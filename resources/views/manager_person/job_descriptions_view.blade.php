@extends('layouts.person')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<style>
    .td-padding td{
        padding:0px 10px;
    }
</style>
@endsection
@section('content')
<?php
    use App\Http\Controllers\ManagerpersonController;
?>
<div style="width:95%;margin:auto;">
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-title">
                ข้อมูล Job descriptions
            </div>
            <div class="block-options">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('mperson.setinfo_jobd')}}" method="post" class="row">
                            @csrf
                            <div class="col-md-6">
                                <input type="search" name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" value="{{$search}}" placeholder="ค้นหา">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-hero-sm btn-hero-info" style=" font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-search mr-2"></i>ค้นหา</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                    <a href="{{route('mperson.setinfo_jobd_add')}}" class="btn btn-info"><i class="fa fa-plus mr-2"></i>เพิ่ม
                    job descriptions</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content mb-4">
            @if(Session::has('listnodadd'))
                <h5>รายชื่อที่ไม่สามารถเพิ่มได้ เนื่องจากทำการเพิ่มข้อมูลแล้ว</h5>
                @foreach(Session('listnodadd') as $row)
                <div class="alert alert-danger">{{$row->HR_FNAME.'  '.$row->HR_LNAME}}</div>
                @endforeach
            @endif
            <div class="table-responsive">
                <table class="table-striped table-vcenter table-sl-p-5px" style="width: 100%;">
                    <colgroup>
                        <col width="5%">
                        <col width="40%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead class="bg-sl-header">
                        <tr height="40">
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                ลำดับ</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                รายการ Job descriptions</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                ตำแหน่ง</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                จำนวน (คน)</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">บุคคล</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                KPI</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                สถานะ</th>
                            <th class="text-font"
                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                คำสั่ง
                            </th>
                        </tr>
                    </thead>
                    <tbody class="td-padding">
                        @php($number = 1)
                        @foreach($infowork_job_descriptions as $row)
                        <tr>
                            <td class="text-center">{{$number++}}</td>
                            <td>{{$row->IWJD_NAME}}</td>
                            <td>{{$row->IWJD_POSITION}}</td>
                            <td style="text-align:center">{{ManagerpersonController::count_job_of_person(getBudgetYear(),$row->IWJOB_D_ID)}}</td>
                            <td style="padding:1px;text-align:center">
                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add_jobdescription" id="btn_add_jobdescription" onclick="add_jobdescription('{{$row->IWJOB_D_ID}}','{{$row->IWJD_NAME}}')"><i class="fa fa-id-badge"></i></a>
                            </td>
                            <td class="text-center">
                                <div class="fa fa-book text-primary" style="cursor:pointer" onclick="show_kpi_of_job_description('{{$row->IWJOB_D_ID}}','{{$row->IWJD_NAME}}','{{$row->IWJD_ACTIVE}}')"></div>
                            </td>
                            <td class="text-center">
                                @if($row->IWJD_ACTIVE)
                                <div class="badge badge-success fs-14 fw-3">เปิดใช้งาน</div>
                                @else
                                <div class="badge badge-danger fs-14 fw-3">ปิดใช้งาน</div>
                                @endif
                            </td>
                            <td class="text-center" style="padding-top:2px;padding-bottom:2px">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle f-kanit fw-2 fs-12" id="dropdown-align-primary"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ทำรายการ</button>
                                    <div class="dropdown-menu dropdown-menu-right fs-15" aria-labelledby="dropdown-align-primary"
                                        x-placement="bottom-end"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-67px, 38px, 0px);">
                                        <a class="dropdown-item" href="{{route('mperson.job_descriptions_set',$row->IWJOB_D_ID)}}">กำหนด KPI</a>
                                        <a class="dropdown-item" href="{{route('mperson.setinfo_jobd_edit',$row->IWJOB_D_ID)}}">แก้ไข</a>
                                        <a class="dropdown-item" href="{{route('mperson.setinfo_jobd_delete',$row->IWJOB_D_ID)}}" onclick="return confirm('ต้องการลบจริงหรือไม่?')" >ลบ</a>
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

<button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#kpi_show" id="kpi_show_click">
</button>

<!-- Modal -->
<div class="modal fade" id="kpi_show" tabindex="-1" role="dialog" aria-labelledby="kpi_show_label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-b" id="kpi_show_label">ข้อมูล KPI <span id="#jobdescription"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid fs-16">
                    <div class="row">
                        <div class="col-md-3">
                            รายการ Job descriptions
                        </div>
                        <div class="col-md-9">
                        : <span id="jobdescription_name"></span>
                        </div>
                        <div class="col-md-3">
                            สถานะ
                        </div>
                        <div class="col-md-auto"> : 
                            <span id="jobdescription_status"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table-striped table-vcenter table-sl-p-5px" style="width: 100%;">
                                    <thead class="bg-sl-header">
                                        <tr height="40">
                                            <th width="5%" class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                                ลำดับ</th>
                                            <th width="20%" class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                                ชื่อ</th>
                                            <th width="25%" class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" colspan="5">
                                                คะแนนตามระดับค่าเป้าหมาย</th>
                                            <th width="8%" class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                                คะแนน</th>
                                            <th width="8%" class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                                น้ำหนัก
                                            </th>
                                            <th width="8%" class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                                ผลรวม</th>
                                            <th width="8%" class="text-font"
                                                style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">
                                                เป้า</th>
                                        </tr>
                                        <tr>
                                            <th width="5%">1</th>
                                            <th width="5%">2</th>
                                            <th width="5%">3</th>
                                            <th width="5%">4</th>
                                            <th width="5%">5</th>
                                        </tr>
                                    </thead>
                                    <tbody class="td-padding" id="jobdescription_kpi_list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="add_jobdescription" role="dialog" aria-labelledby="add_jobdescription" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <form action="{{route('mperson.jobdescriptions_personnel_save')}}" method="post" id="form_modal">
    @csrf
    <input type="hidden" name="budgetyear" value="{{$budgetyear}}">
    <input type="hidden" name="job_descript" value="">
    <input type="hidden" name="from_page" value="setup_infowork_job_descriptions">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-b " id="add_jobdescription">เพิ่ม job description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-form-label">ปีงบประมาณ</div>
                        <div class="col-md-8 mb-2">{{$budgetyear}}</div>
                        <div class="col-md-4 col-form-label">Job descriptions</div>
                        <div class="col-md-8 mb-2" id="jobdescription_name_insert">...</div>
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
<script>
    @if(Session::has('scc_notify'))
        jQuery(function () {
            Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: '{{session("scc_notify")}}'})
        });
    @endif
    @if(Session::has('scc'))
        Swal.fire(`{{session('scc')}}`,`<?=session('scc_msg')?>`,'success')
    @endif
    @if(Session::has('err'))
        Swal.fire(`{{session('err')}}`,`<?=session('err_msg')?>`,'error')
    @endif
</script>
<script>
    let token = $('meta[name="csrf-token"]').attr('content')
    function show_kpi_of_job_description(id,name,status){
        $.ajax({
            url:"{{route('mperson.ajax_setinfo_jobd_list_kpi')}}",
            method:"post",
            data:{
                _token : token,
                id:id
            },
            success:(result)=>{
                $('#jobdescription_name').html(name);
                if(status == 1){
                    $('#jobdescription_status').html(`<div class="badge badge-success fs-14 fw-3">เปิดใช้งาน</div>`);
                }else{
                    $('#jobdescription_status').html(`<div class="badge badge-danger fs-14 fw-3">ปิดใช้งาน</div>`);
                }
                $('#jobdescription_kpi_list').html(result);
                
                $('#kpi_show_click').click();
            } 
        });
    }
</script>
<script>
    function add_jobdescription(job_id,job_name) {
        console.log(job_name + job_id);
        $('#jobdescription_name_insert').html(job_name);
        $('input[name="job_descript"]').val(job_id);
    }

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
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "auto" );
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