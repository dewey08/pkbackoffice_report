@extends('layouts.backend_admin')




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

          .text-pedding{
       padding-left:10px;
                        }

            .text-font {
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}
?>


                    <!-- Advanced Tables -->

                <div class="content">
                <div class="block block-rounded block-bordered">


                <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าระดับการลา</h2>
               
                <a  href="#add_value" data-toggle="modal"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 16px;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มหน่วยงาน</a>
                <a href="{{ url('admin_leave/setupinfolevelgroup/add') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มรายบุคคล</a>
                     
                        <div class="block-content">
                        <div class="table-responsive">

                  <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD;">

                   <tr height="40">
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">รหัส</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ชื่อผู้ที่ลา 3 ระดับ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วยงาน</th>
        <th class="text-font" width="10%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th>



      </tr>
                   </tr>
                   </thead>
                   <tbody>
                     <?php $number=0; ?>
                    @foreach($infopersonlv3s as $infopersonlv3)
                    <?php $number++; ?>
                        <tr>
                          <td class="text-font" align="center">{{ $number }}</td>
                          <td class="text-font text-pedding">{{ $infopersonlv3-> NAME_PERSON }}</td>
                          <td class="text-font text-pedding">{{ $infopersonlv3-> HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                          <td align="center">
                            <div class="dropdown">
                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                           ทำรายการ
                                                       </button>
                                                       <div class="dropdown-menu" style="width:10px">
                                                           <a class="dropdown-item" href="{{ url('admin_leave/setupinfolevelgroup/edit/'.$infopersonlv3 ->PERMIS_LEVEL_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                           <a class="dropdown-item" href="{{ url('admin_leave/setupinfolevelgroup/destroy/'.$infopersonlv3->PERMIS_LEVEL_ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูล {{  $infopersonlv3-> NAME_PERSON }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                                         
                                                       </div>
                           </div>
                            </td>    

                          
                        </tr>
                    @endforeach
                   </tbody>
                  </table>
                  <br>

                                
<div id="add_value" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มบุคคลตามหน่วยงาน</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{route('setup.setupinfolevelgroupdep_save')}}" >
        @csrf
     
     
        <div class="row push">
      <div class="col-sm-3">  
      <label >หน่วยงาน</label>
      </div>
   
      <div class="col-sm-7">  
       
        <select name="INFO_DEP_SUB_SUB" id="INFO_DEP_SUB_SUB" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
          <option value="">--เลือก--</option>
              @foreach ($infodep_sub_subs as $infodep_sub_sub)

                  <option value="{{ $infodep_sub_sub ->HR_DEPARTMENT_SUB_SUB_ID }}">{{ $infodep_sub_sub-> HR_DEPARTMENT_SUB_SUB_NAME}}</option>
          
              @endforeach 
      </select>
    
      </div>
      </div>
   
      

      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">เพิ่มข้อมูล</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>


@endsection

@section('footer')




@endsection
