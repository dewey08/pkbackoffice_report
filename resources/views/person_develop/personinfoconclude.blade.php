@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />


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
      }  

      input::-webkit-calendar-picker-indicator{ 
  
    font-family: 'Kanit', sans-serif;
            font-size: 14px;
         
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


?>

<body onload="run01();">
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div>
                                <a href="{{ url('person_dev/persondevinfo/'.$inforpersonuserid -> ID)}}" class="btn btn-primary" >ข้อมูลฝึกอบรม</a> 
                                </div>
                                <div>&nbsp;</div>  
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">สรุปรายงานการอบรม<label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่รายงานการอบรม {{ DateThai(date("Y-m-d"))}}</label></h2> 
                        
        <form  method="post" action="{{ route('perdev.saveconclude') }}"  enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="RECORD_ID" id="RECORD_ID"  value="{{ $infoconclude->ID }}">
        <input type="hidden" name="RECORD_NAME" id="RECORD_NAME"  value="{{ $infoconclude->RECORD_HEAD_USE }}">
        <input type="hidden" name="OWN_ID" id="OWN_ID"  value="{{ $infoconclude->USER_POST }}">
        <input type="hidden" name="OWN_NAME" id="OWN_NAME"  value="{{ $infoconclude->USER_POST_NAME }}">
        <input type="hidden" name="OWN_POSITION" id="OWN_POSITION"  value="{{ $infoconclude->USER_POST_POSITION }}">
        <input type="hidden" name="OWN_DEP" id="OWN_DEP"  value="{{ $infoconclude->USER_POST_DEPART }}">
        <input type="hidden" name="RECORD_TYPE_NAME" id="RECORD_TYPE_NAME"  value="{{ $infoconclude->RECORD_TYPE_NAME }}">
        <input type="hidden" name="RECORD_ORG_NAME" id="RECORD_ORG_NAME"  value="{{ $infoconclude->RECORD_ORGANIZER_NAME }}">
        <input type="hidden" name="LOCATION_NAME" id="LOCATION_NAME"  value="{{ $infoconclude->LOCATION_ORG_NAME }}">
        <input type="hidden" name="DATE_GO" id="DATE_GO"  value="{{ $infoconclude->DATE_GO }}">
        <input type="hidden" name="DATE_BACK" id="DATE_BACK"  value="{{ $infoconclude->DATE_BACK }}">

        <input type="hidden"  name="MONEYSUM" id="MONEYSUM"  value="{{ $summonney }}">
        <input type="hidden" name="WITHDRAW" id="WITHDRAW" value="{{ $infoconclude->WITHDRAW_ID }}">

        
        <input type="hidden" name="LEADER_ID" id="LEADER_ID"  value="{{ $infoconclude->LEADER_HR_ID }}">
        <input type="hidden" name="LEADER_NAME" id="LEADER_NAME"  value="{{ $infoconclude->LEADER_HR_NAME }}">

       
       <div class="row">
       <div class="col-sm-2">
        <label>รายงานหัวข้อ :</label>
        </div> 
        <div class="col-lg-10">      
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $infoconclude->RECORD_HEAD_USE }}</h1>                               
          
       </div>
       </div>

       <div class="row">
       <div class="col-sm-2">
        <label>ข้าพเจ้า :</label>
        </div> 
        <div class="col-lg-5">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $infoconclude->USER_POST_NAME }}</h1>   
       
        </div>
        <div class="col-sm-1">
        <label>ตำแหน่ง :</label>
        </div> 
        <div class="col-lg-4">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $infoconclude->USER_POST_POSITION }}</h1> 
       
        </div>
      
        </div>

       <div class="row">

       <div class="col-sm-2">
        <label>สังกัด :</label>
        </div> 
        <div class="col-lg-10">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $infoconclude->USER_POST_DEPART }}</h1> 
        
        </div> 
       
       </div>


       <div class="row">
       <div class="col-sm-2">
        <label>ตามหนังสือเลขที่ :</label>
        </div> 
        <div class="col-lg-5">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">&nbsp;</h1> 
        <input type="hidden" name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-sm-1">
        <label>ลงวันที่ :</label>
        </div> 
        <div class="col-lg-4">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">&nbsp;</h1> 
        <input type="hidden" name="" id="" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
        </div> 
       </div>

       <div class="row">
       <div class="col-sm-2">
        <label>ได้เข้าร่วม :</label>
        </div> 
        <div class="col-lg-10">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $infoconclude->RECORD_TYPE_NAME }}</h1> 
        
       </div>
      
       </div>

       <div class="row">
       <div class="col-sm-2">
        <label>จัดโดย :</label>
        </div> 
        <div class="col-lg-5">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $infoconclude->RECORD_ORGANIZER_NAME }}</h1> 
       
       </div>
       <div class="col-sm-1">
       <label>สถานที่ :</label>
        </div> 
        <div class="col-lg-4">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $infoconclude->LOCATION_ORG_NAME }}</h1> 
       
       </div>
       </div>

       <div class="row">
       <div class="col-sm-2">
        <label>ระหว่างวันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($infoconclude->DATE_GO) }}</h1> 
        
        </div> 
        <div class="col-sm-1">
        <label>ถึงวันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($infoconclude->DATE_BACK) }}</h1> 
       
        </div> 
        <div class="col-sm-1">
        <label>เบิกเงิน :</label>
        </div> 
        <div class="col-lg-1">
        <div id="money" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$summonney}}</div>
        </div>
        <div class="col-sm-1">
        <label>บาท</label>
        </div> 
       </div>

       <div class="row">    
        <div class="col-sm-2">
        <label>การเบิกเงิน :</label>
        </div> 
        <div class="col-lg-4">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $infoconclude->WITHDRAW_NAME }}</h1> 
        
        </div>
        <div class="col-sm-2">
        <label>หัวหน้าผู้รับรอง :</label>
        </div> 
        <div class="col-lg-3">
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $infoconclude->LEADER_HR_NAME }}</h1> 
        <input type="hidden" name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infoconclude->LEADER_HR_NAME }}">
       </div> 
        </div> 
       
      
        
     
        

        
      
      
       <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #E6E6FA;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">คณะเดินทาง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">วัตถุประสงค์</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">สาระสำคัญ</a>
                                    </li>      
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ค่าใช้จ่าย</a>
                                    </li>                             
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object7" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;">สรุปการอบรม</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object8" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;">ความรู้ที่ได้</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object9" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;">การนำไปใช้ประโยชน์</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object10" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;">เอกสารที่ได้รับ</a>
                                    </li>
                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                      
                                     <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">ชื่อ สกุล</td>
                                                <td style="text-align: center;border: 1px solid black;" width="30%">ตำแหน่ง</td>
                                                <td style="text-align: center;border: 1px solid black;" width="15%">ระดับ</td>
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                    <?php $checkper = 0; ?>
                                    @foreach ($infoconcludepersons as $infoconcludeperson)   
                                    
                                    <tr>
                                        <td> 
                                        <select name="PERSON_ID[]" id="PERSON_ID{{$checkper}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition({{$checkper}});checklevel({{$checkper}})">
                                                        <option value="">--กรุณาเลือกผู้ร่วมเดินทาง--</option>
                                                            @foreach ($PERSONALLs as $PERSONALL) 
                                                            @if($infoconcludeperson->HR_PERSON_ID == $PERSONALL ->ID)                                                    
                                                                <option value="{{ $PERSONALL ->ID  }}" selected>{{ $PERSONALL->HR_PREFIX_NAME}}{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                            @else
                                                            <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_PREFIX_NAME}}{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>
                                        </td>
                                        <td><div class="showposition{{$checkper}}"></div></td>
                                        <td><div class="showlevel{{$checkper}}"></div></td>
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
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
                                                <td style="text-align: center;border: 1px solid black;">วัตถุประสงค์ในการอบรมครั้งนี้</td>
     
                                                <td style="text-align: center;border: 1px solid black;" width="15%"><a  class="btn btn-success addRow2" style="color:#FFFFFF;"><i class=" fa fa-plus "></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody2">   
                                    <tr>
                                        <td> 
                                        <input name="OBJECTIVE_NAME[]" id="OBJECTIVE_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                      
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-danger remove2" style="color:#FFFFFF;"><i class=" fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    </tbody>   
                                    </table>
                                    </div>
                                    <div class="tab-pane" id="object3" role="tabpanel">
                                       
                                        <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">สาระสำคัญในการอบรม</td>
     
                                                <td style="text-align: center;border: 1px solid black;" width="15%"><a  class="btn btn-success addRow3" style="color:#FFFFFF;"><i class=" fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody3">   
                                    <tr>
                                        <td> 
                                        <input name="IMPORTANT_NAME[]" id="IMPORTANT_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                     
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    </tbody>   
                                    </table>
                                    </div>
                              
                                    <div class="tab-pane" id="object5" role="tabpanel">
                                  
                                    <table class="table gwt-table">
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">รายการ</td>
                                                <td style="text-align: center;border: 1px solid black;" width="15%">จำนวนเงิน</td>
                                                <td style="text-align: center;border: 1px solid black;" width="30%" >หมายเหตุ</td>
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success addRow5" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody5">  
                                        
                                    @foreach ($infoconcludemoneys as $infoconcludemoney) 
                                    <tr>
                                       <td> <select name="MONEY_TYPE_ID[]" id="MONEY_TYPE_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                
                                                            @foreach ($moneysets as $moneyset)  
                                                                @if($infoconcludemoney->MONEY_ID == $moneyset ->MONEY_ID)                                                   
                                                                <option value="{{ $moneyset ->MONEY_ID  }}" selected>{{ $moneyset->MONEY_NAME}}</option>
                                                                @else
                                                                <option value="{{ $moneyset ->MONEY_ID  }}">{{ $moneyset->MONEY_NAME}}</option>
                                                                @endif
                                                            @endforeach 
                                         </select> </td>  
                                        <td> <input name="MONEY[]" id="MONEY[]" class="form-control input-lg items" style=" font-family: 'Kanit', sans-serif;" onkeyup="callmoney()" value="{{$infoconcludemoney->SUMMONEY}}"></td>
                                        <td> <input name="DETAILMONEY[]" id="DETAILMONEY[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"></td>
                                       
                                        <td style="text-align: center;"><a class="btn btn-danger remove5" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    
                                    </tr>
                                    @endforeach 
                                    </tbody>   
                                    </table>

                                  

                                    </div>
                                   
                                    <div class="tab-pane" id="object7" role="tabpanel">
                                       
                                        <textarea name="DETAIL" id="DETAIL" rows="4" cols="50" class="form-control" style=" font-family: 'Kanit', sans-serif;background-color: #F0F8FF;">

                                        </textarea>
                                        <br>
                                    </div>
                                    
                                    
                                    <div class="tab-pane" id="object8" role="tabpanel">
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">ความรู้ที่ได้</td>
     
                                                <td style="text-align: center;border: 1px solid black;" width="15%"><a  class="btn btn-success addRow8" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody8">   
                                    <tr>
                                        <td> 
                                        <input name="KNOWLEDGE_NAME[]" id="KNOWLEDGE_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                     
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-danger remove8" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    </tbody>   
                                    </table>
                                   
                                   </div>
                                   <div class="tab-pane" id="object9" role="tabpanel">
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">การนำไปใช้</td>
                                                <td style="text-align: center;border: 1px solid black;">รายละเอียดหรือตัวอย่าง</td>
     
                                                <td style="text-align: center;border: 1px solid black;" width="15%"><a  class="btn btn-success addRow9" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody9">   
                                    <tr>
                                        <td> 
                                        <input name="BENEFIT_NAME[]" id="BENEFIT_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >                                        
                                        </td>
                                        <td> 
                                        <input name="BENEFIT_EX[]" id="BENEFIT_EX[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >                                        
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-danger remove9" style="color:#FFFFFF;"><i class=" fa fa-trash-alt "></i></a></td>
                                    </tr>
                                    </tbody>   
                                    </table>
                                   
                                   </div>

                                   <div class="tab-pane" id="object10" role="tabpanel">
                                   
                                   <div class="row">    
                                    <div class="col-sm-6" style="background-color: #F0F8FF;">
                                    <div class="form-group">
                                        <br>
                                    <center><canvas  height="100%" width="100%"/></center>
                                    </div>  
                                    </div> 
                                    <div class="col-sm-5">                          
                                     <div class="form-group">
                                    <input type="file" name="pdfupload" id="pdfupload" class="form-control">
                                    </div>
                                    </div>
                                    </div>
                                   </div>
                                   
                                </div>
                            </div>
        </div>

       </div>

      


       <input type="hidden" name ="PERSON_ID_CREATE" id="PERSON_ID_CREATE" class="form-control input-lg" value="{{$inforpersonuserid -> ID }}">

        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="{{ url('person_dev/persondevinfo/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการสรุป ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
               
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf.js') }}"></script>
<script src="{{ asset('pdfupload/pdf.worker.js') }}"></script>

<script>
    
    function vehicle(){
      
        var type_vehicle=document.getElementById("RECORD_VEHICLE_ID");
        var type_vehicle_id = type_vehicle.options[type_vehicle.selectedIndex].value;
        //alert(type_vehicle_id);
        
            var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('perdev.vehicle')}}",
                     method:"GET",
                     data:{type_vehicle_id:type_vehicle_id,_token:_token},
                     success:function(result){
                        $('.vehicle_re').html(result);
                     }
             })

    }
    //===============================เพิ่มสถานที่====================================
    function addlocation(){
      
      var record_location=document.getElementById("ADD_RECORD_LOCATION").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.addlocation')}}",
                   method:"GET",
                   data:{record_location:record_location,_token:_token},
                   success:function(result){
                      $('.location_re').html(result);
                   }
           })

  }
//===============================เพิ่มหน่วยงาน====================================


  function addorg(){
      
      var record_org=document.getElementById("ADD_RECORD_ORG").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.addorg')}}",
                   method:"GET",
                   data:{record_org:record_org,_token:_token},
                   success:function(result){
                      $('.org_re').html(result);
                   }
           })

  }
//======================หาตำแหน่งผู้เดินทาง===========================
function run01(){
    var count = $('.tbody1').children('tr').length;
    //alert(count);
    var number;
        for (number = 0; number < count; number++) { 
            checkposition(number);
            checklevel(number);
        }

}

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
  //========================รวมค่าใช้จ่าย=============================
  function callmoney(){
    
    var items = document.getElementsByClassName("items");
    var itemCount = items.length;
    var total = 0;
    for(var i = 0; i < itemCount; i++)
    {
        total = total +  parseFloat(items[i].value);
    }

    totals = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    document.getElementById("money").innerHTML = totals;
    document.getElementById("MONEYSUM").value = total;
  
}


    //------------------------------------------

    $('.provice').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetch')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.amphures').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.amphures').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetchsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.tumbon').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.provice_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetch')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.amphures_sub').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.amphures_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetchsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.tumbon_sub').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     //----------------แสดงข้อมูลกิโลเมตร--------------------------
     function showdistance(){
       
        var distance = document.getElementById("DISTANCE").value;
        distances = distance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        document.getElementById("distance").innerHTML = distances;
     }  
     
     function showdistancemon(){
       
       var distance = document.getElementById("DISTANCE").value;
       var unitdis = document.getElementById("UNITDIS").value;

       moneydistance = distance * unitdis;
      
       //alert(moneydistances);
      
       moneydistances = moneydistance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   
       document.getElementById("moneydistance").innerHTML = moneydistances;

      
    }

   
</script>

<script>
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
                '<option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_PREFIX_NAME}}{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+
                '<td><div class="showposition'+count+'"></div></td>'+
                '<td><div class="showlevel'+count+'"></div></td>'+
                '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class=" fa fa-trash-alt"></i></a></td>'+
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
                  ' <input name="OBJECTIVE_NAME[]" id="OBJECTIVE_NAME[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                  '</td>'+                      
                '<td style="text-align: center;"><a class="btn btn-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
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
                  '<input name="IMPORTANT_NAME[]" id="IMPORTANT_NAME[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+                                         
                  '</td>'+                           
                  '<td style="text-align: center;"><a class="btn btn-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                 '</tr>';
        $('.tbody3').append(tr);
       
     };

     $('.tbody3').on('click','.remove3', function(){
            $(this).parent().parent().remove();
     });
//-------------------------------------
$('.addRow4').on('click',function(){
         addRow4();
     });

     function addRow4(){
       
    
         var tr = '<tr>'+
                  '<td>'+ 
                  '<input name="HIS[]" id="HIS[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+                          
                  '</td>'+                           
                  '<td style="text-align: center;"><a class="btn btn-danger remove4" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                 '</tr>';
        $('.tbody4').append(tr);
       
     };

     $('.tbody4').on('click','.remove4', function(){
            $(this).parent().parent().remove();
     });

//-------------------------------------------------
     $('.addRow5').on('click',function(){
         addRow5();
     });

     function addRow5(){
         var tr ='<tr>'+
                '<td><select name="MONEY_TYPE_ID[]" id="MONEY_TYPE_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="">--กรุณาเลือกรายการ--</option>'+
                '@foreach ($moneysets as $moneyset)'+                                                     
                '<option value="{{ $moneyset ->MONEY_ID  }}">{{ $moneyset->MONEY_NAME}}</option>'+
                 '@endforeach'+
                '</select></td>'+
                '<td> <input name="MONEY[]" id="MONEY[]" class="form-control input-lg items" style=" font-family: \'Kanit\', sans-serif;" onkeyup="callmoney()"></td>'+
                '<td> <input name="DETAILMONEY[]" id="DETAILMONEY[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" ></td>'+
                
                '<td style="text-align: center;"><a class="btn btn-danger remove5" style="color:#FFFFFF;" ><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody5').append(tr);
     };

     $('.tbody5').on('click','.remove5', function(){
            $(this).parent().parent().remove();
            callmoney();
     });

//-------------------------------------------------
$('.addRow6').on('click',function(){
         addRow6();
     });

     function addRow6(){
    
         var tr = '<tr>'+
                  '<td>'+ 
                  '<input name="MAT[]" id="MAT[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+                          
                  '</td>'+                           
                  '<td style="text-align: center;"><a class="btn btn-danger remove6" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                 '</tr>';
        $('.tbody6').append(tr);
       
     };

     $('.tbody6').on('click','.remove6', function(){
            $(this).parent().parent().remove();
     });

//-------------------------------------------------
$('.addRow8').on('click',function(){
         addRow8();
     });

     function addRow8(){
    
         var tr = '<tr>'+
                  '<td>'+ 
                  '<input name="KNOWLEDGE_NAME[]" id="KNOWLEDGE_NAME[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+                          
                  '</td>'+                           
                  '<td style="text-align: center;"><a class="btn btn-danger remove8" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                 '</tr>';
        $('.tbody8').append(tr);
       
     };

     $('.tbody8').on('click','.remove8', function(){
            $(this).parent().parent().remove();
     });

//-------------------------------------------------
$('.addRow9').on('click',function(){
         addRow9();
     });

     function addRow9(){
    
         var tr = '<tr>'+
                  '<td>'+ 
                  '<input name="BENEFIT_NAME[]" id="BENEFIT_NAME[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+                          
                  '</td>'+ 
                  '<td>'+ 
                  '<input name="BENEFIT_EX[]" id="BENEFIT_EX[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+                          
                  '</td>'+                           
                  '<td style="text-align: center;"><a class="btn btn-danger remove9" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                 '</tr>';
        $('.tbody9').append(tr);
       
     };

     $('.tbody9').on('click','.remove9', function(){
            $(this).parent().parent().remove();
     });

//-------------------------------------------------
</script>


<script>
     $(document).ready(function () {
            var i = 1;
            $('#add').click(function(){
                i++;
                $('dynamic_fileld').append('<tr id="row'+i+'"><td> <input name="name[]" id="name[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" ></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click','.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('row'+button_id+'').remove();
            });
           
    });


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



//---------------------------------------------------------------------------------

document.querySelector("#pdfupload").addEventListener("change", function(e){
	var canvasElement = document.querySelector("canvas")
	var file = e.target.files[0]
	if(file.type != "application/pdf"){
		console.error(file.name, "is not a pdf file.")
		return
	}
	
	var fileReader = new FileReader();  

	fileReader.onload = function() {
		var typedarray = new Uint8Array(this.result);

		PDFJS.getDocument(typedarray).then(function(pdf) {
			// you can now use *pdf* here
			console.log("the pdf has ",pdf.numPages, "page(s).")
			pdf.getPage(pdf.numPages).then(function(page) {
				// you can now use *page* here
				var viewport = page.getViewport(0.8);
				var canvas = document.querySelector("canvas")
				canvas.height = viewport.height;
				canvas.width = viewport.width;


				page.render({
					canvasContext: canvas.getContext('2d'),
					viewport: viewport
				});
			});

		});
	};

	fileReader.readAsArrayBuffer(file);
})
  
</script>





@endsection