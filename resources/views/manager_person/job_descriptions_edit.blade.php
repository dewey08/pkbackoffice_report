@extends('layouts.person')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<style>
    .td-padding td{
        padding:0px 10px;
    }
</style>
@endsection
@section('content')
<div style="width:95%;margin:auto;">
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-title">
                แก้ไข Job descriptions
            </div>
        </div>
        <div class="block-content mb-4">
            <form action="{{route('mperson.setinfo_jobd_update')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$infowork_job_descriptions->IWJOB_D_ID}}">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 col-form-label">
                            ชื่อ Job Description <span style="color:red">*</span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <textarea name="jobdescription_name" id="" cols="30" rows="5" class="form-control">{{$infowork_job_descriptions->IWJD_NAME}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-2 col-form-label">
                            ผลที่คาดหวัง <span style="color:red">*</span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <textarea name="jobdescription_expected" id="" cols="30" rows="5" class="form-control">{{$infowork_job_descriptions->IWJD_EXPECTED_RESULT}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-2 col-form-label">
                            ตำแหน่ง
                        </div>
                        <div class="col-md-10">
                            <div class="col-form-label custom-control custom-switch mb-1 col-sm-5">
                                <select name="jobdesction_position" id="jobdesction_position" class="select2" required data-placeholder="กรุณาเลือกตำแหน่ง">
                                    <option></option>
                                    <option value="{{$infowork_job_descriptions->HR_POSITION_NAME}}" selected>{{$infowork_job_descriptions->HR_POSITION_NAME}}</option>
                                    @foreach($infoposition as $row)
                                    <option value="{{$row->HR_POSITION_NAME}}">{{$row->HR_POSITION_NAME}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-form-label">
                            การใช้งาน Job Description
                        </div>
                        <div class="col-md-10">
                            <div class="col-form-label custom-control custom-switch mb-1 col-sm-5">
                                <input type="checkbox" class="custom-control-input" id="jobdescription_active"
                                    name="jobdescription_active" value="1" <?=$infowork_job_descriptions->IWJD_ACTIVE?'checked=""':''?>>
                                <label class="custom-control-label" for="jobdescription_active">ปิด-เปิด</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-right">
                    <button type="submit" class="btn btn-info mr-2"><i class="fa fa-save mr-2"></i>แก้ไขข้อมูล</button>
                    <a href="{{route('mperson.setinfo_jobd')}}" onClick="return confirm('ต้องการยกเลิกจริงหรือไม่ ?')"
                        class="btn btn-danger"><i class="fa fa-window-close mr-2"></i>ยกเลิก</a>
                </div>
            </form>
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
<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
    @if(Session::has('scc'))
        Swal.fire("{{session('scc')}}","<?=session('scc_msg')?>",'success')
    @endif
    @if(Session::has('err'))
        Swal.fire("{{session('err')}}","<?=session('err_msg')?>",'error')
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