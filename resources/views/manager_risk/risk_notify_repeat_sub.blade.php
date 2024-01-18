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
<br>
<br>
<br>

<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;">รายละเอียดการทบทวน</h3>   
      
                </div> 
            <div class="block-content block-content-full " align="left">


<form  method="post" action="{{ route('mrisk.risk_notify_repeat_sub_save') }}" enctype="multipart/form-data">
@csrf
                                  
<input type="hidden" name = "RISKREP_ID"  id="RISKREP_ID" class="form-control input-lg" value=" {{ $rigreps->RISKREP_ID}}" > 

<input type="hidden" name = "PERSON"  id="PERSON" class="form-control input-lg" value=" {{$id_user}}" > 

<div class="row push">
    <div class="col-sm-2">
    <label style="font-family:'Kanit',sans-serif;">รหัสความเสี่ยง :</label>
    </div> 
    <div class="col-lg-3 " style="font-family:'Kanit',sans-serif;">
        {{ $rigreps->RISKREP_ID}}
    </div> 
    <div class="col-sm-1">
    <label style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่บันทึก :</label>
    </div> 
    <div class="col-lg-1 " style="font-family:'Kanit',sans-serif;font-size:13px;">
        {{ formate($rigreps->RISKREP_DATESAVE)}}
    </div> 
    <div class="col-sm-1">
        <label style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่เกิดเหตุ :</label>
        </div> 
        <div class="col-lg-1 " style="font-family:'Kanit',sans-serif;font-size:13px;">
            {{ formate($rigreps->RISKREP_STARTDATE)}}
        </div>
    <div class="col-sm-1">
        <label style="font-family:'Kanit',sans-serif;font-size:13px;">เวลาเกิดเหตุ :</label>
        </div> 
        <div class="col-lg-1 "style="font-family:'Kanit',sans-serif;font-size:13px;">  
            {{ $rigreps->RISKREP_TIME}}   
    </div> 
   
</div> 

<div class="row push">
<div class="col-sm-2">
<label style="font-family:'Kanit',sans-serif;font-size:13px;">เรื่องความเสี่ยง :</label>
</div> 
<div class="col-lg-3 " style="font-family:'Kanit',sans-serif;font-size:13px;">
    {{ $rigreps->INCIDENCE_SETTING_NAME}}
</div> 
<div class="col-sm-1">
    <label style="font-family:'Kanit',sans-serif;font-size:13px;">สถานที่เกิดเหตุ :</label>
    </div> 
    <div class="col-lg-2 " style="font-family:'Kanit',sans-serif;font-size:13px;">   
        {{ $rigreps->SETUP_GROUPLOCATION_NAME}}  
</div> 
<div class="col-sm-1">
   
    </div> 
    <div class="col-lg-2 ">  
      
</div> 
</div>
    <div class="row push">
        <div class="col-sm-2 ">        
            <label style="font-family:'Kanit',sans-serif;font-size:13px;">ครั้งที่ :</label>
        </div> 
        <div class="col-lg-2 ">
            <input  name="NOTIFY_REPEAT_NO" id="NOTIFY_REPEAT_NO" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;">
        </div>
        <div class="col-sm-2 ">        
            <label style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่ทบทวน :</label>
        </div> 
        <div class="col-lg-2 ">
            <input name="NOTIFY_REPEAT_DATE" id="NOTIFY_REPEAT_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" readonly>
           
        </div>
    <div class="col-sm-2 ">        
        <label style="font-family:'Kanit',sans-serif;font-size:13px;">เอกสารประกอบ :</label>
    </div> 
    <div class="col-lg-2 ">
        <input type="file" name="NOTIFY_REPEAT_FILE" id="NOTIFY_REPEAT_FILE" class=" form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;"> 
    </div>
</div> 
<div class="row push">
    <div class="col-lg-12">
    <div class="block block-rounded block-bordered">
        <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
            <li class="nav-item">
                <a class="nav-link active" href="#object1" style="font-family:'Kanit',sans-serif;font-size:13px;">สรุปการทบทวนในครั้งนี้</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#object2" style="font-family:'Kanit',sans-serif;font-size:13px;">รายการ || รายละเอียด</a>
            </li>
            <li class="nav-item"> 
                <a class="nav-link" href="#object3" style="font-family:'Kanit',sans-serif;font-size:13px;">กรรมการความเสี่ยง</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#object4" style="font-family:'Kanit',sans-serif;font-size:13px;">บุคคลอื่น</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#object5" style="font-family:'Kanit',sans-serif;font-size:13px;">หัวข้อการทบทวน</a>
            </li>  
            <li class="nav-item">
                <a class="nav-link" href="#object6" style="font-family:'Kanit',sans-serif;font-size:13px;">บรรยายสรุป</a>
            </li> 
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane active" id="object1" role="tabpanel">                                      
             <table class="table gwt-table" >
                <thead>
                    <tr>                         
                            <td style="text-align: center;font-size:13px;">รายการทบทวนที่สรุป</td>
                    
                            <td style="text-align: center;" width="8%">
                                <a  class="btn btn-success fa fa-plus-square addRow" style="color:#FFFFFF;"></a>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="tbody1">
                        <tr>                                            
                            <td>
                                <input name="INFER_REPEAT_DETAIL[]" id="INFER_REPEAT_DETAIL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size:13px;" >
                            </td>                        
                            <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="object2" role="tabpanel">
                <table class="table gwt-table" >
                    <thead>
                        <tr>                           
                            <td style="text-align: center;font-size:13px;">รายการสรุป</td>                    
                            <td style="text-align: center;" width="8%">
                                <a  class="btn btn-success fa fa-plus-square addRow2" style="color:#FFFFFF;"></a>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="tbody2">
                        <tr>                            
                            <td>
                                <input name="LIST_INFER_DETAIL[]" id="LIST_INFER_DETAIL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size:13px;" >
                            </td>                        
                            <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="object3" role="tabpanel">
                <table class="table gwt-table" >
                    <thead>
                        <tr>
                            <td style="text-align: center;font-size:13px;">คณะกรรมการที่เข้าร่วม</td>                    
                            <td style="text-align: center;" width="8%">
                                <a  class="btn btn-success fa fa-plus-square addRow3" style="color:#FFFFFF;"></a>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="tbody3">
                        <tr>                            
                            <td>
                                <select name="BOARD_ID[]" id="BOARD_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size:13px;" onchange="checkposition(0);checklevel(0)">
                                    <option value="">--กรุณาเลือกคณะกรรมการ--</option>   
                                    @foreach($infopers as $infoper)
                                        <option value="{{ $infoper-> ID}}" >{{ $infoper-> HR_FNAME}}&nbsp;&nbsp; {{ $infoper-> HR_LNAME}}</option>
                                    @endforeach                                    
                                 </select>    
                            </td>
                        
                            <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

          
            <div class="tab-pane" id="object4" role="tabpanel">         
                <table class="table gwt-table" >
                    <thead>
                        <tr>
                          
                            <td style="text-align: center;font-size:13px;">ชื่อ</td>
                            <td style="text-align: center;font-size:13px;">นามสกุล</td>
                    
                            <td style="text-align: center;" width="8%">
                                <a  class="btn btn-success fa fa-plus-square addRow4" style="color:#FFFFFF;"></a>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="tbody4">
                        <tr> 
                           
                            <td>
                                <input name="BOARD_OUT_FNAME[]" id="BOARD_OUT_FNAME[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size:13px;" >
                            </td>
                            <td>
                                <input name="BOARD_OUT_LNAME[]" id="BOARD_OUT_LNAME[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size:13px;" >
                            </td>
                        
                            <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                        </tr>
                    </tbody>
                </table>
         
            </div>
            <div class="tab-pane" id="object5" role="tabpanel">           
                <table class="table gwt-table" >
                    <thead>
                        <tr>
                          
                            <td style="text-align: center;font-size:13px;">หัวข้อการทบทวน</td>
                            <td style="text-align: center;font-size:13px;">รายละเอียด</td>
                            <td style="text-align: center;" width="8%">
                                <a  class="btn btn-success fa fa-plus-square addRow5" style="color:#FFFFFF;"></a>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="tbody5">
                        <tr> 
                           
                            <td>
                                <input name="TOPIC_REPEAT_HEAD[]" id="TOPIC_REPEAT_HEAD[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size:13px;" >
                            </td>
                            <td>
                                <input name="TOPIC_REPEAT_DETAIL[]" id="TOPIC_REPEAT_DETAIL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size:13px;" >
                            </td>
                            <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                        </tr>
                    </tbody>
                </table>
         
            </div>
           
            <div class="tab-pane" id="object6" role="tabpanel">
             
                        <textarea rows="4" cols="50" id="NOTIFY_REPEAT_DETAIL" name="NOTIFY_REPEAT_DETAIL" class="form-control" style=" font-family: 'Kanit', sans-serif;background-color: #F0F8FF;">

                        </textarea>
                
                <br>
            </div>           
        </div>
    </div>
</div>
</div>
</div>

<div class="modal-footer">
    <div align="right">
    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
    <a href="{{ url('manager_risk/risk_notify_repeat/'.$rigreps->RISKREP_ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
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
<script>
   $('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var tr =    '<tr>'+               
                '<td>'+
                '<input name="INFER_REPEAT_DETAIL[]" id="INFER_REPEAT_DETAIL[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+               
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
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
                '<input name="LIST_INFER_DETAIL[]" id="LIST_INFER_DETAIL[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;font-size:13px;" >'+
                '</td>'+               
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
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
                '<select name="BOARD_ID[]" id="BOARD_ID" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;font-size:13px;" onchange="checkposition(0);checklevel(0)">'+
                '<option value="">--กรุณาเลือกคณะกรรมการ--</option> '+  
                '@foreach($infopers as $infoper)'+
                '<option value="{{ $infoper-> ID}}" >{{ $infoper-> HR_FNAME}}&nbsp;&nbsp; {{ $infoper-> HR_LNAME}}</option>'+
                '@endforeach'+                                    
                '</select>'+    
                '</td>'+               
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody3').append(tr);
    };

    $('.tbody3').on('click','.remove', function(){
        $(this).parent().parent().remove();
});

$('.addRow4').on('click',function(){
        addRow4();
    });

    function addRow4(){
    var count = $('.tbody4').children('tr').length;
        var tr =   '<tr>'+                
                '<td>'+
                '<input name="BOARD_OUT_FNAME[]" id="BOARD_OUT_FNAME[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size:13px;" >'+
                '</td>'+
                '<td>'+
                '<input name="BOARD_OUT_LNAME[]" id="BOARD_OUT_LNAME[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size:13px;" >'+                           
                '</td>'+               
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody4').append(tr);
    };

    $('.tbody4').on('click','.remove', function(){
        $(this).parent().parent().remove();
});

$('.addRow5').on('click',function(){
        addRow5();
    });

    function addRow5(){
    var count = $('.tbody5').children('tr').length;
        var tr =   '<tr>'+                
                '<td>'+
                '<input name="TOPIC_REPEAT_HEAD[]" id="TOPIC_REPEAT_HEAD[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;font-size:13px;" >'+
                '</td>'+ 
                '<td>'+
                ' <input name="TOPIC_REPEAT_DETAIL[]" id="TOPIC_REPEAT_DETAIL[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;font-size:13px;" >'+
                '</td>'+              
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody5').append(tr);
    };

    $('.tbody5').on('click','.remove', function(){
        $(this).parent().parent().remove();
});



</script>
@endsection