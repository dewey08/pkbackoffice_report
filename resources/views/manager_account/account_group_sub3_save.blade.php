@extends('layouts.account')   
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
        }        
        .text-pedding{
    padding-left:10px;
                        }

            .text-font {
        font-size: 13px;
                    }   
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
<?php
    function RemoveDateThai($strDate)
    {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    }
    function Removeformate($strDate)
    {
    $strYear = date("Y",strtotime($strDate));
    $strMonth= date("m",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    
    return $strDay."/".$strMonth."/".$strYear;
    }
    
    function Removeformatetime($strtime)
    {
    $H = substr($strtime,0,5);
    return $H;
    }  
?>          
<!-- Advanced Tables -->
<br>
<br>
<br>

<center>
<div class="block" style="width: 95%;" >
    <div class="block block-rounded block-bordered">            
        <div class="block-content">    
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">หมวดบัญชีย่อย 4</h2>
            
<div class="block-content block-content-full" align="left">
<form  method="post" action="{{ route('maccount.account_group_sub3_update') }}" enctype="multipart/form-data">
@csrf

<div class="row push">
    <div class="col-sm-2">
    <label>หมวดบัญชีย่อยที่ 3  :</label>
    </div> 
    <div class="col-sm-4 ">              
  
    
    <select name="ACCOUNT_GROUP_SUB2_ID" id="ACCOUNT_GROUP_SUB2_ID" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกหมวดบัญชีย่อย 3--</option>
                            @foreach ($infoaccountgroupsub2s as $infoaccountgroupsub2)
                            <option value=" {{ $infoaccountgroupsub2 -> ACCOUNT_GROUP_SUB2_CODE }}" >{{ $infoaccountgroupsub2 -> ACCOUNT_GROUP_SUB2_NAME }}</option>
                            @endforeach         
    </select>
    
    </div> 
</div> 
<div class="row push">
    <div class="col-sm-2">
    <label>เลขที่หมวดบัญชีย่อยที่ 4 :</label>
    </div> 
    <div class="col-sm-4 ">              
    <input  name="ACCOUNT_GROUP_SUB3_CODE" id="ACCOUNT_GROUP_SUB3_CODE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
    </div> 
    <div class="col-sm-2">
    <label>ชื่อหมวดบัญชีย่อยที่ 4 :</label>
    </div> 
    <div class="col-sm-4 ">              
    <input  name="ACCOUNT_GROUP_SUB3_NAME" id="ACCOUNT_GROUP_SUB3_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
    </div> 

</div> 



 
<div class="modal-footer">
<div align="right">
<button type="submit"  class="btn btn-sm btn-info btn-lg" >บันทึกข้อมูล</button>
<a href="{{ url('manager_account/account_group_sub3')  }}" class="btn btn-sm btn-danger btn-lg" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มรายละเอียด ?')" >ยกเลิก</a>
</div>


@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

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


    
</script>


@endsection