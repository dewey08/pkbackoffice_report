 @extends('layouts.guesthouse')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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
    <div class="block mt-5 shadow-lg" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขคำร้องขอบ้านพัก</B></h3>
                &nbsp;&nbsp;
          
                <a href="{{ url('manager_guesthouse/guesthouserequest')  }}"   class="btn btn-hero-sm btn-hero-success foo15 loadscreen" ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
            </div>
            <div class="block-content block-content-full">
       
            <form  method="post" action="{{ route('mguesthouse.guesthouserequest_update') }}" enctype="multipart/form-data"> 
        @csrf      
        <div class="row push">
         
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-2">
                        <label style="text-align: left"> ผู้ร้องขอ :</label>
                    </div> 
            
                    <div class="col-lg-4 text-left">
                    {{ $infopetition -> HR_PREFIX_NAME }}   {{ $infopetition -> HR_FNAME }}  {{ $infopetition -> HR_LNAME }}
                    </div> 
                    <div class="col-lg-2">
                        <label style="text-align: left"> ตำแหน่งงาน :</label>
                    </div> 
            
                    <div class="col-lg-4 text-left">
                    {{ $infopetition -> POSITION_IN_WORK }} 
                    </div> 
                </div>
                <br>

                <div class="row">
                    <div class="col-lg-2">
                        <label style="text-align: left"> ระดับ :</label>
                    </div> 
            
                    <div class="col-lg-4 text-left">
                    {{ $infopetition -> HR_LEVEL_NAME }}  
                    </div> 
                    <div class="col-lg-2">
                        <label style="text-align: left"> ติดต่อ :</label>
                    </div> 
            
                    <div class="col-lg-4 text-left">
                    <input name="PETITION_HR_TEL" id="PETITION_HR_TEL" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" maxlength="10" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infopetition->PETITION_HR_TEL}}">
                    </div> 
                </div>
                <br>
              

                <div class="row">
                    <div class="col-lg-2">
                            <label style="text-align: left"> ประเภทคำร้อง :</label>
                        </div> 
                        <div class="col-lg-4 ">

                        <select name="PETITION_TYPE" id="PETITION_TYPE" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" >
                                <option value="" >--กรุณาประเภท --</option>
                              
                                @if($infopetition->PETITION_TYPE == '1')<option value="1" selected>ขอเข้าพัก</option>@else<option value="1" >ขอเข้าพัก</option>@endif
                                @if($infopetition->PETITION_TYPE  == '2')<option value="2" selected>ขอเปลี่ยนแปลง</option>@else<option value="2" >ขอเปลี่ยนแปลง</option>@endif
                                @if($infopetition->PETITION_TYPE  == '3')<option value="3" selected>ขอย้ายออก</option>@else<option value="3" >ขอย้ายออก</option>@endif
                             
                                </select>
                      
                        </div>
                        <div class="col-lg-2">
                            <label style="text-align: left"> ปัจจุบันอาศัยอยู่ที่ :</label>
                        </div> 
                    <div class="col-lg-4 ">
                        <input name="PETITION_ADD" id="PETITION_ADD" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infopetition->PETITION_ADD}}">
                    </div>                    
                </div> 
                <br>
                <div class="row">
                        <div class="col-lg-2">
                            <label style="text-align: left"> หมายเหตุ :</label>
                        </div> 
                        <div class="col-lg-10 ">
                            <input name="PETITION_REMARK" id="PETITION_REMARK" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infopetition->PETITION_REMARK}}">
                        </div>         
                
                </div> 
                <br>

            </div> 
        </div> 

        <input type="hidden" name="PETITION_ID" id="PETITION_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infopetition->PETITION_ID}}">
     

        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info foo15 loadscreen" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <a href="{{ url('manager_guesthouse/guesthouserequest')  }}" class="btn btn-hero-sm btn-hero-danger foo15 " onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

       
        </div>
        </form>  
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


    $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });

</script>
<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('select').select2();
});
</script>
@endsection