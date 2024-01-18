@extends('layouts.risk')
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
            font-size: 13px;

        }

        label {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;

        }

        @media only screen and (min-width: 1200px) {
            label {
               
            }
        }

        .text-pedding {
            padding-left: 10px;
        }

        .text-font {
            font-size: 13px;
        }


        .form-control {
            font-size: 13px;
        }

    </style>

    <script>
        function checklogin() {
            window.location.href = '{{ route('index') }}';
        }

    </script>
    <?php
    if (Auth::check()) {
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    } else {
    echo "

    <body onload=\"checklogin()\"></body>";
    exit();
    }
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);


    $datenow = date('Y-m-d');
    ?>


 <br><br>
         
 
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดบัญชีความเสี่ยง ด้านการดำเนินงาน</B></h3>               
            
          
                &nbsp;&nbsp;
                <button type="button" class="btn btn-hero-sm btn-hero-info f-Kanit fw-1" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มการประเมินความเสี่ยง</button>
                &nbsp;
                <a href="{{ url('manager_risk/risk_account') }}" type="button"  class="btn btn-hero-sm btn-hero-success f-Kanit fw-1" >ย้อนกลับ</a>
            </div>

            <div class="block-content">
     
                <div class="table-responsive">
                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <th class="text-font" style="text-align: center;" width="5%">ลำดับ</th>
                                <th class="text-font" style="text-align: center;" >ปีงบประมาณ</th>
   
                                <th class="text-font" style="text-align: center;" >โอกาส</th>
                                <th class="text-font" style="text-align: center;" >ผลกระทบ</th>
                                <th class="text-font" style="text-align: center;" > คะแนน</th>
                                <th class="text-font" style="text-align: center;" > ระดับประเมิน</th>
                                <th class="text-font" style="text-align: center;" width="30%"> มาตรการกำหนด</th>
                                <th class="text-font" style="text-align: center;" > ค่าที่ยอมรับได้</th>
                        
                                <th class="text-font" style="text-align: center;" width="5%">คำสั่ง</th>
                            </tr >
                        </thead>
                        <tbody>

                            <?php $number = 0; ?>
                            @foreach ($infomationlevels as $infomationlevel)
                            <?php
                            $number++;
                      ?>

                            
                                <tr height="40">                       
                                    <td class="text-font" style="text-align: center;font-size: 13px;" align="center">{{$number}}</td>
                                
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationlevel->RISK_ACCDE_LE_YEAR}}</td>
                                   
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationlevel->RISK_ACCDE_LE_CHANCE}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationlevel->RISK_ACCDE_LE_EFFECT}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationlevel->RISK_ACCDE_LE_SCORE}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;background-color: {{$infomationlevel->RISK_LEVELTYPE_COLOR}};" >{{$infomationlevel->RISK_LEVELTYPE_NAME}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationlevel->RISK_LEVELTYPE_DETAIL}}</td>
                                    <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomationlevel->RISK_ACCDE_LE_ACCEPTABLE}}</td>
                                  
                                    <td align="center" width="5%">
                                        <div class="dropdown ">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle f-Kanit fw-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;">                                            
                                                ทำรายการ                                           
                                            </button>                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">  

                                                <a class="dropdown-item " href="#edit_modal{{ $infomationlevel->RISK_ACCDE_LE_ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด/แก้ไข</a> 
                                       
                                                
                                            </div>
                                        </div>                                       
                                    </td> 
                                </tr>




                                


    
<div id="edit_modal{{$infomationlevel->RISK_ACCDE_LE_ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
      <div class="modal-header">
            
            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> แก้ไข การประเมินความเสี่ยง</h2>
          </div>
          <div class="modal-body">
          <body>
            <form method="post" action="{{ route('mrisk.risk_account_detail_level_update') }}" enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="RISK_ACC_ID" id="RISK_ACC_ID" value="{{$idref}}">
          <input type="hidden" name="USER_ID" id="USER_ID" value="{{$id_user}}">
          <input type="hidden" name="RISK_ACCDE_LE_ID" id="RISK_ACCDE_LE_ID" value="{{$infomationlevel->RISK_ACCDE_LE_ID}}">


          <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >ปี</label>
            </div>
            <div class="col-sm-4">
                <input  name = "RISK_ACCDE_LE_YEAR"  id="RISK_ACCDE_LE_YEAR" value="{{$infomationlevel->RISK_ACCDE_LE_YEAR}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            <div class="col-sm-2 text-left">
                <label >ระดับประเมิน</label>
                </div>
                <div class="col-sm-4">
                    <select name="RISK_ACCDE_LE_RATE" id="RISK_ACCDE_LE_RATE" class="form-control input-sm">
                        <option value="">--กรุณาเลือก--</option>
                            @foreach ( $infoleveltypes as $infoleveltype)                                   
                              @if($infoleveltype->RISK_LEVELTYPE_ID == $infomationlevel->RISK_ACCDE_LE_RATE)
                                <option value="{{ $infoleveltype->RISK_LEVELTYPE_ID }}" selected>{{ $infoleveltype->RISK_LEVELTYPE_NAME }} </option> 
                              @else
                              <option value="{{ $infoleveltype->RISK_LEVELTYPE_ID }}">{{ $infoleveltype->RISK_LEVELTYPE_NAME }} </option> 
                              @endif
                            @endforeach 
                    </select>
                </div>
            </div>
            </div>
     
        <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >โอกาส</label>
            </div>
            <div class="col-sm-4">
                <input  name = "RISK_ACCDE_LE_CHANCE"  id="RISK_ACCDE_LE_CHANCE" value="{{$infomationlevel->RISK_ACCDE_LE_CHANCE}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            <div class="col-sm-2 text-left">
                <label >ผลกระทบ</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_ACCDE_LE_EFFECT"  id="RISK_ACCDE_LE_EFFECT" value="{{$infomationlevel->RISK_ACCDE_LE_EFFECT}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
            </div>
            </div>


            <div class="form-group">
                <div class="row">
                <div class="col-sm-2 text-left">
                <label >คะแนน</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_ACCDE_LE_SCORE"  id="RISK_ACCDE_LE_SCORE" value="{{$infomationlevel->RISK_ACCDE_LE_SCORE}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
                <div class="col-sm-2 text-left">
                    <label >ค่าที่ยอมรับได้</label>
                    </div>
                    <div class="col-sm-4">
                        <input  name = "RISK_ACCDE_LE_ACCEPTABLE"  id="RISK_ACCDE_LE_ACCEPTABLE" value="{{$infomationlevel->RISK_ACCDE_LE_ACCEPTABLE}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                    </div>
                </div>
                </div>
       

    
     
    
        </div>
          <div class="modal-footer">
          <div align="right">
            <button type="submit" class="btn btn-hero-sm btn-hero-info f-Kanit fw-1"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
          <span type="button" class="btn btn-hero-sm btn-hero-danger f-Kanit fw-1" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
          </div>
          </div>
          </form>  
            </div>

                             
                             @endforeach      
                           
                        </tbody>
                    </table>
                                 
<br><br><br>





    
<div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
      <div class="modal-header">
            
            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เพิ่ม การประเมินความเสี่ยง</h2>
          </div>
          <div class="modal-body">
          <body>
            <form method="post" action="{{ route('mrisk.risk_account_detail_level_save') }}" enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="RISK_ACC_ID" id="RISK_ACC_ID" value="{{$idref}}">
          <input type="hidden" name="USER_ID" id="USER_ID" value="{{$id_user}}">

          <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >ปี</label>
            </div>
            <div class="col-sm-4">
                <input  name = "RISK_ACCDE_LE_YEAR"  id="RISK_ACCDE_LE_YEAR" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            <div class="col-sm-2 text-left">
                <label >ระดับประเมิน</label>
                </div>
                <div class="col-sm-4">
                   
                    <select name="RISK_ACCDE_LE_RATE" id="RISK_ACCDE_LE_RATE" class="form-control input-sm">
                        <option value="">--กรุณาเลือก--</option>
                            @foreach ( $infoleveltypes as $infoleveltype)                                   
                                <option value="{{ $infoleveltype->RISK_LEVELTYPE_ID }}">{{ $infoleveltype->RISK_LEVELTYPE_NAME }}  
                            @endforeach 
                    </select>

                </div>
            </div>
            </div>
     
        <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >โอกาส</label>
            </div>
            <div class="col-sm-4">
                <input  name = "RISK_ACCDE_LE_CHANCE"  id="RISK_ACCDE_LE_CHANCE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            <div class="col-sm-2 text-left">
                <label >ผลกระทบ</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_ACCDE_LE_EFFECT"  id="RISK_ACCDE_LE_EFFECT" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
            </div>
            </div>


            <div class="form-group">
                <div class="row">
                <div class="col-sm-2 text-left">
                <label >คะแนน</label>
                </div>
                <div class="col-sm-4">
                    <input  name = "RISK_ACCDE_LE_SCORE"  id="RISK_ACCDE_LE_SCORE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
                <div class="col-sm-2 text-left">
                    <label >ค่าที่ยอมรับได้</label>
                    </div>
                    <div class="col-sm-4">
                        <input  name = "RISK_ACCDE_LE_ACCEPTABLE"  id="RISK_ACCDE_LE_ACCEPTABLE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                    </div>
                </div>
                </div>
       

    
     
    
        </div>
          <div class="modal-footer">
          <div align="right">
            <button type="submit" class="btn btn-hero-sm btn-hero-info f-Kanit fw-1"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
          <span type="button" class="btn btn-hero-sm btn-hero-danger f-Kanit fw-1" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
          </div>
          </div>
          </form>  
            </div>



        @endsection

        @section('footer')
        <script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
        <script>
            jQuery(function() {
                Dashmix.helpers(['masked-inputs']);
            });
        </script>
        <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
        <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
        <script src="{{ asset('select2/select2.min.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                });
            </script>
            <script>   
                $(document).ready(function() {
                    $('.datepicker').datepicker({
                        format: 'dd/mm/yyyy',
                        todayBtn: true,
                        language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                        thaiyear: true,
                        autoclose: true //Set เป็นปี พ.ศ.
                    }); //กำหนดเป็นวันปัจุบัน
                });
                $('.budget').change(function() {
                    if ($(this).val() != '') {
                        var select = $(this).val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('mrisk.selectbudget') }}",
                            method: "GET",
                            data: {
                                select: select,
                                _token: _token
                            },
                            success: function(result) {
                                $('.date_budget').html(result);
                                datepick();
                            }
                        })
                        // console.log(select);
                    }
                });
               
                $('.scope').change(function() {
                    if ($(this).val() != '') {
                        var select = $(this).val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('mrisk.fectscope') }}",
                            method: "GET",
                            data: {
                                select: select,
                                _token: _token
                            },
                            success: function(result) {
                                $('.effect').html(result);
                            }
                        })
                    }
                });

                $('.effect').change(function() {
                    if ($(this).val() != '') {
                        var select = $(this).val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('mrisk.fectriskeffect') }}",
                            method: "GET",
                            data: {
                                select: select,
                                _token: _token
                            },
                            success: function(result) {
                                $('.risklevel').html(result);
                            }
                        })
                    }
                });
            </script>

        @endsection
