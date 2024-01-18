@extends('layouts.user')
@section('title','ZOffice || ยานพาหนะ')
@section('content')
<script>
    function TypeAdmin() {
        window.location.href = '{{ route('index') }}';
    }
  </script>
    <?php
     if (Auth::check()) {
        $type = Auth::user()->type;
        $iduser = Auth::user()->id;
    } else {
        echo "<body onload=\"TypeAdmin()\"></body>";
        exit();
    }
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    use App\Http\Controllers\UsercarController;
          use App\Http\Controllers\StaticController;
          use App\Models\Products_request_sub;
      
          $refnumber = UsercarController::refnumber();    
          $checkhn = StaticController::checkhn($iduser);
          $checkhnshow = StaticController::checkhnshow($iduser);
          $count_suprephn = StaticController::count_suprephn($iduser);
          $count_bookrep_po = StaticController::count_bookrep_po();
    ?>


<div class="container-fluid ">
    {{-- <div class="px-0 py-0">
      <div class="d-flex flex-wrap justify-content-center "> 
        <a href="{{url('user_car/car_calenda/'.Auth::user()->id)}}" class="btn btn-secondary btn-sm text-white me-1 mt-2">
          <i class="fa-solid fa-calendar-days me-1"></i>
          ปฎิทินการใช้รถ
      </a>
        <a href="{{url('user_car/car_narmal/'.Auth::user()->id)}}" class="btn btn-secondary btn-sm text-white me-1 mt-2">
          <i class="fa-solid fa-car-side me-1"></i>
          รถทั่วไป
      </a>
        <a href="{{url('user_car/car_ambulance/'.Auth::user()->id)}}" class="btn btn-info btn-sm text-white me-1 mt-2">
          <i class="fa-solid fa-truck-medical me-1"></i>
          รถพยาบาล</a>
        
      </div>
  </div> --}}
    <div class="container-fluid">
        <div class="row invoice-card-row">  
                <div class="col-md-3 mt-2">
                    <div class="card bg-info p-1 mx-0 shadow-lg">
                        <div class="panel-body px-3 py-2 text-white">
                            รายการรถยนต์
                        </div>
                        <div class="panel-body bg-white shadow-lg">
                                <div class="row">                               
                                    @foreach ( $article_data as $items )   
                                        @if ($items->article_car_type_id == 2)
                                            {{-- <div class="col-md-3 text-center"> --}}
                                                <div class="col-6 col-md-6 col-xl-6 text-center mt-2"> 
                                                    <div class="bg-image hover-overlay ripple ms-2 me-2">
                                                        <a href="{{url('user_car/car_calenda_add/'.$items->article_id)}}">
                                                            <img src="{{asset('storage/car/'.$items->article_img)}}" height="150px" width="150px" alt="Image" class="img-thumbnail"> 
                                                                {{-- <div class="mask" style="background-color: rgba(12, 232, 248, 0.781);"></div> --}}
                                                                <br> 
                                                                <label for="" style="font-size: 11px">{{$items->article_register}}</label> 
                                                        </a>                     
                                                    </div>
                                            </div>
                                            
                                        @else
                                            <div class="col-6 col-md-6 col-xl-6 text-center mt-2"> 
                                                    <div class="bg-image hover-overlay ripple ms-2 me-2">
                                                        <a href="{{url('user_car/car_calenda_add/'.$items->article_id)}}">
                                                            <img src="{{asset('storage/car/'.$items->article_img)}}" height="150px" width="150px" alt="Image" class="img-thumbnail"> 
                                                                {{-- <div class="mask" style="background-color: rgba(247, 2, 2, 0.603);"></div> --}}
                                                                <br> 
                                                                <label for="" style="font-size: 11px">{{$items->article_register}}</label> 
                                                        </a>                                                                                     
                                                    </div> 
                                            </div>                                
                                        @endif
                                    @endforeach  
                            </div>                                         
                        </div> 
                    </div>  
                </div>  
                <div class="col-md-9 mt-2">
                    <div class="card bg-info p-1 mx-0 shadow-lg">
                        <div class="panel-header text-left px-3 py-2 text-white">
                            ปฎิทินข้อมูลการใช้บริการรถยนต์<span
                                class="fw-3 fs-18 text-white bg-sl-r2 px-2 radius-5">ทะเบียน {{$dataedits->article_register}}</span>
                        </div>
                        <div class="panel-body bg-white">

                            <div id='calendar'></div>

                        </div>
                        <div class="panel-footer text-end pr-5 py-2 bg-white ">
                            <p class="m-0 fa fa-circle me-2" style="color:#A3DCA6;"></p> อนุมัติ<label
                                class="me-3"></label>
                            <p class="m-0 fa fa-circle me-2" style="color:#814ef7;"></p> จัดสรร<label
                                class="me-3"></label>
                            <p class="m-0 fa fa-circle me-2" style="color:#fa861a;"></p>ร้องขอ <label
                                class="me-5"></label>
                        </div>
                    </div>
                </div> 
                    
        </div>
    </div>
</div>

<div class="modal fade" id="carservicessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">          
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ทำรายการจองรถ</h5> 
            </div>
            <div class="modal-body"> 

                <div class="row">
                    <div class="col-md-8">

                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <label for="car_service_book">ตามหนังสือเลขที่ </label>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-group">
                                    <input id="car_service_book" type="text" class="form-control form-control-sm input-rounded" name="car_service_book"> 
                                </div>
                            </div>
                            
                            <div class="col-md-2 mt-2">
                                <label for="car_service_year">ปีงบประมาณ </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="car_service_year" id="car_service_year" class="form-control form-control-sm"
                                        style="width: 100%;">
                                        <option value="" selected>--เลือก--</option>
                                        @foreach ($budget_year as $year)
                                            <option value="{{ $year->leave_year_id }}">{{ $year->leave_year_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          
                        </div>

                        <div class="row ">
                                <div class="col-md-2 mt-2">
                                    <label for="car_service_location">สถานที่ไป </label>
                                </div>
                                <div class="col-md-4 mt-2"> 
                                    <div class="form-group">
                                        <select name="car_service_location" id="car_service_location" class="form-control form-control-sm show_location" style="width: 100%;">
                                        @foreach ($car_location as $itemlo)
                                            <option value="{{ $itemlo->car_location_id}}">{{ $itemlo->car_location_name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <label for="" style="color: rgb(255, 145, 0)">* กรณีไม่มี </label>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="form-outline bga">
                                        <input type="text" id="CAR_LOCATION_INSERT" name="CAR_LOCATION_INSERT" class="form-control form-control-sm shadow" placeholder="เพิ่มสถานที่ไป"/>
                                   
                                    </div> 
                                </div>
                                <div class="col-md-1 mt-2"> 

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="addlocation();">
                                            เพิ่ม
                                        </button> 
                                    </div>
                                </div> 
                        </div>

                        <div class="row">
                                <div class="col-md-2 mt-2">
                                    <label for="car_service_reason">เหตุผล </label>
                                </div>
                                <div class="col-md-10 mt-2">
                                    <div class="form-outline">
                                        <input id="car_service_reason" type="text" class="form-control form-control-sm input-rounded" name="car_service_reason">
                                        
                                    </div>
                                </div>
                                
                        </div>

                        <div class="row">                            
                            <div class="col-md-2 mt-2">
                                <label for="car_service_length_godate">ตั้งแต่วันที่ </label>
                            </div> 
                            <div class="col-md-4 mt-2">
                                <div class="form-group">
                                    <input id="car_service_length_godate" type="date" class="form-control form-control-sm input-rounded"
                                        name="car_service_length_godate">
                                </div>
                            </div>
                            <div class="col-md-2 mt-2">
                                <label for="car_service_length_backdate">ถึงวันที่ </label>
                            </div>
                            
                            <div class="col-md-4 mt-2">
                                <div class="form-group">
                                    <input id="car_service_length_backdate" type="date" class="form-control form-control-sm input-rounded"
                                        name="car_service_length_backdate">
                                </div>
                            </div>
                        
                    </div>

                        <div class="row">
                                {{-- <div class="col-md-2 mt-2">
                                    <label for="personjoin1">ผู้ร่วมเดินทางคนที่ 1 </label>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <div class="form-outline">
                                        <select name="personjoin1" id="personjoin1" class="form-control form-control-sm input-rounded" style="width: 100%;">
                                            <option value="">--เลือก--</option>
                                            @foreach ($users as $item1)
                                                <option value="{{ $item1->id}}">{{ $item1->fname}}  {{ $item1->lname}}</option>
                                            @endforeach
                                            </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-2 mt-2">
                                    <label for="car_service_length_gotime">ตั้งแต่เวลา </label>
                                </div> 
                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <input id="car_service_length_gotime" type="time" class="form-control form-control-sm input-rounded"
                                        name="car_service_length_gotime">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <label for="car_service_length_backtime">ถึงเวลา </label>
                                </div>                    
                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <input id="car_service_length_backtime" type="time" class="form-control form-control-sm input-rounded"
                                        name="car_service_length_backtime">
                                    </div>
                                </div>                   
                        </div>
                
                            {{-- <input type="hidden" id="car_service_no" name="car_service_no" value="{{$refnumber}}"> --}}
                            <input type="hidden" id="status" name="status" value="REQUEST">
                            <input type="hidden" id="userid" name="userid" value="{{ Auth::user()->id }}">
                            <input type="hidden" id="car_service_article_id" name="car_service_article_id" value="{{ $dataedits->article_id }}">


                    </div>
                    <div class="col-md-4">
                        <div class="row ">
                             
                            <div class="col-md-12 ">
                            <h3 class="mt-2 text-center">Digital Signature</h3>
                                <div id="signature-pad" >
                                    <div style="border:solid 1px teal; width:320px;height:120px;padding:3px;position:relative;">
                                        <div id="note" onmouseover="my_function();" class="text-center">The signature should be inside box</div>
                                        <canvas id="the_canvas" width="320px" height="100px" ></canvas>
                                    </div> 
                                        <input type="hidden" id="signature" name="signature">
                                        <input type="hidden" id="user_id" name="user_id" value=" {{ Auth::user()->id }}">
                                        <input type="hidden" name="store_id" id="store_id" value=" {{ Auth::user()->store_id }}">
                                        <input type="hidden" id="car_service_no" name="car_service_no" value="{{$refnumber}}">
                                        {{-- <input type="hidden" name="bookrep_id" id="bookrep_id" value=" {{ $dataedits->bookrep_id }}"> --}}

                                        <button type="button" id="clear_btn" class="btn btn-danger btn-sm mt-3 text-center" data-action="clear"><span class="glyphicon glyphicon-remove"></span> Clear</button>
                                        <button type="button" id="save_btn" class="btn btn-info btn-sm mt-3 text-center" data-action="save-png" onclick="create()"><span class="glyphicon glyphicon-ok"></span> Create</button>
                                        
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>



            </div>

          <div class="modal-footer">     
              <button class="btn btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-solid fa-person-circle-plus"></i>
              </button>      
              <button type="submit" id="saveBtn" class="btn btn-primary btn-sm" >
                <i class="fa-solid fa-floppy-disk me-2"></i>
                บันทึก
            </button>
              <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" id="closebtn">
                <i class="fa-solid fa-xmark me-2"></i>
                ปิด
            </button>
          </div>

           <!-- Collapsed content -->
           <div class="collapse mt-1 mb-2" id="collapseExample">             
                <div class="row mt-3">
                        <div class="col-md-1"> </div>
                        <div class="col-md-10"> 
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-sm myTable" style="width: 100%;" id="crud_table"> 
                                    <thead>
                                            <tr> 
                                                <th> ชื่อ-สกุล</th>  
                                                    <th width="10%"><button type="button" name="addRow" id="addRow" class="btn btn-success btn-sm"><i class="fa-solid fa-square-plus"></i></button></th>
                                                </tr>
                                        </thead>
                                        <tbody class="tbody">
                                            <tr> 
                                                <td >
                                                    <select name="person_join_id" id="person_join_id" class="form-control" multiple="multiple" style="width: 100%;">
                                                        <option >--เลือก--</option>
                                                        @foreach ($users as $item1)
                                                            <option value="{{ $item1->id}}" class="person_join_id">{{ $item1->fname}}  {{ $item1->lname}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                               
                                                <td width="10%" class="text-center"><a class="btn btn-danger btn-sm remove"><i class="fa-solid fa-trash-can"></i></a></td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-1"> </div>
                </div>
            </div>
       
      </div>
  </div>
</div>


@endsection
@section('footer') 

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('js/gcpdfviewer.js') }}"></script> 

<script> 
    var wrapper = document.getElementById("signature-pad");
    var clearButton = wrapper.querySelector("[data-action=clear]");
    var savePNGButton = wrapper.querySelector("[data-action=save-png]");
    var canvas = wrapper.querySelector("canvas");
    var el_note = document.getElementById("note");
    var signaturePad;
    signaturePad = new SignaturePad(canvas);
    clearButton.addEventListener("click", function (event) {
    document.getElementById("note").innerHTML="The signature should be inside box";
    signaturePad.clear();
    });
    savePNGButton.addEventListener("click", function (event){
    if (signaturePad.isEmpty()){
        alert("Please provide signature first.");
        event.preventDefault();
    }else{
        var canvas  = document.getElementById("the_canvas");
        var dataUrl = canvas.toDataURL();
        document.getElementById("signature").value = dataUrl;

        // ข้อความแจ้ง
            Swal.fire({
                title: 'สร้างสำเร็จ',
                text: "You create success",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#06D177',               
                confirmButtonText: 'เรียบร้อย'
            }).then((result) => {
                if (result.isConfirmed) {}
            })  
    }
    });
    function my_function(){
    document.getElementById("note").innerHTML="";
} 

</script>


<script>
     function addlocation() {
        var locationnew = document.getElementById("CAR_LOCATION_INSERT").value; 
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('user_car.addlocation')}}",
            method: "POST",
            data: {
                locationnew: locationnew,
                _token: _token
            },
            success: function (result) {
                $('.show_location').html(result);
            }
        })
      }
</script>

<script>
  $(document).ready(function() {
            // $('.js-example-basic-multiple').select2();
            $('#mySelect2').select2({
                dropdownParent: $('#carservicessModal')
            });

            $('select').select2();
            $('#car_service_year').select2({
                dropdownParent: $('#carservicessModal')
            });
            $('#car_service_location').select2({
                dropdownParent: $('#carservicessModal')
            });
            $('#person_join_id').select2({
                dropdownParent: $('#carservicessModal')
            });
            
            $('#songs').select2({
                dropdownParent: $('#carservicessModal')
            });
            $('#personjoin4').select2({
                dropdownParent: $('#carservicessModal')
            });
            $('#personjoin5').select2({
                dropdownParent: $('#carservicessModal')
            });
            $('#personjoin6').select2({
                dropdownParent: $('#carservicessModal')
            });
            $('#personjoin7').select2({
                dropdownParent: $('#carservicessModal')
            });
            $('#personjoin8').select2({
                dropdownParent: $('#carservicessModal')
            });
            $('#personjoin9').select2({
                dropdownParent: $('#carservicessModal')
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

           

      $(function() {
          var carservicess = @json($events);
            $('#calendar').fullCalendar({
                header: {
                        left: 'prev,next today', //  prevYear nextYea
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay',
                    },
                events: carservicess, 
                selectable: true,
                        selectHelper: true, 
                select: function(start, end, allDays) {
                            console.log(start)
                        $('#carservicessModal').modal('toggle');
                        $('#choosebook').modal('toggle');
                        $('#closebtn').click(function() {
                        $('#carservicessModal').modal('hide');
                        });
                         

                        $('#saveBtn').click(function() {                           
                             /*alert('gggggg');*/
                            // var person_join_id = [];
                            /*Initializing array with Checkbox checked values*/
                            // $("input[name='vehicle']:checked").each(function(){
                            //     vehicle.push(this.value);
                            // });
                            // var person_join_id = new Array(); 
                            // $('#person_join_id').each(function(){
                            //     person_join_id.push($(this).text());
                            // var songs = [];
                            // $('.songs').each(function(){
                            //     songs.push($(this).text());
                            // });
                            var person_join_id = $('#person_join_id').val();   // aray mutiselect2
                            // alert(songs);
                            
                            // var person_join_id = [];
                            // $('.person_join_id').each(function(){
                            //     person_join_id.push($(this).text());
                            // });
                            // alert(songs);
                            var userid = $('#user_id').val();
                            var carservice_book = $('#car_service_book').val();
                            var carservice_year = $('#car_service_year').val();
                            var carservice_location = $('#car_service_location').val();
                            var carservice_reason = $('#car_service_reason').val();
                            var carservice_length_godate = $('#car_service_length_godate').val(); 
                            var carservice_length_backdate = $('#car_service_length_backdate').val();
                            var carservice_length_gotime = $('#car_service_length_gotime').val();                            
                            var carservice_length_backtime = $('#car_service_length_backtime').val();
                            var carservice_article_id = $('#car_service_article_id').val();
                            var carservice_no = $('#car_service_no').val();
                            //  var start_date = moment(carservice_length_godate).format('YYYY-MM-DD');
                            // var end_date = moment(carservice_length_backdate).format('YYYY-MM-DD');
                            var signature = $('#signature').val(); 
                            // var user_id = $('#user_id').val();
                            // var carservice_no = $('#car_service_no').val();
                            // var start_date = moment(start).format('YYYY-MM-DD');
                            // var end_date = moment(end).format('YYYY-MM-DD');

                            $.ajax({
                                url: "{{ route('user_car.car_calenda_save') }}",
                                type: "POST",
                                dataType: 'json',
                                data: { 
                                    userid,
                                    carservice_book,
                                    carservice_year,
                                    carservice_location,
                                    carservice_reason,
                                    carservice_length_godate,
                                    carservice_no,
                                    signature,
                                    carservice_length_backdate,
                                    carservice_length_gotime,
                                    carservice_length_backtime,
                                    carservice_article_id,
                                    person_join_id
                                },
                                success: function(response) {
                                    if (response.status == 0) {

                                    } else {
                                        // alert('gggggg');
                                        Swal.fire({
                                            title: 'บันทึกข้อมูลสำเร็จ',
                                            text: "You Insert data success",
                                            icon: 'success',
                                            showCancelButton: false,
                                            confirmButtonColor: '#06D177', 
                                            confirmButtonText: 'เรียบร้อย'
                                        }).then((result) => {
                                            if (result
                                                .isConfirmed) {
                                                console.log(
                                                    response);
                                                $('#calendar')

                                                    .fullCalendar(
                                                        'renderEvent', {
                                                            'title': response
                                                                .title,
                                                            'start': response
                                                                .start,
                                                            'end': response
                                                                .end,
                                                            'color': response
                                                                .color
                                                        });
                                                window.location
                                                    .reload();
                                            }
                                        })
                                    }
                                    // $('#meettingModal').modal('hide')

                                },                                
                            });
                        });
                },
                selectAllow: function(event) {
                            return moment(event.start).utcOffset(false).isSame(moment(event.end)
                                .subtract(1, 'second').utcOffset(false), 'day');
                },        
            });           
      });


  });
</script>


@endsection
