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
use App\Models\Acc_1102050101_310;
use App\Models\Acc_1102050101_302;

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


class Account310Controller extends Controller
 { 
    // ***************** 310********************************
    public function account_310_dash(Request $request)
    {
            $datenow = date('Y-m-d');
            $startdate = $request->startdate;
            $enddate = $request->enddate;
            $acc_trimart_id = $request->acc_trimart_id;

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
            // dd($start);
            // $data_trimart = DB::table('acc_trimart')->limit(3)->orderBy('acc_trimart_id','desc')->get();
            if ($acc_trimart_id == '') {
                $data_trimart = DB::select('SELECT *,year(acc_trimart_start_date) as year FROM acc_trimart WHERE acc_trimart_start_date BETWEEN "'.$start.'" AND "'.$date.'" order by acc_trimart_id desc');
                // $data_trimart = DB::table('acc_trimart')->limit(6)->orderBy('acc_trimart_id','desc')->get();
                $trimart = DB::table('acc_trimart')->orderBy('acc_trimart_id','desc')->get();
            } else {
                // $data_trimart = DB::table('acc_trimart')->whereBetween('dchdate', [$startdate, $enddate])->orderBy('acc_trimart_id','desc')->get();
                // $data_trimart = DB::table('acc_trimart')->where('acc_trimart_id','=',$acc_trimart_id)->orderBy('acc_trimart_id','desc')->get();
                $data_trimart = DB::select('SELECT *,year(acc_trimart_start_date) as year FROM acc_trimart where acc_trimart_id = "'.$acc_trimart_id.'" order by acc_trimart_id desc');
                $trimart = DB::table('acc_trimart')->orderBy('acc_trimart_id','desc')->get();
            }

            return view('account_310.account_310_dash',[
                'startdate'        => $startdate,
                'enddate'          => $enddate,
                'trimart'          => $trimart,
                'leave_month_year' => $leave_month_year,
                'data_trimart'     => $data_trimart,
            ]);
    }
    
    public function account_302_dashsubdetail(Request $request,$months,$year)
    {
        $datenow = date('Y-m-d'); 
        // dd($id);
        $data['users'] = User::get();

        $data = DB::select('
        SELECT 
            month(dchdate) as months,year(dchdate) as year
            ,an,vn,hn,cid,ptname,dchdate,pttype,debit_total
            from acc_1102050101_302
        
            WHERE month(dchdate) = "'.$months.'"  
            AND year(dchdate) = "'.$year.'"
        ');
        // WHERE month(U1.vstdate) = "'.$months.'" and year(U1.vstdate) = "'.$year.'"
        return view('account_302.account_302_dashsubdetail', $data, [ 
            'data'          =>     $data,
            'year'          =>     $year,
            'months'        =>     $months
        ]);
    }

    public function account_310_pull(Request $request)
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
                 
                SELECT a.acc_debtor_id,a.vn,a.an,a.hn,a.cid,a.ptname,a.vstdate,a.pttype,a.debit_total,c.subinscl,a.dchdate ,a.debit
              
                from acc_debtor a
                left join checksit_hos c on c.an = a.an
                WHERE a.account_code="1102050101.310"
                AND a.stamp = "N"
                order by a.dchdate desc;

            ');
            // a.*,c.subinscl 
            // and month(a.dchdate) = "'.$months.'" and year(a.dchdate) = "'.$year.'"
        } else {
            // $acc_debtor = Acc_debtor::where('stamp','=','N')->whereBetween('dchdate', [$startdate, $enddate])->get();
        }

        return view('account_310.account_310_pull',[
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'acc_debtor'    =>     $acc_debtor,
        ]);
    }
    public function account_310_pulldata(Request $request)
    {
        $datenow = date('Y-m-d');
        $startdate = $request->datepicker;
        $enddate = $request->datepicker2;
        // Acc_opitemrece::truncate();
            $acc_debtor = DB::connection('mysql2')->select('
                SELECT a.vn,a.an,a.hn,pt.cid,concat(pt.pname,pt.fname," ",pt.lname) ptname
                    ,a.regdate as admdate,a.dchdate as dchdate,v.vstdate,op.income as income_group,ip.rw
                    ,ipt.pttype,ptt.max_debt_money
                    ,"15" as acc_code 
                    ,"1102050101.310" as account_code 
                    ,"ประกันสังคม HC/AE" as account_name  
                    ,a.income as income ,a.uc_money,a.rcpt_money as cash_money,a.discount_money
                    ,a.income-a.rcpt_money-a.discount_money as debit
                    ,CASE 
                    WHEN op.icode ="3001758" THEN "1000" 
					WHEN  io.icd9 like "%6632%" THEN "1000" 
                    ELSE "0"
                    END as looknee_mun
                    ,sum(if(op.icode IN ("3001758"),sum_price,0)) as tr
				    ,sum(if(op.icode IN ("3001758"),"1000",0)) as looknee
                    ,sum(if(op.icode ="3010058",sum_price,0)) as fokliad
                    ,sum(if(op.income="02",sum_price,0)) as debit_instument
                    ,sum(if(op.icode IN("1560016","1540073","1530005","1540048","1620015","1600012","1600015"),sum_price,0)) as debit_drug
                    ,sum(if(op.icode IN("3001412","3001417"),sum_price,0)) as debit_toa
                    ,sum(if(op.icode IN("3010829","3011068","3010864","3010861","3010862","3010863","3011069","3011012","3011070"),sum_price,0)) as debit_refer

                    from hos.ipt ip
                    LEFT JOIN hos.an_stat a ON ip.an = a.an
                    LEFT JOIN hos.patient pt on pt.hn=a.hn
                    LEFT JOIN hos.pttype ptt on a.pttype=ptt.pttype
                    LEFT JOIN hos.pttype_eclaim ec on ec.code=ptt.pttype_eclaim_id
                    LEFT JOIN hos.ipt_pttype ipt ON ipt.an = a.an
                    LEFT JOIN hos.opitemrece op ON ip.an = op.an
                    LEFT JOIN hos.nondrugitems n ON n.icode = op.icode
                    LEFT JOIN hos.iptoprt io on io.an = ip.an
                    LEFT JOIN hos.vn_stat v on v.vn = a.vn
                    WHERE a.dchdate BETWEEN "' . $startdate . '" AND "' . $enddate . '"
                    AND ipt.pttype IN(SELECT pttype FROM pkbackoffice.acc_setpang_type WHERE pang ="1102050101.310" AND opdipd ="IPD")
                    AND v.hospmain IN(SELECT hospmain FROM pkbackoffice.acc_setpang_type WHERE pang ="1102050101.310" AND hospmain <> "")
                    and io.icd9 like "%6632%"
                GROUP BY a.an; 
            ');
            // AND ipt.pttype IN(SELECT pttype from pkbackoffice.acc_setpang_type WHERE pttype IN (SELECT pttype FROM pkbackoffice.acc_setpang_type WHERE pang ="1102050101.310" AND opdipd ="IPD"))
            // ,sum(if(op.icode IN ("3001758"),"1000",0)) as looknee
            // AND ipt.pttype IN("A7","15")
            foreach ($acc_debtor as $key => $value) { 
                $check =  Acc_debtor::where('an', $value->an)->where('account_code','1102050101.310')->whereBetween('dchdate', [$startdate, $enddate])->count();   
                        if ($check > 0) {
                            Acc_debtor::where('an', $value->an)->where('account_code','1102050101.310')->update([ 
                                'acc_code'           => $value->acc_code,
                                'account_code'       => $value->account_code,
                                'account_name'       => $value->account_name, 
                                'income'             => $value->income,
                                'uc_money'           => $value->uc_money,
                                'discount_money'     => $value->discount_money,
                                'paid_money'         => $value->cash_money,
                                'rcpt_money'         => $value->cash_money,
                                'debit'              => $value->debit, 
                                'debit_total'        => $value->looknee_mun, 
                                'acc_debtor_userid'  => Auth::user()->id
                            ]); 
                        } else {
                            Acc_debtor::insert([
                                'hn'                 => $value->hn,
                                'an'                 => $value->an,
                                'vn'                 => $value->vn,
                                'cid'                => $value->cid,
                                'ptname'             => $value->ptname,
                                'pttype'             => $value->pttype,
                                'vstdate'            => $value->vstdate,
                                'regdate'            => $value->admdate,
                                'dchdate'            => $value->dchdate,
                                'acc_code'           => $value->acc_code,
                                'account_code'       => $value->account_code,
                                'account_name'       => $value->account_name,
                                'income_group'       => $value->income_group,
                                'income'             => $value->income,
                                'uc_money'           => $value->uc_money,
                                'discount_money'     => $value->discount_money,
                                'paid_money'         => $value->cash_money,
                                'rcpt_money'         => $value->cash_money,
                                'debit'              => $value->debit,
                                'debit_drug'         => $value->debit_drug,
                                'debit_instument'    => $value->debit_instument,
                                'debit_toa'          => $value->debit_toa,
                                'debit_refer'        => $value->debit_refer,
                                'fokliad'            => $value->fokliad,
                                'debit_total'        => $value->looknee_mun,
                                // 'max_debt_amount'    => $value->max_debt_money,
                                'acc_debtor_userid'  => Auth::user()->id
                            ]); 
                        }
                        
                        // if ($check == 0) { 
                        //     Acc_debtor::insert([
                        //         'hn'                 => $value->hn,
                        //         'an'                 => $value->an,
                        //         'vn'                 => $value->vn,
                        //         'cid'                => $value->cid,
                        //         'ptname'             => $value->ptname,
                        //         'pttype'             => $value->pttype,
                        //         'vstdate'            => $value->vstdate,
                        //         'regdate'            => $value->admdate,
                        //         'dchdate'            => $value->dchdate,
                        //         'acc_code'           => $value->acc_code,
                        //         'account_code'       => $value->account_code,
                        //         'account_name'       => $value->account_name,
                        //         'income_group'       => $value->income_group,
                        //         'income'             => $value->income,
                        //         'uc_money'           => $value->uc_money,
                        //         'discount_money'     => $value->discount_money,
                        //         'paid_money'         => $value->cash_money,
                        //         'rcpt_money'         => $value->cash_money,
                        //         'debit'              => $value->debit,
                        //         'debit_drug'         => $value->debit_drug,
                        //         'debit_instument'    => $value->debit_instument,
                        //         'debit_toa'          => $value->debit_toa,
                        //         'debit_refer'        => $value->debit_refer,
                        //         'fokliad'            => $value->fokliad,
                        //         'debit_total'        => $value->looknee_mun,
                        //         // 'max_debt_amount'    => $value->max_debt_money,
                        //         'acc_debtor_userid'  => Auth::user()->id
                        //     ]); 
                        // }  
            }
            return response()->json([ 
                'status'    => '200'
            ]);
    }
    public function account_310_stam(Request $request)
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
             
                $check = Acc_1102050101_310::where('an', $value->an)->count();
                if ($check > 0) {
                # code...
                } else {
                    Acc_1102050101_310::insert([
                            'vn'                => $value->vn,
                            'hn'                => $value->hn,
                            'an'                => $value->an,
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
                            'acc_debtor_userid' => $iduser
                    ]);
                }

        }
        return response()->json([
            'status'    => '200'
        ]);
    }

    public function account_310_destroy_all(Request $request)
    {
        $id = $request->ids;
        $iduser = Auth::user()->id;
        $data = Acc_debtor::whereIn('acc_debtor_id',explode(",",$id))->get();
            Acc_debtor::whereIn('acc_debtor_id',explode(",",$id))->delete();
                    // ->update([ 'stamp' => 'Y' ]);
        // foreach ($data as $key => $value) {
                // $date = date('Y-m-d H:m:s'); 
                // $check = Acc_1102050101_310::where('an', $value->an)->count();
                // if ($check > 0) {
                // # code...
                // } else {
                //     Acc_1102050101_310::insert([
                //             'vn'                => $value->vn,
                //             'hn'                => $value->hn,
                //             'an'                => $value->an,
                //             'cid'               => $value->cid,
                //             'ptname'            => $value->ptname,
                //             'vstdate'           => $value->vstdate,
                //             'regdate'           => $value->regdate,
                //             'dchdate'           => $value->dchdate,
                //             'pttype'            => $value->pttype,
                //             'pttype_nhso'       => $value->pttype_spsch,
                //             'acc_code'          => $value->acc_code,
                //             'account_code'      => $value->account_code,
                //             'income'            => $value->income,
                //             'income_group'      => $value->income_group,
                //             'uc_money'          => $value->uc_money,
                //             'discount_money'    => $value->discount_money,
                //             'rcpt_money'        => $value->rcpt_money,
                //             'debit'             => $value->debit,
                //             'debit_drug'        => $value->debit_drug,
                //             'debit_instument'   => $value->debit_instument,
                //             'debit_refer'       => $value->debit_refer,
                //             'debit_toa'         => $value->debit_toa,
                //             'debit_total'       => $value->debit_total,
                //             'max_debt_amount'   => $value->max_debt_amount,
                //             'acc_debtor_userid' => $iduser
                //     ]);
                // } 
        // }
        return response()->json([
            'status'    => '200'
        ]);
    }
   
    
    public function account_310_dashsub(Request $request,$startdate,$enddate)
    {
        $datenow = date('Y-m-d');
        
        $dabudget_year = DB::table('budget_year')->where('active','=',true)->first();
        $leave_month_year = DB::table('leave_month')->orderBy('MONTH_ID', 'ASC')->get();
        $date = date('Y-m-d'); 
        // dd($end );
       
            $datashow = DB::select('
                    SELECT month(a.dchdate) as months,year(a.dchdate) as year,l.MONTH_NAME,l.MONTH_ID
                    ,count(distinct a.hn) as hn
                    ,count(distinct a.vn) as vn
                    ,count(distinct a.an) as an
                    ,sum(a.income) as income
                    ,sum(a.paid_money) as paid_money
                    ,sum(a.income)-sum(a.discount_money)-sum(a.rcpt_money) as total
                    ,sum(a.debit) as debit
                    FROM acc_debtor a
                    left outer join leave_month l on l.MONTH_ID = month(a.dchdate)
                    WHERE a.dchdate between "'.$startdate.'" and "'.$enddate.'"
                    and account_code="1102050101.310"
                    group by month(a.dchdate) order by month(a.dchdate) desc;
            ');
            

        return view('account_310.account_310_dashsub',[
            'startdate'          =>  $startdate,
            'enddate'            =>  $enddate,
            'datashow'           =>  $datashow,
            'leave_month_year'   =>  $leave_month_year,
        ]);
    }

    public function account_310_dashsubdetail(Request $request,$months,$year)
    {
        $datenow = date('Y-m-d'); 
        // dd($id);
        $data['users'] = User::get();

        $data = DB::select('
        SELECT 
            month(dchdate) as months,year(dchdate) as year
            ,an,vn,hn,cid,ptname,dchdate,pttype,debit,debit_total
            from acc_1102050101_310
        
            WHERE month(dchdate) = "'.$months.'"  
            AND year(dchdate) = "'.$year.'"
        ');
        // WHERE month(U1.vstdate) = "'.$months.'" and year(U1.vstdate) = "'.$year.'"
        return view('account_310.account_310_dashsubdetail', $data, [ 
            'data'          =>     $data,
            'year'          =>     $year,
            'months'        =>     $months
        ]);
    }

    public function account_310_detail_date(Request $request)
    {
        $datenow = date('Y-m-d'); 
        // dd($id);
        $data['users'] = User::get();
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $data = DB::select('
        SELECT an,vn,hn,cid,ptname,dchdate,pttype,debit,debit_total
            from acc_1102050101_310
        
            WHERE dchdate BETWEEN "'.$startdate.'"  AND "'.$enddate.'"
        '); 
        return view('account_310.account_310_detail_date', $data, [ 
            'data'           =>     $data,
            'startdate'      =>     $startdate,
            'enddate'        =>     $enddate
        ]);
    }
   
 }