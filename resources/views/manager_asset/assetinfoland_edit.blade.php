@extends('layouts.asset')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

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





?>
<?php

     $yearbudget = date("Y")+543;
     
     $yearnow = date("Y")+543;
     $monthnow = date("m");
     $datenow1 = date("d");
     $timenow = date(" H:i:s");
 
     $datenow = $datenow1.'/'.$monthnow.'/'.$yearnow.' '.$timenow;
 
  //echo $yearbudget;

?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
           
            }

            .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      }


  
#pages{
    text-align: center;
}
.page{
    width: 90%;
    margin: 10px;
    box-shadow: 0px 0px 5px #000;
    animation: pageIn 1s ease;
    transition: all 1s ease, width 0.2s ease;
}
@keyframes pageIn{
  0%{
      transform: translateX(-300px);
      opacity: 0;
  }
  100%{
      transform: translateX(0px);
      opacity: 1;
  }
}
#zoom-in{
    
}
#zoom-percent{
    display: inline-block;
}
#zoom-percent::after{
    content: "%";
}
#zoom-out{
    
}

.form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }
      
       
</style>

<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลที่ดิน</B></h3>

</div>
<form  method="post" id="form_edit" action="{{ route('massete.updateassetinfoland') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
    @csrf

 
    <input type="hidden"  name = "ID"  id="ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->ID}}">

<div class="block-content block-content-full">
<div class="row">
   <div class="col-md-7" style="text-align: center">
   
  
   <input type="file" id="pdfupload" name="pdfupload" accept="application/pdf" style="width:75%;"/> 
<!-- 
   <input type="file" name="pdfupload"
                                    class="{{ $errors->has('pdfupload') ? 'is-invalid' : '' }}"
                                    value="{{ $infoassetland->files }}"> -->

  
   <div id="zoom-percent" style="text-align: right;background-color: #E6E6FA;">90</div>
   
   <a id="zoom-in" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-plus"></i></a>
  <a id="zoom-out" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a>
  <a id="zoom-reset" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search"></i></a>
 
<br>
<br>
<div style='overflow:scroll; width:auto;height:900px;  background-color: #404040;' id="pages">
@if($infoassetland->FILE_NAME == '' || $infoassetland->FILE_NAME == null)
      <p style="color:#F0FFFF">ไม่มีข้อมูลไฟล์อัปโหลด </p>
@else
<?php list($a,$b,$c,$d) = explode('/',$url); ?>
 <iframe src="{{ asset('storage/assetpdf/'.$infoassetland->FILE_NAME) }}" height="100%" width="100%"></iframe>

@endif


</div>


   </div>
   

   <div class="col-md-5">
   <div class="row">
   <div class="col">
   <h5 style=" font-family: 'Kanit', sans-serif;text-align: left;">รายละเอียด</h5>
   </div>
   <div class="col">
   วันที่บันทึก  {{$datenow}}
   </div>
   </div>
        
        <div class="row">
            <div class="col">
            <p style="text-align: left">เลขระวาง</p>
            </div>
            <div class="col-md-9" >
            <input  name = "LAND_RAWANG"  id="LAND_RAWANG" class="form-control input-sm{{ $errors->has('LAND_RAWANG') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_RAWANG}}">
            </div>
         
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">หมายเลขที่ดิน</p>
            </div>
            <div class="col-md-9" >
            <input  name = "LAND_NUMBER"  id="LAND_NUMBER" class="form-control input-sm{{ $errors->has('LAND_NUMBER') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_NUMBER}}">
            </div>
         
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">เลขโฉนดที่ดิน</p>
            </div>
            <div class="col-md-9" >
            <input  name = "LAND_CHANOD"  id="LAND_CHANOD" class="form-control input-sm{{ $errors->has('LAND_CHANOD') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_CHANOD}}">
            </div>
         
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">หน้าสำรวจ</p>
            </div>
            <div class="col-md-9" >
            <input  name = "LAND_FONT_CHECK"  id="LAND_FONT_CHECK" class="form-control input-sm{{ $errors->has('LAND_FONT_CHECK') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_FONT_CHECK}}">
            </div>
         
        </div>

        
        <div class="row">
            <div class="col">
            <p style="text-align: left">ที่ตั้งบ้านเลขที่</p>
            </div>
            <div class="col-md-9" >
            <input  name = "LAND_ADD"  id="LAND_ADD" class="form-control input-sm{{ $errors->has('LAND_ADD') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_ADD}}">
            </div>
         
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">ที่ตั้งจังหวัด</p>
            </div>
            <div class="col-md-9" >
            <select name="PROVINCE_ID" id="PROVINCE_ID" class="form-control input-lg provice js-example-basic-single {{ $errors->has('PROVINCE_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                        <option value="" >--กรุณาเลือกจังหวัด--</option>
                            @foreach ($infoprovinces as $infoprovince)
                                @if($infoprovince -> ID == $infoassetland->PROVINCE_ID)
                                <option value=" {{ $infoprovince -> ID }}" selected>{{ $infoprovince -> PROVINCE_NAME }}</option>
                                @else
                                <option value=" {{ $infoprovince -> ID }}" >{{ $infoprovince -> PROVINCE_NAME }}</option>
                                @endif
                            @endforeach         
                        </select>
            </div>
         
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">ที่ตั้งอำเภอ</p>
            </div>
            <div class="col-md-9" >
                        <select name="AMPHUR_ID" id="AMPHUR_ID" class="form-control input-lg amphures js-example-basic-single {{ $errors->has('AMPHUR_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" onchange="checkamphurname()">
                            <option value="">--กรุณาเลือกอำเภอ--</option>
                            @foreach ($infoamphures as $infoamphure)
                                @if($infoamphure -> ID == $infoassetland->AMPHUR_ID)
                                <option value=" {{ $infoamphure -> ID }}" selected>{{ $infoamphure -> AMPHUR_NAME }}</option>
                                @else
                                <option value=" {{ $infoamphure -> ID }}" >{{ $infoamphure -> AMPHUR_NAME }}</option>
                                @endif
                            @endforeach  
                        </select>
            </div>
         
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">ที่ตั้งตำบล</p>
            </div>
            <div class="col-md-9" >
                        <select name="TUMBON_ID" id="TUMBON_ID" class="form-control input-lg tumbon js-example-basic-single {{ $errors->has('TUMBON_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" onchange="checktumbonname()">
                            <option value="" >--กรุณาเลือกตำบล--</option>
                            @foreach ($infotumbons as $infotumbon)
                                @if($infotumbon -> ID == $infoassetland->TUMBON_ID)
                                <option value=" {{ $infotumbon -> ID }}" selected>{{ $infotumbon -> TUMBON_NAME }}</option>
                                @else
                                <option value=" {{ $infotumbon -> ID }}" >{{ $infotumbon -> TUMBON_NAME }}</option>
                                @endif
                            @endforeach  
                        </select>
            </div>
         
        </div>

        
        <div class="row">
            <div class="col">
            <p style="text-align: left">ไปรษณีย์</p>
            </div>
            <div class="col-md-9" >
            <input  name = "ZIPCODE"  id="ZIPCODE" class="form-control input-sm {{ $errors->has('ZIPCODE') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" maxlength="5" value="{{$infoassetland->ZIPCODE}}">
            </div>
         
        </div>


              
        <div class="row">
            <div class="col">
            <p style="text-align: left">เนื้อที่ไร่</p>
            </div>
            <div class="col-md-3" >
            <input  name = "LAND_SIZE"  id="LAND_SIZE" class="form-control input-sm{{ $errors->has('LAND_SIZE') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_SIZE}}" OnKeyPress="return chkNumber(this)" >
            </div>
            <div class="col">
            <p style="text-align: left">เนื้อที่งาน</p>
            </div>
            <div class="col-md-3" >
            <input  name = "LAND_SIZE_NGAN"  id="LAND_SIZE_NGAN" class="form-control input-sm{{ $errors->has('LAND_SIZE_NGAN') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{number_format($infoassetland->LAND_SIZE_NGAN)}}" OnKeyPress="return chkNumber(this)" >
            </div>
         
        </div>

        <div class="row">
            <div class="col-md-3">
            <p style="text-align: left">เนื้อที่ตารางวา</p>
            </div>
            <div class="col-md-3" >
            <input  name = "LAND_SIZE_TARANGWA"  id="LAND_SIZE_TARANGWA" class="form-control input-sm{{ $errors->has('LAND_SIZE_TARANGWA') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{number_format($infoassetland->LAND_SIZE_TARANGWA)}}" OnKeyPress="return chkNumber(this)" >
            </div>
         
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">ผู้ถือครอง</p>
            </div>
            <div class="col-md-9" >
            <input  name = "LAND_OWNER"  id="LAND_OWNER" class="form-control input-sm {{ $errors->has('LAND_OWNER') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif; " value="{{$infoassetland->LAND_OWNER}}">
            </div>
         
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">วันถือครอง</p>
            </div>
            <div class="col-md-9" >
            <input name="LAND_OWNER_DATE" id="LAND_OWNER_DATE" class="form-control input-lg datepicker {{ $errors->has('LAND_OWNER_DATE') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" data-date-format="mm/dd/yyyy"  value="{{formate($infoassetland->LAND_OWNER_DATE)}}" readonly>
            </div>
         
        </div>


        <div class="row">
            <div class="col">
            <p style="text-align: left">พิกัดละติจูด</p>
            </div>
            <div class="col-md-3">
            <input  name = "LAND_LAT"  id="LAND_LAT" class="form-control input-sm {{ $errors->has('LAND_LAT') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_LAT}}" OnKeyPress="return chkmunny(this)">
            </div>
            <div class="col">
            <p style="text-align: left">พิกัดลองจิจูด</p>
            </div>
            <div class="col-md-3">
            <input  name = "LAND_LNG"  id="LAND_LNG" class="form-control input-sm {{ $errors->has('LAND_LNG') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_LNG}}" OnKeyPress="return chkmunny(this)">
            </div>
        </div>
       
     
        <div class="row">
            <div class="col">
            <p style="text-align: left">สำนักงานที่ดิน</p>
            </div>
            <div class="col-md-9" >
            <input  name = "LAND_OFFICE"  id="LAND_OFFICE" class="form-control input-sm{{ $errors->has('LAND_OFFICE') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_OFFICE}}">
            </div>
         
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">เบอร์ติดต่อ</p>
            </div>
            <div class="col-md-9" >
            <input  name = "LAND_OFFICE_PHONE"  id="LAND_OFFICE_PHONE" class="form-control input-sm {{ $errors->has('LAND_OFFICE_PHONE') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetland->LAND_OFFICE_PHONE}}">
            </div>
         
        </div>
   

        </div>
</div>
<br>
<div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info btn-submit-edit" ><i class="fas fa-save"></i>&nbsp;บันทึกแก้ไขข้อมูล</button>
        <a href="{{ url('manager_asset/assetinfoland')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</a>
        </div>

</form>



 
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script>

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});



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
     
     $('.provice').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetch')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.amphures').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.amphures').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetchsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.tumbon').html(result);
                     }
             })
            // console.log(select);
             }        
     });

</script>


<script>
  //========================================================

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


//---------------------------------------------------------------------------------
pdfjsLib.GlobalWorkerOptions.workerSrc =
"{{ asset('pdfupload/pdf_upwork.js') }}";

  document.querySelector("#pdfupload").addEventListener("change", function(e){
  document.querySelector("#pages").innerHTML = "";

	var file = e.target.files[0]
	if(file.type != "application/pdf"){
		alert(file.name + " is not a pdf file.")
		return
	}
	
	var fileReader = new FileReader();  

	fileReader.onload = function() {
		var typedarray = new Uint8Array(this.result);
    
		pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
			// you can now use *pdf* here
			console.log("the pdf has", pdf.numPages, "page(s).");
      for (var i = 0; i < pdf.numPages; i++) {
        (function(pageNum){
        pdf.getPage(i+1).then(function(page) {
          // you can now use *page* here
          var viewport = page.getViewport(2.0);
          var pageNumDiv = document.createElement("div");
          pageNumDiv.className = "pageNumber";
          pageNumDiv.innerHTML = "Page " + pageNum;
          var canvas = document.createElement("canvas");
          canvas.className = "page";
          canvas.title = "Page " + pageNum;
          document.querySelector("#pages").appendChild(pageNumDiv);
          document.querySelector("#pages").appendChild(canvas);
          canvas.height = viewport.height;
          canvas.width = viewport.width;


          page.render({
            canvasContext: canvas.getContext('2d'),
            viewport: viewport
          }).promise.then(function(){
            console.log('Page rendered');
          });
          page.getTextContent().then(function(text){
              console.log(text);
          });
        });
        })(i+1);
      }

		});
	};
 
	fileReader.readAsArrayBuffer(file);
   

});




var curWidth = 90;
function zoomIn(){
    if (curWidth < 150) {
        curWidth += 10;
        document.querySelector("#zoom-percent").innerHTML = curWidth;
        document.querySelectorAll(".page").forEach(function(page){

            page.style.width = curWidth + "%";
        });
    }
}
function zoomOut(){
    if (curWidth > 20) {
        curWidth -= 10;
        document.querySelector("#zoom-percent").innerHTML = curWidth;
        document.querySelectorAll(".page").forEach(function(page){

            page.style.width = curWidth + "%";
        });
    }
}
function zoomReset(){

    curWidth = 90;
    document.querySelector("#zoom-percent").innerHTML = curWidth;
   
    document.querySelectorAll(".page").forEach(function(page){
      page.style.width = curWidth + "%";
    });
}
document.querySelector("#zoom-in").onclick = zoomIn;
document.querySelector("#zoom-out").onclick = zoomOut;
document.querySelector("#zoom-reset").onclick = zoomReset;
window.onkeypress = function(e){
    if (e.code == "Equal") {
        zoomIn();
    }
    if (e.code == "Minus") {
        zoomOut();
    }
};

$('#form_edit').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);
       $.ajax({
          type:'POST',
          url:$(this).attr('action'),
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
                if(response.status === 1){
                    
                this.reset();
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    showConfirmButton: false,
                })

                $('.loading-page').show();
                window.location.href = response.url;

                }
           },
           error: function (jqXHR, testStatus, error) {
            var errorObj = jqXHR.responseJSON;
            if(errorObj){

                $.each( errorObj.errors, function( key, value ) {
                    
                    $('#'+key).addClass('is-invalid');
                });
                Swal.fire({
                    icon: 'error',
                    title: 'กรอกข้อมูลให้ครบถ้วน',
                    text: 'Something went wrong!',
                   
                  })
                
            }
        },
       });
  });



function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>
@endsection