@extends('layouts.asset')

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

    
      .form-control {
    font-size: 13px;
                  }   


                  table {
            border-collapse: collapse;
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


?>
<?php
  $date = date('Y-m-d');
  
?>
<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการอาคาร สิ่งก่อสร้าง</B></h3>
                            <div align="right">

        <a href="{{ url('manager_asset/assetinfobuilding_add') }}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;;font-weight:normal;" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
        </div>
                        </div>
                        <div class="block-content block-content-full">

                          <form method="post">
                          @csrf
                        
                          <div class="row">
                          <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
                            </span>
                        </div>


            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
                    </div>
                    </div>

                </div>
                                                    <div class="col-sm-0.5" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">
                                                    &nbsp;งบประมาณ &nbsp;
                                                </div>
                                                <div class="col-sm-2">
                                                    <span>
                                                        <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                                                            <option value="">--เลือกงบประมาณ--</option>                               
                                                              @foreach ($suppliesbudgets as $suppliesbudget)
                                                                    @if($suppliesbudget->BUDGET_ID == $status_check)                                                     
                                                                    <option value="{{ $suppliesbudget ->BUDGET_ID  }}" selected>{{ $suppliesbudget->BUDGET_NAME}}</option>
                                                                    @else
                                                                    <option value="{{ $suppliesbudget ->BUDGET_ID  }}">{{ $suppliesbudget->BUDGET_NAME}}</option>
                                                                    @endif
                                                              
                                                              @endforeach                                                                                                  
                                                        </select>
                                                    </span>                   
                                                </div>
                                                    <div class="col-sm-2">
                                                    <span>
                                                    <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" value="{{$search}}"> 
                                                    </span>
                                                    </div>
                                                    <div class="col-sm-30">
                                                        &nbsp;
                                                        </div>
                                                    <div class="col-sm-2 text-left">
                                                    <span>
                                                    <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;;font-weight:normal;"> <i class="fas fa-search"></i> &nbsp;ค้นหา</button>
                                                    </span> 
                                                    </div>
                                              </div>


                                            </form>

                
             </form>
            
             <div class="table-responsive">                 
                  
             <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                                      <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="5%">ลำดับ</th>
                                       
                                       <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" >ชื่ออาคาร</th>

                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="15%">จำนวนเงิน</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%">วันที่เริ่มสร้าง</th> 


                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="5%">อายุ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">งบประมาณ</th>  
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;"  width="12%">คำสั่ง</th>   
                                       
                                      
    
                                </tr>
                                </thead>
                                <tbody >
   
  
                                <?php $number = 0; ?>
                                @foreach ($assetinfobuildings as $assetinfobuilding)
                                <?php $number++; ?>

                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font text-pedding">{{$assetinfobuilding->BUILD_NAME}}</td>
                              
                                        <td class="text-font text-pedding" align="right" >{{number_format($assetinfobuilding->BUILD_NGUD_MONEY,2)}}</td>
                                        <td class="text-font" align="center">{{DateThai($assetinfobuilding->BUILD_CREATE)}}</td>

   
                                        <td class="text-font " align="center">{{ $assetinfobuilding->OLD_USE }}</td>
                                        <td class="text-font " align="center">{{$assetinfobuilding->BUDGET_NAME}}</td>
                                        <td class="text-font " align="center">

                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="#detail_modal{{ $assetinfobuilding -> ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด</a>
                                                <a class="dropdown-item" href="{{ url('manager_asset/assetinfobuilding/edit/'.$assetinfobuilding->ID) }}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item"  href="#detail_depreciate"  data-toggle="modal"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="depreciatebuilding({{$assetinfobuilding->ID}});"><i class="far fa-file-alt text-info mr-2"></i>ค่าความเสื่อม</a>
                                                    <a class="dropdown-item" href="{{ url('manager_asset/setassetinfolocationlevel/'.$assetinfobuilding-> ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" ><i class="fas fa-plus text-danger mr-2"></i> เพิ่มข้อมูลชั้นและห้อง</a>


                                                  
                                                </div>
                                        
                                        </td>
                                     
                                    </tr>



                                    <div id="detail_modal{{ $assetinfobuilding -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
     
    <div class="row">
    <div>&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดอาคารสิ่งปลูกสร้าง&nbsp;&nbsp;</div>
    </div>
        </div>
        <div class="modal-body">

<div class="row">
  <div class="col-sm-9">

        <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ปลูกบนที่ดิน :</label>
           </div>                               
       </div> 
       <div class="col-sm-4">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->LAND_RAWANG }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >อัตราเสื่อม  :</label>
           </div>                               
       </div>  
       <div class="col-sm-4">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->DECLINE_NAME }}</h1>
           </div>                               
       </div>  
      
       </div>

       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ชื่อสิ่งปลูกสร้าง :</label>
           </div>                               
       </div> 
       <div class="col-sm-4">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->BUILD_NAME }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >งบประมาณ  :</label>
           </div>                               
       </div>  
       <div class="col-sm-4">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->BUDGET_NAME }}</h1>
           </div>                               
       </div>  
      
       </div>

       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >วิธีได้มา :</label>
           </div>                               
       </div> 
       <div class="col-sm-4">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->METHOD_NAME }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >วิธีการซื้อ  :</label>
           </div>                               
       </div>  
       <div class="col-sm-4">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->BUY_NAME }}</h1>
           </div>                               
       </div>  
      
       </div>


       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ใช้งบประมาณ :</label>
           </div>                               
       </div> 
       <div class="col-sm-4">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{number_format($assetinfobuilding->BUILD_NGUD_MONEY,2) }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >จำนวน  :</label>
           </div>                               
       </div>  
       <div class="col-sm-4">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->TOTAL }}</h1>
           </div>                               
       </div>  
      
       </div>

       
       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >อายุการใช้งาน :</label>
           </div>                               
       </div> 
       <div class="col-sm-4">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->OLD_USE }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันที่สร้าง  :</label>
           </div>                               
       </div>  
       <div class="col-sm-4">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($assetinfobuilding->BUILD_CREATE) }}</h1>
           </div>                               
       </div>  
      
       </div>

       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันที่แล้วเสร็จ :</label>
           </div>                               
       </div> 
       <div class="col-sm-4">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($assetinfobuilding->BUILD_FINISH) }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันที่ส่งมอบ  :</label>
           </div>                               
       </div>  
       <div class="col-sm-4">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($assetinfobuilding->TRANSFER_DATE) }}</h1>
           </div>                               
       </div>  
      
       </div>

       
       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ผู้รับผิดชอบ :</label>
           </div>                               
       </div> 
       <div class="col-sm-4">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->HR_FNAME }} {{$assetinfobuilding->HR_LNAME }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >เบอร์ติดต่อ  :</label>
           </div>                               
       </div>  
       <div class="col-sm-4">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->BUILD_HR_TEL }}</h1>
           </div>                               
       </div>  
      
       </div>

       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >วิศวกร :</label>
           </div>                               
       </div> 
       <div class="col-sm-4">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->ENGINEER_NAME }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >หมายเหตุ  :</label>
           </div>                               
       </div>  
       <div class="col-sm-4">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfobuilding->COMMENT }}</h1>
           </div>                               
       </div>  
      
       </div>



        </div> 
       <div class="col-sm-3">

       <img src="data:image/png;base64,{{chunk_split(base64_encode($assetinfobuilding->IMG))}}"  alt="กรุณาเพิ่มรูปภาพ" height="200" width="200"/>
       </div> 
     


      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;;font-weight:normal;">ปิดหน้าต่าง</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>

                                    @endforeach   
                      </tbody>
                    </table>
                    
              </div>
              <br>
              <div style="font-family: 'Kanit', sans-serif; font-size: 15px;font-size: 1.0rem;font-weight:normal;">จำนวน {{$countbuilding}} รายการ</div>
          </div>
      </div>           
  </div>

                
  <!--------------------------------------->

<div id="detail_depreciate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            
                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดค่าเสื่อม&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body" >
                                                    
                                        
                                                            
                                                 <div id="depreciate"></div>
                                                
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                <div align="right">
                                            
                                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;;font-weight:normal;">ปิดหน้าต่าง</button>
                                                </div>
                                                </div>
                                                </form>  
                                        </body>
                                            
                                            
                                            </div>
                                            </div>
                                        </div>
                               
                  
      
                      

@endsection

@section('footer')


<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>


<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
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


function depreciatebuilding(id){


$.ajax({
           url:"{{route('massete.depreciatebuilding')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#depreciate').html(result);
             
         
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
                todayHighlight: true,
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
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            todayBtn: true,
                            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                            thaiyear: true,
                            todayHighlight: true,
                            autoclose: true                         //Set เป็นปี พ.ศ.
                        });  //กำหนดเป็นวันปัจุบัน
                     }
             })
            // console.log(select);
             }        
     });
    

    function rundatepicker1() {
            
            $('.datepicker1').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    }

    
    function rundatepicker2() {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    }

  
</script>





@endsection