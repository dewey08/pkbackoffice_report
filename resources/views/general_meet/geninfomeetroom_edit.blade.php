@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }

            label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
      }  
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }
</style>

<script>
    function checklogin(){
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

?>
<?php
  
  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

?>
           
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลขอใช้ห้องประชุม<label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h2> 
                        
        <form  method="post" action="{{ route('meeting.updateedit') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
        <div class="col-sm-2">
        <label>เรื่องการประชุม :</label>
        </div> 
        <div class="col-lg-5">
        <input name="SERVICE_STORY" id="SERVICE_STORY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforoomservice->SERVICE_STORY}}" onkeyup="check_service_story();" >
        <div style="color: red; font-size: 16px;" id="service_story"></div>
    </div> 
        <div class="col-sm-2">
        <label>ปีงบประมาณ :</label>
        </div> 
        <div class="col-lg-3">
        <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            @foreach ($budgetyears as $budgetyear) 
                @if($budgetyear ->LEAVE_YEAR_ID == $inforoomservice->YEAR_ID)
                    <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_NAME }}</option>
                @else
                    <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_NAME }}</option>
                @endif
            @endforeach 
        </select>
        </div> 
       
        </div>

        <div class="row push">
        <div class="col-sm-2">
        <label>กลุ่มบุคคลเป้าหมาย :</label>
        </div> 
        <div class="col-lg-5">
        <input name="GROUP_FOCUS" id="GROUP_FOCUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforoomservice->GROUP_FOCUS}}" onkeyup="check_group_focus();" >
        <div style="color: red; font-size: 16px;" id="group_focus"></div>
    </div> 
        <div class="col-sm-2">
        <label>จำนวน :</label>
        </div> 
        <div class="col-lg-2">
        <input name="TOTAL_PEOPLE" id="TOTAL_PEOPLE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforoomservice->TOTAL_PEOPLE}}" onkeyup="check_total_people();" OnKeyPress="return chkNumber(this)">
        <div style="color: red; font-size: 16px;" id="total_people"></div>    
    </div> 
        <div class="col-sm-1">
        <label>คน</label>
        </div> 
        </div>
        
       
       <!-- <div class="row push">
        <div class="col-sm-2">
        <label>เลขโครงการ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div>
        <button class="btn btn-hero-sm btn-hero-info" >&nbsp;อ้างถึง&nbsp;&nbsp;</button>
        
        </div>  
      
        <div class="col-lg-7">
         
        <input name="" id="" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" >
        </div>
        
       </div>-->

       <div class="row push">
       <div class="col-sm-2">
        <label>ต้องการใช้ห้อง :</label>
        </div> 
        <div class="col-lg-5">

        <select name="ROOM_ID" id="ROOM_ID" class="form-control input-lg location_re" style=" font-family: 'Kanit', sans-serif;" onchange="check_room_id();">
        <option value="" selected>--กรุณาเลือกห้องประชุม--</option>
                @foreach ($inforooms as $inforoom)
                    @if($inforoom -> ROOM_ID == $inforoomservice->ROOM_ID)
                    <option value="{{ $inforoom -> ROOM_ID }}" selected>{{ $inforoom -> ROOM_NAME }}</option> 
                    @else
                    <option value="{{ $inforoom -> ROOM_ID }}">{{ $inforoom -> ROOM_NAME }}</option> 
                    @endif
                @endforeach 
        </select>    
        <div style="color: red; font-size: 16px;" id="room_id"></div> 
    </div>
        <div class="col-sm-2">
        <label>วัตถุประสงค์การขอใช้ :</label>
        </div>
        <div class="col-lg-3"> 
        <select name="SERVICE_FOR" id="SERVICE_FOR" class="form-control input-lg location_re" style=" font-family: 'Kanit', sans-serif;" onchange="check_servicefor();">
        <option value="" selected>--กรุณาเลือกวัตถุประสงค์--</option>
                            @foreach ($infoobjectives as $infoobjective)
                               @if($infoobjective -> OBJECTIVE_ID == $inforoomservice->SERVICE_FOR)
                               <option value="{{ $infoobjective -> OBJECTIVE_ID }}" selected>{{ $infoobjective -> OBJECTIVE_NAME }}</option>   
                               @else
                                <option value="{{ $infoobjective -> OBJECTIVE_ID }}">{{ $infoobjective -> OBJECTIVE_NAME }}</option>   
                               @endif

                            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="servicefor"></div>   
        </div>
        </div>

       <div class="row push">
       <div class="col-sm-2">
        <label>ช่วงเวลา :</label>
        </div> 
        <div class="col-lg-5">
        <select name="TIME_SC_ID" id="TIME_SC_ID" class="form-control input-lg location_re" style=" font-family: 'Kanit', sans-serif;" onchange="check_time_scid();">
        <option value="" selected>--กำหนดช่วงเวลาเอง--</option>
                            @foreach ($infotimes as $infotime)
                                    @if($infotime -> TIME_SC_ID  == $inforoomservice->TIME_SC_ID)                      
                                    <option value="{{ $infotime -> TIME_SC_ID }}" selected>{{ $infotime -> TIME_SC_NAME }}</option>   
                                    @else
                                    <option value="{{ $infotime -> TIME_SC_ID }}">{{ $infotime -> TIME_SC_NAME }}</option>     
                                    @endif
                            @endforeach 
        </select> 
        <div style="color: red; font-size: 16px;" id="time_scid"></div>    
        </div> 
        <div class="col-sm-1">
        <label>เริ่มต้น :</label>
        </div> 
        <div class="col-lg-1">
        <input name="TIME_BEGIN" id="TIME_BEGIN" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;" value="{{$inforoomservice->TIME_BEGIN}}" onchange="check_time_begin();">
        <div style="color: red; font-size: 16px;" id="time_begin"></div>    
    </div>
        <div class="col-sm-1">
        <label>สิ้นสุด :</label>
        </div>
        <div class="col-lg-1">
        <input name="TIME_END" id="TIME_END" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;" value="{{$inforoomservice->TIME_END}}" onchange="check_time_end();">
        <div style="color: red; font-size: 16px;" id="time_end"></div> 
    </div>  
        
       </div>

    </div>
    <div class="row "> 
        <div class="col-sm-8">
        <div style="color: #DC143C; text-align: center;" class="checkdat"></div>
    </div> 
    <div class="col-lg-4">
    </div> 
    </div>

       <div class="row push">
       <div class="col-sm-2">
        <label>ตั้งแต่วันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="DATE_BEGIN" id="DATE_BEGIN" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($inforoomservice->DATE_BEGIN)}}" onchange="check_date_begin();callcheckdate();" readonly>
        <div style="color: red; font-size: 16px;" id="date_begin"></div> 
    </div> 
        <div class="col-sm-1">
        <label>ถึงวันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($inforoomservice->DATE_END)}}" onchange="check_date_end();callcheckdate();" readonly>
        <div style="color: red; font-size: 16px;" id="date_end"></div> 
    </div> 
        <div class="col-sm-2">
        <label>เบอร์ติดต่อ :</label>
        </div> 
        <div class="col-lg-3">
        <input name="PERSON_REQUEST_PHONE" id="PERSON_REQUEST_PHONE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforpersonuser -> HR_PHONE}}" onchange="check_person_phone();">
        <div style="color: red; font-size: 16px;" id="person_phone"></div> 
    </div> 
       </div>

              {{-- Laout Select Style Room --}}
              <div class="row push detail_styleroom">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for=""> รูปแบบห้องประชุม :</label>
                                    </div>
                                </div>
                                <div class="col-sm-5" style="margin-left:30px;">
                                    <input type="text" name="STYLEROOM_NAME" id="STYLEROOM_NAME" value="{{ $selectStyles->STYLEROOM_NAME }}" class="form-control input-lg" style="font-size: 13px; font-family: 'Kanit', sans-serif;" readonly>
                                </div>
                                <div class="col-sm" align="center">
                                    <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" >เลือกรูปแบบ</button>
                                </div>
                            </div>
                            <div class="row" style="margin-top:30px;">
                                <div class="col-sm-3">
                                    <label for=""> รายละเอียด :</label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea name="STYLEROOM_DETAIL" id="STYLEROOM_DETAIL" class="form-control" cols="100" rows="5" value="{{ $selectStyles->STYLEROOM_DETAIL }}">
                                        {{ $selectStyles->STYLEROOM_DETAIL }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5" align="left">
                            {{-- <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1200px-Picture_icon_BLACK.svg.png" width="180px" height="180px;"> --}}
                            <img id="image_upload_preview" name="image_upload_preview"
                            src="data:image/png;base64,{{ chunk_split(base64_encode($selectStyles->STYLEROOM_IMAGE)) }}"
                            height="180px;" width="180px;">
                        </div>
                    </div>
                </div>
           </div>
    
           @include('admin_meeting.style-room.modal-select-style-room')
           {{-- Modal Select Style Room --}}
           {{-- <div class="row">
            <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                  <div class="modal-header">
                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกรถที่ต้องการใช้</h2>
                      </div>
                      <div class="modal-body">
                      <body>
                         <div class="row">
                            @foreach ($style_rooms as $style_room)                                                     
                                <div class="col-md-3 col-xl-3">
                                    <a class="block block-rounded"  onclick="selectstyleroom({{$style_room->id}});">
                                        <div class="block-content" style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($style_room->STYLEROOM_IMAGE)) }});">
                                            <p>
                                            <span class="badge badge-info font-w2000 p-2 text-uppercase">
                                            {{$style_room->STYLEROOM_NAME}} 
                                            </span>
                                            </p>
                                        <div class="mb-3 mb-sm-3 d-sm-flex justify-content-sm-between align-items-sm-center">
                                                <img src="data:image/png;base64,{{ chunk_split(base64_encode($style_room->STYLEROOM_IMAGE)) }}"  width="100%"> 
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach 
                          </div>  
                    </body>
                    </div>
                      <div class="modal-footer">
                      <div align="right">
              
                      <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
                      </div>
                      </div>
                  </div>
                </div>
              </div>
           </div> --}}


       <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">รายการอาหาร</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">อุปกรณ์</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">งบประมาณ</a>
                                    </li>
                                  
                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">

                                    <table class="table gwt-table">
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">รายการอาหาร</td>
                                                <td style="text-align: center;">ช่วงเวลา</td>
                                                <td style="text-align: center;" width="20%">จำนวน</td>
                                                
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow1" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1">
                                        @if($countinfofoodlist == 0)

                                        <tr>
                                       <td> <select name="FOOD_ID[]" id="FOOD_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกรายการอาหาร--</option>
                                                            @foreach ($infofoods as $infofood)                                                     
                                                                <option value="{{ $infofood ->FOOD_ID  }}">{{ $infofood->FOOD_NAME}}</option>    
                                                            @endforeach 
                                         </select> </td>
                                         <td> <select name="FOOD_TIME_ID[]" id="FOOD_TIME_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกเวลา--</option>
                                                            @foreach ($infofoodtimes as $infofoodtime) 
                                                                <option value="{{ $infofoodtime ->FOOD_TIME_ID  }}">{{ $infofoodtime->FOOD_TIME_NAME}}</option>                         
                                                            @endforeach 
                                         </select> </td>    
                                        <td> <input name="FOOD_TOTAL[]" id="FOOD_TOTAL[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkNumber(this)"></td>
                                       
                                       
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove1" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>


                                        @else
                                        @foreach ($infofoodlists as $infofoodlist)    
                                    <tr>
                                       <td> <select name="FOOD_ID[]" id="FOOD_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกรายการอาหาร--</option>
                                                            @foreach ($infofoods as $infofood)
                                                                @if($infofood ->FOOD_ID == $infofoodlist->FOOD_ID)                                                     
                                                                <option value="{{ $infofood ->FOOD_ID  }}" selected>{{ $infofood->FOOD_NAME}}</option>
                                                                @else
                                                                <option value="{{ $infofood ->FOOD_ID  }}">{{ $infofood->FOOD_NAME}}</option>
                                                                @endif

                                                            @endforeach 
                                         </select> </td>
                                         <td> <select name="FOOD_TIME_ID[]" id="FOOD_TIME_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกเวลา--</option>
                                                            @foreach ($infofoodtimes as $infofoodtime) 
                                                                @if($infofoodtime ->FOOD_TIME_ID == $infofoodlist->FOOD_TIME_ID)                                                     
                                                                <option value="{{ $infofoodtime ->FOOD_TIME_ID  }}" selected>{{ $infofoodtime->FOOD_TIME_NAME}}</option>
                                                                @else
                                                                <option value="{{ $infofoodtime ->FOOD_TIME_ID  }}">{{ $infofoodtime->FOOD_TIME_NAME}}</option>
                                                                @endif
                                                            @endforeach 
                                         </select> </td>    
                                        <td> <input name="FOOD_TOTAL[]" id="FOOD_TOTAL[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infofoodlist->TOTAL}}" OnKeyPress="return chkNumber(this)"></td>
                        
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove1" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                        @endforeach 
                                        @endif
                                    </tbody>   
                                    </table>
                

                                    </div>
                                    <div class="tab-pane" id="object2" role="tabpanel">

                                    <table class="table gwt-table">
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">อุปกรณ์</td>
                                                <td style="text-align: center;" width="20%">จำนวน</td>
       
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody2"> 
                                       
                                        @if($countinfoequipment == 0)
                                        <tr>
                                       <td> <select name="ARTICLE_ID[]" id="ARTICLE_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกอุปกรณ์--</option>
                                                            @foreach ($infoarticles as $infoarticle) 
                                                              
                                                                <option value="{{ $infoarticle ->ARTICLE_ID  }}">{{ $infoarticle->ARTICLE_NAME}}</option>
                                                              
                                                            
                                                            @endforeach 
                                         </select> </td>  
                                        <td> <input name="ARTICLE_TOTAL[]" id="ARTICLE_TOTAL[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkNumber(this)"></td>
                                      
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>

                                        @else

                                        @foreach ($infoequipments as $infoequipment) 
                                    <tr>
                                       <td> <select name="ARTICLE_ID[]" id="ARTICLE_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกอุปกรณ์--</option>
                                                            @foreach ($infoarticles as $infoarticle) 
                                                                @if($infoarticle->ARTICLE_ID == $infoequipment->ARTICLE_ID)                                                    
                                                                <option value="{{ $infoarticle ->ARTICLE_ID  }}" selected>{{ $infoarticle->ARTICLE_NAME}}</option>
                                                                @else
                                                                <option value="{{ $infoarticle ->ARTICLE_ID  }}">{{ $infoarticle->ARTICLE_NAME}}</option>
                                                                @endif
                                                            
                                                            @endforeach 
                                         </select> </td>  
                                        <td> <input name="ARTICLE_TOTAL[]" id="ARTICLE_TOTAL[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoequipment->TOTAL}}" OnKeyPress="return chkNumber(this)"></td>
                                      
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach 
                                    @endif
                                    </tbody>   
                                    </table>
                                  
                                    </div>
                                    <div class="tab-pane" id="object3" role="tabpanel">

                                      <table class="table gwt-table">
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">รายการ</td>
                                                
                                                <td style="text-align: center;" width="15%" >จำนวนเงิน</td>
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow3" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody3">   
                                            @foreach ($mbbudgets as $mbbudget) 
                                                <tr>
                                                    <td> <input name="MB_NAME[]" id="MB_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$mbbudget->MB_NAME}}"></td>
                                                    <td> <input name="MB_PRICE[]" id="MB_PRICE[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$mbbudget->MB_PRICE}}"></td>
                                                    <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                                </tr>
                                            @endforeach 
                                    </tbody>   
                                    </table>
                                       
                                
                                    </div>
                                  
                                   
                                </div>
                            </div>
        </div>

       </div>
       <input type="hidden" name="ID_SERVICE" id="ID_SERVICE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforoomservice->ID}}">
       <input type="hidden" name="PERSON_REQUEST_ID" id="PERSON_REQUEST_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuserid->ID}}">
       <input type="hidden" name="PERSON_REQUEST_NAME" id="PERSON_REQUEST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}">
       <input type="hidden" name="PERSON_REQUEST_POSITION" id="PERSON_REQUEST_POSITION" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuserid->POSITION_IN_WORK}}">
       <input type="hidden"  name="PERSON_REQUEST_DEP" id="PERSON_REQUEST_DEP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}">
       <input type="hidden" name="DATE_TIME_REQUEST" id="DATE_TIME_REQUEST" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{date('Y-m-d H:i:s')}}">


        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกแก้ไขข้อมูล</button>
        <a href="{{ url('general_meet/genmeetroominfo/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
               
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>


function selectstyleroom(style_room_id){
      
      var _token=$('input[name="_token"]').val();
          $.ajax({
                  url:"{{route('general_meet.genmeet-room.select-style-room-edit')}}",
                  method:"GET",
                  data:{id:style_room_id,_token:_token},
                  success:function(result){
                  $('.detail_styleroom').html(result);
                  }
          })
      $('#modalwindow').modal('hide');
      
    }

    function check_service_story()
    { 
                    
        service_story = document.getElementById("SERVICE_STORY").value;             
            if (service_story==null || service_story==''){
            document.getElementById("service_story").style.display = "";     
            text_service_story = "*กรุณาระบุเรื่องการประชุม";
            document.getElementById("service_story").innerHTML = text_service_story;
            }else{
            document.getElementById("service_story").style.display = "none";
            }
    }
    function check_group_focus()
    {                         
        group_focus = document.getElementById("GROUP_FOCUS").value;             
            if (group_focus==null || group_focus==''){
            document.getElementById("group_focus").style.display = "";     
            text_group_focus = "*กรุณาระบุกลุ่มบุคคลเป้าหมาย";
            document.getElementById("group_focus").innerHTML = text_group_focus;
            }else{
            document.getElementById("group_focus").style.display = "none";
            }
    }
    function check_total_people()
    {                         
        total_people = document.getElementById("TOTAL_PEOPLE").value;             
            if (total_people==null || total_people==''){
            document.getElementById("total_people").style.display = "";     
            text_total_people = "*กรุณาระบุจำนวน";
            document.getElementById("total_people").innerHTML = text_total_people;
            }else{
            document.getElementById("total_people").style.display = "none";
            }
    }
    function check_room_id()
    {                         
        room_id = document.getElementById("ROOM_ID").value;             
            if (room_id==null || room_id==''){
            document.getElementById("room_id").style.display = "";     
            text_room_id = "*กรุณาเลือกห้องประชุม";
            document.getElementById("room_id").innerHTML = text_room_id;
            }else{
            document.getElementById("room_id").style.display = "none";
            }
    }
    function check_servicefor()
    {                         
        servicefor = document.getElementById("SERVICE_FOR").value;             
            if (servicefor==null || servicefor==''){
            document.getElementById("servicefor").style.display = "";     
            text_servicefor = "*กรุณาเลือกวัตถุประสงค์";
            document.getElementById("servicefor").innerHTML = text_servicefor;
            }else{
            document.getElementById("servicefor").style.display = "none";
            }
    }
    function check_time_scid()
    {                         
        time_scid = document.getElementById("TIME_SC_ID").value;             
            if (time_scid==null || time_scid==''){
            document.getElementById("time_scid").style.display = "";     
            text_time_scid = "*กรุณาเลือกวัตถุประสงค์";
            document.getElementById("time_scid").innerHTML = text_time_scid;
            }else{
            document.getElementById("time_scid").style.display = "none";
            }
    }
    function check_time_begin()
    {                         
        time_begin = document.getElementById("TIME_BEGIN").value;             
            if (time_begin==null || time_begin==''){
            document.getElementById("time_begin").style.display = "";     
            text_time_begin = "*กรุณาเลือกวัตถุประสงค์";
            document.getElementById("time_begin").innerHTML = text_time_begin;
            }else{
            document.getElementById("time_begin").style.display = "none";
            }
    }
    function check_time_end()
    {                         
        time_end = document.getElementById("TIME_END").value;             
            if (time_end==null || time_end==''){
            document.getElementById("time_end").style.display = "";     
            text_time_end = "*กรุณาเลือกวัตถุประสงค์";
            document.getElementById("time_end").innerHTML = text_time_end;
            }else{
            document.getElementById("time_end").style.display = "none";
            }
    }
    function check_date_begin()
    {                         
        date_begin = document.getElementById("DATE_BEGIN").value;             
            if (date_begin==null || date_begin==''){
            document.getElementById("date_begin").style.display = "";     
            text_date_begin = "*กรุณาเลือกวันที่";
            document.getElementById("date_begin").innerHTML = text_date_begin;
            }else{
            document.getElementById("date_begin").style.display = "none";
            }
    }
    function check_date_end()
    {                         
        date_end = document.getElementById("DATE_END").value;             
            if (date_end==null || date_end==''){
            document.getElementById("date_end").style.display = "";     
            text_date_end = "*กรุณาเลือกวันที่";
            document.getElementById("date_end").innerHTML = text_date_end;
            }else{
            document.getElementById("date_end").style.display = "none";
            }
    }
    function check_person_phone()
    {                         
        person_phone = document.getElementById("PERSON_REQUEST_PHONE").value;             
            if (person_phone==null || person_phone==''){
            document.getElementById("person_phone").style.display = "";     
            text_person_phone = "*กรุณาเลือกเบอร์ติดต่อ";
            document.getElementById("person_phone").innerHTML = text_person_phone;
            }else{
            document.getElementById("person_phone").style.display = "none";
            }
    }
</script>
<script>
$('form').submit(function () {
 
var service_story,text_service_story; 
var group_focus,text_group_focus;
var total_people,text_total_people;
 var room_id,text_room_id;
var servicefor,text_servicefor;
var time_scid,text_time_scid;
var time_begin,text_time_begin;
var time_end,text_time_end;

var date_begin,text_date_begin;
var date_end,text_date_end;
var person_phone,text_person_phone;

service_story = document.getElementById("SERVICE_STORY").value;
group_focus = document.getElementById("GROUP_FOCUS").value;
total_people = document.getElementById("TOTAL_PEOPLE").value;
room_id = document.getElementById("ROOM_ID").value;
servicefor = document.getElementById("SERVICE_FOR").value;
time_scid = document.getElementById("TIME_SC_ID").value;
time_begin = document.getElementById("TIME_BEGIN").value;
time_end = document.getElementById("TIME_END").value;

date_begin = document.getElementById("DATE_BEGIN").value;
date_end = document.getElementById("DATE_END").value;
person_phone = document.getElementById("PERSON_REQUEST_PHONE").value;

if (time_scid==null || time_scid==''){
    document.getElementById("time_scid").style.display = "";     
    text_time_scid= "*กรุณาเลือกห้องประชุม";
    document.getElementById("time_scid").innerHTML = text_time_scid;
    }else{
    document.getElementById("time_scid").style.display = "none";
    }

if (room_id==null || room_id==''){
    document.getElementById("room_id").style.display = "";     
    text_room_id= "*กรุณาเลือกห้องประชุม";
    document.getElementById("room_id").innerHTML = text_room_id;
    }else{
    document.getElementById("room_id").style.display = "none";
    } 

    if (servicefor==null || servicefor==''){
    document.getElementById("servicefor").style.display = "";     
    text_servicefor= "*กรุณาเลือกวัตถุประสงค์";
    document.getElementById("servicefor").innerHTML = text_servicefor;
    }else{
    document.getElementById("servicefor").style.display = "none";
    } 

if (total_people==null || total_people==''){
    document.getElementById("total_people").style.display = "";     
    text_total_people= "*กรุณาระบุจำนวน";
    document.getElementById("total_people").innerHTML = text_total_people;
    }else{
    document.getElementById("total_people").style.display = "none";
    } 

if (group_focus==null || group_focus==''){
    document.getElementById("group_focus").style.display = "";     
    text_group_focus= "*กรุณาระบุกลุ่มบุคคลเป้าหมาย";
    document.getElementById("group_focus").innerHTML = text_group_focus;
    }else{
    document.getElementById("group_focus").style.display = "none";
    }       

if (service_story==null || service_story==''){
    document.getElementById("service_story").style.display = "";     
    text_service_story= "*กรุณาระบุเรื่องการประชุม";
    document.getElementById("service_story").innerHTML = text_service_story;
    }else{
    document.getElementById("service_story").style.display = "none";
    }

    if (time_begin==null || time_begin==''){
    document.getElementById("time_begin").style.display = "";     
    text_time_begin= "*กรุณาระบุเวลาเริ้มต้น";
    document.getElementById("time_begin").innerHTML = text_time_begin;
    }else{
    document.getElementById("time_begin").style.display = "none";
    }
    if (time_end==null || time_end==''){
    document.getElementById("time_end").style.display = "";     
    text_time_end= "*กรุณาระบุเวลาสิ้นสุด";
    document.getElementById("time_end").innerHTML = text_time_end;
    }else{
    document.getElementById("time_end").style.display = "none";
    }

    if (date_begin==null || date_begin==''){
    document.getElementById("date_begin").style.display = "";     
    text_date_begin= "*กรุณาระบุวันที่";
    document.getElementById("date_begin").innerHTML = text_date_begin;
    }else{
    document.getElementById("date_begin").style.display = "none";
    }
    if (date_end==null || date_end==''){
    document.getElementById("date_end").style.display = "";     
    text_date_end= "*กรุณาระบุวันที่";
    document.getElementById("date_end").innerHTML = text_date_end;
    }else{
    document.getElementById("date_end").style.display = "none";
    }
    if (person_phone==null || person_phone==''){
    document.getElementById("person_phone").style.display = "";     
    text_person_phone= "*กรุณาระบุเบอร์ติดต่อ";
    document.getElementById("person_phone").innerHTML = text_person_phone;
    }else{
    document.getElementById("person_phone").style.display = "none";
    }

   
    if(service_story==null || service_story==''||
    group_focus==null || group_focus==''||
    total_people==null || total_people==''||
    room_id==null || room_id==''||
    servicefor==null || servicefor==''||
    time_scid==null || time_scid==''||
    time_begin==null || time_begin==''||
    time_end==null || time_end==''||
    date_begin==null || date_begin==''||
    date_end==null || date_end==''||
    person_phone==null || person_phone==''

    )
{
alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
return false;   
}


});
</script>

<script>
//==================================================================================

$('.addRow1').on('click',function(){
         addRow1();
     });

     function addRow1(){
         var tr ='<tr>'+
                 '<td> <select name="FOOD_ID[]" id="FOOD_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                 '<option value="">--กรุณาเลือกรายการอาหาร--</option>'+
                 '@foreach ($infofoods as $infofood)'+                                                     
                    '<option value="{{ $infofood ->FOOD_ID  }}">{{ $infofood->FOOD_NAME}}</option>'+
                '@endforeach'+ 
                '</select> </td>'+  
                '<td> <select name="FOOD_TIME_ID[]" id="FOOD_TIME_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+  
                '<option value="">--กรุณาเลือกเวลา--</option>'+  
                '@foreach ($infofoodtimes as $infofoodtime)'+                                                       
                '<option value="{{ $infofoodtime ->FOOD_TIME_ID  }}">{{ $infofoodtime->FOOD_TIME_NAME}}</option>'+  
                '@endforeach'+   
                '</select> </td>'+      
                '<td> <input name="FOOD_TOTAL[]" id="FOOD_TOTAL[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" OnKeyPress="return chkNumber(this)"></td>'+
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove1" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove1', function(){
            $(this).parent().parent().remove();
       
     });
//==================================================================================
     $('.addRow2').on('click',function(){
         addRow2();
     });

     function addRow2(){
         var tr ='<tr>'+
                 '<td> <select name="ARTICLE_ID[]" id="ARTICLE_ID[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                 '<option value="">--กรุณาเลือกอุปกรณ์--</option>'+
                '@foreach ($infoarticles as $infoarticle)'+                                                     
                '<option value="{{ $infoarticle ->ARTICLE_ID  }}">{{ $infoarticle->ARTICLE_NAME}}</option>'+
                '@endforeach'+ 
                '</select> </td>'+  
                '<td> <input name="ARTICLE_TOTAL[]" id="ARTICLE_TOTAL[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" OnKeyPress="return chkNumber(this)"></td>'+
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody2').append(tr);
     };

     $('.tbody2').on('click','.remove2', function(){
            $(this).parent().parent().remove();
       
     });

//==================================================================================
     $('.addRow3').on('click',function(){
         addRow3();
     });

     function addRow3(){
         var tr ='<tr>'+
                '<td> <input name="MB_NAME[]" id="MB_NAME[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;"></td>'+
                '<td> <input name="MB_PRICE[]" id="MB_PRICE[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;"></td>'+
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody3').append(tr);
     };

     $('.tbody3').on('click','.remove3', function(){
            $(this).parent().parent().remove();
       
     });



//===================================================================================
  

   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });





function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});



function callcheckdate(){
        var date_bigen=document.getElementById("DATE_BEGIN").value;     
        var date_end=document.getElementById("DATE_END").value;
      

        var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('meeting.callcheckdate')}}",
                     method:"GET",
                     data:{date_bigen:date_bigen,date_end:date_end,_token:_token},
                     success:function(result){
                        $('.checkdat').html(result);
                     }
             })
             }  
  
</script>



@endsection