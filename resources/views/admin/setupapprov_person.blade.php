@extends('layouts.backend_admin')
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" /> 
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

      
      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 14px;
                  }   

</style>

@section('content')
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                <div class="col-md-5">
                กำหนดข้อมูลผู้ถูกเห็นชอบโดย {{$leaderid->HR_FNAME}} {{$leaderid->HR_LNAME}}
                </div>
                
             
               <div class="col-md-5">
               </div>
               <div class="col-md-2">
               <a href="{{ url('admin_leave_H/setupinfoapprov') }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
               <!--<a href="{{ url('admin_leave/setupinfovacation/export_pdf') }}"  class="btn btn-hero-sm btn-hero-danger"  target="_blank">Print</a>-->
               </div>
               </div>
                
                
                </h2> 
                       
                        <div class="row">
                            <div class="col-lg-8">
                               
                        <a href="" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มข้อมูลผู้ถูกเห็นชอบ</a>

                              </div>
                      
                      </div>   
                       
                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">
        <th class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">ชื่อ นามสกุล</th>
            
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">ลบ</th>
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infoapprovpersons as $infoapprovperson)
                   <tr height="40">
                     <td class="text-font" align="center">{{ $infoapprovperson-> PERSON_ID }} </td>                 
                     <td class="text-font text-pedding">{{ $infoapprovperson-> PERSON_NAME }}</td> 
                   
                   
                     <td align="center">
                     <a href="{{ url('admin_leave_H/setupinfoapprov/destroyperson/'. $infoapprovperson-> ID.'/'.$infoapprovperson-> LEADER_ID)  }}" class="btn btn-danger" onclick="return confirm('ต้องการที่จะลบข้อมูล {{ $infoapprovperson-> PERSON_NAME }}?')"><i class=" fa fa-times"></i></a>
                     </td>   
                    
                   </tr> 
 
                   @endforeach 
                   </tbody>
                  </table>

                  


                  <div class="modal fade add" >
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                            <div class="modal-header">
                                  
                                  <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มข้อมูลผู้ถูกเห็นชอบ</h2>
                                </div>
                                <div class="modal-body">
                                <body>
                                <form  method="post" action="{{ route('setup.saveapprovperson') }}" >
                                @csrf
                                <div class="row">
                              <div class="col-lg-2">
                              <label >ชื่อ นามสกุล</label>
                              </div>
                              <div class="col-lg-5">
                              <select name="HR_ID" id="HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="check_hr_id();">
                                            <option value="">--กรุณาเลือกชื่อเจ้าหน้าที่--</option>
                                                @foreach ($inforpersons as $inforperson)
                                                                                                
                                                <option value="{{ $inforperson->HR_CID  }}">{{$inforperson->HR_FNAME}} {{$inforperson->HR_LNAME}}</option>
                                            
                                                @endforeach 
                            </select>
                            <div style="color: red; font-size: 16px;" id="hr_id"></div>
                            </div>
                              </div>

                            <input type="hidden" name = "LEADER_ID"  id="LEADER_ID"  value="{{  $leaderid->ID }} ">
                          
                              

                              </div>
                                <div class="modal-footer">
                                <div align="right">
                                <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
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
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
  $(document).ready(function() {
    $('select').select2({
    width: '100%'
});


    });

   
  function check_hr_id()
  {                         
    hr_id = document.getElementById("HR_ID").value;             
          if (hr_id==null || hr_id==''){
          document.getElementById("hr_id").style.display = "";     
          text_hr_id = "*กรุณาเลือกชื่อเจ้าหน้าที่";
          document.getElementById("hr_id").innerHTML = text_hr_id;
          }else{
          document.getElementById("hr_id").style.display = "none";
          }
  } 
 
 </script>
 <script>      
  $('form').submit(function () {
   
    var hr_id,text_hr_id;
     
    hr_id = document.getElementById("HR_ID").value;
     
    if (hr_id==null || hr_id==''){
    document.getElementById("hr_id").style.display = "";     
    text_hr_id = "*กรุณาเลือกชื่อเจ้าหน้าที่";
    document.getElementById("hr_id").innerHTML = text_hr_id;
    }else{
    document.getElementById("hr_id").style.display = "none";
    }
   

    if(hr_id==null || hr_id==''      
    )
  {
  alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
  return false;   
  }
  }); 
</script>

<script>
  $('#edit_modal').on('show.bs.modal', function(e) {
    var Id = $(e.relatedTarget).data('id');
    var VUTId = $(e.relatedTarget).data('vutid');
    $(e.currentTarget).find('input[name="ID"]').val(Id);
    $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);

});

</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker3').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});

  
</script>

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
            $(document).ready(function(){
              $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
        </script>

@endsection