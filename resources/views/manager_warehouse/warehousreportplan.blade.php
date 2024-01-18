@extends('layouts.warehouse')   
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
    padding-right:10px;
                        }


        .text-font {
    font-size: 13px;
                  }
                  .form-control {
    font-size: 13px;
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
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แผนการจัดซื้อวัสดุ</B></h3>
             
            </div>
            <div class="block-content ">

   <div class="block-content ">
          
  

             <div class="table-responsive"> 
                <table class="table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">

                        <tr height="40">    
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">ขนาดบรรจุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" colspan="3">ข้อมูลการใช้ย้อนหลัง 3 ปี</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">ประมาณการปี 2363</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">ยอดคงคลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">ประมาณการจัดซื้อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">ราคาต่อขนาดบรรจุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">มูลค่า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">งวดจัดซื้อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ต.ค. - ธ.ค.</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ม.ค. - มี.ค.</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เม.ย. - มิ.ย.</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ก.ค. - ก.ย.</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ยอดรวม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">หมายเหตุ</th>
                        </tr >

                        <tr height="40">   
                            
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center" >2560</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">2561</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">2562</td>

                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">แผนจัดซื้อ</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">แผนจัดซื้อ</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">แผนจัดซื้อ</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">แผนจัดซื้อ</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" align="center">แผนจัดซื้อ</td>

                        </tr >
                    </thead>
                    <tbody>     
         
           
                    <tr height="20">   
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2">1</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="center"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>          
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>

                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>

                        <td class="text-font text-pedding" style="border: 1px solid black;" align="center">จำนวน</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right"></td>

                        <td class="text-font text-pedding" style="border: 1px solid black;"  align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;"  align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" rowspan="2" align="right"></td>
                     
          
                    </tr> 

                    <tr height="20">  

                        <td class="text-font text-pedding" style="border: 1px solid black;" align="center">มูลค่า</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right"></td>

                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right"></td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" align="right"></td>

                    </tr> 


               
                    </tbody>
                </table>

       
                        </tbody>
                    </table>
    
                   
               
               
                <br>
            </div>
        </div>
    </div>    
</div>


  
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


function detail(id){


$.ajax({
           url:"{{route('warehouse.detailappall')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);


              //alert("Hello! I am an alert box!!");
           }

   })

}



function detaillast(id){


$.ajax({
           url:"{{route('warehouse.detailappall')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detaillastappall'+id).html(result);


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
            });  //กำหนดเป็นวันปัจุบัน
    });


    

    $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });


</script>

@endsection