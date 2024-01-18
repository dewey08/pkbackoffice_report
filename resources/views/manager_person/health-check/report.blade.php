@extends('layouts.personhealth')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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
    
    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
    
    }
    
    .text-pedding {
        padding-left: 10px;
    }
    
    .text-font {
        font-size: 13px;
    }
    .div-block{
        margin-left: auto;
        margin-right: auto;
        margin-top: 30px;
        margin-bottom: 30px;
        text-align: center;
    }
    .span-font{
        font-size: 16px;
        font-family: 'Kanit', sans-serif;
    }

    .btn-block{
        font-family: 'Kanit', sans-serif;
    }

    </style>

@section('content')

<div class="col-md-12">
    <div class="block block-rounded block-bordered">

        <div class="block-header block-header-default" style="margin-top:50px;">
            <h3 class="block-title text-center" style="font-family: 'Kanit', sans-serif;"><B>รายงานระบบสมรรถภาพ</B></h3>
        </div>

        <div class="block-content block-content-full">
            <div class="col-md-10" style="margin-left: auto; margin-right:auto;">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('manager_person.health-check.report-table', 1) }}" class="btn btn-primary btn-block" role="button" target="_blank">
                            รายงานทดสอบสมรรถภาพ สัญญาณชีพ
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('manager_person.health-check.report-table', 1) }}" class="btn btn-primary btn-block" role="button" target="_blank">
                            รายงานทดสอบสมรรถภาพ สัดส่วนร่างกาย
                        </a>
                    </div>
                    <div class="col-md-6" style="margin-top: 30px;">
                        <a href="{{ route('manager_person.health-check.report-table', 1) }}" class="btn btn-primary btn-block" role="button" target="_blank">
                            <span>รายงานทดสอบสมรรถภาพ ความจุปอด</span>
                        </a>
                    </div>
                    <div class="col-md-6" style="margin-top: 30px;">
                        <a href="{{ route('manager_person.health-check.report-table', 1) }}" class="btn btn-primary btn-block" role="button" target="_blank">
                            <span>รายงานทดสอบสมรรถภาพ ความอ่อนตัว</span>
                        </a>
                    </div>
                </div>
            </div>        
        </div>
        
    </div>
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