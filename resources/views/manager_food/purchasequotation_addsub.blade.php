@extends('layouts.food')
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

?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
            }

            .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
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

<br>
<br>
<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>เพิ่มใบเสนอราคา รายการเลขทะเบียน {{$CON_NUM}}</B></h3>

</div>
<form  method="post" action="{{ route('mfood.savepurchasequotationsub') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
    @csrf

<div class="block-content block-content-full">
<div class="row">
   <div class="col-md-7" style="text-align: center">
   
  
   <input type="file" id="pdfupload" name="pdfupload" accept="application/pdf" style="width:75%;"/>
  
   <div id="zoom-percent" style="text-align: right;background-color: #E6E6FA;">90</div>
   
   <a id="zoom-in" class="btn btn-info    fa fa-search-plus" style="color:#F0FFFF"></a>
  <a id="zoom-out" class="btn btn-info    fa fa-search-minus" style="color:#F0FFFF"></a>
  <a id="zoom-reset" class="btn btn-info    fa fa-search" style="color:#F0FFFF"></a>
 
<br>
<br>
<div style='overflow:scroll; width:auto;height:900px;  background-color: #404040;' id="pages"></div>

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
   
   <input  type="hidden" name = "QUOTATION_CON_NUM"  id="QUOTATION_CON_NUM" class="form-control input-lg" value="{{$CON_NUM}}" >
   <input  type="hidden" name = "ID"  id="ID" class="form-control input-lg" value="{{$IDCON}}" >
   <div class="row">
    <div class="col">
        <p style="text-align: left">เลขที่ใบเสนอราคา</p>
        </div>
        <div class="col-md-9">
    <input  name = "QUOTATION_NUMBER"  id="QUOTATION_NUMBER" class="form-control input-lg {{ $errors->has('QUOTATION_NUMBER') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" >
    </div> 
    </div>
    <div class="row">
    <div class="col">
    <p style="text-align: left">บริษัท</p>
    </div>
    <div class="col-md-9">

        <select name="QUOTATION_VENDOR_ID" id="QUOTATION_VENDOR_ID" class="form-control input-lg js-example-basic-single vendor {{ $errors->has('QUOTATION_VENDOR_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;">
        
        <option value="">--กรุณาเลือกบริษัท--</option>
         @foreach ($vendors as $vendor)

         <option value="{{ $vendor ->VENDOR_ID  }}">{{ $vendor->VENDOR_NAME}}</option>
       
        @endforeach 
    </select>   
    
    </div>
    </div>

<div class="detailvendor">

    <div class="row">
    <div class="col">
    <p style="text-align: left">ที่อยู่</p>
    </div>
    <div class="col-md-9">
        <input  name = "QUOTATION_VENDOR_ADD"  id="QUOTATION_VENDOR_ADD" class="form-control input-lg {{ $errors->has('QUOTATION_VENDOR_ADD') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" >
    </div>
    </div>
    <div class="row">
    <div class="col">
    <p style="text-align: left">เลขภาษี</p>  
    </div>
    <div class="col-md-9">
        <input  name = "QUOTATION_VENDOR_TAXNUM"  id="QUOTATION_VENDOR_TAXNUM" class="form-control input-lg {{ $errors->has('QUOTATION_VENDOR_TAXNUM') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" >
    </div>
    </div>



    <div class="row">
    <div class="col">
    <p style="text-align: left">ยอดนำเสนอ</p>
    </div>
    <div class="col-md-7">
        <input  name = "QUOTATION_VENDOR_PICE"  id="QUOTATION_VENDOR_PICE" class="form-control input-lg {{ $errors->has('QUOTATION_VENDOR_PICE') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkmunny(this)">
    </div>
    <div class="col-md-2">
    <p style="text-align: left">บาท</p>
    </div>
    </div>

</div>
    <div class="row">
    <div class="col">
    <p style="text-align: left">สถานะประมูล</p>
    </div>
    <div class="col-md-9" style="text-align: left">
    <input name="QUOTATION_WIN" id="QUOTATION_WIN" type="checkbox" class="form-check-input" value="1">เป็นผู้ชนะ
    </div>
    </div>



    </div>

</div>
<br>
<div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info f-kanit fw-1" >บันทึกข้อมูล</button>
        <a href="{{ url('manager_food/infofoodbilltotal_quotation_add/'.$IDCON)  }}" class="btn btn-hero-sm btn-hero-danger f-kanit fw-1" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

</form>



 
@endsection

@section('footer')

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>

$(document).ready(function() {
    $('select').select2();
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

//-------------------------------------------------------------------------

function selectvendor(idrefvendor) {
    
    //  alert("Hello! I am an alert box!!");

    $.ajax({
        url: "{{route('msupplies.selectvendor')}}",
        method: "GET",
        data: {
            idrefvendor: idrefvendor},
         
        success: function(result) {
            $('.vendor').html(result);
            vendorname();

            document.getElementById("QUOTATION_WIN").checked = true;
        }

    })


}


function vendorname(idrefvendor) {
    
 
    var select = document.getElementById("QUOTATION_VENDOR_ID").value;
    var select_id = document.getElementById("ID").value;
    
    var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.fetchvendor')}}",
                     method:"GET",
                     data:{select:select,select_id:select_id,_token:_token},
                     success:function(result){
                        $('.detailvendor').html(result);
                     }
             })


}

$('.vendor').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.fetchvendor')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.detailvendor').html(result);
                     }
             })
            // console.log(select);
             }        
     });
</script>
@endsection