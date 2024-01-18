@extends('layouts.person')
    
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

      .form-control{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      }   

      input::-webkit-calendar-picker-indicator{ 
  
    font-family: 'Kanit', sans-serif;
            font-size: 14px;
         
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
<?php

  use App\Http\Controllers\PerdevController;
    $refnumber = PerdevController::refnuminside();
     $datenow = date('Y-m-d');


?>  
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            }

                .table-fixed tbody {
        height: 300px;
        overflow-y: auto;
        width: 100%;
    }
</style>

<center>

 <center>
            
         <div style="width:95%;" >
   <div class="block block-rounded block-bordered">
   <div class="block-content">    
   <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
    
    
     <div class="row">
             <div class="col-md-10" align="left">
                แจ้งยกเลิกประชุมภายใน
                     </div>
             <div class="col-md-2">
                
             </div>
         </div>
             </h2>   
                                     
        <form  method="post" action="{{ route('mperson.inforperson_meetinginside_updatecancel') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="iduser" id="iduser" value="{{ $id_user }}">
        <input type="hidden" name="MEETING_INSIDE_ID" id="MEETING_INSIDE_ID" value="{{$meetinginsides->MEETING_INSIDE_ID}}">

        <div class="row push">
        <div class="col-sm-2 text-right">
        <label>รหัสประชุม :</label>
        </div> 
        <div class="col-lg-2 text-left"> 
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->MEETING_INSIDE_CODE}}</h1>                
        </div> 
        <div class="col-sm-1 text-right">
            <label>ครั้งที่ :</label>
            </div> 
        <div class="col-lg-1 text-left">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->MEETING_INSIDE_NO}}</h1>
        </div> 
        <div class="col-sm-0.5 text-right">
            <label>ปีงบ :</label>
            </div> 
        <div class="col-lg-2 text-left">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->ROOM_NAME}}</h1>
           
        </div> 
        <div class="col-sm-1 text-right">
            <label>วันที่ประชุม :</label>
        </div> 
        <div class="col-lg-2 text-left">
          
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{formate($meetinginsides->MEETING_INSIDE_DATE)}}</h1>
        </div> 
        </div>
       
        <div class="row push">
            <div class="col-sm-2 text-right">
                <label>ห้องประชุม :</label>
            </div> 
            <div class="col-lg-4 text-left">
              
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->ROOM_NAME}}</h1>
        </div> 
        <div class="col-sm-0.5 text-right">
        <label>เวลา :</label>
       
        </div>
        <div class="col-lg-2 text-left">
            
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->MEETING_INSIDE_STARTTIME}}</h1>
        </div> 
        <div class="col-sm-1 text-right">
            <label>ถึง :</label>
            </div> 
            <div class="col-lg-2 text-left">
  
                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->MEETING_INSIDE_ENDTIME}}</h1>
        </div> 
       </div>

       <div class="row push">
       
        <div class="col-sm-2 text-right">
            <div class="form-group">
            <label >หัวข้อประชุม :</label>
            </div>                               
        </div> 
        <div class="col-sm-10 text-left">
            <div class="form-group" >
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->MEETING_INSIDE_TITLE}}</h1>
            </div>                               
        </div>
     
       
        </div>

      
        
        <div class="row">
        <div class="col-sm-2 text-right">
            <div class="form-group">
            <label>ประเภทการประชุม :</label>
            </div>                               
        </div>  
        <div class="col-sm-4 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $meetinginsides -> MEETTINGSIDE_NAME }}</h1>
            </div>                               
        </div>  
      


       <div class="col-sm-0.5 text-right">
        <div class="form-group">
        <label>วันที่ :</label>
        </div>
    </div>
    <div class="col-sm-2 text-left">
        <div class="form-group">
        <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($meetinginsides -> MEETING_INSIDE_DATE) }}</h2>
        </div>
    </div>
    <div class="col-sm-1 text-right">
       <div class="form-group">
       <label>ตั้งแต่เวลา :</label>
       </div>
   </div>
   <div class="col-sm-2 text-left">
       <div class="form-group">
       <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ formatetime($meetinginsides -> MEETING_INSIDE_STARTTIME) }} ถึง {{ formatetime($meetinginsides -> MEETING_INSIDE_ENDTIME) }}</h2>
       </div>
   </div>                                            
   </div>
     
       
       <div class="row">
                                      
        <div class="col-sm-2 text-right">
            <div class="form-group">
            <label >ประธาน :</label>
            </div>
        </div>
        <div class="col-sm-4 text-left">
            <div class="form-group" >
            <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->HR_FNAME}}&nbsp;&nbsp; {{$meetinginsides->HR_LNAME}}</h2>
            </div>
        </div>
 
        <div class="col-sm-0.5 ">
            <div class="form-group">
            <label >ผู้บันทึก :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h2 style="font-family: 'Kanit', sans-serif; font-size:9px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$meetinginsides->MEETING_INSIDE_USERSAVE_NAME}}</h2>
            </div>
        </div> 
        </div>
   
    
      <label style="float:left;">หมายเหตุ</label>
      <textarea   name = "MEETING_INSIDE_COMMENT"  id="MEETING_INSIDE_COMMENT" class="form-control input-lg" ></textarea>
        <hr>

                <div align="right">
                  
                    <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save"></i> &nbsp; บันทึกข้อมูล&nbsp;&nbsp; </button>
                    <a href="{{url('manager_person/inforperson_meetinginside')}}" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" onclick="return confirm('ต้องการที่จะยกเลิกการยกเลิกประชุมภายใน ?')" ><i class="fas fa-window-close"></i> &nbsp; ยกเลิก&nbsp;&nbsp; </a>
                
                </div>    
            </div>         
        </div>
               
</form>


            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style=" font-family: 'Kanit', sans-serif;">ประเภทการประชุม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('perdev.personmeetinginside_type') }}" method="post">           
                            @csrf
                        <input type="hidden" name="ID_USER" id="ID_USER" value="{{ $id_user }}">
                        <div class="form-group row">
                            <label for="MEETTINGSIDE_NAME" class="col-sm-2 col-form-label">ประเภทการประชุม</label>
                            <div class="col-sm-10">
                            <input class="form-control input-lg" id="MEETTINGSIDE_NAME" name="MEETTINGSIDE_NAME" style=" font-family: 'Kanit', sans-serif;">
                            
                            </div>
                        </div>
                    
                    
                    </div>
                    <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save mr-2"></i>บันทึก&nbsp;&nbsp; </button>
                    <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal"><i class="fas fa-window-close mr-2"></i>ปิด &nbsp;&nbsp;</button>
                    </div>
                </div>
                </form>
                </div>
            </div>


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
    $("select").select2();
});

function addtype(){
      
      var record_type=document.getElementById("ADD_RECORD_TYPE").value;
    
      //alert(record_location);
      
          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.addtype')}}",
                   method:"GET",
                   data:{record_type:record_type,_token:_token},
                   success:function(result){
                      $('.addtype').html(result);
                   }
           })

  }



$(document).ready(function () {

var i = 1;
$('#add').click(function(){
    i++;
    $('dynamic_fileld').append('<tr id="row'+i+'"><td> <input name="name[]" id="name[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" ></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
});
$(document).on('click','.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('row'+button_id+'').remove();
});

});

$(document).ready(function () {
    
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true,
        autoclose: true                    //Set เป็นปี พ.ศ.
    });  //กำหนดเป็นวันปัจุบัน
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

//===============================เพิ่มสถานที่====================================
function addlocation(){

var record_location=document.getElementById("ADD_RECORD_LOCATION").value;

//alert(record_location);

var _token=$('input[name="_token"]').val();
$.ajax({
        url:"{{route('perdev.addlocation')}}",
        method:"GET",
        data:{record_location:record_location,_token:_token},
        success:function(result){
            $('.location_re').html(result);
        }
})

}

    
    $('.addRow1').on('click',function(){
             addRow1();
         });
    
         function addRow1(){
            var count = $('.tbody1').children('tr').length;
                var tr = '<tr>'+
                    '<td style="text-align: center;">'+
                        (count+1)+
                    '</td>'+
                        '<td>'+ 
                        '<select name="MEETING_INSIDE_USER[]" id="MEETING_INSIDE_USER[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                        '<option value="">--กรุณาเลือก--</option>'+
                        '@foreach ($infopresidents as $infopresident)'+
                        '<option value="{{ $infopresident->ID  }}">{{ $infopresident->HR_FNAME}}&nbsp;&nbsp;  {{ $infopresident->HR_LNAME}}</option>'+
                        '@endforeach'+      
                        '</select>'+
                        '</td>'+ 
                        '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove1" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
            $('.tbody1').append(tr);
         };
         $('.tbody1').on('click','.remove1', function(){
                $(this).parent().parent().remove();       
    });
    //==================================================================================
    $('.addRow2').on('click',function(){
             addRow2();
         });
    
         function addRow2(){
            var count = $('.tbody2').children('tr').length;
                var tr = '<tr>'+
                    '<td style="text-align: center;">'+
                        (count+1)+
                    '</td>'+
                        '<td>'+ 
                        '<input name="MEETING_INSIDE_USEROUT[]" id="MEETING_INSIDE_USEROUT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;">'+                   
                        '</td>'+ 
                        '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
            $('.tbody2').append(tr);
         };
         $('.tbody2').on('click','.remove2', function(){
                $(this).parent().parent().remove();       
    });
    //==================================================================================
    $('.addRow3').on('click',function(){
             addRow3();
         });
    
         function addRow3(){
            var count = $('.tbody3').children('tr').length;
                var tr = '<tr>'+
                        '<td style="text-align: center;">'+
                            (count+1)+
                        '</td>'+
                        '<td>'+ 
                        '<input name="MEETING_INSIDE_PERFORMANCE[]" id="MEETING_INSIDE_PERFORMANCE[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;">'+                   
                        '</td>'+ 
                        '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
            $('.tbody3').append(tr);
         };
         $('.tbody3').on('click','.remove3', function(){
                $(this).parent().parent().remove();       
    });
    //==================================================================================
    $('.addRow4').on('click',function(){
             addRow4();
         });
    
         function addRow4(){
            var count = $('.tbody4').children('tr').length;
                var tr = '<tr>'+
                        '<td style="text-align: center;">'+
                            (count+1)+
                        '</td>'+
                        '<td>'+ 
                        '<input name="MEETING_INSIDE_PROFESSION[]" id="MEETING_INSIDE_PROFESSION[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;">'+                   
                        '</td>'+ 
                        '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove4" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
            $('.tbody4').append(tr);
         };
         $('.tbody4').on('click','.remove4', function(){
                $(this).parent().parent().remove();       
    });
    </script>
    <script>
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