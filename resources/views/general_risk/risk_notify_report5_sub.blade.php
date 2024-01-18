@extends('layouts.backend')

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
                float: right;
            }

        }

        .text-pedding {
            padding-left: 10px;
            padding-right: 10px;
        }

        .text-font {
            font-size: 13px;
        }

        .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
        }

    </style>
    <style>
        .form-control {
            font-family: 'Kanit', sans-serif;
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
    $checkrisknotify = RiskController::checkrisknotify($user_id);
    $countrisknotify = RiskController::countrisknotify($user_id);

    $check = RiskController::checkpermischeckinfo($user_id);
    ?>
    <?php
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');
    ?>


    <!-- Advanced Tables -->
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                    {{ $inforpersonuser->HR_PREFIX_NAME }} {{ $inforpersonuser->HR_FNAME }}
                    {{ $inforpersonuser->HR_LNAME }}</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <div class="row">
                            <div>
                                <a href="{{ url('general_risk/dashboard_risk/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero "
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </div>
                            <div>&nbsp;&nbsp;</div>
                            
                            <div>
                                <a href="{{ url('general_risk/risk_notify_internalcontrol/' . $inforpersonuserid->ID) }}"
                                  class="btn btn-hero-sm btn-hero"
                                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">กระบวนการทำงาน
                              </a>
                            </div>
                              <div>&nbsp;</div>

                              <div>
                                <a href="{{ url('general_risk/risk_notify_report4/'.$inforpersonuserid->ID) }}"
                                  class="btn btn-hero-sm btn-hero"
                                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน ปค.4
                              </a>
                            </div>
                              <div>&nbsp;</div>

                              <div>
                                <a href="{{ url('general_risk/risk_notify_report5/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero-info"
                                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">รายงาน ปค.5
                              </a>
                            </div>
                              <div>&nbsp;</div>


                              <div>
                              <a href="{{ url('general_risk/risk_notify_account_detail/' . $inforpersonuserid->ID) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บัญชีความเสี่ยง
                            </a>
                          </div>
                            <div>&nbsp;</div>

                                <div >
                                <a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บันทึกความเสี่ยง</a>
                              </div>
                                <div>&nbsp;</div>
                            @if($check == 1)
                                <div>
                                <a href="{{ url('general_risk/risk_notify_checkinfo/' . $inforpersonuserid->ID) }}"
                                  class="btn btn-hero-sm btn-hero"
                                  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                              </a>
                            </div>
                              <div>&nbsp;</div>
                            @endif
                            <div>
                                <a href="{{ url('general_risk/risk_notify_deal/' . $inforpersonuserid->ID) }}"
                                    class="btn btn-hero-sm btn-hero "
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ความเสี่ยงที่เกี่ยวข้อง</a>                              
                                        <span class="badge badge-light" ></span>                                      
                                </a>
                            </div>
                            <div>&nbsp;&nbsp;</div>

                        </div>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content mx-1 ml-3">

        <!-- Dynamic Table Simple -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title foo15" style="font-family: 'Kanit', sans-serif;"><B>รายงาน ปค.5 ประเมินผลควบคุมภายใน</B></h3>
                <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</button>
                &nbsp;
                <a href="{{ url('general_risk/risk_notify_report5_sub_excel/'.$idref.'/'.$id_user)  }}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">EXCEL</a>
                &nbsp; 
                <a href="{{ url('general_risk/risk_notify_report5/'.$id_user)  }}"  type="button" class="btn btn-hero-sm btn-hero-success" >ย้อนกลับ</a>
            </div>
            <div class="block-content">
             
              
                 
                <div class="table-responsive">
                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <th  class="text-font" style="text-align: center;font-size: 13px;" width="5%">ลำดับ</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >ความเสี่ยง</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >การควบคุมภายในที่มี</th> 
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >การประเมินผลควบคุมภายใน</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >ความเสี่ยงที่ยังมีอยู่</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >การปรับปรุงควบคุมภายใน</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >หน่วยงานรับผิดชอบ</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >ระยะเวลา</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >ติดตาม</th>
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >คำสั่ง</th>

                            </tr >
                        </thead>
                        <tbody>

                            <?php $number = 0; ?>
                            @foreach ($infomationreport5subs as $infomationreport5sub)
                            <?php
                            $number++;
                      ?>
                   
                                <tr height="20">                       
                                    <td class="text-font" style="text-align: center;font-size: 13px;" align="center">{{$number}}</td>
                                 
                                    <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_RISK}}</td>
                                    <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_CONTROL}}</td>
                                    <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_RATE}}</td>
                                    <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_HAVE}}</td>
                                    <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_IMPROVE}}</td>
                                    <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomationreport5sub->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                    <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_TIME}}</td>
                                    <td class="text-font text-pedding" style="font-size: 13px;" >{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_TAG}}</td>

                                    <td align="center" width="5%">
                                        <div class="dropdown ">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;">                                            
                                                ทำรายการ                                           
                                            </button>                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">  
                                                <a class="dropdown-item" href="#edit_modal{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_ID}}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด/แก้ไข</a>
                                                
                                            </div>
                                        </div>                                       
                                    </td>

                                 
                                </tr>
                             


        <div id="edit_modal{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_ID}}" class="modal fade" >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
      
          <div class="modal-header">
                
                <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> แก้ไข รายงาน ปค.5</h2>
              </div>
              <div class="modal-body">
              <body>
              <form  method="post" id="form_add" action="{{ route('gen_risk.risk_notify_report5_sub_update') }}" >
              @csrf
              
              <input type="hidden" name="RISK_NOTIFY_RE5_SUB_ID" id="RISK_NOTIFY_RE5_SUB_ID" value="{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_ID}}" >
              <input type="hidden" name="USER_ID" id="USER_ID" value="{{$inforpersonuserid->ID}}" >
              <input type="hidden" name="RISK_NOTIFY_RE5_ID" id="RISK_NOTIFY_RE5_ID" value="{{$idref}}" >


        
              <div class="form-group">
                <div class="row">
                <div class="col-sm-3 text-left">
                <label >ความเสี่ยง</label>
                </div>
                <div class="col-sm-9">

                    <select name = "RISK_NOTIFY_RE5_SUB_RISK"  id="RISK_NOTIFY_RE5_SUB_RISK"  class="form-control input-lg">
                        @foreach ($infomationrists as $infomationrist)
                           @if($infomationrist->ANALYZE_RISK == $infomationreport5sub->RISK_NOTIFY_RE5_SUB_RISK )
                           <option value=" {{ $infomationrist->ANALYZE_RISK }}" selected>{{ $infomationrist -> ANALYZE_RISK }}</option>
                           @else   
                            <option value=" {{ $infomationrist->ANALYZE_RISK }}" >{{ $infomationrist -> ANALYZE_RISK }}</option>
                            @endif
                            @endforeach 
                   </select>


              
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-sm-3 text-left">
                <label >การควบคุมภายในที่มีอยู่</label>
                </div>
                <div class="col-sm-9">
                    <input  name = "RISK_NOTIFY_RE5_SUB_CONTROL"  id="RISK_NOTIFY_RE5_SUB_CONTROL" value="{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_CONTROL}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-sm-3 text-left">
                <label >การประเมินผลการควบคุมภายใน</label>
                </div>
                <div class="col-sm-9">
                    <input  name = "RISK_NOTIFY_RE5_SUB_RATE"  id="RISK_NOTIFY_RE5_SUB_RATE" value="{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_RATE}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-sm-3 text-left">
                <label >ความเสี่ยงที่ยังมีอยู่</label>
                </div>
                <div class="col-sm-9">
                    <input  name = "RISK_NOTIFY_RE5_SUB_HAVE"  id="RISK_NOTIFY_RE5_SUB_HAVE"  value="{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_HAVE}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-sm-3 text-left">
                <label >การปรับปรุงควบคุมภายใน</label>
                </div>
                <div class="col-sm-9">
                    <input  name = "RISK_NOTIFY_RE5_SUB_IMPROVE"  id="RISK_NOTIFY_RE5_SUB_IMPROVE" value="{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_IMPROVE}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                </div>
                </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >หน่วยงานรับผิดชอบ</label>
                    </div>
                    <div class="col-sm-9">
    
                        <select name = "RISK_NOTIFY_RE5_SUB_DEP"  id="RISK_NOTIFY_RE5_SUB_DEP"  class="form-control input-lg">
                            @foreach ($infodeps as $infodep)
                               @if($infodep->HR_DEPARTMENT_SUB_SUB_ID == $infomationreport5sub->RISK_NOTIFY_RE5_SUB_DEP )
                               <option value=" {{ $infodep->HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                               @else   
                                <option value=" {{ $infodep->HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                                @endif
                                @endforeach 
                       </select>
                    
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <div class="col-sm-3 text-left">
                        <label >ระยะเวลา</label>
                        </div>
                        <div class="col-sm-9">
                            <input  name = "RISK_NOTIFY_RE5_SUB_TIME"  id="RISK_NOTIFY_RE5_SUB_TIME"  value="{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_TIME}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                        </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-sm-3 text-left">
                            <label >สถานะดำเนินการ</label>
                            </div>
                            <div class="col-sm-9">
                                <input  name = "RISK_NOTIFY_RE5_SUB_STATUS"  id="RISK_NOTIFY_RE5_SUB_STATUS" value="{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_STATUS}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                            </div>
                            </div>
                            </div>
    
                            <div class="form-group">
                                <div class="row">
                                <div class="col-sm-3 text-left">
                                <label >วิธีติดตามและสรุปผลการประเมิน</label>
                                </div>
                                <div class="col-sm-9">
                                    <input  name = "RISK_NOTIFY_RE5_SUB_TAG"  id="RISK_NOTIFY_RE5_SUB_TAG" value="{{$infomationreport5sub->RISK_NOTIFY_RE5_SUB_TAG}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                                </div>
                                </div>
                                </div>
         
        
            </div>
              <div class="modal-footer">
              <div align="right">
                <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                    class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
              <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
              </div>
              </div>
              </form>  
              @endforeach              
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade add">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
      
          <div class="modal-header">
                
                <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เพิ่ม/แก้ไข รายงาน ปค.5</h2>
              </div>
              <div class="modal-body">
              <body>
                <form method="post" action="{{ route('gen_risk.risk_notify_report5_sub_save') }}" enctype="multipart/form-data">
              @csrf

                <input type="hidden" name="USER_ID" id="USER_ID" value="{{$inforpersonuserid->ID}}" >
                <input type="hidden" name="RISK_NOTIFY_RE5_ID" id="RISK_NOTIFY_RE5_ID" value="{{$idref}}" >

            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >ความเสี่ยง</label>
            </div>
            <div class="col-sm-9">
            
            <select name = "RISK_NOTIFY_RE5_SUB_RISK"  id="RISK_NOTIFY_RE5_SUB_RISK"  class="form-control input-lg">
                <option value=" " >--เลือกความเสี่ยง--</option>
                @foreach ($infomationrists as $infomationrist)
                    <option value=" {{ $infomationrist->ANALYZE_RISK }}" >{{ $infomationrist -> ANALYZE_RISK }}</option>
                    @endforeach 
           </select>

        
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >การควบคุมภายในที่มีอยู่</label>
            </div>
            <div class="col-sm-9">
                <input  name = "RISK_NOTIFY_RE5_SUB_CONTROL"  id="RISK_NOTIFY_RE5_SUB_CONTROL" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >การประเมินผลการควบคุมภายใน</label>
            </div>
            <div class="col-sm-9">
                <input  name = "RISK_NOTIFY_RE5_SUB_RATE"  id="RISK_NOTIFY_RE5_SUB_RATE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >ความเสี่ยงที่ยังมีอยู่</label>
            </div>
            <div class="col-sm-9">
                <input  name = "RISK_NOTIFY_RE5_SUB_HAVE"  id="RISK_NOTIFY_RE5_SUB_HAVE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >การปรับปรุงควบคุมภายใน</label>
            </div>
            <div class="col-sm-9">
                <input  name = "RISK_NOTIFY_RE5_SUB_IMPROVE"  id="RISK_NOTIFY_RE5_SUB_IMPROVE" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                <div class="col-sm-3 text-left">
                <label >หน่วยงานรับผิดชอบ</label>
                </div>
                <div class="col-sm-9">

                    <select name = "RISK_NOTIFY_RE5_SUB_DEP"  id="RISK_NOTIFY_RE5_SUB_DEP"  class="form-control input-lg">
                        <option value=" " >--เลือกหน่วยงานรับผิดชอบ--</option>
                        @foreach ($infodeps as $infodep)
                           <option value=" {{ $infodep -> HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                       @endforeach 
                   </select>
                
                </div>
                </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >ระยะเวลา</label>
                    </div>
                    <div class="col-sm-9">
                        <input  name = "RISK_NOTIFY_RE5_SUB_TIME"  id="RISK_NOTIFY_RE5_SUB_TIME" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <div class="col-sm-3 text-left">
                        <label >สถานะดำเนินการ</label>
                        </div>
                        <div class="col-sm-9">
                            <input  name = "RISK_NOTIFY_RE5_SUB_STATUS"  id="RISK_NOTIFY_RE5_SUB_STATUS" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                        </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                            <div class="col-sm-3 text-left">
                            <label >วิธีติดตามและสรุปผลการประเมิน</label>
                            </div>
                            <div class="col-sm-9">
                                <input  name = "RISK_NOTIFY_RE5_SUB_TAG"  id="RISK_NOTIFY_RE5_SUB_TAG" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                            </div>
                            </div>
                            </div>
         
        
            </div>
              <div class="modal-footer">
              <div align="right">
                <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                    class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
              <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
              </div>
              </div>
              </form>  

        @endsection

        @section('footer')

            <script src="{{ asset('select2/select2.min.js') }}"></script>
            <!-- Page JS Plugins -->
            <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
            <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
            <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
            <!-- Page JS Code -->
            {{-- <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script> --}}
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

            $(document).ready(function() {
                    $('select').select2(
                        {
                    width: '100%'
                });
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
                        // console.log(select);
                    }
                });


                $(document).ready(function() {

                    $('.datepicker').datepicker({
                        format: 'dd/mm/yyyy',
                        todayBtn: true,
                        language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                        thaiyear: true,
                        autoclose: true //Set เป็นปี พ.ศ.
                    }); //กำหนดเป็นวันปัจุบัน
                });


                function chkmunny(ele) {
                    var vchar = String.fromCharCode(event.keyCode);
                    if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
                    ele.onKeyPress = vchar;
                }

            </script>



        @endsection
