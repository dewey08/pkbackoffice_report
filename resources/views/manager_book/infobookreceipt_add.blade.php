@extends('layouts.book')
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
     

        use App\Http\Controllers\ManagerbookController;
        $checkmanagerbooksecret = ManagerbookController::checkmanagerbooksecret($id_user);

?>
<?php


     $yearbudget = date("Y")+543;
     
     $yearnow = date("Y")+543;
     $monthnow = date("m");
     $datenow1 = date("d");
     $timenow = date(" H:i:s");
 
     $datenow = $datenow1.'/'.$monthnow.'/'.$yearnow.' '.$timenow;

?>

<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ออกเลขทะเบียนหนังสือรับ</B></h3>

</div>
<form  method="post"  action="{{ route('mbook.infobookreceiptsave') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
    @csrf

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
<div style='overflow:scroll; width:auto;height:900px;  background-color: #404040;' id="pages"></div>

   </div>
   

   <div class="col-md-5">
   <div class="row">
   <div class="col">
   <h5 style=" font-family: 'Kanit', sans-serif;text-align: left;">รายละเอียด</h5>
   </div>
   <div class="col">
   วันที่บันทึกรับ  {{$datenow}}
   </div>
   </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">เลขรับ</p>
            </div>
            <div class="col-md-3 max_re" >
            <input  name = "BOOK_NUM_IN"  id="BOOK_NUM_IN" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$maxnumberuse}}" required readonly>
            </div>
            <div class="col-md-3">
            <p style="text-align: left">ปี พ.ศ.</p>
            </div>
            <div class="col-md-3">
            <select name="BOOK_YEAR_ID" id="BOOK_YEAR_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onchange="checkmax();">
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
            <p style="text-align: left">ชั้นความเร็ว</p>
            </div>
            <div class="col-md-3">
            <select name="BOOK_URGENT_ID" id="BOOK_URGENT_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                        @foreach ($bookinstants as $bookinstant) 
                          
                            <option value="{{ $bookinstant ->INSTANT_ID  }}">{{ $bookinstant->INSTANT_NAME }}</option>
                               
                        @endforeach 
                </select>
            </div>
            <div class="col-md-3">
            <p style="text-align: left">ชั้นความลับ</p>
            </div>
            <div class="col-md-3">
            <select name="BOOK_SECRET_ID" id="BOOK_SECRET_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            @if($checkmanagerbooksecret != 0)    
                       
                        @foreach ($booksecrets as $booksecret) 
                          
                            <option value="{{ $booksecret ->BOOK_SECRET_ID  }}">{{ $booksecret->BOOK_SECRET_NAME }}</option>
                               
                        @endforeach 
            @else
                            <option value="1">ปกติ</option>
            @endif
                </select>
            </div>
        </div>
       
        <div class="row">
            <div class="col">
            <p style="text-align: left">ลงวันที่</p>
            </div>
            <div class="col-md-3">
            <input  name = "BOOK_DATE"  id="BOOK_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly required>
            </div>
            <div class="col-md-3">
            <p style="text-align: left">วันหมดอายุ</p>
            </div>
            <div class="col-md-3">
            <input  name = "BOOK_DATE_EXPIRE"  id="BOOK_DATE_EXPIRE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly required>
            </div>
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">ลงวันรับเข้า</p>
            </div>
            <div class="col-md-3">
            <input  name = "DATE_SAVE"  id="DATE_SAVE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly required >
            </div>
            <div class="col-md-3">
            <p style="text-align: left">เวลารับ</p>
            </div>
            <div class="col-md-3">
            <input  name = "TIME_SAVE"  id="TIME_SAVE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{date('H:i')}}" required>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-3">
            <p style="text-align: left">เลขที่หนังสือ</p>
            </div>
            <div class="col-md-9">
            <input  name = "BOOK_NUMBER"  id="BOOK_NUMBER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">ประเภทหนังสือ</p>
            </div>
            <div class="col-md-9">
            <select name="BOOK_TYPE_ID" id="BOOK_TYPE_ID" class="form-control input-sm js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
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
            <input  name = "BOOK_NAME"  id="BOOK_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" required>
            </div>
          
        </div>
    
        <div class="row">
            <div class="col">
                <p style="text-align: left">จากหน่วยงาน</p>
                </div>
                <div class="col-md-9">
            
            <select name="BOOK_ORG_ID" id="BOOK_ORG_ID" class="form-control input-lg js-example-basic-single org_re" style=" font-family: 'Kanit', sans-serif;" required>
            <option value="" selected>--กรุณาเลือกหน่วยงาน--</option>
                            @foreach ($bookorgs as $bookorg)   
                                <option value="{{ $bookorg -> RECORD_ORG_ID}}">{{ $bookorg->RECORD_ORG_NAME }}</option>          
                            @endforeach 
            </select> 
           </div>
           </div>
        <div class="row">
            <div class="col">
            &nbsp;&nbsp;
            </div>
          
            <div class="col-md-7">
           <input name="ADD_RECORD_ORG" id="ADD_RECORD_ORG" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="ระบุหน่วยงานหากต้องการเพิ่ม">
           </div> 
            <div class="col-md-2">
            <a class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="if(confirm('ต้องการที่จะเพิ่มข้อมูลหน่วยงาน ?')) addorg();" > เพิ่ม</a>
            </div> 
        </div>
        <br>
        <div class="row">
            <div class="col">
            <p style="text-align: left">1)อ้างถึงหนังสือเลขที่</p>
            </div>
            <div class="col-md-9">
            <input  name = "BOOK_REFER_NUM_1"  id="BOOK_REFER_NUM_1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            </div>
          
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">ลงวันที่</p>
            </div>
            <div class="col-md-9">
            <input  name = "BOOK_REFER_DATE_1"  id="BOOK_REFER_DATE_1" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
          
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">เรื่อง</p>
            </div>
            <div class="col-md-9">
            <input  name = "BOOK_REFER_NAME_1"  id="BOOK_REFER_NAME_1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            </div>
          
        </div>
        <br>
        <div class="row">
            <div class="col">
            <p style="text-align: left">2)อ้างถึงหนังสือเลขที่</p>
            </div>
            <div class="col-md-9">
            <input  name = "BOOK_REFER_NUM_2"  id="BOOK_REFER_NUM_2" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            </div>
          
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">ลงวันที่</p>
            </div>
            <div class="col-md-9">
            <input  name = "BOOK_REFER_DATE_2"  id="BOOK_REFER_DATE_2" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
          
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left">เรื่อง</p>
            </div>
            <div class="col-md-9">
            <input  name = "BOOK_REFER_NAME_2"  id="BOOK_REFER_NAME_2" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
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
        <div class="row">
            <div class="col">
            <p style="text-align: left">แนบไฟล์เพิ่ม</p>
            </div>
            <div class="col-md-9">
            <input style="font-family: 'Kanit', sans-serif;" type="file" name="fileupload" id="fileupload" class="form-control">
           
            </div>

       
           
        </div>

        <div class="row">
            <div class="col">
            <p style="text-align: left">ลิงก์ที่เกี่ยวข้อง</p>
            </div>
            <div class="col-md-9">
                <input name="BOOK_LINK" id="BOOK_LINK" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
            </div>

          
           
        </div>
        




   </div>
  
   


</div>
<br>
<div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="{{ url('manager_book/bookreceipt')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        
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