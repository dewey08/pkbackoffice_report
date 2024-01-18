@extends('layouts.book')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />


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

use App\Http\Controllers\DashboardController;
$checkbook = DashboardController::checkbook($id_user);

?>
<?php
 
  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

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
    font-size: 14px;
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
            font-size: 14px;
            }
      
       
</style>

<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ออกเลขหนังสือส่ง</B></h3>

</div>
<form  method="post" action="{{ route('mbook.saverout') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
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
<div style='overflow:scroll; width:auto;height:500px;  background-color: #404040;' id="pages"></div>

   </div>
   

   <div class="col-md-5">
   <h5 style=" font-family: 'Kanit', sans-serif;">รายละเอียด</h5>
        <div class="row">
            <div class="col">
            <p style="text-align: left">เลขรับ</p>
            </div>
            <div class="col-md-3">
            <input  name = "BOOK_NUM_OUT"  id="BOOK_NUM_OUT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            </div>
            <div class="col-md-3">
            <p style="text-align: left">ปีงบประมาณ</p>
            </div>
            <div class="col-md-3">
            <select name="BOOK_YEAR_ID" id="BOOK_YEAR_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onchange="checkdatebegin();checkdateend();checkall();">
                        @foreach ($budgetyears as $budgetyear) 
                                 @if($budgetyear ->LEAVE_YEAR_ID == $yearbudget)
                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_ID }}</option>
                                @else
                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_ID }}</option>
                                @endif
                        @endforeach 
                </select>
            </div>
        </div>

    

        <div class="row">
            <div class="col">
            <p style="text-align: left">ความเร่งด่วน</p>
            </div>
            <div class="col-md-3">
            <select name="BOOK_URGENT_ID" id="BOOK_URGENT_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onchange="checkdatebegin();checkdateend();checkall();">
                        @foreach ($bookinstants as $bookinstant) 
                          
                            <option value="{{ $bookinstant ->INSTANT_ID  }}">{{ $bookinstant->INSTANT_NAME }}</option>
                               
                        @endforeach 
                </select>
            </div>
            <div class="col-md-3">
            <p style="text-align: left">ชั้นความลับ</p>
            </div>
            <div class="col-md-3">
            <select name="BOOK_SECRET_ID" id="BOOK_SECRET_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onchange="checkdatebegin();checkdateend();checkall();">
                        @foreach ($booksecrets as $booksecret) 
                          
                            <option value="{{ $booksecret ->BOOK_SECRET_ID  }}">{{ $booksecret->BOOK_SECRET_NAME }}</option>
                               
                        @endforeach 
                </select>
            </div>
        </div>
       
        <div class="row">
            <div class="col">
            <p style="text-align: left">ลงวันที่</p>
            </div>
            <div class="col-md-3">
            <input  name = "BOOK_DATE"  id="BOOK_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
            <div class="col-md-3">
            <p style="text-align: left">วันที่บันทึก</p>
            </div>
            <div class="col-md-3">
            <input  name = ""  id="" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">วันหมดอายุ</p>
            </div>
            <div class="col-md-3">
            <input  name = "BOOK_DATE_EXPIRE"  id="BOOK_DATE_EXPIRE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
            <div class="col-md-3">
            <p style="text-align: left">ลงวันส่ง</p>
            </div>
            <div class="col-md-3">
            <input  name = "DATE_SAVE"  id="DATE_SAVE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-3">
            <p style="text-align: left">เลขที่หนังสือ</p>
            </div>
            <div class="col-md-9">
            <input  name = "BOOK_NUMBER"  id="BOOK_NUMBER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            </div>
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">ประเภทหนังสือ</p>
            </div>
            <div class="col-md-9">
            <select name="BOOK_TYPE_ID" id="BOOK_TYPE_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onchange="checkdatebegin();checkdateend();checkall();">
                        @foreach ($booktypes as $booktype) 
                          
                            <option value="{{ $booktype ->BOOK_TYPE_ID  }}">{{ $booktype->BOOK_TYPE_NAME }}</option>
                               
                        @endforeach 
                </select>
            </div>
          
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">ชื่อเรื่อง</p>
            </div>
            <div class="col-md-9">
            <input  name = "BOOK_NAME"  id="BOOK_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            </div>
          
        </div>
       
      
    
        <div class="row">
            <div class="col">
            <p style="text-align: left">ส่งไปยังหน่วยงาน</p>
            </div>
            <div class="col-md-9">
            <select name="BOOK_ORG_TO_ID" id="BOOK_ORG_TO_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkdatebegin();checkdateend();checkall();">
                        @foreach ($bookorgs as $bookorg) 
                          
                            <option value="{{ $bookorg ->RECORD_ORG_ID  }}">{{ $bookorg->RECORD_ORG_NAME }}</option>
                               
                        @endforeach 
                </select>
            </div>
            
           
        </div>
        <br>
        <div class="row">
            <div class="col">
            <p style="text-align: left">ผู้บันทึก</p>
            </div>
            <div class="col-md-9" style="text-align: left">
            {{ $infobooksave -> HR_PREFIX_NAME }}   {{ $infobooksave -> HR_FNAME }}  {{ $infobooksave -> HR_LNAME }}

            <input type="hidden"  name = "PERSON_SAVE_ID"  id="PERSON_SAVE_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{ $id_user }}">
            </div>
           
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">รายละเอียด</p>
            </div>
            <div class="col-md-9">
            <textarea  name = "BOOK_DETAIL"  id="BOOK_DETAIL" rows="3" cols="50" class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;"></textarea>
            
            </div>
           
           
        </div>


   </div>
  
   


</div>
<br>
<div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="{{ url('manager_book/bookout')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

</form>



 
@endsection

@section('footer')

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
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
  
</script>
@endsection