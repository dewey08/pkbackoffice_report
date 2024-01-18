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

label{
            font-family: 'Kanit', sans-serif;
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                <div class="col-md-5">
                กำหนดข้อมูลอุปกรณ์ห้อง {{ $inforoom-> ROOM_NAME }}
                </div>
                
             
               <div class="col-md-5">
               </div>
               <div class="col-md-2">
               <a href="{{ url('admin_meeting/setupinforoom') }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
               <!--<a href="{{ url('admin_leave/setupinfovacation/export_pdf') }}"  class="btn btn-hero-sm btn-hero-danger"  target="_blank">Print</a>-->
               </div>
               </div>
                
                
                </h2> 
                      
                        <div class="row">
                            <div class="col-lg-8">
                                <a href="" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มอุปกรณ์</a>

                              </div>
                   
                      </div>   

                       
                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
        <tr height="45">
        <th width="5%" style="border-color:#F0FFFF;text-align: center;">ลำดับ</th>
        <th style="border-color:#F0FFFF;text-align: center;">อุปกรณ์</th>
        <th width="10%" style="border-color:#F0FFFF;text-align: center;">จำนวน</th>
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th>
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   <?php $count=1; ?>
                   @foreach ($inforoomequs as $inforoomequ)
                   <tr height="45">
                     <td align="center">{{ $count }} </td>                 
                     <td>{{ $inforoomequ-> ARTICLE_NAME }}</td> 
                     <td align="center">{{ $inforoomequ-> AMOUNT }}</td> 

                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                      <a class="dropdown-item"  href="#edit_modal{{ $inforoomequ -> ID }}"     class="btn btn-warning fa fa-pencil-alt" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>                
                                                      <a class="dropdown-item"  href="{{ url('admin_meeting/setupinforoom_equipment/destroy/'.$inforoom-> ROOM_ID.'/'.$inforoomequ-> ID) }}" class="btn btn-danger fa fa-times" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>

                                                        
                                                </div>
                    </div>
                     </td>                        


                    
                   </tr> 

                   <div id="edit_modal{{ $inforoomequ -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">แก้ไขข้อมูลอุปกรณ์ {{ $inforoomequ-> ARTICLE_NAME }}</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('admin.updateequ') }}" >
        @csrf
        <div class="row">
        <div class="col-lg-5">
      <div class="form-group">
      <label >อุปกรณ์</label>
     
      <select name="ARTICLE_ID" id="ARTICLE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="">--กรุณาเลือกอุปกรณ์--</option>
                        @foreach ($infoarticles as $infoarticle)
                        @if($infoarticle ->ARTICLE_ID == $inforoomequ-> ARTICLE_ID)                                                     
                        <option value="{{ $infoarticle ->ARTICLE_ID  }}" selected>{{ $infoarticle->ARTICLE_NAME}}</option>
                        @else
                        <option value="{{ $infoarticle ->ARTICLE_ID  }}">{{ $infoarticle->ARTICLE_NAME}}</option>
                        @endif
                        @endforeach 
                    </select>
      </div>
      </div>
      <div class="col-lg-3">
      <div class="form-group">
      <label >จำนวน</label>
      <input  name = "AMOUNT"  id="AMOUNT" class="form-control input-lg "  style=" font-family: 'Kanit', sans-serif;" value="{{$inforoomequ-> AMOUNT}}">
        
        </div>
      </div>
     </div>
     <input type="hidden" name = "ROOM_ID"  id="ROOM_ID"  value="{{  $inforoom-> ROOM_ID }} ">
     <input type="hidden" name = "ID"  id="ID"  value="{{  $inforoomequ-> ID }} ">
   

      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>





                   <?php $count++; ?>
                   @endforeach 
                   </tbody>
                  </table>

                  


                  <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มข้อมูลอุปกรณ์</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('admin.saveequ') }}" >
        @csrf
        <div class="row">
        <div class="col-lg-5">
      <div class="form-group">
      <label >อุปกรณ์</label>
     
      <select name="ARTICLE_ID" id="ARTICLE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="">--กรุณาเลือกอุปกรณ์--</option>
                        @foreach ($infoarticles as $infoarticle)                                                     
                        <option value="{{ $infoarticle ->ARTICLE_ID  }}">{{ $infoarticle->ARTICLE_NAME}}</option>
                        @endforeach 
                    </select>
      </div>
      </div>
      <div class="col-lg-3">
      <div class="form-group">
      <label >จำนวน</label>
      <input  name = "AMOUNT"  id="AMOUNT" class="form-control input-lg "  style=" font-family: 'Kanit', sans-serif;">
        
        </div>
      </div>
     </div>
     <input type="hidden" name = "ROOM_ID"  id="ROOM_ID"  value="{{  $inforoom-> ROOM_ID }}">
   
      

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

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

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