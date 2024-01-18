@extends('layouts.asset')

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

?>


           
                    <!-- Advanced Tables -->
<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการที่ดิน</B></h3>
                            <div align="right">

        <a href="{{ url('manager_asset/assetinfoland_add') }}"   class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i>&nbsp; เพิ่มข้อมูล</a>
        </div>
                        </div>
                        <div class="block-content block-content-full">
                        <form method="post">
                          @csrf
                        
                                  <div class="row" >

                                                   <div class="col-md-7">
                                                  &nbsp;
                                                    </div>
                                                
                                                    <div class="col-md-3">
                                                    <span>
                                                    <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" value="{{$search}}"> 
                                                    </span>
                                                    </div>

                                                    <div class="col-md-2 text-left">
                                                    <span>
                                                    <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-search"></i> &nbsp; ค้นหา</button>
                                                    </span> 
                                                    </div>
                                              </div>


                                            </form>
            
             <div class="table-responsive">                 
                  
             <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                                      <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="5%">ลำดับ</th>
                                       
                                       <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%">เลขระวาง</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;"  width="12%">เลขที่ดิน</th>    
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;"  width="12%">เลขที่โฉนด|เอกสารสิทธิ์</th>

                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%">จำนวนไร่</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%">จำนวนงาน</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%">จำนวนตารางวา</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" >เขตสำนักงานที่ดิน</th> 


                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;"  width="10%">คำสั่ง</th>   
                                       
                                      
    
                                </tr>
                                </thead>
                                <tbody >
   
  
                                <?php $number = 0; ?>
                                @foreach ($assetinfolands as $assetinfoland)
                                <?php $number++; ?>

                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font" align="center">{{$assetinfoland->LAND_RAWANG }}</td>
                                        <td class="text-font" align="center">{{$assetinfoland->LAND_NUMBER }}</td>
                                        <td class="text-font" align="center">{{$assetinfoland->LAND_CHANOD }}</td>

                                        <td class="text-font" align="center">{{$assetinfoland->LAND_SIZE }}</td>
                                        <td class="text-font" align="center" >{{ number_format($assetinfoland->LAND_SIZE_NGAN) }}</td>
                                        <td class="text-font" align="center">{{  number_format($assetinfoland->LAND_SIZE_TARANGWA) }}</td>
                                        <td class="text-font text-pedding">{{$assetinfoland->LAND_OFFICE }}</td>
                                       
                   

                                        <td class="text-font " align="center">

                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="#detail_modal{{ $assetinfoland -> ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด</a>
                                                    <a class="dropdown-item" href="{{ url('manager_asset/assetinfoland/edit/'.$assetinfoland->ID) }}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a>

                                                  
                                                </div>
                                        
                                        </td>
                                     
                                    </tr>


                                    <div id="detail_modal{{ $assetinfoland -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
     
    <div class="row">
    <div>&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดที่ดิน&nbsp;&nbsp;</div>
    </div>
        </div>
        <div class="modal-body">

        <div class="row">
       
       <div class="col-sm-2 ">
           <div class="form-group">
           <label >เลขระวาง :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->LAND_RAWANG }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >หมายเลขที่ดิน  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->LAND_CHANOD }}</h1>
           </div>                               
       </div>  
      
       </div>

       
       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >เลขโฉนดที่ดิน :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->LAND_CHANOD }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >หน้าสำรวจ  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->LAND_FONT_CHECK }}</h1>
           </div>                               
       </div>  
      
       </div>

       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ที่ตั้งบ้านเลขที่ :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->LAND_ADD }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ที่ตั้งตำบล  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->TUMBON_NAME }}</h1>
           </div>                               
       </div>  
      
       </div>

       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ที่ตั้งอำเภอ :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->AMPHUR_NAME }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ที่ตั้งจังหวัด  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->PROVINCE_NAME }}</h1>
           </div>                               
       </div>  
      
       </div>
     
       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >เนื้อที่ไร่ :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($assetinfoland->LAND_SIZE) }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >เนื้อที่งาน  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{number_format($assetinfoland->LAND_SIZE_NGAN) }}</h1>
           </div>                               
       </div>  
  
       </div>

       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >เนื้อที่ตารางวา :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($assetinfoland->LAND_SIZE_TARANGWA) }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ผู้ถือครอง  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->LAND_OWNER }}</h1>
           </div>                               
       </div>  
  
       </div>

       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันถือครอง :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($assetinfoland->LAND_OWNER_DATE) }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >พิกัด  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->LAND_LAT }},{{$assetinfoland->LAND_LNG }}</h1>
           </div>                               
       </div>  
  
       </div>

       <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >สำนักงานที่ดิน :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->LAND_OFFICE }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >เบอร์ติดต่อ  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$assetinfoland->LAND_OFFICE_PHONE }}</h1>
           </div>                               
       </div>  
  
       </div>


      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;">ปิดหน้าต่าง</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>

                                    @endforeach   
                      </tbody>
                    </table>
              </div>
              <br>
              <div style="font-family: 'Kanit', sans-serif; font-size: 15px;font-size: 1.0rem;font-weight:normal;">จำนวน {{$countland}} รายการ</div>
          </div>
      </div>           
  </div>

                
                 
                  
      
                      

@endsection

@section('footer')





<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });




  
</script>





@endsection