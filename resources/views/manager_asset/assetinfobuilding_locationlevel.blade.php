@extends('layouts.asset')
   


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
                    <br>
<center>    
     <div class="block" style="width: 95%;">

                <div class="block block-rounded block-bordered">

               
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div align="left">
                <div class="row">
                <div class="col-md-10">
             
                กำหนดข้อมูลชั้น :: {{$infosupplocationlevelname->LOCATION_NAME}}

               </div>
                <div class="col-md-2">
               <a href="{{ url('manager_asset/assetinfobuilding') }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
               <!--<a href="{{ url('admin_leave/setupinfovacation/export_pdf') }}"  class="btn btn-hero-sm btn-hero-danger"  target="_blank">Print</a>-->
               </div>
               </div>
                </h2> 
                <div align="left">
                <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มข้อมูลชั้น</button>

                       
                        <div class="block-content">
                        <div class="table-responsive">      
                
                        <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                  <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รหัส</th>
        <th  class="text-font" width="40%"style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ชั้น</th>
        <th  class="text-font" width="12%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ข้อมูลห้อง</th> 
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">คำสั่ง</th>      
   
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody>
                    <?php $number = 0; ?>
                   @foreach ($infosupplieslocationlevels as $infosupplieslocationlevel)
                   <?php $number++; ?>
                   <tr height="20">
                     <td align="center"  class="text-font">{{ $number }} </td>                 
                     <td  class="text-font text-pedding">{{ $infosupplieslocationlevel->LOCATION_LEVEL_NAME}}</td> 

                    <td align="center">
                     <a href="{{ url('manager_asset/setassetinfolocationlevelroom/'.$infosupplieslocationlevel-> LOCATION_ID.'/'.$infosupplieslocationlevel-> LOCATION_LEVEL_ID) }}"     class="btn btn-success"><i class="fa fa-cogs"></i></a>
                     </td>

                   
                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item" href="#edit_modal{{ $infosupplieslocationlevel-> LOCATION_LEVEL_ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('manager_asset/setassetinfolocationlevel/destroy/'.$infosupplieslocationlevel-> LOCATION_LEVEL_ID.'/'.$infosupplieslocationlevel-> LOCATION_ID) }}" onclick="return confirm('ต้องการที่จะลบข้อมูล {{ $infosupplieslocationlevel-> LOCATION_LEVEL_ID }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                                  
                                                </div>
                    </div>
                     </td>   
                    
                   </tr> 



                                                      

<div id="edit_modal{{ $infosupplieslocationlevel-> LOCATION_LEVEL_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">แก้ไขข้อมูลชั้น</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" id="form_edit" action="{{ route('massete.updatelocationlevel') }}">
        @csrf
        <input type="hidden" name="ID" value="{{ $infosupplieslocationlevel-> LOCATION_LEVEL_ID }}"/>
      
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3">
      <label >ชื่อชั้น</label>
      </div>
      <div class="col-sm-9">
      <input  name = "LOCATION_LEVEL_NAME_EDIT"  id="LOCATION_LEVEL_NAME_EDIT" class="form-control input-lg {{$errors->has('LOCATION_LEVEL_NAME_EDIT') ? 'is-invalid' : '' }}" value="{{ $infosupplieslocationlevel->LOCATION_LEVEL_NAME }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
      <input type="hidden" name = "LOCATION_LEVEL_ID"  id="LOCATION_LEVEL_ID" class="form-control input-lg" value="{{$infosupplieslocationlevel->LOCATION_LEVEL_ID}}">
      <input type="hidden" name = "LOCATION_ID"  id="LOCATION_ID" class="form-control input-lg" value="{{$infosupplieslocationlevel->LOCATION_ID}}">


      </div>
        <div class="modal-footer">
        <div align="right">
        <span type="button"  class="btn btn-hero-sm btn-hero-info btn-submit-edit" >บันทึกแก้ไขข้อมูล</span>
        <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</span>
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

                  
                  <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มข้อมูลชั้น</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" id="form_add" action="{{ route('massete.savelocationlevel') }}" >
        @csrf
        <div class="form-group">
        <div class="row">
      <div class="col-sm-3">
      <label >ชื่อชั้น</label>
      </div>
      <div class="col-sm-9">
      <input  name = "LOCATION_LEVEL_NAME"  id="LOCATION_LEVEL_NAME" class="form-control input-lg {{$errors->has('LOCATION_LEVEL_NAME') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
      <input type="hidden" name = "LOCATION_ID"  id="LOCATION_ID" class="form-control input-lg" value="{{$infosupplocationlevelname->LOCATION_ID}}">
      

      </div>
        <div class="modal-footer">
        <div align="right">
        <span type="button"  class="btn btn-hero-sm btn-hero-info btn-submit-add" >บันทึกข้อมูล</span>
        <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</span>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>
<br>
                       
                   </div>
               
                </div>
                 




@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>




  <!-- Page JS Plugins -->
        <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   

        <!-- Page JS Code -->
        <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
  
  <script>
        
        $('.btn-submit-add').click(function (e) { 

          var form = $('#form_add');
          formSubmit(form)
              
          });


          $('.btn-submit-edit').click(function (e) { 

            var form = $('#form_edit');
            formSubmit(form)
                
            });
  </script>

@endsection