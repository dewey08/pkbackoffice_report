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


  <!-- Advanced Tables -->
  <div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <div class="row">
                    <div>
                        <a href="{{ url('general_risk/dashboard_risk/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                            
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </div>
                <div>&nbsp;</div>
                <div >
                <a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)}}" class="btn btn-warning" >ความเสี่ยง</a>
                </div>
                <div>&nbsp;</div>
                <div>
                <a href="{{ url('general_risk/risk_refteam/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงทีม</a>
                </div>
                <div>&nbsp;</div>
                <div>
                <a href="{{ url('general_risk/risk_refdep/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงกลุ่มงาน</a>
                </div>
                <div>&nbsp;</div>

                <div>
                <a href="{{ url('general_risk/risk_refdepsub/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงฝ่าย</a>
                </div>
                <div>&nbsp;</div>
                <div>
                <a href="{{ url('general_risk/risk_refdepsubsub/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงหน่วยงาน</a>
                </div>
                <div>&nbsp;</div>
                <div>
                <a href="{{ url('general_risk/risk_refperson/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงบุคคล</a>
                </div>
                <div>&nbsp;</div>


          
                </div>
                </ol>
            </nav>
        </div>
    </div>
</div>
<br>
<div class="content">
<div class="block block-rounded block-bordered">

            
<div class="block-content">    
<h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขรายงานอุบัติการณ์ความเสี่ยง</h2> 
<div class="block-content block-content-full" align="left">

<form  method="post" action="{{ route('gen_risk.risk_notify_update') }}" enctype="multipart/form-data">
@csrf

<input value="{{$id_user}}" type="hidden" name = "USER_ID"  id="USER_ID" class="form-control input-lg"  >                                                                 
       
<input value="{{$rigreps->RISKREP_ID}}" type="hidden" name = "RISKREP_ID"  id="RISKREP_ID" class="form-control input-lg"  >  

<div class="row push">
    <div class="col-sm-2">
    <label>รหัสอ้างอิง :</label>
    </div> 
    <div class="col-lg-3 ">
    <input name="RISKREP_CODE" id="RISKREP_CODE" class="form-control input-lg" style=" font-family:'Kanit', sans-serif;"  value="{{$rigreps->RISKREP_CODE}}">   
       
    </div> 
    <div class="col-sm-1">
        <label>วันที่บันทึก :</label>
        </div> 
        <div class="col-lg-2 ">
            <input name="RISKREP_DATESAVE" id="RISKREP_DATESAVE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family:'Kanit', sans-serif;" value="{{formate($rigreps->RISKREP_DATESAVE)}}" readonly>   
        </div> 
    <div class="col-sm-1">
    <label>ชนิดสถานที่:</label>
    </div> 
    <div class="col-lg-3 ">
        <select name="RISKREP_LOCAL" id="RISKREP_LOCAL" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                 
            @foreach($grouplocations as $grouplocation)
                @if($grouplocation->ORIGIN_DEPART_ID == $rigreps->RISKREP_LOCAL)
                    <option value="{{ $grouplocation-> ORIGIN_DEPART_ID}}" selected>{{ $grouplocation-> ORIGIN_DEPART_CODE}} :: {{ $grouplocation-> ORIGIN_DEPART_NAME}}</option>
                @else
                    <option value="{{ $grouplocation-> ORIGIN_DEPART_ID}}" >{{ $grouplocation-> ORIGIN_DEPART_CODE}} :: {{ $grouplocation-> ORIGIN_DEPART_NAME}}</option>
                @endif  
            @endforeach
           
        </select> 
      
    </div> 
    </div>

<div class="row push">
<div class="col-sm-2">
<label>หน่วยงานที่รายงาน :</label>
</div> 
<div class="col-lg-5 "> 
<select name="RISKREP_DEPARTMENT_SUB" id="RISKREP_DEPARTMENT_SUB" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">
<option value="">เลือก</option>
  
    @foreach($departsubs as $departsub)
    @if($departsub->HR_DEPARTMENT_SUB_SUB_ID == $rigreps->RISKREP_DEPARTMENT_SUB)
    <option value="{{ $departsub-> HR_DEPARTMENT_SUB_SUB_ID}}" selected>{{ $departsub-> HR_DEPARTMENT_SUB_SUB_NAME}} </option>
    @else
    <option value="{{ $departsub-> HR_DEPARTMENT_SUB_SUB_ID}}">{{ $departsub-> HR_DEPARTMENT_SUB_SUB_NAME}} </option>
    @endif
@endforeach
</select>
</div> 
<div class="col-sm-2">
<label>ประเภทสถานที่ :</label>
</div> 
<div class="col-lg-3 ">        
<select name="RISKREP_TYPE" id="RISKREP_TYPE" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
    <option value="">เลือก</option>
      
        @foreach($typelocations as $typelocation)

        @if($typelocation->SETUP_TYPELOCATION_ID == $rigreps->RISKREP_TYPE)

            <option value="{{ $typelocation-> SETUP_TYPELOCATION_ID}}" selected>{{ $typelocation-> SETUP_TYPELOCATION_NAME}} </option>
            @else
            <option value="{{ $typelocation-> SETUP_TYPELOCATION_ID}}">{{ $typelocation-> SETUP_TYPELOCATION_NAME}} </option>
            @endif
        @endforeach
</select> 
</div> 
</div> 


<div class="row push">
<div class="col-sm-2">
<label>เป็นอุบัติการณ์ความเสี่ยงในเรื่องได :</label>
</div> 
<div class="col-lg-10 ">
<select name="RISKREP_TITLE" id="RISKREP_TITLE" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">
<option value="">เลือก</option>

    @foreach($settings as $setting)
        
        @if($setting->INCIDENCE_SETTING_ID == $rigreps->RISKREP_TITLE)
        <option value="{{ $setting-> INCIDENCE_SETTING_ID}}" selected>{{ $setting-> INCIDENCE_SETTING_NAME}} </option>
        @else
        <option value="{{ $setting-> INCIDENCE_SETTING_ID}}">{{ $setting-> INCIDENCE_SETTING_NAME}} </option>
        @endif
    @endforeach
</select>
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label>เป็นอุบัติการณ์ความเสี่ยงย่อย:</label>
</div> 
<div class="col-lg-10 ">
<select name="RISKREP_SUBTITLE" id="RISKREP_SUBTITLE" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">
<option value="">เลือก</option>

    @foreach($incidentsubs as $incidentsub)       
    @if($incidentsub->INCIDENCE_SUB_ID == $rigreps->RISKREP_SUBTITLE)       
    <option value="{{ $incidentsub-> INCIDENCE_SUB_ID}}" selected>{{ $incidentsub-> INCIDENCE_SUB_NAME}} </option>
    @else
    <option value="{{ $incidentsub-> INCIDENCE_SUB_ID}}">{{ $incidentsub-> INCIDENCE_SUB_NAME}} </option>
    @endif
@endforeach
</select>
</div> 
</div>
<div class="row push">
<div class="col-sm-2">
<label>สรุปประเด็นปัญหา:</label>
</div> 
<div class="col-lg-10 ">
<small>บันทึกตามรูปแบบเพื่อบอกให้ทราบว่า เกิดอะไร อย่างไร(Free text ไม่เกิน 3 บรรทัด)</small>
<textarea name="RISKREP_INFER" id="RISKREP_INFER" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" rows="4">{{ $rigreps-> RISKREP_INFER}}</textarea>
</div> 
</div>



<div class="row push">
<div class="col-sm-2">
<label>ผู้ที่ได้รับผลกระทบ :</label>
</div> 
<div class="col-lg-3 ">
    <select name="RISKREP_USEREFFECT" id="RISKREP_USEREFFECT" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
        <option value="">เลือก</option>
                    

        @foreach($effects as $effect)
        @if($effect->INCEDENCE_USEREFFECT_ID == $rigreps->RISKREP_USEREFFECT) 
                <option value="{{ $effect-> INCEDENCE_USEREFFECT_ID}}" selected>{{ $effect-> INCEDENCE_USEREFFECT_NAME}}</option>
            @else
                <option value="{{ $effect-> INCEDENCE_USEREFFECT_ID}}" >{{ $effect-> INCEDENCE_USEREFFECT_NAME}}</option>
        @endif
    @endforeach



    </select> 
</div> 
<div class="col-sm-0.5">
<label>เพศ :&nbsp;&nbsp;&nbsp;&nbsp;</label>
</div> 
<div class="col-lg-1.5 ">
<select name="RISKREP_SEX" id="RISKREP_SEX" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">
<option value="">เลือก</option>
    @foreach($sexs as $sex)       
        @if($sex->SEX_ID == $rigreps->RISKREP_SEX)
        <option value="{{ $sex-> SEX_ID}}" selected>{{ $sex-> SEX_NAME}} </option>      
       @else
       <option value="{{ $sex-> SEX_ID}}">{{ $sex-> SEX_NAME}} </option>
       @endif
    @endforeach
</select>
</div> 
<div class="col-sm-0.5">
    &nbsp;&nbsp;&nbsp;&nbsp;<label>อายุ :</label>
</div> 
<div class="col-lg-1 ">
<input name="RISKREP_AGE" id="RISKREP_AGE" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;" value="{{$rigreps-> RISKREP_AGE}}">
</div> 
<div class="col-lg-3 text-left">
ปี&nbsp;&nbsp;&nbsp;&nbsp;<small> (&nbsp;เศษของปีน้อยกว่า 6 เดือนไห้นับเป็น 0 ปี ตั้งแต่ 6 เดือนขึ้นไปไห้นับเป็น 1 ปี&nbsp;)</small>
</div>
</div>
<div class="row push">
<div class="col-sm-2">
<label>วันที่เกิดอุบัติการณ์ความเสี่ยง:</label>
</div> 
<div class="col-lg-4 ">
<input name="RISKREP_STARTDATE" id="RISKREP_STARTDATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family:'Kanit', sans-serif;" value="{{formate($rigreps-> RISKREP_STARTDATE)}}" readonly>
</div> 
<div class="col-sm-2">
<label>วันที่ค้นพบ:</label>
</div> 
<div class="col-lg-4 ">
<input name="RISKREP_DIGDATE" id="RISKREP_DIGDATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family:'Kanit', sans-serif;" value="{{formate($rigreps-> RISKREP_DIGDATE)}}" readonly>
</div> 
</div> 

<div class="row push">
<div class="col-sm-2">
<label>ช่วงเวลาที่เกิดอุบัติการณ์ความเสี่ยง*เวร:</label>
</div> 
<div class="col-lg-4 ">
<select name="RISKREP_FATE" id="RISKREP_FATE" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
        <option value="">เลือก</option>
        
            @foreach($worktimes as $worktime)
                @if($worktime->WORKING_TIME_ID == $rigreps->RISKREP_FATE)
                    <option value="{{ $worktime-> WORKING_TIME_ID}}" selected>{{ $worktime-> WORKING_TIME_NAME}}</option>
                    @else
                    <option value="{{ $worktime-> WORKING_TIME_ID}}" >{{ $worktime-> WORKING_TIME_NAME}}</option>
                    @endif
            @endforeach
          </select> 
</div> 
<div class="col-sm-2">
<label>หรือเวลา:</label>
</div> 
<div class="col-lg-4 ">
<input name="RISKREP_TIME" id="RISKREP_TIME" class="form-control input-lg time"  style=" font-family:'Kanit', sans-serif;" value="{{formatetime($rigreps-> RISKREP_TIME)}}">
</div> 
</div> 

<div class="row push">
<div class="col-sm-2">
<label>แหล่งที่มา/วิธีการค้นพบ :</label>
</div> 
<div class="col-lg-4 ">
<select name="RISKREP_SEARCHLOCATE" id="RISKREP_SEARCHLOCATE" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">
<option value="">เลือก</option>

    @foreach($locations as $location)
        @if($location->INCIDENCE_LOCATION_ID == $rigreps->RISKREP_SEARCHLOCATE)        
            <option value="{{ $location-> INCIDENCE_LOCATION_ID}}" selected>{{ $location-> INCIDENCE_LOCATION_NAME}} </option>
        @else
        <option value="{{ $location-> INCIDENCE_LOCATION_ID}}">{{ $location-> INCIDENCE_LOCATION_NAME}} </option>
        @endif      
    @endforeach
</select>
</div>
<div class="col-sm-2">
<label>ระดับความรุนแรง :</label>
</div> 
<div class="col-lg-2 detali_levelname">

<select name="RISKREP_LEVEL" id="RISKREP_LEVEL" class="form-control input-sm" style=" font-family:'Kanit', sans-serif;">
<option value="">เลือก</option>

    @foreach($levels as $level)        
            @if($level->INCIDENCE_LEVEL_NAME == $rigreps->RISKREP_LEVEL)
                <option value="{{ $level-> INCIDENCE_LEVEL_ID}}" selected>{{ $level-> INCIDENCE_LEVEL_NAME}} </option>       
            @else
                <option value="{{ $level-> INCIDENCE_LEVEL_ID}}">{{ $level-> INCIDENCE_LEVEL_NAME}} </option>
        @endif
        @endforeach
</select>
</div> 
<div class="col-sm-2">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".addlevel">รายละเอียด</button>
</div> 
</div>

<div class="row push">
    <div class="col-sm-2">
        <label>รายละเอียดการเกิดเหตุ :</label>
    </div> 
    <div class="col-lg-10 ">
    <textarea name="RISKREP_DETAILRISK" id="myeditor" class="form-control input-lg time"  style=" font-family:'Kanit', sans-serif;" rows="3">{{ $rigreps-> RISKREP_DETAILRISK}}</textarea>
    </div>
</div>

<div class="row push">
<div class="col-sm-2">

</div> 
<div class="col-lg-2 ">เอกสารประกอบ
    <input type="file" name="RISKREP_DOCFILE" id="RISKREP_DOCFILE" class="form-control">
</div>
</div> 


<div class="row push">
<div class="col-sm-2">
<label>การจัดการเบื้องต้น :</label>
</div> 
<div class="col-lg-10 ">
<textarea name="RISKREP_BASICMANAGE" id="myeditor2" class="form-control input-lg time"  style=" font-family:'Kanit', sans-serif;" rows="3">{{ $rigreps-> RISKREP_BASICMANAGE}}</textarea>
</div>
</div>



<div class="row push">
<div class="col-sm-2">

</div> 
<div class="col-lg-10 ">เอกสารประกอบ
    <input type="file" name="RISKREP_DOCFILE2" id="RISKREP_DOCFILE2" class="col-md-3 mb-3 form-control input-sm">
<textarea name="DONATE_PERSON_EMAIL" id="myeditor2" class="form-control input-lg time"  style="color:#FE1219;font-family:'Kanit', sans-serif;" rows="4">
*** หมายถึง ข้อมูลที่บังคับกรอก
*** หมายถึง ข้อมูลตาม Standard Data set & Terminologies ที่ต้องส่งเข้าสู่ระบบ NRLS
[การแนบเอกสารประกอบสามารถแนบได้มากกว่า 1 ไฟล์ในแต่ละหัวข้อ แต่ขนาดของไฟล์รวมทั้งหมดต้องไม่เกิน 10 MB.ในแต่ละขั้นตอนตั้งแต่การรายงาน ยืนยัน แก้ไขระดับหัวหน้า จนถึงการแก้ไขในระดับกรรมการ]
</textarea>
</div>
</div>


</div>






<div class="modal-footer">
<div align="right">
<button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
<a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn  btn-danger btn-lg" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
</div>

</div>

  


<div class="modal fade addlevel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modallevel">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">รายละเอียดความรุนแรง</h2>
                        </div>
                    <div class="modal-body">
                <body>
                                          
                        <div style='overflow:scroll; height:300px;'>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td style="text-align: center;" width="10%">รหัส</td>
                                    <td style="text-align: center;" width="10%">ความรุนแรง</th>
                                    <td style="text-align: center;">รายละเอียด</td>
                                   
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @foreach ($levels as $level) 
                                    <tr>
                                        <td >{{$level->INCIDENCE_LEVEL_CODE}}</td>
                                        <td >{{$level->INCIDENCE_LEVEL_NAME}}</td>
                                        <td >{{$level->INCIDENCE_LEVEL_NAME_DETAIL}}</td>            
                                        
                                    </tr>
                                @endforeach   
                            </tbody>
                        </table>    
                    </div>
                </div>
                </div>
                   
                </body>
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
 
  <!-- Page ckeditor -->
 <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

 <script>                                  
        CKEDITOR.replace( 'myeditor' , {           
        });
</script>
<script>                                  
        CKEDITOR.replace( 'myeditor2' , {           
        });
</script>

<script>
function selectlevel(INCIDENCE_LEVEL_ID){
      
      var _token=$('input[name="_token"]').val();

           $.ajax({
                   url:"{{route('car.selectbookname')}}",
                   method:"GET",
                   data:{INCIDENCE_LEVEL_ID:INCIDENCE_LEVEL_ID,_token:_token},
                   success:function(result){
                    $('.detali_levelname').html(result);
                   }
           })

           $.ajax({
                   url:"{{route('car.selectbooknum')}}",
                   method:"GET",
                   data:{INCIDENCE_LEVEL_ID:INCIDENCE_LEVEL_ID,_token:_token},
                   success:function(result){
                    $('.detali_booknum').html(result);
                   }
           })


           $('#modallevel').modal('hide');

}
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
            });  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection