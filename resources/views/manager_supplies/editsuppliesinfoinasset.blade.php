@extends('layouts.supplies')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

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

     $yearbudget = date("Y")+543;
     
     $yearnow = date("Y")+543;
     $monthnow = date("m");
     $datenow1 = date("d");
     $timenow = date(" H:i:s");
 
     $datenow = $datenow1.'/'.$monthnow.'/'.$yearnow.' '.$timenow;
 
  //echo $yearbudget;

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
      


  
#pages{
    text-align: center;
}
.page{
    width: 90%;
    margin: 10px;
    box-shadow: 0px 0px 5px #000;
    animation: pageIn 1s ease;
    transition: all 1s ease, width 0.2s ease;
}
@keyframes pageIn{
  0%{
      transform: translateX(-300px);
      opacity: 0;
  }
  100%{
      transform: translateX(0px);
      opacity: 1;
  }
}
#zoom-in{
    
}
#zoom-percent{
    display: inline-block;
}
#zoom-percent::after{
    content: "%";
}
#zoom-out{
    
}

.form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }
      
       
</style>


<center>

     

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขทรัพย์สินครุภัณฑ์ เลขรหัสพัสดุ {{$infosupplie->SUP_FSN_NUM}}</B></h3>

</div>
<form  method="post" action="{{ route('msupplies.updateinfosuppliesinfoinasset') }}"  enctype="multipart/form-data" >      
    @csrf

    <input type="hidden" name="ID" id="ID" class="form-control input-sm provice" style=" font-family: 'Kanit', sans-serif;"  value="{{$infosupplie->ID}}">
    <input  type="hidden" name="SUP_FSN" id="SUP_FSN" class="form-control input-sm provice" style=" font-family: 'Kanit', sans-serif;"  value="{{$infosupplie->SUP_FSN_NUM}}">

    <input  type="hidden" name="ARTICLE_ID" id="ARTICLE_ID" class="form-control input-sm provice" style=" font-family: 'Kanit', sans-serif;"  value="{{$infoassetarticle->ARTICLE_ID}}">

<div class="block-content block-content-full">
<div class="row">
   <div class="col-md-3" style="text-align: center">
   <div class="row">
        <div class="col-lg-12">
        <div class="form-group">

           @if ($infoassetarticle->IMG == '')
           <img id="image_upload_preview" src="{{asset('image/default.jpg')}}" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="80%"/>
           @else
           <img src="data:image/png;base64,{{ chunk_split(base64_encode($infoassetarticle->IMG)) }}" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="300px"/>  
           @endif 
       
        
    
    </div>                             
        <div class="form-group">
        <input style="font-family: 'Kanit', sans-serif;" type="file" name="picture" id="picture" class="form-control">
        </div>
         </div>
         </div>
  <br>
         <?php
                $generator = new \Picqer\Barcode\BarcodeGeneratorJPG();
                $Pi = '<img src="data:image/jpeg;base64,' . base64_encode($generator->getBarcode($infoassetarticle->ARTICLE_NUM, $generator::TYPE_CODE_128,2,30)) . '" height="40px" width="95%" > ';
                echo $Pi;
            ?>
             <br>
            
                {{$infoassetarticle->ARTICLE_NUM}}
   </div>
   

   <div class="col-md-9">
   <div class="row">
   <div class="col">
   <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;text-align: left"><span style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;รายละเอียด&nbsp;&nbsp;</span></h2>   
   </div>

   </div>
        
 
        <div class="row">
            <div class="col">
            <p style="text-align: left">รหัสเลขครุภัณฑ์</p>
            </div> 
            <div class="col-md-4" >
            <input name="ARTICLE_NUM" id="ARTICLE_NUM" class="form-control input-sm provice" style=" font-family: 'Kanit', sans-serif;"  value="{{$infoassetarticle->ARTICLE_NUM}}">
                     
            </div>
            <div class="col">
            <p style="text-align: left">ปีงบประมาณ</p>
            </div> 
            <div class="col-md-4" >
            
            <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="" >--กรุณาเลือกปีงบประมาณ--</option>
                            @foreach ($infobudgetyears as $infobudgetyear)
                                @if($infobudgetyear -> LEAVE_YEAR_ID == $infoassetarticle->YEAR_ID)
                                <option value=" {{ $infobudgetyear -> LEAVE_YEAR_ID }}" selected>{{ $infobudgetyear -> LEAVE_YEAR_ID }}</option>
                                @else
                                <option value=" {{ $infobudgetyear -> LEAVE_YEAR_ID }}" >{{ $infobudgetyear -> LEAVE_YEAR_ID }}</option>
                                @endif
                           
                              
                             
                            @endforeach         
            </select>
            
            </div>
         
        </div>

     

        <div class="row">
            <div class="col">
            <p style="text-align: left">ชื่อครุภัณฑ์</p>
            </div>
            <div class="col-md-4" >
            <input  name = "ARTICLE_NAME"  id="ARTICLE_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetarticle->ARTICLE_NAME}}" required>
            </div>
            <div class="col">
            <p style="text-align: left">ลักษณะ</p>
            </div>
            <div class="col-md-4" >
            <input  name = "ARTICLE_PROP"  id="ARTICLE_PROP" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetarticle->ARTICLE_PROP}}">
            </div>
         
        </div>
        
        <div class="row">
            <div class="col">
            <p style="text-align: left">หน่วยนับ</p>
            </div>
            <div class="col-md-4" >
           
            <select name="UNIT_ID" id="UNIT_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกหน่วยนับ--</option>
                            @foreach ($infounits as $infounit)

                                @if( $infounit -> SUP_UNIT_ID  == $infoassetarticle->UNIT_ID)
                                <option value=" {{ $infounit -> SUP_UNIT_ID }}" selected>{{ $infounit -> SUP_UNIT_NAME }}</option>
                                @else
                                <option value=" {{ $infounit -> SUP_UNIT_ID }}" >{{ $infounit -> SUP_UNIT_NAME }}</option>
                                @endif
                           
                               
                             
                            @endforeach         
            </select>
            
            </div>
            <div class="col">
            <p style="text-align: left">เลขเครื่อง</p>
            </div>
            <div class="col-md-4" >
            <input  name = "SERIAL_NO"  id="SERIAL_NO" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetarticle->SERIAL_NO}}">
            </div>
           
         
        </div>

        <div class="row">
        <div  class="col-md-2" >
            <p style="text-align: left">ยี่ห้อครุภัณฑ์</p>
            </div>
            <div class="col-md-4" >
            
            <select name="BRAND_ID" id="BRAND_ID" class="form-control input-lg js-example-basic-single brand_re" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกยี่ห้อ--</option>
                            @foreach ($inbrands as $inbrand)
                                @if($inbrand -> BRAND_ID == $infoassetarticle->BRAND_ID)
                                <option value=" {{ $inbrand -> BRAND_ID }}" selected>{{ $inbrand -> BRAND_NAME }}</option>
                                @else
                                <option value=" {{ $inbrand -> BRAND_ID }}" >{{ $inbrand -> BRAND_NAME }}</option>
                                @endif

                            
                             
                            @endforeach         
            </select>
           
           
            </div>
                <div class="col-sm-3 text-left">
                <input name="ADD_BRAND" id="ADD_BRAND" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุยี่ห้อหากต้องการเพิ่ม">
                </div> 
                <div class="col-lg-2">
                <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="addbrand();"><i class="fas fa-plus"></i> เพิ่ม</a>
                </div> 


         
            </div>

            <div class="row">
                <div class="col-md-2">
                    <p style="text-align: left">รุ่น</p>
                    </div>
                    <div class="col-md-4" >
                  
                    <select name="MODEL_ID" id="MODEL_ID" class="form-control input-lg js-example-basic-single model_re" style=" font-family: 'Kanit', sans-serif;" >
                                <option value="" >--กรุณาเลือกรุ่น--</option>
                                    @foreach ($inmodels as $inmodel)
                                        @if($inmodel -> MODEL_ID  == $infoassetarticle->MODEL_ID)
                                        <option value=" {{ $inmodel -> MODEL_ID }}" selected>{{ $inmodel -> MODEL_NAME }}</option>
                                        @else
                                        <option value=" {{ $inmodel -> MODEL_ID }}" >{{ $inmodel -> MODEL_NAME }}</option>
                                        @endif
                                       
                                     
                                    @endforeach         
                    </select>
                    
                    </div>

                    <div class="col-sm-3 text-left">
                        <input name="ADD_MODEL" id="ADD_MODEL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุรุ่นหากต้องการเพิ่ม">
                        </div> 
                        <div class="col-lg-2">
                        <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="addmodel();"><i class="fas fa-plus"></i> เพิ่ม</a>
                        </div> 




                </div>



    <div class="row">

        <div class="col-md-2">
            <p style="text-align: left">สีครุภัณฑ์</p>
            </div>
            <div class="col-md-4" >
  
            <select name="COLOR_ID" id="COLOR_ID" class="form-control input-lg js-example-basic-single color_re" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกสี--</option>
                            @foreach ($infocolors as $infocolor)
                                @if($infocolor -> COLOR_ID == $infoassetarticle->COLOR_ID)
                                <option value=" {{ $infocolor -> COLOR_ID }}" selected>{{ $infocolor -> COLOR_NAME }}</option>
                                @else
                                <option value=" {{ $infocolor -> COLOR_ID }}" >{{ $infocolor -> COLOR_NAME }}</option>
                                @endif
                               
                               
                            @endforeach         
            </select>
            
            
            </div>

            <div class="col-sm-3 text-left">
                <input name="ADD_COLOR" id="ADD_COLOR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุสีครุภัณฑ์หากต้องการเพิ่ม">
                </div> 
                <div class="col-lg-2">
                <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="addcolor();"><i class="fas fa-plus"></i> เพิ่ม</a>
                </div> 

            </div>

        
          <div class="row">
                <div class="col-md-2">
            <p style="text-align: left">ขนาด</p>
            </div>
            <div class="col-md-4" >
            
            <select name="SIZE_ID" id="SIZE_ID" class="form-control input-lg js-example-basic-single size_re" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกขนาด--</option>
                            @foreach ($infosizes as $infosize)
                                @if($infosize -> SIZE_ID  == $infoassetarticle->SIZE_ID)
                                <option value=" {{ $infosize -> SIZE_ID }}" selected>{{ $infosize -> SIZE_NAME }}</option>
                                @else
                                <option value=" {{ $infosize -> SIZE_ID }}" >{{ $infosize -> SIZE_NAME }}</option>
                                @endif
                             
                              
                            @endforeach         
            </select>
            
            </div>

            <div class="col-sm-3 text-left">
                <input name="ADD_SIZE" id="ADD_SIZE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุขนาดหากต้องการเพิ่ม">
                </div> 
                <div class="col-lg-2">
                <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="addsize();"><i class="fas fa-plus"></i> เพิ่ม</a>
                </div> 
     
        </div>
       
  

        <div class="row">
            <div class="col">
            <p style="text-align: left">ราคา</p>
            </div>
            <div class="col-md-4" >
            <input name="PRICE_PER_UNIT" id="PRICE_PER_UNIT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetarticle->PRICE_PER_UNIT}}" required>
            </div>
            <div class="col">
            <p style="text-align: left">วันที่รับเข้า</p>
            </div>
            <div class="col-md-4" >
            <input name="RECEIVE_DATE" id="RECEIVE_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" data-date-format="mm/dd/yyyy" value="{{formate($infoassetarticle->RECEIVE_DATE)}}" readonly required>
            </div>
         
        </div>

        
        <div class="row">
            <div class="col">
            <p style="text-align: left">วิธีได้มา</p>
            </div>
            <div class="col-md-4" >
           
            
            <select name="METHOD_ID" id="METHOD_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="" >--กรุณาเลือกวิธีได้มา--</option>
                            @foreach ($infomethods as $infomethod)
                                @if($infomethod -> METHOD_ID  == $infoassetarticle->METHOD_ID)
                                <option value=" {{ $infomethod -> METHOD_ID }}" selected>{{ $infomethod -> METHOD_NAME }}</option>
                               
                                @else
                                <option value=" {{ $infomethod -> METHOD_ID }}" >{{ $infomethod -> METHOD_NAME }}</option>
                               
                                @endif
                            
                             
                            @endforeach         
            </select>
            
            </div>
            <div class="col">
            <p style="text-align: left">การจัดซื้อ</p>
            </div>
            <div class="col-md-4" >
           
            
            <select name="BUY_ID" id="BUY_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="" >--กรุณาเลือกการจัดซื้อ--</option>
                            @foreach ($infobuys as $infobuy)

                            @if($infobuy -> BUY_ID   == $infoassetarticle->BUY_ID)
                            <option value=" {{ $infobuy -> BUY_ID }}" selected>{{ $infobuy -> BUY_NAME }}</option>
                            @else
                            <option value=" {{ $infobuy -> BUY_ID }}" >{{ $infobuy -> BUY_NAME }}</option>
                            @endif
                           
                              
                               
                            @endforeach         
            </select>
            
            
            </div>
         
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">งบที่ใช้</p>
            </div>
            <div class="col-md-4" >
         
            <select name="BUDGET_ID" id="BUDGET_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="" >--กรุณาเลือกงบ--</option>
                            @foreach ($infobudgets as $infobudget)

                            @if($infobudget -> BUDGET_ID  == $infoassetarticle->BUDGET_ID)
                            <option value=" {{ $infobudget -> BUDGET_ID }}" selected>{{ $infobudget -> BUDGET_NAME }}</option>
                            @else
                            <option value=" {{ $infobudget -> BUDGET_ID }}" >{{ $infobudget -> BUDGET_NAME }}</option>
                            @endif
                            
                              
                             
                            @endforeach         
            </select>
            
            
            </div>
            <div class="col">
            <p style="text-align: left">ประเภท</p>
            </div>
            <div class="col-md-4" >
            
            
            <select name="TYPE_ID" id="TYPE_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="" >--กรุณาเลือกประเภท--</option>
                            @foreach ($infotypes as $infotype)
                            @if($infotype -> SUP_TYPE_ID  == $infoassetarticle->TYPE_ID)
                            <option value=" {{ $infotype -> SUP_TYPE_ID }}" selected>{{ $infotype -> SUP_TYPE_NAME }}</option>
                               
                            @else
                            <option value=" {{ $infotype -> SUP_TYPE_ID }}" >{{ $infotype -> SUP_TYPE_NAME }}</option>
                               
                            @endif
                            
                              
                            @endforeach         
            </select>
            
            
            </div>
         
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">ประเภทค่าเสื่อม</p>
            </div>
            <div class="col-md-4" >
           
           
            <select name="DECLINE_ID" id="DECLINE_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" onchange="amountdayexp();" required>
                        <option value="" >--กรุณาเลือกค่าเสื่อม--</option>
                            @foreach ($infodeclines as $infodecline)
                                 @if($infodecline -> DECLINE_ID == $infoassetarticle->DECLINE_ID)
                                 <option value=" {{ $infodecline -> DECLINE_ID }}" selected>{{ $infodecline -> DECLINE_NAME }}</option>
                                 @else
                                 <option value=" {{ $infodecline -> DECLINE_ID }}" >{{ $infodecline -> DECLINE_NAME }}</option>
                                 @endif
                               
                            
                               
                            @endforeach         
            </select>
           
            </div>
            <div class="col">
            <p style="text-align: left">ผู้จำหน่าย</p>
            </div>
            <div class="col-md-4" >
           
            
            <select name="VENDOR_ID" id="VENDOR_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="" >--กรุณาเลือกผู้จำหน่าย--</option>
                            @foreach ($infovendors as $infovendor)
                                @if($infovendor -> VENDOR_ID  == $infoassetarticle->VENDOR_ID)
                                <option value=" {{ $infovendor -> VENDOR_ID }}" selected>{{ $infovendor -> VENDOR_NAME }}</option>
                                @else
                                <option value=" {{ $infovendor -> VENDOR_ID }}" >{{ $infovendor -> VENDOR_NAME }}</option>
                                @endif
                            
                              
                               
                            @endforeach         
            </select>
            
            
            </div>
         
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">ประจำหน่วยงาน</p>
            </div>
            <div class="col-md-4" >
            
            
            <select name="DEP_ID" id="DEP_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="" >--กรุณาเลือกหน่วยงาน--</option>
                            @foreach ($infodeps as $infodep)
                            @if($infodep ->HR_DEPARTMENT_SUB_SUB_ID  == $infoassetarticle->DEP_ID)
                            <option value=" {{ $infodep ->HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                            @else
                            <option value=" {{ $infodep ->HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                            @endif
                               
                              
                            @endforeach         
            </select>
            
            
            </div>
            <div class="col">
            <p style="text-align: left">อาคาร</p>
            </div>
            <div class="col-md-4" >
            
            
            <select name="LOCATION_ID" id="LOCATION_ID" class="form-control input-lg js-example-basic-single location" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกอาคาร--</option>
                            @foreach ($infolocations as $infolocation)
                            @if($infolocation -> LOCATION_ID   == $infoassetarticle->LOCATION_ID)
                            <option value=" {{ $infolocation -> LOCATION_ID }}" selected>{{ $infolocation -> LOCATION_NAME }}</option>
                            @else
                            <option value=" {{ $infolocation -> LOCATION_ID }}" >{{ $infolocation -> LOCATION_NAME }}</option>
                            @endif
                             
                                
                              
                            @endforeach         
            </select>
            
            
            </div>
         
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">ชั้น</p>
            </div>
            <div class="col-md-4" >
          
            
            <select name="LOCATION_LEVEL_ID" id="LOCATION_LEVEL_ID" class="form-control input-lg locationlevel js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกชั้น--</option>
                            @foreach ($infolocationlevels as $infolocationlevel)
                            @if($infolocationlevel -> LOCATION_LEVEL_ID   == $infoassetarticle->LOCATION_LEVEL_ID)
                            <option value=" {{ $infolocationlevel -> LOCATION_LEVEL_ID }}" selected>{{ $infolocationlevel -> LOCATION_LEVEL_NAME }}</option>
                            @else
                            <option value=" {{ $infolocationlevel -> LOCATION_LEVEL_ID }}" >{{ $infolocationlevel -> LOCATION_LEVEL_NAME }}</option>
                            @endif
                               
                             
                            @endforeach         
            </select>
            
            </div>
            <div class="col">
            <p style="text-align: left">ห้อง</p>
            </div>
            <div class="col-md-4" >
            
            <select name="LEVEL_ROOM_ID" id="LEVEL_ROOM_ID" class="form-control input-lg locationlevelroom js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกห้อง--</option>
                            @foreach ($infolocationlevelrooms as $infolocationlevelroom)
                            @if($infolocationlevelroom -> LEVEL_ROOM_ID   == $infoassetarticle->LEVEL_ROOM_ID)
                            <option value=" {{ $infolocationlevelroom -> LEVEL_ROOM_ID }}" selected>{{ $infolocationlevelroom -> LEVEL_ROOM_NAME }}</option>
                            @else
                            <option value=" {{ $infolocationlevelroom -> LEVEL_ROOM_ID }}" >{{ $infolocationlevelroom -> LEVEL_ROOM_NAME }}</option>
                            @endif
                                
                               
                            @endforeach         
            </select>
            
            </div>
         
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">ผู้รับผิดชอบ</p>
            </div>
            <div class="col-md-4" >
         
            <select name="PERSON_ID" id="PERSON_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกผู้รับผิดชอบ--</option>
                            @foreach ($infopersons as $infoperson)
                            @if($infoperson -> ID  == $infoassetarticle->PERSON_ID)
                            <option value=" {{ $infoperson -> ID }}" selected>{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                            @else
                            <option value=" {{ $infoperson -> ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                            @endif
                             
                               
                                
                            @endforeach         
            </select>
            
            
            
            </div>
            <div class="col">
            <p style="text-align: left">หมายเหตุ</p>
            </div>
            <div class="col-md-4" >
            <input name="REMARK" id="REMARK" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetarticle->REMARK}}">
            </div>
         
        </div>

        <br>
        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;text-align: left"><span style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;สภาพครุภัณฑ์&nbsp;&nbsp;</span></h2>  

        <div class="row">
            <div class="col">
            <p style="text-align: left">สถานะการใช้งาน</p>
            </div>
            <div class="col-md-3" >
            
            <select name="STATUS_ID" id="STATUS_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="" >--กรุณาเลือกสถานะ--</option>
                            @foreach ($infostatuss as $infostatus)
                            @if($infostatus -> STATUS_ID  == $infoassetarticle->STATUS_ID)
                            <option value=" {{ $infostatus -> STATUS_ID }}" selected>{{ $infostatus -> STATUS_NAME }}</option>
                            @else
                            <option value=" {{ $infostatus -> STATUS_ID }}" >{{ $infostatus -> STATUS_NAME }}</option>
                            @endif
                            
                              
                            
                            @endforeach         
            </select>
            
            
            </div>

    <div class="row amountdayexp_info">

            <div class="col">
            <p style="text-align: left">อายุการใช้งาน</p>
            </div>
            <div class="col-md-3" >
            <input name="OLD_USE" id="OLD_USE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetarticle->OLD_USE}}" >
            </div>
            <div class="col-md-1" >
                ปี
           </div>
         
        
  
            <div class="col-md-2">
            <p style="text-align: left">หมดสภาพ</p>
            </div>
            <div class="col-md-4" >
            <input name="EXPIRE_DATE" id="EXPIRE_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" data-date-format="mm/dd/yyyy"  value="{{ formate($infoassetarticle->EXPIRE_DATE)}}"  readonly>
            </div>
  
        </div>
        </div>
        <br>
        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;text-align: left"><span style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;การตรวจสอบบำรุงรักษา&nbsp;&nbsp;</span></h2>  

        <div class="row">
            <div class="col">
            <p style="text-align: left">การบำรุงรักษา PM</p>
            </div>
            <div class="col-md-4" >
         
            
            <select name="PM_TYPE_ID" id="PM_TYPE_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือก--</option>
                            @foreach ($infogrouppms as $infogrouppm)
                            @if($infogrouppm -> PM_TYPE_ID == $infoassetarticle->PM_TYPE_ID)
                            <option value=" {{ $infogrouppm -> PM_TYPE_ID }}" selected>{{ $infogrouppm -> PM_TYPE_NAME }}</option>
                            @else
                            <option value=" {{ $infogrouppm -> PM_TYPE_ID }}" >{{ $infogrouppm -> PM_TYPE_NAME }}</option>
                            @endif
                             
                               
                             
                            @endforeach         
            </select>
            

            </div>
            <div class="col">
            <p style="text-align: left">การสอบเทียบ CAL</p>
            </div>
            <div class="col-md-4" >
           
            <select name="CAL_TYPE_ID" id="CAL_TYPE_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือก--</option>
                            @foreach ($infogroupcals as $infogroupcal)
                            @if($infogroupcal -> CAL_TYPE_ID == $infoassetarticle->CAL_TYPE_ID)
                            <option value=" {{ $infogroupcal -> CAL_TYPE_ID }}" selected>{{ $infogroupcal -> CAL_TYPE_NAME }}</option>
                            @else
                            <option value=" {{ $infogroupcal -> CAL_TYPE_ID }}" >{{ $infogroupcal -> CAL_TYPE_NAME }}</option>
                            @endif
                             
                              
                            
                            @endforeach         
            </select>
            
            
           
            </div>
         
        </div>
        <div class="row">
            <div class="col-md-2">
            <p style="text-align: left">ความเสี่ยง</p>
            </div>
            <div class="col-md-4" >
           
            
            <select name="RISK_TYPE_ID" id="RISK_TYPE_ID" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกความเสี่ยง--</option>
                            @foreach ($infogrouprisks as $infogrouprisk)
                            @if($infogrouprisk -> RISK_TYPE_ID == $infoassetarticle->RISK_TYPE_ID)
                            <option value=" {{ $infogrouprisk -> RISK_TYPE_ID }}" selected>{{ $infogrouprisk -> RISK_TYPE_NAME }} </option>
                            @else
                            <option value=" {{ $infogrouprisk -> RISK_TYPE_ID }}" >{{ $infogrouprisk -> RISK_TYPE_NAME }} </option>
                            @endif
                            
                               
                            
                            @endforeach         
            </select>
            
            
            </div>
       
         
        </div>
    
    

        </div>
</div>
<br>
<div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกแก้ไขข้อมูล</button>
        <a href="{{ url('manager_supplies/suppliesinfo/suppliesinfoinasset/'.$infosupplie->ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

</form>



 
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script>
  function amountdayexp(){

var RECEIVE_DATE= document.getElementById("RECEIVE_DATE").value; 
var DECLINE_ID= document.getElementById("DECLINE_ID").value; 

//    alert(DECLINE_ID);

var _token=$('input[name="_token"]').val();
    $.ajax({
            url:"{{route('massete.amountdayexp')}}",
            method:"GET",
            data:{DECLINE_ID:DECLINE_ID,RECEIVE_DATE:RECEIVE_DATE,_token:_token},
            success:function(result){
             $('.amountdayexp_info').html(result);
            }
    })

};

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });
</script>

<script>

        //===============================เพิ่มยี่ห้อ====================================
        function addbrand(){
      
      var record_brand=document.getElementById("ADD_BRAND").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.addbrand')}}",
                   method:"GET",
                   data:{record_brand:record_brand,_token:_token},
                   success:function(result){
                      $('.brand_re').html(result);
                   }
           })

  }
//===============================เพิ่มรุ่น====================================
  function addmodel(){
      
      var record_model=document.getElementById("ADD_MODEL").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.addmodel')}}",
                   method:"GET",
                   data:{record_model:record_model,_token:_token},
                   success:function(result){
                      $('.model_re').html(result);
                   }
           })

  }

  //===============================เพิ่มสี====================================
  function addcolor(){
      
      var record_color=document.getElementById("ADD_COLOR").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.addcolor')}}",
                   method:"GET",
                   data:{record_color:record_color,_token:_token},
                   success:function(result){
                      $('.color_re').html(result);
                   }
           })

  }

  //===============================เพิ่มขนาด====================================
  function addsize(){
      
      var record_size=document.getElementById("ADD_SIZE").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.addsize')}}",
                   method:"GET",
                   data:{record_size:record_size,_token:_token},
                   success:function(result){
                      $('.size_re').html(result);
                   }
           })

  }
     
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


<script>


//=====================================================================

$('.location').change(function(){
    
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.repairnomal')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.locationlevel').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.locationlevel').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.repairnomalsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.locationlevelroom').html(result);
                     }
             })
            // console.log(select);
             }        
     });



//---------------------------------------------------------------------------------
pdfjsLib.GlobalWorkerOptions.workerSrc =
"{{ asset('pdfupload/pdf_upwork.js') }}";

  document.querySelector("#pdfupload").addEventListener("change", function(e){
  document.querySelector("#pages").innerHTML = "";

	var file = e.target.files[0]
	if(file.type != "application/pdf"){
		alert(file.name + " is not a pdf file.")
		return
	}
	
	var fileReader = new FileReader();  

	fileReader.onload = function() {
		var typedarray = new Uint8Array(this.result);
    
		pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
			// you can now use *pdf* here
			console.log("the pdf has", pdf.numPages, "page(s).");
      for (var i = 0; i < pdf.numPages; i++) {
        (function(pageNum){
        pdf.getPage(i+1).then(function(page) {
          // you can now use *page* here
          var viewport = page.getViewport(2.0);
          var pageNumDiv = document.createElement("div");
          pageNumDiv.className = "pageNumber";
          pageNumDiv.innerHTML = "Page " + pageNum;
          var canvas = document.createElement("canvas");
          canvas.className = "page";
          canvas.title = "Page " + pageNum;
          document.querySelector("#pages").appendChild(pageNumDiv);
          document.querySelector("#pages").appendChild(canvas);
          canvas.height = viewport.height;
          canvas.width = viewport.width;


          page.render({
            canvasContext: canvas.getContext('2d'),
            viewport: viewport
          }).promise.then(function(){
            console.log('Page rendered');
          });
          page.getTextContent().then(function(text){
              console.log(text);
          });
        });
        })(i+1);
      }

		});
	};
 
	fileReader.readAsArrayBuffer(file);
   

});




var curWidth = 90;
function zoomIn(){
    if (curWidth < 150) {
        curWidth += 10;
        document.querySelector("#zoom-percent").innerHTML = curWidth;
        document.querySelectorAll(".page").forEach(function(page){

            page.style.width = curWidth + "%";
        });
    }
}
function zoomOut(){
    if (curWidth > 20) {
        curWidth -= 10;
        document.querySelector("#zoom-percent").innerHTML = curWidth;
        document.querySelectorAll(".page").forEach(function(page){

            page.style.width = curWidth + "%";
        });
    }
}
function zoomReset(){

    curWidth = 90;
    document.querySelector("#zoom-percent").innerHTML = curWidth;
   
    document.querySelectorAll(".page").forEach(function(page){
      page.style.width = curWidth + "%";
    });
}
document.querySelector("#zoom-in").onclick = zoomIn;
document.querySelector("#zoom-out").onclick = zoomOut;
document.querySelector("#zoom-reset").onclick = zoomReset;
window.onkeypress = function(e){
    if (e.code == "Equal") {
        zoomIn();
    }
    if (e.code == "Minus") {
        zoomOut();
    }
};
  
//===============================เพิ่มหน่วยงาน====================================
function addorg(){
      
      var record_org=document.getElementById("ADD_RECORD_ORG").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mbook.addorg')}}",
                   method:"GET",
                   data:{record_org:record_org,_token:_token},
                   success:function(result){
                      $('.org_re').html(result);
                   }
           })

  }

//====================================================================

function checkmax(){
      
      var year=document.getElementById("BOOK_YEAR_ID").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mbook.checkmax')}}",
                   method:"GET",
                   data:{year:year,_token:_token},
                   success:function(result){
                      $('.max_re').html(result);
                   }
           })

  }

  //======================================================================

  

function readURL(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
        var numb = input.files[0].size/1024;
   
                    if(numb > 64){
                        alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
                            fileInput.value = '';
                            return false;
                        }
    		
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();
            
                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                        }
            
                        reader.readAsDataURL(input.files[0]);
                    }else{
        
                                alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                                fileInput.value = '';
                                return false;
       
                    }

                   


                }

            
                $("#picture").change(function () {
                    readURL(this);
                });


                function checkcancel() {
               
               var r = confirm("ต้องการยกเลิกการเพิ่มข้อมูล");
               if (r == true) {
                       window.location.href = "{{ url('person/personinfouserofficial')}}"
                 } else {
                       return false;   
                 }
                       }    
                  

//=====================================================================

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