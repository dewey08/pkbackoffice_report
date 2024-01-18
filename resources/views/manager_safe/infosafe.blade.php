@extends('layouts.safe')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



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
?>
<?php

    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');
?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;           
            }
        .text-pedding{
            padding-left:10px;
            }
        .text-font {
            font-size: 13px;
            }   
      
            .form-control {
            font-size: 13px;
            }   

            table, td, th {
            border: 1px solid black;
            } 

</style>

<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
    <div class="block-header block-header-default" >
        <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดเหตุการณ์</B></h3>
            <a  href="#addsafe_modal"  data-toggle="modal"  class="btn btn-info" style=" font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มเหตุการณ์</a>
        </div>
    <div class="block-content block-content-full">
        <form method="post">
            @csrf
            <div class="row">
            <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
                            </span>
                        </div>

            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
                    </div>
                    </div>

                </div>
                <div class="col-sm-0.5">
                    &nbsp;สถานะ &nbsp;
                </div>
                <div class="col-sm-2">
                    <span>
                        <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--เลือกประเภทการรายงาน--</option>                         
                                @foreach ($typenameT as $typename)
                               
                                    @if($typename-> SAFE_TYPE_ID == $status_check)
                                        <option value="{{ $typename->SAFE_TYPE_ID  }}" selected>{{ $typename->SAFE_TYPE_NAME}}</option>
                                    @else
                                        <option value="{{ $typename->SAFE_TYPE_ID  }}">{{ $typename->SAFE_TYPE_NAME}}</option>
                                    @endif                                                             
                                @endforeach 
                        </select>
                    </span>                   
                </div>
                <div class="col-sm-0.5">
                    &nbsp;ค้นหา &nbsp;
                </div>
                <div class="col-sm-2">
                    <span>
                        <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                    </span>
                </div>
                <div class="col-sm-30">
                         &nbsp;
                </div> 
                <div class="col-sm-1">
                    <span>
                         <button type="submit" class="btn btn-info" style=" font-family: 'Kanit', sans-serif;font-weight:normal;" >ค้นหา</button>
                    </span> 
                </div>
            </div>  
        </form>
<div class="table-responsive" style="height:500px;"> 

        <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
            <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="4%">ลำดับ</th>   
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">หัวข้อการรายงาน</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ประเภทการรายงาน</th>
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่พบ</th>
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">เวลาที่พบ</th>                    
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">มูลค่า</th>
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เหตุการณ์</th>
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">บรรยายเหตุการณ์</th>
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">สถานที่เกิดเหตุ</th> 
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="9%">แก้ไขเบื้องต้น</th>
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ผู้บันทึก</th> 
                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">คำสั่ง</th>  
                </tr >
            </thead>
            <tbody>


                    <?php $number = 0;  ?>
                    @foreach ($safe as $safeservice)
                    <?php $number++; ?>
                <tr height="20">
                    <td class="text-font" align="center"> {{$number}}</td>                        
                    <td class="text-font text-pedding">{{ $safeservice->SAFE_ITEM }}</td>
                    <td class="text-font text-pedding">{{ $safeservice->SAFE_TYPE_NAME }}</td> 
                    <td class="text-font text-pedding">{{ DateThai($safeservice->SAFE_DATE) }}</td>                     
                    <td class="text-font text-pedding">{{ $safeservice->SAFE_TIME }}</td> 
                    <td class="text-font text-pedding">{{ $safeservice->SAFE_DAMAGE }}</td> 
                    <td class="text-font text-pedding">{{ $safeservice->SAFE_EVENT_NAME }}</td> 
                    <td class="text-font text-pedding">{{ $safeservice->SAFE_COMMENT }}</td> 
                    <td class="text-font text-pedding">{{ $safeservice->SAFE_LOCATION_NAME }}</td> 
                    <td class="text-font text-pedding">{{ $safeservice->SAFE_MODIFY }}</td> 
                    <td class="text-font text-pedding">{{ $safeservice->HR_FNAME }}</td> 
                    <td class="text-font" align="center" >
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                ทำรายการ
                            </button>
                            <div class="dropdown-menu" style="width:5px">
                                <a class="dropdown-item" href="#editsafe_modal{{ $safeservice -> SAFE_ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a> 
                                <a class="dropdown-item" href="{{ url('manager_safe/infosafe/destroy/'.$safeservice -> SAFE_ID )  }}"  onclick="return confirm('ต้องการที่จะลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a> 
                            </div>
                        </div>
                    </td>  
                </tr> 
                <div id="editsafe_modal{{ $safeservice-> SAFE_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="editsafe_modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">           
                                        <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลเหตุการณ์ ลำดับที่ {{ $safeservice -> SAFE_ID }}&nbsp;&nbsp;</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                <form  method="post" action="{{ route('msafe.update') }}" >                                       
                                    @csrf
                                        <body> 
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label >ประเภทการรายงาน</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                            <select name="SAFE_TYPE_ID" id="SAFE_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                                                    <option value="">--เลือกประเภทการรายงาน--</option>
                                                                    @foreach ($typenameT as $typenamerow)  
                                                                   @if($safeservice -> SAFE_TYPE_ID == $typenamerow-> SAFE_TYPE_ID )                                                   
                                                                        <option value="{{ $typenamerow -> SAFE_TYPE_ID  }}"selected>{{ $typenamerow-> SAFE_TYPE_NAME}}</option>
                                                                    @else 
                                                                         <option value="{{ $typenamerow -> SAFE_TYPE_ID  }}">{{ $typenamerow-> SAFE_TYPE_NAME}}</option>
                                                                    @endif
                                                                         @endforeach 
                                                            </select> 
                                                    </div>                        
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label >หัวข้อการรายงาน</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <input  name="SAFE_ITEM"  id="SAFE_ITEM " class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"value="{{ $safeservice->SAFE_ITEM }}" required>
                                                    </div>
                                                </div>
                                            </div>                                       
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label > วันที่พบ </label>
                                                    </div>
                                                    <div class="col-sm-2">        
                                                        <input  name = "SAFE_DATE"  id="SAFE_DATE"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 14px;"  value="{{ formate($safeservice->SAFE_DATE) }}" readonly required>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <label > เวลาที่พบ </label>
                                                    </div>
                                                    <div class="col-sm-2">        
                                                        <input  name = "SAFE_TIME"  id="SAFE_TIME " class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;" value="{{ $safeservice->SAFE_TIME }}" required> 
                                                    </div>
                                                    <div class="col-sm-2"> 
                                                        <label >มูลค่าความเสียหาย</label>
                                                    </div>
                                                    <div class="col-sm-3 text-left">
                                                        <input  name="SAFE_DAMAGE"  id="SAFE_DAMAGE" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;font-size: 14px;" value="{{ $safeservice->SAFE_DAMAGE }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label >เหตุการณ์</label>
                                                        </div>
                                                    <div class="col-sm-10">                                                                                                                  
                                                            <select name="SAFE_EVENT_ID" id="SAFE_EVENT_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                                                    <option value="">--เลือกเหตุการณ์--</option>
                                                                    @foreach ($safeevent as $safeeventrow)  
                                                                   @if($safeservice -> SAFE_EVENT_ID == $safeeventrow-> SAFE_EVENT_ID )                                                   
                                                                        <option value="{{ $safeeventrow -> SAFE_EVENT_ID  }}"selected>{{ $safeeventrow-> SAFE_EVENT_NAME}}</option>
                                                                    @else 
                                                                         <option value="{{ $safeeventrow -> SAFE_EVENT_ID  }}">{{ $safeeventrow-> SAFE_EVENT_NAME}}</option>
                                                                    @endif
                                                                         @endforeach 
                                                            </select>                                                       
                                                    </div>                            
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label for="SAFE_COMMENT"> บรรยายเหตุการณ์</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                    <textarea class="form-control" id="SAFE_COMMENT"  name="SAFE_COMMENT" rows="3" style=" font-family: 'Kanit', sans-serif;" required>{{$safeservice->SAFE_COMMENT}} </textarea>
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label >สถานที่เกิดเหตุ</label>
                                                        </div>
                                                    <div class="col-sm-10">                                                        
                                                        <select name="SAFE_LOCATION_ID" id="SAFE_LOCATION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                                                <option value="">--เลือกสถานที่เกิดเหตุ--</option>
                                                                @foreach ($safelocation as $safelocationrow)  
                                                               @if($safeservice -> SAFE_LOCATION_ID == $safelocationrow-> SAFE_LOCATION_ID )                                                   
                                                                    <option value="{{ $safelocationrow -> SAFE_LOCATION_ID  }}"selected>{{ $safelocationrow-> SAFE_LOCATION_NAME}}</option>
                                                                @else 
                                                                     <option value="{{ $safelocationrow -> SAFE_LOCATION_ID  }}">{{ $safelocationrow-> SAFE_LOCATION_NAME}}</option>
                                                                @endif
                                                                     @endforeach 
                                                        </select> 
                                                    </div>                            
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label for="SAFE_MODIFY">แก้ไขเบื้องต้น</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" id="SAFE_MODIFY" name="SAFE_MODIFY" rows="3" style=" font-family: 'Kanit', sans-serif;" required>{{$safeservice->SAFE_MODIFY}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>    
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label >ผู้บันทึก</label>
                                                    </div>
                                                <div class="col-sm-4">                                                    
                                                {{$safeservice->HR_FNAME}}   {{$safeservice->HR_LNAME}}  
                                                </div>
                                                <div class="col-sm-2"> 
                                                        <label >วันที่บันทึก</label>
                                                    </div>
                                                <div class="col-sm-2">                                                                
                                                    <input  name = "RECORD_DATE"  id="RECORD_DATE"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 14px;"  value="{{ formate($safeservice->RECORD_DATE) }}" readonly required>
                                                           
                                                </div>
                                                <div class="col-sm-2"> 
                                                </div>  
                                                <input value="{{$safeservice->SAFE_ID}}" type="hidden" name = "SAFE_ID"  id="SAFE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>       
                                        </div>

                                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label >โทร</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input  name="RECORD_HR_TEL"  id="RECORD_HR_TEL" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;font-size: 14px;"value="{{$safeservice->RECORD_HR_TEL}}" required>
                                                    </div>
                                                </div>
                                            </div>       



                                    </div>                    
                                    <div class="modal-footer">
                                        <div align="right">
                                            <button type="submit"  class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif;"><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</button>
                                            <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</button>
                                        
                                        
                                        </div>
                                    </div>              
                                        </body>
                                </form>
                                  </div>
                                </div>
                </div>                    
            @endforeach   
            </tbody>
        </table>
    </div>
</div>
</div>

</div>

                <div id="addsafe_modal" class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="addsafe_modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">           
                                <div class="row">
                                    <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลเหตุการณ์&nbsp;&nbsp;</h3></div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                        <body>
                                    <form  method="post" action="{{ route('msafe.save') }}" >
                                        @csrf
                                        
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label >ประเภทการรายงาน</label>
                                                    </div>
                                                    <div class="col-sm-10"> 
                                                            
                                                        <select name="SAFE_TYPE_ID" id="SAFE_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                                                <option value="">--เลือกประเภทการรายงาน--</option>
                                                                @foreach ($typenameT as $typename)                                                     
                                                                    <option value="{{ $typename ->SAFE_TYPE_ID  }}">{{ $typename->SAFE_TYPE_NAME}}</option>
                                                                @endforeach 
                                                        </select>
                                                    </div>                        
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label >หัวข้อการรายงาน</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <input  name="SAFE_ITEM"  id="SAFE_ITEM" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;font-size: 14px;" required>
                                                    </div>
                                                </div>
                                            </div>                                       
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label > วันที่พบ </label>
                                                    </div>
                                                    <div class="col-sm-2">        
                                                        <input  name = "SAFE_DATE"  id="SAFE_DATE"  class="form-control input-lg datepicker " data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 14px;"  value="{{ formate($date) }}" readonly required>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <label > เวลาที่พบ </label>
                                                    </div>
                                                    <div class="col-sm-2">        
                                                        <input  name = "SAFE_TIME"  id="SAFE_TIME" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;"  required> 
                                                    </div>
                                                    <div class="col-sm-2"> 
                                                        <label >มูลค่าความเสียหาย</label>
                                                    </div>
                                                    <div class="col-sm-3 text-left">
                                                        <input  name="SAFE_DAMAGE"  id="SAFE_DAMAGE" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;font-size: 14px;" OnKeyPress="return chkNumber(this)" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label >เหตุการณ์</label>
                                                        </div>
                                                    <div class="col-sm-10">
                                                          
                                                        <select name="SAFE_EVENT_ID" id="SAFE_EVENT_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                                            <option value="">--เลือกเหตุการณ์--</option>
                                                            @foreach ($safeevent as $safeevent)                                                     
                                                                    <option value="{{ $safeevent ->SAFE_EVENT_ID }}">{{ $safeevent->SAFE_EVENT_NAME}}</option>
                                                                @endforeach 
                                                        </select>
                                                    </div>                            
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label for="SAFE_COMMENT"> บรรยายเหตุการณ์</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="SAFE_COMMENT" name="SAFE_COMMENT" rows="3" style=" font-family: 'Kanit', sans-serif;" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <label >สถานที่เกิดเหตุ</label>
                                                        </div>
                                                    <div class="col-sm-10">
                                                            
                                                        <select name="SAFE_LOCATION_ID" id="SAFE_LOCATION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                                            <option value="">--เลือกสถานที่เกิดเหตุ--</option>
                                                            @foreach ($safelocation as $safelocation)                                                     
                                                                    <option value="{{ $safelocation ->SAFE_LOCATION_ID  }}">{{ $safelocation->SAFE_LOCATION_NAME}}</option>
                                                                @endforeach 
                                                        </select>
                                                    </div>                            
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label for="SAFE_COMMENT">แก้ไขเบื้องต้น</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="SAFE_MODIFY" name="SAFE_MODIFY" rows="3" style=" font-family: 'Kanit', sans-serif;" required></textarea>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label >ผู้บันทึก</label>
                                                    </div>
                                                <div class="col-sm-4">                                   
                                                        {{ $personuser ->HR_FNAME }} {{ $personuser ->HR_LNAME }} 
                                                        <input value="{{$id_user}}" type="hidden" name = "RECORD_HR_ID"  id="RECORD_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>                                                                 
                                                
                                                </div>
                                                <div class="col-sm-2"> 
                                                    <label >วันที่บันทึก</label>
                                                </div>
                                                <div class="col-sm-4">        
                                                    <input  name = "RECORD_DATE"  id="RECORD_DATE"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 14px;"  value="{{ formate($date) }}" readonly required>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                            <label >โทร</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                            <input  name="RECORD_HR_TEL"  id="RECORD_HR_TEL" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;font-size: 14px;" value="{{ $personuser ->HR_PHONE }}" required>
                                                    </div>
                                                </div>
                                        </div>       
                                </div>            
                                <div class="modal-footer">
                                    <div align="right">
                                        <button type="submit"  class="btn btn-hero-sm btn-hero-info " style="font-family: 'Kanit', sans-serif;"><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</button>
                                        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;" ><i class="fas fa-window-close" ></i> &nbsp;ยกเลิก</button>
                                    </div>
                                </div>              
                            
                        </form>
                    </body>
                        </div>
                    </div>
                </div>
@endsection

@section('footer')


<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>
<script>jQuery(function(){ Dashmix.helpers(['table-tools-checkable', 'table-tools-sections']); });</script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

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
function chkNumber(ele){
    var vchar = String.fromCharCode(event.keyCode);
    if ((vchar<'0' || vchar>'9')) return false;
    ele.onKeyPress=vchar;
    }
    datepick();
   function datepick() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                todayHighlight: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    };

    $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });
    // If absolute URL from the remote server is provided, configure the CORS
// header on that server.
var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';

// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 0.8,
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport({scale: scale});
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  document.getElementById('page_num').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
document.getElementById('prev').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}
document.getElementById('next').addEventListener('click', onNextPage);

/**
 * Asynchronously downloads PDF.
 */
pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;
  document.getElementById('page_count').textContent = pdfDoc.numPages;

  // Initial/first page rendering
  renderPage(pageNum);
});


//--------------------------------



    // If absolute URL from the remote server is provided, configure the CORS
// header on that server.
var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';

// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 0.8,
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport({scale: scale});
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  document.getElementById('page_num2').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
document.getElementById('prev2').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}
document.getElementById('next2').addEventListener('click', onNextPage);

/**
 * Asynchronously downloads PDF.
 */
pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;
  document.getElementById('page_count2').textContent = pdfDoc.numPages;

  // Initial/first page rendering
  renderPage(pageNum);
});

</script>
<script>
    //////กดปุ่ม Enter
    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});

</script>
@endsection