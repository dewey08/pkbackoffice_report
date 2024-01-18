@extends('layouts.supplies')   
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

    
      .form-control {
    font-size: 13px;
                  }   


                  table {
            border-collapse: collapse;
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

    use App\Http\Controllers\ManagersuppliesController;
    
?>
<?php  

    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');
?>          
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการขายทอดตลาด</B></h3>
               <div align="right">
                          <a href="{{url('manager_supplies/infosoldout_add')}}" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a> 
                    </div>
            </div>
            <div class="block-content block-content-full">


                  
            <div class="table-responsive"> 

            <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ปีงบประมาณ</th>                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายละเอียด</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">มูลค่า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">ผู้ชนะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach($soldout as $items)
                        <?php $number++; ?>

                        <tr height="20">
                            <td class="text-font" align="center" width="5%">{{$number}}</td>
                            <td class="text-font text-pedding" align="center" width="7%">{{$items->SOLDOUT_YEAR}}</td> 
                            <td class="text-font text-pedding" align="center" width="10%"> {{DateThai($items->SOLDOUT_DATE)}}</td> 
                            <td class="text-font text-pedding" >{{$items->ARTICLE_NAME}}</td> 
                            <td class="text-font text-pedding" >{{$items->SOLDOUT_DETAIL}}</td> 
                            <td class="text-font text-pedding" align="right" width="10%">{{number_format($items->SOLDOUT_PRICE,2)}}&nbsp;&nbsp;&nbsp;</td> 
                            <td class="text-font text-pedding" width="15%">{{$items->VENDOR_NAME}}</td> 
                            
                          
                          
                             
                            <td align="center" width="5%">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu" style="width:10px"> 
                                                <a class="dropdown-item"  href="{{ url('manager_supplies/infosoldout_edit/'.$items->SOLDOUT_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไข</a> 
                                                <a class="dropdown-item"  href="{{ url('manager_supplies/infosoldout_delete/'.$items->SOLDOUT_ID)}}" onclick="return confirm('ต้องการที่จะลบข้อมูล {{ $items-> ARTICLE_NAME  }} ?')"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบ</a>
                      
                                            </div>
                                </div>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>
       
                                 
                                            
            </div>

<!------------------------------->
                                        
 <div id="add_list" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มข้อมูลรายการ</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="">
        @csrf
     
     
        <div class="row push">
      <div class="col-sm-2">  
      <label >ปีงบประมาณ</label>
      </div>
      <div class="col-sm-4">  
      <input  name = ""  id=""  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
      <div class="col-sm-2">  
      <label >วันที่</label>
      </div>
      <div class="col-sm-4">  
      <input  name = ""  id=""  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
      </div>
      <br>
      <div class="row push">
      <div class="col-sm-2">  
      <label >รายการ</label>
      </div>
      <div class="col-sm-10">  
      <input  name = ""  id=""  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
      </div>
      <br>
      <div class="row push">
        <div class="col-sm-2">  
        <label >รายละเอียด</label>
        </div>
        <div class="col-sm-10">  
        <input  name = ""  id=""  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
        </div>
        </div>
        <br>
      <div class="row push">
      <div class="col-sm-2">  
      <label >ผู้ชนะ</label>
      </div>
      <div class="col-sm-4">  
      <input  name = ""  id=""  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
  
      <div class="col-sm-2">  
      <label >จำนวนเงิน</label>
      </div>
      <div class="col-sm-4">  
      <input  name = ""  id=""  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
      </div>
      <br>
      <div class="row push">
      <div class="col-sm-2">  
      <label >หมายเหตุ</label>
      </div>
      <div class="col-sm-10">  
      <input  name = ""  id=""  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
      </div>

      </div>
      <br>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึก</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
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


@endsection