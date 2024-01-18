@extends('layouts.guesthouse')   
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
        font-size: 14px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 14px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
    padding-left:10px;
                        }

            .text-font {
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

    use Illuminate\Support\Facades\DB;
?>
        
<center>    
    <div class="block mt-5 shadow-lg" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>จัดสรรแฟลต</B></h3>
                <a href="{{ url('manager_guesthouse/guesthouserequestdetail_flat_edit/'.$infoguesthouse->INFMATION_ID)}}"   class="btn btn-hero-sm btn-hero-warning foo15 loadscreen" ><i class="fas fa-edit mr-2"></i>แก้ไข</a>
                &nbsp;&nbsp;
          
                <a href="{{ url('manager_guesthouse/guesthouserequestdetail')  }}"   class="btn btn-hero-sm btn-hero-success foo15 loadscreen" ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
            
            </div>
            <div class="block-content block-content-full">
         
                                    

                    <div class="row push">
                    <div class="col-lg-4">

                    <div class="form-group">                         
                    @if($infoguesthouse->IMG == '' || $infoguesthouse->IMG ==null)
                        <img src="{{ asset('image/default.jpg')}}" alt="Image" class="img-thumbnail shadow-lg" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="240px" width="400px"/>
                    @else
                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($infoguesthouse->IMG)) }}" id="image_upload_preview" class="img-thumbnail shadow-lg"  height="240px" width="400px"/>
                    @endif
                    </div>
                                
                    </div>



                    <div class="col-sm-8">
                    <div class="row push">

                    <div class="col-sm-2">
                    <label>อ้างถึงอาคาร :</label>
                    </div> 
                    <div class="col-lg-9 text-left">              
                        {{$infoguesthouse->LOCATION_NAME}}
                    </div> 

                    </div>
                    <div class="row push">
                    <div class="col-sm-2">
                    <label>ชื่ออาคาร :</label>
                    </div> 
                    <div class="col-lg-10 text-left">
                    {{$infoguesthouse->INFMATION_NAME}}
                    </div> 

                    </div>
                    <div class="row push">
                    <div class="col-sm-2">
                    <label>ประเภทที่พัก :</label>
                    </div> 
                    <div class="col-lg-4 text-left">

                    @if($infoguesthouse->INFMATION_TYPE == '1')
                            แฟลต
                    @else
                            บ้านพัก
                    @endif

                    </div> 

                    <div class="col-sm-2">
                    <label>สถานะ :</label>
                    </div> 
                    <div class="col-lg-4 text-left">
                 
                    @if($infoguesthouse->INFMATION_STATUS == '1')
                            ปกติ
                    @elseif($infoguesthouse->INFMATION_STATUS == '2')
                            ปิดปรับปรุง
                    @elseif($infoguesthouse->INFMATION_STATUS == '3')
                            ซ่อมแซม
                    @else
                            ปิด
                    @endif
               
                    </div>  

                    </div>



            <div class="row push">


                    <div class="col-sm-2">
                    <label>ผู้รับผิดชอบ :</label>
                    </div> 
                    <div class="col-lg-4 text-left">
                    {{$infoguesthouse->HR_FNAME}} {{$infoguesthouse->HR_LNAME}}
                    </div>

                    <div class="col-sm-2">
                    <label>ติดต่อ :</label>
                    </div> 
                    <div class="col-lg-4 text-left">
                    {{$infoguesthouse->INFMATION_HR_TEL}}
               
                    </div>




           </div>
                

        </div>


        <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="20">                          
                            <th  class="text-font" style="text-align: center;" width="10%">ห้อง</th>
                            <th  class="text-font" style="text-align: center;" width="7%">สถานะ</th>
                            <th  class="text-font" style="text-align: center;" width="15%">ผู้พัก</th>
                            <th  class="text-font" style="text-align: center;" width="15%">บุคคลอื่น</th>
                            <th  class="text-font" style="text-align: center;" >ครุภัณฑ์</th>
                            <th  class="text-font" style="text-align: center;" width="5%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>  


                    

                    @foreach($infoguesthouse_levels as $infoguesthouse_level)
                            <tr height="20">
                                <td class="text-font text-pedding" colspan="6" style="background-color: #FFF8DC;" >{{$infoguesthouse_level->LOCATION_LEVEL_NAME}}</td>
                            </tr>
                                <?php 
                                    $infoguesthouse_rooms = DB::table('supplies_location_level_room')->where('LOCATION_LEVEL_ID','=',$infoguesthouse_level->LOCATION_LEVEL_ID)->get();
                                ?>
                                <?php $number= 0; ?>
                                    @foreach($infoguesthouse_rooms as $infoguesthouse_room)
                                        <?php $number++; 
                                        $checkroom = DB::table('guesthous_infomation_person')->where('LEVEL_ROOM_ID','=',$infoguesthouse_room->LEVEL_ROOM_ID)->where('INFMATION_PERSON_STATUS','=','1')->count();
                                       
                                        $checkroompersons = DB::table('guesthous_infomation_person')
                                        ->leftjoin('hrd_person','hrd_person.ID','=','guesthous_infomation_person.INFMATION_PERSON_HRID')
                                        ->where('LEVEL_ROOM_ID','=',$infoguesthouse_room->LEVEL_ROOM_ID)->where('INFMATION_PERSON_STATUS','=','1')->get();

                                        $checkroompersonsouts = DB::table('guesthous_infomation_outsider')
                                        // ->leftjoin('guesthous_infomation_person','guesthous_infomation_person.LEVEL_ROOM_ID','=','guesthous_infomation_outsider.LEVEL_ROOM_ID')
                                        ->where('guesthous_infomation_outsider.LEVEL_ROOM_ID','=',$infoguesthouse_room->LEVEL_ROOM_ID)
                                        ->where('guesthous_infomation_outsider.STATUS','=','true')
                                        ->get();

                                        $checkroomassets = DB::table('guesthous_infomation_asset')
                                        // ->leftjoin('guesthous_infomation_person','guesthous_infomation_person.LEVEL_ROOM_ID','=','guesthous_infomation_asset.LEVEL_ROOM_ID')
                                        ->where('guesthous_infomation_asset.LEVEL_ROOM_ID','=',$infoguesthouse_room->LEVEL_ROOM_ID)
                                        ->get();

                                        ?>
                                    <tr height="20">
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="10%">{{$infoguesthouse_room->LEVEL_ROOM_NAME}}</td>                                  
                                                                                
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                @if($checkroom !== 0)
                                            <span class="badge badge-danger">ไม่ว่าง</span>  
                                                @else
                                                <span class="badge badge-success">ว่าง</span>      
                                                @endif
                                        </td>                                    
                                                                                
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                            @foreach($checkroompersons as $checkroomperson)
                                            @if ($checkroomperson->INFMATION_PERSON_STATUS == '2')
                                                
                                            @else
                                                {{$checkroomperson->HR_FNAME}} {{$checkroomperson->HR_LNAME}} <br>
                                            @endif
                                                
                                            @endforeach
                                        </td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                            @foreach($checkroompersonsouts as $checkroompersonsout)
                                        
                                                {{$checkroompersonsout->INFMATION_OUTSIDER_NAME}} <br>

                                            @endforeach
                                        </td>


                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                            @foreach($checkroomassets as $checkroomasset)

                                            {{$checkroomasset->INFMATION_ASSET_NAME}}   <br>     
                                           
                                            @endforeach
                                        </td>
                                       
                                        <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="5%">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                        ทำรายการ
                                                    </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                 
                                                        <a class="dropdown-item loadscreen"  href="{{ url('manager_guesthouse/guesthouserequestdetail_flat_room/'.$infoguesthouse->INFMATION_ID.'/'.$infoguesthouse_level->LOCATION_LEVEL_ID.'/'.$infoguesthouse_room->LEVEL_ROOM_ID.'/checkperson')  }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">จัดสรรห้องพัก</a>
                                                   
                                                        
                                                    </div>
                                            </div>
                                        </td>  
                                    </tr>  
                                @endforeach

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


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
           }
            
   })
    
}


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection