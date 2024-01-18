@extends('layouts.risk')   
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
      font-size: 10px;
      font-size: 1.0rem;
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
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
      
      
      .form-control{
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
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานอุบัติการณ์ความเสี่ยงที่ได้รับการแก้ไขแล้ว</B></h3>   
                <div align="right ">
                    <a class="btn btn-success" href="{{url('manager_risk/report')}}" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fas fa-chevron-circle-left text-white-70" style="font-size:18px;"></i>&nbsp;&nbsp;ย้อนกลับ</a> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                  </div>
                </div>
               
            <div class="block-content block-content-full">  
                <div class="row push">
                    <div class="col-sm-2 text-right" >
                        <label style="font-family:'Kanit',sans-serif;font-size:14px;">รายงานโดยใช้ :</label>
                    </div> 
                    <div class="col-lg-2 ">
                    <select name="SETUP_INCEDENCE_REPORTHEADER_NAME" id="SETUP_INCEDENCE_REPORTHEADER_NAME" class="form-control input-lg " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" >
                        <option value="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">--เลือก--</option>
                            @foreach($reportheaders as $reportheader)
                                <option value="{{ $reportheader-> SETUP_INCEDENCE_REPORTHEADER_ID}}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">{{ $reportheader-> SETUP_INCEDENCE_REPORTHEADER_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">กลุ่มอุบัติการณ์ความเสี่ยง :</label>
                        </div> 
                        <div class="col-lg-2 ">
                        <select name="INCIDENCE_GROUP_NAME" id="INCIDENCE_GROUP_NAME" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                            <option value="">--เลือก--</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group-> INCIDENCE_GROUP_ID}}" >{{ $group-> INCIDENCE_GROUP_NAME}}</option>
                                @endforeach
                        </select> 
                        </div>
                       
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">หมวดอุบัติการณ์ความเสี่ยง :</label>
                        </div> 
                        <div class="col-lg-2 ">
                        <select name="INCIDENCE_CATEGORY_SUBNAME" id="INCIDENCE_CATEGORY_SUBNAME" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                                <option value="">--เลือก--</option>
                                    @foreach($category_subs as $category_sub)
                                        <option value="{{ $category_sub-> INCIDENCE_CATEGORY_SUBID}}" >{{ $category_sub-> INCIDENCE_CATEGORY_SUBNAME}}</option>
                                    @endforeach
                        </select> 
                        </div>
                                                     
                    </div>
                    <div class="row push">
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">ประเภทอุบัติการณ์ความเสี่ยง :</label>
                        </div> 
                        <div class="col-lg-2 ">
                        <select name="INCIDENCE_CATEGORY_NAME" id="INCIDENCE_CATEGORY_NAME" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                                <option value="">--เลือก--</option>
                                    @foreach($categorys as $category)
                                        <option value="{{ $category-> INCIDENCE_CATEGORY_ID}}" >{{ $category-> INCIDENCE_CATEGORY_NAME}}</option>
                                    @endforeach
                            </select> 
                        </div>
                      
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">ประเภทอุบัติการณ์ความเสี่ยงย่อย :</label>
                        </div> 
                        <div class="col-lg-2 ">
                        <select name="INCIDENCE_CATEGORY_NAME" id="INCIDENCE_CATEGORY_NAME" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                                <option value="">--เลือก--</option>
                                    @foreach($group_subs as $group_sub)
                                        <option value="{{ $group_sub-> INCIDENCE_GROUP_SUBID}}" >{{ $group_sub-> INCIDENCE_GROUP_SUBNAME}}</option>
                                    @endforeach
                            </select> 
                        </div>
                        
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">ระดับความรุนแรง :</label>
                        </div> 
                        <div class="col-lg-2 ">
                        <select name="INTERNALCONTROL_HEAD_WORK" id="INTERNALCONTROL_HEAD_WORK" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                            <option value="">--เลือก--</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level-> INCIDENCE_LEVEL_ID}}" >{{ $level-> INCIDENCE_LEVEL_NAME}}</option>
                                @endforeach
                            </select> 
                        </div>                                                    
                    </div>


                    <div class="row push">
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">ระดับกลุ่ม/หน่วยงานหลักที่แก้ไข :</label>
                        </div> 
                        <div class="col-lg-2 ">
                            <select name="SETUP_INCEDENCE_LEVELDEPARTSUB_NAME" id="SETUP_INCEDENCE_LEVELDEPARTSUB_NAME" class="form-control input-lg " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" >
                                <option value="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">--เลือก--</option>  
                                @foreach($modify_leveldepartsubs as $modify_leveldepartsub)
                                    <option value="{{ $modify_leveldepartsub-> SETUP_INCEDENCE_LEVELDEPARTSUB_ID}}" >{{ $modify_leveldepartsub-> SETUP_INCEDENCE_LEVELDEPARTSUB_NAME}}</option>
                                @endforeach                                                                  
                            </select>
                        </div>
                       
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">กลุ่ม/หน่วยงานหลักที่แก้ไขปัญหา :</label>
                        </div> 
                        <div class="col-lg-2 ">
                            <select name="DONATE_PERSON_PROVINCE" id="PROVIDONATE_PERSON_PROVINCECE_NAME" class="form-control input-lg " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" >
                            <option value="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">--เลือก--</option>  
                            @foreach($modify_departsubs as $modify_departsub)
                                    <option value="{{ $modify_departsub-> SETUP_INCEDENCE_MODIFY_DEPARTSUB_ID}}" >{{ $modify_departsub-> SETUP_INCEDENCE_MODIFY_DEPARTSUB_NAME}}</option>
                                @endforeach                                                                    
                            </select>
                        </div>
                       
                        <div class="col-sm-2 text-right" >
                            <label style="font-family:'Kanit',sans-serif;font-size:14px;">ระยะเวลาการแก้ไขตามจริง (วัน)</label>
                        </div> 
                        <div class="col-lg-2 ">
                            <select name="SETUP_MODIFY_TODAY_NAME" id="SETUP_MODIFY_TODAY_NAME" class="form-control input-lg " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" >
                                <option value="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">--เลือก--</option> 
                                @foreach($modify_todays as $modify_today)
                                    <option value="{{ $modify_today-> SETUP_MODIFY_TODAY_ID}}" >{{ $modify_today-> SETUP_MODIFY_TODAY_NAME}}</option>
                                @endforeach                                                                    
                            </select>
                        </div>
                        </div>
                        <div class="row push">
                        <div class="col-lg-4 ">                                
                        </div>
                        <div class="col-lg-2 ">
                        <input type="text " name="DONATE_PERSON_PROVINCE" id="PROVIDONATE_PERSON_PROVINCECE_NAME" class="form-control input-lg " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" >
                        </div>
                        <div class="col-sm-1" >
                                <button class="btn btn-info text-white" type="submit" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fa fa-search fa-sm text-white" style="font-size:15px "></i>&nbsp;&nbsp;ค้นหา </button> 
                                </div>  
                        <div class="col-lg-3 ">                                
                        </div>                              
                        <div class="col-sm-2" >
                            <div align="right ">
                                <button class="btn btn-success" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;"><i class="fas fa-file-excel text-white" style="font-size:17px"></i>&nbsp;&nbsp;Export Excel</button> 
                                         
                            </div>
                            </div> 

        
        <div class="block-content">  
            <div class="table-responsive"> 
               <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">วันที่</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">กลุ่ม/ฝ่าย/งาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">หัวหน้าฝ่ายงาน</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ระยะเวลา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ภารกิจ</th> 
                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="8%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                   
                            <tr height="20">                       
                                <td class="text-font" align="center"></td>
                                <td class="text-font text-pedding" style="text-align: center;"></td>
                                <td class="text-font text-pedding" style="text-align: center;"></td>
                                <td class="text-font text-pedding" style="text-align: center;"></td>
                                <td class="text-font text-pedding" ></td>
                                <td class="text-font text-pedding" ></td>    
                                <td align="center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                            ทำรายการ
                                        </button>
                                    <div class="dropdown-menu" style="width:10px">   
                                            <a class="dropdown-item"  href="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ดูรายละเอียด</a> 
                                            <a class="dropdown-item"  href=""  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">แก้ไข</a>                        
                                            <a class="dropdown-item"  href="" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ลบ</a>
                                            
                                        </div>
                                    </div>
                                </td> 
                            </tr>
                       
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
             
         
              //alert("Hello! I am an alert box!!");
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