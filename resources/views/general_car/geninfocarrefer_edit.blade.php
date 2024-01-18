@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลขอใช้รถพยาบาล</h2> 
                        
        <form  method="post" action="{{ route('car.carreferupdate') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="ID" id="ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforefer->ID}}">

       <div class="row push detali_car">
       <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforefer->CAR_ID}}">
       
        <div class="col-sm-2">
        <label>ทะเบียน :</label>
        </div> 
        <div class="col-lg-2">
        <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforefer->CAR_REG}}" readonly>
        <div style="color: red;" id="detalicar"></div>  
        </div> 
        
        <div class="col-sm-2">
        <label>รายละเอียด :</label>
        </div> 
        <div class="col-lg-4">
        <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforefer->CAR_DETAIL}}" readonly>
        </div> 

        <div class="col-lg-2">
        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" >เลือกรถที่ต้องการใช้</button>
        </div>
        
        </div> 
        
     
        <div class="row "> 
            <div class="col-sm-8">
                <div style="color: #DC143C; text-align: center;" class="checkdat"></div>
            </div> 
            <div class="col-lg-4">
            </div> 
        </div>
    
        <div class="row push">
        <div class="col-sm-2">
        <label>วันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="OUT_DATE" id="OUT_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" value="{{formate($inforefer->OUT_DATE)}}" onchange="carcallcheckdate();"  readonly>
        <div style="color: red;" id="outdate"></div> 
        </div> 
        <div class="col-sm-1">
        <label>เวลา :</label>
        </div> 
        <div class="col">
        <input type="text" class="js-masked-time form-control" id="OUT_TIME" name="OUT_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" value="{{$inforefer->OUT_TIME}}"  onkeyup="checkouttime()">
        <div style="color: red;" id="outtime"></div> 
        </div> 
        <div class="col-sm-1">
        <label>ถึงวันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="BACK_DATE" id="BACK_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" value="{{formate($inforefer->BACK_DATE)}}" onchange="carcallcheckdate();" readonly>
        <div style="color: red;" id="backdate"></div> 
        </div>
        <div class="col-sm-1">
        <label>เวลา :</label>
        </div> 
        <div class="col">
        <input type="text" class="js-masked-time form-control" id="BACK_TIME" name="BACK_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" value="{{$inforefer->BACK_TIME}}" onkeyup="checkbacktime()">
        <div style="color: red;" id="backtime"></div> 
        </div>  
        </div>



        <div class="row push">
        <div class="col-sm-2">
        <label>สถานที่ไป :</label>
        </div> 
        <div class="col-lg-4">
        <select name="REFER_LOCATION_GO_ID" id="REFER_LOCATION_GO_ID" class="form-control input-lg js-example-basic-single org_re" style=" font-family: 'Kanit', sans-serif;" onchange="checkreservelocationid()">
            <option value="">--กรุณาเลือกสถานที่ไป--</option>
             @foreach ($locations as $location)  

             @if($inforefer->REFER_LOCATION_GO_ID == $location ->LOCATION_ID)
                <option value="{{ $location ->LOCATION_ID  }}" selected>{{ $location->LOCATION_ORG_NAME}}</option>
             @else
                <option value="{{ $location ->LOCATION_ID  }}">{{ $location->LOCATION_ORG_NAME}}</option>
             @endif                                                   
            
            @endforeach 
             </select> 
             <div style="color: red;" id="referlocationid"></div>   
        </div> 
        <div class="col-sm-4">
        <input name="ADD_RECORD_ORG" id="ADD_RECORD_ORG" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุสถานที่หากต้องการเพิ่ม">
        </div> 
        <div class="col-lg-2">
        <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="addorg();"><i class="fas fa-plus"></i> เพิ่ม</a>
        </div> 
       </div>


        
        
        <div class="row push">
        <div class="col-sm-2">
        <label>ประเภท REFER :</label>
        </div> 
        <div class="col-lg-4">
        <select name="REFER_TYPE_ID" id="REFER_TYPE_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
           
             @foreach ($refertypes as $refertype) 

             @if($inforefer->REFER_TYPE_ID == $refertype ->REFER_TYPE_ID)
             <option value="{{ $refertype ->REFER_TYPE_ID  }}" selected>{{ $refertype->REFER_TYPE_NAME}}</option>
             @else
             <option value="{{ $refertype ->REFER_TYPE_ID  }}">{{ $refertype->REFER_TYPE_NAME}}</option>
             @endif                                                    
           
            @endforeach 
             </select>    
        </div> 
        <div class="col-sm-2">
        <label>พนักงานขับ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="DRIVER_ID" id="DRIVER_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" onchange="checkcardriverid()">
            <option value="">--กรุณาเลือกพนักงานขับ--</option>
             @foreach ($drivers as $driver)  
             @if($inforefer->DRIVER_ID == $driver ->PERSON_ID )
             <option value="{{ $driver ->PERSON_ID  }}" selected>{{ $driver->HR_FNAME}} {{$driver->HR_LNAME}}</option>
             @else
             <option value="{{ $driver ->PERSON_ID  }}">{{ $driver->HR_FNAME}} {{$driver->HR_LNAME}}</option>
             @endif                                                   
            
            @endforeach 
             </select> 

              <div style="color: red;" id="cardriverid"></div>    
        </div> 
        </div> 


        
        <div class="row push">
        <div class="col-sm-2">
        <label>เลขไมล์ก่อนเดินทาง :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_GO_MILE" id="CAR_GO_MILE" class="form-control input-sm"  value="{{$inforefer->CAR_GO_MILE}}" OnKeyPress="return chkNumber(this)">
        </div> 
        <div class="col">
        <label>กิโลเมตร</label>
        </div> 
        <div class="col">
        <label>เติมน้ำมัน:</label>
        </div> 
        <div class="col-lg-2">
        <input name="ADD_OIL_BATH" id="ADD_OIL_BATH" class="form-control input-sm " value="{{$inforefer->ADD_OIL_BATH}}" OnKeyPress="return chkNumber(this)">
        </div> 
        <div class="col">
        <label>บาท</label>
        </div> 
        <div class="col-sm-1">
        <label>จำนวน:</label>
        </div> 
        <div class="col-lg-1">
        <input name="ADD_OIL_LIT" id="ADD_OIL_LIT" class="form-control input-sm" value="{{$inforefer->ADD_OIL_LIT}}" OnKeyPress="return chkNumber(this)">
        </div>
        <div class="col">
        <label>ลิตร</label>
        </div> 
       
        </div>

        <div class="row push">
        <div class="col-sm-2">
        <label>เลขไมล์หลังเดินทาง :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_BACK_MILE" id="CAR_BACK_MILE" class="form-control input-sm"  value="{{$inforefer->CAR_BACK_MILE}}" OnKeyPress="return chkNumber(this)">
        </div> 
        <div class="col">
        <label>กิโลเมตร</label>
        </div> 
        <div class="col">
        <label>ราคาน้ำมัน:</label>
        </div> 
        <div class="col-lg-2">
        <input name="OIL_PRICE" id="OIL_PRICE" class="form-control input-sm " value="{{$inforefer->OIL_PRICE}}" >
        </div> 
        <div class="col">
        <label>บาท/ลิตร</label>
        </div> 
        <div class="col-sm-1">
        <label>หน่วยงาน:</label>
        </div> 
        <div class="col-lg-2">
        <input name="ORG_ID" id="ORG_ID" class="form-control input-sm"  value="{{$inforefer->ORG_ID}}" >
        </div>
      
       
        </div>
     

       
        <div class="row push">
        <div class="col-sm-2">
        <label>หมายเหตุ :</label>
        </div> 
        <div class="col-sm-10">
        <input name="COMMENT" id="COMMENT" class="form-control input-sm"  value="{{$inforefer->COMMENT}}" >
        </div> 

       
       
        </div> 

        

        <div class="row push">
        <div class="col-sm-2">
        <label>ชื่อคนไข้ :</label>
        </div> 
        <div class="col-sm-2">
        <input name="HOS_FULLNAME" id="HOS_FULLNAME" class="form-control input-sm"  value="{{$inforefer->HOS_FULLNAME}}" >
        </div> 
      
        <div class="col">
        <label>อายุ :</label>
        </div> 
        <div class="col-sm-1">
        <input name="HOS_AGE" id="HOS_AGE" class="form-control input-sm " value="{{$inforefer->HOS_AGE}}" OnKeyPress="return chkNumber(this)">
        </div> 
    
        <div class="col-sm-1">
        <label>HN :</label>
        </div> 
        <div class="col-sm-2">
        <input name="HOS_HN" id="HOS_HN" class="form-control input-sm"  value="{{$inforefer->HOS_HN}}">
        </div>

        <div class="col-sm-1">
        <label>CID :</label>
        </div> 
        <div class="col-sm-2">
        <input name="HOS_CID" id="HOS_CID" class="form-control input-sm" value="{{$inforefer->HOS_CID}}" OnKeyPress="return chkNumber(this)">
        </div>
      
       
        </div>
        <div class="row push">
        <div class="col-sm-2">
        <label>ป่วยด้วยโรค :</label>
        </div> 
        <div class="col-sm-4">
        <input name="" id="" class="form-control input-sm"  >
        </div> 
      
    
        <div class="col-sm-1">
        <label>เชื้อชาติ :</label>
        </div> 
        <div class="col-sm-2">
        <select name="NATIONNALITY_ID" id="NATIONNALITY_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--เลือกเชื้อชาติ--</option>
                                                            @foreach ($nationalitys as $nationality) 

                                                                @if($nationality ->HR_NATIONALITY_ID == $inforefer->NATIONNALITY_ID)
                                                                    <option value="{{ $nationality ->HR_NATIONALITY_ID  }}" selected>{{ $nationality->HR_NATIONALITY_NAME}}</option>
                                                                @else
                                                                    <option value="{{ $nationality ->HR_NATIONALITY_ID  }}">{{ $nationality->HR_NATIONALITY_NAME}}</option>
                                                                @endif                                                    
                                                               
                                                            @endforeach 
                                         </select>    
        </div>

        <div class="col-sm-1">
        <label>สัญชาติ :</label>
        </div> 
        <div class="col-sm-2">
        <select name="CITIZENSHIP_ID" id="CITIZENSHIP_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--เลือกสัญชาติ--</option>
                                                            @foreach ($citizenships as $citizenship) 

                                                                @if($citizenship ->HR_CITIZENSHIP_ID == $inforefer->CITIZENSHIP_ID)
                                                                    <option value="{{ $citizenship ->HR_CITIZENSHIP_ID  }}" selected>{{ $citizenship->HR_CITIZENSHIP_NAME}}</option>
                                                                @else
                                                                    <option value="{{ $citizenship ->HR_CITIZENSHIP_ID  }}">{{ $citizenship->HR_CITIZENSHIP_NAME}}</option>
                                                                @endif                                                    
                                                               
                                                            @endforeach 
                                         </select>    
        </div>
      
       
        </div>


        <div class="row push">
        <div class="col-sm-2">
        <label>ผู้ร้องขอ :</label>
        </div> 
        <div class="col-lg-4">
       
        <input type="hidden" name="USER_REQUEST_ID" id="USER_REQUEST_ID" class="form-control input-sm"  value="{{$inforpersonuserid -> ID}}">
        {{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
        </div> 
        <div class="col-sm-1">
        <label>รักษาต่อ :</label>
        </div> 
        <div class="col-lg-5">
        <input name="HOS_HOSPNAME" id="HOS_HOSPNAME" class="form-control input-sm" value="{{$inforefer->HOS_HOSPNAME}}" >
        </div> 
        </div> 
     


        <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">เจ้าหน้าที่คนที่ไป</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">อุปกรณ์ภายในรถ</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">งานมอบหมาย</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">อุปกรณ์อื่นๆ</a>
                                    </li>


                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                      
                                     <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">ชื่อ สกุล</td>
                                                <td style="text-align: center;" width="30%">ตำแหน่ง</td>
                                                <td style="text-align: center;" width="15%">ระดับ</td>
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1">
                                            
                                        <?php $checkper = 0; ?>
                                    @foreach ($infoconcludepersons as $infoconcludeperson)    
                                    <tr>
                                        <td> 
                                        <select name="PERSON_ID[]" id="PERSON_ID{{$checkper}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition(0);checklevel(0)">
                                                        <option value="">--กรุณาเลือกเจ้าหน้าที่--</option>
                                                        @foreach ($PERSONALLs as $PERSONALL)  
                                                               @if($PERSONALL ->ID == $infoconcludeperson->NURSE_HR_ID  )
                                                                    <option value="{{ $PERSONALL ->ID  }}" selected>{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                               @else
                                                                    <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                               @endif                                                   
                                                              
                                                            @endforeach  
                                         </select>    
                                        </td>
                                        <td><div class="showposition{{$checkper}}"></div></td>
                                        <td><div class="showlevel{{$checkper}}"></div></td>
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>

                                    <?php $checkper++; ?>
                                    @endforeach 
                                    </tbody>   
                                    </table>


                                    </div>
                                    <div class="tab-pane" id="object2" role="tabpanel">
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">อุปกรณ์ภายในรถ</td>
     
                                                <td style="text-align: center;" width="15%"><a  class="btn btn-hero-sm btn-hero-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody2">   
                                    <tr>
                                        <td> 
                                        <input name="PERSON_OTHER[]" id="PERSON_OTHER[]" class="form-control input-sm"  >
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    </tbody>   
                                    </table>
                                    </div>

                                    
                                    <div class="tab-pane" id="object3" role="tabpanel">
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;" width="40%">สถานที่</td>
                                                <td style="text-align: center;">รายละเอียดงาน</td>
     
                                                <td style="text-align: center;" width="15%"><a  class="btn btn-hero-sm btn-hero-success addRow3" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody3">  
                                            
                                            <tr>
                                                <td> 
                                                <input name="CARWORK_REFER_LOCATION_ID[]" id="CARWORK_REFER_LOCATION_ID[]" class="form-control input-sm"  >
       
                                               
                                               </td>
                                               <td> 
                                               <input name="CARWORK_REFER_DETAIL[]" id="CARWORK_REFER_DETAIL[]" class="form-control input-sm"  >
                                               </td>
                                            
                                               <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                           </tr>


                                        @foreach ($inforeferworks as $inforeferwork)
                                    <tr>
                                         <td> 
                                         <input name="CARWORK_REFER_LOCATION_ID[]" id="CARWORK_REFER_LOCATION_ID[]" class="form-control input-sm"  value="{{$inforeferwork->CARWORK_REFER_LOCATION_ID}}" >
    
                                        </td>
                                        <td> 
                                        <input name="CARWORK_REFER_DETAIL[]" id="CARWORK_REFER_DETAIL[]" class="form-control input-sm"  value="{{$inforeferwork->CARWORK_REFER_DETAIL}}">
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    
                                    @endforeach 


                                    </tbody>   
                                    </table>
                                    </div>



                                      
                                    <div class="tab-pane" id="object4" role="tabpanel">
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;" width="70%">รายการ</td>
                                                <td style="text-align: center;">จำนวน</td>
     
                                                <td style="text-align: center;" width="15%"><a  class="btn btn-hero-sm btn-hero-success addRow4" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody4"> 

                                            <tr>
                                                <td> 
                                                <select name="EQUIPMENT_ID[]" id="EQUIPMENT_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                       <option value="">--กรุณาเลือกรายการ--</option>
                                                       @foreach ($equipments as $equipment)                                                     
                                                           <option value="{{ $equipment ->EQUIPMENT_ID  }}">{{ $equipment->EQUIPMENT_NAME}}</option>
                                                        @endforeach 
                                               </select>    
                                               </td>
                                               <td> 
                                               <input name="EQUIPMENT_AMOUNT[]" id="EQUIPMENT_AMOUNT[]" class="form-control input-sm"  >
                                               </td>
                                            
                                               <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove4" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                           </tr>
                                        @foreach ($inforeferequipments as $inforeferequipment)  
                                    <tr>
                                         <td> 
                                         <select name="EQUIPMENT_ID[]" id="EQUIPMENT_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                <option value="">--กรุณาเลือกรายการ--</option>
                                                @foreach ($equipments as $equipment) 
                                                    @if($equipment ->EQUIPMENT_ID == $inforeferequipment->EQUIPMENT_ID)
                                                    <option value="{{ $equipment ->EQUIPMENT_ID  }}" selected>{{ $equipment->EQUIPMENT_NAME}}</option>
                                                    @else
                                                    <option value="{{ $equipment ->EQUIPMENT_ID  }}">{{ $equipment->EQUIPMENT_NAME}}</option>
                                                    @endif                                                    
                                                   
                                                 @endforeach 
                                        </select>    
                                        </td>
                                        <td> 
                                        <input name="EQUIPMENT_AMOUNT[]" id="EQUIPMENT_AMOUNT[]" class="form-control input-sm"  value="{{$inforeferequipment->EQUIPMENT_AMOUNT}}">
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove4" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach 
                                    </tbody>   
                                    </table>
                                    </div>
               
                                  

                       
                                   
                                </div>
                            </div>
        </div>

       </div>


       
      
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <a href="{{ url('general_car/gencarinforefer/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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

        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
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
    $('.js-example-basic-single').select2();
});

function addorg(){
      
      var record_org=document.getElementById("ADD_RECORD_ORG").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('car.addorglocation')}}",
                   method:"GET",
                   data:{record_org:record_org,_token:_token},
                   success:function(result){
                      $('.org_re').html(result);
                   }
           })

  }


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
                '<option value="">--กรุณาเลือกเจ้าหน้าที่--</option>'+
                '@foreach ($PERSONALLs as $PERSONALL)'+                                                   
                '<option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+
                '<td><div class="showposition'+count+'"></div></td>'+
                '<td><div class="showlevel'+count+'"></div></td>'+
                ' <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
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
                ' <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
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
         var tr =  '<tr>'+
                    '<td>'+ 
                    '<input name="CARWORK_REFER_LOCATION_ID[]" id="CARWORK_REFER_LOCATION_ID[]" class="form-control input-sm"  >'+    
                    '</td>'+
                    '<td>'+ 
                    '<input name="CARWORK_REFER_DETAIL[]" id="CARWORK_REFER_DETAIL[]" class="form-control input-sm">'+
                    '</td>'+                
                    ' <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
        $('.tbody3').append(tr);
     };

     $('.tbody3').on('click','.remove3', function(){
            $(this).parent().parent().remove();
     });

    //-------------------------------------------------

          $('.addRow4').on('click',function(){
         addRow4();
     });

     function addRow4(){
         var tr =   '<tr>'+
                    '<td>'+ 
                    '<select name="EQUIPMENT_ID[]" id="EQUIPMENT_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;">'+
                    '<option value="">--กรุณาเลือกรายการ--</option>'+
                    '@foreach ($equipments as $equipment)'+                                                     
                    '<option value="{{ $equipment ->EQUIPMENT_ID  }}">{{ $equipment->EQUIPMENT_NAME}}</option>'+
                     '@endforeach'+ 
                    '</select>'+    
                   '</td>'+
                    '<td>'+ 
                    '<input name="EQUIPMENT_AMOUNT[]" id="EQUIPMENT_AMOUNT[]" class="form-control input-sm"  >'+
                    '</td>'+               
                    '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove4" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
        $('.tbody4').append(tr);
     };

     $('.tbody4').on('click','.remove4', function(){
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
                   url:"{{route('car.selectcarrefer')}}",
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


 


function checkoutdate()
        {        
           outdate = document.getElementById("OUT_DATE").value;
                if (outdate==null || outdate==''){      
                        document.getElementById("outdate").style.display = "";     
                        text_outdate= "*กรุณาระบุวันที่";
                        document.getElementById("outdate").innerHTML = text_outdate;

                }else{
                        document.getElementById("outdate").style.display = "none"
                }
        }

        function checkouttime()
        {        
            outtime = document.getElementById("OUT_TIME").value;
                if (outtime==null || outtime==''){      
                        document.getElementById("outtime").style.display = "";     
                        text_outtime= "*กรุณาระบุเวลา ";
                        document.getElementById("outtime").innerHTML = text_outtime;

                }else{
                        document.getElementById("outtime").style.display = "none"
                }
        }



        function checkbackdate()
        {        
         backdate = document.getElementById("BACK_DATE").value;
                if (backdate==null || backdate==''){      
                        document.getElementById("backdate").style.display = "";     
                        text_backdate= "*กรุณาระบุวันที่";
                        document.getElementById("backdate").innerHTML = text_backdate;

                }else{
                        document.getElementById("backdate").style.display = "none"
                }
        }

        function checkbacktime()
        {        
            backtime = document.getElementById("BACK_TIME").value;
                if (backtime==null || backtime==''){      
                        document.getElementById("backtime").style.display = "";     
                        text_backtime= "*กรุณาระบุเวลา ";
                        document.getElementById("backtime").innerHTML = text_backtime;

                }else{
                        document.getElementById("backtime").style.display = "none"
                }
        }


        function checkreservelocationid()
        {        
            referlocation = document.getElementById("REFER_LOCATION_GO_ID").value;
                if (referlocation==null || referlocation==''){      
                        document.getElementById("referlocationid").style.display = "";     
                        text_referlocation= "*กรุณาระบุสถานที่ไป ";
                        document.getElementById("referlocationid").innerHTML = text_referlocation;

                }else{
                        document.getElementById("referlocationid").style.display = "none"
                }
        }



        function checkcardriverid()
        {        
            cardriverid = document.getElementById("DRIVER_ID").value;
                if (cardriverid==null || cardriverid==''){      
                        document.getElementById("cardriverid").style.display = "";     
                        text_cardriverid= "*กรุณาระบุพนักงานขับ";
                        document.getElementById("cardriverid").innerHTML = text_cardriverid;

                }else{
                        document.getElementById("cardriverid").style.display = "none"
                }
        }




$('form').submit(function () {

                var carid,text_carid;
                var outdate,text_outdate;
                var outtime,text_outtime;
                var backdate,text_backdate;
                var backtime,text_backtime;
                var referlocation,text_referlocation;
                var cardriverid,text_cardriverid;

                

                carid = document.getElementById("CAR_ID").value;
                outdate = document.getElementById("OUT_DATE").value;
                outtime = document.getElementById("OUT_TIME").value;

                backdate = document.getElementById("BACK_DATE").value;
                backtime = document.getElementById("BACK_TIME").value;
              

                referlocation = document.getElementById("REFER_LOCATION_GO_ID").value;
                cardriverid = document.getElementById("DRIVER_ID").value;

                

                if (outdate==null || outdate==''){      
                        document.getElementById("outdate").style.display = "";     
                        text_outdate= "*กรุณาระบุวันที่";
                        document.getElementById("outdate").innerHTML = text_outdate;

                }else{
                        document.getElementById("outdate").style.display = "none"
                }
               
                if (outtime==null || outtime==''){      
                        document.getElementById("outtime").style.display = "";     
                        text_outtime= "*กรุณาระบุเวลา ";
                        document.getElementById("outtime").innerHTML = text_outtime;

                }else{
                        document.getElementById("outtime").style.display = "none"
                }

              
                if (backdate==null || backdate==''){      
                        document.getElementById("backdate").style.display = "";     
                        text_backdate= "*กรุณาระบุวันที่";
                        document.getElementById("backdate").innerHTML = text_backdate;

                }else{
                        document.getElementById("backdate").style.display = "none"
                }

               
                if (backtime==null || backtime==''){      
                        document.getElementById("backtime").style.display = "";     
                        text_backtime= "*กรุณาระบุเวลา ";
                        document.getElementById("backtime").innerHTML = text_backtime;

                }else{
                        document.getElementById("backtime").style.display = "none"
                }


                if (carid==null || carid==''){      
                        document.getElementById("detalicar").style.display = "";     
                        text_carid= "*กรุณาเลือกรถที่จะใช้";
                        document.getElementById("detalicar").innerHTML = text_carid;

                }else{
                        document.getElementById("detalicar").style.display = "none"
                }
               

                if (referlocation==null || referlocation==''){      
                        document.getElementById("referlocationid").style.display = "";     
                        text_referlocation= "*กรุณาระบุสถานที่ไป ";
                        document.getElementById("referlocationid").innerHTML = text_referlocation;

                }else{
                        document.getElementById("referlocationid").style.display = "none"
                }

                
                if (cardriverid==null || cardriverid==''){      
                        document.getElementById("cardriverid").style.display = "";     
                        text_cardriverid= "*กรุณาระบุพนักงานขับ";
                        document.getElementById("cardriverid").innerHTML = text_cardriverid;

                }else{
                        document.getElementById("cardriverid").style.display = "none"
                }
               

if(carid==null || carid=='' || outdate==null || outdate=='' || outtime==null || outtime=='' || 
backdate==null || backdate=='' || backtime==null || backtime=='' || carid==null || carid=='' ||
referlocation==null || referlocation=='' || cardriverid==null || cardriverid=='')
{
alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
return false;   
}


});



function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}


function carcallcheckdate(){
        var date_bigen=document.getElementById("OUT_DATE").value;     
        var date_end=document.getElementById("BACK_DATE").value;
      

        var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('car.carcallcheckdate')}}",
                     method:"GET",
                     data:{date_bigen:date_bigen,date_end:date_end,_token:_token},
                     success:function(result){
                        $('.checkdat').html(result);
                     }
             })
             }  
  
</script>


@endsection