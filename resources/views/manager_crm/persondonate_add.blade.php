@extends('layouts.crm')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      
      
      .form-control{
    font-size: 13px;
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
<center>
    <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
        

                <div class="block-header block-header-default">
                    <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>เพิ่มทะเบียนผู้บริจาค</B></h3>
                    &nbsp;&nbsp;
              
                    <a href="{{ url('manager_crm/persondonate')  }}"   class="btn btn-hero-sm btn-hero-success foo15" ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
                </div>  

        <div class="block-content block-content-full">
                <form method="post" action="{{ route('mcrm.persondonate_save') }}">
                        @csrf

                        <input value="{{$id_user}}" type="hidden" name = "DONATE_PERSON_USER_ID"  id="DONATE_PERSON_USER_ID" class="form-control input-lg"  >  

                        <div class="row push text-left">

                        <div class="col-sm-1">
                        <label>ชื่อผู้บริจาค :</label>
                        </div> 
                        <div class="col-lg-5 ">              
                        <input  name="DONATE_PERSON_NAME" id="DONATE_PERSON_NAME" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" required>
                        </div> 
                        <div class="col-sm-2">
                        <label>เบอร์โทร :</label>
                        </div> 
                        <div class="col-lg-4 ">
                        <input name="DONATE_PERSON_TEL" id="DONATE_PERSON_TEL" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" >
                        </div> 
                        </div>

                        <div class="row push text-left">
                        <div class="col-sm-1">
                        <label>เลขบัตรประชาชน:</label>
                        </div> 
                        <div class="col-lg-5 ">
                        <input name="DONATE_PERSON_CID" id="DONATE_PERSON_CID" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" >
                        </div> 
                        <div class="col-sm-2">
                        <label>วัน/เดือน/ปีเกิด :</label>
                        </div> 
                        <div class="col-lg-4 ">
                        <input name="DONATE_BIRTH_DATE" id="DONATE_BIRTH_DATE" class="form-control input-lg datepicker foo13" data-date-format="mm/dd/yyyy"  value="{{formate(date('Y-m-d'))}}" readonly>
                        </div>
                        </div>

                        <div class="row push text-left">
                        <div class="col-sm-1">
                        <label>อีเมล :</label>
                        </div> 
                        <div class="col-lg-5 ">
                        <input name="DONATE_PERSON_EMAIL" id="DONATE_PERSON_EMAIL" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">
                        </div> 
                        <div class="col-sm-2">
                        <label>Line :</label>
                        </div> 
                        <div class="col-lg-4 ">
                        <input name="DONATE_PERSON_LINE" id="DONATE_PERSON_LINE" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" >
                        </div>
                        </div>

                        <div class="row push text-left">
                        <div class="col-sm-1">
                        <label>เลขผู้สียภาษี :</label>
                        </div> 
                        <div class="col-lg-5">
                        <input name="DONATE_PERSON_VAT_NO" id="DONATE_PERSON_VAT_NO" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" >  
                        </div> 
                        <div class="col-sm-2">
                        <label>วันที่ลงทะเบียน :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="DONATE_PERSON_DATE" id="DONATE_PERSON_DATE" class="form-control input-sm datepicker foo13" data-date-format="mm/dd/yyyy" value="{{formate(date('Y-m-d'))}}" readonly>
                        </div> 
                        </div>

                        <div class="row push text-left">
                        <div class="col-sm-1">
                        <label>บ้านเลขที่ :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="DONATE_PERSON_NO_HOME" id="DONATE_PERSON_NO_HOME" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" >  
                        </div>       
                        <div class="col-sm-1">
                        <label>ถนน :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="DONATE_PERSON_ROAD" id="DONATE_PERSON_ROAD" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">  
                        </div> 
                        <div class="col-sm-2">
                        <label>หมู่ :</label>
                        </div> 
                        <div class="col-lg-1">
                        <input name="DONATE_PERSON_MOO" id="DONATE_PERSON_MOO" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" >  
                        </div> 
                        <div class="col-sm-1">
                        <label>บ้าน :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="DONATE_PERSON_BAN" id="DONATE_PERSON_BAN" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" >  
                        </div> 
                        </div>

                        <div class="row push text-left">
                        <div class="col-sm-1">
                        <label>จังหวัด :</label>
                        </div> 
                        <div class="col-lg-5 ">


                        <select name="DONATE_PERSON_PROVINCE" id="PROVIDONATE_PERSON_PROVINCECE_NAME" class="form-control input-lg js-example-basic-single provice" style=" font-family: 'Kanit', sans-serif;" >
                                <option value="" >--กรุณาเลือกจังหวัด--</option>
                                @foreach ($infoprovinces as $infoprovince)
                                <option value=" {{ $infoprovince -> ID }}" >{{ $infoprovince -> PROVINCE_NAME }}</option>
                                @endforeach         
                        </select>

                        </div>
                        <div class="col-sm-2">
                        <label>อำเภอ :</label>
                        </div> 
                        <div class="col-lg-4 ">

                        <select name="DONATE_PERSON_AMPHER" id="DONATE_PERSON_AMPHER" class="form-control input-lg js-example-basic-single amphures" style=" font-family: 'Kanit', sans-serif;" >
                                <option value="">--กรุณาเลือกอำเภอ--</option>
                        </select>

                        </div> 
                        </div>
                        <div class="row push text-left">
                        <div class="col-sm-1">
                        <label>ตำบล :</label>
                        </div> 
                        <div class="col-lg-5 ">

                        <select name="DONATE_PERSON_TUMBON" id="DONATE_PERSON_TUMBON" class="form-control input-lg js-example-basic-single tumbon" style=" font-family: 'Kanit', sans-serif;" >
                                                                                                        <option value="" >--กรุณาเลือกตำบล--</option>
                                                                                                </select>
                        </div> 
                        <div class="col-sm-2">
                        <label>รหัสไปรษณีย์ :</label>
                        </div> 
                        <div class="col-lg-4 ">
                        <input name="DONATE_PERSON_POST" id="DONATE_PERSON_POST" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" >
                        </div>
                        </div>


                        
                        </div>
                      
                        <div class="modal-footer">
                        <div align="right">
                        <button type="submit"  class="btn btn-hero-sm btn-hero-info foo14" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                        <a href="{{ url('manager_crm/persondonate')  }}" class="btn btn-hero-sm btn-hero-danger foo14" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                        </div>



                        
    
  
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    <script src="{{ asset('select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<script>

$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


     
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


</script>

@endsection