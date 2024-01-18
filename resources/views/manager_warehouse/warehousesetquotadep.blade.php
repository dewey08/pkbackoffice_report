@extends('layouts.warehouse')   
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

  
    use App\Http\Controllers\ManagerwarehouseController;

?>       
<!-- Advanced Tables -->

<center>    
    <div class="block" style="width: 95%;margin-top:10px;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header-default"  >
                <br>
              
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>กำหนดโควตาของคลังย่อย</B></h3>
                    </div>
                </div>
               
            </div>
     
       
            <div class="block-content ">
                    <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >กำหนดโควตา</th>

                         
                        </tr >
                    </thead>
                    <tbody>
                   
                        <?php $number=1; ?>
                        @foreach ($infodepsubs as $infodepsub)
                     
                                <tr height="20">
                                        <td class="text-font" align="center" width="5%">{{$number}}</td>
                                        <td class="text-font text-pedding" >{{$infodepsub->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                               
                                        <td class="text-font text-pedding" width="8%">
                
                                            <div class="dropdown">
                                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                        ทำรายการ
                                                    </button>
                                            <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item" href="{{ url('manager_warehouse/warehousesetquotadep_setquota/'.$infodepsub->HR_DEPARTMENT_SUB_SUB_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ปรับข้อมูลโควตา</a>
                                                </div>
                                            </div>


                                        </td>
                                </tr>
                                <?php $number++; ?>


                                {{-- <div id="edit_modal{{ $infodepsub->HR_DEPARTMENT_SUB_SUB_ID }}" class="modal fade edit" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">
                  
                                          <h2 class="modal-title"
                                            style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                                            ปรับข้อมูลโควตา</h2>
                                        </div>
                  
                  
                                        <div class="modal-body">
                                          <body>
                                            <form method="post" id="form_edit{{ $infodepsub->HR_DEPARTMENT_SUB_SUB_ID }}"
                                              action="{{ route('addreward.edit') }}">
                                              @csrf
                                              <input type="hidden" name="WAREHOUSE_TREASARY_QUOTA_DEP_ID" id="WAREHOUSE_TREASARY_QUOTA_DEP_ID" value="{{ $infodepsub->HR_DEPARTMENT_SUB_SUB_ID }}" />
                  
                                              <div class="form-group">
                                                <div class="row">
                                                  <div class="col-sm-3 text-left">
                                                    <label>โควตา</label>
                                                  </div>
                                                  <div class="col-sm-9">
                                                    <input name="WAREHOUSE_TREASARY_QUOTA_AMOUNT" id="WAREHOUSE_TREASARY_QUOTA_AMOUNT"
                                                      class="form-control input-lg"
                                                      style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <div class="row">
                                                  <div class="col-sm-3 text-left">
                                                    <label>น้อยสุด</label>
                                                  </div>
                                                  <div class="col-sm-9">
                                                    <input name="WAREHOUSE_TREASARY_QUOTA_MIN" id="WAREHOUSE_TREASARY_QUOTA_MIN"
                                                    class="form-control input-lg"
                                                    style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <div class="row">
                                                  <div class="col-sm-3 text-left">
                                                    <label>มากสุด</label>
                                                  </div>
                                                  <div class="col-sm-9">
                                                    <input name="WAREHOUSE_TREASARY_QUOTA_MAX" id="WAREHOUSE_TREASARY_QUOTA_MAX"
                                                    class="form-control input-lg"
                                                    style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                                  </div>
                                                </div>
                                              </div>
                                            
                                        </div>
                  
                  
                                        <div class="modal-footer">
                                          <div align="right">
                                            <span type="button" class="btn btn-hero-sm btn-hero-info btn-submit-edit"><i class="fas fa-save"></i>
                                              &nbsp;บันทึกข้อมูล</span>
                                            <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal"><i
                                                class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
                                          </div>
                                        </div>
                                        </form>
                                        </body>
                                      </div>
                                    </div>
                                  </div> --}}

                        @endforeach  

                    </tbody>
                </table>
                                       
                        <br>
                </div>
            </div>        
        </div>
       
    </div>             

  
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