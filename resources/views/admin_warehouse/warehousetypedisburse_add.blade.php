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
            font-size: 14px;
            
            }

            .text-pedding{
        padding-left:10px;
                            }

                .text-font {
            font-size: 14px;
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
<div class="content">
    <div class="block block-rounded block-bordered">    
        <div class="block-content">    
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มประเภท</h2> 
        <form action="{{ route('setupwarehouse.typedisburse_save') }}" method="post"> 
            @csrf
                <div class="row">
                    <div class="col-lg-2 text-right">
                        <label for="">ประเภท :</label>
                    </div>    
                    <div class="col-lg-10">
                        <input type="text" id="SUP_TYPE_NAME" name="SUP_TYPE_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;">
                    </div>             
                </div> 
                <br> 
            <div class="footer">
                <div align="right">          
                    <button type="submit" class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                <a href="{{ url('admin_warehouse/setupwarehousetypedisburse') }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
            </div>                
        </div>
        </form>
    </div>                

<br>
                 
@endsection

@section('footer')

<!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>

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
    });  //กำหนดเป็นวันปัจุบัน
});

    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        });
    });



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

@endsection