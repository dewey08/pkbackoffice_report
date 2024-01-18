@extends('layouts.risk')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
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
        .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
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
        .table-fixed tbody {
                height: 300px;
                overflow-y: auto;
                width: 100%;
            }

            .table-fixed thead,
            .table-fixed tbody,
            .table-fixed tr,
            .table-fixed td,
            .table-fixed th {
                display: block;
            }

            .table-fixed tbody td,
            .table-fixed tbody th,
            .table-fixed thead > tr > th {
        float: left;
        position: relative;

        &::after {
            content: '';
            clear: both;
            display: block;
        }
    }
</style>

<script>
    function checklogin(){
     window.location.href = '{{route("index")}}'; 
    }
</script>

<?php


     $yearbudget = date("Y")+543;
     
     $yearnow = date("Y")+543;
     $monthnow = date("m");
     $datenow1 = date("d");
     $timenow = date(" H:i:s");
 
     $datenow = $datenow1.'/'.$monthnow.'/'.$yearnow.' '.$timenow;
 
 
?>
<br><br>
<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลทบทวนความเสี่ยง</B></h3>

</div>
<form  method="post"  action="{{ route('mrisk.detail_check_recheck_update') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
    @csrf

<input  type="hidden" name = "RISK_RECHECK_ID"  id="RISK_RECHECK_ID" value="{{$inforecheck->RISK_RECHECK_ID}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
<input  type="hidden" name = "RISK_RECHECK_RISKID"  id="RISK_RECHECK_RISKID" value="{{$riskid}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >

    <div class="block-content block-content-full">
<div class="row">
   <div class="col-md-7" style="text-align: center">
   
  
   <input type="file" id="pdfupload" name="pdfupload" accept="application/pdf" style="width:75%;"/>
  
   <div id="zoom-percent" style="text-align: right;background-color: #E6E6FA;">90</div>
   
   <a id="zoom-in" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-plus"></i></a>
  <a id="zoom-out" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a>
  <a id="zoom-reset" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a>
 
<br>
<br>
<div style='overflow:auto; width:auto; background-color: #404040;' id="pages">

@if($inforecheck->RISK_RECHECK_FILE == '' || $inforecheck->RISK_RECHECK_FILE == null)
      ไม่มีข้อมูลไฟล์อัปโหลด 
@else 
 <iframe src="{{ asset('storage/riskpdf/'.$inforecheck->RISK_RECHECKE_NAME) }}" height="680px" width="100%"></iframe>

@endif
   </div>

</div>
   <div class="col-md-5">
   <div class="row">
   <div class="col">
   <h5 style=" font-family: 'Kanit', sans-serif;text-align: left;">รายละเอียด</h5>
   </div>
   <div class="col">
   วันที่บันทึกแก้ไข  {{$datenow}}
   </div>
   </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">วันที่ทบทวน</p>
            </div>
            <div class="col-md-9">
            <input  name = "RISK_RECHECK_DATE"  id="RISK_RECHECK_DATE" value="{{formate($inforecheck->RISK_RECHECK_DATE)}}" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
          
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">หัวข้อทบทวน</p>
            </div>
            <div class="col-md-9">
            <input  name = "RISK_RECHECK_HEAD"  id="RISK_RECHECK_HEAD" value="{{$inforecheck->RISK_RECHECK_HEAD}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            </div>
          
        </div>
        <br>

        <div class="row">
            <div class="col">
            <p style="text-align: left">รายละเอียด</p>
            </div>
            <div class="col-md-9">
            <textarea  name = "RISK_RECHECK_DETAIL"  id="RISK_RECHECK_DETAIL"  rows="3" cols="50" class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;">{{$inforecheck->RISK_RECHECK_DETAIL}}</textarea>
            
            </div>

        
        </div>
        <br>
        <div class="row">
            <div class="col">
            <p style="text-align: left">สรุปการทบทวน</p>
            </div>
            <div class="col-md-9">
            <textarea  name = "RISK_RECHECK_TOTAL"  id="RISK_RECHECK_TOTAL" rows="3" cols="50" class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;">{{$inforecheck->RISK_RECHECK_TOTAL}}</textarea>
            
            </div>

           
           
        </div>
        <br>

        <div class="row">
            <div class="col">
            <p style="text-align: left">ผู้บันทึก</p>
            </div>
            <div class="col-md-9" style="text-align: left">
                <select name="RISK_RECHECK_PERSON" id="RISK_RECHECK_PERSON" class="form-control input-lg js-example-basic-single org_re" style=" font-family: 'Kanit', sans-serif;" required>
                    <option value="" selected>--กรุณาเลือกผู้บันทึก--</option>
                                    @foreach ($persons as $person)  
                                      @if($person->ID == $inforecheck->RISK_RECHECK_PERSON)
                                      <option value="{{ $person -> ID}}" selected>{{ $person->HR_FNAME}} {{ $person->HR_LNAME}}</option>                     
                                      @else
                                        <option value="{{ $person -> ID}}">{{ $person->HR_FNAME}} {{ $person->HR_LNAME}}</option>          
                                      @endif
                                    @endforeach 
                    </select> 

              
            </div>
           
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">แนบไฟล์เพิ่ม</p>
            </div>
            <div class="col-md-9">
            <input style="font-family: 'Kanit', sans-serif;" type="file" name="fileupload" id="fileupload" class="form-control">
            
            </div>

           
           
        </div>
        




   </div>
  
   


</div>
<br>
<div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif;font-weight:normal;">บันทึกข้อมูล</button>
        <a href="{{ url('manager_risk/detail_check_recheck/'.$riskid)  }}" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        
     
    </div>

</form>



 
@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

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
  
//===============================เพิ่มหน่วยงาน====================================
function addorg(){
      
      var record_org=document.getElementById("ADD_RECORD_ORG").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mbook.addorg')}}",
                   method:"GET",
                   data:{record_org:record_org,_token:_token},
                   success:function(result){
                      $('.org_re').html(result);
                   }
           })

  }

//====================================================================

function checkmax(){
      
      var year=document.getElementById("BOOK_YEAR_ID").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mbook.checkmax')}}",
                   method:"GET",
                   data:{year:year,_token:_token},
                   success:function(result){
                      $('.max_re').html(result);
                   }
           })

  }


</script>
@endsection