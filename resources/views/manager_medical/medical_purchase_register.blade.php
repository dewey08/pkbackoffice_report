@extends('layouts.medical')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
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


use App\Http\Controllers\ManagersuppliesController;

?>
<?php    
  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

?>  
<body onload="checktheboardcon()"></body>
<center>    
    <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">
                <div align="left">

                <form  method="post" action="{{ route('mmedical.medical_purchaseregister_save') }}" enctype="multipart/form-data">
                @csrf
            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                <div class="col-sm-2">
                ออกทะเบียนคุม 
                </div>
                <div class="col-sm-2">
                <input name="CON_NUM" id="CON_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$maxnumberuse}}" required>
                </div>
               
                <div class="col-sm-1">
            <label>ปีงบประมาณ :</label>
        </div> 
        <div class="col-lg-1"> 
        <label>{{$yearbudget}}</label>
        <input type="hidden" name="CON_YEAR_ID" id="CON_YEAR_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$yearbudget}}" required>       
           
        </div>

        <div class="col-sm-1">
            <label>ลงวันที่ :</label>
        </div> 
        <div class="col-lg-2">        
        <input name="DATE_REGIS" id="DATE_REGIS" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}"  onchange="amountdate();" readonly>
        </div>

       
               
              
               </div>
                </h2> 
                
        
      
        <input type="hidden" name="REGIS_BY_ID" id="REGIS_BY_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
        
        <div class="detali_ref">

        <div class="row push">
        <div class="col-sm-2">
        <label>อ้างอิงทะเบียนขอซื้อ/จ้าง :</label>
        </div> 
        <div class="col-lg-4">
        <input type="hidden" name="REQUEST_ID" id="REQUEST_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$REQUEST_ID}}" >
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$REQUEST_NAME}}" readonly >
        </div>
        <div class="col-lg-1">
        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addref" >เลือก</button>
        </div>  
       
        <div class="col-sm-1">
        <label>เลขที่หนังสือ :</label>
        </div> 
        <div class="col-lg-4">
        <input name="DEP_REQUEST_BOOK" id="DEP_REQUEST_BOOK" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$maxnumberuse}}" required>
        </div>

        </div>

        <div class="row push">
        <div class="col-sm-2">
        <label>หน่วยงาน :</label>
        </div> 
        <div class="col-lg-5">
                        <select name="DEP_REQUEST_ID" id="DEP_REQUEST_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                                         <option value="" selected>--กรุณาเลือกหน่วยงาน--</option>
                                         @foreach ($departmentsubsubs as $departmentsubsub) 
                                                  @if($departmentsubsub -> HR_DEPARTMENT_SUB_SUB_ID == $DEP_REQUEST_ID )
                                                  <option value="{{ $departmentsubsub -> HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{ $departmentsubsub -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>           
                                                  @else
                                                  <option value="{{ $departmentsubsub -> HR_DEPARTMENT_SUB_SUB_ID }}">{{ $departmentsubsub -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>           
                                                  @endif                   
                                                      
                                        @endforeach  
                                         
                         </select> 
        </div>
   
        <div class="col-sm-1">
            <label>ผู้ร้องขอ :</label>
        </div> 
        <div class="col-lg-4">        
        <select name="PERSON_REQUEST_ID" id="PERSON_REQUEST_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                                         <option value="" selected>--กรุณาเลือกผู้ร้องขอ-</option>
                                         @foreach ($pessonalls as $pessonall)  
                                                 @if( $pessonall -> ID  == $PERSON_REQUEST_ID )                  
                                                        <option value="{{ $pessonall -> ID }}" selected>{{ $pessonall -> HR_FNAME }} {{ $pessonall -> HR_LNAME }}</option>           
                                                        @else
                                                        <option value="{{ $pessonall -> ID }}">{{ $pessonall -> HR_FNAME }} {{ $pessonall -> HR_LNAME }}</option>                   
                                                  @endif      
                                       
                                       
                                        @endforeach  

                         </select> 
        </div>

        </div>

        </div>




        <div class="row push">
                    <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                   
                                    <li class="nav-item">
                                     <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บันทึกข้อความ</a>  
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">วิธีการซื้อ/จ้าง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">แผนงานโครงการ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">คำสั่ง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ผู้อนุมัติเห็นชอบ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object6" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">กก. ตรวจรับ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object7" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">กก. กำหนดรายละเอียด</a>
                                    </li>
 
                                </ul>
                    <div class="block-content tab-content">
                   
                                    <div class="tab-pane active" id="object1" role="tabpanel">

                                            <div class="row push">
                                                <div class="col-sm-2">
                                                <label>ส่วนราชการ :</label>
                                                </div> 
                                                <div class="col-lg-10">
                                                <input name="ORG_ADD" id="ORG_ADD" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliespurchase->PURCHASE_GOV}}">
                                                </div>
                                            </div>
                                            <div class="row push">
                                                <div class="col-sm-2">
                                                <label>ปฏิบัติราชการแทน :</label>
                                                </div> 
                                                <div class="col-lg-10">
                                                <input name="ORG_PROVINCE" id="ORG_PROVINCE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliespurchase->PURCHASE_SUBROGATE}}">
                                                </div>
                                            </div>
                                            <div class="row push">
                                                <div class="col-sm-2">
                                                <label>คำสั่งจังหวัดเลขที่ :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                                <input name="ORG_CMD_PROVINCE" id="ORG_CMD_PROVINCE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliespurchase->PURCHASE_CMD_PROVINCE}}">
                                                </div>
                                                <div class="col-sm-1">
                                                <label>ลงวันที่ :</label>
                                                </div> 
                                                <div class="col-lg-5">
                                                <input name="ORG_CMD_DATE" id="ORG_CMD_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;"  readonly>
                                                </div>
                                            </div>


                                            <div class="row push">
                                                <div class="col-sm-2">
                                                <label>หนังสือเรียน :</label>
                                                </div> 
                                                <div class="col-lg-10">
                                                <input name="ORG_PROVINCE_LEADER" id="ORG_PROVINCE_LEADER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliespurchase->PURCHASE_NOTIFY}}">
                                                </div>
                                            </div>
                                    </div>

                                    <div class="tab-pane" id="object2" role="tabpanel">
                                    
                                           <div class="row push">
                                                <div class="col-sm-2">
                                                <label>วิธีซื้อหรือจ้าง :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                              
                                                <select name="BUY_ID" id="BUY_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                                                    <option value="" selected>--กรุณาเลือกวิธีซื้อ--</option>
                                                    @foreach ($suppliesbuys as $suppliesbuy)             
                                                                @if($medicalsetup->SETUP_BUY_ID == $suppliesbuy->BUY_ID && $medicalsetup->USE_INFO == 'use' )
                                                                    <option value="{{ $suppliesbuy -> BUY_ID }}" selected>{{ $suppliesbuy -> BUY_NAME }}</option>  
                                                                @else
                                                                    <option value="{{ $suppliesbuy -> BUY_ID }}">{{ $suppliesbuy -> BUY_NAME }}</option>    
                                                                @endif   
                                                                    
                                                    @endforeach  

                                                </select> 
                                                
                                                
                                                </div>
                                                <div class="col-sm-2">
                                                <label>เงื่อนไข :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                                  
                                                <select name="CONDISION_ID" id="CONDISION_ID" class="form-control input-sm condition" style=" font-family: 'Kanit', sans-serif;" required>
                                                    <option value="" selected>--กรุณาเลือกเงื่อนไข--</option>
                                                    @foreach ($suppliescondisions as $suppliescondision)                    
                                                        @if($medicalsetup->SETUP_CONDISION_ID == $suppliescondision->CONDISION_ID && $medicalsetup->USE_INFO == 'use' )
                                                            <option value="{{ $suppliescondision -> CONDISION_ID }}" selected>{{ $suppliescondision -> CONDISION_NAME }}</option>           
                                                        @else
                                                            <option value="{{ $suppliescondision -> CONDISION_ID }}">{{ $suppliescondision -> CONDISION_NAME }}</option>           
                                                        @endif
                                                    @endforeach  

                                                </select> 

                                                </div>
                                            </div>

                                            <div class="row push">

                                            <div class="col-sm-2">
                                                    <label>เหตุผลการจัดหา :</label>
                                            </div>         
                                            <div class="col-lg-10">       
                                                @if($medicalsetup->USE_INFO == 'use' ) 
                                                    <textarea name="CONDISION_RESION" id="CONDISION_RESION" class="form-control reason" rows="2" id="comment">{{$medicalsetup->SETUP_CONDISION_RESION}}</textarea>
                                                @else
                                                    <textarea name="CONDISION_RESION" id="CONDISION_RESION" class="form-control reason" rows="2" id="comment"></textarea>
                                                @endif
                                        
                                        </div>

                                            </div>
                                            <div class="row push">
                                                <div class="col-sm-2">
                                                <label>วิธีจัดหา :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                               
                                                <select name="METHOD_ID" id="METHOD_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                                                    <option value="" selected>--กรุณาเลือกวิธีจัดหา--</option>
                                                    @foreach ($suppliesmethods as $suppliesmethod)  
                                                    @if($medicalsetup->SETUP_METHOD_ID == $suppliesmethod->METHOD_ID && $medicalsetup->USE_INFO == 'use' )
                                                        <option value="{{ $suppliesmethod -> METHOD_ID }}" selected>{{ $suppliesmethod -> METHOD_NAME }}</option>           
                                                        @else
                                                        <option value="{{ $suppliesmethod -> METHOD_ID }}">{{ $suppliesmethod -> METHOD_NAME }}</option>           
                                                        @endif
                                                    @endforeach  
                                                </select> 
                                                
                                                </div>
                                                <div class="col-sm-2">
                                                <label>ประเภทจัดหา :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                                <select name="SUP_TYPE_ID" id="SUP_TYPE_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                                                    <option value="" selected>--กรุณาเลือกประเภท--</option>
                                                    @foreach ($suppliestypes as $suppliestype)                    
                                                    @if($medicalsetup->SETUP_SUP_TYPE_ID== $suppliestype->SUP_TYPE_ID && $medicalsetup->USE_INFO == 'use' )
                                                        <option value="{{ $suppliestype -> SUP_TYPE_ID }}" selected>{{ $suppliestype -> SUP_TYPE_NAME }}</option>           
                                                        @else
                                                        <option value="{{ $suppliestype -> SUP_TYPE_ID }}">{{ $suppliestype -> SUP_TYPE_NAME }}</option>           
                                                        @endif
                                                        

                                                        @endforeach  
                                                </select> 
                    
                                                </div>
                                            </div>

                                            <div class="row push">

                                            <div class="col-sm-2">
                                                    <label>รายละเอียดพัสดุ :</label>
                                            </div>         
                                            <div class="col-lg-10">  
                                                @if($medicalsetup->USE_INFO == 'use' )
                                                    <input name="CON_DETAIL" id="CON_DETAIL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$medicalsetup->SETUP_CON_DETAIL}}">
                                                @else
                                                    <input name="CON_DETAIL" id="CON_DETAIL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="">
                                                @endif
                                             </div>

                                            </div>

                                            <div class="row push">
                                                <div class="col-sm-2">
                                                <label>การพิจารณา :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                             
                                                <select name="ASPECT_ID" id="ASPECT_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                    <option value="" selected>--กรุณาเลือกการพิจารณา--</option>
                                                    @foreach ($suppliesaspects as $suppliesaspect)  

                                                        @if($medicalsetup->SETUP_ASPECT_ID== $suppliesaspect->ASPECT_ID  && $medicalsetup->USE_INFO == 'use' )
                                                                <option value="{{ $suppliesaspect->ASPECT_ID }}" selected>{{ $suppliesaspect->ASPECT_NAME }}</option> 
                                                        @else    
                                                                <option value="{{ $suppliesaspect->ASPECT_ID }}">{{ $suppliesaspect->ASPECT_NAME }}</option>           
                                                        @endif 

                                                    @endforeach  
                                                </select> 
                    
                                               
                                                </div>
                                                <div class="col-sm-1">
                                                <label>วันที่ต้องการ :</label>
                                                </div> 
                                                <div class="col-lg-2">
                                                    @if($medicalsetup->USE_INFO == 'use' )
                                                        <input name="DATE_WANT_USE" id="DATE_WANT_USE" value="{{formate($medicalsetup->SETUP_DATE_WANT_USE)}}" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" onchange="amountdate();"  readonly required>
                                                     @else
                                                        <input name="DATE_WANT_USE" id="DATE_WANT_USE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" onchange="amountdate();"  readonly required>
                                                     @endif
                                                </div>
                                                <div class="col-sm-1">
                                                <label>ประมาณ :</label>
                                                </div> 
                                                <div class="col-lg-1 amountdateuse">
                                                    @if($medicalsetup->USE_INFO == 'use' )
                                                        <input name="DATE_WANT_COUNT" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$medicalsetup->SETUP_DATE_WANT_COUNT}}">
                                                    @else
                                                        <input name="DATE_WANT_COUNT" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="0">
                                                    @endif
                                                </div>
                                                <div class="col-lg-1">
                                                <label>วัน</label>
                                                </div>
                                            </div>

                                            <div class="row push">

                                            <div class="col-sm-2">
                                                    <label>เหตุผลความจำเป็น :</label>
                                            </div>         
                                            <div class="col-lg-10">  
                                                @if($medicalsetup->USE_INFO == 'use' )
                                                    <textarea name="RESON_NAME" id="RESON_NAME" class="form-control" rows="2" id="comment">{{$medicalsetup->SETUP_RESON_NAME}}</textarea>
                                                @else
                                                    <textarea name="RESON_NAME" id="RESON_NAME" class="form-control" rows="2" id="comment"></textarea>
                                                @endif
                                           
                                            </div>

                                            </div>

                                            <div class="row push">
                                                <div class="col-sm-2">
                                                <label>หมวดเงิน :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                               
                                                <select name="MONEY_GROUP_ID" id="MONEY_GROUP_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                                                    <option value="" >--กรุณาเลือกหมวดเงิน--</option>
                                                    @foreach ($suppliesmoneygroups as $suppliesmoneygroup)                    
                                                        @if($medicalsetup->SETUP_MONEY_GROUP_ID== $suppliesmoneygroup->MONEY_GROUP_ID  && $medicalsetup->USE_INFO == 'use' )
                                                            <option value="{{ $suppliesmoneygroup -> MONEY_GROUP_ID }}" selected>{{ $suppliesmoneygroup -> MONEY_GROUP_NAME }}</option>           
                                                        @else
                                                            <option value="{{ $suppliesmoneygroup -> MONEY_GROUP_ID }}">{{ $suppliesmoneygroup -> MONEY_GROUP_NAME }}</option>           
                                                        @endif
                                                    @endforeach  
                                                </select> 
                                                
                                                
                                                </div>
                                                <div class="col-sm-2">
                                                <label>ประเภทเงิน :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                               
                                                <select name="BUDGET_ID" id="BUDGET_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                                                    <option value="" >--กรุณาเลือกประเภทเงิน--</option>
                                                    @foreach ($suppliesbudgets as $suppliesbudget)                    
                                                        @if($medicalsetup->SETUP_BUDGET_ID== $suppliesbudget->BUDGET_ID  && $medicalsetup->USE_INFO == 'use' )
                                                            <option value="{{ $suppliesbudget -> BUDGET_ID }}" selected>{{ $suppliesbudget -> BUDGET_NAME }}</option>           
                                                        @else
                                                            <option value="{{ $suppliesbudget -> BUDGET_ID }}">{{ $suppliesbudget -> BUDGET_NAME }}</option> 
                                                        @endif
                                                    @endforeach  
                                                </select> 
                                                
                                                </div>
                                            </div>




      

                                    </div>

                                    <div class="tab-pane" id="object3" role="tabpanel">
                                    <div class="row push">
                                                <div class="col-sm-2">
                                                <label>โครงการเลขที่ :</label>
                                                </div> 
                                                <div class="col-lg-2">
                                                <input name="EGP_CODE" id="EGP_CODE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="">
                                                </div>
                                                <div class="col-sm-2">
                                                <label>ชื่อโครงการ :</label>
                                                </div> 
                                                <div class="col-lg-6">
                                                <input name="EGP_PLAN_NAME" id="EGP_PLAN_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="">
                                                </div>
                                           
                                    </div>

                                    <div class="row push">
                                                <div class="col-sm-2">
                                                <label>รหัสอ้างอิง EGP :</label>
                                                </div> 
                                                <div class="col-lg-2">
                                                <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="">
                                                </div>
                                                <div class="col-sm-2">
                                                <label>การเบิกจ่ายเงิน :</label>
                                                </div> 
                                                <div class="col-lg-6">
                                                <input name="EG_OPEN_TYPE_ID" id="EG_OPEN_TYPE_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="">
                                                </div>
                                    </div>
                                 

                                    <div class="row push">
                                                <div class="col-sm-2">
                                                <label>รายการแผน EGP :</label>
                                                </div> 
                                                <div class="col-lg-10">
                                                <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="">
                                                </div>
                                               
                                            </div>
                                    </div>

                                    <div class="tab-pane" id="object4" role="tabpanel">
                                    <div class="row push">

                                        <div class="col-sm-2">
                                        <label>ตามคำสั่ง :</label>
                                        </div> 
                                        <div class="col-lg-10 detali_bookname">
                                        <input type="hidden" name="BOOK_ID" id="BOOK_ID" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >
                                        <input name="COMMAND_DETAIL" id="COMMAND_DETAIL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                        </div> 
                                        <!--<div class="col-lg-2">
                                        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addbook"  >คำสั่งอ้างถึง</button>
                                        </div>--> 
                                        </div> 

                                        <div class="row push">
                                        <div class="col-sm-2">
                                        <label>เลขที่คำสั่ง:</label>
                                        </div> 
                                        <div class="col-lg-3 detali_booknum">
                                        <input name="COMMAND_NUMBER" id="COMMAND_NUMBER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                        </div> 
                                        <div class="col-sm-1">
                                        <label>ลงวันที่ :</label>

                                        </div>
                                        <div class="col-lg-2 detali_bookdate">
                                        <input name="COMMAND_DATE" id="COMMAND_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
                                        </div> 

                                        </div>
                                    </div>

                                    
                                    <div class="tab-pane" id="object5" role="tabpanel">

                                                                                    
                                                <div class="row push"> 

                                                    <div class="col-lg-2">
                                                    <label >ชื่อผู้อนุมัติจ่าย :</label>
                                                    </div> 
                                                    <div class="col-lg-6">   
                                                    
                                                    <select name="PURCHASE_LEADER_ID" id="PURCHASE_LEADER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                    <option value="">--กรุณาเลือกชื่อผู้อนุมัติจ่าย--</option>
                                                            @foreach ($infopersons as $infoperson)  
                                                                    @if($infosuppliespurchase->PURCHASE_LEADER_ID == $infoperson ->ID )
                                                                    <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                                                    @else
                                                                    <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                                                    @endif     
                                                                
                                                            @endforeach 
                                                    </select>
                                                
                                                    </div> 
                                                </div> 

                                                <div class="row push"> 
                                                
                                                    <div class="col-lg-2">

                                                    <label >เจ้าหน้าที่พัสดุ :</label>
                                                
                                                    </div> 
                                                    <div class="col-lg-6">

                                                
                                                    
                                                    <select name="PURCHASE_OFFICER_ID" id="PURCHASE_OFFICER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                    <option value="">--กรุณาเลือกชื่อเจ้าหน้าที่พัสดุ--</option>
                                                            @foreach ($infoofficers as $infoofficer)   
                                                            
                                                            @if($medicalsetup->SETUP_PURCHASE_OFFICER_ID== $infoofficer ->ID  && $medicalsetup->USE_INFO == 'use' )
                                                            <option value="{{ $infoofficer ->ID  }}" selected>{{ $infoofficer->HR_FNAME }} {{ $infoofficer->HR_LNAME }}</option> 
                                                            @else
                                                            <option value="{{ $infoofficer ->ID  }}">{{ $infoofficer->HR_FNAME }} {{ $infoofficer->HR_LNAME }}</option> 
                                                            @endif          
                                                            @endforeach 
                                                    </select>
                                                

                                                    </div> 
                                                </div> 


                                                <div class="row push"> 

                                                    <div class="col-lg-2">
                                                    
                                                    <label >หัวหน้าเจ้าหน้าที่ :</label>

                                                    </div> 
                                                    <div class="col-lg-6">

                                                
                                                    
                                                    <select name="PURCHASE_HEAD_ID" id="PURCHASE_HEAD_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                    <option value="">--กรุณาเลือกชื่อหัวหน้าเจ้าหน้า--</option>
                                                            @foreach ($infopersons as $infoperson)   
                                                                    @if($infosuppliespurchase->PURCHASE_HEAD_ID == $infoperson ->ID )
                                                                    <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                                                    @else
                                                                    <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                                                    @endif
                                                                
                                                            @endforeach 
                                                    </select>
                                                

                                                    </div> 
                                                </div> 
                                   

                                 

                                   
                                    </div>

                                    <div class="tab-pane" id="object6" role="tabpanel">
                                  
                                  
                                    <select name="THEBOARD" id="THEBOARD" class="form-control input-sm theboard"
                                        style=" font-family: 'Kanit', sans-serif;">
                                        <option value="" selected>--เลือกคณะกรรมการ--</option>
                                        @foreach ($suppliesconboardlists as $suppliesconboardlist)

                                            @if($medicalsetup->SETUP_THEBOARD== $suppliesconboardlist ->BOARD_GROUP_ID  && $medicalsetup->USE_INFO == 'use' )
                                                <option value="{{ $suppliesconboardlist ->BOARD_GROUP_ID  }}" selected>{{ $suppliesconboardlist-> BOARD_GROUP_NAME }}</option>
                                            @else
                                                <option value="{{ $suppliesconboardlist ->BOARD_GROUP_ID  }}">{{ $suppliesconboardlist-> BOARD_GROUP_NAME }}</option>
                                            @endif
                                            
                                        @endforeach

                                    </select>
                                    <br>
                                    <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                <thead style="background-color: #F0F8FF;">
                                            <tr height="40">
                                
                                            
                                                <td style="text-align: center;" width="10%">คณะกรรมการ</td>
                                                <td style="text-align: center;" width="10%">ตำแหน่ง</td>
                                            
                                                <td style="text-align: center;" width="5%">
                                                    <a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody class="tbody1 detailtheboard">
                                            <tr height="40">
                                                <td>

                                                    <select name="BOARD_HR_ID[]" id="BOARD_HR_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                                <option value="" selected>--กรุณาเลือก--</option>
                                                                @foreach ($infopersons as $infoperson)   
                                                              
                                                                <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                                               
                                                                
                                                                @endforeach 
                                                                
                                                    </select> 

                                                </td>
                                                <td>

                                                    <select name="SUP_POSITION_ID[]" id="SUP_POSITION_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                                    <option value="" selected>--กรุณาเลือก--</option>

                                                                    @foreach ($suppliespositions as $suppliesposition)   
                                                              
                                                              <option value="{{ $suppliesposition ->POSITION_ID  }}">{{ $suppliesposition-> POSITION_NAME }}</option> 
                                                             
                                                              
                                                              @endforeach 
                                                                
                                                    </select> 

                                                    </td>
                                         
                                                <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    </div>



                                    <div class="tab-pane" id="object7" role="tabpanel">
                                 
                                    <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                <thead style="background-color: #F0F8FF;">
                                            <tr height="40">
                                
                                            
                                                <td style="text-align: center;" width="10%">คณะกรรมการ</td>
                                                <td style="text-align: center;" width="10%">ตำแหน่ง</td>
                                            
                                                <td style="text-align: center;" width="5%">
                                                    <a  class="btn btn-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody class="tbody2">
                                            <tr height="40">
                                                <td>

                                                    <select name="BOARD_DETAIL_HR_ID[]" id="BOARD_DETAIL_HR_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                                <option value="" selected>--กรุณาเลือก--</option>
                                                                @foreach ($infopersons as $infoperson)   
                                                              
                                                                <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                                               
                                                                
                                                                @endforeach 
                                                                
                                                    </select> 

                                                </td>
                                                <td>

                                                    <select name="SUP_POSITION_DETAIL_ID[]" id="SUP_POSITION_DETAIL_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                                    <option value="" selected>--กรุณาเลือก--</option>

                                                                    @foreach ($suppliespositions as $suppliesposition)   
                                                              
                                                              <option value="{{ $suppliesposition ->POSITION_ID  }}">{{ $suppliesposition-> POSITION_NAME }}</option> 
                                                             
                                                              
                                                              @endforeach 
                                                                
                                                    </select> 

                                                    </td>
                                         
                                                <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    </div>

                    </div>
        
        </div>





     <br> 
        <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                    <a href="{{ url('manager_medical/purchase')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
            </div>
        </div>
    </form>  

   
    <!--    เมนูเลือก   -->
       
    <div class="modal fade addref" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalref">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">อ้างอิงทะเบียนขอซื้อ/จ้าง</h2>
                        </div>
                    <div class="modal-body">
                <body>
                    <div class="container mt-3">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <br>
                        <div style='overflow:scroll; height:300px;'>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td style="text-align: center;" width="20%">คำร้องเพื่อ</td>
                                    <td style="text-align: center;">เหตุผล</th>
                                    <td style="text-align: center;">หน่วยงานที่ร้องขอ</th> 
                                    <td style="text-align: center;">งบประมาณ</th>   
                                    <td style="text-align: center;" width="5%">เลือก</td>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                            
                            @foreach ($suppliesrequests as $suppliesrequest)

                            <?php $checkref =  ManagersuppliesController::checkref($suppliesrequest->ID); ?>

                               @if($checkref == 0)
                                    <tr>
                                        <td class="text-font text-pedding">{{$suppliesrequest->REQUEST_FOR}}</td>
                                        <td class="text-font text-pedding">{{$suppliesrequest->REQUEST_BUY_COMMENT}}</td>
                                        <td class="text-font text-pedding">{{$suppliesrequest->SAVE_HR_DEP_SUB_NAME}}</td>
                                        <td class="text-font text-pedding text-align: right;">{{number_format($suppliesrequest->BUDGET_SUM,5)}}</td>                       
                                        <td >
                                             <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"  onclick="selectrequest({{$suppliesrequest->ID}});">เลือก</button> 
                                            {{-- <button type="button" class="btn btn-hero-sm btn-hero-info"   >เลือก</button> --}}
                                        </td>
                                    </tr>
                                @endif
                  
                                  
                           
                                    @endforeach 
                            </tbody>
                        </table>    
                    </div>
                </div>
                </div>
                    <div class="modal-footer">
                        <div align="right">
                                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
                        </div>
                    </div>
                </body>
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
<script>

$(document).ready(function() {
    $('select').select2({
        width: '100%'
});
});

function amountdate(){

    var date1= document.getElementById("DATE_REGIS").value; 
    var date2= document.getElementById("DATE_WANT_USE").value; 
    

      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.amountdate')}}",
                   method:"GET",
                   data:{date1:date1,date2:date2,_token:_token},
                   success:function(result){
                    $('.amountdateuse').html(result);
                   }
           })
       
  };


$('.condition').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.condition')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.reason').html(result);
                     }
             })
      
             }        
     });


     

     $('.theboard').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.theboard')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.detailtheboard').html(result);
                     }
             })
      
             }        
     });



     function checktheboardcon(){
           
             var select= document.getElementById("THEBOARD").value; 
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.theboard')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.detailtheboard').html(result);
                     }
             })


             var select=document.getElementById("CONDISION_ID").value; 
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.condition')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.reason').html(result);
                     }
             })
      
                     
     }

function selectrequest(id){
      
    
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.selectrequest')}}",
                   method:"GET",
                   data:{id:id,_token:_token},
                   success:function(result){
                    $('.detali_ref').html(result);
                   }
           })

           $('#modalref').modal('hide');

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


$('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
        '<select name="BOARD_HR_ID[]" id="BOARD_HR_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
        '<option value="" selected>--กรุณาเลือก--</option>'+
        '@foreach ($infopersons as $infoperson)'+                          
        '<option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>'+                    
        '@endforeach'+                     
        '</select>'+ 
        '</td>'+
        ' <td>'+
        '<select name="SUP_POSITION_ID[]" id="SUP_POSITION_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
        '<option value="" selected>--กรุณาเลือก--</option>'+
        '@foreach ($suppliespositions as $suppliesposition)'+                      
        '<option value="{{ $suppliesposition ->POSITION_ID  }}">{{ $suppliesposition-> POSITION_NAME }}</option>'+                    
        '@endforeach'+                          
        '</select>'+ 
        '</td>'+
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});
//===============================



$('.addRow2').on('click',function(){
        addRow2();
    });

    function addRow2(){
    var count = $('.tbody2').children('tr').length;
        var tr =   '<tr>'+
        '<td>'+
        '<select name="BOARD_DETAIL_HR_ID[]" id="BOARD_DETAIL_HR_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
        '<option value="" selected>--กรุณาเลือก--</option>'+
        '@foreach ($infopersons as $infoperson)'+                          
        '<option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>'+                    
        '@endforeach'+                     
        '</select>'+ 
        '</td>'+
        ' <td>'+
        '<select name="SUP_POSITION_DETAIL_ID[]" id="SUP_POSITION_DETAIL_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
        '<option value="" selected>--กรุณาเลือก--</option>'+
        '@foreach ($suppliespositions as $suppliesposition)'+                      
        '<option value="{{ $suppliesposition ->POSITION_ID  }}">{{ $suppliesposition-> POSITION_NAME }}</option>'+                    
        '@endforeach'+                          
        '</select>'+ 
        '</td>'+
        '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
        '</tr>';
    $('.tbody2').append(tr);
    };

    $('.tbody2').on('click','.remove', function(){
        $(this).parent().parent().remove();
});
</script>
<script> 
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
  
</script>

<script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>


@endsection