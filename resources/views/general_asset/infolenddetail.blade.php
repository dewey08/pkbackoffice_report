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

<body onload="run01();">
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                             <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
                             <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div>
                                <a href="{{ url('general_asset/dashboard/'.$inforpersonuserid -> ID)}}"  class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a> 
                                </div>
                                <div>&nbsp;</div>     
                                <div>
                                <a href="{{ url('general_asset/genassetindex/'.$inforpersonuserid -> ID)}}"  class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนครุภัณฑ์</a> 
                                </div>
                                <div>&nbsp;</div>                      
                                <div>
                                <a href="{{ url('general_asset/genassetdisburseindex/'.$inforpersonuserid -> ID)}}"  class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนเบิกครุภัณฑ์  
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infolendindex/'.$inforpersonuserid -> ID)}}" class="btn btn-info" >ทะเบียนยืม
                                </a>   
                                </div>           
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infogiveindex/'.$inforpersonuserid -> ID)}}"  class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนถูกยืม
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">รายละเอียดการขอยืมทรัพย์สิน</h2> 
                        
       
       

       <div class="row push">
            <div class="col-sm-2">
                <label>ผู้ขอเบิก :</label>
            </div> 
            <div class="col-lg-4">
            {{$infoassetrequestlend -> SAVE_HR_NAME}} 
            
            </div> 
           
            <div class="col-sm-2">
                <label>หน่วยงานผู้ขอเบิก :</label>
            </div> 
            <div class="col-lg-4">
            {{$infoassetrequestlend -> DEP_SUB_SUB_NAME}}

   
          
            </div>
         
        </div>
       <div class="row push">
            <div class="col-sm-2">
                <label>ขอเบิกจากหน่วยงาน :</label>
            </div> 
            <div class="col-lg-4">
            
            {{$infoassetrequestlend->GIVE_DEP_SUB_SUB_NAME }}
            
            </div>
            <div class="col-sm-2">
                <label>เหตุผลการขอยืม :</label>
            </div> 
            <div class="col-lg-4">
           
            {{$infoassetrequestlend->REQUEST_FOR }}
            </div>


           
        </div>

        <div class="row push">
            <div class="col-sm-2">
                <label>วันที่ต้องการ :</label>
            </div> 
            <div class="col-lg-4">
           
            {{ dateThaifromFull($infoassetrequestlend->DATE_WANT) }}
            </div>
            <div class="col-sm-2">
                <label>วันที่ขอยืม :</label>
            </div> 
            <div class="col-lg-4">
           
            {{dateThaifromFull($infoassetrequestlend->DATE_LEND) }}
            </div>


           
        </div>

    

       <table class="table gwt-table" >
            <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    
                    <td style="text-align: center;">ครุภัณฑ์ที่ต้องการยืม </td>
           
                
              
                </tr>
            </thead>
            <tbody class="tbody1">
            @foreach ($infoassetrequestlendsubs as $infoassetrequestlendsub) 
                <tr height="20">
                 
                  
                    <td class="text-font text-pedding" >{{ $infoassetrequestlendsub -> ASSET_REQUEST_LEND_SUB_NUMBER }} :: {{ $infoassetrequestlendsub -> ASSET_REQUEST_LEND_SUB_DETAIL }}</td> 
                 

                  

                </tr>
                @endforeach 
            </tbody>
        </table>
              <br> 
        <div class="modal-footer">
            <div align="right">
              
                    <a href="{{ url('general_asset/infolendindex/'.$inforpersonuserid -> ID) }}" class="btn btn-secondary btn-lg"  >ปิดหน้าต่าง</a>
            </div>
        </div>
    </form>  

   
                  

@endsection

@section('footer')




@endsection