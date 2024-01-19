<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\support\Facades\Hash;
use Illuminate\support\Facades\Validator;
use App\Models\User;
use App\Models\Ot_one;
use PDF;
use setasign\Fpdi\Fpdi;
use App\Models\Budget_year;
use Illuminate\Support\Facades\File;
use DataTables;
use Intervention\Image\ImageManagerStatic as Image;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\OtExport;
// use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Department;
use App\Models\Departmentsub;
use App\Models\Departmentsubsub;
use App\Models\Position;
use App\Models\Product_spyprice;
use App\Models\Products;
use App\Models\Products_type;
use App\Models\Product_group;
use App\Models\Product_unit;
use App\Models\Products_category;
use App\Models\Article;
use App\Models\Product_prop;
use App\Models\Product_decline;
use App\Models\Department_sub_sub;
use App\Models\Products_vendor;
use App\Models\Status; 
use App\Models\Products_request;
use App\Models\Products_request_sub;   
use App\Models\Leave_leader;
use App\Models\Leave_leader_sub;
use App\Models\Book_type;
use App\Models\Book_import_fam;
use App\Models\Book_signature;
use App\Models\Bookrep;
use App\Models\Book_objective; 
use Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http; 
use SoapClient;
use Arr; 
use App\Imports\ImportAcc_stm_ti;
use App\Imports\ImportAcc_stm_tiexcel_import;
use App\Imports\ImportAcc_stm_ofcexcel_import;
use App\Imports\ImportAcc_stm_lgoexcel_import;
use App\Models\D_ofc_repexcel;
use App\Models\D_ofc_rep;
use SplFileObject;
use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory; 
use ZipArchive;  
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\If_;
use Stevebauman\Location\Facades\Location; 
use Illuminate\Filesystem\Filesystem;

use Mail;
use Illuminate\Support\Facades\Storage;
  
 
date_default_timezone_set("Asia/Bangkok");

class ReportNewController extends Controller
{ 
    // public function report_db(Request $request)
    // {
    //     $startdate = $request->startdate;
    //     $enddate = $request->enddate;
    //     $data['users']     = User::get();  
    //     $data['d_claim']   = DB::connection('mysql')->select('
    //         SELECT d.vn,d.hn,d.an,d.cid,d.ptname,d.vstdate,d.pttype,d.sum_price,s.rep_a,s.tranid_c,s.price1_k,s.income_ad,s.pp_gep_ae,s.claim_true_af,s.claim_false_ag,s.cash_money_ah
    //         ,s.pay_ai,s.IPCS_ao,s.IPCS_ORS_ap,s.OPCS_aq,s.PACS_ar,s.INSTCS_as,s.OTCS_at,s.PP_au,s.DRUG_av,s.errorcode_m
    //         FROM d_claim d
    //         LEFT OUTER JOIN d_ofc_rep s ON s.hn_d = d.hn AND s.vstdate_i = d.vstdate
    //         WHERE d.vstdate BETWEEN "'.$startdate.'" and "'.$enddate.'"
    //         ORDER BY s.tranid_c DESC
    //     '); 


    //     return view('report_all.report_db',$data,[
    //         'startdate'     =>     $startdate,
    //         'enddate'       =>     $enddate, 
    //     ]);
    // }

    public function report_hos_01(Request $request)
    {
        $startdate   = $request->startdate;
        $enddate     = $request->enddate;        
        // dd($enddate);
        $hos_01      = DB::connection('mysql2')->select('
                SELECT v.refer_date,a.hn,a.an,CONCAT(p.pname,p.fname," ",p.lname) as ptname,s.name as sexname,h.name as referhos,
                    a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5,DATEDIFF(v.refer_date,ip.regdate) as datereg,TIMEDIFF(v.refer_time,ip.regtime) as timerefer
                    FROM referout v 
                    LEFT OUTER JOIN an_stat a on a.an=v.vn
                    LEFT OUTER JOIN ipt ip on ip.an=a.an
                    LEFT OUTER JOIN patient p on p.hn=a.hn 
                    LEFT OUTER JOIN icd101 i on i.code in (a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5)
                    LEFT OUTER JOIN hospcode h on h.hospcode=v.refer_hospcode
                    LEFT OUTER JOIN sex s on s.code=p.sex
                    WHERE v.refer_date BETWEEN "'. $startdate.'" AND "'. $enddate.'"
                    AND v.department ="IPD"
                    AND DATEDIFF(v.refer_date,ip.regdate) <= "0"
                    AND TIMEDIFF(v.refer_time,ip.regtime) < "06:00:00"
                    AND TIMEDIFF(v.refer_time,ip.regtime) not LIKE "-%"
                    AND h.hospcode not in ("04038","04039","04040","04041","04042","04043","04044","04045","04046","04047","04048","04049",
                    "04051","10970","10971","10972","10973","10974","10975","10976","10977","10979","10980","10981","10982","10983")
                    GROUP BY a.an 
                    ORDER BY v.refer_date 
        ');
 
        return view('report_all.report_hos_01',[
            'startdate'     =>     $startdate,
            'enddate'       =>     $enddate,
            'hos_01'        =>     $hos_01,             
        ]);
    }
    
    
    
 
}
