@extends('layouts.car')
    

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 


?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }
</style>

<body onload="run01();">
<center>    
     <div class="block" style="width: 95%;">
              
                <div class="block block-rounded block-bordered">

            
                <div class="block-content" align="left">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">จัดสรรการใช้รถยนต์ทั่วไป
                
            
                @if($infonomalapp->STATUS == 'REGROUP')
                   >> เดินทางร่วมกับรายการ  {{$detailregroup}}
                @endif
                
                </h2> 
                        
        <form  method="post" action="{{ route('mcar.updateinfonomalapp') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="RESERVE_ID" id="RESERVE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infonomalapp->RESERVE_ID}}">
     <div class="row push">
        <div class="col-sm-2">
        <label>ตามหนังสือ :</label>
        </div> 
        <div class="col-lg-10">
        <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infonomalapp->BOOK_NAME}}">
        </div> 
     
        </div>
       
        <div class="row push">
        <div class="col-sm-2">
        <label>เลขที่หนังสือ :</label>
        </div> 
        <div class="col-lg-3">
        <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infonomalapp->BOOK_NUM}}">
        </div> 
        <div class="col-sm-1">
        <label>ลงวันที่ :</label>
       
        </div>
        <div class="col-lg-2">
        @if($infonomalapp->BOOK_DATE_REG == '' || $infonomalapp->BOOK_DATE_REG == null )
        <input name="" id="" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;"  readonly>
        @else
        <input name="" id="" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;"  value="{{formate($infonomalapp->BOOK_DATE_REG)}}" readonly>
        @endif
       
        </div> 
        <div class="col-sm-2">
        <label>ความเร่งด่วน :</label>
        </div> 
        <div class="col-lg-2">
        <select name="PRIORITY_ID" id="PRIORITY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
            <option value="">--กรุณาเลือก--</option>
             @foreach ($prioritys as $priority)

             @if($infonomalapp->PRIORITY_ID == $priority ->PRIORITY_ID)
             <option value="{{ $priority ->PRIORITY_ID  }}" selected>{{ $priority->PRIORITY_NAME}}</option>
             @else
             <option value="{{ $priority ->PRIORITY_ID  }}">{{ $priority->PRIORITY_NAME}}</option>
             @endif                                                     
           
            @endforeach 
             </select>    
        </div> 
       </div>


       <div class="row push ">
     
       
        <div class="col-sm-2">
        <label>รถโรงพยาบาลทะเบียน :</label>
        </div> 
        <div class="col-lg-2">
        <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infonomalapp->CAR_REG}}" readonly>
        </div> 
    
        <div class="col-sm-1">
        <label>รายละเอียด :</label>
        </div> 
        <div class="col-lg-3">
        <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"   value="{{$infonomalapp->CAR_DETAIL}}" readonly>
        </div> 
        <div class="col-sm-2">
        <label>รถยนต์ส่วนตัวทะเบียน :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_OWNER" id="CAR_OWNER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infonomalapp->CAR_OWNER}}" >
        </div> 

      
        </div> 

      
        


       <div class="row push">
        <div class="col-sm-2">
        <label>เหตุผลขอใช้รถ :</label>
        </div> 
        <div class="col-lg-10">
        <input name="RESERVE_NAME" id="RESERVE_NAME" class="form-control input-sm"   value="{{$infonomalapp->RESERVE_NAME}}">
        </div> 
     
        </div>
        
        <div class="row push">
        <div class="col-sm-2">
        <label>สถานที่ไป :</label>
        </div> 
        <div class="col-lg-4">
        <select name="RESERVE_LOCATION_ID" id="RESERVE_LOCATION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
            <option value="">--กรุณาเลือกสถานที่ไป--</option>
             @foreach ($locations as $location) 

              @if($infonomalapp->RESERVE_LOCATION_ID == $location ->LOCATION_ID )
              <option value="{{ $location ->LOCATION_ID  }}" selected>{{ $location->LOCATION_ORG_NAME}}</option>
              @else
              <option value="{{ $location ->LOCATION_ID  }}">{{ $location->LOCATION_ORG_NAME}}</option>
              @endif                                                    
           
            @endforeach 
             </select>    
        </div> 
        <div class="col-sm-2">
        <label>พนักงานขับที่ร้องขอ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="CAR_DRIVER_ID" id="CAR_DRIVER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกพนักงานขับ--</option>
             @foreach ($drivers as $driver) 
             @if($infonomalapp->CAR_DRIVER_ID == $driver ->PERSON_ID  )
             <option value="{{ $driver ->PERSON_ID  }}" selected>{{ $driver->HR_FNAME}} {{$driver->HR_LNAME}}</option>
             @else
             <option value="{{ $driver ->PERSON_ID  }}">{{ $driver->HR_FNAME}} {{$driver->HR_LNAME}}</option>
             @endif                                                    
          
            @endforeach 
             </select>    
        </div> 
        </div> 
     

    
        <div class="row push">
        <div class="col-sm-2">
        <label>วันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="RESERVE_BEGIN_DATE" id="RESERVE_BEGIN_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  value="{{formate($infonomalapp->RESERVE_BEGIN_DATE)}}" readonly>
        </div> 
        <div class="col-sm-1">
        <label>เวลา :</label>
        </div> 
        <div class="col">
  
        <input type="text" class="js-masked-time form-control" id="RESERVE_BEGIN_TIME" name="RESERVE_BEGIN_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" value="{{$infonomalapp->RESERVE_BEGIN_TIME}}">
        </div> 
        <div class="col-sm-1">
        <label>ถึงวันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="RESERVE_END_DATE" id="RESERVE_END_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" value="{{formate($infonomalapp->RESERVE_END_DATE)}}" readonly>
        </div>
        <div class="col-sm-1">
        <label>เวลา :</label>
        </div> 
        <div class="col">
    
        <input type="text" class="js-masked-time form-control" id="RESERVE_END_TIME" name="RESERVE_END_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" value="{{$infonomalapp->RESERVE_END_TIME}}">
        </div>  
        </div>
       
        <div class="row push">
        <div class="col-sm-2">
        <label>หมายเหตุ :</label>
        </div> 
        <div class="col-sm-10">
        <input name="RESERVE_COMMENT" id="RESERVE_COMMENT" class="form-control input-sm" value="{{$infonomalapp->RESERVE_COMMENT}}" >
        </div> 
      
        </div> 

      

        <div class="row push">
        <div class="col-sm-2">
        <label>ผู้ร้องขอ :</label>
        </div> 
        <div class="col-lg-4">
        {{$infonomalapp->RESERVE_PERSON_NAME}}
        </div> 
        <div class="col-sm-2">
        <label>หัวหน้างานรับรอง :</label>
        </div> 
        <div class="col-lg-4">
        <select name="LEADER_PERSON_ID" id="LEADER_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition(0);checklevel(0)">
            <option value="">--กรุณาเลือกหัวหน้างานรับรอง--</option>
             @foreach ($PERSONALLs as $PERSONALL)  
             @if($infonomalapp->LEADER_PERSON_ID ==  $PERSONALL ->ID )
             <option value="{{ $PERSONALL ->ID  }}" selected>{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
             @else
             <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
             @endif                                                   
            
            @endforeach 
             </select>    
        </div> 
        </div> 
     


        <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ผู้ร่วมเดินทาง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคคลอื่นร่วมเดินทาง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">สถานะการจัดสรร</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object6" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บันทึกก่อนเดินทาง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บันทึกกลับถึงสำนักงาน</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">งานมอบหมาย</a>
                                    </li>




                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                      
                                     <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">ชื่อ สกุล</td>
                                                <td style="text-align: center;" width="30%">ตำแหน่ง</td>
                                                <td style="text-align: center;" width="15%">ระดับ</td>
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow" style="color:#FFFFFF;"><i class="fas fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        @if($countreferperson == 0)  
                                    <tr>
                                        <td> 
                                        <select name="PERSON_ID[]" id="PERSON_ID0" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition(0);checklevel(0)">
                                                        <option value="">--กรุณาเลือกผู้ร่วมเดินทาง--</option>
                                                            @foreach ($PERSONALLs as $PERSONALL)                                                     
                                                                <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_PREFIX_NAME}}{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                            @endforeach 
                                         </select>    
                                        </td>
                                        <td><div class="showposition0"></div></td>
                                        <td><div class="showlevel0"></div></td>
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger fa fa-trash-alt remove" style="color:#FFFFFF;"><i class="fas fa fa-plus"></i></a></td>
                                    </tr>

                                    @else
                                    <?php $checkper = 0; ?>
                                    @foreach ($inforeferpersons as $inforeferperson)  
                                    <tr>
                                        <td> 
                                        <select name="PERSON_ID[]" id="PERSON_ID{{$checkper}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition({{$checkper}});checklevel({{$checkper}})">
                                        <option value="">--กรุณาเลือกผู้ร่วมเดินทาง--</option>
                                                            @foreach ($PERSONALLs as $PERSONALL) 
                                                            @if($inforeferperson->HR_PERSON_ID == $PERSONALL ->ID)                                                    
                                                                <option value="{{ $PERSONALL ->ID  }}" selected>{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                            @else
                                                                <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>    
                                        </td>
                                        <td><div class="showposition{{$checkper}}"></div></td>
                                        <td><div class="showlevel{{$checkper}}"></div></td>
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $checkper++; ?>
                                    @endforeach 
                                    @endif

                                    </tbody>   
                                    </table>

             
                                    </div>
                                    <div class="tab-pane" id="object2" role="tabpanel">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">บุคคลอื่นร่วมเดินทาง</td>
     
                                                <td style="text-align: center;" width="15%"><a  class="btn btn-hero-sm btn-hero-success addRow2" style="color:#FFFFFF;"><i class="fas fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody2">   
                                        @if($countreferpersonetc == 0)  
                                    <tr>
                                        <td> 
                                        <input name="PERSON_OTHER[]" id="PERSON_OTHER[]" class="form-control input-sm"  >
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    @else
                                        @foreach ($inforeferpersonetcs as $inforeferpersonetc) 
                                        <tr>
                                        <td> 
                                        <input name="PERSON_OTHER[]" id="PERSON_OTHER[]" class="form-control input-sm" value="{{$inforeferpersonetc->FULLNAME}}" >
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>
                                        </tr> 

                                        @endforeach 
                                    @endif
                                    </tbody>   
                                    </table>
                                    </div>


                                    <div class="tab-pane" id="object3" role="tabpanel">

                                    <div class="row push">
                                        <div class="col-sm-2">
                                        <label>สถานะจัดสรร :</label>
                                        </div> 
                                        <div class="col-sm-4">
                                        <select name="STATUS" id="STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition(0);checklevel(0)">
                                                        <option value="RECERVE">ร้องขอ</option>
                                                        @if($infonomalapp->STATUS == 'SUCCESS')
                                                        <option value="SUCCESS" selected>อนุมัติ</option>
                                                        @else
                                                        <option value="SUCCESS">อนุมัติ</option>
                                                        @endif

                                                        @if($infonomalapp->STATUS == 'REGROUP')
                                                        <option value="REGROUP" selected>อนุมัติร่วม</option>
                                                        @else
                                                        <option value="REGROUP">อนุมัติร่วม</option>
                                                        @endif

                                                        @if($infonomalapp->STATUS == 'CANCEL')
                                                        <option value="CANCEL" selected>ยกเลิก</option>
                                                        @else
                                                        <option value="CANCEL">ยกเลิก</option>
                                                        @endif
                                                        
                                         </select>    
                                        </div> 
                                        <div class="col-sm-2">
                                        <label>จัดสรรพนักงานขับ :</label>
                                        </div> 
                                        <div class="col-sm-4">
                                        <select name="CAR_DRIVER_SET_ID" id="CAR_DRIVER_SET_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                <option value="">--กรุณาเลือกพนักงานขับ--</option>
                                                @foreach ($drivers as $driver) 
                                                    @if($infonomalapp->CAR_DRIVER_SET_ID == $driver ->PERSON_ID  )
                                                            <option value="{{ $driver ->PERSON_ID  }}" selected>{{ $driver->HR_FNAME}} {{$driver->HR_LNAME}}</option>
                                                     @else
                                                            <option value="{{ $driver ->PERSON_ID  }}">{{ $driver->HR_FNAME}} {{$driver->HR_LNAME}}</option>
                                                 @endif                                                    
          
                                                @endforeach 
                                        </select>    
                                        </div> 
                                    </div> 
                                    

                                    <div class="row push detali_car">
                                        <input type="hidden" name="CAR_REQUEST_ID" id="CAR_REQUEST_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$carset_CAR_ID}}" >
                                        
                                            <div class="col-sm-2">
                                            <label>รถโรงพยาบาลทะเบียน :</label>
                                            </div> 
                                            <div class="col-lg-2">
                                            <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$carset_CAR_REG}}" readonly>
                                            </div> 
                                        
                                            <div class="col-sm-2">
                                            <label>รายละเอียด :</label>
                                            </div> 
                                            <div class="col-lg-4">
                                            <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$carset_CAR_DETAIL}}" readonly>
                                            </div> 

                                            <div class="col-lg-2">
                                            <button type="button" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;" data-toggle="modal" data-target=".add" >เลือกรถที่ต้องการใช้</button>
                                            </div> 
                                            </div>

                                            <div class="row push">
                                               <div class="col-sm-2">
                                                <label>รถยนต์ส่วนตัวทะเบียน :</label>
                                                </div> 
                                                <div class="col-lg-2">
                                                <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infonomalapp->CAR_OWNER}}" readonly>
                                                </div>      
                                                </div> 

                                            <div class="row push">
                                
                                    <table class="table table-bordered" >

                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">เดินทางร่วมกับรายการ</td>
     
                                                <td style="text-align: center;" width="15%"><a  class="btn btn-hero-sm btn-hero-success addRow3" style="color:#FFFFFF;"><i class="fas fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody3">   
                                    <tr>
                                        <td> 
                                        @if($countnomalregroup == 0)  

                                        <select name="RESERVE_ID_SUB[]" id="RESERVE_ID_SUB[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกรายการที่ร่วมเดินทาง--</option>
                                                            @foreach ($infonomalreserves as $infonomalreserve)                                                     
                                                                <option value="{{ $infonomalreserve ->RESERVE_ID  }}">{{ $infonomalreserve->RESERVE_NAME}}</option>
                                                            @endforeach 
                                         </select>    
                                       @else
                                       
                                       @foreach ($infonomalregroups as $infonomalregroup) 
                                       <select name="RESERVE_ID_SUB[]" id="RESERVE_ID_SUB[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกรายการที่ร่วมเดินทาง--</option>
                                                            @foreach ($infonomalreserve2s as $infonomalreserve2 )   
                                                                @if($infonomalregroup->RESERVE_ID_SUB == $infonomalreserve2->RESERVE_ID)
                                                                <option value="{{ $infonomalreserve2 ->RESERVE_ID  }}" selected>{{ $infonomalreserve2->RESERVE_NAME}}</option>
                                                                @else
                                                                <option value="{{ $infonomalreserve2 ->RESERVE_ID  }}">{{ $infonomalreserve2->RESERVE_NAME}}</option>
                                                                @endif                                                  
                                                              
                                                            @endforeach 
                                         </select>    
                                         @endforeach 

                                       @endif
                                        

                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    </tbody>
                                    </table>   
                                

                                        </div>
                                </div>        




                                <div class="tab-pane" id="object6" role="tabpanel">

                                <div class="row push">
                                <div class="col-sm-2">
                                        <label>เลขไมล์ก่อนเดินทาง :</label>
                                        </div> 
                                        <div class="col-sm-4">
                                            <input name="CAR_NUMBER_BEGIN" id="CAR_NUMBER_BEGIN" class="form-control input-sm" value="{{$infonomalapp->CAR_NUMBER_BEGIN}}" onkeyup="amountdistance();" OnKeyPress="return chkNumber(this)">
                                        </div> 
                                        <div class="col-sm-2">
                                        <label>สถานที่นัดหมาย :</label>
                                        </div> 
                                        <div class="col-sm-4">
                                    

                                            <select name="APPOINT_LOCATE_ID" id="APPOINT_LOCATE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                    <option value="">--กรุณาเลือกสถานที่นัดหมาย--</option>
                                                    @foreach ($infoappointlocates as $infoappointlocate)  
                                                    @if($infonomalapp->APPOINT_LOCATE_ID ==  $infoappointlocate ->APPOINT_LOCATE_ID )
                                                    <option value="{{ $infoappointlocate ->APPOINT_LOCATE_ID  }}" selected>{{ $infoappointlocate->APPOINT_LOCATE_NAME}}</option>
                                                    @else
                                                    <option value="{{ $infoappointlocate ->APPOINT_LOCATE_ID  }}">{{ $infoappointlocate->APPOINT_LOCATE_NAME}}</option>
                                                    @endif                                                   
                                                    
                                                    @endforeach 
                                                    </select>    

                                        </div> 
                                 
                                    </div> 
                                    <div class="row push">
                                        <div class="col-sm-2">
                                        <label>วันนัดหมาย :</label>
                                        </div> 
                                        <div class="col-sm-2">
                                           @if($infonomalapp->APPOINT_DATE == '0000-00-00' || $infonomalapp->APPOINT_DATE == '')
                                           <input name="APPOINT_DATE" id="APPOINT_DATE"  class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" readonly  >
                                           @else
                                           <input name="APPOINT_DATE" id="APPOINT_DATE"  class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  value="{{formate($infonomalapp->APPOINT_DATE)}}" readonly  >
                                           @endif
                                         
                                        </div> 
                                        <div class="col-sm-1">
                                        <label>เวลา :</label>
                                        </div> 
                                        <div class="col-sm-1">
                                        <input type="text" class="js-masked-time form-control" id="APPOINT_TIME" name="APPOINT_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" value="{{$infonomalapp->APPOINT_TIME}}">
                                        </div> 

                                        </div> 


                                </div> 

                     

                                    <div class="tab-pane" id="object4" role="tabpanel">

                                    <div class="row push">
                                        <div class="col-sm-2">
                                        <label>เลขไมล์หลังเดินทาง :</label>
                                        </div> 
                                        <div class="col-sm-4">
                                            <input name="CAR_NUMBER_BACK" id="CAR_NUMBER_BACK" class="form-control input-sm"  value="{{$infonomalapp->CAR_NUMBER_BACK}}" onkeyup="amountdistance();" OnKeyPress="return chkNumber(this)">
                                        </div> 
                                        <div class="col-sm-1">
                                        <label>ราคาที่เติม :</label>
                                        </div> 
                                        <div class="col-sm-2">
                                            <input name="OIL_IN_BATH" id="OIL_IN_BATH" class="form-control input-sm"  value="{{$infonomalapp->OIL_IN_BATH}}">
                                        </div> 

                                        <div class="col-sm-1">
                                        <label>จำนวนลิตร :</label>
                                        </div> 
                                        <div class="col-sm-2">
                                            <input name="OIL_IN_LIT" id="OIL_IN_LIT" class="form-control input-sm"  value="{{$infonomalapp->OIL_IN_LIT}}">
                                        </div> 
                                    </div> 
                                    <div class="row push">
                                        <div class="col-sm-2">
                                        <label>วันที่กลับถึง :</label>
                                        </div> 
                                        <div class="col-sm-4">
                                            @if($infonomalapp->BACK_DATE == '0000-00-00' || $infonomalapp->BACK_DATE == '')
                                            <input name="BACK_DATE" id="BACK_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  readonly  >
                                            @else
                                            <input name="BACK_DATE" id="BACK_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  value="{{formate($infonomalapp->BACK_DATE)}}" readonly  >
                                            @endif
                                        
                                        </div> 
                                        <div class="col-sm-1">
                                        <label>เวลา :</label>
                                        </div> 
                                        <div class="col-sm-2">
                                        <input type="text" class="js-masked-time form-control" id="BACK_TIME" name="BACK_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" value="{{$infonomalapp->BACK_TIME}}">
                                        </div> 
                                        <div class="col-sm-1">
                                        <label>ระยะทางไป กม. :</label>
                                        </div> 
                                        <div class="col-sm-2 amountdistanceuse" >
                                            <input name="DISTANCE" id="DISTANCE" class="form-control input-sm"  value="{{$infonomalapp->DISTANCE}}">
                                        </div> 
                                    </div> 
                                    <div class="row push">
                                        <div class="col-sm-2">
                                        <label>หมายเหตุ :</label>
                                        </div> 
                                        <div class="col-sm-4">
                                            <input name="COMMENT" id="COMMENT" class="form-control input-sm"  value="{{$infonomalapp->COMMENT}}">
                                        </div> 
                                      
                                    </div> 
                                  

                                    </div>


                                    <div class="tab-pane" id="object5" role="tabpanel">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;" width="25%">สถานที่</td>
                                                <td style="text-align: center;">รายละเอียดงาน</td>
                                                <td style="text-align: center;" width="10%">ผลปฏิบัติ</td>
                                                <td style="text-align: center;" width="20%">หมายเหตุ</td>
     
                                                <td style="text-align: center;" width="15%"><a  class="btn btn-hero-sm btn-hero-success addRow5" style="color:#FFFFFF;"><i class="fas fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody5"> 
                                        @if($countnomalwork == 0)  

                                    <tr>
                                         <td> 

                                         <input name="CARWORK_LOCATION_ID[]" id="CARWORK_LOCATION_ID[]" class="form-control input-sm"  >
                                         
                                        
                                        </td>
                                        <td> 
                                        <input name="CARWORK_DETAIL[]" id="CARWORK_DETAIL[]" class="form-control input-sm"  >
                                        </td> 
                                        <td> 
                                        <select name="CARWORK_RESERVE_CHECK[]" id="CARWORK_RESERVE_CHECK[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                                                  
                                                    <option value="false">ไม่สำเร็จ</option>
                                                    <option value="true">สำเร็จ</option>
                                        </select> 
                                        </td> 
                                        <td> 
                                        <input name="CARWORK_RESERVE_COMMENT[]" id="CARWORK_RESERVE_COMMENT[]" class="form-control input-sm"  >
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove5" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>
                                    </tr>

                                    @else
                                
                                    @foreach ($infonomalworks as $infonomalwork)  

                                    <tr>
                                         <td> 

                                         <input name="CARWORK_LOCATION_ID[]" id="CARWORK_LOCATION_ID[]" class="form-control input-sm" value="{{$infonomalwork->CARWORK_LOCATION_ID}}" >

                                       
                                        </td>
                                        <td> 
                                        <input name="CARWORK_DETAIL[]" id="CARWORK_DETAIL" class="form-control input-sm"  value="{{$infonomalwork->CARWORK_DETAIL}}">
                                        </td> 
                                        <td> 

                                        <select name="CARWORK_RESERVE_CHECK[]" id="CARWORK_RESERVE_CHECK[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                                                  
                                                                                  <option value="false">ไม่สำเร็จ</option>
                                                                                  @if($infonomalwork->CARWORK_RESERVE_CHECK == 'true')
                                                                                  <option value="true" selected>สำเร็จ</option>
                                                                                  @else
                                                                                  <option value="true">สำเร็จ</option>
                                                                                  @endif
                                            </select>   
                                        </td> 
                                        <td> 
                                        <input name="CARWORK_RESERVE_COMMENT[]" id="CARWORK_RESERVE_COMMENT" class="form-control input-sm"  value="{{$infonomalwork->CARWORK_RESERVE_COMMENT}}">
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove5" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>
                                    </tr>

                                   
                                    @endforeach 
                                    @endif
                                    </tbody>   
                                    </table>
                                    </div>
               
                                  

                       
                                   
                                </div>
                            </div>
        </div>

       </div>


       
      
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <a href="{{ url('manager_car/carinfonomal')  }}"  style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
                     
        <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกรถที่ต้องการใช้</h2>
        </div>
        <div class="modal-body">
        <body>
  
           <div class="row">
        @foreach ($cars as $car)                                                     
           <div class="col-md-2 col-xl-2">
                            <!-- Story #1 -->
                            <a class="block block-rounded"  onclick="selectcar({{$car->CAR_ID}});">
                            
                                <div class="block-content" style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($car->CAR_IMG)) }});">
                                    <p>
                                    <span class="badge badge-info font-w2000 p-2 text-uppercase">
                                   {{$car->CAR_REG}} 
                                    </span>
                                    </p>
                                <div class="mb-3 mb-sm-3 d-sm-flex justify-content-sm-between align-items-sm-center">
                                   
                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($car->CAR_IMG)) }}"  width="100%"> 

                                    </div>
                                  

                                    
                                </div>
                            </a>
                            <!-- END Story #1 -->
                        </div>
            @endforeach 
 
            </div>
      </div>
        <div class="modal-footer">
        <div align="right">

        <button type="button" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
        </div>
        </div>
    
</body>
     
     
    </div>
  </div>
</div>
       
               
                      

@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    
    

<script>
   $(document).ready(function() {
    $('select').select2({
        width: '100%'
});
});
function run01(){
    var count = $('.tbody1').children('tr').length;
    //alert(count);
    var number;
        for (number = 0; number < count; number++) { 
            checkposition(number);
            checklevel(number);
            
        }
        
}

   $('.addRow').on('click',function(){
         addRow();
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
         var tr ='<tr>'+
                '<td>'+  
                    '<select name="PERSON_ID[]" id="PERSON_ID'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition('+count+');checklevel('+count+');">'+
                '<option value="">--กรุณาเลือกผู้ร่วมเดินทาง--</option>'+
                '@foreach ($PERSONALLs as $PERSONALL)'+                                                   
                '<option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+
                '<td><div class="showposition'+count+'"></div></td>'+
                '<td><div class="showlevel'+count+'"></div></td>'+
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });

     //-------------------------------------------------

     $('.addRow2').on('click',function(){
         addRow2();
     });

     function addRow2(){
         var tr = '<tr>'+
                  '<td>'+ 
                
                  '<input name="PERSON_OTHER[]" id="PERSON_OTHER[]" class="form-control input-sm"  >'+
                  '</td>'+                      
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody2').append(tr);
     };

     $('.tbody2').on('click','.remove2', function(){
            $(this).parent().parent().remove();
     });

         //-------------------------------------------------

         $('.addRow3').on('click',function(){
         addRow3();
     });

     function addRow3(){
         var tr = '<tr>'+
                  '<td>'+ 
                  '<select name="RESERVE_ID_SUB[]" id="RESERVE_ID_SUB[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+ 
                    '<option value="">--กรุณาเลือกรายการที่ร่วมเดินทาง--</option>'+ 
                        '@foreach ($infonomalreserves as $infonomalreserve)'+                                                      
                            '<option value="{{ $infonomalreserve ->RESERVE_ID  }}">{{ $infonomalreserve->RESERVE_NAME}}</option>'+ 
                        '@endforeach'+  
                '</select>'+  
                  '</td>'+                      
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody3').append(tr);
     };

     $('.tbody3').on('click','.remove3', function(){
            $(this).parent().parent().remove();
     });

       //-------------------------------------------------

       $('.addRow5').on('click',function(){
         addRow5();
     });

     function addRow5(){
         var tr = '<tr>'+
                '<td>'+ 
                '<select name="CARWORK_LOCATION_ID[]" id="CARWORK_LOCATION_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;">'+
                '<option value="">--กรุณาเลือกสถาน--</option>'+
                 '@foreach ($locations as $location)'+                                                     
                 '<option value="{{ $location ->LOCATION_ID  }}">{{ $location->LOCATION_ORG_NAME}}</option>'+
                '@endforeach'+ 
                '</select>'+    
                '</td>'+
                '<td>'+ 
                '<input name="CARWORK_DETAIL[]" id="CARWORK_DETAIL[]" class="form-control input-sm"  >'+
                '</td>'+ 
                 '<td>'+ 
                 '<select name="CARWORK_RESERVE_CHECK[]" id="CARWORK_RESERVE_CHECK[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;">'+                                                                   
                  '<option value="false">ไม่สำเร็จ</option>'+ 
                  '<option value="true">สำเร็จ</option>'+ 
                '</select>'+  
                '</td>'+ 
                '<td>'+ 
                '<input name="CARWORK_RESERVE_COMMENT[]" id="CARWORK_RESERVE_COMMENT[]" class="form-control input-sm"  >'+
                '</td>'+                    
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove5" style="color:#FFFFFF;"><i class="fas fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody5').append(tr);
     };

     $('.tbody5').on('click','.remove5', function(){
            $(this).parent().parent().remove();
     });
//======================หาตำแหน่งผู้เดินทาง===========================




function checkposition(number){
      
    
      var PERSON_ID=document.getElementById("PERSON_ID"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.checkposition')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showposition'+number).html(result);
                   }
           })

        

  }

  function checklevel(number){
      
    
      var PERSON_ID=document.getElementById("PERSON_ID"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.checklevel')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showlevel'+number).html(result);
                   }
           })

  }


  function selectcar(car_id){
      
    
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('car.selectcarno')}}",
                   method:"GET",
                   data:{car_id:car_id,_token:_token},
                   success:function(result){
                    $('.detali_car').html(result);
                   }
           })

           $('#modalwindow').modal('hide');

  }



$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });





function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

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


function amountdistance(){

var beginnum= document.getElementById("CAR_NUMBER_BEGIN").value; 
var endnum= document.getElementById("CAR_NUMBER_BACK").value; 


  var _token=$('input[name="_token"]').val();
       $.ajax({
               url:"{{route('mcar.amountdistance')}}",
               method:"GET",
               data:{beginnum:beginnum,endnum:endnum,_token:_token},
               success:function(result){
                $('.amountdistanceuse').html(result);
               }
       })
   
};


  
</script>


@endsection