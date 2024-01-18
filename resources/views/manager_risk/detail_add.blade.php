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


    use App\Http\Controllers\ManagerriskController;
    $refnumber = ManagerriskController::refnumberRisk();



    use App\Http\Controllers\FectdataController;
    $checkleader_sub = FectdataController::checkleader_sub($id_user);

    $datenow = date('Y-m-d');
?>

<br>
<br>
<br>

<center>
<div class="block" style="width: 95%;" >
<div class="block block-rounded block-bordered">
         
<div class="block-content">    
    <div align="left">
    <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">เพิ่มรายงานความเสี่ยง</h2> 
</div> 
    <div class="block-content block-content-full">
    <form  method="post" action="{{ route('mrisk.detail_save') }}" enctype="multipart/form-data">
    @csrf
    
    <input value="{{$id_user}}" type="hidden" name = "USER_ID"  id="USER_ID" class="form-control input-lg"  >                                                                 
           
    <div class="row push">
        <div class="col-sm-2">
            <label for="RISKREP_NO" style="font-family:'Kanit',sans-serif;font-size:13px;">Risk no. :</label>
            </div> 
            <div class="col-lg-2 ">
                <input type="text"name="RISKREP_NO" id="RISKREP_NO" class="form-control input-sm fo13" value="{{$refnumber}} ">             
            </div> 
            
            <div class="col-sm-1">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่บันทึก:</label>
                </div> 
                <div class="col-lg-2 "> 
                <input name="RISKREP_DATESAVE" id="RISKREP_DATESAVE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style="font-family:'Kanit',sans-serif;font-size:13px;" value="{{formate($datenow)}}" readonly>          
                
                </div> 
                <div class="col-sm-2">
                    <label for="RISKREP_DEPARTMENT_SUB" style="font-family:'Kanit',sans-serif;font-size:13px;">หน่วยงานที่รายงาน :</label>
                    </div> 
                    <div class="col-lg-3 ">                                        
                        @foreach($departsubs as $departsub)
                        <input type="text" class="form-control input-sm fo13" name="" id="" value="{{ $departsub-> HR_DEPARTMENT_SUB_SUB_NAME}}" readonly>
                        <input type="hidden" class="form-control input-sm fo13" name="RISKREP_DEPARTMENT_SUB" id="RISKREP_DEPARTMENT_SUB" value="{{ $departsub-> HR_DEPARTMENT_SUB_SUB_ID}}" >
                        @endforeach
                        
                    </div>              
                </div> 
                <div class="row push">
                    <div class="col-sm-2">
                        <label style="font-family:'Kanit',sans-serif;font-size:13px;">แหล่งที่มา/วิธีการค้นพบ :</label>
                        </div> 
                        <div class="col-lg-2 ">
                        <select name="RISKREP_SEARCHLOCATE" id="RISKREP_SEARCHLOCATE" class="form-control input-sm fo13" required>
                        <option value="">--เลือก--</option>
                        @foreach($locations as $location)
                                <option value="{{ $location-> INCIDENCE_LOCATION_ID}}">{{ $location-> INCIDENCE_LOCATION_NAME}} </option>
                            @endforeach
                        </select>
                        </div>
                   
                    
                    
                    <div class="col-sm-1">
                        <label for="RISKREP_TYPE" style="font-family:'Kanit',sans-serif;font-size:13px;">ประเภทสถานที่:</label>
                        </div> 
                        <div class="col-lg-2 ">
                            <select name="RISKREP_TYPE" id="RISKREP_TYPE" class="form-control input-sm typelocation fo13" required>
                                <option value="">--เลือก--</option>
                                    @foreach($typelocations as $typelocation)
                                        <option value="{{ $typelocation-> SETUP_TYPELOCATION_ID}}" >{{ $typelocation-> SETUP_TYPELOCATION_NAME}}</option>
                                    @endforeach
                            </select> 
                        </div> 
                     
                        <div class="col-sm-2">
                            <label >หัวหน้างาน</label><label style="color: red;">** &nbsp;</label>                           
                        </div>
                        <div class="col-lg-3 ">
                            <select name="LEADER_PERSON_ID" id="LEADER_PERSON_ID" class="form-control input-lg fo13" required>
                           
                                @foreach ($leaders as $leader) 
                                  @if( $leader ->LEADER_ID  == $checkleader_sub)
                                       <option value="{{ $leader ->LEADER_ID  }}" selected>{{ $leader->LEADER_NAME}}</option>
                                  @else                                                    
                                        <option value="{{ $leader ->LEADER_ID  }}">{{ $leader->LEADER_NAME}}</option>
                                  @endif      
                                @endforeach 
                            </select>                            
                        </div>

                           
                    </div>  
        
        <div class="row push">
            <div class="col-sm-2">
                <label style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดเหตุการณ์ :</label>
            </div> 
            <div class="col-lg-10 ">
            <textarea name="RISKREP_DETAILRISK" id="RISKREP_DETAILRISK" class="form-control input-lg time fo13" rows="3" required></textarea>
            </div>
        </div>                
    
    
        <div class="row push">
            <div class="col-sm-2">
            <label style="font-family:'Kanit',sans-serif;font-size:13px;">การจัดการเบื้องต้น :</label>
            </div> 
            <div class="col-lg-10 ">
            <textarea name="RISKREP_BASICMANAGE" id="RISKREP_BASICMANAGE" class="form-control input-lg time"  style=" font-family:'Kanit', sans-serif;font-size:13px;" rows="3" required></textarea>
            </div>
            </div>
        

            <div class="row push">
                <div class="col-sm-2">
                </div> 
                <div class="col-sm-4">
                    <div class="form-group">
                        <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>      
                        <img id="add_preview" src="{{asset('image/camera.png')}}" alt="Image" class="img-thumbnail" height="200" width="200"/>
                        </div>
                        <div class="form-group">
                        *ขนาดรูปไม่เกิน 350 x 350 pixel
                        <input type="file" name="RISK_REP_IMG" id="RISK_REP_IMG" class="form-control" onchange="addURL(this)">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div> 
                <div class="col-sm-1">
                </div> 
                <div class="col-lg-5 ">
                    
                    <div class="form-group">
                        <br><br><br><br><br><br><br><br><br>
                        <p style="font-family:'Kanit',sans-serif;font-size:13px;">เอกสารประกอบ </p>
                        <input type="file" name="RISKREP_DOCFILE" id="RISKREP_DOCFILE" class="form-control">
                        </div>
                </div>
        </div>  
           
<div class="modal-footer">
<div align="right">
<button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
<a href="{{ url('manager_risk/detail')  }}" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
</div>

</div>

  
 
  
@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
 
<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script>
    function addURL(input) {
        var fileInput = document.getElementById('RISK_REP_IMG');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        var numb = input.files[0].size/2048;
   
            if(numb > 64){
                alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
                    fileInput.value = '';
                    return false;
                }

            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#add_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }else{
                alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                fileInput.value = '';
                return false;
            }
        }
</script>


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

@endsection