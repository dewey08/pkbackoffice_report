@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />


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


use App\Http\Controllers\OperateController;

        $checkver = OperateController::checkoperate_ver($user_id);
        $checkallow =  OperateController::checkoperate_allow($user_id);


?>

<body onload="checkpositionver1();checkpositionver2();run01();">           
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
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลเวร</h2> 
                        
        <form  method="post" action="{{ route('operate.updateoperate') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="row push">
       <div class="col-sm-2">
        <label>ประจำเดือน:</label>
        </div> 
        <div class="col-lg-4">
    
        <select name="OPERATE_INDEX_MONTH" id="OPERATE_INDEX_MONTH" class="form-control input-lg org_re" style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกเดือน--</option>
                            @if($infooperate->OPERATE_INDEX_MONTH == '1')<option value="1" selected>มกราคม</option>@else<option value="1">มกราคม</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '2')<option value="2" selected>กุมภาพันธ์</option>@else<option value="2">กุมภาพันธ์</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '3')<option value="3" selected>มีนาคม</option>@else<option value="3">มีนาคม</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '4')<option value="4" selected>เมษายน</option>@else<option value="4">เมษายน</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '5')<option value="5" selected>พฤษภาคม</option>@else<option value="5">พฤษภาคม</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '6')<option value="6" selected>มิถุนายน</option>@else<option value="6">มิถุนายน</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '7')<option value="7" selected>กรกฎาคม</option>@else<option value="7">กรกฎาคม</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '8')<option value="8" selected>สิงหาคม</option>@else<option value="8">สิงหาคม</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '9')<option value="9" selected>กันยายน</option>@else<option value="9">กันยายน</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '10')<option value="10" selected>ตุลาคม</option>@else<option value="10">ตุลาคม</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '11')<option value="11" selected>พฤศจิกายน</option>@else<option value="11">พฤศจิกายน</option>@endif
                            @if($infooperate->OPERATE_INDEX_MONTH == '12')<option value="12" selected>ธันวาคม</option>@else<option value="12">ธันวาคม</option>@endif
                  
                            
        </select>    
       
       </div>
       <div class="col-sm-2">
        <label>ปีพุทธศักราช :</label>
        </div> 
        <div class="col-lg-4">

          <select name="OPERATE_INDEX_YEAR" id="OPERATE_INDEX_YEAR" class="form-control input-lg org_re" style=" font-family: 'Kanit', sans-serif;">
               
                            @foreach ($infobudgets as $infobudget )  
                                 @if($infobudget->LEAVE_YEAR_ID - 543 == $infooperate->OPERATE_INDEX_YEAR)                 
                                    <option value="{{$infobudget->LEAVE_YEAR_ID - 543}}" selected>{{$infobudget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{$infobudget->LEAVE_YEAR_ID - 543}}">{{$infobudget->LEAVE_YEAR_ID}}</option> 
                                @endif
                            @endforeach                                  
                
                            
        </select>    

       </div>
       </div>
       <div class="row push">
     
       <div class="col-sm-2">
        <label>หน่วยงาน :</label>
        </div> 
        <div class="col-lg-4">  
       
        <select name="OPERATE_DEPARTMENT_ID" id="OPERATE_DEPARTMENT_ID" class="form-control input-lg org_re" style=" font-family: 'Kanit', sans-serif;" onchange="member();">
        <option value=" " selected>--กรุณาเลือกหน่วยงาน--</option>
                            @foreach ($infodepartments as $infodepartment) 
                                @if($infooperate->OPERATE_DEPARTMENT_ID == $infodepartment -> HR_DEPARTMENT_SUB_SUB_ID)
                                <option value="{{ $infodepartment -> HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{ $infodepartment -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>           
                                @else
                                <option value="{{ $infodepartment -> HR_DEPARTMENT_SUB_SUB_ID }}">{{ $infodepartment -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>           
                                @endif
                            @endforeach 
        </select>    
    </div>
    <div class="col-sm-2"> 
        <label>ประเภทเวร :</label>
    </div>
    <div class="col-sm-4">
        <select name="OPERATE_TYPE" id="OPERATE_TYPE" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
            <option value="0">--กรุณาเลือกประเภท--</option>
            @foreach ($infotypes as $infotype) 
               @if($infotype->OPERATE_TYPE_ID == $infooperate->OPERATE_TYPE)
               <option value="{{$infotype->OPERATE_TYPE_ID}}" selected>{{$infotype->OPERATE_TYPE_NAME}}</option>
               @else
                <option value="{{$infotype->OPERATE_TYPE_ID}}">{{$infotype->OPERATE_TYPE_NAME}}</option>
                @endif
        @endforeach 
            
        </select>  
    </div> 
       
     
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>ผู้จัดเวร :</label>
        </div> 
        <div class="col-lg-4">
        <label>{{ $infooperate->OPERATE_ORGANIZER_NAME }}</label>
        <input type="hidden" name="OPERATE_ORGANIZER_ID" id="OPERATE_ORGANIZER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infooperate->OPERATE_ORGANIZER_ID }}">           
        <input type="hidden" name="OPERATE_ORGANIZER_NAME" id="OPERATE_ORGANIZER_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infooperate->OPERATE_ORGANIZER_NAME }}" >           
       </div>
       <div class="col-sm-2">
        <label>ตำแหน่ง :</label>
        </div> 
        <div class="col-lg-4">
        <label>{{ $infooperate -> POSITION_IN_WORK }}</label>
       </div>
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>ผู้ตรวจสอบคนที่1 :</label> 
        </div> 
        <div class="col-lg-4">
     
        <select name="OPERATE_VERIFY_1_ID" id="OPERATE_VERIFY_1_ID" class="form-control input-lg org_re" style=" font-family: 'Kanit', sans-serif;" onchange="checkpositionver1();">
        <option value=" " selected>--กรุณาเลือกผู้ตรวจสอบคนที่1--</option>
                            @foreach ($inforpersons as $inforperson)   
                                    @if( $infooperate -> OPERATE_VERIFY_1_ID == $inforperson -> ID)
                                    <option value="{{ $inforperson -> ID }}" selected>{{ $inforperson -> HR_FNAME }}  {{ $inforperson -> HR_LNAME }}</option>           
                                    @else
                                    <option value="{{ $inforperson -> ID }}">{{ $inforperson -> HR_FNAME }}  {{ $inforperson -> HR_LNAME }}</option>                               
                                    @endif
                            @endforeach 
        </select>    
       
       </div>
       <div class="col-sm-2">
        <label>ตำแหน่ง :</label>
        </div> 
        <div class="col-lg-4">
        <div class="ver1_showposition"></div>
       </div>
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>ผู้ตรวจสอบคนที่2 :</label>
        </div> 
        <div class="col-lg-4">
       
        <select name="OPERATE_VERIFY_2_ID" id="OPERATE_VERIFY_2_ID" class="form-control input-lg org_re" style=" font-family: 'Kanit', sans-serif;" onchange="checkpositionver2();">
        <option value=" " selected>--กรุณาเลือกผู้ตรวจสอบคนที่2--</option>
                            @foreach ($inforpersons as $inforperson)
                                    @if($infooperate -> OPERATE_VERIFY_2_ID == $inforperson -> ID)                    
                                    <option value="{{ $inforperson -> ID }}" selected>{{ $inforperson -> HR_FNAME }}  {{ $inforperson -> HR_LNAME }}</option>           
                                    @else
                                    <option value="{{ $inforperson -> ID }}">{{ $inforperson -> HR_FNAME }}  {{ $inforperson -> HR_LNAME }}</option>           
                                    @endif

                            @endforeach 
        </select>    
       </div>
       <div class="col-sm-2">
        <label>ตำแหน่ง :</label>
        </div> 
        <div class="col-lg-4">
        <div class="ver2_showposition"></div>
       </div>
       </div>
       <div class="row push">
       <div class="col-sm-2">
        <label>ผู้อำนวยการ :</label>
        </div> 
        <div class="col-lg-4">
        <label>{{ $infoorg -> HR_PREFIX_NAME }} {{ $infoorg -> HR_FNAME }} {{ $infoorg -> HR_LNAME }}</label>
        </div>
       <div class="col-sm-2">
        <label>ตำแหน่ง :</label>
        </div> 
        <div class="col-lg-4">
        <label>{{ $infoorg -> ORG_LEADER_POSITION }}</label> 
       </div>
       </div>


       <div class="row push">

       &nbsp;&nbsp;<h4 style=" font-family: 'Kanit', sans-serif;">สมาชิกในหน่วยงาน</h4>
       <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;  border: 1px solid black;">ลำดับ</td>
                                                <td style="text-align: center;  border: 1px solid black;">ชื่อ สกุล</td>
                                                <td style="text-align: center;  border: 1px solid black;" width="30%">ตำแหน่ง</td>
                                               
                                                <td style="text-align: center;  border: 1px solid black;"  border: 1px solid black; width="12%"><a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus "></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1">   
                                        <?php $checkper = 0; $number=1;?>
                                        @foreach ($infooperatemembers as $infooperatemember)
                                        <tr>
                                        <td style="text-align: center;" >{{$number}}</td>
                                        <td> 
                                        <select name="MEMBER_ID[]" id="MEMBER_ID{{$checkper}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition({{$checkper}});">
                                        <option value="">--กรุณาเลือกสมาชิก--</option>
                                                            @foreach ($inforpersons as $inforperson) 
                                                            @if($inforperson->ID == $infooperatemember ->OPERATE_MEMBER_PERSON_ID)                                                    
                                                            <option value="{{ $inforperson->ID }}" selected>{{$inforperson->HR_FNAME}} {{$inforperson->HR_LNAME}}</option>
                                                            @else
                                                            <option value="{{ $inforperson->ID }}">{{$inforperson->HR_FNAME}} {{$inforperson->HR_LNAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>    
                                        </td>
                                      
                                        <td><div class="showposition{{$checkper}}"></div></td>
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class=" fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $checkper++; $number++;?>               
                                        <input type="hidden" name="DATE_1[]" value="{{ $infooperatemember->DATE_1 }}">
                                        <input type="hidden" name="DATE_2[]" value="{{ $infooperatemember->DATE_2 }}">
                                        <input type="hidden" name="DATE_3[]" value="{{ $infooperatemember->DATE_3 }}">
                                        <input type="hidden" name="DATE_4[]" value="{{ $infooperatemember->DATE_4 }}">
                                        <input type="hidden" name="DATE_5[]" value="{{ $infooperatemember->DATE_5 }}">
                                        <input type="hidden" name="DATE_6[]" value="{{ $infooperatemember->DATE_6 }}">
                                        <input type="hidden" name="DATE_7[]" value="{{ $infooperatemember->DATE_7 }}">
                                        <input type="hidden" name="DATE_8[]" value="{{ $infooperatemember->DATE_8 }}">
                                        <input type="hidden" name="DATE_9[]" value="{{ $infooperatemember->DATE_9 }}">
                                        <input type="hidden" name="DATE_10[]" value="{{ $infooperatemember->DATE_10 }}">
                                        <input type="hidden" name="DATE_11[]" value="{{ $infooperatemember->DATE_11 }}">
                                        <input type="hidden" name="DATE_12[]" value="{{ $infooperatemember->DATE_12 }}">
                                        <input type="hidden" name="DATE_13[]" value="{{ $infooperatemember->DATE_13 }}">
                                        <input type="hidden" name="DATE_14[]" value="{{ $infooperatemember->DATE_14 }}">
                                        <input type="hidden" name="DATE_15[]" value="{{ $infooperatemember->DATE_15 }}">
                                        <input type="hidden" name="DATE_16[]" value="{{ $infooperatemember->DATE_16 }}">
                                        <input type="hidden" name="DATE_17[]" value="{{ $infooperatemember->DATE_17 }}">
                                        <input type="hidden" name="DATE_18[]" value="{{ $infooperatemember->DATE_18 }}">
                                        <input type="hidden" name="DATE_19[]" value="{{ $infooperatemember->DATE_19 }}">
                                        <input type="hidden" name="DATE_20[]" value="{{ $infooperatemember->DATE_20 }}">
                                        <input type="hidden" name="DATE_21[]" value="{{ $infooperatemember->DATE_21 }}">
                                        <input type="hidden" name="DATE_22[]" value="{{ $infooperatemember->DATE_22 }}">
                                        <input type="hidden" name="DATE_23[]" value="{{ $infooperatemember->DATE_23 }}">
                                        <input type="hidden" name="DATE_24[]" value="{{ $infooperatemember->DATE_24 }}">
                                        <input type="hidden" name="DATE_25[]" value="{{ $infooperatemember->DATE_25 }}">
                                        <input type="hidden" name="DATE_26[]" value="{{ $infooperatemember->DATE_26 }}">
                                        <input type="hidden" name="DATE_27[]" value="{{ $infooperatemember->DATE_27 }}">
                                        <input type="hidden" name="DATE_28[]" value="{{ $infooperatemember->DATE_28 }}">
                                        <input type="hidden" name="DATE_29[]" value="{{ $infooperatemember->DATE_29 }}">
                                        <input type="hidden" name="DATE_30[]" value="{{ $infooperatemember->DATE_30 }}">
                                        <input type="hidden" name="DATE_31[]" value="{{ $infooperatemember->DATE_31 }}">
                                        @endforeach 
                                    </tbody>   
                                    </table>

                                    </div>
        <input type="hidden" id="PERSON_ID" name="PERSON_ID" value="{{$inforpersonuserid -> ID}}">   
        <input type="hidden" id="OPERATE_INDEX_ID" name="OPERATE_INDEX_ID" value="{{$infooperate -> OPERATE_INDEX_ID}}"> 
                                 
                  
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="javascript:history.back()" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
               
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
 function run01(){
    $('select').select2();
    var count = $('.tbody1').children('tr').length;
    //alert(count);
    var number;
        for (number = 0; number < count; number++) { 
            checkposition(number);
            
        }
       
}   

//======================หาตำแหน่งผู้เดินทาง===========================

function checkpositionver1(){
      
    
      var OPERATE_VERIFY_1_ID=document.getElementById("OPERATE_VERIFY_1_ID").value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('operate.checkposition1')}}",
                   method:"GET",
                   data:{OPERATE_VERIFY_1_ID:OPERATE_VERIFY_1_ID,_token:_token},
                   success:function(result){
                      $('.ver1_showposition').html(result);
                   }
           })

        

  }

  function checkpositionver2(){
      
    
      var OPERATE_VERIFY_2_ID=document.getElementById("OPERATE_VERIFY_2_ID").value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('operate.checkposition2')}}",
                   method:"GET",
                   data:{OPERATE_VERIFY_2_ID:OPERATE_VERIFY_2_ID,_token:_token},
                   success:function(result){
                      $('.ver2_showposition').html(result);
                   }
           })

        

  }


  function member(){
      
    
      var OPERATE_DEPARTMENT_ID=document.getElementById("OPERATE_DEPARTMENT_ID").value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('operate.member')}}",
                   method:"GET",
                   data:{OPERATE_DEPARTMENT_ID:OPERATE_DEPARTMENT_ID,_token:_token},
                   success:function(result){
                      $('.tbody1').html(result);
                        var count = $('.tbody1').html(result).children('tr').length; 
                     // alert(count);  
                        var number;
                            for (number = 0; number < count; number++) { 
                            checkposition(number);   
                                }
                                $('select').select2();
                   }
           })

          
         
     

  }



  function checkposition(number){
      
    
      var MEMBER_ID=document.getElementById("MEMBER_ID"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('operate.checkposition')}}",
                   method:"GET",
                   data:{MEMBER_ID:MEMBER_ID,_token:_token},
                   success:function(result){
                      $('.showposition'+number).html(result);
                   }
           })

        

  }
  

  //========================รวมค่าใช้จ่าย=============================


     
</script>

<script>

$(document).ready(function() {
    $('select').select2();
});


     $('.addRow').on('click',function(){
         addRow();
         $('select').select2();
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
        var number = count+1;
         var tr ='<tr>'+
            '<td style="text-align: center;" >'+number+'</td>'+
                '<td>'+
                '<select name="MEMBER_ID[]" id="MEMBER_ID'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition('+count+');">'+
                '<option value="">--กรุณาเลือกสมาชิก--</option>'+
                '@foreach ($inforpositions as $inforposition)'+                                                   
                '<option value="{{ $inforposition ->ID  }}">{{ $inforposition->HR_FNAME}} {{$inforposition->HR_LNAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+ 
               
                '</td>'+
                '<td><div class="showposition'+count+'"></div></td>'+
                '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class=" fa fa-trash-alt"></i></a></td>'+
                '</tr>'+
                '<input type="hidden" name="DATE_1[]" value="">'+
                '<input type="hidden" name="DATE_2[]" value="">'+
                '<input type="hidden" name="DATE_3[]" value="">'+
                '<input type="hidden" name="DATE_4[]" value="">'+
                '<input type="hidden" name="DATE_5[]" value="">'+
                '<input type="hidden" name="DATE_6[]" value="">'+
                '<input type="hidden" name="DATE_7[]" value="">'+
                '<input type="hidden" name="DATE_8[]" value="">'+
                '<input type="hidden" name="DATE_9[]" value="">'+
                '<input type="hidden" name="DATE_10[]" value="">'+
                '<input type="hidden" name="DATE_11[]" value="">'+
                '<input type="hidden" name="DATE_12[]" value="">'+
                '<input type="hidden" name="DATE_13[]" value="">'+
                '<input type="hidden" name="DATE_14[]" value="">'+
                '<input type="hidden" name="DATE_15[]" value="">'+
                '<input type="hidden" name="DATE_16[]" value="">'+
                '<input type="hidden" name="DATE_17[]" value="">'+
                '<input type="hidden" name="DATE_18[]" value="">'+
                '<input type="hidden" name="DATE_19[]" value="">'+
                '<input type="hidden" name="DATE_20[]" value="">'+
                '<input type="hidden" name="DATE_21[]" value="">'+
                '<input type="hidden" name="DATE_22[]" value="">'+
                '<input type="hidden" name="DATE_23[]" value="">'+
                '<input type="hidden" name="DATE_24[]" value="">'+
                '<input type="hidden" name="DATE_25[]" value="">'+
                '<input type="hidden" name="DATE_26[]" value="">'+
                '<input type="hidden" name="DATE_27[]" value="">'+
                '<input type="hidden" name="DATE_28[]" value="">'+
                '<input type="hidden" name="DATE_29[]" value="">'+
                '<input type="hidden" name="DATE_30[]" value="">'+
                '<input type="hidden" name="DATE_31[]" value="">';
                
                
              
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
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




  
</script>



@endsection