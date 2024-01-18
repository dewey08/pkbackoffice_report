@extends('layouts.warehouse')   
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
    padding-right:10px;
                        }


        .text-font {
    font-size: 13px;
                  }
                  .form-control {
    font-size: 13px;
                  }


                  table, td, th {
            border: 1px solid black;
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

  
 
    use App\Http\Controllers\ManagerwarehouseController;
?>
      
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>สรุปงานไตรมาส</B></h3>

             
            </div>
            <div class="block-content ">

   <div class="block-content ">
            <form action="{{ route('mwarehouse.reportquarter') }}" method="post">
                @csrf
                <div class="row">

                <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                            <span>
                              
                               2565
                            </span>
                        </div>
						   <div class="col-sm-0.5">
                                &nbsp;คลัง &nbsp;&nbsp;&nbsp;
                            </div>
						
						      <div class="col-md-3">
                        <select name="RECEIVE_STORE" id="RECEIVE_STORE" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                            <option value="" >--เลือกคลัง--</option>                                          
                                @foreach ($infosuppliesinvens as $infosuppliesinven)  
                                    @if($infosuppliesinven -> INVEN_ID == $checkreceive)
                                    <option value="{{ $infosuppliesinven -> INVEN_ID }}" selected>{{ $infosuppliesinven -> INVEN_NAME }}</option>                                          
                                    @else
                                    <option value="{{ $infosuppliesinven -> INVEN_ID }}" >{{ $infosuppliesinven -> INVEN_NAME }}</option>                                          
                                    @endif
                                @endforeach  
                            </select> 
                    </div>


                <div class="col-sm-1">
                                &nbsp;ประเภท &nbsp;
                            </div>                                
                            <div class="col-md-3">
                                <span>                                
                                    <select name="TYPE_CODE" id="TYPE_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                        <option value="">--ทั้งหมด--</option>
                                            @foreach ($infotypes as $infotype)
                                                @if($infotype->SUP_TYPE_ID == $type_check)
                                                    <option value="{{ $infotype->SUP_TYPE_ID  }}" selected>{{ $infotype->SUP_TYPE_NAME}}</option>
                                                @else                                                 
                                                    <option value="{{ $infotype->SUP_TYPE_ID  }}">{{ $infotype->SUP_TYPE_NAME}}</option>                                
                                                @endif
                                            @endforeach 
                                    </select>
                                </span>
                            </div>                

                 
                    <div class="col-md-30">
                        &nbsp;
                    </div>
              
                    <div class="col-md-1.5">
                        <span>
                            <button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                        </span>
                    </div>
                </div>
        </form>
  

             <div class="table-responsive"> 
                ไตรมาส 1 ตุลาคม - ธันวาคม
                <table class="table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">    
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการละเอียด</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">จำนวนรายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าการยกมา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าการรับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" >มูลค่าการจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าคงเหลือ</th>

                          
                  
                        </tr >
                    </thead>
                    <tbody>     
         
                   
                    <tr height="20">   
                        <td class="text-font text-pedding" style="border: 1px solid black;">จำนวนทั้งหมด</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriall_1}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotalrecivefirst,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotal_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotalpay_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotalrecivefirst + $infotrialltotal_1-$infotrialltotalpay_1,2)}}</td>
                              
                    </tr>    

                    <tr height="20">   
                        <td class="text-font text-pedding" style="border: 1px solid black;">ราคาสืบเขต</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotricounty_1}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotalfirst,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotal_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotalpay_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotalfirst+$infotricountytotal_1 - $infotricountytotalpay_1,2)}}</td>       
                    </tr> 

                    <tr height="20">   
                        <td class="text-font text-pedding" style="border: 1px solid black;">ราคาสืบจังหวัด</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriprovince_1}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotalfirst,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotal_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotalpay_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotalfirst+$infotriprovincetotal_1 - $infotriprovincetotalpay_1,2)}}</td>
                    </tr> 

                    <tr height="20">   
                        <td class="text-font text-pedding" style="border: 1px solid black;">ราคาจัดซื้อเอง</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriself_1}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotalfirst,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotal_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotalpay_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotalfirst+$infotriselftotal_1-$infotriselftotalpay_1,2)}}</td>  
                    </tr> 
                             
                    <tr height="20">   
                       
                        <td class="text-font text-pedding" style="border: 1px solid black;">ราคาไม่ระบุ</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infonotremark_1}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotalfirst,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotal_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotalpay_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotalfirst+$infonotremarktotal_1-$infonotremarktotalpay_1,2)}}</td>
                    </tr> 

                    <tr height="20">   
                        <td class="text-font text-pedding" style="border: 1px solid black;">ของแถม</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotribonus_1}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotalfirst,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotal_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotalpay_1,2)}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotalfirst+$infotribonustotal_1 - $infotribonustotalpay_1,2)}}</td>
                    </tr> 
                    </tbody>
                </table>

               
                <br>


                  <table class="table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #50cedf;">
                        <tr height="40">    
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการละเอียด</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="40%">รายการจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="40%" >มูลค่าการจ่าย</th>
                            

                          
                  
                        </tr >
                    </thead>
                    <tbody>   
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">รพสต.</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infohcenter_1}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infohcentertotalpay_1,2)}}</td>
                        </tr> 
                        </tbody>
                    </table>
                    <br><br>  


                ไตรมาส 2 มกราคม - มีนาคม
                <table class="table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">    
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการละเอียด</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" >จำนวนรายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าการยกมา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าการรับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" >มูลค่าการจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าคงเหลือ</th>

                          
                  
                        </tr >
                    </thead>
                    <tbody>     
         
                   
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">จำนวนทั้งหมด</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriall_2}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotalrecivefirst+$infotrialltotal_1-$infotrialltotalpay_1,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotal_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotrialltotalrecivefirst+$infotrialltotal_1-$infotrialltotalpay_1+$infotrialltotal_2)-$infotrialltotalpay_2,2)}}</td>
                                  
                        </tr>    
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาสืบเขต</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotricounty_2}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotalfirst+$infotricountytotal_1 - $infotricountytotalpay_1,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotal_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotricountytotalfirst+$infotricountytotal_1 - $infotricountytotalpay_1+$infotricountytotal_2) - $infotricountytotalpay_2,2)}}</td>       
                        </tr> 
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาสืบจังหวัด</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriprovince_2}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotalfirst+$infotriprovincetotal_1 - $infotriprovincetotalpay_1,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotal_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotriprovincetotalfirst+$infotriprovincetotal_1 - $infotriprovincetotalpay_1+$infotriprovincetotal_2) - $infotriprovincetotalpay_2,2)}}</td>
                        </tr> 
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาจัดซื้อเอง</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriself_2}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotalfirst+$infotriselftotal_1-$infotriselftotalpay_1,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotal_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotriselftotalfirst+$infotriselftotal_1-$infotriselftotalpay_1+$infotriselftotal_2)-$infotriselftotalpay_2,2)}}</td>  
                        </tr> 
                                 
                        <tr height="20">   
                           
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาไม่ระบุ</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infonotremark_2}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotalfirst+$infonotremarktotal_1-$infonotremarktotalpay_1,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotal_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infonotremarktotalfirst+$infonotremarktotal_1-$infonotremarktotalpay_1+$infonotremarktotal_2)-$infonotremarktotalpay_2,2)}}</td>
                        </tr> 
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ของแถม</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotribonus_2}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotalfirst+$infotribonustotal_1 - $infotribonustotalpay_1,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotal_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotribonustotalfirst+$infotribonustotal_1 - $infotribonustotalpay_1+$infotribonustotal_2) - $infotribonustotalpay_2,2)}}</td>
                        </tr> 
                        </tbody>
                    </table>
    
                   
                    <br>
    
    
                      <table class="table-striped table-vcenter " style="width: 100%;">
                        <thead style="background-color: #50cedf;">
                            <tr height="40">    
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการละเอียด</th>
    
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="40%">รายการจ่าย</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="40%" >มูลค่าการจ่าย</th>
                                
    
                              
                      
                            </tr >
                        </thead>
                        <tbody>   
                            <tr height="20">   
                                <td class="text-font text-pedding" style="border: 1px solid black;">รพสต.</td>
                                <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infohcenter_2}}</td>
                                <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infohcentertotalpay_2,2)}}</td>
                            </tr> 
                            </tbody>
                        </table>
                        <br><br>  

                ไตรมาส 3 เมษายน - มิถุนายน
                <table class="table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">    
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการละเอียด</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" >จำนวนรายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าการยกมา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าการรับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" >มูลค่าการจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าคงเหลือ</th>

                          
                  
                        </tr >
                    </thead>
                    <tbody>     
         
                   
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">จำนวนทั้งหมด</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriall_3}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotrialltotalrecivefirst+$infotrialltotal_1-$infotrialltotalpay_1+$infotrialltotal_2)-$infotrialltotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotal_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infotrialltotalrecivefirst+$infotrialltotal_1-$infotrialltotalpay_1+$infotrialltotal_2)-$infotrialltotalpay_2)+$infotrialltotal_3)-$infotrialltotalpay_3,2)}}</td>
                                  
                        </tr>    
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาสืบเขต</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotricounty_3}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotricountytotalfirst+$infotricountytotal_1 - $infotricountytotalpay_1+$infotricountytotal_2) - $infotricountytotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotal_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infotricountytotalfirst+$infotricountytotal_1 - $infotricountytotalpay_1+$infotricountytotal_2) - $infotricountytotalpay_2)+$infotricountytotal_3)-$infotricountytotalpay_3,2)}}</td>       
                        </tr> 
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาสืบจังหวัด</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriprovince_3}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotriprovincetotalfirst+$infotriprovincetotal_1 - $infotriprovincetotalpay_1+$infotriprovincetotal_2) - $infotriprovincetotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotal_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infotriprovincetotalfirst+$infotriprovincetotal_1 - $infotriprovincetotalpay_1+$infotriprovincetotal_2) - $infotriprovincetotalpay_2)+$infotriprovincetotal_3)-$infotriprovincetotalpay_3,2)}}</td>
                        </tr> 
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาจัดซื้อเอง</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriself_3}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotriselftotalfirst+$infotriselftotal_1-$infotriselftotalpay_1+$infotriselftotal_2)-$infotriselftotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotal_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infotriselftotalfirst+$infotriselftotal_1-$infotriselftotalpay_1+$infotriselftotal_2)-$infotriselftotalpay_2)+$infotriselftotal_3)-$infotriselftotalpay_3,2)}}</td>  
                        </tr> 
                                 
                        <tr height="20">   
                           
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาไม่ระบุ</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infonotremark_3}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infonotremarktotalfirst+$infonotremarktotal_1-$infonotremarktotalpay_1+$infonotremarktotal_2)-$infonotremarktotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotal_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infonotremarktotalfirst+$infonotremarktotal_1-$infonotremarktotalpay_1+$infonotremarktotal_2)-$infonotremarktotalpay_2)+$infonotremarktotal_3)-$infonotremarktotalpay_3,2)}}</td>
                        </tr> 
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ของแถม</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotribonus_3}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotribonustotalfirst+$infotribonustotal_1 - $infotribonustotalpay_1+$infotribonustotal_2) - $infotribonustotalpay_2,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotal_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infotribonustotalfirst+$infotribonustotal_1 - $infotribonustotalpay_1+$infotribonustotal_2) - $infotribonustotalpay_2)+$infotribonustotal_3)-$infotribonustotalpay_3,2)}}</td>
                        </tr> 
                        </tbody>
                    </table>
    
                   
                    <br>
    
    
                      <table class="table-striped table-vcenter " style="width: 100%;">
                        <thead style="background-color: #50cedf;">
                            <tr height="40">    
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการละเอียด</th>
    
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="40%">รายการจ่าย</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="40%" >มูลค่าการจ่าย</th>
                                
    
                              
                      
                            </tr >
                        </thead>
                        <tbody>   
                            <tr height="20">   
                                <td class="text-font text-pedding" style="border: 1px solid black;">รพสต.</td>
                                <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infohcenter_3}}</td>
                                <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infohcentertotalpay_3,2)}}</td>
                            </tr> 
                            </tbody>
                        </table>
                        <br><br>  

                ไตรมาส 4 กรกฎาคม - กันยายม
                <table class="table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">    
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการละเอียด</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" >จำนวนรายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าการยกมา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าการรับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" >มูลค่าการจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">มูลค่าคงเหลือ</th>

                          
                  
                        </tr >
                    </thead>
                    <tbody>     
         
                   
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">จำนวนทั้งหมด</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriall_4}}</td>
                           
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infotrialltotalrecivefirst+$infotrialltotal_1-$infotrialltotalpay_1+$infotrialltotal_2)-$infotrialltotalpay_2)+$infotrialltotal_3)-$infotrialltotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotal_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotrialltotalpay_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format((((($infotrialltotalrecivefirst+$infotrialltotal_1-$infotrialltotalpay_1+$infotrialltotal_2)-$infotrialltotalpay_2)+$infotrialltotal_3)-$infotrialltotalpay_3+$infotrialltotal_4)-$infotrialltotalpay_4,2)}}</td>
                                  
                        </tr>    
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาสืบเขต</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotricounty_4}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infotricountytotalfirst+$infotricountytotal_1 - $infotricountytotalpay_1+$infotricountytotal_2) - $infotricountytotalpay_2)+$infotricountytotal_3)-$infotricountytotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotal_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotricountytotalpay_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format((((($infotricountytotalfirst+$infotricountytotal_1 - $infotricountytotalpay_1+$infotricountytotal_2) - $infotricountytotalpay_2)+$infotricountytotal_3)-$infotricountytotalpay_3+$infotricountytotal_4) - $infotricountytotalpay_4,2)}}</td>       
                        </tr> 
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาสืบจังหวัด</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriprovince_4}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infotriprovincetotalfirst+$infotriprovincetotal_1 - $infotriprovincetotalpay_1+$infotriprovincetotal_2) - $infotriprovincetotalpay_2)+$infotriprovincetotal_3)-$infotriprovincetotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotal_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriprovincetotalpay_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format((((($infotriprovincetotalfirst+$infotriprovincetotal_1 - $infotriprovincetotalpay_1+$infotriprovincetotal_2) - $infotriprovincetotalpay_2)+$infotriprovincetotal_3)-$infotriprovincetotalpay_3+$infotriprovincetotal_4) - $infotriprovincetotalpay_4,2)}}</td>
                        </tr> 
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาจัดซื้อเอง</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotriself_4}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infotriselftotalfirst+$infotriselftotal_1-$infotriselftotalpay_1+$infotriselftotal_2)-$infotriselftotalpay_2)+$infotriselftotal_3)-$infotriselftotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotal_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotriselftotalpay_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format((((($infotriselftotalfirst+$infotriselftotal_1-$infotriselftotalpay_1+$infotriselftotal_2)-$infotriselftotalpay_2)+$infotriselftotal_3)-$infotriselftotalpay_3+$infotriselftotal_4)-$infotriselftotalpay_4,2)}}</td>  
                        </tr> 
                                 
                        <tr height="20">   
                           
                            <td class="text-font text-pedding" style="border: 1px solid black;">ราคาไม่ระบุ</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infonotremark_4}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(((($infonotremarktotalfirst+$infonotremarktotal_1-$infonotremarktotalpay_1+$infonotremarktotal_2)-$infonotremarktotalpay_2)+$infonotremarktotal_3)-$infonotremarktotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotal_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infonotremarktotalpay_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format((((($infonotremarktotalfirst+$infonotremarktotal_1-$infonotremarktotalpay_1+$infonotremarktotal_2)-$infonotremarktotalpay_2)+$infonotremarktotal_3)-$infonotremarktotalpay_3+$infonotremarktotal_4)-$infonotremarktotalpay_4,2)}}</td>
                        </tr> 
    
                        <tr height="20">   
                            <td class="text-font text-pedding" style="border: 1px solid black;">ของแถม</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infotribonus_4}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotalfirst+$infotribonustotal_3 - $infotribonustotalpay_3,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotal_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infotribonustotalpay_4,2)}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format(($infotribonustotalfirst+$infotribonustotal_3 - $infotribonustotalpay_3+$infotribonustotal_4) - $infotribonustotalpay_4,2)}}</td>
                        </tr> 
                        </tbody>
                    </table>
    
                   
                    <br>
    
    
                      <table class="table-striped table-vcenter " style="width: 100%;">
                        <thead style="background-color: #50cedf;">
                            <tr height="40">    
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการละเอียด</th>
    
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="40%">รายการจ่าย</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="40%" >มูลค่าการจ่าย</th>
                                
    
                              
                      
                            </tr >
                        </thead>
                        <tbody>   
                            <tr height="20">   
                                <td class="text-font text-pedding" style="border: 1px solid black;">รพสต.</td>
                                <td class="text-font text-pedding" style="border: 1px solid black;" align="center">{{$infohcenter_4}}</td>
                                <td class="text-font text-pedding" style="border: 1px solid black;" align="right">{{number_format($infohcentertotalpay_4,2)}}</td>
                            </tr> 
                            </tbody>
                        </table>
                        <br><br> 
               
                <br>
            </div>
        </div>
    </div>    
</div>


  
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
    <script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>

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

<script>

 $(document).ready(function() {
           $('select').select2({
           width: '100%'
       });

    });

function detail(id){


$.ajax({
           url:"{{route('warehouse.detailappall')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);


              //alert("Hello! I am an alert box!!");
           }

   })

}



function detaillast(id){


$.ajax({
           url:"{{route('warehouse.detailappall')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detaillastappall'+id).html(result);


              //alert("Hello! I am an alert box!!");
           }

   })

}


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    

    $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });


</script>

@endsection