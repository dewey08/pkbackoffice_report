@extends('layouts.plan')   
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
        .form-control {
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
<body onload="run01();";>
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default" style="text-align: left">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดตัวชี้วัด ปีงบประมาณ {{$planyear->PLAN_YEAR}}</B></h3>

            </div>
            <div class="block-content block-content-full">
<form  method="post" action="{{ route('mplan.plan_kpisaveupdatedetail') }}" enctype="multipart/form-data">
@csrf

        <input type="hidden" name="KPI_ID" id="KPI_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infokpi->KPI_ID}}" >

        <div class="col-sm-12">
        <div class="row push">
     
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ยุทธศาสตร์ :              
        </label>
        </div> 
        <div class="col-lg-3" style="text-align: left">
        {{$infokpi->STRATEGIC_NAME}}
        </div> 

        <div class="col-lg-2" style="text-align: left">
        <label >                           
        เป้าประสงค์ :              
        </label>
        </div> 
        <div class="col-lg-4" style="text-align: left">
        {{$infokpi->TARGET_NAME}}
        </div> 
   
        </div>

        <div class="row push">
            <div class="col-lg-2" style="text-align: left">
                <label >                           
                    ตัวชี้วัด :              
                </label>
            </div> 
        <div class="col-lg-3" style="text-align: left">
                    {{$infokpi->KPI_NAME}}
        </div> 
        <div class="col-lg-2" style="text-align: left">
                <label >                           
                    รายละเอียด :              
                </label>
        </div> 
        <div class="col-lg-4">
                    <input name="KPI_DETAIL" id="KPI_DETAIL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_DETAIL}}" >
        </div> 

        </div>

        <div class="row push">
            <div class="col-lg-2" style="text-align: left">
                <label >                           
                    หน่วยวัด :              
                </label>
            </div> 
        <div class="col-lg-3" style="text-align: left">
                    <input name="KPI_UNIT" id="KPI_UNIT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_UNIT}}" >   
        </div> 
        <div class="col-lg-2" style="text-align: left">
                <label >                           
                     น้ำหนัก :              
                </label>
        </div> 
        <div class="col-lg-4">
                    <input name="KPI_WEIGHT" id="KPI_WEIGHT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkmunny(this)"  value="{{$infokpi->KPI_WEIGHT}}" >     
        </div> 

        </div>
        <div class="row push">
            <div class="col-lg-2" style="text-align: left">
                <label >                           
                      เป้าหมาย :              
                </label>
            </div> 
        <div class="col-lg-3" style="text-align: left">
                    <input name="KPI_GOAL" id="KPI_GOAL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_GOAL}}" >   
        </div> 
        <div class="col-lg-2" style="text-align: left">
                <label >                           
                    ค่ายอมรับ :              
                </label>
        </div> 
        <div class="col-lg-4">
                    <input name="KPI_ACCEP" id="KPI_ACCEP" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_ACCEP}}" >     
        </div> 

        </div>
        <div class="row push">
            <div class="col-lg-2" style="text-align: left">
                <label >                           
                    ค่าวิกฤติ :              
                </label>
            </div> 
        <div class="col-lg-3" style="text-align: left">
                <input name="KPI_CRITICAL" id="KPI_CRITICAL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_CRITICAL}}" >   
        </div> 
    

        </div>
        <div class="row push" style="text-align: center"> 

                            <div class="col-lg-6" style="text-align: left">
                           
                            <div class="row push">
                                <div class="col-lg-6" style="text-align: left">
                                <label >                           
                                คะแนนระดับ        
                                </label>
                            </div>
                            </div>
                        

                            @if($countkpilevel == 0)

                                    @for ($i = 1; $i <= 5; $i++)


                                    <div class="row push">
                                            <div class="col-lg-4" style="text-align: left">
                                                <label >                           
                                                ระดับ {{$i}} :              
                                                </label>
                                            </div> 
                                        <div class="col-lg-6" style="text-align: left">
                                                <input type="hidden" name="KPI_LEVEL_NUM[]" id="KPI_LEVEL_NUM[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$i}}" >   
                                                <input name="KPI_LEVEL[]" id="KPI_LEVEL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="" >   
                                        </div> 
                                    </div> 

                                    @endfor
                            @else

                                    <?php $number = 0; ?>
                                    @foreach ($infoplankpilevels as $infoplankpilevel)
                                        <?php $number++; ?>

                                            <div class="row push">
                                                    <div class="col-lg-4" style="text-align: left">
                                                        <label >                           
                                                        ระดับ {{$number}} :              
                                                        </label>
                                                    </div> 
                                                <div class="col-lg-6" style="text-align: left">
                                                        <input type="hidden" name="KPI_LEVEL_NUM[]" id="KPI_LEVEL_NUM[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$number}}" >   
                                                        <input name="KPI_LEVEL[]" id="KPI_LEVEL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infoplankpilevel->KPI_LEVEL}}" >   
                                                </div> 
                                            </div> 


                                    @endforeach


                            @endif

                            </div> 

                            <div class="col-lg-6" style="text-align: left">

                            <div class="row push">
                                <div class="col-lg-6" style="text-align: left">
                                    <label >                           
                                    คะแนนย้อนหลัง 3 ปี       
                                    </label>
                                </div>
                            </div>
                            <div class="row push">
                                    <div class="col-lg-4" style="text-align: left">
                                    <label >                           
                                                        ปี {{$planyear->PLAN_YEAR-1}} :              
                                    </label>
                                    </div> 
                                    <div class="col-lg-6" style="text-align: left">
                                                          
                                                        <input name="REYEAR_1" id="REYEAR_1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->REYEAR_1}}" >   
                                    </div> 
                            </div> 
                            <div class="row push">
                                    <div class="col-lg-4" style="text-align: left">
                                    <label >                           
                                                        ปี {{$planyear->PLAN_YEAR-2}} :              
                                    </label>
                                    </div> 
                                    <div class="col-lg-6" style="text-align: left">
                                                          
                                                        <input name="REYEAR_2" id="REYEAR_2" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->REYEAR_2}}" >   
                                    </div> 
                            </div> 
                            <div class="row push">
                                    <div class="col-lg-4" style="text-align: left">
                                    <label >                           
                                                        ปี {{$planyear->PLAN_YEAR-3}} :              
                                    </label>
                                    </div> 
                                    <div class="col-lg-6" style="text-align: left">
                                                          
                                                        <input name="REYEAR_3" id="REYEAR_3" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->REYEAR_3}}" >   
                                    </div> 
                            </div> 

                            </div> 
                        </div>
        </div>

                        
        <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">คะแนน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ผู้รับผิดชอบ</a>
                                    </li>
                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">

                                    <div class="row push">
                                        <div class="col-lg-2" style="text-align: left">
                                            <label >                           
                                                ผลงาน :              
                                            </label>
                                        </div> 
                                        <div class="col-lg-3" style="text-align: left">
                                                <input name="KPI_RESULTS" id="KPI_RESULTS" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_RESULTS}}" >   
                                        </div> 
                                        <div class="col-lg-2" style="text-align: left">
                                            <label >                           
                                                คะแนน :              
                                            </label>
                                        </div> 
                                        <div class="col-lg-4">
                                                <input name="KPI_SCORE" id="KPI_SCORE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  OnKeyPress="return chkmunny(this)"  value="{{$infokpi->KPI_SCORE}}" >     
                                        </div> 

                                    </div>

                                    <table width="90%">

                                        <tr>
                                                <td> <label >   ตุลาคม : </label > </td>
                                                <td> <input name="KPI_SCORE_M10" id="KPI_SCORE_M10" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M10}}" >     </td>
                                                <td> <label >   มกราคม : </label >   </td>
                                                <td> <input name="KPI_SCORE_M1" id="KPI_SCORE_M1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M1}}" >     </td>
                                                <td> <label >   เมษายน :  </label >   </td>
                                                <td> <input name="KPI_SCORE_M4" id="KPI_SCORE_M4" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M4}}" >     </td>    
                                                <td> <label >   กรกฎาคม : </label > </td>
                                                <td> <input name="KPI_SCORE_M7" id="KPI_SCORE_M7" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M7}}" >     </td>
    
                                                
                                        </tr>   

                                        <tr>
                                            
                                                <td> <label >   พฤศจิกายน : </label > </td>
                                                <td> <input name="KPI_SCORE_M11" id="KPI_SCORE_M11" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M11}}" >     </td>
                                                <td> <label >   กุมภาพันธ์ : </label >   </td>
                                                <td> <input name="KPI_SCORE_M2" id="KPI_SCORE_M2" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M2}}" >     </td>
                                                <td> <label >   พฤษภาคม :  </label >   </td>
                                                <td> <input name="KPI_SCORE_M5" id="KPI_SCORE_M5" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M5}}" >     </td>
                                                <td> <label >   สิงหาคม : </td>
                                                <td> <input name="KPI_SCORE_M8" id="KPI_SCORE_M8" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M8}}" >     </td>
        

                                        </tr>   

                                        <tr>
                                                <td> <label >   ธันวาคม :  </label >   </td>
                                                <td> <input name="KPI_SCORE_M12" id="KPI_SCORE_M12" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M12}}" >     </td>
                                                <td> <label >   มีนาคม :  </label >   </td>
                                                <td> <input name="KPI_SCORE_M3" id="KPI_SCORE_M3" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M3}}" >     </td>
                                                <td> <label >   มิถุนายน : </label > </td>
                                                <td> <input name="KPI_SCORE_M6" id="KPI_SCORE_M6" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M6}}" >     </td>
                                                <td><label >   กันยายน : </label > </td>
                                                <td> <input name="KPI_SCORE_M9" id="KPI_SCORE_M9" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infokpi->KPI_SCORE_M9}}" >     </td>        
                                        </tr>   
                                       
                                      
                                    </table>
                                      
                                 
                                </div>
                               
                                <div class="tab-pane" id="object2" role="tabpanel">

                                <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border-color:#000000;" >ชื่อ สกุล</td>
                                                <td style="text-align: center;border-color:#000000;" width="30%">ตำแหน่ง</td>
                                                <td style="text-align: center;border-color:#000000;" width="15%">ระดับ</td>

                                                <td style="text-align: center;border-color:#000000;" width="12%"><a  class="btn btn-success fa fa-plus addRow" style="color:#FFFFFF;"></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1">   
                                   

                                        @if($countkpiperson == 0)
                                        <tr>
                                            <td>
                                                    <select name="PERSON_ID[]" id="PERSON_ID0" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition(0);checklevel(0)">
                                                                    <option value="">--กรุณาเลือกผู้รับผิดชอบ--</option>
                                                                        @foreach ($PERSONALLs as $PERSONALL) 
                                                                            <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                
                                                                        @endforeach 
                                                    </select> 
                                                    
                                            </td>
                                            <td><div class="showposition0"></div></td>
                                            <td><div class="showlevel0"></div></td>
                                            <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                        </tr>
                                         @else

                                                @foreach ($infokpipersons as $infokpiperson)
                                                <tr>
                                                    <td>
                                                 <?php $checkper = 0; ?>   
                                                <select name="PERSON_ID[]" id="PERSON_ID0" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkposition(0);checklevel(0)">
                                                                <option value="">--กรุณาเลือกผู้รับผิดชอบ--</option>
                                                                    @foreach ($PERSONALLs as $PERSONALL) 
                                                                    @if($PERSONALL ->ID == $infokpiperson->KPI_PERSON_HR_ID)
                                                                        <option value="{{ $PERSONALL ->ID  }}" selected>{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                                    @else
                                                                        <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                                    @endif                                                    
                                                                    
                                                                    @endforeach 
                                                </select> 

                                                    </td>

                                                    <td><div class="showposition{{$checkper}}"></div></td>
                                                    <td><div class="showlevel{{$checkper}}"></div></td>
                                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                                </tr>
                                                <?php $checkper++; ?>
                                                @endforeach

                                         @endif   
                                        </td>

                                       
                                    </tr>
                                    </tbody>   
                                    </table>

                               </div>
                                </div>
                            </div>
                        </div>
        </div>

  


        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info"  style=" font-family: 'Kanit', sans-serif;"  >บันทึก</button>
        <a href="{{ url('manager_plan/plan_kpiadddetail')  }}" class="btn btn-hero-sm btn-hero-danger"  style=" font-family: 'Kanit', sans-serif;"  onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  

            
        



        </div>
    </div>    
</div>

  
@endsection

@section('footer')
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('select').select2({
            width: '100%'
         });
});
</script>


<script>

$('.addRow').on('click',function(){
         addRow();
         $('select').select2({
            width: '100%'
         });
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
         var tr ='<tr>'+
                '<td>'+ 
                '<select name="PERSON_ID[]" id="PERSON_ID'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition('+count+');checklevel('+count+');">'+
                '<option value="">--กรุณาเลือกผู้รับผิดชอบ--</option>'+
                '@foreach ($PERSONALLs as $PERSONALL)'+                                                   
                '<option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_PREFIX_NAME}}{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+
                '<td><div class="showposition'+count+'"></div></td>'+
                '<td><div class="showlevel'+count+'"></div></td>'+
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });
//-------------------------------------------------


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



 //======================หาตำแหน่งผู้เดินทาง===========================
function run01(){
    var count = $('.tbody1').children('tr').length;
    //alert(count);
    var number;
        for (number = 0; number < count; number++) { 
            checkposition(number);
            checklevel(number);
            
        }
  
}

function checkposition(number){
      
    
      var PERSON_ID=document.getElementById("PERSON_ID"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.checkposition')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showposition'+number).html(result);
                   }
           })

        

  }

  function checklevel(number){
      
    
      var PERSON_ID=document.getElementById("PERSON_ID"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.checklevel')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showlevel'+number).html(result);
                   }
           })

  }

  function chkmunny(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
                ele.onKeyPress = vchar;
        }

</script>

@endsection