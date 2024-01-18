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

      .text-pedding{
   padding-left:10px;
   padding-right:10px;
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
<br>
<br>
<center>    
     <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ประมวลผลเมนูรายวัน</B></h3>
               

            </div>
        <div class="block-content block-content-full">
            <form action="{{ route('mfood.infofoodbill_process') }}" method="post">
                @csrf   
                


                <input type="hidden" name="FOOD_BILL_DAY_ID" id="FOOD_BILL_DAY_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$inforef->FOOD_BILL_DAY_ID}}" >
                <div class="row push">
                     <div class="col-sm-3">
                     <label>เลขทะเบียน {{$inforef->FOOD_BILL_DAY_NUMBER}}  </label>
                     </div>
                     <div class="col-sm-3">
                     <label>เรื่อง {{$inforef->FOOD_BILL_DAY_NAME}}  </label>
                     </div>
                </div>    

            <div class="row push">
                <div class="col-sm-1 text-right">
                    <label>มื้อเช้า :</label>
                </div> 
                <div class="col-sm-11">

                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #F0F8FF;">
                                            <tr>
                                                <td style="text-align: center;">เมนูอาหาร</td>
                                                <td style="text-align: center;" width="20%">จำนวนหน่วย</td>
                                             
                                           
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-success fa fa-plus addRow1" style="color:#FFFFFF;"></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        
                                        @if($check == 0)
                                        <tr>         
                                    <td> 
                                    <select name="FOOD_BILL_MENU1[]" id="FOOD_BILL_MENU1[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                        <option value="" >--กรุณาเลือก--</option>
                                        @foreach ($infofoods as $infofood)
                                        <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                        @endforeach   
                                    </select>
                                    </td>
                                    <td>
                                    <input name="FOOD_BILL_MENU_AMOUNT1[]" id="FOOD_BILL_MENU_AMOUNT1[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                                    </td>
                                
                                
                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                </tr>
                     

                             @else

                                    @foreach ($infomenutype1s as $infomenutype1)
                                                    <tr>         
                                                    <td> 
                                                    <select name="FOOD_BILL_MENU1[]" id="FOOD_BILL_MENU1[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
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
                                                    <td>
                                                    <input name="FOOD_BILL_MENU_AMOUNT1[]" id="FOOD_BILL_MENU_AMOUNT1[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infomenutype1->FOOD_BILL_MENU_AMOUNT}}">
                                                    </td>
                                                
                                                
                                                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                                </tr>
                                        @endforeach   

                                            
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
                                <td style="text-align: center;" width="20%">จำนวนหน่วย</td>
                               
                           
                                <td style="text-align: center;" width="12%"><a  class="btn btn-success fa fa-plus addRow2" style="color:#FFFFFF;"></a></td>
                            </tr>
                        </thead> 
                        <tbody class="tbody2"> 
                        @if($check == 0)
                            <tr>
                                        
                                        <td> 
                                        <select name="FOOD_BILL_MENU2[]" id="FOOD_BILL_MENU2[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                            <option value="" >--กรุณาเลือก--</option>
                                            @foreach ($infofoods as $infofood)
                                            <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                            @endforeach   
                                        </select>
                                        </td>
                                        <td>
                                        <input name="FOOD_BILL_MENU_AMOUNT2[]" id="FOOD_BILL_MENU_AMOUNT2[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                
                                    
                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                    </tr>

                      
                        @else
                                  
                                    @foreach ($infomenutype2s as $infomenutype2)
                                    <tr>
                                        <td> 
                                        <select name="FOOD_BILL_MENU2[]" id="FOOD_BILL_MENU2[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
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
                                        <td>
                                        <input name="FOOD_BILL_MENU_AMOUNT2[]" id="FOOD_BILL_MENU_AMOUNT2[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{ $infomenutype2->FOOD_BILL_MENU_AMOUNT}}">
                                        </td>
                                
                                    
                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                    </tr>
                

                                @endforeach 
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
                                <td style="text-align: center;" width="20%">จำนวนหน่วย</td>
                             
                           
                                <td style="text-align: center;" width="12%"><a  class="btn btn-success fa fa-plus addRow3" style="color:#FFFFFF;"></a></td>
                            </tr>
                        </thead> 
                        <tbody class="tbody3"> 
                        @if($check == 0)

                    <tr>
                                
                                <td> 
                                <select name="FOOD_BILL_MENU3[]" id="FOOD_BILL_MENU3[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                <option value="" >--กรุณาเลือก--</option>
                                @foreach ($infofoods as $infofood)
                                <option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>
                                @endforeach   
                            </select>
                                </td>
                                <td>
                                <input name="FOOD_BILL_MENU_AMOUNT3[]" id="FOOD_BILL_MENU_AMOUNT3[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                </td>
                        
                            
                                <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                            </tr>


                    
                      

                    @else
                         @foreach ($infomenutype3s as $infomenutype3)
                                <tr>
                                <td> 
                                <select name="FOOD_BILL_MENU3[]" id="FOOD_BILL_MENU3[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
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
                                <td>
                                <input name="FOOD_BILL_MENU_AMOUNT3[]" id="FOOD_BILL_MENU_AMOUNT3[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{ $infomenutype3->FOOD_BILL_MENU_AMOUNT}}">
                                </td>
                        
                            
                                <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                            </tr>
                            @endforeach      
                    @endif
                            
            
                    </tbody>   
                    </table>

</div>
            </div> 

            <div class="row push">
             
            </div>     

            
            <div class="row push">
                <div class="col-sm-1 text-right">
                    <label>วัตถุดิบ :</label>
                </div> 


                <table class="gwt-table table-striped table-vcenter" style="width: 80%;">
                        <thead style="background-color: #F0F8FF;">
                            <tr>
                                <td style="text-align: center;" width="5%">ลำดับ</td>
                                <td style="text-align: center;">วัตถุดิบ</td>
                                <td style="text-align: center;" width="20%">จำนวน</td>
                                <td style="text-align: center;" width="20%">หน่วย</td>

                               
                            </tr>
                        </thead> 
                        <tbody class="tbody"> 
             
                            <?php $number = 0; ?>
                                    @foreach ($infodetails as $infodetail)
                            <?php $number++; ?>

                            <tr>
                                <td class="text-font" align="center"> 
                                {{$number}}
                                </td>

                                <td class="text-font text-pedding" align="left"> 
                                {{$infodetail->SUP_NAME}}
                                </td>
                                
                                <td class="text-font text-pedding" align="right"> 
                                {{number_format($infodetail->total_sum)}}
                                </td>
                                
                                <td class="text-font" align="center"> 
                            กรัม
                                </td>
                              
                        
                            
                            
                            </tr>
                        
                            @endforeach
                   
                    </tbody>   
                    </table>

            </div>   
             
        <div class="footer">
            <div align="right">
            @if($check != 0)
                <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-info f-kanit fw-1" value="send" >ส่งข้อมูล</button>
             @endif   
                <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-success" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="process" >ประมวลผล</button>
                <a href="{{ url('manager_food/infofoodbillstaple_add/'.$inforef->FOOD_BILL_DAY_ID)}}" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
            </div>
        </div>
        </div>
    </div>
</div>
</form>

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
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

   


  


$('.addRow1').on('click',function(){
        addRow1();
        });

    function addRow1(){
        var count = $('.tbody1').children('tr').length;
            var tr =  '<tr>'+
            '<td>'+
                        '<select name="FOOD_BILL_MENU1[]" id="FOOD_BILL_MENU1[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="" >--กรุณาเลือก--</option>'+
                        '@foreach ($infofoods as $infofood)'+
                        '<option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>'+
                        '@endforeach'+   
                    '</select>'+
                        '</td>'+
                        '<td>'+
                        '<input name="FOOD_BILL_MENU_AMOUNT1[]" id="FOOD_BILL_MENU_AMOUNT1[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
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
                        '<select name="FOOD_BILL_MENU2[]" id="FOOD_BILL_MENU2[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="" >--กรุณาเลือก--</option>'+
                        '@foreach ($infofoods as $infofood)'+
                        '<option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>'+
                        '@endforeach'+ 
                        '</select>'+
                        '</td>'+
                        '<td>'+
                        '<input name="FOOD_BILL_MENU_AMOUNT2[]" id="FOOD_BILL_MENU_AMOUNT2[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
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
            var tr =  '<tr>'+
            '<td>'+ 
                        '<select name="FOOD_BILL_MENU3[]" id="FOOD_BILL_MENU3[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="" >--กรุณาเลือก--</option>'+
                        '@foreach ($infofoods as $infofood)'+
                        '<option value="{{ $infofood->FOOD_MENU_ID}}" >{{$infofood->FOOD_MENU_NAME}}</option>'+
                        '@endforeach'+   
                    '</select>'+
                        '</td>'+
                        '<td>'+
                        '<input name="FOOD_BILL_MENU_AMOUNT3[]" id="FOOD_BILL_MENU_AMOUNT3[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                        '</td>'+
                    '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
        $('.tbody3').append(tr);
    };

    $('.tbody3').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
  




</script>



@endsection