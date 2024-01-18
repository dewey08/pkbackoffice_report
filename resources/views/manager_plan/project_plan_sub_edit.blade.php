@extends('layouts.plan')   
  
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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
    
    .text-pedding{
        padding-left:10px;
        padding-right:10px;
                            }
    
                .text-font {
            font-size: 13px;
                        }   

                        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
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

   
    use App\Http\Controllers\ManagerplanController;
    $refnumber = ManagerplanController::refnumberPj();
    
?>
     
<!-- Advanced Tables -->
<br>
<br>
 
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B> แก้ไขแผนงานโครงการย่อย</B></h3>

            </div>
            <div class="block-content block-content-full">




            <br>
        <form  method="post" action="{{ route('mplan.project_plan_sub_update') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="PRO_SUB_ID" id="PRO_SUB_ID" value="{{$idref_posub}}">
        <input type="hidden" name="PRO_ID" id="PRO_ID" value="{{$idref_po}}">
      

        <div class="col-sm-12">   
       
        <div class="row push">

            <div class="col-lg-2" style="text-align: left">
            <label >                           
            รหัสโครงการ :              
            </label>
            </div> 
            <div class="col-lg-2">
            <input type="text" name= "PRO_SUB_CODE" id = "PRO_SUB_CODE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infoprojectsub->PRO_SUB_CODE}}" >
                      
            </select>

            </div>

            <div class="col-lg-1" style="text-align: left">
                ชื่อโครงการ :
            </div>
            <div class="col-lg-7" style="text-align: left">
                <input type="text" name= "PRO_SUB_NAME" id = "PRO_SUB_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infoprojectsub->PRO_SUB_NAME}}">
            </div>
        </div>
        
      
        <div class="row push">

            <div class="col-lg-2" style="text-align: left">
            <label >                           
            ประเภทงบ :              
            </label>
            </div> 
            <div class="col-lg-4">
                <select name="PRO_SUB_BUDGET" id="PRO_SUB_BUDGET" class="form-control input-sm js-example-basic-single"  style=" font-family: 'Kanit', sans-serif;">   
                                <option value="">กรุณาเลือกประเภท</option>                         
                            @foreach ($infobudgettypes as $infobudgettype) 
                                    @if($infobudgettype->BUDGET_ID ==$infoprojectsub->PRO_SUB_BUDGET)
                                        <option value="{{ $infobudgettype->BUDGET_ID  }}" selected>{{ $infobudgettype->BUDGET_NAME}}</option>                                      
                                    @else
                                        <option value="{{ $infobudgettype->BUDGET_ID  }}">{{ $infobudgettype->BUDGET_NAME}}</option>                                      
                                    @endif
                               
                            @endforeach                         
                </select>
     

            </div>

            <div class="col-lg-2" style="text-align: left">
                มูลค่า :
            </div>
            <div class="col-lg-4" style="text-align: left">
                <input type="text" name= "PRO_SUB_AMOUNT" id = "PRO_SUB_AMOUNT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infoprojectsub->PRO_SUB_AMOUNT}}" OnKeyPress="return chkmunny(this)">
            </div>
        </div>

        <div class="row push">

            <div class="col-lg-2" style="text-align: left">
            <label >                           
                ผู้รับผิดชอบหลัก :              
            </label>
            </div> 
            <div class="col-lg-4">
                <select name="PRO_SUB_HR" id="PRO_SUB_HR" class="form-control input-sm js-example-basic-single"  style=" font-family: 'Kanit', sans-serif;">   
                    <option value="">กรุณาเลือก</option>                         
                            @foreach ($infopersons as $infoperson) 
                              @if($infoperson->ID == $infoprojectsub->PRO_SUB_HR)
                                <option value="{{ $infoperson->ID  }}" selected>{{ $infoperson->HR_FNAME}} {{ $infoperson->HR_LNAME}}</option>                                      
                              @else
                                <option value="{{ $infoperson->ID  }}">{{ $infoperson->HR_FNAME}} {{ $infoperson->HR_LNAME}}</option>                                      
                              @endif
                                
                            @endforeach                         
                    </select>
                      


            </div>

            <div class="col-lg-2" style="text-align: left">
                การติดตาม :
            </div>
            <div class="col-lg-4" style="text-align: left">
                <select name="PRO_SUB_FOLLOW" id="PRO_SUB_FOLLOW" class="form-control input-sm js-example-basic-single teamunit"  style=" font-family: 'Kanit', sans-serif;">   
                    <option value="">กรุณาเลือกการติดตาม</option>                         
                            @foreach ($infotrackings as $infotracking)      
                                @if($infotracking->PLAN_TRACKING_ID == $infoprojectsub->PRO_SUB_FOLLOW )
                                    <option value="{{ $infotracking->PLAN_TRACKING_ID  }}" selected>{{ $infotracking->PLAN_TRACKING_NAME}}</option>                                      
                                @else
                                    <option value="{{ $infotracking->PLAN_TRACKING_ID  }}">{{ $infotracking->PLAN_TRACKING_NAME}}</option>                                      
                                @endif
                             
                            
                            @endforeach                         
                </select>
            </div>
        </div>

     
       </div>
       <br>
 
     

       <div class="row push">
        <div class="col-lg-12">
                <!-- Block Tabs Default Style -->
                <div class="block block-rounded block-bordered">
                    <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #adabfd;">
                       
                        <li class="nav-item">
                         <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">หลักการและเหตุผล</a>  
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">วัตถุประสงค์เชิงยุทธศาสตร์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ตัวชี้วัด (KPI)</a>  
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ค่าเป้าหมาย</a>  
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">กิจกรรมและงบประมาณ</a>  
                        </li>
                           <li class="nav-item">
                            <a class="nav-link" href="#object6" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">หน่วยงานรับผิดชอบหลัก</a>  
                           </li>
                           <li class="nav-item">
                            <a class="nav-link" href="#object7" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ผู้จัดทำโครงการ</a>  
                           </li>
                           <li class="nav-item">
                            <a class="nav-link" href="#object8" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ผู้เสนอโครงการ</a>  
                           </li>
                           <li class="nav-item">
                            <a class="nav-link" href="#object9" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ผู้เห็นชอบโครงการ</a>  
                           </li>
                           <li class="nav-item">
                            <a class="nav-link" href="#object10" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ผู้อนุมัติโครงการ</a>  
                           </li>
                      
                    </ul>
        <div class="block-content tab-content">
       
                        <div class="tab-pane active" id="object1" role="tabpanel">
                            <textarea id="PRO_SUB_DETAIL" name="PRO_SUB_DETAIL" class="form-control input-sm" rows="10" cols="50">{{$infoprojectsub->PRO_SUB_DETAIL}}</textarea>
                            <br>  <br>
                        </div>

                        <div class="tab-pane" id="object2" role="tabpanel">
                      
                         
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                              <thead style="background-color: #c3dff8;">
                                 <tr>
                                 <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">วัตถุประสงค์เชิงยุทธศาสตร์</td>

                                 <td style="text-align: center;" width="5%">
                                    <a  class="btn btn-success addRow1" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                </td> 
                             
                                 </tr>
                             </thead>
                             
                             <tbody class="tbody1">

                                <?php $check1 = 0; ?>
                                @foreach ($infoobjs as $infoobj)  
                                    <tr>
                                            <td> <input name="PRO_SUBOBJ_NAME[]" id="PRO_SUBOBJ_NAME{{$check1}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" value="{{$infoobj->PRO_SUBOBJ_NAME}}" ></td>
                                            <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                <?php $check1++; ?>
                                @endforeach 

                            </tbody>

                        </table>


                        </div>
                        <div class="tab-pane" id="object3" role="tabpanel">
                        
                             
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                  <thead style="background-color: #c3dff8;">
                                     <tr>
                                     <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">ตัวชี้วัด (KPI) ประเด็นยุทธศาสตร์ / เป้าประสงค์</td>
    
                                     <td style="text-align: center;" width="5%">
                                        <a  class="btn btn-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                    </td> 
                                 
                                     </tr>
                                 </thead>
                                 
                                 <tbody class="tbody2">
                                    <?php $check2 = 0; ?>
                                    @foreach ($infokpis as $infokpi)  

                                            <tr>
                                                <td> <input name="PRO_SUBKPI_NAME[]" id="PRO_SUBKPI_NAME{{$check2}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" value="{{$infokpi->PRO_SUBKPI_NAME}}"></td>
                                                <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                            </tr>
                                    <?php $check2++; ?>
                                    @endforeach 
                                </tbody>
    
                            </table>
                        </div>
                        <div class="tab-pane" id="object4" role="tabpanel">
                        
                             
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                  <thead style="background-color: #c3dff8;">
                                     <tr>
                                     <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">ค่าเป้าหมาย</td>
    
                                     <td style="text-align: center;" width="5%">
                                        <a  class="btn btn-success addRow3" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                    </td> 
                                 
                                     </tr>
                                 </thead>
                                 
                                 <tbody class="tbody3">
                                    <?php $check3 = 0; ?>
                                    @foreach ($infotars as $infotar)  
                                    <tr>
                                        <td> <input name="PRO_SUBTAR_NAME[]" id="PRO_SUBTAR_NAME{{$check3}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" value="{{$infotar->PRO_SUBTAR_NAME}}"></td>
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $check3++; ?>
                                    @endforeach 
                                </tbody>
    
                            </table>
                        </div>
                        <div class="tab-pane" id="object5" role="tabpanel">
                       
                             
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                  <thead style="background-color: #c3dff8;">
                                     <tr>
                                     <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">ชื่อกิจกรรม</td>
                                     <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">งบประมาณ</td>
                                     <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">รหัส</td>
                                     <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">ผู้รับผิดชอบ</td>
                                     <td style="text-align: center;" width="5%">
                                        <a  class="btn btn-success addRow4" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                    </td> 
                                 
                                     </tr>
                                 </thead>
                                 
                                 <tbody class="tbody4">

                                    <?php $check4 = 0; ?>
                                    @foreach ($infoacts as $infoact)  
                                    <tr>
                                            <td><input name="PRO_SUBACTIVITY_NAME[]" id="PRO_SUBACTIVITY_NAME{{$check4}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" value="{{$infoact->PRO_SUBACTIVITY_NAME}}" ></td>
                                            <td><input name="PRO_SUBACTIVITY_AMOUNT[]" id="PRO_SUBACTIVITY_AMOUNT{{$check4}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" value="{{$infoact->PRO_SUBACTIVITY_AMOUNT}}"></td>
                                            <td><input name="PRO_SUBACTIVITY_CODE[]" id="PRO_SUBACTIVITY_CODE{{$check4}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" value="{{$infoact->PRO_SUBACTIVITY_CODE}}"></td>
                                            <td>
                                                
                                                <select name="PRO_SUBACTIVITY_HR[]" id="PRO_SUBACTIVITY_HR{{$check4}}" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                                                    <option value="">--กรุณาเลือก--</option>
                                                        @foreach ($infopersons as $infoperson) 
                                                             @if($infoperson->ID == $infoact->PRO_SUBACTIVITY_HR )
                                                            <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>                                                                                                   
                                                             @else
                                                             <option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>                                                                                                   
                                                             @endif
                                                            
                                                       
                                                         @endforeach 
                                                </select>    
                                            
                                            </td>
                                            <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>

                                    <?php $check4++; ?>
                                    @endforeach 
                                </tbody>
    
                            </table>
                        </div>
                        <div class="tab-pane" id="object6" role="tabpanel">
                     
                             
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                  <thead style="background-color: #c3dff8;">
                                     <tr>
                                     <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">หน่วยงานรับผิดชอบหลัก</td>
    
                                     <td style="text-align: center;" width="5%">
                                        <a  class="btn btn-success addRow5" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                    </td> 
                                 
                                     </tr>
                                 </thead>
                                 
                                 <tbody class="tbody5">

                                    <?php $check5 = 0; ?>
                                    @foreach ($infodeps as $infodep)  
                                    <tr>
                                        <td> 
                                            <select name="PRO_SUBDEP_IDDEP[]" id="PRO_SUBDEP_IDDEP{{$check5}}" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                                                <option value="">--กรุณาเลือก--</option>
                                                    @foreach ($infodepsubsubs as $infodepsubsub) 
                                                        @if($infodepsubsub ->HR_DEPARTMENT_SUB_SUB_ID == $infodep->PRO_SUBDEP_IDDEP)
                                                        <option value="{{ $infodepsubsub ->HR_DEPARTMENT_SUB_SUB_ID  }}" selected>{{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_NAME}}</option>                                                                                                   
                                                        @else
                                                        <option value="{{ $infodepsubsub ->HR_DEPARTMENT_SUB_SUB_ID  }}">{{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_NAME}}</option>  
                                                        @endif
                                                    
                                                    @endforeach 
                                            </select>    
                                        
                                        </td>

                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>

                                    </tr>
                                    <?php $check5++; ?>
                                    @endforeach 
                                </tbody>
    
                            </table>
                        </div>
                        <div class="tab-pane" id="object7" role="tabpanel">
                    
                             
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                  <thead style="background-color: #c3dff8;">
                                     <tr>
                                     <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">ผู้จัดทำโครงการ</td>
                                     <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;width: 30%;">ตำแหน่ง</td>
                                     <td style="text-align: center;" width="5%">
                                        <a  class="btn btn-success addRow6" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                    </td> 
                                 
                                     </tr>
                                 </thead>
                                 
                                 <tbody class="tbody6">
                                    <?php $check6 = 0; ?>
                                    @foreach ($infoorgs as $infoorg)  
                                    <tr>
                                            <td> 
                                                <select name="PRO_SUBORGANIZER_HR_ID[]" id="PRO_SUBORGANIZER_HR_ID{{$check6}}" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition_org(0);">
                                                    <option value="">--กรุณาเลือก--</option>
                                                        @foreach ($infopersons as $infoperson) 
                                                            @if($infoperson ->ID == $infoorg->PRO_SUBORGANIZER_HR_ID)
                                                            <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                            @else
                                                            <option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                           @endif
                                                        @endforeach 
                                                </select>    
                                            </td>                                   
                                            <td class="text-pedding"><div class="showpositionorg{{$check6}}">{{$infoorg->PRO_SUBORGANIZER_HR_POSITION}}</div></td>
                                            <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $check6++; ?>
                                    @endforeach 
                                </tbody>
    
                            </table>
                        </div>
                        <div class="tab-pane" id="object8" role="tabpanel">
                  
                             
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                  <thead style="background-color: #c3dff8;">
                                     <tr>
                                        <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">ผู้เสนอโครงการ</td>
                                        <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;width: 30%;">ตำแหน่ง</td>
    
                                        <td style="text-align: center;" width="5%">
                                            <a  class="btn btn-success addRow7" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                        </td> 
                                 
                                     </tr>
                                 </thead>
                                 
                                 <tbody class="tbody7">
                                    <?php $check7 = 0; ?>
                                    @foreach ($infopres as $infopre)  
                                    <tr>
                                        <td> 

                                            <select name="PRO_SUBPRE_HR_ID[]" id="PRO_SUBPRE_HR_ID{{$check7}}" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition_pre(0);">
                                                <option value="">--กรุณาเลือก--</option>
                                                    @foreach ($infopersons as $infoperson) 
                                                     @if($infoperson ->ID ==  $infopre->PRO_SUBPRE_HR_ID)
                                                        <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                     @else
                                                        <option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                    @endif
                                                      @endforeach 
                                            </select>    
                                        
                                        </td>
                                        <td class="text-pedding"><div class="showpositionpre{{$check7}}">{{$infopre->PRO_SUBPRE_POSITION}}</div></td>
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $check7++; ?>
                                    @endforeach 
                                </tbody>
    
                            </table>
                        </div>
                        <div class="tab-pane" id="object9" role="tabpanel">
                       
                             
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                  <thead style="background-color: #c3dff8;">
                                     <tr>
                                        <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">ผู้เห็นชอบโครงการ</td>
                                        <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;width: 30%;">ตำแหน่ง</td>
    
                                        <td style="text-align: center;" width="5%">
                                            <a  class="btn btn-success addRow8" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                        </td> 
                                 
                                     </tr>
                                 </thead>
                                 
                                 <tbody class="tbody8">
                                    <?php $check8 = 0; ?>
                                    @foreach ($infoapps as $infoapp) 
                                    <tr>
                                        <td> 
                                            <select name="PRO_SUBAPP_HR_ID[]" id="PRO_SUBAPP_HR_ID{{$check8}}" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition_app(0);">
                                                <option value="">--กรุณาเลือก--</option>
                                                    @foreach ($infopersons as $infoperson) 
                                                       @if($infoperson ->ID == $infoapp->PRO_SUBAPP_HR_ID)
                                                            <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                       @else
                                                            <option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                       @endif
                                                       
                                                   
                                                    @endforeach 
                                            </select>    
                                        
                                        </td>
                                        <td class="text-pedding"><div class="showpositionapp{{$check8}}">{{$infoapp->PRO_SUBAPP_POSITION}}</div></td>
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $check8++; ?>
                                    @endforeach 
                                </tbody>
    
                            </table>
                        </div>
                        <div class="tab-pane" id="object10" role="tabpanel">
                       
                             
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                  <thead style="background-color: #c3dff8;">
                                     <tr>
                                        <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;">ผู้อนุมัติโครงการ</td>
                                        <td style="text-align:font-family: 'Kanit', sans-serif; font-size: 14px; text-align:center;width: 30%;" >ตำแหน่ง</td>
    
    
                                        <td style="text-align: center;" width="5%">
                                            <a  class="btn btn-success addRow9" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                        </td> 
                                 
                                     </tr>
                                 </thead>
                                 
                                 <tbody class="tbody9">
                                    <?php $check9 = 0; ?>
                                    @foreach ($infolastapps as $infolastapp) 
                                    <tr>   
                                        <td> 
                                            <select name="PRO_SUBLASTAPP_HR_ID[]" id="PRO_SUBLASTAPP_HR_ID{{$check9}}" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition_last(0);">
                                                <option value="">--กรุณาเลือก--</option>
                                                    @foreach ($infopersons as $infoperson) 
                                                       @if($infoperson->ID == $infolastapp->PRO_SUBLASTAPP_HR_ID)
                                                       <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                       @else
                                                        <option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                       @endif
                                                    @endforeach 
                                            </select>    
                                        
                                        </td>
                                        <td class="text-pedding"><div class="showpositionlast{{$check9}}">{{$infolastapp->PRO_SUBLASTAPP_POSITION}}</div></td>
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $check9++; ?>
                                    @endforeach 
                                </tbody>
    
                            </table>
                        </div>
        </div>
 




        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info f-kanit" ><i class="fas fa-save mr-2"></i>บันทึก</button>
        <a href="{{ url('manager_plan/project_plan_sub/1')  }}" class="btn btn-hero-sm btn-hero-danger f-kanit" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

       
        </div>
        </form>  

            
        



        </div>
    </div>    
</div>

  
@endsection

@section('footer')

      

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script >
$(document).ready(function() {
    $('select').select2({
        width: '100%' 
    });
    });





    $('.addRow1').on('click',function(){
        addRow1();
    });

    function addRow1(){
    var count = $('.tbody1').children('tr').length;
        var tr =   '<tr>'+
        ' <td> <input name="PRO_SUBOBJ_NAME[]" id="PRO_SUBOBJ_NAME'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" ></td>'+
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});



$('.addRow2').on('click',function(){
    addRow2();
    });

    function addRow2(){
    var count = $('.tbody2').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
        '<input name="PRO_SUBKPI_NAME[]" id="PRO_SUBKPI_NAME'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
        '</td>'+
  
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody2').append(tr);
    };

    $('.tbody2').on('click','.remove', function(){
        $(this).parent().parent().remove();
});





$('.addRow3').on('click',function(){
    addRow3();
    });

    function addRow3(){
    var count = $('.tbody3').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
        '<input name="PRO_SUBTAR_NAME[]" id="PRO_SUBTAR_NAME'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
        '</td>'+
  
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody3').append(tr);
    };

    $('.tbody3').on('click','.remove', function(){
        $(this).parent().parent().remove();
});




$('.addRow4').on('click',function(){
    addRow4();
    $('select').select2({ width: '100%' });
    });

    function addRow4(){
    var count = $('.tbody4').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
        '<input name="PRO_SUBACTIVITY_NAME[]" id="PRO_SUBACTIVITY_NAME'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
        '</td>'+
        '<td>'+
        '<input name="PRO_SUBACTIVITY_AMOUNT[]" id="PRO_SUBACTIVITY_AMOUNT'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
        '</td>'+
        '<td>'+
        '<input name="PRO_SUBACTIVITY_CODE[]" id="PRO_SUBACTIVITY_CODE'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
        '</td>'+
        '<td>'+
        '<select name="PRO_SUBACTIVITY_HR[]" id="PRO_SUBACTIVITY_HR'+count+'" class="form-control input-lg js-example-basic-single" style=" font-family: \'Kanit\', sans-serif;" >'+
            '<option value="">--กรุณาเลือก--</option>'+
            '@foreach ($infopersons as $infoperson)'+ 
            '<option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>'+                                                                                                   
            '@endforeach'+ 
            '</select>'+ 
        
        
        '</td>'+
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody4').append(tr);
    };

    $('.tbody4').on('click','.remove', function(){
        $(this).parent().parent().remove();
});



$('.addRow5').on('click',function(){
    addRow5();
    $('select').select2({ width: '100%' });
    });

    function addRow5(){
    var count = $('.tbody5').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
            '<select name="PRO_SUBDEP_IDDEP[]" id="PRO_SUBDEP_IDDEP'+count+'" class="form-control input-lg js-example-basic-single" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="">--กรุณาเลือก--</option>'+
                '@foreach ($infodepsubsubs as $infodepsubsub)'+ 
                    '<option value="{{ $infodepsubsub ->HR_DEPARTMENT_SUB_SUB_ID  }}">{{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_NAME}}</option>'+                                                                                                   
                 '@endforeach'+ 
                '</select>'+    
        '</td>'+
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody5').append(tr);
    };

    $('.tbody5').on('click','.remove', function(){
        $(this).parent().parent().remove();
});




$('.addRow6').on('click',function(){
    addRow6();
    $('select').select2({ width: '100%' });
    });

    function addRow6(){
    var count = $('.tbody6').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
            '<select name="PRO_SUBORGANIZER_HR_ID[]" id="PRO_SUBORGANIZER_HR_ID'+count+'" class="form-control input-lg js-example-basic-single" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition_org('+count+');">'+
                '<option value="">--กรุณาเลือก--</option>'+
                '@foreach ($infopersons as $infoperson)'+ 
                '<option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>'+
                '@endforeach'+ 
                '</select>'+
        '</td>'+
       
        '<td class="text-pedding"><div class="showpositionorg'+count+'"></div></td>'+
     
     
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody6').append(tr);
    };

    $('.tbody6').on('click','.remove', function(){
        $(this).parent().parent().remove();
});




$('.addRow7').on('click',function(){
    addRow7();
    $('select').select2({ width: '100%' });
    });

    function addRow7(){
    var count = $('.tbody7').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
        '<select name="PRO_SUBPRE_HR_ID[]" id="PRO_SUBPRE_HR_ID'+count+'" class="form-control input-lg js-example-basic-single" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition_pre('+count+');">'+
        '<option value="">--กรุณาเลือก--</option>'+
        '@foreach ($infopersons as $infoperson)'+ 
        '<option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>'+
        '@endforeach'+ 
        '</select>'+    
        '</td>'+
       
        '<td class="text-pedding"><div class="showpositionpre'+count+'"></div></td>'+
       
     
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody7').append(tr);
    };

    $('.tbody7').on('click','.remove', function(){
        $(this).parent().parent().remove();
});





$('.addRow8').on('click',function(){
    addRow8();
    $('select').select2({ width: '100%' });
    });

    function addRow8(){
    var count = $('.tbody8').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
        '<select name="PRO_SUBAPP_HR_ID[]" id="PRO_SUBAPP_HR_ID'+count+'" class="form-control input-lg js-example-basic-single" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition_app('+count+');">'+
        '<option value="">--กรุณาเลือก--</option>'+
        '@foreach ($infopersons as $infoperson)'+ 
        '<option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>'+
        '@endforeach'+ 
        '</select>'+    
        '</td>'+
      
            '<td class="text-pedding"><div class="showpositionapp'+count+'"></div></td>'+
      
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody8').append(tr);
    };

    $('.tbody8').on('click','.remove', function(){
        $(this).parent().parent().remove();
});



$('.addRow9').on('click',function(){
    addRow9();
    $('select').select2({ width: '100%' });
    });

    function addRow9(){
    var count = $('.tbody9').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
            '<select name="PRO_SUBLASTAPP_HR_ID[]" id="PRO_SUBLASTAPP_HR_ID'+count+'" class="form-control input-lg js-example-basic-single" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition_last('+count+');">'+
                '<option value="">--กรุณาเลือก--</option>'+
                '@foreach ($infopersons as $infoperson)'+ 
                '<option value="{{ $infoperson ->ID  }}">{{ $infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>'+
                '@endforeach'+ 
                '</select>'+    
        '</td>'+
      
            '<td class="text-pedding"><div class="showpositionlast'+count+'"></div></td>'+
      
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody9').append(tr);
    };

    $('.tbody9').on('click','.remove', function(){
        $(this).parent().parent().remove();
});



//======================หาตำแหน่งบุคคล===========================

function checkposition_org(number){
      var PERSON_ID=document.getElementById("PRO_SUBORGANIZER_HR_ID"+number).value;


      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mplan.checkpositioninfo')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showpositionorg'+number).html(result);
                   }
           })     
  }


function checkposition_pre(number){
      var PERSON_ID=document.getElementById("PRO_SUBPRE_HR_ID"+number).value;
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mplan.checkpositioninfo')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showpositionpre'+number).html(result);
                   }
           })     
  }


  function checkposition_app(number){
      var PERSON_ID=document.getElementById("PRO_SUBAPP_HR_ID"+number).value;
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mplan.checkpositioninfo')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showpositionapp'+number).html(result);
                   }
           })     
  }



  function checkposition_last(number){
      var PERSON_ID=document.getElementById("PRO_SUBLASTAPP_HR_ID"+number).value;
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mplan.checkpositioninfo')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showpositionlast'+number).html(result);
                   }
           })     
  }




  function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}

</script>

@endsection