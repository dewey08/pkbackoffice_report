@extends('layouts.launder')   
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
      font-size: 10px;
      font-size: 1.0rem;
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
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
<?php
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d');     
?>         
<!-- Advanced Tables -->
<br>
<br>
<center>    
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  style="text-align: center;">
            
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>เช็คสต็อก</B></h3>
              
              
               
                </div>

            </div>
            <div class="block-content ">
             
              
            <div class="col-lg-12" style="height:50%;">

            <form action="{{ route('launder.launder_checkstock') }}" method="post">
                    @csrf

                    <div class="row">

                            <div class="col-sm-0.5">
                            &nbsp;ค้นหา &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>

                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                            </span>
                            </div>

                            <div class="col-sm-30">
                            &nbsp;
                            </div> 
                            <div class="col-sm-1">
                            <span>
                            <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ค้นหา</button>
                            </span> 
                            </div>


                                        
                                            </div>  
             </form>
                          

             <div class="table-responsive"> 
              
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="5%">ลำดับ</th>
    
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" >รายละเอียด</th>
         
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" >จัดสรร</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" >จ่ายออก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" >คงเหลือ</th>
                     
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="5%">คำสั่ง</th> 
                            
                        </tr >
                    </thead>
                    <tbody>
                   
             
                        
                
                    

                    <?php $number = 0; ?>
                        @foreach ($infotypes as $infotype)
                    <?php $number++; 
                       
                       $sumre = DB::table('launder_check_sub')->where('LAUNDER_CHECK_SUB_TYPE','=',$infotype->LAUNDER_TYPE_ID)->sum('LAUNDER_CHECK_SUB_AMOUNT');

                       $sumpay =DB::table('launder_dis_sub')->where('LAUNDER_DIS_SUB_TYPE','=',$infotype->LAUNDER_TYPE_ID)->sum('LAUNDER_DIS_SUB_AMOUNT');
                    
                    ?>
                       
 
                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                        <td class="text-font text-pedding" >{{$infotype->LAUNDER_TYPE_NAME}}</td>
                    
                        <td class="text-font text-pedding" style="text-align: center;">{{$sumre}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{$sumpay }}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{$sumre - $sumpay}}</td>
                      
                     
                        
                        <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                <div class="dropdown-menu" style="width:10px">
                              
                                <a class="dropdown-item" href="{{ url('manager_launder/launder_checkstock_sub/'.$infotype->LAUNDER_TYPE_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">เรียกดู</a>
                                <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                </div>
                                </div>
                            </td> 
                        
                        </tr>
                    

                        @endforeach  

                      
                  

                    </tbody>
                </table>
                <br>
               
                </div>

  
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
                autoclose: true                    //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
    </script>
@endsection
  