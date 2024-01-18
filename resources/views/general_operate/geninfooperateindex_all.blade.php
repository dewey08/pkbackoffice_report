@extends('layouts.backend')

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}

 .text-pedding{
   padding-left:10px;
}


.text-font {
    font-size: 14px;
}
</style>

@section('content')
<script>
    function checklogin(){
     window.location.href = '{{route("index")}}';
    }
    </script>
<?php
if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
}else{
    echo "<body onload=\"checklogin()\"></body>";
    exit();
}
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos);






$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}

use App\Http\Controllers\OperateController;

        $checkver = OperateController::checkoperate_ver($user_id);
        $checkallow =  OperateController::checkoperate_allow($user_id);

?>
<?php



  function DateThaihead($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));


  $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strMonthThai $strYear";
  }


  function satsun($date)
{
  $DayOfWeek = date("w", strtotime($date));


   if($DayOfWeek  == 0 || $DayOfWeek  == 6){
        $resultcoller = '#FF9999';
   }else{
        $resultcoller = '#99FFFF'; 
   }

  return $resultcoller;

}

?>


                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                         
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">

               

                </div>
                    
                    <div class="col-xl-14">
                    <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>เวรปฏิบัติงาน หน่วยงาน {{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}  ประจำเดือน {{DateThaihead($year.'-'.$month.'-01')}}</B></B></h3>
                        </div>
                        <div class="table-responsive">
                          
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table border="1" style="border-color: #000000;"  width="100%">
                                <thead >
                                    <tr>
                                        <th class="text-center" width="1%" style="background-color: #FFFFCC;">ลำดับ</th>
                                        <th class="text-center" width="7%" style="background-color: #FFFFCC;">ชื่อ-นามสกุล</th>
                                        <th class="text-center" width="5%" style="background-color: #FFFFCC;">ตำแหน่ง</th>

                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-01')}};" >1 </th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-02')}};">2</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-03')}};">3</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-04')}};">4</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-05')}};">5</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-06')}};">6</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-07')}};">7</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-08')}};">8</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-09')}};">9</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-10')}};">10</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-11')}};">11</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-12')}};">12</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-13')}};">13</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-14')}};">14</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-15')}};">15</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-16')}};">16</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-17')}};">17</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-18')}};">18</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-19')}};">19</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-20')}};">20</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-21')}};">21</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-22')}};">22</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-23')}};">23</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-24')}};">24</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-25')}};">25</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-26')}};">26</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-27')}};">27</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-28')}};">28</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-29')}};">29</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-30')}};">30</th>
                                        <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-31')}};">31</th>





                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                use Illuminate\Http\Request;
                                use Illuminate\Support\Facades\DB;
                                $number = 0; ?>
                                @foreach ($infoactivitys as $infoactivity)
                                <?php $number++;  ?>
                                <tr>

                               <td align="center"   rowspan="{{ $operateindex2_count}}" >{{$number}}</td>
                               <td class="text-pedding text-font"  rowspan="{{ $operateindex2_count}}">{{ $infoactivity->OPERATE_MEMBER_PERSON_NAME }}</td>
                               <td class="text-pedding text-font"  rowspan="{{ $operateindex2_count}}">{{ $infoactivity->OPERATE_MEMBER_POSITION_NAME }}</td>


                               @foreach ($operateindex2s as $operateindex2)

                                   <?php

                        $infoactivity2 =  DB::table('operate_activity')
                            ->where('OPERATE_ACTIVITY_PERSON_ID','=',$infoactivity->OPERATE_MEMBER_PERSON_ID)
                            ->where('OPERATE_ACTIVITY_INDEX_ID','=',$operateindex2->OPERATE_INDEX_ID)
                            ->first();

                                   ?>

                                        @foreach ($operatejobs as $operatejob)
                                            <?php
                                        

                                                if($infoactivity2->DATE_1 == $operatejob->OPERATE_JOB_ID){
                                                    $DATE_1 = $operatejob->OPERATE_JOB_NAME;
                                                    $color_1 = $operatejob->OPERATE_JOB_COLOR;
                                                    break;
                                                }else{
                                                    $DATE_1='';
                                                    $color_1 ='';
                                                }
                                            ?>
                                        @endforeach


                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_2 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_2 = $operatejob->OPERATE_JOB_NAME;
                                            $color_2 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_2='';
                                            $color_2 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_3 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_3 = $operatejob->OPERATE_JOB_NAME;
                                            $color_3 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_3='';
                                            $color_3 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_4 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_4 = $operatejob->OPERATE_JOB_NAME;
                                            $color_4 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_4='';
                                            $color_4 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_5 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_5 = $operatejob->OPERATE_JOB_NAME;
                                            $color_5 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_5='';
                                            $color_5 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_6 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_6 = $operatejob->OPERATE_JOB_NAME;
                                            $color_6 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_6='';
                                            $color_6 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_7 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_7 = $operatejob->OPERATE_JOB_NAME;
                                            $color_7 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_7='';
                                            $color_7 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_8 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_8 = $operatejob->OPERATE_JOB_NAME;
                                            $color_8 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_8='';
                                            $color_8 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_9 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_9 = $operatejob->OPERATE_JOB_NAME;
                                            $color_9 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_9='';
                                            $color_9 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_10 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_10 = $operatejob->OPERATE_JOB_NAME;
                                            $color_10 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_10='';
                                            $color_10 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_11 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_11 = $operatejob->OPERATE_JOB_NAME;
                                            $color_11 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_11='';
                                            $color_11 = '';
                                        }

                                   ?>
                               @endforeach

                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_12 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_12 = $operatejob->OPERATE_JOB_NAME;
                                            $color_12 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_12='';
                                            $color_12 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_13 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_13 = $operatejob->OPERATE_JOB_NAME;
                                            $color_13 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_13='';
                                            $color_13 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_14 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_14 = $operatejob->OPERATE_JOB_NAME;
                                            $color_14 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_14='';
                                            $color_14 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_15 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_15 = $operatejob->OPERATE_JOB_NAME;
                                            $color_15 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_15='';
                                            $color_15 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_16 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_16 = $operatejob->OPERATE_JOB_NAME;
                                            $color_16 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_16='';
                                            $color_16 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_17 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_17 = $operatejob->OPERATE_JOB_NAME;
                                            $color_17 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_17='';
                                            $color_17 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_18 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_18 = $operatejob->OPERATE_JOB_NAME;
                                            $color_18 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_18='';
                                            $color_18 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_19 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_19 = $operatejob->OPERATE_JOB_NAME;
                                            $color_19 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_19='';
                                            $color_19 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_20 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_20 = $operatejob->OPERATE_JOB_NAME;
                                            $color_20 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_20='';
                                            $color_20 = '';
                                        }

                                   ?>
                               @endforeach

                                 <!------------------------------------------------------>
                                 @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_21 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_21 = $operatejob->OPERATE_JOB_NAME;
                                            $color_21 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_21='';
                                            $color_21 = '';
                                        }

                                   ?>
                               @endforeach

                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_22 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_22 = $operatejob->OPERATE_JOB_NAME;
                                            $color_22 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_22='';
                                            $color_22 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_23 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_23 = $operatejob->OPERATE_JOB_NAME;
                                            $color_23 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_23='';
                                            $color_23 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_24 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_24 = $operatejob->OPERATE_JOB_NAME;
                                            $color_24 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_24='';
                                            $color_24 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_25 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_25 = $operatejob->OPERATE_JOB_NAME;
                                            $color_25 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_25='';
                                            $color_25 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_26 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_26 = $operatejob->OPERATE_JOB_NAME;
                                            $color_26 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_26='';
                                            $color_26 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_27 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_27 = $operatejob->OPERATE_JOB_NAME;
                                            $color_27 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_27='';
                                            $color_27 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_28 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_28 = $operatejob->OPERATE_JOB_NAME;
                                            $color_28 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_28='';
                                            $color_28 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_29 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_29 = $operatejob->OPERATE_JOB_NAME;
                                            $color_29 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_29='';
                                            $color_29 = '';
                                        }

                                   ?>
                               @endforeach
                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_30 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_30 = $operatejob->OPERATE_JOB_NAME;
                                            $color_30 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_30='';
                                            $color_30 = '';
                                        }

                                   ?>
                               @endforeach

                                <!------------------------------------------------------>
                                @foreach ($operatejobs as $operatejob)
                                     <?php
                                        if($infoactivity2->DATE_31 == $operatejob->OPERATE_JOB_ID){
                                            $DATE_31 = $operatejob->OPERATE_JOB_NAME;
                                            $color_31 = $operatejob->OPERATE_JOB_COLOR;
                                            break;
                                         }else{
                                            $DATE_31='';
                                            $color_31 = '';
                                        }

                                   ?>
                               @endforeach



                               <td class="text-font" align="center" bgcolor="{{ $color_1 }}">{{$DATE_1}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_2 }}">{{$DATE_2}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_3 }}">{{$DATE_3}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_4 }}">{{$DATE_4}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_5 }}">{{$DATE_5}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_6 }}">{{$DATE_6}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_7 }}">{{$DATE_7}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_8 }}">{{$DATE_8}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_9 }}">{{$DATE_9}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_10 }}">{{$DATE_10}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_11 }}">{{$DATE_11}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_12 }}">{{$DATE_12}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_13 }}">{{$DATE_13}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_14 }}">{{$DATE_14}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_15 }}">{{$DATE_15}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_16 }}">{{$DATE_16}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_17 }}">{{$DATE_17}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_18 }}">{{$DATE_18}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_19 }}">{{$DATE_19}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_20 }}">{{$DATE_20}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_21 }}">{{$DATE_21}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_22 }}">{{$DATE_22}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_23 }}">{{$DATE_23}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_24 }}">{{$DATE_24}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_25 }}">{{$DATE_25}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_26 }}">{{$DATE_26}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_27 }}">{{$DATE_27}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_28 }}">{{$DATE_28}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_29 }}">{{$DATE_29}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_30 }}">{{$DATE_30}}</td>
                               <td class="text-font" align="center" bgcolor="{{ $color_31 }}">{{$DATE_31}}</td>
                              

                               </tr>
                               @endforeach

                               @endforeach
                                </tbody>
                            </table>
                            <br>
                            <?php $number = 1; $count=2;?>
                            @foreach ($operatejobs as $operatejob)

                            @if($number%3 == 0)
                            
                            <div class="col-lg-4"><b style="font-size: 13px;">&nbsp;&nbsp;{{$operatejob->OPERATE_JOB_NAME}} :: {{$operatejob->OPERATE_JOB_DETAIL}}</b></div> </div>
                            @else
                                @if($count%3 ==0)
                                <div class="col-lg-4"><b style="font-size: 13px;">&nbsp;&nbsp;{{$operatejob->OPERATE_JOB_NAME}} :: {{$operatejob->OPERATE_JOB_DETAIL}}</b></div>
                                @else
                                <div class="row">
                                <div class="col-lg-4"><b style="font-size: 13px;">&nbsp;&nbsp;{{$operatejob->OPERATE_JOB_NAME}} :: {{$operatejob->OPERATE_JOB_DETAIL}}</b></div>
                                @endif
                            @endif
                          
                            
                          
                            <?php $number++;$count++; ?>
                            @endforeach
                            
                           
                            <!-- END  -->
                        </div>
                        <br>
</div>









@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



 <!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>


 <!-- Page JS Plugins -->
 <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>


<script>
   $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });



    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection
