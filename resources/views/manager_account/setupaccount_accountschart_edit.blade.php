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
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขรายละเอียดประเภทสมุดบัญชี</h2>
            
<div class="block-content block-content-full" align="left">
<form  method="post" action="{{ route('maccount.accountschart_update') }}" enctype="multipart/form-data">
@csrf



<input type="hidden"  name="ACCOUNT_CHART_ID" id="ACCOUNT_CHART_ID" value="{{$infoaccount->ACCOUNT_CHART_ID}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
       
      <!--  <div class="row push">
                <div class="col-sm-2">
                    <label>หมวดบัญชีบัญชี :</label>
                    </div> 
                    <div class="col-sm-4 ">              
                
                    <select name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                                        <option value="" >--กรุณาเลือกบัญชี--</option>
                                            @foreach ($infoaccountgroups as $infoaccountgroup)
                                            <option value=" {{ $infoaccountgroup -> ACCOUNT_GROUP_CODE }}" >{{ $infoaccountgroup -> ACCOUNT_GROUP_NAME }}</option>
                                            @endforeach         
                                        </select>
                    
                    </div> 
                    <div class="col-sm-2">
                        <label>เชื่อมโยงพัสดุ :</label>
                        </div> 
                        <div class="col-sm-4 ">              
                        <select name="ACCOUNT_CHART_SUPTYPEID" id="ACCOUNT_CHART_SUPTYPEID " class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($infosuptypes as $infosuptype) 
                                    $infoaccount->ACCOUNT_TYPE
                                         @if($infosuptype ->SUP_TYPE_ID == $infoaccount->ACCOUNT_CHART_SUPTYPEID)
                                            <option value="{{ $infosuptype ->SUP_TYPE_ID  }}" selected>{{ $infosuptype->SUP_TYPE_NAME}}</option>
                                            @else
                                            <option value="{{ $infosuptype ->SUP_TYPE_ID  }}">{{ $infosuptype->SUP_TYPE_NAME}}</option>
                                            @endif
                                    @endforeach 
                            </select>  
                    </div> 

        </div>
        <div class="row push">
                <div class="col-sm-2">
                    <label>หมวดบัญชีบัญชีย่อยระดับ 2 :</label>
                    </div> 
                    <div class="col-sm-4 ">              
                
                    <select name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                                        <option value="" >--กรุณาเลือกบัญชี--</option>
                                            @foreach ($infoaccountgroupsub1s as $infoaccountgroupsub1)
                                            <option value=" {{ $infoaccountgroupsub1 -> ACCOUNT_GROUP_SUB1_CODE }}" >{{ $infoaccountgroupsub1 -> ACCOUNT_GROUP_SUB1_NAME }}</option>
                                            @endforeach         
                                        </select>
                    
                    </div> 

                    <div class="col-sm-2">
                        <label>ประเภทเชื่อมโยง :</label>
                        </div> 
                        <div class="col-sm-4 ">              
                        
                        <select name="ACCOUNT_CHART_DC" id="ACCOUNT_CHART_DC" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                    <option value="">--กรุณาเลือก--</option>
                                    @if($infoaccount->ACCOUNT_CHART_DC == 'debit')<option value="debit" selected>เดบิต</option>@else<option value="debit">เดบิต</option>@endif
                                    @if($infoaccount->ACCOUNT_CHART_DC == 'credit')<option value="credit" selected>เครดิต</option>@else<option value="credit">เครดิต</option>@endif
                            </select>  
                        </div> 


        </div>

        <div class="row push">
                <div class="col-sm-2">
                    <label>หมวดบัญชีบัญชีย่อยระดับ 3 :</label>
                    </div> 
                    <div class="col-sm-4 ">              
                
                    <select name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                                        <option value="" >--กรุณาเลือกบัญชี--</option>
                                            @foreach ($infoaccountgroupsub2s as $infoaccountgroupsub2)
                                            <option value=" {{ $infoaccountgroupsub2 -> ACCOUNT_GROUP_SUB2_CODE }}" >{{ $infoaccountgroupsub2 -> ACCOUNT_GROUP_SUB2_NAME }}</option>
                                            @endforeach         
                                        </select>
                    
                    </div> 

        </div>

        <div class="row push">
                <div class="col-sm-2">
                    <label>หมวดบัญชีบัญชีย่อยระดับ 4 :</label>
                    </div> 
                    <div class="col-sm-4 ">              
                
                    <select name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                                        <option value="" >--กรุณาเลือกบัญชี--</option>
                                            @foreach ($infoaccountgroupsub3s as $infoaccountgroupsub3)
                                            <option value=" {{ $infoaccountgroupsub3 -> ACCOUNT_GROUP_SUB3_CODE }}" >{{ $infoaccountgroupsub3 -> ACCOUNT_GROUP_SUB3_NAME }}</option>
                                            @endforeach         
                                        </select>
                    
                    </div> 

        </div>-->



        <div class="row push">
                        <div class="col-sm-2">
                        <label>เชื่อมโยงพัสดุ :</label>
                        </div> 
                        <div class="col-sm-4 ">              
                        <select name="ACCOUNT_CHART_SUPTYPEID" id="ACCOUNT_CHART_SUPTYPEID " class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($infosuptypes as $infosuptype) 
                                    $infoaccount->ACCOUNT_TYPE
                                         @if($infosuptype ->SUP_TYPE_ID == $infoaccount->ACCOUNT_CHART_SUPTYPEID)
                                            <option value="{{ $infosuptype ->SUP_TYPE_ID  }}" selected>{{ $infosuptype->SUP_TYPE_NAME}}</option>
                                            @else
                                            <option value="{{ $infosuptype ->SUP_TYPE_ID  }}">{{ $infosuptype->SUP_TYPE_NAME}}</option>
                                            @endif
                                    @endforeach 
                            </select>  
                    </div> 
                        
                    <div class="col-sm-2">
                        <label>ประเภทเชื่อมโยง :</label>
                        </div> 
                        <div class="col-sm-4 ">              
                        
                        <select name="ACCOUNT_CHART_DC" id="ACCOUNT_CHART_DC" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                    <option value="">--กรุณาเลือก--</option>
                                    @if($infoaccount->ACCOUNT_CHART_DC == 'debit')<option value="debit" selected>เดบิต</option>@else<option value="debit">เดบิต</option>@endif
                                    @if($infoaccount->ACCOUNT_CHART_DC == 'credit')<option value="credit" selected>เครดิต</option>@else<option value="credit">เครดิต</option>@endif
                            </select>  
                        </div> 

        </div>

<div class="row push">

    <div class="col-sm-1">
    <label>ประเภทบัญชี :</label>
    </div> 
    <div class="col-sm-3 ">              
   
    <select name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                        <option value="" >--กรุณาเลือกบัญชีหลัก--</option>
                            @foreach ($infoaccounttypes as $infoaccounttype)
                                    @if($infoaccounttype -> ACCOUNT_TYPE_ID == $infoaccount->ACCOUNT_TYPE)
                                    <option value=" {{ $infoaccounttype -> ACCOUNT_TYPE_ID }}" selected>{{ $infoaccounttype -> ACCOUNT_TYPE_NAME }}</option>
                                    @else
                                    <option value=" {{ $infoaccounttype -> ACCOUNT_TYPE_ID }}" >{{ $infoaccounttype -> ACCOUNT_TYPE_NAME }}</option>
                                    @endif
                            @endforeach         
                        </select>
    
    </div> 
    <div class="col-sm-1">
    <label>เลขที่บัญชี :</label>
    </div> 
    <div class="col-sm-3 ">              
    <input  name="ACCOUNT_CHART_CODE" id="ACCOUNT_CHART_CODE" value="{{$infoaccount->ACCOUNT_CHART_CODE}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
    </div> 
    <div class="col-sm-1">
    <label>ชื่อบัญชี :</label>
    </div> 
    <div class="col-sm-3 ">              
    <input  name="ACCOUNT_CHART_NAME" id="ACCOUNT_CHART_NAME" value="{{$infoaccount->ACCOUNT_CHART_NAME}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
    </div> 

</div> 

<div class="row push">

    <div class="col-sm-1">
    <label>รายละเอียด :</label>
    </div> 
    <div class="col-sm-3 ">              
    <input  name="ACCOUNT_CHART_DETAIL" id="ACCOUNT_CHART_DETAIL" value="{{$infoaccount->ACCOUNT_CHART_DETAIL}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
    </div> 
    <div class="col-sm-2">
    <label>อัตราหักภาษี ณ ที่จ่าย :</label>
    </div> 
    <div class="col-sm-2 ">              
    <input  name="ACCOUNT_CHART_TAX" id="ACCOUNT_CHART_TAX" value="{{$infoaccount->ACCOUNT_CHART_TAX}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
    </div> 
  

</div> 


 
<div class="modal-footer">
<div align="right">
<button type="submit"  class="btn btn-sm btn-info btn-lg" >บันทึกข้อมูล</button>
<a href="{{ url('manager_account/setupaccount_accountschart')  }}" class="btn btn-sm btn-danger btn-lg" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มรายละเอียด ?')" >ยกเลิก</a>
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