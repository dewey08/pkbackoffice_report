@extends('layouts.person')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{asset('asset/js/plugins/sweetalert2/sweetalert2.min.css')}}">

<style>
    .t-content td{
        padding : 5px;
    }
</style>
@endsection
@section('content')
<div style="width:95%;margin:auto;">
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-title fw-5">
                ข้อมูล Job descriptions of personnel
            </div>
            <div class="block-options">
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add_jobdescription" id="btn_add_jobdescription"><i class="fa fa-plus mr-2"></i>เพิ่ม job descriptions รายบุคคล</a>
            </div>
        </div>
        <div class="block-content">
            <form action="{{ route('mperson.jobdescriptions_personnel') }}" method="post" class="mb-2 ">
                @csrf
                <div class="row" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                    <div class="col-md-1 text-center col-form-label">ปีงบประมาณ</div>
                    <div class="col-md-2 d-flex">
                        <select name="budgetyear" id="budgetyear" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;font-size: 12px;">
                            <option value="all" selected>--ทั้งหมด--</option>
                            @foreach($dropbudgetyear as $value)
                            @if($value == $budgetyear)
                                <option value="{{$value}}" selected>{{$value}}</option>
                            @else
                                <option value="{{$value}}">{{$value}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 text-center col-form-label">Job descriptions</div>
                    <div class="col-md-2">
                        <select name="job_descript" id="job_descript" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;font-size: 12px;">
                            <option value="all" selected>--ทั้งหมด--</option>
                            @foreach($dropjob_descript as $row)
                            @if($row->IWJOB_D_ID == $job_descript)
                                <option value="{{$row->IWJOB_D_ID}}" selected>{{$row->IWJD_NAME}}</option>
                            @else
                                <option value="{{$row->IWJOB_D_ID}}">{{$row->IWJD_NAME}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 text-center col-form-label">ผู้รับ Job description</div>
                    <div class="col-md-2">
                        <select name="person_id" id="person_id" class="form-control input-lg select2 w-100"
                            style=" font-family: 'Kanit', sans-serif;font-size: 12px;">
                            <option value="all" selected>--ทั้งหมด--</option>
                            @foreach($dropperson as $row)
                            @if($row->ID == $person_id)
                                <option value="{{$row->ID}}" selected>{{$row->HR_FNAME.' '.$row->HR_LNAME}}</option>
                            @else
                                <option value="{{$row->ID}}">{{$row->HR_FNAME.' '.$row->HR_LNAME}}</option>
                            @endif
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <button type="submit" class="btn btn-sm btn-info"><i
                                class="fas fa-search mr-2"></i>ค้นหา</button>
                    </div>
                </div>
            </form>
            
            @if(Session::has('listnodadd'))
                <h5>รายชื่อที่ไม่สามารถเพิ่มได้ เนื่องจากทำการเพิ่มข้อมูลแล้ว</h5>
                @foreach(Session('listnodadd') as $row)
                <div class="alert alert-danger">{{$row->HR_FNAME.'  '.$row->HR_LNAME}}</div>
                @endforeach
            @endif

            <div class="table-responsive" style="min-height:70vh">
                <table class="table-striped table-vcenter js-dataTable-simple table-sl-p-5px" style="width: 100%;">
                    <Colgroup>
                        <Col width="3%"></Col>
                        <Col width="5%"></Col>
                        <Col width="22%"></Col>
                        <Col width="12%"></Col>
                        <Col width="12%"></Col>
                        <Col width="12%"></Col>
                        <Col width="12%"></Col>
                        <Col width="10%"></Col>
                        <Col width="12%"></Col>
                    </Colgroup>
                    <thead class="bg-sl-header">
                        <tr height="40">
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                ลำดับ</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                ปีงบ</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                Job descriptions</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                ผู้รับ Job description</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                ผู้สร้าง
                            </th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                ผู้ประเมิน รอบ1</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                ผู้ประเมิน รอบ2</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">สถานะ</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                คำสั่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($number = 1)
                    @foreach($list_person_work as $row)
                        <tr class="t-content">
                            <td class="text-center">{{$number++}}</td>
                            <td class="text-center">{{$row->IWJP_BUDGETYEAR}}</td>
                            <td>{{$row->IWJD_NAME}}</td>
                            <td>{{$row->p_fname.' '.$row->p_lname}}</td>
                            <td>{{$row->p_c_fname.' '.$row->p_c_lname}}</td>
                            <td>{{$row->p_a1_fname.' '.$row->p_a1_lname}}</td>
                            <td>{{$row->p_a2_fname.' '.$row->p_a2_lname}}</td>
                            <td class="text-center">
                                @php($color_bg_status = "bg-success")
                                @foreach($list_person_work_status as $stat)
                                @if($row->IWJOB_PERSON_STATUS_ID == 1)
                                @php($color_bg_status = "bg-primary")
                                @endif
                                @if($row->IWJOB_PERSON_STATUS_ID == $stat->IWJOB_PERSON_STATUS_ID)
                                <p class="{{$color_bg_status}} m-0 radius-5 p-1 text-white fs-14">{{$stat->IWJPS_NAME}}</p>
                                @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle f-kanit fw-2 fs-12" id="dropdown-align-primary"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ทำรายการ</button>
                                    <div class="dropdown-menu dropdown-menu-right fs-15" aria-labelledby="dropdown-align-primary"
                                        x-placement="bottom-end"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-67px, 38px, 0px);">
                                        @if($row->IWJOB_PERSON_STATUS_ID != 2 && $row->IWJOB_PERSON_STATUS_ID != 3 )
                                        <a class="dropdown-item" href="{{route('mperson.jobdescriptions_personnel_estimate6',$row->IWJOB_PERSON_ID)}}">ประเมิน KPI <b>6 เดือนแรก</b></a>
                                        @endif
                                        @if($row->IWJOB_PERSON_STATUS_ID == 2)
                                        <a class="dropdown-item" href="{{route('mperson.jobdescriptions_personnel_estimate12',$row->IWJOB_PERSON_ID)}}">ประเมิน KPI <b>6 เดือนหลัง</b></a>
                                        @endif
                                        <a class="dropdown-item" href="{{route('mperson.jobdescriptions_personnel_edit',$row->IWJOB_PERSON_ID)}}">แก้ไข</a>
                                        @if($row->IWJOB_PERSON_STATUS_ID == 1)
                                        <a class="dropdown-item" href="{{route('mperson.jobdescriptions_personnel_delete',$row->IWJOB_PERSON_ID)}}" onclick="return confirm('ต้องการลบจริงหรือไม่?')" >ลบ</a>
                                        @endif
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('mperson.jobdescriptions_personnel_estimate',$row->IWJOB_PERSON_ID)}}">ผลการประเมิน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="add_jobdescription" role="dialog" aria-labelledby="add_jobdescription" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <form action="{{route('mperson.jobdescriptions_personnel_save')}}" method="post" id="form_modal">
    @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-b " id="add_jobdescription">เพิ่ม job description รายบุคคล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-form-label">ปีงบประมาณ</div>
                        <div class="col-md-8 mb-2">
                            <select name="budgetyear" id="budgetyear_modal" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;font-size: 12px;" required>
                                <option value="" disabled selected="true">เลือกปีงบประมาณ</option>
                                @foreach($dropbudgetyear as $value)
                                @if($value == $budgetyear)
                                    <option value="{{$value}}" selected>{{$value}}</option>
                                @else
                                    <option value="{{$value}}">{{$value}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-form-label">Job descriptions</div>
                        <div class="col-md-8 mb-2">
                            <select name="job_descript" id="job_descript_modal" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;font-size: 12px;" required>
                                <option value="" disabled selected="true">เลือก job description</option>
                                @foreach($dropjob_descript as $row)
                                @if($row->IWJOB_D_ID == $job_descript)
                                    <option value="{{$row->IWJOB_D_ID}}" selected>{{$row->IWJD_NAME}}</option>
                                @else
                                    <option value="{{$row->IWJOB_D_ID}}">{{$row->IWJD_NAME}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-form-label">ผู้รับ Job description</div>
                        <div class="col-md-12 mb-2">
                            <table class="table table-striped table-bordered">
                                <thead class="text-white" style="background:#0665d0">
                                    <tr>
                                        <th width="80%" style="vertical-align:middle;" class="text-center py-1">ชื่อ</th>
                                        <th width="20%" class="text-center py-1">
                                            <button type="button" class="btn btn-sm btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i></button>
                                        </th>
                                </thead>
                                <tbody class="tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </form>
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
<!-- <script src="{{ asset('select2/select2.min.js') }}"></script> -->
<!-- sweet alert2 -->
<script src="{{asset('asset/js/plugins/es6-promise/es6-promise.auto.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- notify -->
<script src="{{asset('asset/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script>
    @if(Session::has('scc_notify'))
        jQuery(function () {
            Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: '{{session("scc_notify")}}'})
        });
    @endif

    @if(Session::has('scc'))
        Swal.fire("{{session('scc')}}","<?=session('scc_msg')?>",'success')
    @endif
    @if(Session::has('err'))
        Swal.fire("{{session('err')}}","<?=session('err_msg')?>",'error')
    @endif
</script>
<script>
    $('.addRow').on('click',function(){
        addRow();
    })
    
    function addRow() {
        var count = $('.tbody').children('tr').length;
        var tr =    '<tr>'+
                    '<td width="80%" class="text-left">'+
                        '<div class="form-group mb-0">'+
                        '<select class="js-select2 form-control select2" id="person_id" name="person_id[]"'+
                        'style="width: 100%;" data-placeholder="เลือกบุคคล" required>'+
                        '<option></option>'+
                        @foreach($dropperson as $row)
                            '<option value="{{$row->ID}}">{{$row->HR_PREFIX_NAME.$row->HR_FNAME.'  '.$row->HR_LNAME}}</option>'+
                        @endforeach
                        '</select>'+
                        '</div>'+
                    '</td>'+
                    '<td width="20%" class="text-center">'+
                    '<button type="button" class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></button>'+
                    '</td>'+
                    '</tr>';
        $('.tbody').append(tr);
        $('.js-select2').select2();
    };
    $('.tbody').on('click','.remove', function () {
        $(this).parent().parent().remove();
    });
</script>
<script>
    $('#btn_add_jobdescription').click(function name(params) {
        $('.js-select2').select2();
    })
    $('.select2').select2();
    $('.budget').change(function () {
        if ($(this).val() != '') {
            var select = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('admin.selectbudget')}}",
                method: "GET",
                data: {
                    select: select,
                    _token: _token
                },
                success: function (result) {
                    $('.date_budget').html(result);
                    datepick();
                }
            })
        }
    });

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        todayHighlight: true,
        language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย
        thaiyear: true,
        autoclose: true //Set เป็นปี พ.ศ.
    }); //กำหนดเป็นวันปัจุบัน
</script>
@endsection