@extends('layouts.backend')



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

?>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

            p {
	
                word-wrap:break-word;
                }
                .text{
                    font-family: 'Kanit', sans-serif;
                     
                }
                table, td, th {
            border: 1px solid black;
            }  
</style>
         <!-- Advanced Tables -->
         <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                         
                              
                                <div >
                                <a href="{{ url('person_guesthouse/guesthouse_info/'.$id_user)}}" class="btn btn-info loadscreen" >รายละเอียดบ้านพัก</a>
                                </div>
                                <div>&nbsp;</div>
                             
                                <div>
                                        <a href="{{ url('person_guesthouse/guesthouse_petition/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">         
                                        ยื่นคำร้อง
                                        </a>
                                    </div>
                                <div>&nbsp;</div>
                                @if($ckeckleave !== 0)
                                <div >
                                <a href="{{ url('person_guesthouse/guesthouse_problem/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนแจ้งปัญหา</a>
                                </div>
                                <div>&nbsp;</div>
                           
                               @endif

                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">


            @if($ckeckleave !== 0)

            <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดบ้านพัก</B></h3>
                 
            </div>
            <div class="block-content">

          
            <div class="row" >

                    <div class="col-sm-2" style="font-family: 'Kanit', sans-serif;">
                        <label>ชื่ออาคาร :</label>
                    </div> 
                    <div class="col-lg-10 " style="font-family: 'Kanit', sans-serif;">
                        {{$detailstay->INFMATION_NAME}}
                    </div> 

            </div>
            <div class="row" >

                    <div class="col-sm-2" style="font-family: 'Kanit', sans-serif;">
                        <label>ชั้น :</label>
                    </div> 
                    <div class="col-lg-4 " style="font-family: 'Kanit', sans-serif;">
                        {{$detailstay->LOCATION_LEVEL_NAME}}
                    </div> 

                    <div class="col-sm-2" style="font-family: 'Kanit', sans-serif;">
                        <label>ห้อง :</label>
                    </div> 
                    <div class="col-lg-4 " style="font-family: 'Kanit', sans-serif;">
                        {{$detailstay->LEVEL_ROOM_NAME}}
                    </div> 

            </div>
            <div class="row" >

                    <div class="col-sm-2" style="font-family: 'Kanit', sans-serif;">
                        <label>ประเภทที่พัก :</label>
                    </div> 
                    <div class="col-lg-4 " style="font-family: 'Kanit', sans-serif;">

                    @if($detailstay->INFMATION_TYPE == '1')
                        แฟลต
                    @else
                       บ้านพัก  
                    @endif
                      
                    </div> 

                    <div class="col-sm-2" style="font-family: 'Kanit', sans-serif;">
                        <label>สถานะที่พัก :</label>
                    </div> 
                    <div class="col-lg-4 " style="font-family: 'Kanit', sans-serif;">
                      

                        
                    @if($detailstay->INFMATION_STATUS == '1')
                        ปกติ
                    @elseif($detailstay->INFMATION_STATUS == '2')
                       ปิดปรับปรุง  
                       @elseif($detailstay->INFMATION_STATUS == '3')
                       ซ่อมแซม
                       @else
                       จำหน่าย  
                    @endif
                    </div> 

            </div>

            <br>
            
            
            
            <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #E6E6FA;">
                                    <li class="nav-item">
                                
                                    <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคคลเข้าพัก</a>
                                    </li>
                                    <li class="nav-item">

                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคคลภายนอก</a>
                                 
                                       
                                    
                                    </li>
                                    <li class="nav-item">
                                 
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ครุภัณฑ์</a>
                             

                                    </li>
                                    <li class="nav-item">
                                  
                                        <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บันทึกซ่อมแซม</a>
                               
                                       
                                    </li>
                                  

                                  
                                </ul>
                                     <div class="block-content tab-content">
    
                                      
                                        <div class="tab-pane active" id="object1" role="tabpanel">
                                   
                                       


                                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                                    <thead style="background-color: #FFEBCD;">
                                                        <tr height="40">
                                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="20%">ชื่อ-นามสกุล</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">ตำแหน่ง</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">หน่วยงาน</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">สถานะ</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">วันที่เข้า</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">วันที่ออก</td>
                                                      
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody2">
                                                    <?php $number = 0; ?>
                                                         @foreach ($infoguesthouspersons as $infoguesthousperson)
                                                    <?php $number++; ?>

                                                
                                                        <tr height="20">
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                                                {{$number}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{ $infoguesthousperson->HR_FNAME}}  {{ $infoguesthousperson->HR_LNAME}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{ $infoguesthousperson->POSITION_IN_WORK}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{ $infoguesthousperson->HR_DEPARTMENT_SUB_SUB_NAME}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                                            @if($infoguesthousperson->INFMATION_PERSON_STATUS == '2')
                                                                ย้ายออกแล้ว
                                                            @else
                                                                ปกติ
                                                            @endif
                                                           
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                                            {{ DateThai($infoguesthousperson->INFMATION_PERSON_INDATE)}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                                            @if($infoguesthousperson->INFMATION_PERSON_OUTDATE !== null)
                                                            {{ DateThai($infoguesthousperson->INFMATION_PERSON_OUTDATE)}}
                                                            @endif
                                                          
                                                            </td>
                                                        
                                                          
                                                        </tr>



                                                
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                        </div>


                                        <div class="tab-pane" id="object2" role="tabpanel">
                                    
                                      
                                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                                    <thead style="background-color: #FFEBCD;">
                                                        <tr height="40">
                                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ชื่อ-นามสกุล</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"width="10%">ความสัมพันธ์</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >สัมพันธ์กับ</td> 
                                                     
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody1">
                                                    <?php $number = 0; ?>
                                                         @foreach ($infoguesthousoutsiders as $infoguesthousoutsider)
                                                    <?php $number++; ?>
                                                
                                                        <tr height="20">
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                                               {{$number}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{$infoguesthousoutsider->INFMATION_OUTSIDER_NAME}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp;  {{$infoguesthousoutsider->INFMATION_OUTSIDER_RELATION}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp;  {{ $infoguesthousperson->HR_FNAME}}  {{ $infoguesthousperson->HR_LNAME}}
                                                            </td>
                                                          
                                                          
                                                           
                                                        </tr>


                                                        @endforeach
                                                    </tbody>
                                                </table>
                                  </div>
                                            <div class="tab-pane" id="object3" role="tabpanel">
                              
                                     
                                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                                    <thead style="background-color: #FFEBCD;">
                                                        <tr height="40">
                                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เลขอ้างอิง</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รายการ</td>
                                                          
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">มูลค่า</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">วันที่ซื้อ</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">วันที่จำหน่าย</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">สถานะ</td>
                                                         
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody3">
                                                    <?php $number = 0; ?>
                                                         @foreach ($infoguesthousassets as $infoguesthousasset)
                                                    <?php $number++; ?>
                                                
                                                        <tr height="20">
                                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                {{$number}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{$infoguesthousasset->INFMATION_ASSET_NUMBER}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{$infoguesthousasset->INFMATION_ASSET_NAME}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{number_format($infoguesthousasset->INFMATION_ASSET_VALUE,2)}}
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                                            {{DateThai($infoguesthousasset->INFMATION_ASSET_BUYDATE)}}
                                                            </td>
                                                            <td>
                                                            @if($infoguesthousasset->INFMATION_ASSET_DISDATE != '' || $infoguesthousasset->INFMATION_ASSET_DISDATE != null)
                                                            {{DateThai($infoguesthousasset->INFMATION_ASSET_DISDATE)}}
                                                            @endif
                                                            </td>
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                           @if($infoguesthousasset->INFMATION_ASSET_STATUS == '1')
                                                                    ปกติ
                                                           @elseif($infoguesthousasset->INFMATION_ASSET_STATUS == '2')
                                                                    ซ่อมแซม
                                                           @else
                                                                   จำหน่าย         
                                                           @endif
                                                            </td>
                                                          
                                                          
                                                       
                                                        </tr>

                         


                                                        @endforeach
                                                    </tbody>
                                                </table>

                                  </div>
                                        <div class="tab-pane" id="object4" role="tabpanel">
                                
                                       
                                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                                    <thead style="background-color: #FFEBCD;">
                                                        <tr height="40">
                                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ซ่อมแซม</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">มูลค่าซ่อมแซม</td>
                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">วันที่ซ่อม</td>
                                                          
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody4">
                                                    <?php $number = 0; ?>
                                                         @foreach ($infoguesthousrepairs as $infoguesthousrepair)
                                                    <?php $number++; ?>
                                                
                                                        <tr height="20">
                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                                               {{$number}}
                                                            </td>
                                                            <td class="text-font text-pedding"  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{$infoguesthousrepair->INFMATION_REPAIR_NAME}}
                                                            </td>
                                                            <td class="text-font text-pedding"  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{number_format($infoguesthousrepair->INFMATION_REPAIR_VALUE,2)}}
                                                            </td>
                                                            <td class="text-font text-pedding"  style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                                                &nbsp; {{DateThai($infoguesthousrepair->INFMATION_REPAIR_DATE)}}
                                                            </td>
                                                        
                                                       
                                                        </tr>


                                                        @endforeach
                                                    </tbody>
                                                </table>
                                        </div>


                            
<br>
                                    </div>
            
            
            
            
            
            
            <br>








            @else

            <div class="row" > 
                                    @foreach ($infoinfomations as $infoinfomation) 

                                    @if($infoinfomation->INFMATION_TYPE == 1)



<div class="col-md-6 col-xl-4">
        <!-- Story #1 -->
        <a href="{{ url('person_guesthouse/guesthouse_infohotel/'.$infoinfomation->INFMATION_ID.'/'.$id_user)}}" class="block block-rounded"  href="javascript:void(0)">

            <div class="block-content" style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($infoinfomation->IMG)) }});">
                <p>
                <span class="badge badge-info font-w2000 p-2 text-uppercase">
                {{$infoinfomation->INFMATION_NAME}}
                </span>
                </p>
            <div class="mb-3 mb-sm-3 d-sm-flex justify-content-sm-between align-items-sm-center">

                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($infoinfomation->IMG)) }}" height="200px" width="100%">

                </div>



            </div>
        </a>
        <!-- END Story #1 -->
    </div>
@else

<div class="col-md-6 col-xl-4">
        <!-- Story #1 -->
        <a href="{{ url('person_guesthouse/guesthouse_infohome/'.$infoinfomation->INFMATION_ID.'/'.$id_user)}}" class="block block-rounded"  href="javascript:void(0)">

            <div class="block-content" style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($infoinfomation->IMG)) }});">
                <p>
                <span class="badge badge-info font-w2000 p-2 text-uppercase">
                {{$infoinfomation->INFMATION_NAME}} ::
                <?php $checkhom = DB::table('guesthous_infomation_person')->where('INFMATION_ID','=',$infoinfomation->INFMATION_ID)->where('INFMATION_PERSON_STATUS','=','1')->count(); ?>
                                                @if($checkhom !== 0)
                                                    ไม่ว่าง
                                                @else
                                                    ว่าง
                    @endif
                </span>
                </p>
            <div class="mb-3 mb-sm-3 d-sm-flex justify-content-sm-between align-items-sm-center">

                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($infoinfomation->IMG)) }}" height="200px" width="100%">

                </div>



            </div>
        </a>
        <!-- END Story #1 -->
    </div>



@endif

                        
                                    @endforeach     



        </div>

          @endif


        </div>
   

    <script src="{{ asset('google/Charts.js') }}"></script>


@endsection