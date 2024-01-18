@extends('layouts.elearning')
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


<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">

        <div class="block-header block-header-default">
            <h3 class="block-title text-center  fs-24"> ข้อมูลผลการทดสอบ</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow"><br>
        <form action="{{ route('information_points_search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-2" align="right">
                    <label for="" class="fs-20">หมวดหมู่บทเรียน :</label>
                </div> 
                <div class="col-md-2 text-left " >
                    <select class="form-control" id="ID_LESSON_GROU"  name="ID_LESSON_GROU" style=" font-family: 'Kanit', sans-serif;">
                        <option> กรุณาเลือก </option>
                        @foreach ($id_lesson_group as $row)
                                @if(empty($id_lesson_group_search))
                                    <option value="{{$row->ID_LESSON_GROU}}"> {{$row->NAME_LESSON_GROUP}}</option>
                                @else
                                    @if( $row->ID_LESSON_GROU == $id_lesson_group_search)
                                        <option value="{{$row->ID_LESSON_GROU}}" selected> {{$row->NAME_LESSON_GROUP}}</option>
                                    @else
                                        <option value="{{$row->ID_LESSON_GROU}}"> {{$row->NAME_LESSON_GROUP}}</option>
                                    @endif
                                @endif
                            @endforeach
                    </select>
                </div> 
                <div class="col-md-1" align="left">
                    <button type="submit" class="btn btn-info fw-5 text loadscreen">แสดง</button>
                </div> 
            </div><br>
        </form>

            <div class="row ">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                <br>
                <table class="table table-bordered table-hover table-vcenter js-dataTable-full text-center" >
                                <thead class=" table-warning " >
                                        <tr>
                                            <th width="5%"><span style="font-size: 16px;">ลำดับ</span></th>
                                            <th width="50%"><span style="font-size: 16px;">ชื่อบทเรียน</span></th>
                                            <th width="10%"><span style="font-size: 16px;">คะเเนนก่อนเรียน</span></th> 
                                            <th width="10%"><span style="font-size: 16px;">คะเเนนหลังเรียน</span></th>
                                            <th width="10%"><span style="font-size: 16px;">สถานะ</span></th>
                                            <!-- <th class="d-none d-sm-table-cell" style="width: 15%;">สถานะ</th> -->
                                        </tr>
                                </thead>
                                <tbody >
                                <?php $number = 0;$i = 0; $j = 0;?>
                                @foreach ($info_sum_score as $row)
                                <?php $number++; ?>
                                        <tr>
                                            <td ><span style="font-size: 16px;">{{$number}}</span></td>
                                            <td  align="left"><span style="font-size: 16px;">{{$row->NAME_LESSON}}</span></td>
                                            <td ><span style="font-size: 16px;">{{$data[$i]}}</span></td>
                                            <td ><span style="font-size: 16px;">{{$data2[$j]}}</span></td>
                                            <td class=" d-none d-md-table-cell" ><h5><span class="badge badge-success" >ผ่าน</span></h5></td>
                                        </tr>
                                        <?php $i++; $j++;?> 
                                @endforeach
                                </tbody>
                        </table><br>
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
 <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
 <script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('select').select2();
});
</script>
@endsection