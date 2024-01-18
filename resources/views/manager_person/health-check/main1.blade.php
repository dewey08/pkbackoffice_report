@extends('layouts.personhealth')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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

@section('content')

<div class="row">
    <div class="col-md-10" style="margin-right: auto; margin-left:auto;">
        <div class="block text-center" style="width: 100%; margin-top:30px;">
            <div class="block-content">
                <div class="block-header block-header-default">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการตรวจสุขภาพประจำปี</B></h3>  
                </div>
            </div>
            <div class="block-content">
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%" border="1" style="margin-left: auto; margin-right:auto;">
                            <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                    <td width="5%" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="7%">ลำดับ</td>
                                    <td width="10%" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="7%">สถานะ</td>
                                    <td width="20%" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="7%">วันที่คัดกรอง</td>
                                    <td width="20%"style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">ชื่อ - นามสกุล</td>
                                    <td width="10%" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">เพศ</td>
                                    <td width="5%" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">อายุ</td>
                                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">หน่วยงาน</td>
                                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">BMI</td>
                                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">รายละเอียด</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if ($user->id < 50)
                                    <tr>
                                        <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">
                                            {{ $user->id }}
                                        </td>
                                        <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">
                                            {{ $user->status }}
                                        </td>
                                        <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">
                                            <span style="margin-left:10px;">{{ $user->updated_at }}</span>
                                        </td>
                                        <td class="text-font"  style="border-color:#F0FFFF;font-family: 'Kanit', sans-serif;border: 1px solid black;">
                                            <span style="margin-left:10px;">{{ $user->name }}</span>
                                        </td>
                                        <td class="text-font"  style="border-color:#F0FFFF;font-family: 'Kanit', sans-serif;border: 1px solid black;">
                                            <span style="margin-left:10px;">{{ $user->username }}</span>
                                        </td>
                                        <td class="text-font"  style="border-color:#F0FFFF;font-family: 'Kanit', sans-serif;border: 1px solid black;">
                                            <span style="margin-left:10px;">{{ $user->PERSON_ID }}</span>
                                        </td>
                                        <td class="text-font"  style="border-color:#F0FFFF;font-family: 'Kanit', sans-serif;border: 1px solid black;">
                                            <span style="margin-left:10px;">{{ $user->email }}</span>
                                        </td>
                                        <td class="text-font"  style="border-color:#F0FFFF;font-family: 'Kanit', sans-serif;border: 1px solid black;">
                                            <span style="margin-left:10px;">{{ $user->password }}</span>
                                        </td>
                                        <td style="margin-top: 5px; border-color:#F0FFFF;font-family: 'Kanit', sans-serif;border: 1px solid black; text-align:center;" width="10%">
                                            <div class="dropdown" style="margin-top: 5px; margin-bottom: 5px;">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                        ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item" href="{{ url('manager_person/health-check/form') }}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    {{-- <i class="fas fa-clipboard-check text-info mr-2"></i> --}}
                                                    กรอกข้อมูลรับการตรวจ</a>
                                                <a class="dropdown-item" href="{{ url('manager_person/health-check/results') }}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    {{-- <i class="fas fa-info-circle text-info mr-2"></i> --}}
                                                    ข้อมูลผลตรวจสุขภาพ</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
    <script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>

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
@endsection
