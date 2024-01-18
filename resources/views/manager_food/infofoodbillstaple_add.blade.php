@extends('layouts.food')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
      font-size: 13px;
     
      }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
      } 

      .text-pedding{
   padding-left:10px;
   padding-right:10px;
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
<body onload="findTotal();";>

<center>    
     <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการวัตถุดิบรายวัน</B></h3>
               
                <a href="{{ url('manager_food/infofoodbill_add/'.$infobillday -> FOOD_BILL_DAY_ID)}}"  class="btn btn-hero-sm btn-hero-success" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >ประมวลผล</a>
            </div>
        <div class="block-content block-content-full" align="left">
            <form  method="post" action="{{ route('mfood.infofoodbillstaple_save') }}" enctype="multipart/form-data">
                @csrf

          <div class="row">
            <div class="col-sm-4">
            <label style=" font-family: 'Kanit', sans-serif;font-size: 13px;">เลขทะเบียน :&nbsp;&nbsp;  {{$infobillday->FOOD_BILL_DAY_NUMBER}}  </label>
            </div>
      
            <div class="col-sm-4">
            <label style=" font-family: 'Kanit', sans-serif;font-size: 13px;">อ้างอิงเลขทะเบียนจัดซื้อ :&nbsp;&nbsp;  {{$infobillday->CON_NUM}}</label>
            </div>
      
            <div class="col-sm-3">
             <label style=" font-family: 'Kanit', sans-serif;font-size: 13px;">วันที่ :&nbsp;&nbsp;   {{DateThai($infobillday->FOOD_BILL_DAY_DATE)}}</label>
            </div>
         

        </div>

        <div class="row">
            <div class="col-sm-4">
            <label style=" font-family: 'Kanit', sans-serif;font-size: 13px;">เรื่อง  :&nbsp;&nbsp;  {{$infobillday->FOOD_BILL_DAY_NAME}}  </label>
            </div>
            <div class="col-sm-4">
                <label style=" font-family: 'Kanit', sans-serif;font-size: 13px;">บริษัท  :&nbsp;&nbsp;  {{$infobillday->VENDOR_NAME}}  </label>
            </div>
            <div class="col-sm-4">
                @if($infobillday->FOOD_BILL_DAY_ROUNDING == 'on')
                <input type="checkbox" id="ROUNDING" name="ROUNDING" checked>
                @else
                <input type="checkbox" id="ROUNDING" name="ROUNDING">
                @endif
                &nbsp;&nbsp;&nbsp;
                <label style=" font-family: 'Kanit', sans-serif;font-size: 13px;">ปัดเศษ </label>
            </div>
          

        </div>
        <div class="col-sm-12"  align="right">
           <div class="row">
           <div class="col-sm-4">
           &nbsp;
           </div>
           <div class="col-sm-1">
            <label>รวมมูลค่า </label> 
            </div>
            <div class="col-sm-2">
              
            <input class="form-control input-sm" style="text-align: center;background-color: rgba(50, 115, 220, 0.3);" type="text" name="total" id="total" readonly>   
          
        </div>
            <div class="col-sm-1">
            <label> บาท</label>
            </div>
            <div class="col-sm-1">
                <label>รวมยอดเต็ม </label> 
                </div>
                <div class="col-sm-2">
                  
                <input class="form-control input-sm" style="text-align: center;background-color: rgba(50, 115, 220, 0.3);" type="text" name="total2" id="total2" readonly>   
              
            </div>
                <div class="col-sm-1">
                <label> บาท</label>
                </div>
          </div>
         </div>
<br>
        
    
        
        <input type="hidden" name="FOOD_BILL_DAY_ID" id="FOOD_BILL_DAY_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$infobillday->FOOD_BILL_DAY_ID}}">
           
                         <!-- Block Tabs Default Style -->
                         <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                   
                                    <li class="nav-item">
                                     <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:13px;">รายการวัตถุดิบ</a>  
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:13px;">เมนูอาหาร</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:13px;">กรรมการตรวจสอบ</a>
                                    </li>
                                 
 
                                </ul>
                    <div class="block-content tab-content" align="center">
                   
                            <div class="tab-pane active" id="object1" role="tabpanel">
                            
                <table class="gwt-table table-striped table-vcenter" style="width: 95%;">
                        <thead style="background-color: #F0F8FF;">
                            <tr>
                              
                                <td style="text-align: center;font-size: 13px;">วัตถุดิบ</td>
                                <td style="text-align: center;font-size: 13px;" width="10%">ปริมาณ</td>
                                <td style="text-align: center;font-size: 13px;" width="10%">หน่วย</td>
                                <td style="text-align: center;font-size: 13px;" width="10%">ปริมาณจัดซื้อ</td>
                                <td style="text-align: center;font-size: 13px;" width="10%">หน่วยจัดซื้อ</td>
                                <td style="text-align: center;font-size: 13px;" width="10%">ราคาต่อหน่วย</td>
                                <td style="text-align: center;font-size: 13px;" width="10%">มูลค่า</td>
                                <td style="text-align: center;font-size: 13px;" width="12%"><a  class="btn btn-success fa fa-plus addRow0" style="color:#FFFFFF;"></a></td>
                            </tr>
                        </thead> 
                        <tbody class="tbody0"> 


             
                          @if( $check != 0)
                          <?php $number = 0;?>
                          @foreach ($infodetails as $infodetail)
                      
                                    <tr>
                                        <input type="hidden" name="IDREF" id="IDREF{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$number}}" >
                                            <td class="text-font" align="center"> 

                                                <select name="FOOD_INDEX_STAPLE_SUPID[]" id="FOOD_INDEX_STAPLE_SUPID{{$number}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                    <option value="" selected>--กรุณาเลือกวัตถุดิบ--</option>
                                                    @foreach ($infosups as $infosup) 
                                                           @if($infodetail->FOOD_MENU_STAPLE_ID == $infosup -> ID)
                                                           <option value="{{ $infosup -> ID }}" selected>{{ $infosup -> SUP_NAME }}</option>           
                                                           @else
                                                           <option value="{{ $infosup -> ID }}">{{ $infosup -> SUP_NAME }}</option>           
                                                           @endif
                                                           
                                                         
                                                    @endforeach  
                                                    
                                                </select> 
                                        
                                            </td>

                                            <td class="text-font text-pedding" align="left"> 
                                            <input name="FOOD_INDEX_STAPLE_TOTAL[]" id="FOOD_INDEX_STAPLE_TOTAL{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$infodetail->total_sum}}" >
                                            </td>
                                            
                                            
                                            <td class="text-font" align="center"> 
                                                    <select name="FOOD_INDEX_STAPLE_UNIT[]" id="FOOD_INDEX_STAPLE_UNIT{{$number}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                            
                                                                @foreach ($infounits as $infounit) 
                                                                        <option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                                                @endforeach  
                                                    </select> 
                                            </td>

                                            <td class="text-font text-pedding" align="left">
                                            <div class="showconver{{$number}}">
                                            <input name="FOOD_INDEX_STAPLE_BUY_TOTAL[]" id="FOOD_INDEX_STAPLE_BUY_TOTAL{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;"  onkeyup="calvalue({{$number}});">
                                            
                                            </div>
                                            </td>
                                            
                                            
                                            <td class="text-font" align="center"> 
                                                    <select name="FOOD_INDEX_STAPLE_BUY_UNIT[]" id="FOOD_INDEX_STAPLE_BUY_UNIT{{$number}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;"  >
                                                            
                                                                @foreach ($infounits as $infounit) 
                                                                        <option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                                                @endforeach  
                                                    </select> 
                                            </td>
                                            
                                            <td class="text-font text-pedding" align="left"> 
                                            <input name="FOOD_INDEX_STAPLE_PERUNIT[]" id="FOOD_INDEX_STAPLE_PERUNIT{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onkeyup="calvalue({{$number}});">
                                            </td>
                                            <td class="text-font text-pedding" align="right"> 
                                            <div class="showvalue{{$number}}">
                                            <input name="FOOD_INDEX_STAPLE_PICE[]" id="FOOD_INDEX_STAPLE_PICE{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                            </div>
                                            </td>
                                        
                                            <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                        
                                        
                                        </tr>
                                        <?php $number++;?>
                                        @endforeach 
                          @elseif($checkedit != 0)

                                        <?php $number = 0;?>
                                        @foreach ($infodetailedits as $infodetailedit)
                                    
                                                    <tr>
                                                    <input type="hidden" name="IDREF" id="IDREF{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$number}}" >
                                                            <td class="text-font" align="center"> 

                                                                <select name="FOOD_INDEX_STAPLE_SUPID[]" id="FOOD_INDEX_STAPLE_SUPID{{$number}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                                    <option value="" selected>--กรุณาเลือกวัตถุดิบ--</option>
                                                                    @foreach ($infosups as $infosup) 
                                                                        @if($infodetailedit->FOOD_INDEX_STAPLE_SUPID == $infosup -> ID)
                                                                        <option value="{{ $infosup -> ID }}" selected>{{ $infosup -> SUP_NAME }}</option>           
                                                                        @else
                                                                        <option value="{{ $infosup -> ID }}">{{ $infosup -> SUP_NAME }}</option>           
                                                                        @endif
                                                                        
                                                                        
                                                                    @endforeach  
                                                                    
                                                                </select> 
                                                        
                                                            </td>

                                                            <td class="text-font text-pedding" align="left"> 
                                                            <input name="FOOD_INDEX_STAPLE_TOTAL[]" id="FOOD_INDEX_STAPLE_TOTAL{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$infodetailedit->FOOD_INDEX_STAPLE_TOTAL}}" >
                                                            </td>
                                                            
                                                            
                                                            <td class="text-font" align="center"> 
                                                                    <select name="FOOD_INDEX_STAPLE_UNIT[]" id="FOOD_INDEX_STAPLE_UNIT{{$number}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                                            
                                                                                @foreach ($infounits as $infounit) 
                                                                                    @if($infounit -> FOOD_UNIT_ID  == $infodetailedit->FOOD_INDEX_STAPLE_UNIT )
                                                                                    <option value="{{ $infounit -> FOOD_UNIT_ID }}" selected>{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                                                                    @else
                                                                                    <option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                                                                    @endif
                                                                                       
                                                                                @endforeach  
                                                                    </select> 
                                                            </td>

                                                            <td class="text-font text-pedding" align="left">
                                                            <div class="showconver{{$number}}">
                                                            <input name="FOOD_INDEX_STAPLE_BUY_TOTAL[]" id="FOOD_INDEX_STAPLE_BUY_TOTAL{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;"  value="{{$infodetailedit->FOOD_INDEX_STAPLE_BUY_TOTAL}}" onkeyup="calvalue({{$number}});">
                                                            </div>
                                                            </td>
                                                            
                                                            
                                                            <td class="text-font" align="center"> 
                                                                    <select name="FOOD_INDEX_STAPLE_BUY_UNIT[]" id="FOOD_INDEX_STAPLE_BUY_UNIT{{$number}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;"  >
                                                                            
                                                                                @foreach ($infounits as $infounit) 
                                                                                
                                                                                @if($infounit -> FOOD_UNIT_ID  == $infodetailedit->FOOD_INDEX_STAPLE_BUY_UNIT )
                                                                                        <option value="{{ $infounit -> FOOD_UNIT_ID }}" selected>{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                                                                @else
                                                                                        <option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                                                                @endif
                                                                               
                                                                                @endforeach  
                                                                    </select> 
                                                            </td>
                                                            
                                                            <td class="text-font text-pedding" align="left"> 
                                                            <input name="FOOD_INDEX_STAPLE_PERUNIT[]" id="FOOD_INDEX_STAPLE_PERUNIT{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$infodetailedit->FOOD_INDEX_STAPLE_PERUNIT}}" onkeyup="calvalue({{$number}});">
                                                            </td>
                                                            <td class="text-font text-pedding" align="right"> 
                                                            <div class="showvalue{{$number}}">
                                                            <input name="FOOD_INDEX_STAPLE_PICE[]" id="FOOD_INDEX_STAPLE_PICE{{$number}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$infodetailedit->FOOD_INDEX_STAPLE_PICE}}" >
                                                            </div>
                                                            </td>
                                                        
                                                            <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                                        
                                                        
                                                        </tr>
                                                        <?php $number++;?>
                                                        @endforeach 

                          @else

                            <tr>
                                <td class="text-font" align="center"> 
                                <input type="hidden" name="IDREF" id="IDREF0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="0" >
                                    <select name="FOOD_INDEX_STAPLE_SUPID[]" id="FOOD_INDEX_STAPLE_SUPID0" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                         <option value="" selected>--กรุณาเลือกวัตถุดิบ--</option>
                                         @foreach ($infosups as $infosup) 
                                                  <option value="{{ $infosup -> ID }}">{{ $infosup -> SUP_NAME }}</option>           

                                        @endforeach  
                                         
                                     </select> 
                               
                                </td>

                                <td class="text-font text-pedding" align="left"> 
                                <input name="FOOD_INDEX_STAPLE_TOTAL[]" id="FOOD_INDEX_STAPLE_TOTAL0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                </td>
                                
                                
                                <td class="text-font" align="center"> 
                                         <select name="FOOD_INDEX_STAPLE_UNIT[]" id="FOOD_INDEX_STAPLE_UNIT0" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                
                                                    @foreach ($infounits as $infounit) 
                                                            <option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                                    @endforeach  
                                         </select> 
                                </td>

                                <td class="text-font text-pedding" align="left"> 
                                <div class="showconver0">
                                            <input name="FOOD_INDEX_STAPLE_BUY_TOTAL[]" id="FOOD_INDEX_STAPLE_BUY_TOTAL0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onkeyup="calvalue(0);">
                                </div>
                                </td>
                                            
                                            
                                <td class="text-font" align="center"> 
                                                    <select name="FOOD_INDEX_STAPLE_BUY_UNIT[]" id="FOOD_INDEX_STAPLE_BUY_UNIT0" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                            
                                                                @foreach ($infounits as $infounit) 
                                                                        <option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                                                @endforeach  
                                                    </select> 
                                </td>
                                            
                                
                                <td class="text-font text-pedding" align="left"> 
                                <input name="FOOD_INDEX_STAPLE_PERUNIT[]" id="FOOD_INDEX_STAPLE_PERUNIT0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onkeyup="calvalue(0);">
                                </td>
                                <td class="text-font text-pedding" align="right"> 
                                <div class="showvalue0">
                                <input name="FOOD_INDEX_STAPLE_PICE[]" id="FOOD_INDEX_STAPLE_PICE0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                </div> 
                                 </td>
                              
                                 <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                            
                            
                            </tr>
                        
                           @endif
                         
                    </tbody>   
                    </table>
                            </div>

                            <div class="tab-pane" id="object2" role="tabpanel">

                            <div class="row push">
                <div class="col-sm-1 text-right">
                    <label>มื้อเช้า :</label>
                </div> 
                <div class="col-sm-11">

                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #F0F8FF;">
                                            <tr>
                                                <td style="text-align: center;">เมนูอาหาร</td>
                                              
                                             
                                           
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-success fa fa-plus addRow1" style="color:#FFFFFF;"></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        
                                        @if( $check != 0)
                                             @foreach ($infomenutype1s as $infomenutype1) 
                                                <tr>         
                                                    <td> 
                                                    <select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                        <option value="" >--กรุณาเลือก--</option>
                                                        @foreach ($infofoods as $infofood)
                                                            @if($infomenutype1->FOOD_BILL_MENU == $infofood->FOOD_MENU_ID)
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" selected>{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @endif
                                                       
                                                        @endforeach   
                                                    </select>
                                                    </td>

                                                    <input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="1" >
                                                
                                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                                </tr>
                                            @endforeach  

                                        @elseif($checkedit != 0)

                                        @foreach ($infomenutypeedit1s as $infomenutypeedit1) 
                                                <tr>         
                                                    <td> 
                                                    <select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                        <option value="" >--กรุณาเลือก--</option>
                                                        @foreach ($infofoods as $infofood)
                                                            @if($infomenutypeedit1->FOOD_INDEX_MENU == $infofood->FOOD_MENU_ID)
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" selected>{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @endif
                                                       
                                                        @endforeach   
                                                    </select>
                                                    </td>

                                                    <input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="1" >
                                                
                                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                                </tr>
                                            @endforeach  



                                        @else
                                                <tr>         
                                                    <td> 
                                                    <select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                        <option value="" >--กรุณาเลือก--</option>
                                                        @foreach ($infofoods as $infofood)
                                                        <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                                        @endforeach   
                                                    </select>
                                                    </td>

                                                    <input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="1" >
                                                
                                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                                </tr>
                     
                                        @endif
                            
                                    </tbody>   
                                    </table>

                </div>
               
            </div>  
         
 

                 <div class="row push">
                <div class="col-sm-1 text-right">
                    <label>มื้อเที่ยง :</label>
                </div>
                <div class="col-sm-11">

                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #F0F8FF;">
                            <tr>
                                <td style="text-align: center;">เมนูอาหาร</td>
  
                                <td style="text-align: center;" width="12%"><a  class="btn btn-success fa fa-plus addRow2" style="color:#FFFFFF;"></a></td>
                            </tr>
                        </thead> 
                        <tbody class="tbody2"> 
                        @if( $check != 0)
                            @foreach ($infomenutype2s as $infomenutype2) 
                                    <tr>
                                        <td> 
                                        <select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                            <option value="" >--กรุณาเลือก--</option>
                                            @foreach ($infofoods as $infofood)
                                                            @if($infomenutype2->FOOD_BILL_MENU == $infofood->FOOD_MENU_ID)
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" selected>{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @endif
                                            @endforeach   
                                        </select>
                                        </td>

                                        <input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="2" >

                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                    </tr>

                            @endforeach 
                        @elseif($checkedit != 0)

                        @foreach ($infomenutypeedit2s as $infomenutypeedit2) 
                                    <tr>
                                        <td> 
                                        <select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                            <option value="" >--กรุณาเลือก--</option>
                                            @foreach ($infofoods as $infofood)
                                                            @if($infomenutypeedit2->FOOD_INDEX_MENU == $infofood->FOOD_MENU_ID)
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" selected>{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @endif
                                            @endforeach   
                                        </select>
                                        </td>

                                        <input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="2" >

                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                    </tr>

                            @endforeach 


                        @else
                                    <tr>
                                        <td> 
                                        <select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                            <option value="" >--กรุณาเลือก--</option>
                                            @foreach ($infofoods as $infofood)
                                            <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                            @endforeach   
                                        </select>
                                        </td>

                                        <input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="2" >

                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                    </tr>

                        @endif
          
            
                    </tbody>   
                    </table>

</div> 
                

            </div> 
     


            <div class="row push">
                <div class="col-sm-1 text-right">
                    <label>มื้อเที่ยงเย็น :

                </div>
                <div class="col-sm-11">

                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #F0F8FF;">
                            <tr>
                                <td style="text-align: center;">เมนูอาหาร</td>
                             
                             
                           
                                <td style="text-align: center;" width="12%"><a  class="btn btn-success fa fa-plus addRow3" style="color:#FFFFFF;"></a></td>
                            </tr>
                        </thead> 
                        <tbody class="tbody3"> 
                  
                        @if($check != 0)
                             <?php $number0 = 0 ?>
                            @foreach ($infomenutype3s as $infomenutype3) 
                                <tr> 
                                    <td> 
                                    <select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU{{$number0}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                    <option value="" >--กรุณาเลือก--</option>
                                    @foreach ($infofoods as $infofood)
                                                            @if($infomenutype3->FOOD_BILL_MENU == $infofood->FOOD_MENU_ID)
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" selected>{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @endif
                                    @endforeach   
                                </select>
                                    </td>
                            
                                    <input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE{{$number0}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="3" >
                                
                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                </tr>
                                <?php $number0++; ?>
                            @endforeach 

                        @elseif($checkedit != 0)
                        <?php $number1 = 0 ?>
                        @foreach ($infomenutypeedit3s as $infomenutypeedit3) 
                                <tr> 
                                    <td> 
                                    <select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU{{$number1}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                    <option value="" >--กรุณาเลือก--</option>
                                    @foreach ($infofoods as $infofood)
                                                            @if($infomenutypeedit3->FOOD_INDEX_MENU == $infofood->FOOD_MENU_ID)
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" selected>{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                                            @endif
                                    @endforeach   
                                </select>
                                </td>
            
                                    <input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE{{$number1}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="3" >
                                
                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                </tr>
                                <?php $number1++; ?>
                            @endforeach 


                        @else

                                <tr> 
                                    <td> 
                                    <select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU0" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                    <option value="" >--กรุณาเลือก--</option>
                                    @foreach ($infofoods as $infofood)
                                    <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                    @endforeach   
                                </select>
                                    </td>
                            
                                    <input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="3" >
                                
                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                </tr>


                        @endif


                    
                      
                    </tbody>   
                    </table>

                    </div>    
                    </div>

                            </div>

                            <div class="tab-pane" id="object3" role="tabpanel">
                            
                            <div class="table-responsive"> 
                    <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #F0F8FF;">
                            <tr height="40">
                                <td style="text-align: center;font-size: 13px;" >คณะกรรมการ</td>
                                <td style="text-align: center;font-size: 13px;" >ตำแหน่ง</td>                            
                                <td style="text-align: center;font-size: 13px;" width="8%">
                                    <a  class="btn btn-success fa fa-plus-square addRow4" style="color:#FFFFFF;"></a>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="tbody4">
                        @if($checkedit != 0)

                        @foreach ($foodboardedits as $foodboardedit)
                                    <tr height="40">
                                        <td>
                                            <select name="FOOD_INDEX_BOARD_PERSON[]" id="FOOD_INDEX_BOARD_PERSON[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                    <option value="" >--กรุณาเลือก--</option>
                                                @foreach ($infopersons as $infoperson)
                                                    @if($infoperson->ID == $foodboardedit->FOOD_INDEX_BOARD_PERSON)
                                                    <option value="{{ $infoperson->ID}}" selected>{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                    @else
                                                    <option value="{{ $infoperson->ID}}" >{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                    @endif
                                                
                                                @endforeach     
                                            </select> 

                                        </td>
                                        <td>
                                            <select name="FOOD_INDEX_BOARD_POSITION[]" id="FOOD_INDEX_BOARD_POSITION[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                <option value="" >--กรุณาเลือกตำแหน่ง--</option>
                                                @if( $foodboardedit->FOOD_INDEX_BOARD_POSITION == '1')<option value="1" selected>ประธาน</option>@else<option value="1" >ประธาน</option>@endif
                                                @if( $foodboardedit->FOOD_INDEX_BOARD_POSITION == '2')<option value="2" selected>กรรมการ</option>@else<option value="2" >กรรมการ</option>@endif
                                            </select>                                         </td>
                                    
                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                    </tr>      
                                
                                    @endforeach                               

                        @else

                                @foreach ($foodboards as $foodboard)
                                    <tr height="40">
                                        <td>
                                            <select name="FOOD_INDEX_BOARD_PERSON[]" id="FOOD_INDEX_BOARD_PERSON[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                    <option value="" >--กรุณาเลือก--</option>
                                                @foreach ($infopersons as $infoperson)
                                                    @if($infoperson->ID == $foodboard->FOOD_BOARD_PERSON_ID)
                                                    <option value="{{ $infoperson->ID}}" selected>{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                    @else
                                                    <option value="{{ $infoperson->ID}}" >{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                                    @endif
                                                
                                                @endforeach     
                                            </select> 

                                        </td>
                                        <td>
                                            <select name="FOOD_INDEX_BOARD_POSITION[]" id="FOOD_INDEX_BOARD_POSITION[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                                <option value="" >--กรุณาเลือกตำแหน่ง--</option>
                                                @if( $foodboard->FOOD_BOARD_POSITION_ID == '1')<option value="1" selected>ประธาน</option>@else<option value="1" >ประธาน</option>@endif
                                                @if( $foodboard->FOOD_BOARD_POSITION_ID == '2')<option value="2" selected>กรรมการ</option>@else<option value="2" >กรรมการ</option>@endif
                                            </select>                                         </td>
                                    
                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                    </tr>      
                                
                                    @endforeach                               
                            @endif                            
                        </tbody>
                    </table>


                            </div>


                    </div>
                    <br>
                </div>
            </div>
         

{{-- <br> --}}
          <hr>   
        <div class="footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                    <a href="{{ url('manager_food/infofoodbill')}}" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
            </div>
        </div>
        </div>
    </div>
{{-- </div> --}}
</form>

@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

 <script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function() {
    $('select').select2({ width: '100%' });

   
});
   

  


    $('.addRow0').on('click',function(){
        addRow0();
        $('select').select2();
        });

    function addRow0(){
        
        var count = $('.tbody0').children('tr').length;
            var tr =         '<tr>'+
                                '<input type="hidden" name="IDREF" id="IDREF'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="'+count+'" >'+ 
                                '<td class="text-font" align="center">'+ 
                                '<select name="FOOD_INDEX_STAPLE_SUPID[]" id="FOOD_INDEX_STAPLE_SUPID'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                                '<option value="" selected>--กรุณาเลือกวัตถุดิบ--</option>'+
                                '@foreach ($infosups as $infosup)'+ 
                                '<option value="{{ $infosup -> ID }}">{{ $infosup -> SUP_NAME }}</option>'+           
                                '@endforeach'+   
                                '</select>'+ 
                                '</td>'+
                                '<td class="text-font text-pedding" align="left">'+ 
                                '<input name="FOOD_INDEX_STAPLE_TOTAL[]" id="FOOD_INDEX_STAPLE_TOTAL'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                                '</td>'+
                                '<td class="text-font" align="center">'+ 
                                '<select name="FOOD_INDEX_STAPLE_UNIT[]" id="FOOD_INDEX_STAPLE_UNIT'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                                '@foreach ($infounits as $infounit)'+ 
                                '<option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>'+            
                                '@endforeach'+  
                                '</select>'+ 
                                '</td>'+
                                '<td class="text-font text-pedding" align="left">'+ 
                                '<div class="showconver'+count+'">'+
                                '<input name="FOOD_INDEX_STAPLE_BUY_TOTAL[]" id="FOOD_INDEX_STAPLE_BUY_TOTAL'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" onkeyup="calvalue('+count+');" >'+
                                '</div>'+
                                '</td>'+
                                '<td class="text-font" align="center">'+ 
                                '<select name="FOOD_INDEX_STAPLE_BUY_UNIT[]" id="FOOD_INDEX_STAPLE_BUY_UNIT'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;">'+
                                '@foreach ($infounits as $infounit)'+ 
                                '<option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>'+            
                                '@endforeach'+  
                                '</select>'+ 
                                '</td>'+
                                '<td class="text-font text-pedding" align="left">'+ 
                                '<input name="FOOD_INDEX_STAPLE_PERUNIT[]" id="FOOD_INDEX_STAPLE_PERUNIT'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" onkeyup="calvalue('+count+');" >'+
                                '</td>'+
                                '<td class="text-font text-pedding" align="right">'+ 
                                 '<div class="showvalue'+count+'">'+ 
                                '<input name="FOOD_INDEX_STAPLE_PICE[]" id="FOOD_INDEX_STAPLE_PICE'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                                '</div>'+
                                 '</td>'+
                                 '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                            '</tr>';
                        
        $('.tbody0').append(tr);
    };

    $('.tbody0').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
  





$('.addRow1').on('click',function(){
        addRow1();
        $('select').select2();
        });

    function addRow1(){
        var count = $('.tbody1').children('tr').length;
            var tr =  '<tr>'+
            '<td>'+
                        '<select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="" >--กรุณาเลือก--</option>'+
                        '@foreach ($infofoods as $infofood)'+
                        '<option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>'+
                        '@endforeach'+   
                    '</select>'+
                        '</td>'+
                        '<input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="1" >'+
                    '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
        $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
  

$('.addRow2').on('click',function(){
        addRow2();
        $('select').select2();
        });

    function addRow2(){
        var count = $('.tbody2').children('tr').length;
            var tr =   '<tr>'+
            '<td>'+ 
                        '<select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="" >--กรุณาเลือก--</option>'+
                        '@foreach ($infofoods as $infofood)'+
                        '<option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>'+
                        '@endforeach'+ 
                        '</select>'+
                        '</td>'+
                        '<input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="2" >'+

                    '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
        $('.tbody2').append(tr);
    };

    $('.tbody2').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
  

$('.addRow3').on('click',function(){
        addRow3();
        $('select').select2();
        });

    function addRow3(){
        var count = $('.tbody3').children('tr').length;
            var tr =  '<tr>'+
            '<td>'+ 
                        '<select name="FOOD_INDEX_MENU[]" id="FOOD_INDEX_MENU'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="" >--กรุณาเลือก--</option>'+
                        '@foreach ($infofoods as $infofood)'+
                        '<option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>'+
                        '@endforeach'+   
                    '</select>'+
                        '</td>'+
                        '<input type="hidden"  name="FOOD_INDEX_MENU_TYPE[]" id="FOOD_INDEX_MENU_TYPE'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="3" >'+
                    '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
        $('.tbody3').append(tr);
    };

    $('.tbody3').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  



$('.addRow4').on('click',function(){
        addRow4();
        $('select').select2();
        });

    function addRow4(){
        var count = $('.tbody4').children('tr').length;
            var tr =   '<tr>'+
            '<td>'+
            '<select name="FOOD_INDEX_BOARD_PERSON[]" id="FOOD_INDEX_BOARD_PERSON'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
            '<option value="" >--กรุณาเลือก--</option>'+
            '@foreach ($infopersons as $infoperson)'+
            '<option value="{{ $infoperson->ID}}" >{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>'+
            '@endforeach'+     
            '</select>'+ 
            '</td>'+
            '<td>'+
            '<select name="FOOD_INDEX_BOARD_POSITION[]" id="FOOD_INDEX_BOARD_POSITION'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
            '<option value="" >--กรุณาเลือกตำแหน่ง--</option>'+
            '<option value="1" >ประธาน</option>'+
            '<option value="2" >กรรมการ</option>'+
            '</select>'+ 
            '</td>'+
            '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
            '</tr>';
        $('.tbody4').append(tr);
    };

    $('.tbody4').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
  
  

  
function conversion(number){
        
      var STAPLE_TOTAL=document.getElementById("FOOD_INDEX_STAPLE_TOTAL"+number).value;
      var STAPLE_UNIT=document.getElementById("FOOD_INDEX_STAPLE_UNIT"+number).value;
      var STAPLE_BUY_UNIT=document.getElementById("FOOD_INDEX_STAPLE_BUY_UNIT"+number).value;
      var  IDREF =document.getElementById("IDREF"+number).value;
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mfood.conversion')}}",
                   method:"GET",
                   data:{STAPLE_TOTAL:STAPLE_TOTAL,STAPLE_UNIT:STAPLE_UNIT,STAPLE_BUY_UNIT:STAPLE_BUY_UNIT,IDREF:IDREF,_token:_token},
                   success:function(result){
                      $('.showconver'+number).html(result);
                   }
           })   

  }



  
  function calvalue(number){
        
        var STAPLEBUYTOTAL=document.getElementById("FOOD_INDEX_STAPLE_BUY_TOTAL"+number).value;
        var STAPLEPERUNIT=document.getElementById("FOOD_INDEX_STAPLE_PERUNIT"+number).value;
        var  IDREF =document.getElementById("IDREF"+number).value;
        //alert(PERSON_ID);
        
        var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('mfood.calvalue')}}",
                     method:"GET",
                     data:{STAPLEBUYTOTAL:STAPLEBUYTOTAL,STAPLEPERUNIT:STAPLEPERUNIT,IDREF:IDREF,_token:_token},
                     success:function(result){
                        $('.showvalue'+number).html(result);
                        findTotal();
                     }
             })   
  
    }
  



    function findTotal(){
    var arr = document.getElementsByName('FOOD_INDEX_STAPLE_PICE[]');
    var tot=0;

    count = $('.tbody0').children('tr').length;
    for(var i=0;i<count;i++){
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('total').value =tot.toFixed(2);
    document.getElementById('total2').value =tot.toFixed(0);
}


$('body').on('keydown', 'input,textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
      
        focusable = form.find('input,a,button,textarea').filter(':visible');
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