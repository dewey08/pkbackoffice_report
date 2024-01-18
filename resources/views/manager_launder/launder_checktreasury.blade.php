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

 
    use App\Http\Controllers\ManagerlaunderController;

?>         
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  style="text-align: left;">
               <div class="row">
                <div class="col">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>คลังย่อย</B></h3>
                </div>
            
               
                </div>

            </div>
            <div class="block-content ">
             
              
            <div class="col-lg-12" style="height:50%;">

            <form action="{{ route('launder.launder_checktreasury') }}" method="post">
                    @csrf

                    <div class="row">
             

                            <div class="col-sm-0.5">
                            &nbsp;คลัง &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>
                            <select name="SEND_DEP" id="SEND_DEP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">

                            <option value="">ทั้งหมด</option>

                            @foreach ($infodeps as $infodep)  
                                 @if($infodep->LAUNDER_DEP_CODE == $depid_check)
                                    <option value="{{$infodep->LAUNDER_DEP_CODE}}" selected>{{ $infodep->LAUNDER_DEP_NAME}}</option>
                                @else
                                    <option value="{{$infodep->LAUNDER_DEP_CODE}}" >{{ $infodep->LAUNDER_DEP_NAME}}</option>
                                @endif
                            @endforeach 
                            


                            </select>
                            </span>
                            </div> 

                            <div class="col-sm-0.5">
                            &nbsp;ค้นหา &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>

                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                            </span>
                            </div>

                            <div class="col-sm-30">
                            &nbsp;
                            </div> 
                            <div class="col-sm-1">
                            <span>
                            <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ค้นหา</button>
                            </span> 
                            </div>


                                        
                                            </div>  
                            </form>




             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #48D1CC;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" >คลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" >รับเข้า</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" >จ่ายออก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" >คงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="5%">เรียกดู</th> 
                            
                        </tr >
                    </thead>
                    <tbody>
                   
                    <?php $number=1; ?>
                        @foreach ($infotreasurys as $infotreasury)
                       
                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                        <td class="text-font text-pedding" >{{$infotreasury->LAUNDER_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infotreasury->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{number_format(ManagerlaunderController::sumtreasuryreceive($infotreasury->LAUNDER_DIS_SUB_TYPE,$infotreasury->LAUNDER_DIS_DEP))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{number_format(ManagerlaunderController::sumtreasurypay($infotreasury->LAUNDER_DIS_SUB_TYPE,$infotreasury->LAUNDER_DIS_DEP))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{number_format(ManagerlaunderController::sumtreasuryreceive($infotreasury->LAUNDER_DIS_SUB_TYPE,$infotreasury->LAUNDER_DIS_DEP)-ManagerlaunderController::sumtreasurypay($infotreasury->LAUNDER_DIS_SUB_TYPE,$infotreasury->LAUNDER_DIS_DEP))}}</td>
                       
                     
                        
                        <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                <div class="dropdown-menu" style="width:10px">
                              
                                <a class="dropdown-item" href="{{ url('manager_launder/launder_checktreasury_sub/'.$infotreasury->LAUNDER_DIS_SUB_TYPE.'/'.$infotreasury->LAUNDER_DIS_DEP)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">เรียกดู</a>
                                <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                </div>
                                </div>
                            </td> 
                        
                        </tr>
                        <?php $number++; ?>
                        @endforeach  


                      
                  

                    </tbody>
                </table>
                <br>
               
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