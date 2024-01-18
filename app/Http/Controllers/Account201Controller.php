<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\support\Facades\Hash;
use Illuminate\support\Facades\Validator;
use App\Models\User;
use App\Models\Acc_debtor;
use App\Models\Pttype_eclaim;
use App\Models\Account_listpercen;
use App\Models\Leave_month;
use App\Models\Acc_debtor_stamp;
use App\Models\Acc_debtor_sendmoney;
use App\Models\Pttype;
use App\Models\Pttype_acc;
use App\Models\Acc_stm_ti;
use App\Models\Acc_stm_ti_total;
use App\Models\Acc_opitemrece;
use App\Models\Acc_1102050101_202;
use App\Models\Acc_1102050101_217;
use App\Models\Acc_1102050101_2166;
use App\Models\Acc_stm_ucs;
use App\Models\Acc_1102050101_301;
use App\Models\Acc_1102050101_304;
use App\Models\Acc_1102050101_308;
use App\Models\Acc_1102050101_4011;
use App\Models\Acc_1102050101_3099;
use App\Models\Acc_1102050101_401;
use App\Models\Acc_1102050101_402;
use App\Models\Acc_1102050102_801;
use App\Models\Acc_1102050102_802;
use App\Models\Acc_1102050102_803;
use App\Models\Acc_1102050102_804;
use App\Models\Acc_1102050101_4022;
use App\Models\Acc_1102050102_602;
use App\Models\Acc_1102050102_603;
use App\Models\Acc_1102050101_201;
use App\Models\Orginfo;
use App\Models\Acc_stm_ti_excel;
use App\Models\Acc_stm_ofc;
use App\Models\acc_stm_ofcexcel;
use App\Models\Acc_stm_lgo;
use App\Models\Acc_stm_lgoexcel;
use App\Models\Check_sit_auto;
use App\Models\Acc_stm_ucs_excel;

use PDF;
use setasign\Fpdi\Fpdi;
use App\Models\Budget_year;
use Illuminate\Support\Facades\File;
use DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use App\Mail\DissendeMail;
use Mail;
use Illuminate\Support\Facades\Storage;
use Auth;
use Http;
use SoapClient;
// use File;
// use SplFileObject;
use Arr;
// use Storage;
use GuzzleHttp\Client;

use App\Imports\ImportAcc_stm_ti;
use App\Imports\ImportAcc_stm_tiexcel_import;
use App\Imports\ImportAcc_stm_ofcexcel_import;
use App\Imports\ImportAcc_stm_lgoexcel_import;
use App\Models\Acc_1102050101_217_stam;
use App\Models\Acc_opitemrece_stm;

use SplFileObject;
use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set("Asia/Bangkok");


class Account201Controller extends Controller
 { 
    public function account_201_dash(Request $request)
    {
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $dabudget_year = DB::table('budget_year')->where('active','=',true)->first();
        $leave_month_year = DB::table('leave_month')->orderBy('MONTH_ID', 'ASC')->get();
        $date = date('Y-m-d');
        $y = date('Y') + 543;
        $newweek = date('Y-m-d', strtotime($date . ' -1 week')); //ย้อนหลัง 1 สัปดาห์
        $newDate = date('Y-m-d', strtotime($date . ' -1 months')); //ย้อนหลัง 1 เดือน
        $newyear = date('Y-m-d', strtotime($date . ' -1 year')); //ย้อนหลัง 1 ปี
        $yearnew = date('Y')+1;
        $yearold = date('Y');
        $start = (''.$yearold.'-10-01');
        $end = (''.$yearnew.'-09-30'); 

        if ($startdate == '') {
            $datashow = DB::select('
                SELECT month(a.vstdate) as months,year(a.vstdate) as year,l.MONTH_NAME
                    ,count(distinct a.hn) as hn
                    ,count(distinct a.vn) as vn
                    ,sum(a.paid_money) as paid_money
                    ,sum(a.income) as income
                    ,sum(a.income)-sum(a.discount_money)-sum(a.rcpt_money) as total
                    FROM acc_debtor a
                    left outer join leave_month l on l.MONTH_ID = month(a.vstdate)
                    WHERE a.vstdate between "'.$newweek.'" and "'.$date.'"
                    and account_code="1102050101.201"
                    and income <> 0
                    group by month(a.vstdate) 
                    order by a.vstdate desc limit 1;
            ');

        } else {
            $datashow = DB::select('
                SELECT month(a.vstdate) as months,year(a.vstdate) as year,l.MONTH_NAME
                    ,count(distinct a.hn) as hn
                    ,count(distinct a.vn) as vn
                    ,sum(a.paid_money) as paid_money
                    ,sum(a.income) as income
                    ,sum(a.income)-sum(a.discount_money)-sum(a.rcpt_money) as total
                    FROM acc_debtor a
                    left outer join leave_month l on l.MONTH_ID = month(a.vstdate)
                    WHERE a.vstdate between "'.$startdate.'" and "'.$enddate.'"
                    and account_code="1102050101.201"
                    and income <>0
                 
                    order by a.vstdate desc;
            ');
        }

        return view('account_201.account_201_dash',[
            'startdate'        => $startdate,
            'enddate'          => $enddate,
            'leave_month_year' => $leave_month_year,
            'datashow'         => $datashow,
            'newyear'          => $newyear,
            'date'             => $date,
            'newweek'          => $newweek,
        ]);
    }
    public function account_201_pull(Request $request)
    {
        $datenow = date('Y-m-d');
        $months = date('m');
        $year = date('Y');
        // dd($year);
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        if ($startdate == '') {
            // $acc_debtor = Acc_debtor::where('stamp','=','N')->whereBetween('dchdate', [$datenow, $datenow])->get();
            $acc_debtor = DB::select('
                SELECT a.acc_debtor_id,a.vn,a.an,a.hn,a.cid,a.ptname,a.vstdate,a.pttype,a.debit_total 
                 
                from acc_debtor a
                WHERE a.account_code="1102050101.201"
                AND a.stamp = "N"
                group by a.vn
                order by a.vstdate asc
            ');
            // and month(a.dchdate) = "'.$months.'" and year(a.dchdate) = "'.$year.'"
        } else {
            // $acc_debtor = Acc_debtor::where('stamp','=','N')->whereBetween('dchdate', [$startdate, $enddate])->get();
            $acc_debtor = DB::select('
                SELECT a.acc_debtor_id,a.vn,a.an,a.hn,a.cid,a.ptname,a.vstdate,a.pttype,a.debit_total 
                
                from acc_debtor a
                WHERE a.account_code="1102050101.201"
                AND a.stamp = "N"
                group by a.vn
                order by a.vstdate asc
            ');
        }

        return view('account_201.account_201_pull',[
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'acc_debtor'    =>     $acc_debtor,
        ]);
    }

    public function account_201_pulldata(Request $request)
    {
        $db_ = Orginfo::where('orginfo_id','=','1')->first();
        $db  = $db_->dbname;
        $datenow = date('Y-m-d');
        $startdate = $request->datepicker;
        $enddate = $request->datepicker2; 
        $acc_debtor = DB::connection('mysql2')->select('
                SELECT v.vn,ifnull(o.an,"") as an,o.hn,pt.cid
                ,concat(pt.pname,pt.fname," ",pt.lname) as ptname
                ,o.vstdate,o.vsttime 
                ,v.hospmain,vp.max_debt_amount                 
                ,ptt.pttype_eclaim_id ,v.pttype 
                ,e.code as acc_code ,e.ar_opd as account_code ,e.name as account_name
                ,v.income,v.uc_money,v.discount_money,v.paid_money,v.rcpt_money
                
                ,sum(if(d.name like "CT%",sum_price,0)) as CT
                ,if(op.icode IN ("3010058"),sum_price,0) as fokliad 
                ,sum(if(op.income="02",sum_price,0)) as debit_instument
                ,sum(if(op.icode IN("1560016","1540073","1530005","1540048","1620015","1600012","1600015"),sum_price,0)) as debit_drug
                ,sum(if(op.icode IN("3001412","3001417"),sum_price,0)) as debit_toa
                ,sum(if(op.icode IN("3010829","3011068","3010864","3010861","3010862","3010863","3011069","3011012","3011070"),sum_price,0)) as debit_refer
                ,v.income-v.discount_money-v.rcpt_money as debit
                FROM hos.vn_stat v
                LEFT OUTER JOIN hos.ovst o on v.vn=o.vn
                LEFT OUTER JOIN hos.patient pt on pt.hn=v.hn
                LEFT OUTER JOIN hos.visit_pttype vp on vp.vn = v.vn
                LEFT OUTER JOIN hos.pttype ptt on v.pttype=ptt.pttype
                LEFT OUTER JOIN hos.pttype_eclaim e on e.code=ptt.pttype_eclaim_id
                LEFT OUTER JOIN hos.opitemrece op ON op.vn = o.vn
                LEFT OUTER JOIN hos.s_drugitems d on d.icode = op.icode 
                WHERE v.vstdate BETWEEN "' . $startdate . '" AND "' . $enddate . '"    
                AND vp.pttype IN(SELECT pttype FROM pkbackoffice.acc_setpang_type WHERE pang ="1102050101.202" AND opdipd ="OPD")
                AND (o.an="" or o.an is null)
                AND v.hospmain IN(SELECT hospmain FROM pkbackoffice.acc_setpang_type WHERE pang ="1102050101.202")        
                GROUP BY v.vn 
        ');

        foreach ($acc_debtor as $key => $value) {
                    $check = Acc_debtor::where('vn', $value->vn)->where('account_code','1102050101.201')->whereBetween('vstdate', [$startdate, $enddate])->count();
                    if ($check == 0) {
                        if ($value->debit > 0) { 
                        
                            Acc_debtor::insert([
                                'hn'                 => $value->hn,
                                'an'                 => $value->an,
                                'vn'                 => $value->vn,
                                'cid'                => $value->cid,
                                'ptname'             => $value->ptname,
                                'pttype'             => $value->pttype,
                                'vstdate'            => $value->vstdate,
                                'acc_code'           => $value->acc_code,
                                'account_code'       => $value->account_code,
                                'account_name'       => $value->account_name,
                                'hospmain'           => $value->hospmain,
                                'income'             => $value->income,
                                'uc_money'           => $value->uc_money,
                                'discount_money'     => $value->discount_money,
                                'paid_money'         => $value->paid_money,
                                'rcpt_money'         => $value->rcpt_money,
                                'debit'              => $value->debit,
                                'debit_drug'         => $value->debit_drug,
                                'debit_instument'    => $value->debit_instument,
                                'debit_toa'          => $value->debit_toa,
                                'debit_refer'        => $value->debit_refer,
                                'debit_total'        => $value->uc_money,
                                'max_debt_amount'    => $value->max_debt_amount,
                                'acc_debtor_userid'  => Auth::user()->id
                            ]);

                        } else {
                            # code...
                        }
                    }

        }

            return response()->json([

                'status'    => '200'
            ]);
    }
    public function account_201_stam(Request $request)
    {
        $id = $request->ids;
        $iduser = Auth::user()->id;
        $data = Acc_debtor::whereIn('acc_debtor_id',explode(",",$id))->get();
            Acc_debtor::whereIn('acc_debtor_id',explode(",",$id))
                    ->update([
                        'stamp' => 'Y'
                    ]);
        foreach ($data as $key => $value) {
                $date = date('Y-m-d H:m:s');
            //  $check = Acc_debtor::where('vn', $value->vn)->where('account_code','1102050101.4011')->where('account_code','1102050101.4011')->count();
                $check = Acc_1102050101_201::where('vn', $value->vn)->count();
                if ($check > 0) {
                # code...
                } else {
                    if ($value->debit_total > 0) {
                        Acc_1102050101_201::insert([
                            'vn'                => $value->vn,
                            'an'                => $value->an,
                            'hn'                => $value->hn,                          
                            'cid'               => $value->cid,
                            'ptname'            => $value->ptname,
                            'vstdate'           => $value->vstdate,
                            'regdate'           => $value->regdate,
                            'dchdate'           => $value->dchdate,
                            'pttype'            => $value->pttype,
                            'pttype_nhso'       => $value->pttype_spsch,
                            'acc_code'          => $value->acc_code,
                            'account_code'      => $value->account_code,
                            'income'            => $value->income,
                            'hospmain'          => $value->hospmain,
                            'income_group'      => $value->income_group,
                            'uc_money'          => $value->uc_money,
                            'discount_money'    => $value->discount_money,
                            'rcpt_money'        => $value->rcpt_money,
                            'debit'             => $value->debit,
                            'debit_drug'        => $value->debit_drug,
                            'debit_instument'   => $value->debit_instument,
                            'debit_refer'       => $value->debit_refer,
                            'debit_toa'         => $value->debit_toa,
                            'debit_total'       => $value->debit_total,
                            'max_debt_amount'   => $value->max_debt_amount,
                            'rw'                => $value->rw,
                            'adjrw'             => $value->adjrw,
                            'total_adjrw_income'=> $value->total_adjrw_income,
                            'acc_debtor_userid' => $value->acc_debtor_userid
                    ]);
                    }
                   
                }

        }
        return response()->json([
            'status'    => '200'
        ]);
    }
    public function account_201_detail(Request $request,$months,$year)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        // dd($id);
        $data['users'] = User::get();

        $data = DB::select('
       
            SELECT *
            from acc_1102050101_201 
            WHERE month(vstdate) = "'.$months.'" AND year(vstdate) = "'.$year.'"           
            GROUP BY vn
        ');
  
        return view('account_201.account_201_detail', $data, [
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'data'          =>     $data,
            'months'        =>     $months,
            'year'          =>     $year
        ]);
    }
    public function account_201_detaildate(Request $request)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        // dd($id);
        $data['users'] = User::get();

        $data = DB::select(' 
            SELECT *
            from acc_1102050101_201 
            WHERE vstdate BETWEEN "'.$startdate.'" AND "'.$enddate.'"           
            GROUP BY vn
        ');
  
        return view('account_201.account_201_detaildate', $data, [
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'data'          =>     $data,
       
        ]);
    }
    public function account_201_detail_date(Request $request,$startdate,$enddate)
    {
        $datenow = date('Y-m-d'); 
        $data['users'] = User::get();

        $data = DB::select(' 
            SELECT *
            from acc_1102050101_201 
            WHERE vstdate BETWEEN "'.$startdate.'" AND "'.$enddate.'"           
            GROUP BY vn
        ');
  
        return view('account_201.account_201_detail_date', $data, [
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'data'          =>     $data,
       
        ]);
    }
    public function account_201_stmdate(Request $request)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        // dd($id);
        $data['users'] = User::get();

        $datashow = DB::select(' 

            SELECT U1.vn,U1.hn,U1.cid,U1.ptname,U1.vstdate,U1.pttype,U1.debit_total,U2.total_approve
            from acc_1102050101_201 U1 
            LEFT JOIN acc_stm_ucs U2 ON U2.hn = U1.hn AND U2.vstdate = U1.vstdate
            WHERE U1.vstdate BETWEEN "'.$startdate.'" and "'.$enddate.'"
            AND U2.pp is not null

        ');
  
        return view('account_201.account_201_stmdate', $data, [
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'datashow'      =>     $datashow,
       
        ]);
    }
    
    // public function account_602_edit(Request $request, $id)
    // {
    //     $acc602 = Acc_1102050102_602::find($id);
 
    //     return response()->json([
    //         'status'      => '200',
    //         'acc602'      =>  $acc602,
    //     ]);
    // }
    // public function account_602_update(Request $request)
    // {
    //     $iduser = Auth::user()->id;
    //     $id = $request->acc_1102050102_602_id;
    //     $sauntang_ = Acc_1102050102_602::where('acc_1102050102_602_id','=',$id)->first();
    //     $sauntang  = $sauntang_->debit_total;
    //     Acc_1102050102_602::whereIn('acc_1102050102_602_id',explode(",",$id))
    //     ->update([
    //         'status'           => 'Y',
    //         'recieve_true'     => $request->payprice,
    //         'recieve_no'       => $request->money_billno,
    //         'recieve_date'     => $request->paydate,
    //         'savedate'         => $request->savedate,
    //         'difference'       => $sauntang - $request->payprice,
    //         'comment'          => $request->comment,
    //         'recieve_user'     => $iduser
           
    //     ]);

    //     // Acc_stm_prb::whereIn('acc_1102050102_602_sid',explode(",",$id))->delete();
    //     $check = Acc_stm_prb::where('acc_1102050102_602_sid',$id)->count();
    //     if ($check > 0) {
    //         # code...
    //     } else {
    //         $add = new Acc_stm_prb();
    //         $add->acc_1102050102_602_sid = $id;
    //         $add->req_no           = $request->req_no;
    //         $add->pid              = $request->cid;
    //         $add->fullname           = $request->ptname;
    //         $add->claim_no         = $request->claim_no;
    //         $add->vendor           = $request->vendor;
    //         $add->money_billno     = $request->money_billno;
    //         $add->paytype          = $request->paytype;
    //         $add->no               = $request->no;
    //         $add->payprice         = $request->payprice;
    //         $add->paydate          = $request->paydate;
    //         $add->savedate         = $request->savedate;
    //         $add->save();
    //     }
        
       
    //     return response()->json([
    //         'status'      => '200'
    //     ]);
    // }
    
    // public function account_602_stmnull_all(Request $request,$months,$year)
    // {
    //     $datenow = date('Y-m-d');
    //     $startdate = $request->startdate;
    //     $enddate = $request->enddate;
    //     // dd($id);
    //     $data['users'] = User::get();

    //     $datashow = DB::connection('mysql')->select('
    //             SELECT U2.req_no,U1.vn,U1.hn,U1.cid,U1.ptname,U1.vstdate,U1.pttype,U1.debit_total,U2.money_billno,U2.payprice
    //             from acc_1102050102_602 U1
    //             LEFT JOIN acc_stm_prb U2 ON U2.acc_1102050102_602_sid = U1.acc_1102050102_602_id
    //             WHERE U1.status ="N"
    //             AND U2.acc_1102050102_602_sid IS NULL

    //         ');

    //         // AND month(U1.vstdate) = "'.$months.'" and year(U1.vstdate) = "'.$year.'"
    //     return view('account_602.account_602_stmnull_all', $data, [
    //         'startdate'         =>     $startdate,
    //         'enddate'           =>     $enddate,
    //         'datashow'          =>     $datashow,
    //         'months'            =>     $months,
    //         'year'              =>     $year,
    //     ]);
    // }
    // public function account_602_stm(Request $request,$months,$year)
    // {
    //     $datenow = date('Y-m-d');
    //     $startdate = $request->startdate;
    //     $enddate = $request->enddate;
    //     // dd($id);
    //     $data['users'] = User::get();

    //     $datashow = DB::select('
    //     SELECT U2.req_no,U1.an,U1.vn,U1.hn,U1.cid,U1.ptname,U1.vstdate,U1.pttype,U1.debit_total,U1.nhso_docno
    //     ,U1.nhso_ownright_pid,U1.recieve_true,U1.difference,U1.recieve_no,U1.recieve_date,U2.money_billno,U2.payprice
    //         from acc_1102050102_602 U1
    //         LEFT JOIN acc_stm_prb U2 ON U2.acc_1102050102_602_sid = U1.acc_1102050102_602_id
    //         WHERE month(U1.vstdate) = "'.$months.'"
    //         and year(U1.vstdate) = "'.$year.'"
    //         AND U1.nhso_ownright_pid is not null
    //     ');
    //     return view('account_602.account_602_stm', $data, [
    //         'startdate'         =>     $startdate,
    //         'enddate'           =>     $enddate,
    //         'datashow'          =>     $datashow,
    //         'months'            =>     $months,
    //         'year'              =>     $year,

    //     ]);
    // }
    // public function account_602_stmnull(Request $request,$months,$year)
    // {
    //     $datenow = date('Y-m-d');
    //     $startdate = $request->startdate;
    //     $enddate = $request->enddate;
    //     // dd($id);
    //     $data['users'] = User::get();

    //     $datashow = DB::select('
    //         SELECT U1.an,U1.vn,U1.hn,U1.cid,U1.ptname,U1.vstdate,U1.pttype,U1.debit_total,U1.nhso_docno,U1.nhso_ownright_pid,U1.recieve_true,U1.difference,U1.recieve_no,U1.recieve_date
    //             from acc_1102050102_602 U1
        
    //             WHERE month(U1.vstdate) = "'.$months.'"
    //             and year(U1.vstdate) = "'.$year.'"
    //             AND U1.nhso_ownright_pid is null
    //     ');
    //     return view('account_602.account_602_stmnull', $data, [
    //         'startdate'         =>     $startdate,
    //         'enddate'           =>     $enddate,
    //         'datashow'          =>     $datashow,
    //         'months'            =>     $months,
    //         'year'              =>     $year,

    //     ]);
    // }
    // public function account_602_syncall(Request $request)
    // {
    //     $months = $request->months;
    //     $year = $request->year;
    //     $sync = DB::connection('mysql')->select('   
    //             SELECT ac.acc_1102050102_602_id,o.an,o.hn,v.vn,ac.vstdate,v.pttype,v.nhso_ownright_pid,v.nhso_docno 
    //             from hos.visit_pttype v
    //             LEFT JOIN hos.ovst o ON o.vn = v.vn
    //             LEFT JOIN pkbackoffice.acc_1102050102_602 ac ON ac.vn = v.vn                   
    //             WHERE month(o.vstdate) = "'.$months.'" 
    //             AND year(o.vstdate) = "'.$year.'"
    //             AND v.nhso_docno  <> ""
    //             AND ac.acc_1102050102_602_id <> ""
    //             GROUP BY v.vn

    //         ');
    //         foreach ($sync as $key => $value) { 
                     
    //                 Acc_1102050102_602::where('vn',$value->vn) 
    //                     ->update([ 
    //                         'nhso_docno'           => $value->nhso_docno ,
    //                         'nhso_ownright_pid'    => $value->nhso_ownright_pid
    //                 ]);
    //         }
    //         return response()->json([
    //             'status'    => '200'
    //         ]);
        
        
    // }
   
 

 }