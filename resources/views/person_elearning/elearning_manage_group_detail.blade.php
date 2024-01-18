@extends('layouts.elearning')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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

<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">รายละเอียดหมวดหมู่{{ $deatail_lessongroup ->NAME_LESSON_GROUP}}</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow"><br>
            <div class="row">
                <div class="col-md-12" align="right">
                    <a href="{{ url('e_learning/manage_group')  }}"   class="btn btn-hero-sm btn-hero-success foo15 loadscreen"  ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
                </div>
            </div>  
            <div class="row">
                <br>
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12"><br>
                                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full text-center" >
                                    <thead class=" table-warning">
                                            <tr>
                                                <th  width="5%"><span style="font-size: 15px;">ลำดับ</span></th>
                                                <th><span style="font-size: 15px;">ชื่อบทเรียน</span></th>
                                                <th width="15%">สถานะ</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php $number = 0; ?>
                                @foreach ($deatail_lesson as $row)
                                    <?php $number++; ?>
                                            <tr>
                                                <td class=""><span style="font-size: 15px;">{{$number}}</span></td>
                                                <td class="" align="left"><span style="font-size: 15px;">{{ $row ->NAME_LESSON}}</span></td>
                                                <td align="center" width="10%">
                                                <div class="custom-control custom-switch custom-control-lg ">
                                                    @if($row-> ACTIVE_LESSON == 'True' )
                                                    <input type="checkbox" class="custom-control-input" id="" name=""  checked>
                                                    @else
                                                    <input type="checkbox" class="custom-control-input" id="" name="" >
                                                    @endif
                                                    <label class="custom-control-label" for=""></label>
                                                </div>
                                            </td>
                                            </tr> 
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




@endsection

@section('footer')

<script>
  function readURL_edit(input) {
    var fileInput = document.getElementById('picture_edit');
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    var numb = input.files[0].size / 1024;
    if (numb > 100) {
      alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
      fileInput.value = '';
      return false;
    }
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#image_upload_preview_edit').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif');
      fileInput.value = '';
      return false;
    }
  }
  $("#picture_edit").change(function () {
    readURL_edit(this);
  });
</script>

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

    <script src="{{ asset('asset/js/plugins/datatables/buttons.colVis.min.js') }}"></script>


<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>  
    $(document).ready(function () {
         $('#select_edit_exam_group').select2();
    });

    $(document).ready(function () {
         $('#select_edit_exam').select2();
    });
</script>
 @endsection




