@extends('layouts.elearning')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')
<style>
    body * {
        font-family: 'Kanit', sans-serif;
    }

    p {
        word-wrap: break-word;
    }

    .text {
        font-family: 'Kanit', sans-serif;
    }
</style>

<div class="block mb-4 " style="width: 95%;margin: 45px;">
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">คำถาม : {{ $info_exam ->QUESTION_EXAM}}</h3>
        </div>
        <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow"><br>
            <div class="row">
                <div class="col-md-12" align="right">
                    <a href="{{ url('e_learning/manage_exam/detail_question/'.$id_exam_group)  }}"
                        class="btn btn-hero-sm btn-hero-success foo15 loadscreen"><i
                            class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @if (session('alert'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="flex-fill ml-3">
                            <p class="mb-0">{{ session('alert') }}</p>
                        </div>
                    </div>

                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8" align="right">
                    <button type="button" class="btn btn-outline-info mr-1 mb-3 text" data-toggle="modal"
                        data-target="#add_choice">
                        <i class="fa fa-fw fa-plus mr-1"></i>เพิ่มคำตอบ
                    </button>
                </div>
            </div>
            <div class="row">
                <br>
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12"><br>
                            <table
                                class="table table-bordered table-hover  table-vcenter js-dataTable-full text-center">
                                <thead class=" table-warning">
                                    <tr>
                                        <th width="7%"><span style="font-size: 14px;">ตัวเลือก</span</th> <th
                                                    width="30%"><span style="font-size: 14px;">คำตอบ</span</th> <th
                                                        width="5%"><span style="font-size: 14px;">เฉลย</span</th> <th
                                                            width="5%"><span style="font-size: 14px;">เปิดใช้</span</th>
                                                                <th width="5%"><span style="font-size: 14px;">คำสั่ง
                                                                </span</th> </tr> </thead> <tbody>
                                                                <?php $number = 0; ?>
                                                                <?php ; ?>
                                                                @foreach ($info_exam_choice as $row)
                                                                <?php $number++; ?>
                                    <tr>
                                        <td class=""><span style="font-size: 14px;">{{$number }}</span</td> <td class=""
                                                    align="left"><span style="font-size: 14px;">{{ $row ->EXAM_CHOICE}}
                                                    </span</td> @if ($row ->ANSWER_EXAM_CHOICE == 'True' )
                                        <td class="text-center" align="left"><span
                                                style="font-size: 14px;">{{ $ANSWER_EXAM_CHOICE = 'ถูก'}}</span</td>
                                                    @else <td class="text-center" align="left"><span
                                                    style="font-size: 14px;">{{ $ANSWER_EXAM_CHOICE = 'ผิด'}}</span</td>
                                                        @endif <td align="center" width="10%">
                                                    <div class="custom-control custom-switch custom-control-lg ">
                                                        @if($row-> ACTIVE_EXAM_CHOICE == 'True' )
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="{{ $row-> ID_EXAM_CHOICE }}"
                                                            name="{{ $row-> ID_EXAM_CHOICE }}"
                                                            onchange="switch_status({{ $row-> ID_EXAM_CHOICE }});"
                                                            checked>
                                                        @else
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="{{ $row-> ID_EXAM_CHOICE }}"
                                                            name="{{ $row-> ID_EXAM_CHOICE }}"
                                                            onchange="switch_status({{ $row-> ID_EXAM_CHOICE }});">
                                                        @endif
                                                        <label class="custom-control-label"
                                                            for="{{ $row-> ID_EXAM_CHOICE }}"></label>
                                                    </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle foo13"
                                                    id="dropdown-align-outline-info" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu foo13" style="width:15px">
                                                    <a class="dropdown-item"
                                                        href="#edit_choice{{ $row -> ID_EXAM_CHOICE }}"
                                                        data-toggle="modal">แก้ไขข้อมูล</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- The Modal edit exam-->
                                    <script>
                                    $(document).ready(function() {
                                        $("#ID_EXAM_edit{{ $row -> ID_EXAM_CHOICE}}").select2({ 
                                            dropdownParent: $("#edit_choice{{ $row -> ID_EXAM_CHOICE }}") 
                                        });
                                    });
                                    </script>

                                    <div class="modal fade " id="edit_choice{{ $row -> ID_EXAM_CHOICE }}" role="dialog" aria-labelledby="modal-block-fromleft"  aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-fromleft modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="block block-themed block-transparent mb-0">
                                                    <div class="block-header bg-warning">
                                                        <h2 class="block-title">แก้ไขคำตอบ</h2>
                                                    </div>
                                                    <div class="block-content">
                                                        <form method="post"
                                                            action="{{ url('/e_learning/manage_exam/update_choice/'.$row->ID_EXAM)}}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" id="ID_EXAM_CHOICE" name="ID_EXAM_CHOICE" style=" font-family: 'Kanit', sans-serif;" value="{{$row->ID_EXAM_CHOICE}}">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label for="" class="fs-20">คำถาม <span
                                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-9 text-left" align="left">
                                                                    <div class="form-group">
                                                                        <select class="form-control text"
                                                                            id="ID_EXAM_edit{{ $row -> ID_EXAM_CHOICE }}"
                                                                            name="ID_EXAM_edit" style="width: 100%;"
                                                                            data-placeholder="Choose one..">
                                                                            <option></option>
                                                                            @foreach ($id_exam as $row_id_exam)
                                                                            @if( $row_id_exam ->ID_EXAM ==
                                                                            $row->ID_EXAM)
                                                                            <option value="{{ $row_id_exam->ID_EXAM  }}"
                                                                                selected>{{$row_id_exam->QUESTION_EXAM}}
                                                                            </option>
                                                                            @else
                                                                            <option
                                                                                value="{{ $row_id_exam->ID_EXAM  }}">
                                                                                {{$row_id_exam->QUESTION_EXAM}}</option>
                                                                            @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div><br>

                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label for="" class="fs-20">คำตอบ <span
                                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-9 text-left" align="left">
                                                                    <input type="text" class="form-control" required
                                                                        id="EXAM_CHOICE" name="EXAM_CHOICE_edit"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{ $row->EXAM_CHOICE  }}">
                                                                </div>
                                                            </div><br>

                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label for="" class="fs-20">เฉลย <span
                                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                                                @if($row->ANSWER_EXAM_CHOICE == 'True')
                                                                <div class="col-md-1 form-group">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="ANSWER_edit" value="True"
                                                                            checked="true">ถูก
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 form-group">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="ANSWER_edit" value="False">ผิด
                                                                    </label>
                                                                </div>
                                                                @else
                                                                <div class="col-md-1 form-group">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="ANSWER_edit" value="True">ถูก
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 form-group">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="ANSWER_edit" value="False"
                                                                            checked="true">ผิด
                                                                    </label>
                                                                </div>
                                                                @endif

                                                            </div><br>

                                                    </div>
                                                    <div class="block-content block-content-full text-right bg-light">
                                                        <div align="right">
                                                            <button type="submit"
                                                                class="btn btn-hero-sm btn-hero-info foo15"><i
                                                                    class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                            <button type="submit"
                                                                class="btn btn-hero-sm btn-hero-danger foo15"
                                                                data-dismiss="modal"><i
                                                                    class="fas fa-times mr-2"></i>ยกเลิก</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    </tbody>
                            </table><br>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- The Modal add choice-->
<div class="modal fade" id="add_choice" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromleft"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromleft modal-xl" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-success">
                    <h2 class="block-title">เพิ่มตัวเลือกคำตอบ</h2>
                </div>
                <div class="block-content">
                    <form method="post" action="{{ url('e_learning/manage_exam/save_choice/'.$info_exam ->ID_EXAM) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="fs-20">คำถาม <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 text-left" align="left">
                                <div class="form-group">
                                    <input type="hidden" id="ID_EXAM" name="ID_EXAM" value="{{$info_exam ->ID_EXAM}}">
                                    <input type="text" class="form-control" style=" font-family: 'Kanit', sans-serif;"
                                        value="{{$info_exam ->QUESTION_EXAM}}" disabled>
                                </div>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="fs-20">คำตอบ <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 text-left" align="left">
                                <input type="text" class="form-control" required placeholder="กรุณากรอกคำตอบ..."
                                    id="EXAM_CHOICE" name="EXAM_CHOICE" style=" font-family: 'Kanit', sans-serif;">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="fs-20">เฉลย <span class="text-danger">*</span></label>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                            <div class="col-md-1 form-group">
                                <label class="form-check-label">
                                    <input type="radio" required class="form-check-input" name="ANSWER" value="True">ถูก
                                </label>

                            </div>
                            <div class="col-md-1 form-group">

                                <label class="form-check-label">
                                    <input type="radio" required class="form-check-input" name="ANSWER"
                                        value="False">ผิด
                                </label>
                            </div>

                        </div><br>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <div align="right">
                        <button type="submit" class="btn btn-hero-sm btn-hero-info foo15"><i
                                class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                        <button type="submit" class="btn btn-hero-sm btn-hero-danger foo15" data-dismiss="modal"><i
                                class="fas fa-times mr-2"></i>ยกเลิก</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>


<!-- on off -->
<script>
    function switch_status(status_choice) {
        // alert(budget);
        var checkBox = document.getElementById(status_choice);
        var onoff;

        if (checkBox.checked == true) {
            onoff = "True";
        } else {
            onoff = "False";
        }
        //alert(onoff);

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('switch_exams_choice')}}",
            method: "GET",
            data: {
                onoff: onoff,
                status_choice: status_choice,
                _token: _token
            }
        })
    }
</script>

<!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>
    jQuery(function () {
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

<script src="{{ asset('asset/js/plugins/datatables/buttons.colVis.min.js') }}"></script>



<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

@endsection