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
                   
                <div style="width:95%;" >
          <div class="block block-rounded block-bordered">
          <div class="block-content">    
          <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
          <div class="row">
          <div class="col-md-7" align="left">
            วิเคราะห์ข้อมูล
            </div>
          <div class="col-md-5" align="right">
               <a href="{{ url('manager_risk/internalcontrol_sub_add')  }}"  class="btn btn-hero-sm btn-hero-info"  ><i class="fas fa-plus"></i> เพิ่มข้อมูลวิเคราะห์</a>

             
          </div>
          </div>
          </h2>  
                                
             
         
        <div class="panel-body" style="overflow-x:auto;">     
         
                   <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ขั้นตอน/กระบวนการปฎิบัติ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">เพื่อลดความเสี่ยงอะไร</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">กิจกรรมที่ปฎิบัติ</th>                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="8%">คำสั่ง</th> 
                        </tr >
                    </thead>



                   <tbody>
                   
 
                    <tr height="20">
                        <td class="text-font text-pedding" >1</td>                 
                        <td class="text-font text-pedding">ทดสอบ</td> 
                        <td class="text-font text-pedding">ทดสอบ</td> 
                        <td class="text-font text-pedding">ทดสอบ</td> 
                        <td align="center">
                            <div class="dropdown">
                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                    ทำรายการ
                                </button>
                                <div class="dropdown-menu" style="width:10px">
                                    <a class="dropdown-item" href="{{ url('manager_risk/internalcontrol_sub_edit/' )}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >แก้ไข</a>
                                    <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >ลบ</a>
                                </div>
                            </div>
                        </td>
                    </tr> 
                   
                 
              
                   </tbody>
                  </table>
</div>
    
                      

@endsection
@section('footer')
    
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

          function checkpass(id) {
          var  text;
          var  NEWPASSWORD = document.getElementById("NEWPASSWORD_"+id).value;
          var  CHECK_NEWPASSWORD = document.getElementById("CHECK_NEWPASSWORD_"+id).value;

       
         // alert(NEWPASSWORD);
         
            if(NEWPASSWORD !== CHECK_NEWPASSWORD){
              document.getElementById("text"+id).style.display = "";     
            text = "*กรุณาระบุรหัสผ่านให้ตรงกับยืนยันรหัสผ่าน";
            document.getElementById("text"+id).innerHTML = text;
            

          }
          

          if(NEWPASSWORD !== CHECK_NEWPASSWORD){
             return false; 
          }else if(NEWPASSWORD==null || NEWPASSWORD=='' || CHECK_NEWPASSWORD==null || CHECK_NEWPASSWORD==''){
  
            return false; 
          }

          }

        </script>
@endsection