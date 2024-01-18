@extends('layouts.asset')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 



?>

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
     
      

</style>

<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลขอเบิกครุภัณฑ์</B></h3>

</div>
<div class="block-content block-content-full" align="left">

<form  method="post" action="{{ route('massete.updatedisburseapp') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="ID" id="ID" value=" {{$inforequest->ID}}">
      
    <div class="row">

  

        <div class="col-sm-10">
 
        
       <div class="row">
        <div class="col-lg-2">
        <label>ผู้ขอเบิก:</label>
        </div> 
        <div class="col-lg-4">
       {{$inforequest->SAVE_HR_NAME}}
        </div> 
        <div class="col-lg-2">
        <label>หน่วยงาน :</label>
        </div> 
        <div class="col-lg-4">
        {{$inforequest->DEP_SUB_SUB_NAME}}
        </div>
       </div>
        
        <div class="row">
        <div class="col-lg-2">
        <label>วันที่ต้องการ:</label>
        </div> 
        <div class="col-lg-4">
        {{DateThai($inforequest->DATE_WANT)}}
        </div> 
        <div class="col-lg-2">
        <label>เลขที่ใบเบิก :</label>
        </div> 
        <div class="col-lg-4">
        {{$inforequest->BILL_NUMBER}}
        </div> 
        </div> 

             
        <div class="row">
        <div class="col-lg-2">
        <label>ขอเบิกเพื่อ:</label>
        </div> 
        <div class="col-lg-4">
        {{$inforequest->REQUEST_FOR}}
        </div> 
        </div> 
     
        </div> 
     

        <div class="col-sm-2">
        <img  src="data:image/png;base64,{{ chunk_split(base64_encode($imgperson->HR_IMAGE)) }}" height="150px" width="150px"> 
        </div>


        </div>

      <br>


        
        <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                     
                                    
                                     <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ครุภัณฑ์</a>
                                   
                                   
                                    </li>
                                




                                  
                                </ul>
                    <div class="block-content tab-content">
                   
                                    <div class="tab-pane active" id="object1" role="tabpanel">

                                
                            <div id="detail_accessory">
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #99CCFF;">
                                    <tr height="40">
                                        <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="5%">ลำดับ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="10%">เลขครุภัณฑ์</th>    
     
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  width="18%">ชื่อครุภัณฑ์</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%"> หน่วยนับ</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" width="8%">ราคา</th> 
                                     
                  

                                       
                                        <th   class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="12%">คำสั่ง</th> 
                                    
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php $number = 0; ?>
                                    @foreach ($infoassetrequests as $infoassetrequest)  
                                    <?php $number++;?>
                                    
                                            <tr height="20">
                                            <td class="text-font" align="center">{{$number}}</td>
                                                <td class="text-font text-pedding" >{{$infoassetrequest->ASSET_REQUEST_SUB_NUMBER}}</td>
                                                <td class="text-font text-pedding" >{{$infoassetrequest->ASSET_REQUEST_SUB_DETAIL}}</td>
                                                <td class="text-font text-pedding" >{{$infoassetrequest->ASSET_REQUEST_SUB_UNIT}}</td>
                                                <td class="text-font text-pedding" >{{$infoassetrequest->ASSET_REQUEST_SUB_PRICE}}</td>
                                         


                                                <td align="center">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                                    ทำรายการ
                                                            </button>
                                                        <div class="dropdown-menu" style="width:10px">

                                                            <a class="dropdown-item"  href="{{ url('manager_asset/assetinfodisburseapproval/destroy/'.$inforequest -> ID.'/'.$infoassetrequest -> ASSET_REQUEST_SUB_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a>                                                   
                                                        
                                                        </div>
                                                    </div>                                    
                                                </td>

                        <!-- editaccessory -->

                                            
                                            </tr>
                                            @endforeach   
  
                                    </tbody>
                                </table>
                                <br>
                                <div class="modal-footer">
                                <div align="right">
                                <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" >อนุมัติ</button>
                                <button type="submit"  name = "SUBMIT"  class="btn btn-lg btn-danger" value="not_approved" >ไม่อนุมัติ</button>
                                <a href="{{ url('manager_asset/assetinfodisburse')  }}" class="btn btn-warning btn-lg" >ปิดหน้าต่าง</a>
                            
                                </div>
                            </div>

                            </form>  


       
       
               
                      

@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
    
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


@endsection