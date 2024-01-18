@extends('layouts.leave')
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
            font-size: 14px;
           
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
    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แนบใบรับรองแพทย์</B></h3>

</div>
<form  method="post" id="form_add" action="{{ route('mleave.certificate_save') }}"  enctype="multipart/form-data" >      
    @csrf
    <input type="hidden" name="PERSON_ID" id="PERSON_ID" value="{{$detailleave->LEAVE_PERSON_ID}}">
    <input type="hidden" name="ID" id="ID" value="{{$detailleave->ID}}">


<div class="block-content block-content-full">
    <div class="row">

        
    <div class="col-md-6" style="text-align: center"> 
      
        <input type="file" id="pdfupload" name="pdfupload" accept="application/pdf" style="width:75%;"/>
        <div style='overflow:auto; width:auto;height:900px; background-color: #404040;' id="pages">   
            <iframe src="{{ asset('storage/leavepdf/certificate_'.$detailleave->ID.'.pdf') }}" height="100%" width="100%"></iframe>
            
   
            
        </div>



    </div>


        <div class="col-md-6" style="text-align: center">
  

        <div class="col">
            <div class="row">
       
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >ปีงบประมาณ :</label>
                    </div>                               
                </div> 
                <div class="col-sm-3 text-left">
                    <div class="form-group" >
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_YEAR_ID }}</h1>
                    </div>                               
                </div>
                
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >ชื่อผู้ลา  :</label>
                    </div>                               
                </div>  
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_PERSON_FULLNAME }}</h1>
                    </div>                               
                </div>  
               
                </div>
         
                <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >เหตุผลการลา :</label>
                    </div>                               
                </div>  
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_BECAUSE }}</h1>
                    </div>                               
                </div>    
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >สถานที่ไป :</label>
                    </div>                               
                </div>  
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LOCATION_NAME }} </h1>
                    </div>                               
                </div>
                </div>
         
                
                <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                    <label>มอบหมายงาน :</label>
                    </div>                               
                </div>  
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LEAVE_WORK_SEND}}</h1>
                    </div>                               
                </div>  
                <div class="col-sm-2">
                    <div class="form-group">
                    <label>ลาเต็มวัน/ครึ่งวัน :</label>
                    </div>                               
                </div>  
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
                    @if($inforleave -> DAY_TYPE_ID == 3)
                    ครึ่งวัน(บ่าย)
                    @elseif($inforleave -> DAY_TYPE_ID == 2)
                    ครึ่งวัน(เช้า)
                    @else
                    เติมวัน
                    @endif   
                    
                    </h1>
                    </div>                               
                </div>    
               </div>
             
               
              
                <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >วันเริ่มลา :</label>
                    </div>                               
                </div>
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforleave -> LEAVE_DATE_BEGIN) }}</h1>
                    </div>                               
                </div> 
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >สิ้นสุดวันลา :</label>
                    </div>                               
                </div>
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforleave -> LEAVE_DATE_END) }}</h1>
                    </div>                               
                </div>   
          
                </div>
              
                <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                    <label > เบอร์ติดต่อ :</label>
                    </div>                               
                </div>
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_CONTACT_PHONE }}</h1>
                    </div>                               
                </div> 
                <div class="col-sm-2">
                    <div class="form-group">
                    <label > ระหว่างลาติดต่อ :</label>
                    </div>                               
                </div>
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_CONTACT }}</h1>
                    </div>                               
                </div> 
         
                </div>
         
                <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >รวมวันลา :</label>
                    </div>                               
                </div>
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_ALL,1) }} วัน</h1>
                    
                    </div>                               
                </div> 
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >วันทำการ :</label>
                    </div>                               
                </div>
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> WORK_DO,1) }} วัน</h1>
                    </div>                               
                </div>   
          
                </div>
         
                <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >วันหยุดเสาร์ - อาทิตย์ :</label>
                    </div>                               
                </div>
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_HOLIDAY) }} วัน</h1>
                    </div>                               
                </div> 
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >วันหยุดนักขัตฤกษ์ :</label>
                    </div>                               
                </div>
                <div class="col-sm-3 text-left">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_SETSUN) }} วัน</h1>
                    </div>                               
                </div>   
          
                </div>
         
                <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                    <label >หมายเหตุ :</label>
                    </div>                               
                </div>
                <div class="col-sm-10">
                    <div class="form-group">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LEAVE_COMMENT_BY}}</h1>
                    </div>                               
                </div> 
              
          
                </div>
         
        </div>

   
        </div>




</div>    
</div>
<br>
<div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <a href="{{ url('manager_leave/personleaveinfocheckver')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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

    
$('.btn-submit-add').click(function (e) { 

var form = $('#form_add');
formSubmit(form)
       
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
             var select_id = document.getElementById("ID").value;

             $.ajax({
                     url:"{{route('msupplies.fetchvendor')}}",
                     method:"GET",
                      data:{select:select,select_id:select_id,_token:_token},
                     success:function(result){
                        $('.detailvendor').html(result);
                     }
             })
            // console.log(select);
             }        
     });
</script>
@endsection