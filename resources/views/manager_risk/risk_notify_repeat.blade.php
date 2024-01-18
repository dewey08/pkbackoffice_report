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
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
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
<br>
<br>

<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">รายละเอียดการทบทวน</h2>   
              
                <a href="{{ url('manager_risk/risk_notify_repeat_sub/'.$rigreps->RISKREP_ID) }}"   class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>&nbsp;
                <a href="{{ route('mrisk.detail')}}"   class="btn btn-success btn-lg" >ย้อนกลับ</a>
           
            <input type="hidden" value="{{$rigreps->RISKREP_ID}}" name = "RISKREP_ID"  id="RISKREP_ID" class="form-control input-lg"> 
    
            </div>
                <div class="block-content block-content-full">            
                    <div class="table-responsive">                        
                       <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                           <thead style="background-color: #FFEBCD;">
                               <tr height="40">
                                <th  class="text-font" style="text-align: center;font-size: 13px;" width="5%">ลำดับ</th> 
                                <th  class="text-font" style="text-align: center;font-size: 13px;" width="7%">ครั้งที่</th>                               
                                <th  class="text-font" style="text-align: center;font-size: 13px;" >รายละเอียด </th>       
                                
                                <th  class="text-font" style="text-align: center;font-size: 13px;" width="10%">ผู้บันทึก</th>  
                                <th  class="text-font" style="text-align: center;font-size: 13px;" width="12%">วันที่-เวลาตอบกลับ</th> 
                                <th  class="text-font" style="text-align: center;font-size: 13px;" width="7%">คำสั่ง</th> 
                               </tr >
                           </thead>
                           <tbody>
                            <?php $number = 0; ?>
                            @foreach ($notify_repeats as $notify_repeat)
                            <?php $number++; ?>
                               <tr height="20">
                                <td class="text-font" style="text-align: center;font-size: 13px;">{{ $number}}</td>
                                <td class="text-font" style="text-align: center;font-size: 13px;">{{$notify_repeat->NOTIFY_REPEAT_NO}} </td>                                      
                                <td class="text-font" style="text-align: center;font-size: 13px;">{{$notify_repeat->NOTIFY_REPEAT_DETAIL}} </td>
                       
                                <td class="text-font"style="text-align: center;font-size: 13px;" >{{$notify_repeat->HR_FNAME}}  {{$notify_repeat->HR_LNAME}}</td>
                                <td class="text-font" style="text-align: center;font-size: 13px;">{{DateThai($notify_repeat->NOTIFY_REPEAT_DATE)}} </td>                                                  
                                       <td align="center">
                                                   <div class="dropdown">
                                                       <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                           ทำรายการ
                                                       </button>
                                                       <div class="dropdown-menu" style="width:10px">
                                                       <a class="dropdown-item"  href="{{ url('manager_risk/risk_notify_repeat_sub_edit/'.$notify_repeat->NOTIFY_REPEAT_ID.'/'.$rigreps->RISKREP_ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;" >แก้ไข</a>   
                                                       <a class="dropdown-item"  href="{{ url('manager_risk/risk_notify_repeat_sub_destroy/'.$notify_repeat->NOTIFY_REPEAT_ID.'/'.$rigreps->RISKREP_ID) }}"   onclick="return confirm('ต้องการที่จะลบข้อมูล ?')"  style="font-family: 'Kanit', sans-serif; font-size: 13px;" >ลบ</a>   
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
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
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