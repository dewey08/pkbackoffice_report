@extends('layouts.launder')   
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
    padding-right:10px;
                        }

            .text-font {
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

 
    use App\Http\Controllers\ManagerwarehouseController;
?>
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  style="text-align: left;">
             
               
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการผ้า :: {{$infotype->LAUNDER_TYPE_NAME}}</B></h3>
                <div align="right">

<a href="{{ url('manager_launder/launder_checkstock') }}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ย้อนกลับ</a>
</div>
            </div>
            <div class="block-content ">
             
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #E9967A;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">รายการรับเข้าผ้า</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">รายการเบิกจ่ายผ้า</a>
                                    </li>


                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">

                                    <div class="row push" style="text-align: left;">
                               
                                         <div class="col-sm-1">
                                                <label>วันที่รับ :</label>
                                         </div> 
                                         <div class="col-sm-2">        
                                             <input name="DATE" id="DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 10px;" readonly>
                                        </div>
                                        <div class="col-sm-1">
                                                <label>ถึง</label>
                                         </div> 
                                         <div class="col-sm-2">        
                                             <input name="DATE" id="DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 10px;" readonly>
                                        </div>
                                        <div class="col-sm-1">
                                        <button type="submit"  class="btn btn-info btn-sm" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">ค้นหา</button> 
                                         </div>
                
                                    </div>
           
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #F0F8FF;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >วันที่รับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เวลา</th>
                
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รับเข้า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รับจาก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ชื่อหน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ผู้รับ</th>
                        </tr >
                    </thead>
                    <tbody>
              
                        
                        <?php $number=1; ?>
                        @foreach ($storereceivesubs as $storereceivesub)

                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                        <td class="text-font text-pedding" >{{DateThai($storereceivesub->LAUNDER_CHECK_DATE)}}</td>
                        <td class="text-font text-pedding" >{{$storereceivesub->LAUNDER_CHECK_TIME}}</td>
                        <td class="text-font text-pedding" >{{$infotype->LAUNDER_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$storereceivesub->LAUNDER_CHECK_SUB_AMOUNT}}</td>
                        <td class="text-font text-pedding" >{{$storereceivesub->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                        <td class="text-font text-pedding" >
                        @if($storereceivesub->LAUNDER_CHECK_FROM == '2')
                                ภายนอกองค์กร
                             @else
                                 ภายในองค์กร
                             @endif
                        </td>
                        <td class="text-font text-pedding" >{{$storereceivesub->LAUNDER_CHECK_ACCEPT}}</td>
                        <td class="text-font text-pedding" >{{$storereceivesub->LAUNDER_CHECK_HR_NAME}}</td>
                  

                        </tr>

                        <?php $number++; ?>
                        @endforeach  
                    
            
                     
                  

                    </tbody>
                </table>
                <br>




                                    </div>

                                    <div class="tab-pane" id="object2" role="tabpanel">

                                    <div class="row push" style="text-align: left;">
                               
                               <div class="col-sm-1">
                                      <label>วันที่รับ :</label>
                               </div> 
                               <div class="col-sm-2">        
                                   <input name="DATE" id="DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 10px;" readonly>
                              </div>
                              <div class="col-sm-1">
                                      <label>ถึง</label>
                               </div> 
                               <div class="col-sm-2">        
                                   <input name="DATE" id="DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 10px;" readonly>
                              </div>
                              <div class="col-sm-1">
                              <button type="submit"  class="btn btn-info btn-sm" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">ค้นหา</button> 
                               </div>
      
                          </div>

                                
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFF8DC;">
                      
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >วันที่จ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เวลา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >จ่ายออก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ผู้จัดสรร</th>
                     
                        </tr >
                    </thead>
                    <tbody>
                   
                    <?php $number=1; ?>
                        @foreach ($storeexportsubs as $storeexportsub)

                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                        <td class="text-font text-pedding" >{{DateThai($storeexportsub->LAUNDER_DIS_DATE)}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->LAUNDER_DIS_TIME}}</td>
                        <td class="text-font text-pedding" >{{$infotype->LAUNDER_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->LAUNDER_DIS_SUB_AMOUNT}}</td>
                        <td class="text-font text-pedding" >{{$storeexportsub->LAUNDER_DIS_HR_NAME}}</td>
                   
                        </tr>

                        <?php $number++; ?>
                        @endforeach  
            
                     
                  

                    </tbody>
                </table>
                <br>





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
                autoclose: true                    //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
    </script>
@endsection