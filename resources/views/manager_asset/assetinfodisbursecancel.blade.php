@extends('layouts.asset')
    
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

      .form-control{
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


?>
<?php

  $datenow = date('Y-m-d');

  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

  

?>  

<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
                <div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ยกเลิกคำร้องขอเบิกทรัพย์สิน</B></h3>

</div>                
<div class="block-content block-content-full" style="text-align: left;">                  
       
                <form  method="post" action="{{ route('massete.canceldisburseassetinfoupdate') }}" enctype="multipart/form-data">
                @csrf

       <div class="row push">
            <div class="col-sm-2">
                <label>ผู้ขอเบิก :</label>
            </div> 
            <div class="col-lg-4">
            {{$infoassetrequest -> SAVE_HR_NAME}} 
           
            </div> 
           
            <div class="col-sm-2">
                <label>หน่วยงานผู้ขอเบิก :</label>
            </div> 
            <div class="col-lg-4">
            {{$infoassetrequest -> DEP_SUB_SUB_NAME}}

   
          
            </div>
         
        </div>
       <div class="row push">
            <div class="col-sm-2">
                <label>ปีงบประมาณ :</label>
            </div> 
            <div class="col-lg-4">
            {{$infoassetrequest -> YEAR_ID}}          
            </div>
            <div class="col-sm-2">
                <label>ใบสำคัญเบิกเลขที่ :</label>
            </div> 
            <div class="col-lg-4">
            {{$infoassetrequest -> BILL_NUMBER}}
            
            </div>


           
        </div>

        <div class="row push">
            <div class="col-sm-2">
                <label>วันที่ต้องการ :</label>
            </div> 
            <div class="col-lg-4">
            {{DateThai($infoassetrequest -> DATE_WANT)}}
            
            </div>
            <div class="col-sm-2">
                <label>วันที่เบิก :</label>
            </div> 
            <div class="col-lg-4">
            {{DateThai($infoassetrequest -> DATE_OPEN)}}
            
            </div>


           
        </div>

       <div class="row push">

       <div class="col-sm-2">
        <label>เหตุผลการขอเบิก :</label>
        </div> 
        <div class="col-sm-10">
        {{$infoassetrequest -> REQUEST_FOR}}
        </div> 
       </div>

       <table class="table gwt-table" >
            <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    
                    <td style="text-align: center;">ครุภัณฑ์ที่ต้องการเบิก </td>
                    <td style="text-align: center;">หน่วยนับ </td>
                    <td style="text-align: center;">ราคาต่อหน่วย </td>
                
                   
                </tr>
            </thead>
            <tbody class="tbody1">
            @foreach ($infoassetrequestsubs as $infoassetrequestsub) 
                <tr height="40">
                 
                  
                    <td class="text-font text-pedding" >{{ $infoassetrequestsub -> ASSET_REQUEST_SUB_NUMBER }} :: {{ $infoassetrequestsub -> ASSET_REQUEST_SUB_DETAIL }}</td> 
                 

                    <td class="text-font text-pedding" >{{ $infoassetrequestsub -> ASSET_REQUEST_SUB_UNIT }}</td> 
                    <td class="text-font text-pedding" >{{ $infoassetrequestsub -> ASSET_REQUEST_SUB_PRICE }}</td> 

                </tr>
                @endforeach 
            </tbody>
        </table>
              <br> 

            <input type="hidden" name="ID" id="ID" value="{{$infoassetrequest -> ID}}">
           

        <div class="modal-footer">
            <div align="right">
            <button type="submit"  class="btn btn-hero-sm btn-hero-danger" >ยืนยันการยกเลิกคำร้อง</button>&nbsp;&nbsp;
                    <a href="{{ url('manager_asset/assetinfodisburse') }}" class="btn btn-secondary btn-lg" >ปิดหน้าต่าง</a></div><br>
            </div>
        </div>
    </form>  

   
                  

@endsection

@section('footer')


@endsection