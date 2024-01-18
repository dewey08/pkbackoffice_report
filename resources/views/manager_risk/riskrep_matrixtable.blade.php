@extends('layouts.risk')   
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

    function timeformate($strtime)
  {   
    list($a,$b) = explode(':',$strtime);
    return $a.":".$b;
    }
?>
<br><br><br><center>
     <div>
        <div class="block block-rounded block-bordered">


        <div class="block-content">
        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่า Risk matrix</h2>
             
                <div class="block-content">
                    <form  method="post" action="{{ route('mrisk.riskrep_matrixtableupdate') }}" enctype="multipart/form-data">
                        @csrf
               

                    <div class="row">  
                        <div>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                          <label >ตาราง (size 180x360) :</label>
                        </div>
                        </div>
                        <div class="col-lg-4">
                      <div class="form-group">
                      
                        
                @if ( $inforiskimgmatrix->RISK_IMG_MATRIX == Null )
                        <img id="image_upload_preview" src="{{asset('image/pers.png')}}" height="180" width="360"> 
                      @else
                      <img id="image_upload_preview" src="data:image/png;base64,{{ chunk_split(base64_encode($inforiskimgmatrix->RISK_IMG_MATRIX)) }}" height="180" width="360"> 
                      @endif
                      
                      
                      
                      </div>                             
                        <div class="form-group">
                        <input style="font-family: 'Kanit', sans-serif;" type="file" name="picture" id="picture" class="form-control">
                        </div>
                      </div>
                      
                      </div>
                      
                          <div class="modal-footer">
                              <div align="right">
                              <button type="submit"  class="btn btn-hero-sm btn-hero-info fw-1 f-kanit" > <i class="fas fa-save"></i>  บันทึกข้อมูล</button>
                             </div>    
                      
                      </div> 
                      <input type="hidden"  name = "RISK_IMG_ID"  id="RISK_IMG_ID"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" value="{{ $inforiskimgmatrix->RISK_IMG_ID }}">
                      </body>
                      </form>
                </div>
            </div>
          

@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

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

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>

function readURL(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
        var numb = input.files[0].size/1024;
   
                    if(numb > 64){
                        alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
                            fileInput.value = '';
                            return false;
                        }
    		
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



<script>
 
    function switchactive(idfunc){
         // alert(budget);
         var checkBox=document.getElementById(idfunc);
         var onoff;
   
         if (checkBox.checked == true){
           onoff = "True";
     } else {
           onoff = "False";
     }
 
   
    var _token=$('input[name="_token"]').val();
         $.ajax({
                 url:"{{route('mrisk.riskfunction')}}",
                 method:"GET",
                 data:{onoff:onoff,idfunc:idfunc,_token:_token}
         })
         }        
     
   </script>

@endsection