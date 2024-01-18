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
use App\Models\Acc_1102050101_216;
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
use App\Models\Acc_stm_prb;
use App\Models\Acc_stm_ti_totalhead;
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


class Account216Controller extends Controller
 { 
    public function account_pkucs216_dash(Request $request)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $dabudget_year = DB::table('budget_year')->where('active','=',true)->first();

        $leave_month_year = DB::table('leave_month')->orderBy('MONTH_ID', 'ASC')->get();
        $date = date('Y-m-d');
        $y = date('Y') + 543;
        $newweek = date('Y-m-d', strtotime($date . ' -1 week')); //ย้อนหลัง 1 สัปดาห์
        $newDate = date('Y-m-d', strtotime($date . ' -5 months')); //ย้อนหลัง 5 เดือน
        $newyear = date('Y-m-d', strtotime($date . ' -1 year')); //ย้อนหลัง 1 ปี
        $yearnew = date('Y')+1;
        $yearold = date('Y')-1;
        $start = (''.$yearold.'-10-01');
        $end = (''.$yearnew.'-09-30'); 

        if ($startdate == '') {
            $datashow = DB::select('
                    SELECT month(a.vstdate) as months,year(a.vstdate) as year,l.MONTH_NAME
                    ,count(distinct a.hn) as hn
                    ,count(distinct a.vn) as vn
                    ,count(distinct a.an) as an
                    ,sum(a.income) as income
                    ,sum(a.paid_money) as paid_money
                    ,sum(a.income)-sum(a.discount_money)-sum(a.rcpt_money) as total
                    ,sum(a.debit) as debit
                    FROM acc_debtor a
                    left outer join leave_month l on l.MONTH_ID = month(a.vstdate)
                    WHERE a.vstdate between "'.$start.'" and "'.$end.'"
                    and account_code="1102050101.216"
                    group by month(a.vstdate) order by a.vstdate desc limit 3;
            ');
            // and stamp = "N"
        } else {
            $datashow = DB::select('
                    SELECT month(a.vstdate) as months,year(a.vstdate) as year,l.MONTH_NAME
                    ,count(distinct a.hn) as hn
                    ,count(distinct a.vn) as vn
                    ,count(distinct a.an) as an
                    ,sum(a.income) as income
                    ,sum(a.paid_money) as paid_money
                    ,sum(a.income)-sum(a.discount_money)-sum(a.rcpt_money) as total
                    ,sum(a.debit) as debit
                    FROM acc_debtor a
                    left outer join leave_month l on l.MONTH_ID = month(a.vstdate)
                    WHERE a.vstdate between "'.$startdate.'" and "'.$enddate.'"
                    and account_code="1102050101.216"
                    group by month(a.vstdate) order by a.vstdate desc;
            ');
        }

        return view('account_216.account_pkucs216_dash',[
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'datashow'    =>     $datashow,
            'leave_month_year' =>  $leave_month_year,
        ]);
    }
    public function account_pkucs216_pull(Request $request)
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
                SELECT a.acc_debtor_id,a.vn,a.hn,a.cid,a.vstdate,a.ptname,a.pttype,a.income,a.debit_total,a.debit_instument
                ,a.debit_drug,a.debit_toa,a.debit_refer,c.subinscl 
                from acc_debtor a
                left outer join checksit_hos c on c.vn = a.vn
               
                WHERE a.account_code="1102050101.216"
                AND a.stamp = "N" 
                group by a.vn
                order by a.vstdate desc;
            ');
            // AND a.dchdate BETWEEN "'.$startdate.'" AND "'.$enddate.'"
            // AND a.pttype IN(SELECT pttype from pkbackoffice.acc_setpang_type WHERE pttype IN (SELECT pttype FROM pkbackoffice.acc_setpang_type WHERE pang ="1102050101.202"))
            // SELECT a.*,c.subinscl from acc_debtor a
            // left outer join check_sit_auto c on c.cid = a.cid and c.vstdate = a.vstdate
            // WHERE a.account_code="1102050101.217"
            // AND a.stamp = "N"
            // and month(a.dchdate) = "'.$months.'" and year(a.dchdate) = "'.$year.'"
            // order by a.dchdate asc;
        } else {
            $acc_debtor = DB::select('
            SELECT a.acc_debtor_id,a.vn,a.hn,a.cid,a.vstdate,a.ptname,a.pttype,a.income,a.debit_total,a.debit_instument
            ,a.debit_drug,a.debit_toa,a.debit_refer,c.subinscl 
             from acc_debtor a
                left join checksit_hos c on c.vn = a.vn

                WHERE a.account_code="1102050101.216"
                AND a.stamp = "N" 
                group by a.vn
                order by a.vstdate desc;
            ');
            // $acc_debtor = Acc_debtor::where('stamp','=','N')->whereBetween('dchdate', [$startdate, $enddate])->get();
        }
        return view('account_216.account_pkucs216_pull',[
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'acc_debtor'    =>     $acc_debtor,
        ]);
    }
    public function account_pkucs216_pulldata(Request $request)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->datepicker;
        $enddate = $request->datepicker2;
        $acc_debtor = DB::connection('mysql2')->select(' 
                 SELECT v.vn,ifnull(o.an,"") as an,o.hn,pt.cid
                ,concat(pt.pname,pt.fname," ",pt.lname) as ptname
                ,v.vstdate,v.hospmain 
                
                ,vp.pttype,"03" as acc_code
                ,"1102050101.216" as account_code ,"ลูกหนี้ค่ารักษา UC-OP บริการเฉพาะ (CR)" as account_name
                ,v.income,v.uc_money,v.discount_money,v.paid_money,v.rcpt_money
                 
                ,CASE 
                WHEN vp.pttype = "49" THEN v.income
                WHEN sum(if(op.icode IN ("3001412","3001417"),sum_price,0)) > 0 THEN v.income	
                WHEN  vp.pttype_number ="2" AND vp.pttype NOT IN ("31","36","39") AND vp.max_debt_amount = "" OR sum(if(op.income="02",sum_price,0)) > 0 THEN 
                (sum(if(op.income="02",sum_price,0))) +
                (sum(if(op.icode IN("1560016","1540073","1530005","3001412","3001417","3010829","3011068","3010864","3010861","3010862","3010863","3011069","3011012","3011070"),sum_price,0)))     
                WHEN vp.pttype_number ="2" AND vp.pttype NOT IN ("31","36","39") AND vp.max_debt_amount <> "" THEN vp.max_debt_amount  		
                ELSE                 
                (sum(if(op.income="02",sum_price,0))) +
                (sum(if(op.icode IN("1560016","1540073","1530005","3001412","3001417","3010829","3011068","3010864","3010861","3010862","3010863","3011069","3011012","3011070"),sum_price,0)))   
                END as debit
                                                
                ,v.income-v.discount_money-v.rcpt_money as debit2
                 
                ,sum(if(op.income="02",sum_price,0)) as debit_instument
                ,sum(if(op.icode IN("1560016","1540073","1530005"),sum_price,0)) as debit_drug
                ,sum(if(op.icode IN("3001412","3001417"),sum_price,0)) as debit_toa
                ,sum(if(op.icode IN("3010829","3011068","3010864","3010861","3010862","3010863","3011069","3011012","3011070"),sum_price,0)) as debit_refer
                ,vp.max_debt_amount
                from hos.ovst o
                left outer join hos.vn_stat v on v.vn=o.vn
                left outer join visit_pttype vp on vp.vn = v.vn
                left outer join hos.patient pt on pt.hn=o.hn
                left outer join hos.pttype ptt on o.pttype=ptt.pttype
                left outer join hos.pttype_eclaim e on e.code=ptt.pttype_eclaim_id
                left outer join hos.opitemrece op ON op.vn = o.vn
                left outer join s_drugitems s on s.icode = op.icode

                WHERE v.vstdate BETWEEN "' . $startdate . '" AND "' . $enddate . '"
                AND v.income-v.discount_money-v.rcpt_money <> 0
                AND vp.pttype IN (SELECT pttype FROM pkbackoffice.acc_setpang_type WHERE pang ="1102050101.216")
                
                AND op.icode NOT like "c%" 
                AND op.icode NOT IN("3003661","3003662","3003336","3002896","3002897","3002898","3002910","3002911","3002912","3002913","3002914","3002915","3002916","3002917","3002918","3003608","3010102","3010353")
                AND (o.an="" or o.an is null)
                GROUP BY v.vn 
                
        '); 
        // AND s.nhso_adp_code NOT IN("3001","3002","2501","2502","3001","3002","9214","8901","8902","8904","8608","9001","8903","9211","9212","020700")
        // AND op.icode NOT IN("3003661","3003662","3010272","3003663","3002896","3002897","3002898","3002910","3002911","3002912","3002913","3002914","3002915","3002916","3002917","3002918","3009702","3010348")
        // AND op.icode IN(SELECT icode from pkbackoffice.acc_setpang_type WHERE icode IN(SELECT icode FROM pkbackoffice.acc_setpang_type WHERE pang ="1102050101.217"))
        foreach ($acc_debtor as $key => $value) {
            if ($value->debit_refer > 0 ) {
                # code...
            } else { 
                if ($value->debit >0) {
                    // $check = Acc_debtor::where('vn', $value->vn)->where('account_code', '1102050101.216')->whereBetween('vstdate', [$startdate, $enddate])->count();
                    $check = Acc_debtor::where('vn', $value->vn)->where('account_code', '1102050101.216')->count();
                    if ($check == 0) {
                        Acc_debtor::insert([
                            'hn'                 => $value->hn,
                            'an'                 => $value->an,
                            'vn'                 => $value->vn,
                            'cid'                => $value->cid,
                            'ptname'             => $value->ptname,
                            'pttype'             => $value->pttype,
                            'vstdate'            => $value->vstdate,
                            // 'regdate'            => $value->regdate,
                            // 'dchdate'            => $value->dchdate,
                            'acc_code'           => $value->acc_code,
                            'account_code'       => $value->account_code,
                            'account_name'       => $value->account_name,
                            // 'income_group'       => $value->income_group,
                            'income'             => $value->income,
                            'uc_money'           => $value->uc_money,
                            'discount_money'     => $value->discount_money,
                            // 'paid_money'         => $value->cash_money,
                            'rcpt_money'         => $value->rcpt_money,
                            'debit'              => $value->debit,
                            'debit_drug'         => $value->debit_drug,
                            'debit_instument'    => $value->debit_instument,
                            'debit_toa'          => $value->debit_toa,
                            'debit_refer'        => $value->debit_refer,
                            'debit_total'        => $value->debit,
                            'max_debt_amount'    => $value->max_debt_amount,
                            // 'rw'                 => $value->rw,
                            // 'adjrw'              => $value->adjrw,
                            // 'total_adjrw_income' => $value->total_adjrw_income,
                            'acc_debtor_userid'  => Auth::user()->id
                        ]);
                    }
                } else {
                    # code...
                }  
            }
        }
        return response()->json([
            'status'    => '200'
        ]);
    } 
    public function account_pkucs216_stam(Request $request)
    {
        $id = $request->ids;
        $iduser = Auth::user()->id;
        // Acc_1102050101_217_stam::truncate();
        $data = Acc_debtor::whereIn('acc_debtor_id',explode(",",$id))->get();
            Acc_debtor::whereIn('acc_debtor_id',explode(",",$id))
                    ->update([
                        'stamp' => 'Y'
                    ]);
        foreach ($data as $key => $value) {
            Acc_1102050101_216::insert([
                'vn'                => $value->vn,
                'hn'                => $value->hn,
                'an'                => $value->an,
                'cid'               => $value->cid,
                'ptname'            => $value->ptname,
                'vstdate'           => $value->vstdate,
                'regdate'           => $value->regdate,
                'dchdate'           => $value->dchdate,
                'pttype'            => $value->pttype,
                'acc_code'          => $value->acc_code,
                'account_code'      => $value->account_code,
                'rw'                 => $value->rw,
                'adjrw'              => $value->adjrw,
                'total_adjrw_income' => $value->total_adjrw_income,
                'debit_drug'         => $value->debit_drug,
                'debit_instument'    => $value->debit_instument,
                'debit_toa'          => $value->debit_toa,
                'debit_refer'        => $value->debit_refer,
                'income'             => $value->income,
                'uc_money'           => $value->uc_money,
                'discount_money'     => $value->discount_money,
                'rcpt_money'         => $value->rcpt_money, 
                'debit'              => $value->debit,
                'debit_total'        => $value->debit_total,
                'acc_debtor_userid'  => $value->acc_debtor_userid
            ]);
        }
        
        return response()->json([
            'status'    => '200'
        ]);
    } 
    
    public function account_pkucs216_detail(Request $request,$months,$year)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        // dd($id);
        $data['users'] = User::get();

        $data = DB::select('
            SELECT *  from acc_1102050101_216 
            WHERE month(vstdate) = "'.$months.'" and year(vstdate) = "'.$year.'"

            
            
        ');
        // SELECT *  from acc_1102050101_216 a
            // left outer join acc_opitemrece ao ON ao.vn = a.vn
            // WHERE month(a.vstdate) = "'.$months.'" and year(a.vstdate) = "'.$year.'"
        // AND status = "N"
        return view('account_216.account_pkucs216_detail', $data, [
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'data'          =>     $data,
            'months'        =>     $months,
            'year'          =>     $year
        ]);
    }
    
    public function account_pkucs216_stm(Request $request,$months,$year)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        // dd($id);
        $data['users'] = User::get();

        $datashow = DB::select('
        

            SELECT s.tranid,a.vn,a.an,a.hn,a.cid,a.ptname,a.vstdate,a.dchdate,s.dmis_money2
            ,a.income_group,s.inst,s.hc,s.hc_drug,s.ae,s.ae_drug,s.STMdoc,a.debit_total,s.ip_paytrue as STM202
            ,s.hc_drug+ s.hc+ s.ae_drug+s.inst+s.ae+s.fs as stm216
            ,s.total_approve STM_TOTAL
            from acc_1102050101_216 a
            LEFT JOIN acc_stm_ucs s ON s.hn = a.hn AND s.vstdate = a.vstdate
            WHERE month(a.vstdate) = "'.$months.'" and year(a.vstdate) = "'.$year.'"
            
            AND (s.hc_drug+ s.hc+s.ae_drug+s.inst+s.ae+s.fs <> 0 OR s.hc_drug+ s.hc+ s.ae_drug+s.inst+s.ae+s.fs <> "")
            group by a.vn
        ');
        // AND s.rep IS NOT NULL
       
            return view('account_216.account_pkucs216_stm', $data, [
                'startdate'         =>     $startdate,
                'enddate'           =>     $enddate,
                'datashow'          =>     $datashow,
                'months'            =>     $months,
                'year'              =>     $year, 
            ]);
    }
    public function account_pkucs216_stmnull(Request $request,$months,$year)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        // dd($id);
        $data['users'] = User::get();

        $data = DB::select('
                SELECT s.tranid,a.vn,a.an,a.hn,a.cid,a.ptname,a.vstdate,a.dchdate,a.debit_total,s.dmis_money2,s.total_approve,a.income_group,s.inst,s.ip_paytrue
                ,s.hc_drug+ s.hc+ s.ae_drug+s.inst+s.ae+s.fs as stm216
                from acc_1102050101_216 a
                LEFT JOIN acc_stm_ucs s ON s.hn = a.hn AND s.vstdate = a.vstdate
                WHERE a.status ="N"
                AND month(a.vstdate) = "'.$months.'" and year(a.vstdate) = "'.$year.'"
                AND (s.hc_drug+ s.hc+s.ae_drug+s.inst+s.ae+s.fs < 1 OR s.hc_drug+ s.hc+ s.ae_drug+s.inst+s.ae+s.fs is null)
                
                group by a.vn
        ');
        // AND (s.hc_drug+ s.hc+ s.ae+ s.ae_drug+s.inst+s.dmis_money2 + s.dmis_drug = 0 OR s.hc_drug+ s.hc+ s.ae+ s.ae_drug+s.inst+s.dmis_money2 + s.dmis_drug is null)

        return view('account_216.account_pkucs216_stmnull', $data, [
            'startdate'         =>     $startdate,
            'enddate'           =>     $enddate,
            'data'              =>     $data,
            'months'            =>     $months,
            'year'              =>     $year, 
        ]);
    }

    public function account_pkucs216_stm_date(Request $request,$startdate,$enddate)
    {
        $data['users'] = User::get();

        $datashow = DB::select('
        

            SELECT s.tranid,a.vn,a.an,a.hn,a.cid,a.ptname,a.vstdate,a.dchdate,s.dmis_money2
            ,a.income_group,s.inst,s.hc,s.hc_drug,s.ae,s.ae_drug,s.STMdoc,a.debit_total,s.ip_paytrue as STM202
            ,s.hc_drug+ s.hc+ s.ae_drug+s.inst+s.ae+s.fs as stm216
            ,s.total_approve STM_TOTAL
            from acc_1102050101_216 a
            LEFT JOIN acc_stm_ucs s ON s.hn = a.hn AND s.vstdate = a.vstdate
            WHERE a.vstdate between "'.$startdate.'" and "'.$enddate.'"
            AND (s.hc_drug+ s.hc+s.ae_drug+s.inst+s.ae+s.fs <> 0 OR s.hc_drug+ s.hc+ s.ae_drug+s.inst+s.ae+s.fs <> "")
           
            group by a.vn
        ');
        // AND (s.hc_drug+ s.hc+s.ae_drug+s.inst+s.ae <> 0 OR s.hc_drug+ s.hc+ s.ae_drug+s.inst+s.ae <> "") 
        // AND (s.hc_drug+ s.hc+ s.ae+ s.ae_drug+s.inst+s.dmis_money2 + s.dmis_drug <> 0 OR s.hc_drug+ s.hc+ s.ae+ s.ae_drug+s.inst+s.dmis_money2 + s.dmis_drug <> "") 
        // AND s.rep IS NOT NULL
       
            return view('account_216.account_pkucs216_stm_date', $data, [
                'startdate'         =>     $startdate,
                'enddate'           =>     $enddate,
                'datashow'          =>     $datashow, 
            ]);
    }
    public function account_pkucs216_detail_date(Request $request,$startdate,$enddate)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        // dd($id);
        $data['users'] = User::get();

        $data = DB::select('
            SELECT *  from acc_1102050101_216 
            WHERE vstdate between "'.$startdate.'" and  "'.$enddate.'" 
        '); 
        return view('account_216.account_pkucs216_detail_date', $data, [
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'data'          =>     $data, 
        ]);
    }
    public function account_pkucs216_stmnull_date(Request $request,$startdate,$enddate)
    { 
        $data['users'] = User::get();

        $data = DB::select('
                SELECT s.tranid,a.vn,a.an,a.hn,a.cid,a.ptname,a.vstdate,a.dchdate,a.debit_total,s.dmis_money2,s.total_approve,a.income_group,s.inst,s.ip_paytrue
                ,s.hc_drug+ s.hc+ s.ae_drug+s.inst+s.ae+s.fs as stm216
                from acc_1102050101_216 a
                LEFT JOIN acc_stm_ucs s ON s.hn = a.hn AND s.vstdate = a.vstdate
                WHERE a.status ="N"
                AND a.vstdate between "'.$startdate.'" and  "'.$enddate.'" 
                AND (s.hc_drug+ s.hc+s.ae_drug+s.inst+s.ae+s.fs <> 0 OR s.hc_drug+ s.hc+ s.ae_drug+s.inst+s.ae+s.fs is null)
                
                group by a.vn
        '); 
          
        // AND (s.hc_drug+ s.hc+ s.ae+ s.ae_drug+s.inst+s.dmis_money2 + s.dmis_drug = 0 OR s.hc_drug+ s.hc+ s.ae+ s.ae_drug+s.inst+s.dmis_money2 + s.dmis_drug is null)
        return view('account_216.account_pkucs216_stmnull_date', $data, [
            'startdate'         =>     $startdate,
            'enddate'           =>     $enddate,
            'data'              =>     $data, 
        ]);
    }

 }