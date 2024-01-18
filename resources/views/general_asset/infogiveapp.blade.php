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

      .form-control{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      }   

      input::-webkit-calendar-picker-indicator{ 
  
    font-family: 'Kanit', sans-serif;
            font-size: 14px;
        
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
  $datenow = date('Y-m-d');
  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

?>  


                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                             <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
                             <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div>
                                <a href="{{ url('general_asset/dashboard/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a> 
                                </div>
                                <div>&nbsp;</div>     
                                <div>
                                <a href="{{ url('general_asset/genassetindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนครุภัณฑ์</a> 
                                </div>
                                <div>&nbsp;</div>                      
                                <div>
                                <a href="{{ url('general_asset/genassetdisburseindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนเบิกครุภัณฑ์  
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infolendindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนยืม
                                </a>   
                                </div>           
                                <div>&nbsp;</div>
                                <div>

                                <a href="{{ url('general_asset/infogiveindex/'.$inforpersonuserid -> ID)}}" class="btn btn-danger loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ทะเบียนถูกยืม

                                </a>   
                                </div>    
                         
                                
                                </div>
                                </ol>
                            </nav> 
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลขอยืมครุภัณฑ์</B></h3>

</div>
<div class="block-content block-content-full" align="left">

<form  method="post" action="{{ route('asset.updategiveapp') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="ID" id="ID" value="{{$inforequest->ID}}">

        <input type="hidden" name="iduser" id="iduser" value="{{$inforpersonuserid->ID}}">

    
      
    <div class="row">

  

        <div class="col-sm-10">
 
        
       <div class="row">
        <div class="col-lg-2">
        <label>ผู้ขอยืม:</label>
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
        <label>วันที่ยืม :</label>
        </div> 
        <div class="col-lg-4">
        {{DateThai($inforequest->DATE_LEND)}}  
        </div> 
        </div> 

             
        <div class="row">
        <div class="col-lg-2">
        <label>ขอยืมเพื่อ:</label>
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
                                                        <td class="text-font text-pedding" >{{$infoassetrequest->ASSET_REQUEST_LEND_SUB_NUMBER}}</td>
                                                        <td class="text-font text-pedding" >{{$infoassetrequest->ASSET_REQUEST_LEND_SUB_DETAIL}}</td>
                                                        <td class="text-font text-pedding" >{{$infoassetrequest->ASSET_REQUEST_LEND_SUB_UNIT}}</td>
                                                        <td class="text-font text-pedding" >{{$infoassetrequest->ASSET_REQUEST_LEND_SUB_PRICE}}</td>
                                                


                                                        <td align="center">
                                                                <div class="dropdown">
                                                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                                            ทำรายการ
                                                                    </button>
                                                                <div class="dropdown-menu" style="width:10px">

                                                                    <a class="dropdown-item"  href="{{ url('general_asset/infogiveapp/destroy/'.$inforpersonuserid->ID.'/'.$inforequest -> ID.'/'.$infoassetrequest -> ASSET_REQUEST_LEND_SUB_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a>                                                   
                                                                
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
                                <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" >ไม่อนุมัติ</button>
                                <a href="{{ url('general_asset/infogiveindex/'.$inforpersonuserid->ID)  }}" class="btn btn-warning btn-lg" >ปิดหน้าต่าง</a>
                            
                                </div>
                            </div>

                            </form>  

   
                  

@endsection

@section('footer')



@endsection