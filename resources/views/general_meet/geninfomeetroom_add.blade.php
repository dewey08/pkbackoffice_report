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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">บันทึกขอใช้ห้องประชุม<label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h2> 
                        
        <form  method="post" action="{{ route('meeting.save') }}" enctype="multipart/form-data">
        @csrf

            <div style="color: red;" class="checkroom">
            
            <input type="hidden" id="checkroomre" name="checkroomre" value="0">
             </div>

        <div class="row push">
        <div class="col-sm-2">
        <label>เรื่องการประชุม :</label>
        </div> 
        <div class="col-lg-5">
        {{-- <input name="SERVICE_STORY" id="SERVICE_STORY" class="form-control input-lg {{ $errors->has('SERVICE_STORY') ? 'is-invalid' : '' }}" value="{{ old('SERVICE_STORY') }}" style=" font-family: 'Kanit', sans-serif;" > --}}
        <input name="SERVICE_STORY" id="SERVICE_STORY" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" required>
       
        </div> 
        <div class="col-sm-2">
        <label>ปีงบประมาณ :</label>
        </div> 
        <div class="col-lg-3">
        <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            @foreach ($budgetyears as $budgetyear) 
                @if($budgetyear ->LEAVE_YEAR_ID == $yearbudget)
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
        <input name="GROUP_FOCUS" id="GROUP_FOCUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
        
        </div> 
        <div class="col-sm-2">
        <label>จำนวน :</label>
        </div> 
        <div class="col-lg-2">
        {{-- <input name="TOTAL_PEOPLE" id="TOTAL_PEOPLE" class="form-control input-lg {{ $errors->has('TOTAL_PEOPLE') ? 'is-invalid' : '' }}" value="{{ old('TOTAL_PEOPLE') }}" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkNumber(this)"> --}}
        <input name="TOTAL_PEOPLE" id="TOTAL_PEOPLE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkNumber(this)" required>
    
        </div> 
        <div class="col-sm-1">
        <label>คน</label>
        </div> 
        </div>
        
       
   

       <div class="row push">
       <div class="col-sm-2">
        <label>ต้องการใช้ห้อง :</label>
        </div> 
        <div class="col-lg-5">
            {{-- <select name="ROOM_ID" id="ROOM_ID" class="form-control input-lg location_re {{ $errors->has('ROOM_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;"> --}}
        <select name="ROOM_ID" id="ROOM_ID" class="form-control input-lg location_re" style=" font-family: 'Kanit', sans-serif;" onchange="checkroom()" required>
        <option value="" >--กรุณาเลือกห้องประชุม--</option>
                            @foreach ($inforooms as $inforoom)
                                @if($idroom == $inforoom -> ROOM_ID )                    
                                    <option value="{{ $inforoom -> ROOM_ID }}" selected>{{ $inforoom -> ROOM_NAME }}</option>   
                                @else
                                <option value="{{ $inforoom -> ROOM_ID }}">{{ $inforoom -> ROOM_NAME }}</option>   
                                @endif
                            @endforeach 
        </select>    
        
    </div>
        <div class="col-sm-2">
        <label>วัตถุประสงค์การขอใช้ :</label>
        </div>
        <div class="col-lg-3"> 
        {{-- <select name="SERVICE_FOR" id="SERVICE_FOR" class="form-control input-lg {{ $errors->has('SERVICE_FOR') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;"> --}}
            <select name="SERVICE_FOR" id="SERVICE_FOR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
        <option value="" selected>--กรุณาเลือกวัตถุประสงค์--</option>
                            @foreach ($infoobjectives as $infoobjective)
                               
                                <option value="{{ $infoobjective -> OBJECTIVE_ID }}">{{ $infoobjective -> OBJECTIVE_NAME }}</option>   
                               
                            @endforeach 
        </select> 
       
        </div>
        </div>

       <div class="row push">
       <div class="col-sm-2">
        <label>ช่วงเวลา :</label>
        </div> 
        <div class="col-lg-5">
        {{-- <select name="TIME_SC_ID" id="TIME_SC_ID" class="form-control input-lg {{ $errors->has('TIME_SC_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" > --}}
            <select name="TIME_SC_ID" id="TIME_SC_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"  onchange="checkroom()" required>
        <option value="" selected>--กรุณาเลือกช่วงเวลา--</option>
                            @foreach ($infotimes as $infotime)
                                                   
                                    <option value="{{ $infotime -> TIME_SC_ID }}">{{ $infotime -> TIME_SC_NAME }}</option>   
                           
                            @endforeach 
        </select>   
        
        </div> 
        <div class="col-sm-1">
        <label>เริ่มต้น :</label>
        </div> 
        <div class="col-lg-1">
        {{-- <input name="TIME_BEGIN" id="TIME_BEGIN" class="js-masked-time form-control {{ $errors->has('TIME_BEGIN') ? 'is-invalid' : '' }}" value="{{ old('TIME_BEGIN') }}" style=" font-family: 'Kanit', sans-serif;"  > --}}
        <input name="TIME_BEGIN" id="TIME_BEGIN" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;"  required>
      
        </div>
        <div class="col-sm-1">
        <label>สิ้นสุด :</label>
        </div>
        <div class="col-lg-1">
        {{-- <input name="TIME_END" id="TIME_END" class="js-masked-time form-control {{ $errors->has('TIME_END') ? 'is-invalid' : '' }}" value="{{ old('TIME_END') }}" style=" font-family: 'Kanit', sans-serif;"   > --}}
        <input name="TIME_END" id="TIME_END" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;"  required >
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
        <input name="DATE_BEGIN" id="DATE_BEGIN" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}"  onchange="checkroom();callcheckdate();" readonly>
    
        </div> 
        <div class="col-sm-1">
        <label>ถึงวันที่ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}" onchange="callcheckdate();" readonly>
        </div> 

        <div class="col-sm-2">
        <label>เบอร์ติดต่อ :</label>
        </div> 
        <div class="col-lg-3">
        <input name="PERSON_REQUEST_PHONE" id="PERSON_REQUEST_PHONE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforpersonuser -> HR_PHONE}}">
    
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
                                <input type="text" name="" id="" class="form-control input-lg" style="font-size: 13px; font-family: 'Kanit', sans-serif;" readonly>
                            </div>
                            <div class="col-sm" align="center">
                                <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" >เลือกรูปแบบ</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top:30px;">
                            <div class="col-sm-3">
                                <label for=""> รายละเอียด :</label>
                            </div>
                            <div class="col-sm-8" style="margin-left:30px;">
                                <textarea name="STYLEROOM_DETAIL" id="STYLEROOM_DETAIL" class="form-control" cols="100" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5" align="left">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1200px-Picture_icon_BLACK.svg.png" width="180px" height="180px;">
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
                                                <td style="text-align: center;border-color: #000000;">รายการอาหาร</td>
                                                <td style="text-align: center;border-color: #000000;">ช่วงเวลา</td>
                                                <td style="text-align: center;border-color: #000000;" width="20%">จำนวน</td>
                                                
                                               
                                                <td style="text-align: center;border-color: #000000;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow1" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1">   
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
                                    </tbody>   
                                    </table>
                

                                    </div>
                                    <div class="tab-pane" id="object2" role="tabpanel">

                                    <table class="table gwt-table">
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border-color: #000000;">อุปกรณ์</td>
                                                <td style="text-align: center;border-color: #000000;" width="20%">จำนวน</td>
       
                                               
                                                <td style="text-align: center;border-color: #000000;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody2">  
                                        @foreach ($infoequipments as $infoequipment) 
                                    <tr>
                                       <td> <select name="ARTICLE_ID[]" id="ARTICLE_ID[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกอุปกรณ์--</option>
                                                            @foreach ($infoarticles as $infoarticle) 
                                                                @if($infoarticle->ARTICLE_ID == $infoequipment->ROOM_ARTICLE_ID)                                                    
                                                                <option value="{{ $infoarticle ->ARTICLE_ID  }}" selected>{{ $infoarticle->ARTICLE_NAME}}</option>
                                                                @else
                                                                <option value="{{ $infoarticle ->ARTICLE_ID  }}">{{ $infoarticle->ARTICLE_NAME}}</option>
                                                                @endif
                                                            
                                                            @endforeach 
                                         </select> </td>  
                                        <td> <input name="ARTICLE_TOTAL[]" id="ARTICLE_TOTAL[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoequipment->AMOUNT}}" OnKeyPress="return chkNumber(this)"></td>
                                      
                                      
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach 
                                    </tbody>   
                                    </table>
                                  
                                    </div>
                                    <div class="tab-pane" id="object3" role="tabpanel">

                                      <table class="table gwt-table">
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border-color: #000000;">รายการ</td>
                                                
                                                <td style="text-align: center;border-color: #000000;" width="15%" >จำนวนเงิน</td>
                                               
                                                <td style="text-align: center;border-color: #000000;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow3" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody3">   
                                    <tr>
                                        <td> <input name="MB_NAME[]" id="MB_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"></td>
                                        <td> <input name="MB_PRICE[]" id="MB_PRICE[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"></td>

                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    </tbody>   
                                    </table>
                                       
                                
                                    </div>
                                  
                                   
                                </div>
                            </div>
        </div>

       </div>

       <input type="hidden" name="PERSON_REQUEST_ID" id="PERSON_REQUEST_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuserid->ID}}">
       <input type="hidden" name="PERSON_REQUEST_NAME" id="PERSON_REQUEST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}">
       <input type="hidden" name="PERSON_REQUEST_POSITION" id="PERSON_REQUEST_POSITION" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuserid->POSITION_IN_WORK}}">
       <input type="hidden"  name="PERSON_REQUEST_DEP" id="PERSON_REQUEST_DEP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}">
       <input type="hidden" name="DATE_TIME_REQUEST" id="DATE_TIME_REQUEST" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{date('Y-m-d H:i:s')}}">
      

       

        <div class="modal-footer">
        <div align="right">
            <button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
            {{-- <span type="button" class="btn btn-hero-sm btn-hero-info btn-submit-add" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</span> --}}
        <a href="{{ url('general_meet/genmeetroom/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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
//==================================================================================


function selectstyleroom(style_room_id){
      
    var _token=$('input[name="_token"]').val();
        $.ajax({
                url:"{{route('general_meet.genmeet-room.select-style-room-add')}}",
                method:"GET",
                data:{id:style_room_id,_token:_token},
                success:function(result){
                $('.detail_styleroom').html(result);
                }
        })
    $('#modalwindow').modal('hide');
    
  }

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

<script>

function checkroom(){
   

        var ROOM_ID=document.getElementById("ROOM_ID").value;
        var TIME_SC_ID=document.getElementById("TIME_SC_ID").value;
        var DATE_BEGIN=document.getElementById("DATE_BEGIN").value;
      

        var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('meeting.checkroom')}}",
                     method:"GET",
                     data:{ROOM_ID:ROOM_ID,TIME_SC_ID:TIME_SC_ID,DATE_BEGIN:DATE_BEGIN,_token:_token},
                     success:function(result){  
                                        
                        $('.checkroom').html(result);  
                    
                     }
             })
           
                 
             }  



$('form').submit(function () {

   
     
     var SERVICE_STORY, GROUP_FOCUS;
     var TOTAL_PEOPLE,TOTAL_PEOPLE;
     var ROOM_ID,SERVICE_FOR,TIME_SC_ID;
     var TIME_BEGIN,TIME_END;
     var DATE_BEGIN,DATE_END;
     var PERSON_REQUEST_PHONE;

     var checkroomre = document.getElementById("checkroomre").value;

     

    //  SERVICE_STORY = document.getElementById("SERVICE_STORY").value;
    //  GROUP_FOCUS = document.getElementById("GROUP_FOCUS").value;
    //  TOTAL_PEOPLE = document.getElementById("TOTAL_PEOPLE").value;
    //  ROOM_ID = document.getElementById("ROOM_ID").value;
    //  SERVICE_FOR = document.getElementById("SERVICE_FOR").value;
    //  TIME_SC_ID = document.getElementById("TIME_SC_ID").value;
    //  TIME_BEGIN = document.getElementById("TIME_BEGIN").value;
    //  TIME_END = document.getElementById("TIME_END").value;
    //  DATE_BEGIN = document.getElementById("DATE_BEGIN").value;
    //  DATE_END = document.getElementById("DATE_END").value;
    //  PERSON_REQUEST_PHONE = document.getElementById("PERSON_REQUEST_PHONE").value;

     

    //  if (SERVICE_STORY==null || SERVICE_STORY==''){
    //  document.getElementById("SERVICESTORY").style.display = "";     
    //  text_name = "*กรุณาระบุข้อมูลเรื่อง";
    //  document.getElementById("SERVICESTORY").innerHTML = text_name;
    //  }else{
    //  document.getElementById("SERVICESTORY").style.display = "none";
    //  }

     
    //  if (GROUP_FOCUS==null || GROUP_FOCUS==''){
    //  document.getElementById("GROUPFOCUS").style.display = "";     
    //  text_lastname = "*กรุณาระบุข้อมูลกลุ่มบุคคลเป้าหมาย ";
    //  document.getElementById("GROUPFOCUS").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("GROUPFOCUS").style.display = "none";
    //  }

     
    //  if (TOTAL_PEOPLE==null || TOTAL_PEOPLE==''){
    //  document.getElementById("TOTALPEOPLE").style.display = "";     
    //  text_lastname = "*กรุณาระบุข้อมูลจำนวน";
    //  document.getElementById("TOTALPEOPLE").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("TOTALPEOPLE").style.display = "none";
    //  }



    //  if (ROOM_ID==null || ROOM_ID==''){
    //  document.getElementById("ROOMID").style.display = "";     
    //  text_lastname = "*กรุณาระบุข้อมูลห้อง";
    //  document.getElementById("ROOMID").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("ROOMID").style.display = "none";
    //  }



    //  if (SERVICE_FOR==null || SERVICE_FOR==''){
    //  document.getElementById("SERVICEFOR").style.display = "";     
    //  text_lastname = "*กรุณาระบุข้อมูล";
    //  document.getElementById("SERVICEFOR").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("SERVICEFOR").style.display = "none";
    //  }



    //  if (TIME_SC_ID==null || TIME_SC_ID==''){
    //  document.getElementById("TIMESCID").style.display = "";     
    //  text_lastname = "*กรุณาระบุข้อมูลช่วงเวลา ";
    //  document.getElementById("TIMESCID").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("TIMESCID").style.display = "none";
    //  }



    //  if (TIME_BEGIN==null || TIME_BEGIN==''){
    //  document.getElementById("TIMEBEGIN").style.display = "";     
    //  text_lastname = "*ระบุเวลา ";
    //  document.getElementById("TIMEBEGIN").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("TIMEBEGIN").style.display = "none";
    //  }



    //  if (TIME_END==null || TIME_END==''){
    //  document.getElementById("TIMEEND").style.display = "";     
    //  text_lastname = "*ระบุเวลา ";
    //  document.getElementById("TIMEEND").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("TIMEEND").style.display = "none";
    //  }



    //  if (DATE_BEGIN==null || DATE_BEGIN==''){
    //  document.getElementById("DATEBEGIN").style.display = "";     
    //  text_lastname = "*กรุณาระบุข้อมูลวัน";
    //  document.getElementById("DATEBEGIN").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("DATEBEGIN").style.display = "none";
    //  }



    //  if (DATE_END==null || DATE_END==''){
    //  document.getElementById("DATEEND").style.display = "";     
    //  text_lastname = "*กรุณาระบุข้อมูลวัน ";
    //  document.getElementById("DATEEND").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("DATEEND").style.display = "none";
    //  }



    //  if (PERSON_REQUEST_PHONE==null || PERSON_REQUEST_PHONE==''){
    //  document.getElementById("PERSONREQUESTPHONE").style.display = "";     
    //  text_lastname = "*กรุณาระบุข้อมูลเบอร์ ";
    //  document.getElementById("PERSONREQUESTPHONE").innerHTML = text_lastname;
    //  }else{
    //  document.getElementById("PERSONREQUESTPHONE").style.display = "none";
    //  }


     

 
     
//กำหนดการแจ้งเตือนใน submin
// if(SERVICE_STORY==null || SERVICE_STORY=='' ||
// GROUP_FOCUS==null || GROUP_FOCUS=='' ||
// TOTAL_PEOPLE ==null || TOTAL_PEOPLE=='' ||
// ROOM_ID ==null || ROOM_ID=='' ||
// SERVICE_FOR ==null || SERVICE_FOR=='' ||
// TIME_SC_ID ==null || TIME_SC_ID=='' ||
// TIME_BEGIN ==null ||  TIME_BEGIN=='' ||
// TIME_END ==null || TIME_END=='' ||
// DATE_BEGIN ==null || DATE_BEGIN=='' ||
// DATE_END ==null || DATE_END=='' || 
// PERSON_REQUEST_PHONE ==null || PERSON_REQUEST_PHONE=='' ||
// checkroomre == 1
// )

if(checkroomre == 1)
{
 alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
 return false;   
}
});

$('.btn-submit-add').click(function (e) { 
    var form = $('#form_add');
    formSubmit(form)           
 });


</script>






@endsection