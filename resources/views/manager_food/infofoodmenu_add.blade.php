@extends('layouts.food')
   
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
<?php


  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

  
?>
<br>
<br>
<center>    
     <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B> เพิ่มรายการอาหาร</B></h3>
               

            </div>
        <div class="block-content block-content-full">
            <form action="{{ route('mfood.infofoodmenu_save') }}" method="post" enctype="multipart/form-data">
                @csrf       

                <div class="row push">
                <div class="col-lg-4">
                <div class="form-group"> 
                <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>
                </div>
                <div class="form-group">                         
                        <img src="{{ asset('image/default.jpg')}}" id="add_upload_preview" alt="Image" class="img-thumbnail" style="height:300px; width:350px;"/>
                
                </div>
                <div class="form-group"> *ขนาดรูปไม่เกิน 350 x 350 pixel
                       
                        <input style="font-family: 'Kanit', sans-serif;" type="file" name="FOOD_IMG" id="FOOD_IMG" class="form-control input-sm" onchange="readURL(this)" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>                
                </div>
                <div class="col-sm-8">
                    <div class="row push">                
                            <div class="col-sm-2 text-right">
                            <label>ชื่ออาหาร :</label>
                            </div> 
                            <div class="col-lg-10 ">              
                                <input  name="FOOD_MENU_NAME" id="FOOD_MENU_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                            </div>                 
                            </div> 

                            <div class="row push">                
                            <div class="col-sm-2 text-right">
                            <label>วันที่บันทึก :</label>
                            </div> 
                            <div class="col-lg-2 ">    
                            {{DateThai($date)}}

                                <input type="hidden"  name="FOOD_MENU_SAVE_DATE" id="FOOD_MENU_SAVE_DATE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$date}}" >
                            </div> 
                            <div class="col-sm text-right">
                            <label>ประเภทอาหาร :</label>
                            </div> 
                            <div class="col-lg-6 ">              
                            <select name="FOOD_MENU_TYPE" id="FOOD_MENU_TYPE" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                @foreach ($infotypes as $infotype)
                                 
                                    <option value="{{ $infotype->FOOD_TYPE_ID}}" >{{$infotype->FOOD_TYPE_NAME}}</option>
                                 
                                @endforeach      
                                </select> 
                            </div>                 
                            </div> 
                            <div class="row push">  
                            <div class="col-sm text-right">
                            <label>หมายเหตุ :</label>
                            </div> 
                            <div class="col-lg-10 ">              
                                <input  name="FOOD_MENU_REMARK" id="FOOD_MENU_REMARK" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                            </div>      

                            </div> 
                        

        <div class="row push">
                    <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                   
                                    <li class="nav-item">
                                     <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:13px;">รายการวัตถุดิบที่ต้องใช้</a>  
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:13px;">วิธีทำอาหาร</a>
                                    </li>
                              
                                </ul>
                    <div class="block-content tab-content">
                   
                                    <div class="tab-pane active" id="object1" role="tabpanel">

                                    <div class="table-responsive"> 
                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                            <thead style="background-color: #F0F8FF;">
                                <tr height="40">
                                    <td style="text-align: center;font-size: 13px;" >รายการวัตถุดิบที่ต้องใช้</td> 
                                    <td style="text-align: center;font-size: 13px;" width="15%">ประเภท</td>      
                                    <td style="text-align: center;font-size: 13px;" width="15%">ปริมาณ</td>   
                                    <td style="text-align: center;font-size: 13px;" width="15%">หน่วย</td>                                                       
                                    <td style="text-align: center;font-size: 13px;" width="8%">
                                        <a  class="btn btn-hero-sm btn-hero-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                    </td>
                                </tr>
                            </thead>
                            <tbody class="tbody1"> 
                            
                                <tr height="40">
                                    <td>
                                        <select name="FOOD_MENU_STAPLE_ID[]" id="FOOD_MENU_STAPLE_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                            <option value="" >--กรุณาเลือก--</option>
                                            @foreach ($infosups as $infosup)
                                                <option value="{{ $infosup->ID}}" >{{$infosup->SUP_NAME}}</option>
                                             @endforeach     
                                        </select>  
                                    </td>
                                    <td>
                                        <select name="FOOD_MENU_STAPLE_TYPE[]" id="FOOD_MENU_STAPLE_TYPE[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                            <option value="" >--เลือก--</option>
                                            <option value="1" >เนื้อสัตว์</option>
                                            <option value="2" >ผัก</option>
                                            <option value="3" >เครื่องปรุง</option>
                                            <option value="4" >วัตถุดิบ</option>
                                        </select>  
                                    </td>
                                    <td>
                                        <input  name="FOOD_MENU_STAPLE_AMOUNT[]" id="FOOD_MENU_STAPLE_AMOUNT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >   
                                    </td>
                                    <td>
                                  
                                    <select name="FOOD_MENU_UNIT_ID[]" id="FOOD_MENU_UNIT_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                    @foreach ($infounits as $infounit)
                                              
                                                <option value="{{ $infounit->FOOD_UNIT_ID}}" >{{$infounit->FOOD_UNIT_NAME}}</option>
                                               
                                    @endforeach        
                                    </select>             

                                    </td>  
                                    <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                </tr> 

                               

                            </tbody>
                        </table> 
                        <br> 
                    </div>

                                     </div>
                                     <div class="tab-pane" id="object2" role="tabpanel">

                                     
        <div class="row push">                
    
            <div class="col-lg-12 ">              
            <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                            <thead style="background-color: #F0F8FF;">
                                <tr height="40">
                                    <td style="text-align: center;font-size: 13px;" >ขั้นตอนการทำอาหาร</td>                                                         
                                    <td style="text-align: center;font-size: 13px;" width="8%">
                                        <a  class="btn btn-hero-sm btn-hero-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                    </td>
                                </tr>
                            </thead>
                            <tbody class="tbody2">  
                                           
                                <tr height="40">
                                    <td>
                                        <input  name="FOOD_MENU_DETAIL[]" id="FOOD_MENU_DETAIL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;"  >                           
                                    </td>  
                                    <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                </tr>
                                                 
                            </tbody>
                        </table>  
                     
            </div>                 
        </div> 
    </div>
</div>
        </div>

<div class="footer">
<div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                    <a href="{{ url('manager_food/infofoodmenu')}}" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

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

   

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}

$('.addRow').on('click',function(){
        addRow();
        });

    function addRow(){
        var count = $('.tbody1').children('tr').length;
            var tr =   '<tr>'+
                        '<td>'+
                        '<select name="FOOD_MENU_STAPLE_ID[]" id="FOOD_MENU_STAPLE_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;font-size: 13px;" >'+
                        '<option value="" >--กรุณาเลือก--</option>'+
                        '@foreach ($infosups as $infosup)'+
                        '<option value="{{ $infosup->ID}}" >{{$infosup->SUP_NAME}}</option>'+
                        '@endforeach'+     
                        '</select>'+             
                        '</td>'+
                        '<td>'+
                        '<select name="FOOD_MENU_STAPLE_TYPE[]" id="FOOD_MENU_STAPLE_TYPE[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;font-size: 13px;" >'+
                        '<option value="" >--เลือก--</option>'+
                        '<option value="1" >เนื้อสัตว์</option>'+
                        '<option value="2" >ผัก</option>'+
                        '<option value="3" >เครื่องปรุง</option>'+
                        '</select>'+             
                        '</td>'+
                        '<td>'+
                        '<input  name="FOOD_MENU_STAPLE_AMOUNT[]" id="FOOD_MENU_STAPLE_AMOUNT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;font-size: 13px;" >'+   
                        '</td>'+
                        '<td>'+ 
                        '<select name="FOOD_MENU_UNIT_ID[]" id="FOOD_MENU_UNIT_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;font-size: 13px;" >'+
                        '@foreach ($infounits as $infounit)'+   
                        '<option value="{{ $infounit->FOOD_UNIT_ID}}" >{{$infounit->FOOD_UNIT_NAME}}</option>'+      
                        '@endforeach'+     
                        '</select>'+             
                        '</td>'+  
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></td>'+
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
                '<input name="FOOD_MENU_DETAIL[]" id="FOOD_MENU_DETAIL[]" class="form-control qtys" style=" font-family: \'Kanit\', sans-serif;font-size: 13px;">'+
                '</td>'+ 
                '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></td>'+
            '</tr>';
        $('.tbody2').append(tr);
    };

    $('.tbody2').on('click','.remove', function(){
        $(this).parent().parent().remove();
});   
  
</script>
<script>
        function readURL(input) {
            var fileInput = document.getElementById('FOOD_IMG');
            var url = input.value;
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();

                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#add_upload_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }else{
                    alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                    fileInput.value = '';
                    return false;
                }
            }
</script>


@endsection