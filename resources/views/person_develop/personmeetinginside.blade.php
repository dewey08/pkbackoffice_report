@extends('layouts.backend')
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@section('content')
<style>
        .center {
        margin: auto;
        width: 100%;
        padding: 10px;
        }
    body {
      font-family: 'Kanit', sans-serif;
      font-size: 13px;    
      }
      label{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
           
      }

      @media only screen and (min-width: 1200px) {
    label {
        float:right;
        }

      }

    .text-pedding{
        padding-left:10px;
        padding-right:10px;
        }

    .text-font {
    font-size: 13px;
        }
    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
            }

            table, th, td {
    border: 1px solid #A9A9A9;
}
</style>
<style>
       
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



        use App\Http\Controllers\PerdevController;
        $checkapp = PerdevController::checkapp($user_id);
        $checkver = PerdevController::checkver($user_id);

        $countapp = PerdevController::countapp($user_id);
        $countver = PerdevController::countver($user_id);


?>
<?php
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d');
?>


                <!-- Advanced Tables -->
                <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                    <div>
                                        <a href="{{ url('person_dev/persondevindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                            
                                            <span class="nav-main-link-name">Dashboard</span>
                                        </a>
                                        </div>
                                    <div>&nbsp;</div>

                                    <div>
                                        <a href="{{ url('person_dev/personmeetinginside/'.$inforpersonuserid -> ID)}}" class="btn btn-info loadscreen" >ประชุมภายใน</a>
                                        </div>
                                    <div>&nbsp;</div>

                                    <div>
                                    <a href="{{ url('person_dev/persondevinfo/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ประชุมอบรมภายนอก</a>
                                    <span class="badge badge-light" ></span>
                                </div>
                                    <div>&nbsp;</div>
                                    @if($checkver != 0)
                                    <div>
                                    <a href="{{ url('person_dev/persondevver/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                                    @if($countver!=0)
                                        <span class="badge badge-light" >{{$countver}}</span>
                                    @endif
                                    </a>
                                    </div>
                                    <div>&nbsp;</div>
                                    @endif

                                    @if($checkapp!=0)
                                    <div>
                                    <a href="{{ url('person_dev/persondevapp/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อนุมัติ
                                    @if($countapp!=0)
                                        <span class="badge badge-light" >{{$countapp}}</span>
                                    @endif
                                    </a>
                                    </div>
                                    <div>&nbsp;</div>
                                    @endif
                                    </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ระบบบันทึกการประชุม</B></h3>
                            <a href="{{ url('person_dev/personmeetinginside_add/'.$inforpersonuserid -> ID)}}"  class="btn btn-info" ><i class="fas fa-plus"></i> เพิ่มการประชุมภายใน</a>
                        </div>
                        <div class="block-content block-content-full">
                                       
            <form action="{{ route('perdev.personmeetinginside_search',['iduser'=>  $inforpersonuserid->ID]) }}" method="post">
                 @csrf

             <div class="row">
             <div class="col-sm-0.5">
                                        &nbsp;&nbsp; ปีงบ &nbsp;
                            </div>
                            <div class="col-sm-1.5">
                                <span>
                                    <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                        @foreach ($budgets as $budget)
                                            @if($budget->LEAVE_YEAR_ID== $year_id)
                                                <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                            @else
                                                <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                            @endif                                 
                                        @endforeach                         
                                    </select>
                                </span>
                            </div>
                            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
                    </div>
                    </div>

                </div>
               
                            <div class="col-sm-0.5">
                                &nbsp;คำค้นหา &nbsp;
                            </div>                            
                            <div class="col-sm-2">
                                <span>                            
                                    <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                                </span>
                            </div>     
                            <div class="col-sm-30">
                            &nbsp;
                        </div>                   
                            <div class="col-sm-1">
                                <span>
                                    <button type="submit" class="btn btn-info" >ค้นหา</button>
                                </span> 
                            </div>              
                        </div>  


                 
             </form>
             <div class="table-responsive">
                        
                            <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="5%">ลำดับ</th>      
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="6%">ปีงบ</th>                                 
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="5%">สถานะ</th>
                                    
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" >File</th>
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" >Attach File</th>
            
                                       
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" >หัวเรื่องการประชุม</th>                                 
                                       
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" >ห้องประชุม</th>    
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="10%">วันที่ประชุม</th>                                     
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="7%">เริ่มเวลา</th>
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="7%">ถึงเวลา</th>
                                       
                                        <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;"  width="5%">คำสั่ง</th>

                                    </tr >
                                </thead>
                                <tbody>
                                    <?php $number = 0; ?>
                                    @foreach ($meetinginsides as $item)
                                    <?php $number++;                                                                           
                                    ?>

                                    <tr height="20">
                                        <td align="center" width="5%">{{$number}}</td>
                                        <td  class="text-font text-pedding" width="5%">{{$item->MEETING_INSIDE_BUDGET}}</td>
                                        @if($item->MEETING_STATUS == 'APPLY')
                                        <td  style="vertical-align: text-top;" align="center"><span class="badge badge-success" >ปกติ</span></td>
                                     @else
                                     <td  style="vertical-align: text-top;" align="center"><a class="btn"  href="#detail_modal_cls{{ $item -> MEETING_INSIDE_ID }}"  data-toggle="modal"><span class="badge badge-danger" >ยกเลิก</span></a></td>
                                    @endif

                                      
                                        @if($item->MEETING_INSIDE_FILE == !null)
                                        <?php $bookpdf = storage_path('app/public/meettinginsidepdf/'.$item->MEETING_INSIDE_FILE) ; ?>
                                        @if(file_exists($bookpdf))
                                        <td  align="center" width="5%" style="vertical-align: text-top;">
                                            <a href="{{ asset('storage/meettinginsidepdf/'.$item->MEETING_INSIDE_FILE) }}" target="_blank">  <span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span> </a></td>
                                        @else
                                        <td align="center" width="5%" style="vertical-align: text-top;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                        @endif
                                        @else
                                        <td  align="center"width="5%" style="vertical-align: text-top;"></td>
                                        @endif

                                        @if($item->MEETING_INSIDE_LOCATION == !null)
                                        <td align="center" width="5%"  style="vertical-align: text-top;" ><span><a  class="btn"  target="_blank" style="background-color:#0000FF;color:#F0FFFF;" href="{{$item->MEETING_INSIDE_LOCATION}}"><i class="fa fa-1.5x fa-paperclip"></i></a></span></td>
                                        @elseif ($item->MEETING_INSIDE_LOCATION == null)
                                        <td align="center" width="5%"  style="vertical-align: text-top;" ><span><a  class="btn"  target="_blank" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-paperclip"></i></a></span></td>
                                        @endif


                                    

                                        <td class="text-font text-pedding" >{{$item->MEETING_INSIDE_TITLE}}</td>                                  
                                      
                                        <td class="text-font text-pedding" >{{$item->ROOM_NAME}}</td>
                                        <td class="text-font text-pedding" width="10%">{{DateThai($item->MEETING_INSIDE_DATE)}}</td>
                                        <td class="text-font text-pedding" width="7%">{{formatetime($item->MEETING_INSIDE_STARTTIME)}}</td>
                                        <td class="text-font text-pedding" width="7%">{{formatetime($item->MEETING_INSIDE_ENDTIME)}}</td>                                       

                                        <td align="center" width="5%">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">

                                                    @if($item->MEETING_STATUS == 'APPLY')
                                                    <a class="dropdown-item"  href="#detail_modal{{ $item -> MEETING_INSIDE_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>
                                                    <a class="dropdown-item"  href="{{url('person_dev/personmeetinginside_edit/'.$item->MEETING_INSIDE_ID.'/'.$id_user)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item"  href="{{url('person_dev/personmeetinginside_cancel/'.$item->MEETING_INSIDE_ID.'/'.$id_user)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แจ้งยกเลิก</a>
                                                    @else
                                                    <a class="dropdown-item"  href="#detail_modal_cls{{ $item -> MEETING_INSIDE_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>

                                                    @endif
                                                </div>
                                        </div>
                                        </td>
                                    </tr>

                                    <div id="detail_modal{{ $item -> MEETING_INSIDE_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                          <div class="modal-content">
                                          <div class="modal-header">
                                      
                                          <div class="row">
                                                <div>
                                                     <label>&nbsp;&nbsp;&nbsp;&nbsp; รายละเอียดคำขอเลขที่ &nbsp;&nbsp; {{ $item -> MEETING_INSIDE_CODE }} &nbsp;&nbsp;&nbsp;&nbsp; ครั้งที่ &nbsp;&nbsp; {{ $item -> MEETING_INSIDE_NO }}</label></div>
                                          <div>
                                        
                                          </div>
                                      
                                          </div>
                                              </div>
                                              <div class="modal-body">
                                      
                                      
                                              <div class="row">
                                      
                                             <div class="col-sm-2">
                                                 <div class="form-group">
                                                 <label >หัวข้อประชุม :</label>
                                                 </div>
                                             </div>
                                             <div class="col-sm-10">
                                                 <div class="form-group" >
                                                 <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $item -> MEETING_INSIDE_TITLE }}</h2>
                                                 </div>
                                             </div>                                      
                                                                            
                                             </div>
                                                                                                                    
                                             <div class="row">
                                             <div class="col-sm-2">
                                                 <div class="form-group">
                                                 <label>ประเภทการประชุม :</label>
                                                 </div>
                                             </div>
                                             <div class="col-sm-3 text-left">
                                                 <div class="form-group">
                                                 <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $item -> MEETTINGSIDE_NAME }}</h2>
                                                 </div>
                                             </div>
                                             <div class="col-sm-2">
                                                 <div class="form-group">
                                                 <label>วันที่ :</label>
                                                 </div>
                                             </div>
                                             <div class="col-sm-2">
                                                 <div class="form-group">
                                                 <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($item -> MEETING_INSIDE_DATE) }}</h2>
                                                 </div>
                                             </div>
                                             <div class="col-sm-1">
                                                <div class="form-group">
                                                <label>ตั้งแต่เวลา :</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ formatetime($item -> MEETING_INSIDE_STARTTIME) }} ถึง {{ formatetime($item -> MEETING_INSIDE_ENDTIME) }}</h2>
                                                </div>
                                            </div>                                            
                                            </div>
                                      
                                            <div class="row">
                                      
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label >ประธาน :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group" >
                                                    <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$item->HR_FNAME}}&nbsp;&nbsp; {{$item->HR_LNAME}}</h2>
                                                    </div>
                                                </div>
                                         
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label >ผู้บันทึก :</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 text-left">
                                                    <div class="form-group">
                                                    <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$item->MEETING_INSIDE_USERSAVE_NAME}}</h2>
                                                    </div>
                                                </div>                                         
                                                </div>


                                                <div class="row">
                                      
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label >ห้องประชุม :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                        <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$item->ROOM_NAME}}</h2>
                                                        </div>
                                                    </div>   
                                                </div>

                                                <div class="row">
                                      
                                                                          
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label >Link Googledrive :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                        <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $item -> MEETING_INSIDE_LOCATION }}</h2>
       
                                                        </div>
                                                    </div>                                      
                                                  
                                      
                                            </div>
                                              <div class="modal-footer">
                                              <div align="right">
                                              <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>
                                              </div>
                                              </div>
                                              </form>
                                      </body>
                                      
                                      
                                          </div>
                                        </div>
                                      </div>
                                    </div>


                                      
                                      <div id="detail_modal_cls{{ $item -> MEETING_INSIDE_ID }}" class="modal fade edit" tabindex="-1"
                                        role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                
                                                    <div class="row">
                                                        <div>
                                                            <label>&nbsp;&nbsp;&nbsp;&nbsp; รายละเอียดคำขอเลขที่ &nbsp;&nbsp;
                                                                {{ $item -> MEETING_INSIDE_CODE }} &nbsp;&nbsp;&nbsp;&nbsp; ครั้งที่
                                                                &nbsp;&nbsp; {{ $item -> MEETING_INSIDE_NO }}</label></div>
                                                        <div>
                
                                                        </div>
                
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                
                
                                                    <div class="row">
                
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>หัวข้อประชุม :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <h2
                                                                    style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                                    {{ $item -> MEETING_INSIDE_TITLE }}</h2>
                                                            </div>
                                                        </div>
                
                                                    </div>
                
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>ประเภทการประชุม :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 text-left">
                                                            <div class="form-group">
                                                                <h2
                                                                    style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                                    {{ $item -> MEETTINGSIDE_NAME }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>วันที่ :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <h2
                                                                    style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                                    {{ DateThai($item -> MEETING_INSIDE_DATE) }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group">
                                                                <label>ตั้งแต่เวลา :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <h2
                                                                    style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                                    {{ formatetime($item -> MEETING_INSIDE_STARTTIME) }} ถึง
                                                                    {{ formatetime($item -> MEETING_INSIDE_ENDTIME) }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    <div class="row">
                
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>ประธาน :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 text-left">
                                                            <div class="form-group">
                                                                <h2
                                                                    style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                                    {{$item->HR_FNAME}}&nbsp;&nbsp; {{$item->HR_LNAME}}</h2>
                                                            </div>
                                                        </div>
                
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>ผู้บันทึก :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 text-left">
                                                            <div class="form-group">
                                                                <h2
                                                                    style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                                    {{$item->MEETING_INSIDE_USERSAVE_NAME}}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                
                
                                                    <div class="row">
                
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>ห้องประชุม :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <h2
                                                                    style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                                    {{$item->ROOM_NAME}}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    <div class="row">
                
                
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>Link Googledrive :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <h2
                                                                    style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                                                                    {{ $item -> MEETING_INSIDE_LOCATION }}</h2>
                
                                                            </div>
                                                        </div>
                                                  

                                                       
                
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label style="color: red;">หมายเหตุการยกเลิก :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <h2
                                                                style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color: red;">
                                                                {{ $item -> MEETING_INSIDE_COMMENT }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div align="right">
                                                            <button type="button" class="btn btn-secondary btn-lg"
                                                                data-dismiss="modal">ปิดหน้าต่าง</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                    </body>
                
                
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    @endforeach
                                </tbody>
                            </table>

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


<script>

$('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });


   $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection
