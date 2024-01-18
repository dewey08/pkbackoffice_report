@extends('layouts.risk')
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
            font-size: 10px;
            font-size: 1.0rem;
        }

        label {
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
        }

        @media only screen and (min-width: 1200px) {
            label {
                /* float: right; */
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

    use App\Http\Controllers\RiskController;


    function timeformate($strtime)
    {
    [$a, $b] = explode(':', $strtime);
    return $a . ':' . $b;
    }
    ?>
    <center>
        <div class="block shadow-lg mt-5" style="width: 95%;">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <div align="left">
                        <h2 class="block-title" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">
                            <B>บัญชีความเสี่ยง</B></h2>
                    </div>
                  
                </div>

                <div class="block-content block-content-full">
          
                    <form action="{{route('mrisk.risk_account')}}" method="post">
                        @csrf
                        <div class="row">
                        <div class="col-sm-2">
                         ประเภทความเสี่ยง
                            </div>
                        <div class="col-sm-2">
                              
                                <select name="TYPE" id="TYPE" class="form-control input-sm fo13" >
                                    <option value="">--เลือก--</option>
                                    @foreach($inforisktypes as $inforisktype)
                                                @if( $inforisktype-> RISK_TYPE_ID == $type)
                                                <option value="{{ $inforisktype-> RISK_TYPE_ID}}" selected>{{ $inforisktype-> RISK_TYPE_NAME}} </option>
                                                @else
                                                <option value="{{ $inforisktype-> RISK_TYPE_ID}}">{{ $inforisktype-> RISK_TYPE_NAME}} </option>
                                                @endif
                                            @endforeach
                                    </select>
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
        <div class="col-sm-1.5">
        <span>
        <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-search mr-2"></i> ค้นหา</button>
        </span> 
        </div>
        
        
                      
         </div>  
                     </form>
                   
                    <div class="table-responsive">
                        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                            <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                    <th class="text-font" style="text-align: center;" width="5%">ลำดับ</th>
                                    <th class="text-font" style="text-align: center;" width="8%">รหัส</th>
                                    <th class="text-font" style="text-align: center;" >ประเภทความเสี่ยง</th>
                                    <th class="text-font" style="text-align: center;" >ภารกิจ/แผนงาน/ขั้นตอน</th>
                                    <th class="text-font" style="text-align: center;" >ความเสี่ยง</th>  
                                    <th class="text-font" style="text-align: center;" > ปัจจัยเสี่ยง</th>
                                    <th class="text-font" style="text-align: center;" > โอกาส</th>
                                    <th class="text-font" style="text-align: center;" > ผลกระทบ</th>
                                    <th class="text-font" style="text-align: center;" > คะแนน</th>
                                    <th class="text-font" style="text-align: center;" > ระดับ</th>
                                    <th class="text-font" style="text-align: center;" > หน่วยงาน</th>
                                    <th class="text-font" style="text-align: center;" width="5%">คำสั่ง</th>
                                </tr >
                            </thead>
                            <tbody>
                                <?php $number = 0; ?>
                                @foreach ($infomations as $infomation)
                                <?php
                                $number++;
                          ?>
                          
                                    <tr height="40">                       
                                        <td class="text-font" style="text-align: center;font-size: 13px;" align="center">{{$number}}</td>
                                        <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomation->RISK_CODE}}</td>
                                        <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomation->RISK_TYPE_NAME}}</td>
                                        <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomation->RISK_ACC_MISSION}}</td>
                                        <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomation->RISK_ACC_ISSUE}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{$infomation->RISK_ACC_FACTOR}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{RiskController::RISK_ACCDE_LE_CHANCE($infomation->RISK_ACC_ID)}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{RiskController::RISK_ACCDE_LE_EFFECT($infomation->RISK_ACC_ID)}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;" >{{RiskController::RISK_ACCDE_LE_SCORE($infomation->RISK_ACC_ID)}}</td>
                                        <td class="text-font text-pedding" style="text-align: center;font-size: 13px;background-color:{{RiskController::RISK_ACCDE_LE_RATE_COLOR($infomation->RISK_ACC_ID)}}" >{{RiskController::RISK_ACCDE_LE_RATE($infomation->RISK_ACC_ID)}}</td>
                                        <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomation->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                        <td align="center" width="5%">
                                            <div class="dropdown ">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle f-Kanit fw-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;">                                            
                                                    ทำรายการ                                           
                                                </button>                                          
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">  
                                                    <a class="dropdown-item"  href="{{ url('manager_risk/risk_notify_account_level/'.$infomation->RISK_ACC_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียดระดับ</a>
                            
                                                        <a class="dropdown-item" href="#edit_modal{{ $infomation->RISK_ACC_ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด/แก้ไข</a> 
                                                        <a class="dropdown-item"  href="{{ url('manager_risk/risk_notify_account_incidence/'.$infomation->RISK_ACC_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;"><i class="fas fa-info-circle text-info mr-2"></i>อุบัติการณ์ความเสี่ยง</a> 
                                                    
                                                </div>
                                            </div>                                       
                                        </td> 
                                    </tr>
    
    
    
    
                                    
    
        
    <div id="edit_modal{{ $infomation->RISK_ACC_ID}}" class="modal fade">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
      
          <div class="modal-header">
                
                <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เพิ่ม/แก้ไข รายการความเสี่ยง</h2>
              </div>
              <div class="modal-body">
              <body>
                <form method="post" action="{{ route('mrisk.risk_account_detail_update') }}" enctype="multipart/form-data">
                    @csrf
    
                    <input type="hidden" name="RISK_ACC_ID" id="RISK_ACC_ID" value="{{$infomation->RISK_ACC_ID}}">
                    {{-- <input type="hidden" name="USER_ID" id="USER_ID" value=""> --}}
         
    
                    <div class="form-group">
                        <div class="row">
                        <div class="col-sm-3 text-left">
                        <label >รหัส</label>
                        </div>
                        <div class="col-sm-9">
                            <input name="RISK_CODE" id="RISK_CODE" class="form-control input-sm"  value="{{$infomation->RISK_CODE}}"  readonly>
                        </div>
                        </div>
                        </div>
           
                    <div class="form-group">
                        <div class="row">
                        <div class="col-sm-3 text-left">
                        <label >ประเภทความเสี่ยง</label>
                        </div>
                        <div class="col-sm-9">
                
                        <select name = "RISK_TYPE_ID"  id="RISK_TYPE_ID"  class="form-control input-lg f-Kanit fw-1">
                            <option value=" " >--เลือกประเภทความเสี่ยง--</option>
                            @foreach ($inforisktypes as $inforisktype)
                                 @if($inforisktype->RISK_TYPE_ID == $infomation->RISK_TYPE_ID)
                                 <option value=" {{ $inforisktype->RISK_TYPE_ID }}" selected>{{ $inforisktype ->RISK_TYPE_NAME }}</option>
                                 @else
                                 <option value=" {{ $inforisktype->RISK_TYPE_ID }}" >{{ $inforisktype ->RISK_TYPE_NAME }}</option>
                                @endif
                                @endforeach 
                       </select>
                    
                        </div>
                        </div>
                        </div>
    
           
           
           
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >ความเสี่ยง</label>
            </div>
            <div class="col-sm-9">
    
                <input list="risk_acc" name="RISK_ACC_ISSUE" id="RISK_ACC_ISSUE" value="{{$infomation->RISK_ACC_ISSUE}}"  class="form-control input-lg f-Kanit fw-1" style=" font-family: 'Kanit', sans-serif;" >
                <datalist id="risk_acc" >
                   
                @foreach ($infomationrists as $infomationrist)
                
                        <option  value=" {{ $infomationrist->ANALYZE_RISK }}" ></option>
                
                @endforeach 
          
                </datalist>
    
       
        
            </div>
            </div>
            </div>
    
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >ภารกิจ</label>
            </div>
            <div class="col-sm-9">
                <input  name = "RISK_ACC_MISSION"  id="RISK_ACC_MISSION"  value="{{$infomation->RISK_ACC_MISSION}}"  class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >วัตถุประสงค์</label>
            </div>
            <div class="col-sm-9">
                <input  name = "RISK_ACC_OBJ"  id="RISK_ACC_OBJ" value="{{$infomation->RISK_ACC_OBJ}}"  class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
          
            <div class="form-group">
                <div class="row">
                <div class="col-sm-3 text-left">
                <label >การควบคุมภายในที่มีอยู่</label>
                </div>
                <div class="col-sm-9">
                    <input  name = "RISK_ACC_CONTROLS"  id="RISK_ACC_CONTROLS" value="{{$infomation->RISK_ACC_CONTROLS}}"  class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
                </div>
                </div>
    
    
                <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >ปัจจัยเสี่ยง</label>
                    </div>
                    <div class="col-sm-9">
                        <input  name = "RISK_ACC_FACTOR"  id="RISK_ACC_FACTOR" value="{{$infomation->RISK_ACC_FACTOR}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                    </div>
                    </div>
                    </div>
    
    
                <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >หน่วยงานรับผิดชอบ</label>
                    </div>
                    <div class="col-sm-9">
                   
                    
                        <select name = "RISK_ACC_AGENCY"  id="RISK_ACC_AGENCY"  class="form-control input-lg f-Kanit fw-1">
                            <option value=" " >--เลือกความเสี่ยง--</option>
                            @foreach ($infodepartments as $infodepartment)
                                @if($infomation->RISK_ACC_AGENCY == $infodepartment->HR_DEPARTMENT_SUB_SUB_ID)
                                <option value=" {{ $infodepartment->HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{ $infodepartment ->HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                                @else
                                 <option value=" {{ $infodepartment->HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $infodepartment ->HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                                @endif
                               
                                @endforeach 
                       </select>
                        
    
                    
                    </div>
                    </div>
                    </div>
        
            </div>
              <div class="modal-footer">
              <div align="right">
                <button type="submit" class="btn btn-hero-sm btn-hero-info f-Kanit fw-1"><i
                    class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
              <span type="button" class="btn btn-hero-sm btn-hero-danger f-Kanit fw-1" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
              </div>
              </div>
              </form>  
                </div>
    
    
    
    
                                    @endforeach 
                               
                            </tbody>
                        </table>
                                     
    <br><br><br>
                        </div>
                </div>
            </div>
        </div>

    @endsection
    @section('footer')
        <script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
        <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
        <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
        <!-- Page JS Plugins -->
        <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
        <!-- Page JS Code -->
        <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
        <script>
            jQuery(function() {
                Dashmix.helpers(['easy-pie-chart', 'sparkline']);
            });

        </script>
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
            function detail(id) {
                $.ajax({
                    url: "{{ route('suplies.detailapp') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(result) {
                        $('#detail').html(result);
                    }
                })
            }
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
                        url: "{{ route('admin.selectbudget') }}",
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
                }
            });

            function chkmunny(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
                ele.onKeyPress = vchar;
            }

        </script>

    @endsection
