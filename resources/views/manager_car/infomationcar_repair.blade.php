@extends('layouts.car')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 

?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

            .text-pedding{
   padding-left:10px;
   padding-right:10px;
   
                    }

        .text-font {
    font-size: 13px;
                  }   

            

</style>
<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลยานพาหนะ</B></h3>

</div>
<div class="block-content block-content-full" align="left">


      
    <div class="row">

       <div class="col-lg-4" align="center">
                                        <div class="form-group">
                                          
                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($infocarrepair->CAR_IMG)) }}" height="150px" width="150px"/>
                                     
                                    
                                        </div>
              
                                        
        </div>

        <div class="col-sm-8">
 
        
       <div class="row">
        <div class="col-lg-2">
        <label>ทะเบียนรถ :</label>
        </div> 
        <div class="col-lg-2">
        {{$infocarrepair->CAR_REG}}
        </div> 
        <div class="col-lg-2">
        <label>รายละเอียด :</label>
        </div> 
        <div class="col-lg-6">
      {{$infocarrepair->CAR_DETAIL}}
        </div>
       </div>
        
        <div class="row">
        <div class="col-lg-2">
        <label>ผู้รับผิดชอบ:</label>
        </div> 
        <div class="col-lg-4">
        {{$infocarrepair->HR_FNAME}} {{$infocarrepair->HR_LNAME}}
        </div> 
        <div class="col-lg-2">
        <label>สถานะ :</label>
        </div> 
        <div class="col-lg-4">
        {{$infocarrepair->CAR_STATUS_NAME}}  
        </div> 
        </div> 
     


        
        <div class="row">
        <div class="col-lg-2">
        <label>ประเภท :</label>
        </div> 
        <div class="col-lg-4">
        {{$infocarrepair->CAR_TYPE_NAME}}  
        </div> 
        <div class="col-lg-2">
        <label>ลักษณะรถ :</label>
        </div> 
        <div class="col-lg-4">
        {{$infocarrepair->CAR_STYLE_NAME}} 
        </div> 
    
   
  
        </div>
     
        <div class="row">
        <div class="col-lg-2">
        <label>ยี่ห้อ :</label>
        </div> 
        <div class="col-lg-4">
        {{$infocarrepair->BRAND_NAME}}  
        </div>
        <div class="col-lg-2">
        <label>เชื้อเพลิง :</label>
        </div> 
        <div class="col-lg-4">
        {{$infocarrepair->CAR_POWER_NAME}}  
        </div> 

      
        <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
        </div>
        </div>
        </div>


        
        <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #E6E6FA;">
                                    <li class="nav-item">
                                     @if($type_check == 'checkcar' || $type_check == 'assetin' || $type_check == 'checkact' || $type_check == 'checktax' || $type_check == 'checkinsu' || $type_check == 'checkplan')
                                     <a class="nav-link" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">อุปกรณ์ภายใน</a>
                                     @else
                                     <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">อุปกรณ์ภายใน</a>
                                     @endif
                                   
                                    </li>
                                   
                                    <li class="nav-item">
                                        @if($type_check == 'assetin')
                                        <a class="nav-link active" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ครุภัณฑ์ภายใน</a>
                                        @else
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ครุภัณฑ์ภายใน</a>
                                        @endif
                                    </li>
                                    <li class="nav-item">

                                    @if($type_check == 'checkcar')
                                    <a class="nav-link active" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ตรวจเช็คบำรุงรักษา</a>
                                     @else
                                     <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ตรวจเช็คบำรุงรักษา</a>
                                     @endif

                                       
                                    </li>
                               
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ประวัติการซ่อม</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                    @if($type_check == 'checkact')
                                        <a class="nav-link active" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ข้อมูล พ.ร.บ.รถ</a>
                                    @else
                                        <a class="nav-link" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ข้อมูล พ.ร.บ.รถ</a>
                                    @endif
                                    </li>

                                    <li class="nav-item">
                                    @if($type_check == 'checktax')
                                        <a class="nav-link active" href="#object6" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ข้อมูลต่อภาษีรถ</a>
                                    @else
                                        <a class="nav-link" href="#object6" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ข้อมูลต่อภาษีรถ</a>
                                    @endif
                                    
                                    </li>

                                    <li class="nav-item">
                                    @if($type_check == 'checkinsu')
                                        <a class="nav-link active" href="#object7" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ข้อมูลกรมธรรม์</a>
                                    @else
                                        <a class="nav-link" href="#object7" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ข้อมูลกรมธรรม์</a>
                                    @endif
                                    
                                    </li>

                                    <li class="nav-item">
                                    @if($type_check == 'checkplan')
                                        <a class="nav-link active" href="#object8" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">แผนบำรุงรักษา</a>
                                    @else
                                        <a class="nav-link" href="#object8" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">แผนบำรุงรักษา</a>
                                    @endif
                                    
                                    </li>


                                  
                                </ul>
                    <div class="block-content tab-content">
                                @if($type_check == 'checkcar' || $type_check == 'assetin' || $type_check == 'checkact' || $type_check == 'checktax' || $type_check == 'checkinsu' || $type_check == 'checkplan')
                                    <div class="tab-pane" id="object1" role="tabpanel">
                                @else
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                @endif  
                                    <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#accessory"><i class="fas fa-plus"></i> เพิ่มอุปกรณ์</button>
                                   <br><br>

                            <div id="detail_accessory">
                            <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                        <tr>
                                        <th scope="col" class="text-font text-pedding" style="border: 1px solid black;text-align: center;">อุปกรณ์</th>
                                        <th scope="col" class="text-font text-pedding" style="border: 1px solid black;text-align: center;">จำนวน</th>
                                        <th scope="col" class="text-font text-pedding" style="border: 1px solid black;text-align: center;">วันที่ได้รับ</th>
                                        <th scope="col" class="text-font text-pedding" style="border: 1px solid black;text-align: center;">ผู้บันทึก</th>
                                        <th width="6%" class="text-font text-pedding" style="border: 1px solid black;text-align: center;">คำสั่ง</th> 
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailaccessorys as $detailaccessory)
                                            <tr>
                                                <td class="text-font text-pedding" style= "border: 1px solid black;" >{{$detailaccessory->ACCESSORY_NAME}}</td>
                                                <td class="text-font text-pedding" style= "border: 1px solid black;" width="10%">{{$detailaccessory->ACCESSORY_AMOUNT}}</td>
                                                <td class="text-font text-pedding" style= "border: 1px solid black;" width="15%">{{DateThai($detailaccessory->ACCESSORY_DATE)}}</td>
                                                <td class="text-font text-pedding" style= "border: 1px solid black;"width="15%">{{$detailaccessory->HR_FNAME}} {{$detailaccessory->HR_LNAME}}</td>
                                                <td style= "border: 1px solid black;" width="5%">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                                    ทำรายการ
                                                            </button>
                                                        <div class="dropdown-menu" style="width:10px;border: 1px solid black;">
                                                            <a class="dropdown-item" href=""  data-toggle="modal" data-target="#editaccessory{{ $detailaccessory -> ID }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                                                                                        
                                                            {{-- <a class="dropdown-item"  href="{{ url('product/product/destroy/'.$detailaccessory -> ACCESSORY_ID )  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบ</a>                                                    --}}
                                                            <a class="dropdown-item" href="{{ url('manager_car/infomationcar/accessory/destroy/'.$infocarrepair->CAR_ID.'/'.$detailaccessory -> ID )  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a>                                                   
                                                        
                                                        </div>
                                                    </div>                                    
                                                </td>

                        <!-- editaccessory -->
                                                <div id="editaccessory{{ $detailaccessory -> ID }}" class="modal fade editaccessory" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                                                        <div class="modal-dialog modal-xl">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">        
                                                                    <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขอุปกรณ์ภายใน</h4>
                                                                </div>
                                                                <div class="modal-body">                                                                  
                                                                    <div class="row push">
                                                                    <form  method="post" action="{{ route('mcar.editaccessory') }}" enctype="multipart/form-data">
                                                                    @csrf  
                                                                   
                                                                        <div class="col-lg-1">
                                                                            <label >อุปกรณ์</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <select name="ACCESSORY_ID" id="ACCESSORY_ID{{ $detailaccessory -> ID }}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                                <option value="">--กรุณาเลือกอุปกรณ์--</option>                                                                                      
                                                                                    @foreach ($carassets as $carasset) 
                                                                                        @if($detailaccessory -> ACCESSORY_ID == $carasset-> ACCESSORY_ID )                                                     
                                                                                                <option value="{{ $carasset ->ACCESSORY_ID  }}" selected>{{ $carasset->ACCESSORY_NAME}}</option>
                                                                                            @else
                                                                                                <option value="{{ $carasset ->ACCESSORY_ID  }}">{{ $carasset->ACCESSORY_NAME}}</option>
                                                                                            @endif
                                                                                    @endforeach 
                                                                            </select>                                                                                                
                                                                        </div>                                                
                                                                        <div class="col-lg-1">
                                                                            <label >จำนวน</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input value="{{$detailaccessory->ACCESSORY_AMOUNT}}" name = "ACCESSORY_AMOUNT"  id="ACCESSORY_AMOUNT{{ $detailaccessory -> ID }}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        </div>
                                                                        <div class="col-lg-1">
                                                                            <label >วันที่ได้รับ</label>
                                                                        </div>
                                                                        <div class="col-lg-2">                                                                           
                                                                            <input value="{{ formate($detailaccessory->ACCESSORY_DATE) }}" name = "ACCESSORY_DATE"  id="ACCESSORY_DATE{{ $detailaccessory -> ID }}"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                                                                        </div>   
                                                                            <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">                                                  
                                                                            <input  type="hidden" name = "ACCESSORY_PERSON_ID"  id="ACCESSORY_PERSON_ID{{ $detailaccessory -> ID }}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                                                            <input  type="hidden" name = "ID"  id="ID{{ $detailaccessory -> ID }}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$detailaccessory->ID}}">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                                </div>
                                                              </form>
                                                            </div>
                                                        </div>
                                                    </div>             
                                                </div>
    
                                                   
                                    <!-- END แก้ไข -->

                                            
                                            </tr>
                                         @endforeach   
                                    </tbody>
                                </table>
                            </div>


                                <div id="accessory" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                                    <div class="modal-dialog modal-xl">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">        
                                            </div>
                                            <div class="modal-body">                                                                  
                                                
                                                <form  method="post" action="{{ route('mcar.saveaccessory') }}" enctype="multipart/form-data">
                                                @csrf 
                                                <div class="row push">
                                                    <div class="col-lg-1">
                                                        <label >อุปกรณ์</label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <select name="ACCESSORY_ID" id="ACCESSORY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                            <option value="">--กรุณาเลือกอุปกรณ์--</option>
                                                                @foreach ($carassets as $carasset)                                                     
                                                                    <option value="{{ $carasset ->ACCESSORY_ID  }}">{{ $carasset->ACCESSORY_NAME}}</option>
                                                            @endforeach 
                                                        </select>  
                                                    </div>                                                
                                                    <div class="col-lg-1">
                                                        <label >จำนวน</label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input  name = "ACCESSORY_AMOUNT"  id="ACCESSORY_AMOUNT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <label >วันที่ได้รับ</label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input  name = "ACCESSORY_DATE"  id="ACCESSORY_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                    </div>                                                    
                                                        <input  type="hidden" name = "ACCESSORY_PERSON_ID"  id="ACCESSORY_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                                        <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>             
                                </div>
                                </form>




                                    @if($type_check == 'assetin')  
                                    <div class="tab-pane active" id="object2" role="tabpanel">
                                     @else
                                     <div class="tab-pane" id="object2" role="tabpanel">
                                     @endif
                                    
                                <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#asset"><i class="fas fa-plus"></i> เพิ่มครุภัณฑ์</button>
                                
                                <br>
                                <br>




                                <div id="detail_asset">
                                <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                        <tr>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ครุภัณฑ์</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">จำนวน</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">วันที่ได้รับ</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ผู้บันทึก</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;"   width="12%">คำสั่ง</th> 
                                    
                                        </tr>
                                </thead>
                            <tbody>

                                @foreach ($detailaccessoryassets as $detailaccessoryasset)
                                    <tr>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailaccessoryasset->ARTICLE_NUM}}::{{$detailaccessoryasset->ARTICLE_NAME}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailaccessoryasset->ASSET_AMOUNT}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{DateThai($detailaccessoryasset->RECEIVE_DATE)}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailaccessoryasset->HR_FNAME}} {{$detailaccessoryasset->HR_LNAME}}</td>
                                        <td style= "border: 1px solid black;">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                            ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                        <a class="dropdown-item" href=""  data-toggle="modal" data-target="#editasset{{$detailaccessoryasset->ASSET_ID}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>                                                                                                                        
                                                        <a class="dropdown-item"  href="{{ url('manager_car/infomationcar/asset/destroy/'.$infocarrepair->CAR_ID.'/'.$detailaccessoryasset -> ID )  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะลบไขข้อมูล ?')">ลบ</a> 
                                                </div>
                                            </div>                                    
                                        </td>
        <!----editasset------->    <div id="editasset{{$detailaccessoryasset->ASSET_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                                            <div class="modal-dialog modal-xl">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">        
                                                        <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขครุภัณฑ์</h4>
                                                    </div>
                                                    <div class="modal-body">                                                                  
                                                        <div class="row push">  
                                                <form  method="post" action="{{ route('mcar.editasset') }}" enctype="multipart/form-data">
                                                @csrf 
                                                <input type="hidden" name="ID" id="ID" class="form-control input-sm "  value="{{$detailaccessoryasset->ID}}">
                                                            <div class="col-lg-1">
                                                                <label >ครุภัณฑ์</label>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <select name="ASSET_ID" id="ASSET_ID{{$detailaccessoryasset->ASSET_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        <option value="">--กรุณาเลือกครุภัณฑ์--</option>
                                                                        @foreach ($assetarticles as $assetarticle)
                                                                            @if($detailaccessoryasset -> ARTICLE_ID == $assetarticle-> ARTICLE_ID )                                                      
                                                                                <option value="{{ $assetarticle ->ARTICLE_ID  }}"selected>{{$assetarticle->ARTICLE_NUM}}::{{ $assetarticle->ARTICLE_NAME}}</option>
                                                                            @else
                                                                                <option value="{{ $assetarticle ->ARTICLE_ID  }}">{{$assetarticle->ARTICLE_NUM}}::{{ $assetarticle->ARTICLE_NAME}}</option>
                                                                            @endif
                                                                                @endforeach 
                                                                </select> 
                                                                           
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label >จำนวน</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input value="{{$detailaccessoryasset->ASSET_AMOUNT}}" name = "ASSET_AMOUNT"  id="ASSET_AMOUNT{{$detailaccessoryasset->ASSET_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                            </div> 
                                                            <div class="col-lg-1">
                                                             
                                                                <input  type="hidden" name = "ASSET_PERSON_ID"  id="ASSET_PERSON_ID{{$detailaccessoryasset->ASSET_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                                                <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                            </div>
                                                        </div>
                                                <div class="modal-footer">
                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;color:white"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>             
                                    </div>
                                    </form>
                                    </tr>
                                    @endforeach   
              
                                    </tbody></table>
                                   </div>

          <!----asset_Add-------> <div id="asset" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            
                                            <div class="modal-dialog modal-xl">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                             <div class="modal-header">        
                                                            <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มครุภัณฑ์</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form  method="post" action="{{ route('mcar.saveasset') }}" enctype="multipart/form-data">
                                                            @csrf  
                                                            <div class="row push">
                                                           

                                                                <div class="col-lg-1">
                                                                <label >ครุภัณฑ์</label>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                    <select name="ASSET_ID" id="ASSET_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                            <option value="">--กรุณาเลือกครุภัณฑ์--</option>
                                                                            @foreach ($assetarticles as $assetarticle)                                                     
                                                                            <option value="{{ $assetarticle ->ARTICLE_ID  }}">{{$assetarticle->ARTICLE_NUM}}::{{ $assetarticle->ARTICLE_NAME}}</option>
                                                                            @endforeach 
                                                                    </select>    
                                                                    
                                                                    </div>
                                                            
                                                                    <div class="col-lg-1">
                                                                    <label >จำนวน</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input  name = "ASSET_AMOUNT"  id="ASSET_AMOUNT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>

                                                                
                                                                    
                                                                    <input  type="hidden" name = "ASSET_PERSON_ID"  id="ASSET_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                                                    <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                                    </div>

                                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;color:white"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                </div>
                                                </form>
                                                </div>
                                              
                                            </div>
                                            </div>
             
                                    </div>
                                   

                                    @if($type_check == 'checkcar')  
                                    <div class="tab-pane active" id="object3" role="tabpanel">
                                     @else
                                     <div class="tab-pane" id="object3" role="tabpanel">
                                     @endif

                                  
                                    <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#maintenance"><i class="fas fa-plus"></i> เพิ่มการตรวจเช็ค</button>
                                   <br><br>
                        <div id="detail_maintenance">
                        <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                    <tr>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;">วันที่ตรวจ</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;">เวลา</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;">ผู้ตรวจเช็คอุปกรณ์</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;">หัวหน้ารับรอง</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;">ผลการตรวจ</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;">ประเภท</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;">หมายเหตุ</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;">รายละเอียด</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;" width="5%">คำสั่ง</th> 
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailcarchecks as $detailcarcheck)
                                        <tr>
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" width="10%">{{DateThai($detailcarcheck->CARE_DATE)}}</td>
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" width="10%">{{$detailcarcheck->CARE_TIME_BEGIN}} - {{$detailcarcheck->CARE_TIME_END}}</td>
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" width="12%">{{$detailcarcheck->CARE_HR_NAME}}</td>
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" width="12%">{{$detailcarcheck->CARE_LEADER_HR_NAME}}</td>

                                                @if($detailcarcheck->CARE_ANS_ID == 1)
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" width="10%">ปกติ</td>
                                                @elseif($detailcarcheck->CARE_ANS_ID == 2)
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" width="10%">ผิดปกติ</td>
                                                @endif

                                                @if($detailcarcheck->CARE_CHECK_TYPE == 1)
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" width="10%">ตรวจเช็คตามแผน</td>
                                                @elseif($detailcarcheck->CARE_CHECK_TYPE == 2)
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" width="10%">ตรวจเช็คอื่นๆ</td>
                                                @else
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" width="10%">เปลี่ยนอะไหล่</td>
                                                @endif
                                            <td class="text-font text-pedding" style= "border: 1px solid black;" >{{$detailcarcheck->CARE_COMMENT}}</td>
                                            <td align="center" style= "border: 1px solid black;" width="7%">
                                            
                                                <a class="btn btn-success fa fa-file-signature"  href="#detail_usecar"  data-toggle="modal"   onclick="detail({{$detailcarcheck->ID}});"></a>

                                            </td>
                                            <td style= "border: 1px solid black;" width="5%">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                            ทำรายการ
                                                    </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href=""  data-toggle="modal" data-target="#editmaintenance{{$detailcarcheck->ID}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>                                                                                                                        
                                                    <a class="dropdown-item"  href="{{url('manager_car/infomationcar/destroy/'.$detailcarcheck->ID.'/'.$infocarrepair->CAR_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')">ลบ</a> 
                                                    </div>
                                                </div>                                            
                                            </td>
                                    
 <!-----EDIT maintenance--->     <div id="editmaintenance{{$detailcarcheck->ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                                    <div class="modal-dialog modal-xl">
                                        
                                            <div class="modal-content">
                                                <div class="modal-header">        
                                                    <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลการตรวจเช็ค</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form  method="post" action="{{ route('mcar.updatecheckcar') }}" enctype="multipart/form-data">
                                                        @csrf   
                                                            <input type="hidden" name="type_check" id="type_check"  value="checkcar">
                                                            <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                            <input type="hidden" name="ARTICLE_ID" id="ARTICLE_ID" class="form-control input-sm "  value="{{$infocarrepair->ARTICLE_ID}}">
                                                            <input  type="hidden" name = "CHECK_PERSON_ID"  id="CHECK_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                                            <input  type="hidden" name = "ID"  id="ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$detailcarcheck->ID}}">
                                                        
                                                        <div class="row push">
                                                            <div class="col-lg-2">
                                                                <label >วันที่ทำรายการ</label>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <input value="{{formate($detailcarcheck->CARE_DATE)}}" name = "CHECK_DATE"  id="CHECK_DATE{{$detailcarcheck->ID}}" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                            </div>                                                            
                                                            <div class="col-lg-1">
                                                                <label >เวลา</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input value="{{$detailcarcheck->CARE_TIME_BEGIN}}" type="text" class="js-masked-time form-control" id="CHECK_TIME_BIGIN{{$detailcarcheck->ID}}" name="CHECK_TIME_BIGIN" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label >ถึงเวลา</label>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <input value="{{$detailcarcheck->CARE_TIME_END}}" type="text" class="js-masked-time form-control" id="CHECK_TIME_END{{$detailcarcheck->ID}}" name="CHECK_TIME_END" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                            </div>
                                                        </div>
                                                        <div class="row push">
                                                            <div class="col-lg-2">
                                                                <label >หัวหน้ารับรอง</label>
                                                            </div>
                                                            <div class="col-lg-3">                                                
                                                                <select name="CHECK_LEADER_ID" id="CHECK_LEADER_ID{{$detailcarcheck->ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    <option value="">--กรุณาเลือกหัวหน้ารับรอง--</option>  
                                                                        @foreach ($leaders as $leader)
                                                                        @if($detailcarcheck->CARE_LEADER_HR_ID == $leader->LEADER_ID ) 
                                                                            <option value="{{$leader->LEADER_ID}}" selected>{{$leader->LEADER_NAME}}</option>  
                                                                            @else
                                                                            <option value="{{$leader->LEADER_ID}}">{{$leader->LEADER_NAME}}</option> 
                                                                            @endif                                 
                                                                        @endforeach   
                                                                </select>                                                               
                                                            </div>

                                                            <div class="col-lg-1">
                                                                <label >ประเภท</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <select name="CARE_CHECK_TYPE" id="CARE_CHECK_TYPE{{$detailcarcheck->ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        <option value="1">ตรวจเช็คตามแผน</option>                                   
                                                                        <option value="2">ตรวจเช็คอื่นๆ</option>
                                                                        <option value="3">เปลี่ยนอะไหล่</option>
                                                                        
                                                                </select>  
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label >หมายเหตุ</label>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <input value="{{$detailcarcheck->CHECK_COMMENT}}" name="CHECK_COMMENT"  id="CHECK_COMMENT{{$detailcarcheck->ID}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
                                                            </div>
                                                        </div>
                                                        
                                                         <!-- <table class="table table-bordered" >
                                                            <thead>
                                                                <tr>
                                                                    <td style="text-align: center;" width="40%">รายการปฏิบัติ</td>
                                                                    <td style="text-align: center;" width="15%">ผลการตรวจเช็ค</td>
                                                                    <td style="text-align: center;" width="15%">เลขไมล์</td>
                                                                    <td style="text-align: center;" >หมายเหตุ</td>

                                                                    <td style="text-align: center;" width="15%"><a  class="btn btn-success fa fa-plus addRow1" style="color:#FFFFFF;"></a></td>
                                                                </tr>
                                                            </thead> 
                                                            <tbody class="tbody1">                                                                            
                                                                <tr>
                                                                    <td> 
                                                                        <select name="CARE_NAME[]" id="CARE_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                            <option value="">--กรุณาเลือกรายการ--</option>  
                                                                                @foreach ($assetcaredetails as $assetcaredetail)
                                                                            <option value="{{$assetcaredetail->CARE_LIST_NAME}}">{{$assetcaredetail->CARE_LIST_NAME}}</option>                                   
                                                                                @endforeach   
                                                                        </select>   
                                                                    </td>
                                                                    <td> 
                                                                        <select name="CHECK_CARE_RESULT[]" id="CHECK_CARE_RESULT[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                            @foreach ($assetcarechecks as $assetcarecheck)
                                                                        <option value="{{$assetcarecheck->CARE_CHECK_ID}}">{{$assetcarecheck->CARE_CHECK_NAME}}</option>                                   
                                                                            @endforeach
                                                                        </select>    
                                                                    </td> 
                                                                    <td> 
                                                                        <input name="CHECK_CARE_MILE[]" id="CHECK_CARE_MILE[]" class="form-control input-sm"  >  
                                                                    </td> 
                                                                    <td> 
                                                                        <input name="CHECK_CARE_REMARK[]" id="CHECK_CARE_REMARK[]" class="form-control input-sm"  >  
                                                                    </td> 
                                                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove1" style="color:#FFFFFF;"></a></td>
                                                                </tr>
                                                            </tbody>   
                                                        </table>  -->
                                                    </div>                                                            
                                                <div class="modal-footer">
                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                </div>
                                            </div>
                                  </form>  
                                    </div>
                                    </div> 




                                        </tr>
                                    @endforeach                      
                                </tbody>
                            </table>
                        </div>

<!---Add maintenance ---><div id="maintenance" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                            <div class="modal-dialog modal-xl">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">        
                                        <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลการตรวจเช็ค</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form  method="post" action="{{ route('mcar.savecheckcar') }}" enctype="multipart/form-data">
                                            @csrf   

                                                <input type="hidden" name="type_check" id="type_check"  value="checkcar">
                                                <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                <input type="hidden" name="ARTICLE_ID" id="ARTICLE_ID" class="form-control input-sm "  value="{{$infocarrepair->ARTICLE_ID}}">
                                            <div class="row push">
                                                <div class="col-lg-2">
                                                    <label >วันที่ทำรายการ</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input  name = "CHECK_DATE"  id="CHECK_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                </div>                                                            
                                                <div class="col-lg-1">
                                                    <label >เวลา</label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input type="text" class="js-masked-time form-control" id="CHECK_TIME_BIGIN" name="CHECK_TIME_BIGIN" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                </div>
                                                <div class="col-lg-1">
                                                    <label >ถึงเวลา</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="js-masked-time form-control" id="CHECK_TIME_END" name="CHECK_TIME_END" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                </div>
                                            </div>
                                            <div class="row push">
                                                <div class="col-lg-2">
                                                    <label >หัวหน้ารับรอง</label>
                                                </div>
                                                <div class="col-lg-3">                                                
                                                    <select name="CHECK_LEADER_ID" id="CHECK_LEADER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกหัวหน้ารับรอง--</option>  
                                                            @foreach ($leaders as $leader)
                                                        <option value="{{$leader->LEADER_ID}}">{{$leader->LEADER_NAME}}</option>                                   
                                                            @endforeach   
                                                    </select>   
                                                </div>

                                                <div class="col-lg-1">
                                                    <label >ประเภท</label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <select name="CARE_CHECK_TYPE" id="CARE_CHECK_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                            <option value="1">ตรวจเช็คตามแผน</option>                                   
                                                            <option value="2">ตรวจเช็คอื่นๆ</option>
                                                            <option value="3">เปลี่ยนอะไหล่</option>
                                                            
                                                    </select>  
                                                </div>
                                                <div class="col-lg-1">
                                                    <label >หมายเหตุ</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input  name="CHECK_COMMENT"  id="CHECK_COMMENT" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
                                                </div>
                                            </div>
                                            <input  type="hidden" name = "CHECK_PERSON_ID"  id="CHECK_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                            <table class="table table-bordered" >
                                                <thead>
                                                    <tr>
                                                        <td style="text-align: center;" style= "border: 1px solid black;" width="40%">รายการปฏิบัติ</td>
                                                        <td style="text-align: center;" style= "border: 1px solid black;" width="15%">ผลการตรวจเช็ค</td>
                                                        <td style="text-align: center;" style= "border: 1px solid black;"width="15%">เลขไมล์</td>
                                                        <td style="text-align: center;" style= "border: 1px solid black;">หมายเหตุ</td>
            
                                                        <td style="text-align: center;" style= "border: 1px solid black;" width="15%"><a  class="btn btn-success fa fa-plus addRow1" style="color:#FFFFFF;"></a></td>
                                                    </tr>
                                                </thead> 
                                                <tbody class="tbody1">                                                                            
                                                    <tr>
                                                        <td> 
                                                            <select name="CARE_NAME[]" id="CARE_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                <option value="">--กรุณาเลือกรายการ--</option>  
                                                                    @foreach ($assetcaredetails as $assetcaredetail)
                                                                <option value="{{$assetcaredetail->CARE_LIST_NAME}}">{{$assetcaredetail->CARE_LIST_NAME}}</option>                                   
                                                                    @endforeach   
                                                            </select>   
                                                        </td>
                                                        <td> 
                                                            <select name="CHECK_CARE_RESULT[]" id="CHECK_CARE_RESULT[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                @foreach ($assetcarechecks as $assetcarecheck)
                                                            <option value="{{$assetcarecheck->CARE_CHECK_ID}}">{{$assetcarecheck->CARE_CHECK_NAME}}</option>                                   
                                                                @endforeach
                                                            </select>    
                                                        </td> 
                                                        <td> 
                                                            <input name="CHECK_CARE_MILE[]" id="CHECK_CARE_MILE[]" class="form-control input-sm"  >  
                                                        </td> 
                                                        <td> 
                                                            <input name="CHECK_CARE_REMARK[]" id="CHECK_CARE_REMARK[]" class="form-control input-sm"  >  
                                                        </td> 
                                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove1" style="color:#FFFFFF;"></a></td>
                                                    </tr>
                                                </tbody>   
                                            </table>
                                        </div>                                                            
                                    <div class="modal-footer">
                                        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                        <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                    </div>
                                </div>
                            </form>  
                        </div>
                        </div>

                                            <!----------------------------------------------->

                                                         
                                    <div id="detail_usecar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            
                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการตรวจเช็ค&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body" >
                                                    
                                        
                                                            
                                                 <div id="detail"></div>
                                                
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                <div align="right">
                                            
                                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ปิดหน้าต่าง</button>
                                                </div>
                                                </div>
                                                </form>  
                                        </body>
                                            
                                            
                                            </div>
                                            </div>
                                        </div>
              
                                    </div>
                                    <div class="tab-pane" id="object4" role="tabpanel">
                                      
                                    <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                                                                <tr>
                                                                                <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;"width="10%">วันที่ซ่อม</td>
                                                                                    
                                                                                <th scope="col" class="text-font text-pedding"  style= "border: 1px solid black;text-align: center;" width="10%">เลขที่แจ้งซ่อม</td>
                                                                                <th scope="col" class="text-font text-pedding"  style= "border: 1px solid black;text-align: center;" width="8%">สถานะ</td>
                                                                                <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;" width="15%">เลขครุภัณฑ์</td>   
                                                                                <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;" >แจ้งซ่อม</td>
                                                                                <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;" >อาการ</td>
                                                                                <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;text-align: center;" width="15%">ช่างซ่อม</td>
                                        
                                
                                                                                </tr>
                                                                            </thead> 
                                                                            <tbody>

                                                                    @foreach ($infohisrepairs as $infohisrepair)      
                                                                        <tr>
                                                                            <td  class="text-font text-pedding" style= "border: 1px solid black;" align="center">{{DateThai($infohisrepair->TECH_RECEIVE_DATE)}}</td>
                                                                            <td  class="text-font text-pedding" style= "border: 1px solid black;" align="center">{{$infohisrepair->REPAIR_ID}}</td>
                                                                            @if($infohisrepair->REPAIR_STATUS == 'REPAIR_OUT')
                                                                                <td  align="center" style= "border: 1px solid black;"><span class="badge badge-secondary" >แจ้งยกเลิก</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS== 'REQUEST')
                                                                                <td  align="center" style= "border: 1px solid black;"><span class="badge badge-warning" >ร้องขอ</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS== 'RECEIVE')
                                                                                <td  align="center" style= "border: 1px solid black;"><span class="badge badge-info" >รับงาน</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'PENDING')
                                                                                <td  align="center" style= "border: 1px solid black;"><span class="badge badge-danger" >กำลังดำเนินการ</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'CANCEL')
                                                                                <td  align="center" style= "border: 1px solid black;"><span class="badge badge-dark" >ยกเลิก</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'SUCCESS')
                                                                                <td  align="center" style= "border: 1px solid black;"><span class="badge badge-success" >ซ่อมเสร็จ</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'OUTSIDE')
                                                                                <td  align="center" style= "border: 1px solid black;"><span class="badge badge-danger" >ส่งซ่อมนอก</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'DEAL')
                                                                                <td  align="center" style= "border: 1px solid black;"><span class="badge badge-danger" >จำหน่าย</span></td>
                                                                            @else
                                                                            <td class="text-font" align="center" style= "border: 1px solid black;"><span class="badge badge-success" >ซ่อมเสร็จ</span></td>
                                                                                @endif


                                                                            <td class="text-font text-pedding" style= "border: 1px solid black;" >{{$infohisrepair->ARTICLE_NUM}}</td>
                                                                            <td class="text-font text-pedding" style= "border: 1px solid black;">{{$infohisrepair->REPAIR_NAME}}</td>
                                                                            <td class="text-font text-pedding" style= "border: 1px solid black;"> {{$infohisrepair->SYMPTOM}}</td>
                                                                            <td class="text-font text-pedding" style= "border: 1px solid black;">{{$infohisrepair->TECH_REPAIR_NAME}}</td>
                                                
                                                                        
                                                                          
                                                                        </tr>
                                                                        @endforeach  

                                                                        </tbody>   
                                                                        </table>

             
                                    </div>

                                    @if($type_check == 'checkact')
                                    <div class="tab-pane active" id="object5" role="tabpanel">
                                    @else
                                    <div class="tab-pane" id="object5" role="tabpanel">
                                    @endif

                                    <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#act"><i class="fas fa-plus"></i> เพิ่มข้อมูล พ.ร.บ.</button>
                            <br>
                            <br>
                        <div id="detail_act">
                        <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                    <tr>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ชื่อบริษัท</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">กรมธรรม์</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">เบี้ยประกัน</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">วันที่</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">คุ้มครองถึงวันที่</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">เวลา</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ตัวแทน</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">โทร</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ผู้บันทึก</th>
                                    <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;"  width="12%">คำสั่ง</th>
                                    </tr>
                                </thead>
                            <tbody>

                                @foreach ($detailacts as $detailact)
                                    <tr>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailact->ACT_COMPANY}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailact->ACT_INSURANCE}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailact->ACT_CHIP}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{DateThai($detailact->ACT_BEGIN_DATE)}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{DateThai($detailact->ACT_END_DATE)}}</td> 
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailact->ACT_END_TIME}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailact->ACT_AGENT}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailact->ACT_AGENT_TEL}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailact->HR_FNAME}} {{$detailact->HR_LNAME}}</td>
                                        <td style= "border: 1px solid black;">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                            ทำรายการ
                                                        </button>
                                                        <div class="dropdown-menu" style="width:10px">
                                                                <a class="dropdown-item" href=""  data-toggle="modal" data-target="#actedit{{$detailact->ACT_ID}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>                                                                                                                        
                                                                <a class="dropdown-item"  href="{{ url('manager_car/infomationcar/act/destroy/'.$infocarrepair->CAR_ID.'/'.$detailact->ACT_ID )  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a> 
                                                        </div>
                                                </div>                                    
                                        </td> 

<!--- Edit act---> 
                        <div id="actedit{{$detailact->ACT_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                                <div class="modal-dialog modal-xl">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                                    <div class="modal-header">        
                                                        <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูล พ.ร.บ.</h4>
                                                    </div>
                                                    <div class="modal-body"> 
                                            <form  method="post" action="{{ route('mcar.editact') }}" enctype="multipart/form-data">
                                            @csrf                                       
                                                    <div class="row push">
                                                    <input type="hidden" name="ACT_ID" id="ACT_ID" class="form-control input-sm "  value="{{$detailact->ACT_ID}}">
                                                        <div class="col-lg-1">
                                                            <label >ชื่อบริษัท</label>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input  name="ACT_COMPANY"  id="ACT_COMPANY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$detailact->ACT_COMPANY}}" >    
                                                        </div>                                                    
                                                        <div class="col-lg-2">
                                                            <label >กรมธรรม์ เลขที่</label>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input value="{{$detailact->ACT_INSURANCE}}" name="ACT_INSURANCE"  id="ACT_INSURANCE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <label >เบี้ยประกัน</label>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input value="{{$detailact->ACT_CHIP}}" name="ACT_CHIP"  id="ACT_CHIP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        </div>
                                                    </div>
                                                    <div class="row push">
                                                            <div class="col-lg-1">
                                                                <label >วันที่</label>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <input value="{{formate($detailact->ACT_BEGIN_DATE)}}" name = "ACT_BEGIN_DATE"  id="ACT_BEGIN_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label >คุ้มครองถึงวันที่</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input value="{{formate($detailact->ACT_END_DATE)}}" name = "ACT_END_DATE"  id="ACT_END_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label >เวลา</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input value="{{$detailact->ACT_END_TIME}}" type="text" class="js-masked-time form-control" id="ACT_END_TIME{{$detailact->ACT_ID}}" name="ACT_END_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                            </div>
                                                    </div>

                                                    <div class="row push">
                                                        <div class="col-lg-1">
                                                            <label >ตัวแทน</label>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input value="{{$detailact->ACT_AGENT}}" name = "ACT_AGENT"  id="ACT_AGENT{{$detailact->ACT_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label >โทร</label>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input value="{{$detailact->ACT_AGENT_TEL}}"  name = "ACT_AGENT_TEL"  id="ACT_AGENT_TEL{{$detailact->ACT_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        </div>
                                                        <div class="col-lg-2">
                                                                
                                                            </div>
                                                        <div class="col-lg-2">
                                                            <input type="hidden" name = "ACT_PERSON_ID"  id="ACT_PERSON_ID{{$detailact->ACT_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}" readonly>
                                                            <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                    </div>
                                                </div>
                                        <div class="modal-footer">
                                            <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                            <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-window-close text-danger mr-2"></i>ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>

                                    <div id="act" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                                            <div class="modal-dialog modal-xl">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                             <div class="modal-header">        
                                                            <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูล พ.ร.บ.</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                        <form  method="post" action="{{ route('mcar.saveact') }}" enctype="multipart/form-data">
                                                        @csrf       
                                                            <div class="row push">
       
                                                                    <div class="col-lg-1">
                                                                    <label >ชื่อบริษัท</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name = "ACT_COMPANY"  id="ACT_COMPANY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >    
                                                                    
                                                                    </div>
                                                            
                                                                    <div class="col-lg-2">
                                                                    <label >กรมธรรม์ เลขที่</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input  name = "ACT_INSURANCE"  id="ACT_INSURANCE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>

                                                                    <div class="col-lg-1">
                                                                    <label >เบี้ยประกัน</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input  name = "ACT_CHIP"  id="ACT_CHIP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>

                                                            </div>

                                                            <div class="row push">
                                                                    <div class="col-lg-1">
                                                                    <label >วันที่</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name = "ACT_BEGIN_DATE"  id="ACT_BEGIN_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <label >คุ้มครองถึงวันที่</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input  name = "ACT_END_DATE"  id="ACT_END_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                    </div>

                                                                    <div class="col-lg-1">
                                                                    <label >เวลา</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input type="text" class="js-masked-time form-control" id="ACT_END_TIME" name="ACT_END_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                                    </div>
                                                       
                                                            </div>

                                                            <div class="row push">
                                                                    <div class="col-lg-1">
                                                                    <label >ตัวแทน</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name = "ACT_AGENT"  id="ACT_AGENT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <label >โทร</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input  name = "ACT_AGENT_TEL"  id="ACT_AGENT_TEL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>
                                                            </div>
                                                                    <input  type="hidden" name = "ACT_PERSON_ID"  id="ACT_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                                                    <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>



                                @if($type_check == 'checktax')
                                    <div class="tab-pane active" id="object6" role="tabpanel">
                                @else    
                                    <div class="tab-pane " id="object6" role="tabpanel">
                                @endif    

                                    <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#tax"><i class="fas fa-plus"></i> เพิ่มข้อมูลต่อภาษี</button>
                                  

                                    <br><br>


                            <div id="detail_tax">
                            <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                        <tr>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">เลขที่ใบเสร็จรับเงิน</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ค่าภาษี</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">วันที่เสียภาษี</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">วันที่ครบกำหนด</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ผู้บันทึก</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;" width="12%">คำสั่ง</th> 
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailtaxs as $detailtax)
                                        <tr><td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailtax->TAX_BILL}}</td>
                                            <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailtax->TAX_PRICE}}</td>
                                            <td class="text-font text-pedding" style= "border: 1px solid black;">{{DateThai($detailtax->TAX_BEGIN_DATE)}}</td>
                                            <td class="text-font text-pedding" style= "border: 1px solid black;">{{DateThai($detailtax->TAX_END_DATE)}}</td> 
                                            <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailtax->HR_FNAME}} {{$detailtax->HR_LNAME}}</td>
                                            <td style= "border: 1px solid black;">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                                ทำรายการ
                                                            </button>
                                                            <div class="dropdown-menu" style="width:10px">
                                                                    <a class="dropdown-item" href=""  data-toggle="modal" data-target="#taxedit{{$detailtax->TAX_ID}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>                                                                                                                        
                                                                    <a class="dropdown-item"  href="  {{ url('manager_car/infomationcar/tax/destroy/'.$infocarrepair->CAR_ID.'/'.$detailtax->TAX_ID )  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a> 
                                                            </div>
                                                    </div>                                    
                                            </td>
                                        </tr>

              <!---taxedit-->        <div id="taxedit{{$detailtax->TAX_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                                                <div class="modal-dialog modal-xl">                               
                                                    <div class="modal-content">
                                                        <div class="modal-header">        
                                                                <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลต่อภาษี</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form  method="post" action="{{ route('mcar.edittax') }}" enctype="multipart/form-data">
                                                            @csrf 
                                                            <input type="hidden" name="TAX_ID" id="TAX_ID" class="form-control input-sm "  value="{{$detailtax->TAX_ID}}">
                                                            <div class="row push">
                                                                <div class="col-lg-2">
                                                                    <label >เลขที่ใบเสร็จรับเงิน</label>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input value="{{$detailtax->TAX_BILL}}" name = "TAX_BILL"  id="TAX_BILL{{$detailtax->TAX_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >   
                                                                        
                                                                </div>                                            
                                                                <div class="col-lg-2">
                                                                    <label >ค่าภาษี</label>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input value="{{$detailtax->TAX_PRICE}}" name = "TAX_PRICE"  id="TAX_PRICE{{$detailtax->TAX_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                </div> 
                                                            </div>
                                                            <div class="row push">
                                                                <div class="col-lg-2">
                                                                    <label >วันที่เสียภาษี</label>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input value="{{formate($detailtax->TAX_BEGIN_DATE)}}"  name = "TAX_BEGIN_DATE"  id="TAX_BEGIN_DATE{{$detailtax->TAX_ID}}" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label >วันที่ครบกำหนด</label>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input value="{{formate($detailtax->TAX_END_DATE)}}" name = "TAX_END_DATE"  id="TAX_END_DATE{{$detailtax->TAX_ID}}" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                </div>                                    
                                                            </div>
                                                                <input  type="hidden" name = "TAX_PERSON_ID"  id="TAX_PERSON_ID{{$detailtax->TAX_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                                                <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                                <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>               
                                            </div>
                                            </form>



                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                            
                        <div id="tax" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                            <div class="modal-dialog modal-xl">                               
                                <div class="modal-content">
                                    <div class="modal-header">        
                                            <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลต่อภาษี</h4>
                                    </div>
                                    <div class="modal-body">  
                                    <form  method="post" action="{{ route('mcar.savetax') }}" enctype="multipart/form-data">
                                    @csrf          
                                                                                             
                                        <div class="row push">
                                            <div class="col-lg-2">
                                                <label >เลขที่ใบเสร็จรับเงิน</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <input  name = "TAX_BILL"  id="TAX_BILL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >   
                                                    
                                            </div>                                            
                                            <div class="col-lg-2">
                                                <label >ค่าภาษี</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <input  name = "TAX_PRICE"  id="TAX_PRICE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                            </div> 
                                        </div>
                                        <div class="row push">
                                            <div class="col-lg-2">
                                                <label >วันที่เสียภาษี</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <input  name = "TAX_BEGIN_DATE"  id="TAX_BEGIN_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                            </div>
                                            <div class="col-lg-2">
                                                <label >วันที่ครบกำหนด</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <input  name = "TAX_END_DATE"  id="TAX_END_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                            </div>                                    
                                        </div>
                                            <input  type="hidden" name = "TAX_PERSON_ID"  id="TAX_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                            <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;color:white"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>               
                        </div>
                        </form>

                            @if($type_check == 'checkinsu')
                                <div class="tab-pane active" id="object7" role="tabpanel">                                
                            @else
                                <div class="tab-pane" id="object7" role="tabpanel">                                 
                            @endif
                                    
                                      
                                      <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#insu"><i class="fas fa-plus"></i> เพิ่มข้อมูลกรมธรรม์</button>
                                   <br><br>
                                   <div id="detail_insu">
                                   <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                        <tr>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ชื่อบริษัท</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">กรมธรรม์</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">เบี้ยประกัน</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">คุ้มครองวันที่</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">คุ้มครองถึงวันที่</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">เวลา</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ตัวแทน</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">โทร</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">ผู้บันทึก</th>
                                        <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;" width="12%">คำสั่ง</th> 
                                    
                                        </tr>
                                    </thead><tbody>
                                    @foreach ($detailinsus as $detailinsu)
                                        <tr><td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailinsu->INSU_COMPANY}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailinsu->INSU_INSURANCE}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailinsu->INSU_CHIP}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{DateThai($detailinsu->INSU_BEGIN_DATE)}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{DateThai($detailinsu->INSU_END_DATE)}}</td> 
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailinsu->INSU_END_TIME}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailinsu->INSU_AGENT}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailinsu->INSU_AGENT_TEL}}</td>
                                        <td class="text-font text-pedding" style= "border: 1px solid black;">{{$detailinsu->HR_FNAME}} {{$detailinsu->HR_LNAME}}</td>
                                    <td style= "border: 1px solid black;">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                        ทำรายการ
                                                    </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                            <a class="dropdown-item" href=""  data-toggle="modal" data-target="#insuedit{{$detailinsu->INSU_ID}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>                                                                                                                        
                                                            <a class="dropdown-item"  href="{{ url('manager_car/infomationcar/insu/destroy/'.$infocarrepair->CAR_ID.'/'.$detailinsu->INSU_ID )  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')">ลบ</a> 
                                                    </div>
                                            </div>                                    
                                        </td>
      <!---insuedit--->      <div id="insuedit{{$detailinsu->INSU_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                            
                                                <div class="modal-dialog modal-xl">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                                 <div class="modal-header">        
                                                                <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลกรมธรรม์</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                <form  method="post" action="{{ route('mcar.editinsu') }}" enctype="multipart/form-data">
                                                                @csrf 
                                                                <input type="hidden" name="INSU_ID" id="INSU_ID" class="form-control input-sm "  value="{{$detailinsu->INSU_ID}}">
                                                                <div class="row push">
                                                                       
                                                                        <div class="col-lg-1">
                                                                        <label >ชื่อบริษัท</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                        <input value="{{$detailinsu->INSU_COMPANY}}" name = "INSU_COMPANY"  id="INSU_COMPANY{{$detailinsu->INSU_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >    
                                                                        
                                                                        </div>
                                                                
                                                                        <div class="col-lg-2">
                                                                        <label >กรมธรรม์ เลขที่</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <input value="{{$detailinsu->INSU_INSURANCE}}" name = "INSU_INSURANCE"  id="INSU_INSURANCE{{$detailinsu->INSU_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        </div>
    
                                                                        <div class="col-lg-2">
                                                                        <label >เบี้ยประกัน</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <input value="{{$detailinsu->INSU_CHIP}}" name = "INSU_CHIP"  id="INSU_CHIP{{$detailinsu->INSU_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        </div>                                                                       
                                                                </div>    
                                                                <div class="row push"> 
                                                                        <div class="col-lg-1">
                                                                        <label >วันที่</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                        <input value="{{formate($detailinsu->INSU_BEGIN_DATE)}}" name = "INSU_BEGIN_DATE"  id="INSU_BEGIN_DATE{{$detailinsu->INSU_ID}}" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <label >คุ้มครองถึงวันที่</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <input value="{{formate($detailinsu->INSU_END_DATE)}}" name = "INSU_END_DATE"  id="INSU_END_DATE{{$detailinsu->INSU_ID}}" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                        </div>
    
                                                                        <div class="col-lg-2">
                                                                        <label >เวลา</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <input value="{{$detailinsu->INSU_END_TIME}}" type="text" class="js-masked-time form-control" id="INSU_END_TIME{{$detailinsu->INSU_ID}}" name="INSU_END_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                                        </div>
                                                           
                                                                </div>
    
                                                                <div class="row push">
                                                                        <div class="col-lg-1">
                                                                        <label >ตัวแทน</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                        <input value="{{$detailinsu->INSU_AGENT}}" name = "INSU_AGENT"  id="INSU_AGENT{{$detailinsu->INSU_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        </div>
    
                                                                        <div class="col-lg-2">
                                                                        <label >โทร</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <input value="{{$detailinsu->INSU_AGENT_TEL}}" name = "INSU_AGENT_TEL"  id="INSU_AGENT_TEL{{$detailinsu->INSU_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        </div>
                                                                    </div>
    
                                                                        <input  type="hidden" name = "INSU_PERSON_ID"  id="INSU_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                                                        <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                        <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;color:white"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                    </div>
                                                    </div>
    
                                                </div>
                                                </div>
                                                </div>    
                                  </form>
                                </tr>
                            @endforeach                           
                        </tbody>
                    </table>
                </div>

                                            <div id="insu" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            
                                            <div class="modal-dialog modal-xl">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                             <div class="modal-header">        
                                                            <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลกรมธรรม์</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                            <form  method="post" action="{{ route('mcar.saveinsu') }}" enctype="multipart/form-data">
                                                            @csrf 
                                                                  
                                                            <div class="row push">
       
                                                                    <div class="col-lg-1">
                                                                    <label >ชื่อบริษัท</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name = "INSU_COMPANY"  id="INSU_COMPANY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >    
                                                                    
                                                                    </div>
                                                            
                                                                    <div class="col-lg-2">
                                                                    <label >กรมธรรม์ เลขที่</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input  name = "INSU_INSURANCE"  id="INSU_INSURANCE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>

                                                                    <div class="col-lg-2">
                                                                    <label >เบี้ยประกัน</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input  name = "INSU_CHIP"  id="INSU_CHIP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>

                                                                

                                                            </div>

                                                            <div class="row push">
                                                                
                                                               
                                                                    <div class="col-lg-1">
                                                                    <label >วันที่</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name = "INSU_BEGIN_DATE"  id="INSU_BEGIN_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <label >คุ้มครองถึงวันที่</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input  name = "INSU_END_DATE"  id="INSU_END_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                    </div>

                                                                    <div class="col-lg-2">
                                                                    <label >เวลา</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input type="text" class="js-masked-time form-control" id="INSU_END_TIME" name="INSU_END_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                                    </div>
                                                       
                                                            </div>

                                                            <div class="row push">
                                                                    <div class="col-lg-1">
                                                                    <label >ตัวแทน</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name = "INSU_AGENT"  id="INSU_AGENT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>

                                                                    <div class="col-lg-2">
                                                                    <label >โทร</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input  name = "INSU_AGENT_TEL"  id="INSU_AGENT_TEL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>
                                                                </div>

                                                                    <input  type="hidden" name = "INSU_PERSON_ID"  id="INSU_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">
                                                                    <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;color:white"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                </div>
                                                </div>

                                            </div>
                                            </div>
                                            </div>    
                                        </form>                             


                                @if($type_check == 'checkplan')
                                    <div class="tab-pane active" id="object8" role="tabpanel">                             
                                @else
                                    <div class="tab-pane" id="object8" role="tabpanel">
                                @endif
                                      
                                      <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#plan"><i class="fas fa-plus"></i> เพิ่มแผนตรวจเช็ค</button>
                                     <br><br>


                                     <div id="detail_plan">
                                     <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                          <tr>
                                          <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;">แผนบำรุงรักษา</th>
                                
                                          <th scope="col" class="text-font text-pedding" style= "border: 1px solid black;" width="12%">คำสั่ง</th> 
                                      
                                          </tr>
                                      </thead><tbody>

                                      @foreach ($detailplans as $detailplan)
                                    <tr>
                                        <td style= "border: 1px solid black;" class="text-font text-pedding">{{$detailplan->CARE_LIST_NAME}}</td>                                 
                                        <td style= "border: 1px solid black;">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                            ทำรายการ
                                                    </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                            <a class="dropdown-item" href=""  data-toggle="modal" data-target="#planedit{{$detailplan->CARE_LIST_ID}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>                                                                                                                        
                                                            <a class="dropdown-item"  href="{{ url('manager_car/infomationcar/plan/destroy/'.$infocarrepair->CAR_ID.'/'.$detailplan->CARE_LIST_ID )  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a> 
                                                    </div>
                                            </div>
                                        
                                        </td> 
    <!---planedit-->                 <div id="planedit{{$detailplan->CARE_LIST_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                              
                                            <div class="modal-dialog modal-xl">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">        
                                                        <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขแผนตรวจเช็ค</h4>
                                                    </div>
                                                    <div class="modal-body">  
                                                    <form  method="post" action="{{ route('mcar.editplan') }}" enctype="multipart/form-data">
                                                              @csrf  
                                                              <input type="hidden" name="CARE_LIST_ID" id="CARE_LIST_ID" class="form-control input-sm "  value="{{$detailplan->CARE_LIST_ID}}">                                                                   
                                                        <div class="row push">
                                                            <div class="col-lg-2 text-right">
                                                                <label >แผนบำรุงรักษา</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input value="{{$detailplan->CARE_LIST_NAME}}" name = "PLAN_CARE_LIST_NAME"  id="PLAN_CARE_LIST_NAME{{$detailplan->CARE_LIST_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                            </div>
                                                        </div>
                                                    </div>    
                                                            <input type="hidden" name="PLAN_ARTICLE_ID" id="PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$infocarrepair->ARTICLE_ID}}">
                                                            <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">                                                      
                                                    <div class="modal-footer">
                                                        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                        <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;color:white"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        </form>   
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                  
  
                                              <div id="plan" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                              
                                              <div class="modal-dialog modal-xl">
                                                  <!-- Modal content-->
                                                  <div class="modal-content">
                                                               <div class="modal-header">        
                                                              <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มแผนตรวจเช็ค</h4>
                                                              </div>
                                                              <div class="modal-body">
                                                              <form  method="post" action="{{ route('mcar.saveplan') }}" enctype="multipart/form-data">
                                                              @csrf 
                                                                    
                                                              <div class="row push">
                                                                    <div class="col-lg-2 text-right" >
                                                                    <label >แผนบำรุงรักษา</label>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                    <input  name = "PLAN_CARE_LIST_NAME"  id="PLAN_CARE_LIST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>

                                                                </div>
         
                                                          </div>     
                                                             
                                                          <input type="hidden" name="PLAN_ARTICLE_ID" id="PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$infocarrepair->ARTICLE_ID}}">
                                                          <input type="hidden" name="CAR_ID" id="CAR_ID" class="form-control input-sm "  value="{{$infocarrepair->CAR_ID}}">
                                                    
                                                  <div class="modal-footer">
                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;color:white"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                  </div>
                                                  </div>
  
                                              </div>
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

function detail(id){

  $.ajax({
             url:"{{route('mcar.detailcheck')}}",
            method:"GET",
             data:{id:id},
             success:function(result){
                 $('#detail').html(result);   
                //alert("Hello! I am an alert box!!");
             }              
     })      
}

$('.addRow1').on('click',function(){
   
         addRow1();
     });

     function addRow1(){
        var count = $('.tbody1').children('tr').length;
         var tr ='<tr>'+
                    '<td>'+ 
                    '<select name="CARE_NAME[]" id="CARE_NAME[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                    '<option value="">--กรุณาเลือกรายการ--</option>'+  
                    '@foreach ($assetcaredetails as $assetcaredetail)'+
                    '<option value="{{$assetcaredetail->CARE_LIST_NAME}}">{{$assetcaredetail->CARE_LIST_NAME}}</option>'+                                   
                    '@endforeach'+   
                    '</select>'+   
                    '</td>'+
                    '<td>'+ 
                    '<select name="CHECK_CARE_RESULT[]" id="CHECK_CARE_RESULT[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+ 
                    '@foreach ($assetcarechecks as $assetcarecheck)'+ 
                    '<option value="{{$assetcarecheck->CARE_CHECK_ID}}">{{$assetcarecheck->CARE_CHECK_NAME}}</option>'+                                    
                    '@endforeach'+    
                    '</select>'+     
                    '</td>'+ 
                    '<td>'+  
                    '<input name="CHECK_CARE_MILE[]" id="CHECK_CARE_MILE[]" class="form-control input-sm"  >'+   
                    '</td>'+    
                    '<td>'+ 
                    '<input name="CHECK_CARE_REMARK[]" id="CHECK_CARE_REMARK[]" class="form-control input-sm"  >'+  
                    '</td>'+                                           
                    '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove1" style="color:#FFFFFF;"></a></td>'+
                    '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove1', function(){
            $(this).parent().parent().remove();
});

  
//------------------------------------
function saveaccessory(){
 
    var CAR_ID=document.getElementById("CAR_ID").value;
    var ACCESSORY_ID=document.getElementById("ACCESSORY_ID").value;
    var ACCESSORY_AMOUNT=document.getElementById("ACCESSORY_AMOUNT").value;
    var ACCESSORY_DATE=document.getElementById("ACCESSORY_DATE").value;
    var ACCESSORY_PERSON_ID=document.getElementById("ACCESSORY_PERSON_ID").value;
    
        //alert(type_vehicle_id);
        
            var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('mcar.saveaccessory')}}",
                     method:"GET",
                     data:{CAR_ID:CAR_ID,ACCESSORY_PERSON_ID:ACCESSORY_PERSON_ID,ACCESSORY_ID:ACCESSORY_ID,ACCESSORY_AMOUNT:ACCESSORY_AMOUNT,ACCESSORY_DATE:ACCESSORY_DATE,_token:_token},
                     success:function(result){
                        $('#detail_accessory').html(result);
                        clear();
                     }
             })

  }

  function clear(){

                        ACCESSORY_ID.value = '';
                        ACCESSORY_AMOUNT.value = '';
                        ACCESSORY_DATE.value = '';
}   

//----------------------------------------------------------
function editaccessory(accid){ 

     //alert("ACCESSORY_ID"+accid);
 
    var ID=document.getElementById("ID"+accid).value;
    var CAR_ID=document.getElementById("CAR_ID").value;
    var ACCESSORY_ID=document.getElementById("ACCESSORY_ID"+accid).value;
    var ACCESSORY_AMOUNT=document.getElementById("ACCESSORY_AMOUNT"+accid).value;
    var ACCESSORY_DATE=document.getElementById("ACCESSORY_DATE"+accid).value;
    var ACCESSORY_PERSON_ID=document.getElementById("ACCESSORY_PERSON_ID"+accid).value;

    // alert(ID);
         var _token=$('input[name="_token"]').val();
          $.ajax({
                  url:"{{route('mcar.editaccessory')}}",
                  method:"GET",
                     data:{ID:ID,ACCESSORY_PERSON_ID:ACCESSORY_PERSON_ID,CAR_ID:CAR_ID,ACCESSORY_ID:ACCESSORY_ID,ACCESSORY_AMOUNT:ACCESSORY_AMOUNT,ACCESSORY_DATE:ACCESSORY_DATE,_token:_token}
                    // success:function(result){
                     //   $('#detail_accessory').html(result);
                     //   $("#editaccessory"+accid).modal('hide');
                     //}
            })
}

//----------------------------------------------------------



function saveasset(){
    
    var CAR_ID=document.getElementById("CAR_ID").value;
    var ASSET_ID=document.getElementById("ASSET_ID").value;
    var ASSET_AMOUNT=document.getElementById("ASSET_AMOUNT").value;
    var ASSET_PERSON_ID=document.getElementById("ASSET_PERSON_ID").value;
    
        //alert(type_vehicle_id);
        
            var _token=$('input[name="_token"]').val();
            $.ajax({
                    url:"{{route('mcar.saveasset')}}",
                    method:"GET",
                    data:{CAR_ID:CAR_ID,ASSET_ID:ASSET_ID,ASSET_AMOUNT:ASSET_AMOUNT,ASSET_PERSON_ID:ASSET_PERSON_ID,_token:_token},
                    success:function(result){
                        $('#detail_asset').html(result);
                        clearasset();
                    }
            })
    }
    function clearasset(){  
        ASSET_ID.value = '';
        ASSET_AMOUNT.value = ''; 
}   

function editasset(eactid){
    // alert(eaid);
    var CAR_ID=document.getElementById("CAR_ID"+eactid).value;
    var ASSET_ID=document.getElementById("ASSET_ID"+eactid).value;
    var ASSET_AMOUNT=document.getElementById("ASSET_AMOUNT"+eactid).value;
    var ASSET_PERSON_ID=document.getElementById("ASSET_PERSON_ID"+eactid).value;
 
         
         var _token=$('input[name="_token"]').val();
          $.ajax({
                  url:"{{route('mcar.editasset')}}",
                  method:"GET",
                  data:{CAR_ID:CAR_ID,ASSET_ID:ASSET_ID,ASSET_AMOUNT:ASSET_AMOUNT,ASSET_PERSON_ID:ASSET_PERSON_ID,_token:_token},
                  success:function(result){
                     $('#detail_asset').html(result);
                     clearasset();
                  }
          })
    }

    function clearasset(){  
        ASSET_ID.value = '';
        ASSET_AMOUNT.value = ''; 
} 


function saveinsu(){
 
    var CAR_ID=document.getElementById("CAR_ID").value;
    var INSU_COMPANY=document.getElementById("INSU_COMPANY").value;
    var INSU_INSURANCE=document.getElementById("INSU_INSURANCE").value;
    var INSU_AGENT=document.getElementById("INSU_AGENT").value;
    var INSU_AGENT_TEL=document.getElementById("INSU_AGENT_TEL").value;
    var INSU_BEGIN_DATE=document.getElementById("INSU_BEGIN_DATE").value;
    var INSU_END_DATE=document.getElementById("INSU_END_DATE").value;
    var INSU_PERSON_ID=document.getElementById("INSU_PERSON_ID").value;
    var INSU_CHIP=document.getElementById("INSU_CHIP").value;
    var INSU_END_TIME=document.getElementById("INSU_END_TIME").value;
    
     //alert(type_vehicle_id);
     
         var _token=$('input[name="_token"]').val();
          $.ajax({
                  url:"{{route('mcar.saveinsu')}}",
                  method:"GET",
                  data:{CAR_ID:CAR_ID,INSU_COMPANY:INSU_COMPANY,INSU_INSURANCE:INSU_INSURANCE,INSU_AGENT:INSU_AGENT,INSU_AGENT_TEL:INSU_AGENT_TEL,INSU_BEGIN_DATE:INSU_BEGIN_DATE,INSU_END_DATE:INSU_END_DATE,INSU_PERSON_ID:INSU_PERSON_ID,INSU_END_TIME:INSU_END_TIME,INSU_CHIP:INSU_CHIP,_token:_token},
                  success:function(result){
                     $('#detail_insu').html(result);
                     clearinsu();
                  }
          })
    }
    function clearinsu(){
        INSU_COMPANY.value = '';
        INSU_INSURANCE.value = '';
        INSU_AGENT.value = '';
        INSU_AGENT_TEL.value = '';
        INSU_BEGIN_DATE.value = '';
        INSU_END_DATE.value = '';
        INSU_CHIP.value = '';
        INSU_END_TIME.value = '';
}  



function savetax(){ 
    var CAR_ID=document.getElementById("CAR_ID").value;
    var TAX_BILL=document.getElementById("TAX_BILL").value;
    var TAX_PRICE=document.getElementById("TAX_PRICE").value;
    var TAX_BEGIN_DATE=document.getElementById("TAX_BEGIN_DATE").value;
    var TAX_END_DATE=document.getElementById("TAX_END_DATE").value;
    var TAX_PERSON_ID=document.getElementById("TAX_PERSON_ID").value; 
     //alert(type_vehicle_id);     
         var _token=$('input[name="_token"]').val();
          $.ajax({
                  url:"{{route('mcar.savetax')}}",
                  method:"GET",
                  data:{CAR_ID:CAR_ID,TAX_BILL:TAX_BILL,TAX_PRICE:TAX_PRICE,TAX_BEGIN_DATE:TAX_BEGIN_DATE,TAX_END_DATE:TAX_END_DATE,TAX_PERSON_ID:TAX_PERSON_ID,_token:_token},
                  success:function(result){
                     $('#detail_tax').html(result);
                     cleartax();
                  }
            })
    }
    function cleartax(){
        TAX_BILL.value = '';
        TAX_PRICE.value = '';
        TAX_BEGIN_DATE.value = '';
        TAX_END_DATE.value = '';   
}   

function saveplan(){
    var PLAN_CARE_LIST_NAME=document.getElementById("PLAN_CARE_LIST_NAME").value;
    var PLAN_ARTICLE_ID=document.getElementById("PLAN_ARTICLE_ID").value;
        //alert(type_vehicle_id);        
         var _token=$('input[name="_token"]').val();
          $.ajax({
                  url:"{{route('mcar.saveplan')}}",
                  method:"GET",
                  data:{PLAN_CARE_LIST_NAME:PLAN_CARE_LIST_NAME,PLAN_ARTICLE_ID:PLAN_ARTICLE_ID,_token:_token},
                  success:function(result){
                     $('#detail_plan').html(result);
                     clearplan();
                  }
          })
    }
    function clearplan(){
        CARE_LIST_NAME.value = '';  
}   
  //---------------------------------------------------------------
function planedit(plid){
    var PLAN_CARE_LIST_NAME=document.getElementById("PLAN_CARE_LIST_NAME"+plid).value;
    var PLAN_ARTICLE_ID=document.getElementById("PLAN_ARTICLE_ID"+plid).value;
        //alert(type_vehicle_id);
        
         var _token=$('input[name="_token"]').val();
          $.ajax({
                  url:"{{route('mcar.saveplan')}}",
                  method:"GET",
                  data:{PLAN_CARE_LIST_NAME:PLAN_CARE_LIST_NAME,PLAN_ARTICLE_ID:PLAN_ARTICLE_ID,_token:_token},
                  success:function(result){
                     $('#detail_plan').html(result);
                     clearplan();
                  }
          })
    }
    function clearplan(){
        CARE_LIST_NAME.value = '';  
}   
  //---------------------------------------------------------------
  

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


</script>


@endsection