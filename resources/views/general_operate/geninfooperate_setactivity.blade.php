@extends('layouts.backend')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


@section('content')


<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
    
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
         
      } 

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

  .text-pedding{
   padding-left:10px;
}

.text-font {
    font-size: 13px;
}

      }

      tbody{
    height:200px;
    overflow-y:auto;
    width: 100%;
    }

    .modal-xl {
    width: 90%;
  }

  .css-col{
    width: 10%; 
  }

  span{
    font-size: 16px;  
  }

  @media only screen and (max-width: 768px) {
  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }
  }


.headcol{
  content: 'Row ';
}

      



      
</style>

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


use App\Http\Controllers\OperateController;

        $checkver = OperateController::checkoperate_ver($user_id);
        $checkallow =  OperateController::checkoperate_allow($user_id);


?>
<?php


  function Monththai($strtime)
  {
    if($strtime == '1'){
        $month = 'มกราคม';
    }else if($strtime == '2'){
        $month = 'กุมภาพันธ์';
    }else if($strtime == '3'){
        $month = 'มีนาคม';
    }else if($strtime == '4'){
        $month = 'เมษายน';
    }else if($strtime == '5'){
        $month = 'พฤษภาคม';
    }else if($strtime == '6'){
        $month = 'มิถุนายน';
    }else if($strtime == '7'){
        $month = 'กรกฎาคม';
    }else if($strtime == '8'){
        $month = 'สิงหาคม';
    }else if($strtime == '9'){
        $month = 'กันยายน';
    }else if($strtime == '10'){
        $month = 'ตุลาคม';
    }else if($strtime == '11'){
        $month = 'พฤศจิกายน';
    }else if($strtime == '12'){
        $month = 'ธันวาคม';
    }else{
        $month = '';  
    }

    return $month;
    }

    function Yearthai($strtime)
    {
      $year = $strtime+543;
      return $year;
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
  

$searchmonth_check  = $infooper->OPERATE_INDEX_MONTH; 
$searchyear_check = $infooper->OPERATE_INDEX_YEAR;


?>

           
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div>
                                <a href="{{ url('general_operate/genoperateindex/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#4682B4;color:#F0FFFF;">ตารางเวรปฏิบัติงาน  
                                </a>   
                                </div>           
                                <div>&nbsp;</div>
 
                                <div>
                                <a href="{{ url('general_operate/genoperateindexset/'.$inforpersonuserid -> ID)}}" class="btn btn-warning" >จัดเวร  
                               
                                </a> 
                                </div>
                                <div>&nbsp;</div>

                                @if($checkver > 0)
                                  <div>
                                  <a href="{{ url('general_operate/genoperateindexver/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#00BFFF;color:#F0FFFF;">ตรวจสอบ  
                                  </a>   
                                  </div>           
                                  <div>&nbsp;</div>
                                @endif
                                @if($checkallow > 0)
                                  <div>
                                  <a href="{{ url('general_operate/genoperateindexapp/'.$inforpersonuserid -> ID)}}" class="btn btn-success" >อนุมัติ  
                                  </a> 
                                  </div>
                                  <div>&nbsp;</div>
                                @endif

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
             

                <div class="content">
               
                  
               <div class="col-xl-14">
               <div class="block block-rounded block-bordered">
                   <div class="block-header block-header-default">
                       <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>จัดสรรเวรปฏิบัติงาน {{$infooper->OPERATE_TYPE_NAME}} ประจำเดือน {{Monththai($infooper->OPERATE_INDEX_MONTH)}} {{Yearthai($infooper->OPERATE_INDEX_YEAR)}}  หน่วยงาน {{$infooper->HR_DEPARTMENT_SUB_SUB_NAME}} </B></h3>
                   </div>
                   <div class="table-responsive">    
                       <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                       <form  method="post" action="{{ route('operate.updateactivity') }}" enctype="multipart/form-data">
                        @csrf


                        <input type="hidden" id="OPERATE_INDEX_ID" name="OPERATE_INDEX_ID" value="{{$idactivity}}">
                        <input type="hidden" id="PERSON_ID" name="PERSON_ID" value="{{$inforpersonuserid -> ID}}">
                       
                       <table border="1" style="border-color: #000000;"  width="150%">
                           <thead >
                               <tr>
                                   <th class="text-center" width="1%" style="background-color: #FFFFCC;">ลำดับ</th>
                                   {{-- <th class="text-center" width="1%">จัดเวร</th> --}}
                                   <th class="text-center" width="7%" style="background-color: #FFFFCC;">ชื่อ-นามสกุล</th>
                                   <th class="text-center" width="7%" style="background-color: #FFFFCC;">ตำแหน่ง</th>
                                 
                                   <th class="text-center" width="1%" style="background-color: {{satsun($searchyear_check.'-'.$searchmonth_check.'-01')}};">1</th>
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
                          
                          <td align="center" >{{$number}}</td>
                          {{-- <td align="center" ><a href="#set_modal{{ $infoactivity -> OPERATE_ACTIVITY_ID }}"  data-toggle="modal" class="btn btn-info"><i class=" fa fa-pen-nib"></i></a></td> --}}
                          <td class="text-pedding text-font" class="headcol">{{ $infoactivity->OPERATE_MEMBER_PERSON_NAME }}</td>
                          <td class="text-pedding text-font" class="headcol">{{ $infoactivity->OPERATE_MEMBER_POSITION_NAME }}</td>
                              
                 
                          <td class="text-font" align="center" >
                       
                            <select name="DATE_1[]" id="DATE_1" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)    
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_1)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                                         
                               
                                @endforeach         
                        </select> 


                          </td>
                          <td class="text-font" align="center" >
                            <select name="DATE_2[]" id="DATE_2" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                               @foreach ($operatejobs as $operatejob)                                             
                               @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_2)
                               <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};"  selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                               @else
                               <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" >{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                               @endif                         
                               @endforeach        
                       </select> 
                        
                        
                           </td>  
                          <td class="text-font" align="center" >
                            <select name="DATE_3[]" id="DATE_3" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_3)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                         
                                @endforeach           
                        </select> 
                        
                          </td>  
                          <td class="text-font" align="center" >
                            <select name="DATE_4[]" id="DATE_4" class="input-lg" style="font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_4)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach        
                        </select>     
                        
                          </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_5[]" id="DATE_5" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_5)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                         
                                @endforeach           
                        </select> 
                        
                           </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_6[]" id="DATE_6" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_6)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                         
                                @endforeach         
                        </select> 
                        
                        
                          </td> 
                          <td class="text-font" align="center" >
                              
                            <select name="DATE_7[]" id="DATE_7" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_7)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach      
                            </select> 
                          
                          </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_8[]" id="DATE_8" class="input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_8)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                          
                                @endforeach          
                        </select> 
                      
                        
                          </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_9[]" id="DATE_9" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_9)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                          
                                @endforeach         
                        </select> 
                      
                          </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_10[]" id="DATE_10" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                               @foreach ($operatejobs as $operatejob)                                             
                               @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_10)
                               <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                               @else
                               <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                               @endif                           
                               @endforeach            
                            </select>  
                        
                          </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_11[]" id="DATE_11" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_11)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                         
                                @endforeach         
                        </select> 


                          </td>
                          <td class="text-font" align="center" >
                            <select name="DATE_12[]" id="DATE_12" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_12)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach           
                        </select>   
                          </td>  
                          <td class="text-font" align="center" >
                            
                            <select name="DATE_13[]" id="DATE_13" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_13)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach      
                            </select> 

                          </td>  
                          <td class="text-font" align="center" >
                             
                            <select name="DATE_14[]" id="DATE_14" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_14)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach         
                            </select>  
                          
                          </td> 
                          <td class="text-font" align="center" >
 
                                <select name="DATE_15[]" id="DATE_15" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">-</option> 
                                    @foreach ($operatejobs as $operatejob)                                             
                                    @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_15)
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @else
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @endif                           
                                    @endforeach           
                            </select> 
                               
                          </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_16[]" id="DATE_16" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_16)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach           
                        </select> 
                          
                         </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_17[]" id="DATE_17" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_17)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach            
                        </select> 
                          </td> 
                          <td class="text-font" align="center" >
                              
                                <select name="DATE_18[]" id="DATE_18" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">-</option> 
                                    @foreach ($operatejobs as $operatejob)                                             
                                    @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_18)
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @else
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @endif                           
                                    @endforeach           
                            </select> 

                        
                          </td> 
                          <td class="text-font" align="center" >
                                                    
                            <select name="DATE_19[]" id="DATE_19" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_19)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach       
                        </select> 
                          
                          </td> 
                          <td class="text-font" align="center" >
                              
                                <select name="DATE_20[]" id="DATE_20" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">-</option> 
                                    @foreach ($operatejobs as $operatejob)                                             
                                    @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_20)
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @else
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @endif                           
                                    @endforeach     
                            </select> 

                            
                          </td> 
                          <td class="text-font" align="center" >

                            <select name="DATE_21[]" id="DATE_21" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_21)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                          
                                @endforeach          
                            </select>     

                          </td>
                          <td class="text-font" align="center" >
                            <select name="DATE_22[]" id="DATE_22" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_22)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach        
                        </select> 
                      
                        
                          </td>  
                          <td class="text-font" align="center" >
                            <select name="DATE_23[]" id="DATE_23" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_23)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach        
                        </select> 
                        
                          </td>  
                          <td class="text-font" align="center" >
                            <select name="DATE_24[]" id="DATE_24" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_24)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach      
                        </select> 
                        
                          
                          </td> 
                          <td class="text-font" align="center" >
                              
                                    <select name="DATE_25[]" id="DATE_25" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                        <option value="">-</option> 
                                        @foreach ($operatejobs as $operatejob)                                             
                                        @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_25)
                                        <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                        @else
                                        <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                        @endif                           
                                        @endforeach      
                                </select> 
                        
                          </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_26[]" id="DATE_26" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_26)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach          
                        </select> 
                        
                           </td> 
                          <td class="text-font" align="center" >
                              
                                <select name="DATE_27[]" id="DATE_27" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">-</option> 
                                    @foreach ($operatejobs as $operatejob)                                             
                                    @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_27)
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @else
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @endif                           
                                    @endforeach        
                            </select> 
                        
                           </td> 
                          <td class="text-font" align="center" >
                              
                                <select name="DATE_28[]" id="DATE_28" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">-</option> 
                                    @foreach ($operatejobs as $operatejob)                                             
                                    @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_28)
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @else
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @endif                           
                                    @endforeach           
                            </select> 
                          
                         </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_29[]" id="DATE_29" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_29)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach            
                        </select> 
                        
                          </td> 
                          <td class="text-font" align="center" >
                            <select name="DATE_30[]" id="DATE_30" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">-</option> 
                                @foreach ($operatejobs as $operatejob)                                             
                                @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_30)
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @else
                                <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                @endif                           
                                @endforeach          
                        </select> 

                          </td>
                          <td class="text-font" align="center" >
                            
                                <select name="DATE_31[]" id="DATE_31" class="input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">-</option> 
                                    @foreach ($operatejobs as $operatejob)                                             
                                    @if($operatejob->OPERATE_JOB_ID == $infoactivity->DATE_31)
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};" selected>{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @else
                                    <option value="{{ $operatejob->OPERATE_JOB_ID  }}" style="background-color:{{ $operatejob->OPERATE_JOB_COLOR  }};">{{ $operatejob->OPERATE_JOB_NAME }}</option>  
                                    @endif                           
                                    @endforeach     
                            </select> 
                          </td>
                       
                

                          </tr>

                       

    
        <input type="hidden" id="OPERATE_MEMBER_PERSON_ID" name="OPERATE_MEMBER_PERSON_ID[]" value="{{ $infoactivity->OPERATE_MEMBER_PERSON_ID }}">


                         
                          @endforeach      
                           </tbody>
                       </table>
                 
                       <br>

                        @foreach ($operatejobs as $operatejob)
                        <b style="font-size: 13px;"> &nbsp;&nbsp;&nbsp; {{$operatejob->OPERATE_JOB_NAME}} :: {{$operatejob->OPERATE_JOB_DETAIL}}</b><br>
                        @endforeach

                       <!-- END  -->
                   </div>

<div class="modal-footer">
    <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="{{ url('general_operate/genoperateindexset/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการบันทึกข้อมูล ?')" >ยกเลิก</a>
    </div>
    </div>
    </form>  
                
                 
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
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection