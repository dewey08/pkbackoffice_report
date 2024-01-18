@extends('layouts.meet')

@section('css_before')

<link rel="stylesheet" href="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.css') }}">

<style>
    tr.detailservice{
        cursor:pointer;
    }
    tr.detailservice:hover{
        background:#AED6F1 !important;
    }
    .meetroom:hover{
        background:#AED6F1;
    }
    .tr-header{
        background: #dcdcdc !important;
    }
    .fc-content{
        cursor:pointer;
    }
    #calendar {
        max-width: 95%;
        margin: 0 auto;
        font-size: 15px;
    }

    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
    }
</style>

<script>
    function checklogin() {
        window.location.href = '{{route("index")}}';
    }
</script>
<?php

        if(Auth::check()){
            $status = Auth::user()->status;
            $id_user = Auth::user()->PERSON_ID;   
        }else{
            
            echo "<body onload=\"checklogin()\"></body>";
            exit();
        } 
        $url = Request::url();
        $pos = strrpos($url, '/') + 1;
        $user_id = substr($url, $pos); 
       
        $m_budget = date("m");
        if($m_budget>9){
        $yearbudget = date("Y")+544;
        }else{
        $yearbudget = date("Y")+543;
        }
        ?>
@endsection

@section('content')

<div class="bg-body-light">
 
</div>

<!-- Advanced Tables -->
<center>
    <div class="block row pt-2 shadow mb-4" style="width:95%;">
        <div class="col-lg-2 mb-2">
            <div class="card bg-info p-1 mx-0">
                <div class="card-header px-3 py-2 text-white">
                    ห้องประชุม
                </div>
                <div class="card-body bg-white text-left">
                        <a class="dropdown-item meetroom fs-18 fw-b" href="{{url('manager_meet/meetcalendar')}}">ทั้งหมด</a>
                        @foreach($roomservices as $row)
                        <a class="dropdown-item pl-3 meetroom" href="{{url('manager_meet/meetcalendar?meetroom=').$row->ROOM_ID.'&meetname='.$row->ROOM_NAME}}">{{$row->ROOM_NAME}}</a>
                        @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <div class="panel bg-sl-blue p-1">
                <div class="panel-header text-left px-3 py-2 text-white">
                    ปฎิทินข้อมูลการใช้บริการห้องประชุม<span class="fw-3 fs-18 text-white bg-sl-r2 px-2 radius-5">{{$meetroom['name']}}</span>
                </div>
                <div class="panel-body bg-white p-2">
                    <div id='calendar' style="width:100%; display: inline-block;"></div>
                </div>
                <div class="panel-footer text-right bg-white pr-5 py-2">
                        <p class="m-0 fa fa-circle" style="color:#A3DCA6;"></p> อนุมัติ
                        <p class="m-0 fa fa-circle" style="color:#ADD8E6;"></p> จัดสรร
                        <p class="m-0 fa fa-circle" style="color:#F1C54D;"></p> ร้องขอ
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-2">
            <div class="card p-1 bg-win8-cyan mb-2">
              <div class="card-header px-3 py-2">
                รายการประชุมวันนี้ ( วันที่ {{DateThai(date('Y-m-d'))}} )
              </div>
              <div class="card-body bg-white">
                <table class="table table-striped table-bordered mb-0">
                  <tr class="text-center" style="background:#dcdcdc;">
                    <th width="110px">ห้องประชุม</th>
                    <th>รายการ</th>
                    <th width="150px">วันที่ และเวลา</th>
                    <th width="80px">สถานะ</th>
                  </tr>
                  @foreach($service_day as $row)
                  <?php
                    if($row->STATUS == 'SUCCESS'){
                    $color = 'info'; 
                    $text = "จัดสรร";
                    }elseif ($row->STATUS == 'REQUEST') {
                        $color = 'warning';
                        $text = "ร้องขอ";
                    }elseif ($row->STATUS == 'LASTAPP') {
                        $color = 'success';
                        $text = "อนุมัติ";
                    }
                  ?>
                  <tr class="detailservice" onClick="popup_detail(this)" data-id="{{$row->ID}}">
                    <td>{{$row->ROOM_NAME}}</td>
                    <td>{{$row->SERVICE_STORY}}</td>
                    <td class="text-center p-1">{{DateThai(date('Y-m-d',strtotime($row->DATE_BEGIN)))}} <br>
                    {{date('H:i',strtotime($row->TIME_BEGIN))}}-{{date('H:i',strtotime($row->TIME_END))}} น.</td>
                    <td class="text-center"><span class="badge badge-{{$color}}">{{$text}}</span></td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
            <div class="card p-1 bg-win8-blue mb-2">
              <div class="card-header px-3 py-2">
              รายการประชุมวันพรุ่งนี้ ( วันที่ {{DateThai(date('Y-m-d',strtotime('1 Day')))}}  )
              </div>
              <div class="card-body bg-white">
                <table class="table table-striped table-bordered mb-0">
                  <tr class="text-center" style="background:#dcdcdc;">
                    <th width="110px">ห้องประชุม</th>
                    <th>รายการ</th>
                    <th width="150px">วันที่ และเวลา</th>
                    <th width="80px">สถานะ</th>
                  </tr>
                  @foreach($service_tomorrow as $row)
                  <?php
                    if($row->STATUS == 'SUCCESS'){
                    $color = 'info'; 
                    $text = "จัดสรร";
                    }elseif ($row->STATUS == 'REQUEST') {
                        $color = 'warning';
                        $text = "ร้องขอ";
                    }elseif ($row->STATUS == 'LASTAPP') {
                        $color = 'success';
                        $text = "อนุมัติ";
                    }
                  ?>
                  <tr class="detailservice" onClick="popup_detail(this)" data-id="{{$row->ID}}">
                    <td>{{$row->ROOM_NAME}}</td>
                    <td>{{$row->SERVICE_STORY}}</td>
                    <td class="text-center p-1">{{DateThai(date('Y-m-d',strtotime($row->DATE_BEGIN)))}} <br>
                    {{date('H:i',strtotime($row->TIME_BEGIN))}}-{{date('H:i',strtotime($row->TIME_END))}} น.</td>
                    <td class="text-center"><span class="badge badge-{{$color}}">{{$text}}</span></td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>       
                  @foreach($service_month as $row)
                  <?php
                    if($row->STATUS == 'SUCCESS'){
                    $color = 'info'; 
                    $text = "จัดสรร";
                    }elseif ($row->STATUS == 'REQUEST') {
                        $color = 'warning';
                        $text = "ร้องขอ";
                    }elseif ($row->STATUS == 'LASTAPP') {
                        $color = 'success';
                        $text = "อนุมัติ";
                    }
                  ?>
                  <tr class="detailservice" onClick="popup_detail(this)" data-id="{{$row->ID}}">
                    <td>{{$row->ROOM_NAME}}</td>
                    <td>{{$row->SERVICE_STORY}}</td>
                    <td class="text-center p-1">{{DateThai(date('Y-m-d',strtotime($row->DATE_BEGIN)))}} <br>
                    {{date('H:i',strtotime($row->TIME_BEGIN))}}-{{date('H:i',strtotime($row->TIME_END))}} น.</td>
                    <td class="text-center"><span class="badge badge-{{$color}}">{{$text}}</span></td>
                  </tr>
                  @endforeach
                </table>
                </div>
            </div> -->
        </div>
    </div>
    <div class="detail"></div>
    @endsection

    @section('footer')
    <script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lib/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lang/th.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today', //  prevYear nextYea
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                },
                buttonIcons: {
                    prev: 'left-single-arrow',
                    next: 'right-single-arrow',
                    prevYear: 'left-double-arrow',
                    nextYear: 'right-double-arrow'
                },

                viewRender: function (view, element) {
                    setTimeout(function () {
                        var strDate = $.trim($(".fc-center").find("h2").text());
                        var arrDate = strDate.split(" ");
                        var lengthArr = arrDate.length;
                        var newstrDate = "";
                        for (var i = 0; i < lengthArr; i++) {
                            if (lengthArr - 1 == i || parseInt(arrDate[i]) > 1000) {
                                var yearBuddha = parseInt(arrDate[i]) + 543;
                                newstrDate += yearBuddha;
                            } else {
                                newstrDate += arrDate[i] + " ";
                            }
                        }
                        $(".fc-center").find("h2").text(newstrDate);
                    }, 5);
                },
             
                <?php $count=0; ?>
                @foreach ($infoservices as $infoservice)

                <?php
                 if($infoservice->STATUS == 'SUCCESS'){
                  $color_code = '#ADD8E6';
                 }elseif($infoservice->STATUS == 'LASTAPP'){
                    $color_code = '#A3DCA6';
                }else{
                  $color_code = '#F1C54D';
                 }
                   $data[] = array(
                    'id'   => $infoservice->ID,
                    'title'   => $infoservice->SERVICE_STORY,
                    'room'   => $infoservice->ROOM_NAME,
                    'start'   => $infoservice->DATE_BEGIN.'T'.$infoservice->TIME_BEGIN,
                    'end'   => $infoservice->DATE_END.'T'.$infoservice->TIME_END,
                    'person'   => $infoservice->PERSON_REQUEST_NAME,
                    'color'=> $color_code
                   );
                   $count++; ?>
                @endforeach

                events: <?php
                if ($count == 0) {
                    echo '[]';
                } else {
                    echo json_encode($data);
                } ?> ,
                eventLimit : true,
                //        hiddenDays: [ 2, 4 ],
                lang: 'th',

                eventClick: function (calEvent, jsEvent, view) {

                    $.ajax({
                        url: "{{route('meeting.deatailcalendar')}}",
                        method: "GET",
                        data: {
                            id: calEvent.id
                        },
                        success: function (result) {
                            $('.detail').html(result);
                            $('#detail_meet').modal();
                          
                        }

                    })

                }
            });
        });

        function popup_detail(e) {
            $.ajax({
                        url: "{{route('meeting.deatailcalendar')}}",
                        method: "GET",
                        data: {
                            id: e.getAttribute('data-id')
                        },
                        success: function (result) {
                            $('.detail').html(result);
                            $('#detail_meet').modal();
                           
                        }

            });
        }
        
    </script>
    @endsection