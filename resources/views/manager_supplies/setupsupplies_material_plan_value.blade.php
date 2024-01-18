@extends('layouts.supplies')
@section('css_before')
    <?php
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
    ?>


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
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    }
    
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
    
    ?>

    <style>
        .center {
            margin: auto;
            width: 100%;
            padding: 10px;
        }

        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            /* font-size: 1.0rem; */
        }

        .text-pedding {
            padding-left: 10px;
        }

        .text-font {
            font-size: 13px;
        }

        .table,
        th,
        td {
            border: 1px solid rgb(0, 0, 0);
        }

            .form-control{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      }   

      input::-webkit-calendar-picker-indicator{ 
  
    font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
}     

    </style>



    <?php
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');
    ?>
@endsection

@section('content')
    {{-- <center> --}}
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    
    @if (\Session::has('success_save'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success_save') !!}</li>
        </ul>
    </div>
@endif

    <div class="block " style="width: 95%;margin:auto">
     
        
        <div class="block-content">
            <div class="block-header block-header-default">
                       <div class="col-6"> <h3 class="block-title text-left fs-20">กำหนดมูลค่าแผนพัสดุ <span >ประจำปี {{$ids->PLAN_SUPPLIES_YEAR}}</span></h3></div>
                        <div class="col-6"> <a class="btn btn-hero btn-success loadscreen" style="float: right;"
                            href="{{ url('manager_supplies/setupsupplies_year_material_plan_value') }}"><i
                                class="far fa-arrow-alt-circle-left  fa-1x">&nbsp;&nbsp;</i>ย้อนกลับ</a></div>
                    </div>
        
        </div>
        
        <hr>
        <div class="col-12" align="right">
           
            <a href="{{ url('manager_supplies/add_setupsupplies_material_plan_value/'.$ids ->PLAN_SUPPLIES_YEAR_ID) }}"
                class="btn btn-hero-sm btn-hero-info"
                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-plus"></i>
                เพิ่มข้อมูลแผนจัดซื้อ</a>&nbsp;&nbsp;
            <a href="{{ url('manager_supplies/setupsupplies_excel_material_plan_value') }}" class="btn btn-hero-sm btn-hero-success "
                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                <li class="fa fa-file-excel"></li>&nbsp;Excel
            </a>
        </div> <br>
        <style>
            .grid-container {
                display: grid;
                table-layout: auto;
                font-size: 14px;

            }

        </style>
        <div class="col-12  grid-container">
            <div class="col-sm-12 ">

                {{-- <div class="table-responsive"> --}}
                <table class="table-striped  table-hover table-bordered  js-dataTable-simple" width="100%" height="100%">
                   
                    <thead style="background-color: #FFEBCD;text-align: center;border: 1px solid black; ">

                        <tr height="40">
                            <th class="text-font" width="5%">ลำดับ</th>
                            <th class="text-font" width="40%">
                                ประเภทพัสดุ
                            </th>
                            <th class="text-font" width="40%"> แผนจัดซื้อ
                                (บาท)
                            </th>
                          

                            <th class="text-font" width="12%">ลบข้อมูล
                            </th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $count = 1; ?>

                        @foreach ($mp_e as $row)


                            <tr>
                                <td class="text-center">
                                    {{ $count }}
                                </td>
                                <td>
                                    {{ $row->SUP_TYPE_NAME }}
                                </td>
                                <td class="text-font text-pedding">
                                    <input pattern="[0-9]{1}" title="กรอกตัวเลขเท่านั้น" type="number" id="receipt{{ $row->SUP_MATERIAL_ID }}"
                                        name="receipt{{ $row->SUP_MATERIAL_ID }}"
                                        class="form-control input-sm inputs{{ $count }}"
                                        style=" font-family: 'Kanit', sans-serif;"
                                        onkeyup="SUP_MV({{ $row->SUP_MATERIAL_ID }},{{ $row->SUP_MATERIAL_ID }},{{ $count }});"
                                        value="{{ $row->SUP_MATERIAL_VALUE }}" placeholder="กรอกตัวเลข (จำนวนเต็ม/ไม่มีจุด คอมม่า ตัวหนังาสือ หรือ เครื่อหมายต่างๆ)" >



                                </td>
                          
                                <td align="center">
                                    

                                        <a href="{{ url('manager_supplies/destroy_setupsupplies_material_plan_value/'.$ids ->PLAN_SUPPLIES_YEAR_ID.'/'.$row->SUP_MATERIAL_ID) }}"
                                            onclick="return confirm('ต้องการที่จะลบข้อมูล {{$row->SUP_TYPE_NAME}} ?')"
                                            class="btn btn-sm btn-danger "><i class="fa fa-window-close fa-1.6x"></i></a>

                                </td>


                            </tr>

                            <?php $count++; ?>
                        @endforeach
                    </tbody>
                </table>

            </div>


        </div>
        <br><br>
    </div>









@endsection

@section('footer')

    <script>
        function SUP_MV(idreceipt, idlist, count) {


            var x = event.which || event.keyCode;
            // alert(x);
            // var next = event.srcElement || event.target;
            if (x == 13) {
                var value = document.getElementById('receipt' + idreceipt).value;
                var number = count + 1;

                var value = document.getElementById('receipt' + idreceipt).value;

                // alert(value+"::"+iddep);

                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('msupplies.up_material_plan_value') }}",
                    method: "GET",
                    data: {
                        value: value,
                        idreceipt: idreceipt,
                        _token: _token
                    },
                    success: function(result) {
                        // alert("ikjlf");

                        $(".inputs" + number).focus();


                    }

                })



            }

        }

        
    </script>




    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page JS Plugins -->






@endsection
