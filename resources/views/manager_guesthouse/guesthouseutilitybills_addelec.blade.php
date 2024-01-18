@extends('layouts.guesthouse')   
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
 
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);

    use Illuminate\Support\Facades\DB;

?>
        
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
      
            
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;">
                    <div class="row">
                        <div class="col-sm-2" align="left">
                        <B>รายการ ค่าไฟฟ้า บ้านพัก</B> 
                    </div>     
                        <div class="col-md-1" style="  font-size: 13px;";>
                            ประจำปี 
                            </div>
                            <div class="col-md-1">
                            <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">
                                  
                                @foreach ($budgets as $budget)
                                                         @if($budget->LEAVE_YEAR_ID == $year_id)                                                     
                                                     <option value="{{ $budget ->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                                         @else
                                                     <option value="{{ $budget ->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                                     @endif
                                                                       
                                             @endforeach                           
            
                             </select>
                        </div>   
                        <div class="col-md-1"  style="  font-size: 13px;";>
                            เดือน
                        </div>
                        <div class="col-md-2">
                            <select name="MONTH_ID" id="MONTH_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">
                                   
                                   @if($m_budget == 1)<option value="1" selected>มกราคม</option>@else<option value="1">มกราคม</option>@endif
                                   @if($m_budget == 2)<option value="2" selected>กุมภาพันธ์</option>@else<option value="2" >กุมภาพันธ์</option>@endif
                                   @if($m_budget == 3)<option value="3" selected>มีนาคม</option>@else<option value="3" >มีนาคม</option>@endif
                                   @if($m_budget == 4)<option value="4" selected>เมษายน</option>@else<option value="4" >เมษายน</option>@endif
                                   @if($m_budget == 5)<option value="5" selected>พฤษภาคม</option>@else<option value="5" >พฤษภาคม</option>@endif
                                   @if($m_budget == 6)<option value="6" selected>มิถุนายน</option>@else<option value="6" >มิถุนายน</option>@endif
                                   @if($m_budget == 7)<option value="7" selected>กรกฎาคม</option>@else<option value="7" >กรกฎาคม</option>@endif
                                   @if($m_budget == 8)<option value="8" selected>สิงหาคม</option>@else<option value="8" >สิงหาคม</option>@endif
                                   @if($m_budget == 9)<option value="9" selected>กันยายน</option>@else<option value="9" >กันยายน</option>@endif
                                   @if($m_budget == 10)<option value="10" selected>ตุลาคม</option>@else<option value="10" >ตุลาคม</option>@endif
                                   @if($m_budget == 11)<option value="11" selected>พฤศจิกายน</option>@else<option value="11" >พฤศจิกายน</option>@endif
                                   @if($m_budget == 12)<option value="12" selected>ธันวาคม</option>@else<option value="12" >ธันวาคม</option>@endif
                                </select>
                        </div>
                      
                    </div>     
            </h3>
                </div>
           
             <div class="table-responsive"> 
             
                @foreach($infoinfomations as $infoinfomation)
               <br>
               {{$infoinfomation->INFMATION_NAME}}
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                    <thead style="background-color: #edbb7b;">
                        <tr height="40">
                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายละเอียด</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="20%">เลขมอนิเตอร์</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="20%">หน่วยที่ใช้</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="20%">ราคาต่อหน่วย</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="20%">มูลค่า</th> 
                        </tr >
                    </thead>
                    <tbody>

                @if($infoinfomation->INFMATION_TYPE == '2')
                <tr height="20">
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="10%">{{$infoinfomation->INFMATION_NAME}}</td>                                                                             
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">    
                        <input type="text" id="fname" name="fname">
                    </td>                                                                           
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                        <input type="text" id="fname" name="fname">
                    </td>
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">        
                        <input type="text" id="fname" name="fname">
                    </td>
                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"> 
                        <input type="text" id="fname" name="fname">
                    </td>
                   
                  
                </tr>  


                @else
                    
                    <?php
                        $infoguesthouse_levels = DB::table('supplies_location_level')
                        ->where('LOCATION_ID','=',$infoinfomation->LOCATION_ID)
                        ->get();
                    ?>
                        @foreach($infoguesthouse_levels as $infoguesthouse_level)
                        <tr height="20">
                            <td class="text-font text-pedding" colspan="6" style="background-color: #FFF8DC;" >{{$infoguesthouse_level->LOCATION_LEVEL_NAME}}</td>
                        </tr>
                            <?php 
                                $infoguesthouse_rooms = DB::table('supplies_location_level_room')->where('LOCATION_LEVEL_ID','=',$infoguesthouse_level->LOCATION_LEVEL_ID)->get();
                            ?>
                            <?php $number= 0; ?>
                                @foreach($infoguesthouse_rooms as $infoguesthouse_room)
                                
                                <tr height="20">
                                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;" width="10%">{{$infoguesthouse_room->LEVEL_ROOM_NAME}}</td>                                  
                                                                            
                                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                        <input type="text" id="fname" name="fname">
                                    </td>                                    
                                                                            
                                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                        <input type="text" id="fname" name="fname">
                                    </td>
                                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                        <input type="text" id="fname" name="fname">
                                    </td>


                                    <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                        <input type="text" id="fname" name="fname">
                                    </td>
                                   
                                  
                                </tr>  
                            @endforeach

                @endforeach
                   
                @endif
                    </tbody>
                </table>

                @endforeach
            </div>
        </div>
 

<div class="modal-footer">
    <div align="right">
        <button type="submit" class="btn btn-hero-sm btn-hero-info" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;font-weight: normal;"
            >บันทึกข้อมูล</button>
        <a href="{{ url('manager_guesthouse/guesthouseutilitybills')  }}" class="btn btn-hero-sm btn-hero-danger" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;font-weight: normal;"
            onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')"
            >ยกเลิก</a>
    </div>

</div>

        </form>  







        
</body>
     
     
    </div>
  </div>
</div>



  
@endsection

@section('footer')

<script>

$(document).ready(function() {

    $('select:not(.normal)').each(function () {
                $(this).select2({
                    width: '100%',
                    dropdownParent: $(this).parent()
                });
            });
      
});

function amountreceipt(idreceipt,idlist,count){


var x = event.which || event.keyCode;
// alert(x);
// var next = event.srcElement || event.target;
if(x == 13){
            var value=document.getElementById('receipt'+idreceipt).value;
            var number = count+1;
            
            var value=document.getElementById('receipt'+idreceipt).value;
     
     // alert(value+"::"+iddep);

      var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('mcompensation.updateamountreceipt')}}",
              method:"GET",
              data:{value:value,idreceipt:idreceipt,_token:_token},
              success:function(result){
                summoneyreceipt(idlist);
                $(".inputs"+number).focus();
                     }
      })

        
        
}

}
    
 function summoneyreceipt(idlist){

var _token=$('input[name="_token"]').val();
$.ajax({
        url:"{{route('mcompensation.summoneyreceipt')}}",
        method:"GET",
        data:{idlist:idlist,_token:_token},
        success:function(result){
                  $('.detailsum').html(result);
               }
})
}
  
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

    
</script>

@endsection