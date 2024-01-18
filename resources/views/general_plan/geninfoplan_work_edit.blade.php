@extends('layouts.backend')


<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
@section('content')

<style>

#calendar{
		max-width: 95%;
		margin: 0 auto;
    font-size:15px;
	}

    body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
      }

      table, td, th {
            border: 1px solid black;
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
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
        {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }} {{ $inforpersonuser -> HR_LNAME }}
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <div class="row">
            <div>
              <a href="{{ url('general_plan/plan_dashboard/'.$inforpersonuserid -> ID)}}"
                class="btn loadscreen"  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_plan/planwork/'.$inforpersonuserid -> ID)}}" class="btn btn-info loadscreen"
               >แผนปฏิบัติงาน</a>
            </div>
            <div>&nbsp;</div>

            <div>
              <a href="{{ url('general_plan/plan_project/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนงานโครงการ</a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_plan/plan_humandev/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนพัฒนาบุคลากร</a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_plan/plan_durable/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนซื้อครุภัณฑ์</a>
            </div>
            <div>&nbsp;</div>
            <a href="{{ url('general_plan/plan_repair/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
              style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนซ่อมบำรุง</a>
          </div>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
  <div class="block-content">

    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;">
      <div class="row">
        <div class="col-sm-12">
          <B>แก้ไขข้อมูลแผนปฏิบัติงาน</B>
        </div>
      </div>
    </h3>


    <div class="block-content block-content-full">

      <form  method="post" action="{{ route('guest.geninfoplanwork_update') }}"  enctype="multipart/form-data">
  @csrf


  <input type="hidden" name="PLANWORK_SAVE_HR_ID" id="PLANWORK_SAVE_HR_ID" value="{{$id_user}}">
  <input type="hidden" name="IDREF" id="IDREF" value="{{$infowork_ref->PLANWORK_ID}}">

  <div class="col-sm-12">
  <div class="row push">
  <div class="col-lg-2" style="text-align: left">
  <label >                           
  ปีงบประมาณ :              
  </label>
  </div> 
  <div class="col-lg-2">
  <select name="PLANWORK_BUDGET" id="PLANWORK_BUDGET" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;">   
                              @foreach ($budgets as $budget)
                          @if($budget->LEAVE_YEAR_ID== $infowork_ref->PLANWORK_BUDGET)
                  <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                          @else
                  <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                          @endif                                 
                      @endforeach                         
                          </select>
  </div> 

 


      <div class="col-lg-2" style="text-align: left">
      <label >                           
      ตามยุทธศาสตร์ :              
      </label>
      </div> 
      <div class="col-lg-6">
      <select name="PLANWORK_STRATEGIC_ID" id="PLANWORK_STRATEGIC_ID" class="form-control input-lg js-example-basic-single strategic" style=" font-family: 'Kanit', sans-serif;" onclick="checkhrdepartment()">
                      <option value="" >กรุณาเลือกยุทธศาสตร์</option>
                              @foreach ($infostrategics as $infostrategic) 
                                 @if($infostrategic ->STRATEGIC_ID == $infowork_ref->PLANWORK_STRATEGIC_ID)
                                 <option value="{{ $infostrategic ->STRATEGIC_ID  }}" selected>{{ $infostrategic->STRATEGIC_NAME }}</option>
                                @else
                                  <option value="{{ $infostrategic ->STRATEGIC_ID  }}">{{ $infostrategic->STRATEGIC_NAME }}</option>
                                @endif                              
                      @endforeach 
      </select>

      
    </div>
  </div>
  
  <div class="row push">
  <div class="col-lg-2" style="text-align: left">
  <label >                           
  เป้าประสงค์ :              
  </label>
  </div> 
  <div class="col-lg-4">
  <select name="PLANWORK_TARGET_ID" id="PLANWORK_TARGET_ID" class="form-control input-lg js-example-basic-single goal" style=" font-family: 'Kanit', sans-serif;" onclick="checkhrdepartmentsub()">
  <option value="" >กรุณาเลือกเป้าประสงค์</option>
  <option value="{{$infowork_ref->PLANWORK_TARGET_ID}}" selected>{{$infowork_ref->TARGET_NAME}}</option>
  </select>
  </div> 
  <div class="col-lg-1" style="text-align: left">
  <label >                           
  ตัวชี้วัด :              
  </label>
  </div> 
  <div class="col-lg-5">
  <select name="PLANWORK_KPI_ID" id="PLANWORK_KPI_ID" class="form-control input-lg js-example-basic-single metric" style=" font-family: 'Kanit', sans-serif;" onclick="checkhrdepartmentsubsub()">
  <option value="" >กรุณาเลือกตัวชี้วัด</option>
  <option value="{{$infowork_ref->PLANWORK_KPI_ID}}" selected>{{$infowork_ref->KPI_CODE}} :: {{$infowork_ref->KPI_NAME}}</option>
  </select>
  </div> 

  </div>


  <div class="row push">
  <div class="col-lg-2" style="text-align: left">
  <label >                           
  รหัสแผนงาน :              
  </label>
  </div> 
  <div class="col-lg-2">
  <input name="PLANWORK_CODE" id="PLANWORK_CODE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infowork_ref->PLANWORK_CODE}}" >
  </div>

  <div class="col-lg-2" style="text-align: left">
  <label >                           
   ชื่อแผนงาน :              
  </label>
  </div> 
  <div class="col-lg-6">
  <input name="PLANWORK_HEAD" id="PLANWORK_HEAD" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infowork_ref->PLANWORK_HEAD}}" >
  </div> 

  </div>


  

  <div class="row push">
  <div class="col-lg-2" style="text-align: left">
  <label >                           
  วันที่เริ่มต้น :              
  </label>
  </div> 
  <div class="col-lg-2">
  <input  name = "PLANWORK_DATE_BEGIN"  id="PLANWORK_DATE_BEGIN" value="{{formate($infowork_ref->PLANWORK_DATE_BEGIN)}}" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
  </div> 
  <div class="col-lg-2" style="text-align: left">
  <label >                           
  ถึงวันที่            
  </label>
  </div> 
  <div class="col-lg-2">
  <input  name = "PLANWORK_DATE_END"  id="PLANWORK_DATE_END" value="{{formate($infowork_ref->PLANWORK_DATE_END)}}" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
  </div> 


  </div>


  <div class="row push">
  <div class="col-lg-2" style="text-align: left">
  <label >                           
  ประเภทแผนงาน :              
  </label>
  </div> 
  <div class="col-lg-4">
  <select name="PLANWORK_PRO_TYPE" id="PLANWORK_PRO_TYPE" class="form-control input-sm js-example-basic-single plantype"  style=" font-family: 'Kanit', sans-serif;">   
              <option value="team">ทีมประสาน</option>  
              <option value="dep">หน่วยงาน</option>                       
  </select>
  </div>

  <div class="col-lg-2" style="text-align: left">
  <label >                           
  ทีมประสาน/หน่วยงาน :              
  </label>
  </div> 
  <div class="col-lg-4">
  <select name="PLANWORK_PRO_TEAM_NAME" id="PLANWORK_PRO_TEAM_NAME" class="form-control input-sm js-example-basic-single teamunit"  style=" font-family: 'Kanit', sans-serif;">   
    <option value="">กรุณาเลือก</option>                         
    <option value="{{$infowork_ref->PLANWORK_PRO_TEAM_NAME}}" selected>{{$infowork_ref->PLANWORK_PRO_TEAM_NAME}}</option>                                
        </select>
  </div>
 
 
  </div> 



  <div class="row push">
              <div class="col-lg-2" style="text-align: left">
              <label >                           
              ผู้รับผิดชอบโครงการ :              
              </label>
              </div> 
              <div class="col-lg-4">
              <select name="PLANWORK_PRO_TEAM_HR_ID" id="PLANWORK_PRO_TEAM_HR_ID" class="form-control input-sm js-example-basic-single headperson"  style=" font-family: 'Kanit', sans-serif;">   
                <option value="{{$infowork_ref->PLANWORK_PRO_TEAM_HR_ID}}" selected>{{$infowork_ref->HR_FNAME}} {{$infowork_ref->HR_LNAME}}</option>     
                     
              </select>
              </div>
      
              <div class="col-lg-2" style="text-align: left">
              <label >                           
              บันทึกรายละเอียด :        
              </label>
              </div> 
              <div class="col-lg-4">
         

              <textarea id="PLANWORK_DETAIL" name="PLANWORK_DETAIL" rows="4" cols="50" class="form-control input-sm" >{{$infowork_ref->PLANWORK_DETAIL}}            
                </textarea>

              </div> 
              




              

  </div>
  <div class="row push ">
    <div class="col-md-12">
        <div class="block block-rounded block-bordered">
            <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist"
                style="background-color: #D2B4DE;">
                <li class="nav-item"><a class="nav-link active" href="#object1"
                        style="font-family: 'Kanit', sans-serif; font-size:14px;font-weight:normal;">ทีมนำ</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#object2"
                        style="font-family: 'Kanit', sans-serif; font-size:14px;font-weight:normal;">หน่วยงาน</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#object3"
                        style="font-family: 'Kanit', sans-serif; font-size:14px;font-weight:normal;">บุคคล</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#object4"
                        style="font-family: 'Kanit', sans-serif; font-size:14px;font-weight:normal;">To do list</a>
                </li>
               
            </ul>
            <div class="block-content tab-content">

                <div class="tab-pane active" id="object1" role="tabpanel">
                
                  <table class="table-striped table-vcenter"
                  style="width: 100%;">
                  <thead>
                      <tr>
                          <th class="text-font text-pedding fo13" style="text-align: center;">
                              ชื่อทีม</th>
                          <th  style="text-align: center;"
                              width="5%">
                              <a class="btn btn-hero-sm btn-hero-success addRow1"
                                  style="color:#FFFFFF;"><i class="fa fa-plus"></i></a>
                          </th>
                      </tr>
                  </thead>
                  <tbody class="tbody1"> 
                    <?php $count1 = 0; ?>
                    @foreach ($planworkteam_refs as $planworkteam_ref) 
                      <tr>                                                         
                          <td>
                              
                                  <select name="PLANWORK_HR_TEAM_ID[]" id="PLANWORK_HR_TEAM_ID{{$count1}}" class="form-control input-sm foo13">
                                      <option value="">--กรุณาเลือก--</option>
                                      @foreach ($teams as $team) 
                                      @if( $planworkteam_ref->PLANWORK_HR_TEAM_ID == $team->HR_TEAM_ID )  
                                          <option value="{{ $team->HR_TEAM_ID }}" selected> {{ $team->HR_TEAM_NAME }} :: {{ $team->HR_TEAM_DETAIL }}</option>                                                              
                                      @else
                                          <option value="{{ $team->HR_TEAM_ID }}" > {{ $team->HR_TEAM_NAME }} :: {{ $team->HR_TEAM_DETAIL }}</option>                                                              
                                      @endif
                                      @endforeach
                                  </select>
                          
                          </td>
                          <td style="text-align: center;"><a
                                  class="btn btn-hero-sm btn-hero-danger remove"
                                  style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>
                          </td>
                      </tr>
                      <?php $count1++;?>
                      @endforeach

                  </tbody>
              </table>
                </div>

                <div class="tab-pane" id="object2" role="tabpanel">

                  <table class="table-striped table-vcenter"
                  style="width: 100%;">
                  <thead>
                      <tr>
                          <th class="text-font text-pedding fo13" style="text-align: center;">
                              หน่วยงาน</th>
                          <th  style="text-align: center;"
                              width="5%">
                              <a class="btn btn-hero-sm btn-hero-success addRow2"
                                  style="color:#FFFFFF;"><i class="fa fa-plus"></i></a>
                          </th>
                      </tr>
                  </thead>
                  <tbody class="tbody2">
                    <?php $count2 = 0; ?>
                    @foreach ($planworkdep_refs as $planworkdep_ref) 
                          <tr>
                              <td>                                   
                                      <select name="PLANWORK_HR_DEP_ID[]" id="PLANWORK_HR_DEP_ID{{$count2}}" class="form-control input-sm fo13">
                                          <option value="">--กรุณาเลือกหน่วยงาน--</option>
                                              @foreach ($infordepartmentsubsubs as $infordepartmentsubsub)
                                                 @if($infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_ID  == $planworkdep_ref->PLANWORK_HR_DEP_ID)
                                                 <option value="{{ $infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_ID }}" selected> {{ $infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                                                 @else
                                                  <option value="{{ $infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_ID }}"> {{ $infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                                                @endif
                                              @endforeach
                                      </select>
                                                                                            
                              </td>
                              <td style="text-align: center;"><a
                                      class="btn btn-hero-sm btn-hero-danger remove"
                                      style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>
                              </td>
                          </tr>
                          <?php $count2++; ?>
                          @endforeach
                  </tbody>
              </table>
                  

                </div>

                <div class="tab-pane" id="object3" role="tabpanel">
                  <table class="table-striped table-vcenter"
                  style="width: 100%;">
                  <thead>
                      <tr>
                          <th class="text-font text-pedding fo13" style="text-align: center;">ชื่อ-นามสกุล</th>
                          <th class="text-font text-pedding fo13" style="text-align: center;" width="5%"> <a class="btn btn-hero-sm btn-hero-success addRow3" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></th>
                      </tr>
                  </thead>
                  <tbody class="tbody3">  
                    <?php $count3 = 0; ?>
                @foreach ($planworkperson_refs as $planworkperson_ref) 
                  <tr>        
                       <td>   
                          <select name="PLANWORK_HR_PERSON_ID[]" id="PLANWORK_HR_PERSON_ID{{$count3}}" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                              <option value="">--กรุณาเลือก--</option>
                                  @foreach ($infopers as $infoperson)                                                     
                                      @if($infoperson ->ID  == $planworkperson_ref->PLANWORK_HR_PERSON_ID)
                                          <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                      @else
                                          <option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                     @endif
                                  @endforeach 
                              </select>
                        </td>
                        <td style="text-align: center;"><a
                                class="btn btn-hero-sm btn-hero-danger remove"
                                style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>
                        </td>

                      </tr>
                      <?php $count3++; ?>

                      @endforeach

                    </tbody>

                      </table>
                </div>


                <div class="tab-pane" id="object4" role="tabpanel">

                  <table class="table-striped table-vcenter"
                  style="width: 100%;">
                  <thead>
                      <tr>
                          <th class="text-font text-pedding fo13" style="text-align: center;">รายการ</th>
                          <th class="text-font text-pedding fo13" style="text-align: center;" width="5%"> <a class="btn btn-hero-sm btn-hero-success addRow4" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></th>
                      </tr>
                  </thead>
                  <tbody class="tbody4">  
                    <?php $count4 = 0; ?>
                    @foreach ($planworklist_refs as $planworklist_ref) 
                  <tr>        
                       <td>   
                         <input name="PLANWORK_LIST_DETAIL[]" id="PLANWORK_LIST_DETAIL{{$count4}}" class="form-control input-lg js-example-basic-single"  value="{{$planworklist_ref->PLANWORK_LIST_DETAIL}}">
                        </td>
                        <td style="text-align: center;"><a
                                class="btn btn-hero-sm btn-hero-danger remove"
                                style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>
                        </td>

                      </tr>

                      <?php $count4++; ?>
                      @endforeach
                    </tbody>

                      </table>

             
              </table>

                </div>

            

            </div>
        </div>



 </div>
 <br>

</div>



  <div class="modal-footer">
  <div align="right">
  <button type="submit"  class="btn btn-hero-sm btn-hero-info f-kanit" >บันทึก</button>
  <a href="{{ url('general_plan/planwork/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger f-kanit" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
  </div>

 
  </div>
  </form>  

      
  



  </div>
  

</div>
</div>
@endsection

@section('footer')

        <script src="{{ asset('select2/select2.min.js') }}"></script>

        <script>
        $(document).ready(function() {
            $('select').select2({ width: '100%' });
        });
        </script>

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

  $('.strategic').change(function(){
       if($(this).val()!=''){
       var select=$(this).val();
       var _token=$('input[name="_token"]').val();
       $.ajax({
               url:"{{route('plandropdown.strategic')}}",
               method:"GET",
               data:{select:select,_token:_token},
               success:function(result){
                  $('.goal').html(result);
               }
       })
      
       }        
  });
  
  $('.goal').change(function(){
       if($(this).val()!=''){
       var select=$(this).val();
       var _token=$('input[name="_token"]').val();
       $.ajax({
               url:"{{route('plandropdown.goal')}}",
               method:"GET",
               data:{select:select,_token:_token},
               success:function(result){
                  $('.metric').html(result);
               }
       })
     
       }        
  });
  
  
  
  
  
  $('.plantype').change(function(){
       if($(this).val()!=''){
       var select=$(this).val();
       var _token=$('input[name="_token"]').val();
       $.ajax({
               url:"{{route('plandropdown.plantype')}}",
               method:"GET",
               data:{select:select,_token:_token},
               success:function(result){
                  $('.teamunit').html(result);
               }
       })
     
       }        
  });
  
  
  $('.teamunit').change(function(){
       if($(this).val()!=''){
       var select=$(this).val();
       var PROTYPE=document.getElementById("PLANWORK_PRO_TYPE").value;
       var _token=$('input[name="_token"]').val();
       $.ajax({
               url:"{{route('plandropdown.teamunit')}}",
               method:"GET",
               data:{select:select,PROTYPE:PROTYPE,_token:_token},
               success:function(result){
                  $('.headperson').html(result);
               }
       })
     
       }        
  });
  
  
  
  </script>

 <script>
                        $('.addRow1').on('click', function() {
                            addRow1();
                            $('select').select2({ width: '100%' });
                        });

                        function addRow1() {
                            var count = $('.tbody1').children('tr').length;
                            var tr = '<tr>'+                                                      
                                    '<td>'+
                                    '<select name="PLANWORK_HR_TEAM_ID[]" id="PLANWORK_HR_TEAM_ID'+count+'"  class="form-control input-sm foo13">'+
                                    '<option value="">--กรุณาเลือก--</option>'+
                                    '@foreach ($teams as $team)'+   
                                    '<option value="{{ $team->HR_TEAM_ID }}" > {{ $team->HR_TEAM_NAME }} :: {{ $team->HR_TEAM_DETAIL }}</option>'+                                                              
                                    '@endforeach'+
                                    '</select>'+
                                    '</td>'+
                                    '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>'+
                                    '</td>'+
                                    '</tr>'; 
                            $('.tbody1').append(tr);
                        };

                        $('.tbody1').on('click', '.remove', function() {
                            $(this).parent().parent().remove();
                        });



                        $('.addRow2').on('click', function() {
                            addRow2();
                            $('select').select2({ width: '100%' });
                        });

                        function addRow2() {
                            var count = $('.tbody2').children('tr').length;
                            var tr = '<tr>'+
                              '<td>'+                                   
                                '<select name="PLANWORK_HR_DEP_ID[]" id="PLANWORK_HR_DEP_ID'+count+'"  class="form-control input-sm fo13">'+
                                  '<option value="">--กรุณาเลือกหน่วยงาน--</option>'+
                                  '@foreach ($infordepartmentsubsubs as $infordepartmentsubsub)'+
                                  '<option value="{{ $infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_ID }}"> {{ $infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_NAME }}</option>'+
                                  '@endforeach'+
                                  '</select>'+                                                              
                                  '</td>'+
                                  '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove"'+
                                    'style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>'+
                                    '</td>'+
                                    '</tr>'; 
                            $('.tbody2').append(tr);
                        };

                        $('.tbody2').on('click', '.remove', function() {
                            $(this).parent().parent().remove();
                        });


                        $('.addRow3').on('click', function() {
                            addRow3();
                            $('select').select2({ width: '100%' });
                        });

                        function addRow3() {
                            var count = $('.tbody3').children('tr').length;
                            var tr =   '<tr>'+       
                              '<td>'+   
                                '<select name="PLANWORK_HR_PERSON_ID[]" id="PLANWORK_HR_PERSON_ID'+count+'"  class="form-control input-lg js-example-basic-single" style=" font-family: \'Kanit\', sans-serif;" >'+
                                  '<option value="">--กรุณาเลือก--</option>'+
                                  '@foreach ($infopers as $infoperson)'+                                                     
                                  '<option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>'+      
                                  '@endforeach'+ 
                                  '</select>'+
                                  '</td>'+
                                  '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove"'+
                                  'style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>'+
                                  '</td>'+
                                  '</tr>'; 
                            $('.tbody3').append(tr);
                        };

                        $('.tbody3').on('click', '.remove', function() {
                            $(this).parent().parent().remove();
                        });


                        $('.addRow4').on('click', function() {
                            addRow4();
                            $('select').select2({ width: '100%' });
                        });

                        function addRow4() {
                            var count = $('.tbody4').children('tr').length;
                            var tr = '<tr>'+       
                                '<td>'+     
                                '<input name="PLANWORK_LIST_DETAIL[]" id="PLANWORK_LIST_DETAIL'+count+'"  class="form-control input-lg js-example-basic-single"  >'+  
                                '</td>'+  
                                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove"'+  
                                  'style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a>'+  
                                  '</td>'+  
                                  '</tr>'; 
                            $('.tbody4').append(tr);
                        };

                        $('.tbody4').on('click', '.remove', function() {
                            $(this).parent().parent().remove();
                        });


                        
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',           
                thaiyear: true,
                autoclose: true                       
            }); 
    });


</script>



@endsection