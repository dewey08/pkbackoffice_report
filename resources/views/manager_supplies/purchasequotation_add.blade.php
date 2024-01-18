@extends('layouts.supplies')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />




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
    padding-right:10px;
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
           
<center>    
    <div class="block" style="width: 95%;">
            
    <div class="block block-rounded block-bordered">
<div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ใบเสนอราคา รายการเลขทะเบียน {{$CON_NUM}}</B></h3>
                    <div align="right">
                    <a href="{{ url('manager_supplies/purchase')  }}"   class="btn btn-hero-sm btn-hero-success" ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a> 
                    </div>
            </div>
<div class="block-content" align="left"> 

<a href="{{ url('manager_supplies/purchasequotation_addsub/'.$IDCON)  }}"   class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มใบเสนอราคา</a>

                                   <br><br>

                            <div id="detail_accessory">
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #F0F8FF;">
                                <tr height="40">
                                        <th style="text-align: center;font-size: 14px;">เลขที่ใบเสนอราคา</th>
                                        <th style="text-align: center;font-size: 14px;">บริษัท</th>
                                        <th style="text-align: center;font-size: 14px;">ที่อยู่</th>
                                        <th style="text-align: center;font-size: 14px;">เลขภาษี</th>
                                        <th style="text-align: center;font-size: 14px;">ยอดนำเสนอ</th>
                                        <th style="text-align: center;font-size: 14px;">สถานะ</th>
                                        <th style="text-align: center;font-size: 14px;">File</th>
                                        <th  style="text-align: center;font-size: 14px;"  width="12%">คำสั่ง</th> 
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @foreach ($detailquotations as $detailquotation)  
                                            <tr>
                                            <td class="text-font text-pedding" style="font-size: 14px;">{{$detailquotation->QUOTATION_NUMBER}}</td> 
                                            <td class="text-font text-pedding" style="font-size: 14px;">{{$detailquotation->VENDOR_NAME}}</td> 
                                            <td class="text-font text-pedding" style="font-size: 14px;">{{$detailquotation->QUOTATION_VENDOR_ADD}}</td> 
                                            <td class="text-font text-pedding" style="font-size: 14px;">{{$detailquotation->QUOTATION_VENDOR_TAXNUM}}</td> 
                                            <td class="text-font text-pedding" style="text-align: right;font-size: 14px;" >{{number_format($detailquotation->QUOTATION_VENDOR_PICE,5)}}</td> 
                                            @if($detailquotation->QUOTATION_WIN == 1)
                                            <td  align="center" ><span class="btn btn-hero-sm btn-hero-info" style="background-color:#4169E1;color:#F0FFFF;"><i class="fas fa-crown"></i></span></td>
                                        @else
                                        <td  align="center" >-</td>
                                        @endif

                                            @if($detailquotation->QUOTATION_VENDOR_FILE_NAME !== '')
                                            <td  align="center" ><span class="btn btn-hero-sm btn-hero-danger" style="background-color:#B22222;color:#F0FFFF;"><i class="fas fa-file-pdf"></i></span></td>
                                        @else
                                        <td  align="center" ></td>
                                        @endif
                                            
                                                <td  style="text-align: center;" >
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                                    ทำรายการ
                                                            </button>
                                                        <div class="dropdown-menu" style="width:10px">
                                                            <a class="dropdown-item" href="{{ url('manager_supplies/purchasequotation_addsubedit/'.$IDCON.'/'.$detailquotation->QUOTATION_ID)  }}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด/แก้ไข</a>
                                                                                                                        
                                                                                                       
                                                            <a class="dropdown-item"  href="{{ url('manager_supplies/purchasequotation_deletesub/'.$IDCON.'/'.$detailquotation->QUOTATION_ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่ลบข้อมูล {{$detailquotation->QUOTATION_NUMBER}} ?')">ลบ</a>                                                   
                                                        
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

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

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

    
  $('#edit_modal').on('show.bs.modal', function(e) {
    var Id = $(e.relatedTarget).data('id');
    var VUTId = $(e.relatedTarget).data('vutid');
    $(e.currentTarget).find('input[name="ID"]').val(Id);
    $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);

});

$('img').bind('contextmenu', function(e){
    return false;
}); 

</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,  //Set เป็นปี พ.ศ.
                autoclose: true 
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน

      
});
    
        

    $(document).ready(function () {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker3').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker4').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
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


function readURL(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
    		
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();
            
                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                        }
            
                        reader.readAsDataURL(input.files[0]);
                    }else{
        
                                alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                                fileInput.value = '';
                                return false;
       
                        }
                }

            
                $("#picture").change(function () {
                    readURL(this);
                });




</script>



@endsection