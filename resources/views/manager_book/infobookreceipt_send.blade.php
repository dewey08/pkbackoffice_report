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
      
       
</style>

<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>หนังสือรับ เลขที่ {{$infobookreceiptview->BOOK_NUMBER}}</B></h3>

</div>
<form  method="post" action="{{ route('mbook.sendreceipt') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
    @csrf
  
<div class="block-content block-content-full">
<div class="row">
   <div class="col-md-7" style="text-align: left">
 
   <div style="text-align:center">


    <iframe src="http://110.49.14.230/backoffice/storage/app/public/bookpdf/{{ $infobookreceiptview->BOOK_NUM_IN }}.pdf" height="100%" width="100%"></iframe>

</div>

   </div>
   

   <div class="col-md-5">

     
          
     
        <div class="row">
            <div class="col">
            <p style="text-align: left"><b>ชื่อเรื่อง</b></p>
            </div>
            <div class="col-md-9" style="text-align: left">
            {{$infobookreceiptview->BOOK_NAME}}
            </div>
          
        </div>
       
      
    
        <div class="row">
            <div class="col">
            <p style="text-align: left"><b>จากหน่วยงาน</b></p>
            </div>
            <div class="col-md-9" style="text-align: left">
            <p style="text-align: left">{{$infobookreceiptview->RECORD_ORG_NAME}}
            </div>
            
           
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left"><b>ผู้บันทึก</b></p>
            </div>
            <div class="col-md-9" style="text-align: left"> 
            {{ $infobookreceiptview -> HR_PREFIX_NAME }}   {{ $infobookreceiptview -> HR_FNAME }}  {{ $infobookreceiptview -> HR_LNAME }}
            </div>
           
        </div>
        <div class="row">
            <div class="col">
            <p style="text-align: left"><b>รายละเอียด</b></p>
            </div>
            <div class="col-md-9" style="text-align: left">
            {{$infobookreceiptview->BOOK_DETAIL}}
            
            </div>
           
           
        </div>

        <div class="row" >

        
                                    <div class="block block-rounded block-bordered" style="width:100%;">
                                 <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #B0C4DE;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ส่งกลุ่มงาน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ส่งหน่วยงาน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ส่งบุคคล</a>
                                    </li>      
                                                  
                          
                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                    
                                    <div style='overflow:scroll; height:500px;'>
                                    <table class="js-table-checkable table table-hover table-vcenter" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 70px;">
                                            <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                                <input type="checkbox" class="custom-control-input" id="check-all" name="check-all">
                                                <label class="custom-control-label" for="check-all"></label>
                                            </div>
                                        </th>
                                        <th>กลุ่มงาน</th>
                                   
                                    </tr>
                                </thead>
                               
                                <tbody>
                          
                                @foreach ($bookdepartments as $bookdepartment)
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                                <input type="checkbox" class="custom-control-input" id="row1[]" name="row1[]" value="{{ $bookdepartment-> HR_DEPARTMENT_ID }}">
                                                <label class="custom-control-label" for="row1[]"></label>
                                            </div>
                                        </td>
                                        <td>
                                        {{ $bookdepartment-> HR_DEPARTMENT_NAME }}
                                        </td>
                                   
                                    </tr>
                                @endforeach 
                                </tbody>
                           
                            </table>
                            </div>
                                <input type="hidden"  name="BOOK_ID" id="BOOK_ID" value="{{$infobookreceiptview->BOOK_ID}}">

                                    </div>
                                    <div class="tab-pane" id="object2" role="tabpanel">

                                    <div style='overflow:scroll; height:500px;'>
                                    <table class="js-table-checkable table table-hover table-vcenter" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 70px;">
                                            <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                                <input type="checkbox" class="custom-control-input" id="check-all2" name="check-all2">
                                                <label class="custom-control-label" for="check-all2"></label>
                                            </div>
                                        </th>
                                        <th>หน่วยงาน</th>
                                   
                                    </tr>
                                </thead>
                               
                                <tbody>
                          
                                @foreach ($bookdepartmentsubsubs as $bookdepartmentsubsub)
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox custom-control-primary d-inline-block">
                                                <input type="checkbox" class="custom-control-input" id="row2[]" name="row2[]">
                                                <label class="custom-control-label" for="row2[]"></label>
                                            </div>
                                        </td>
                                        <td>
                                        {{ $bookdepartmentsubsub-> HR_DEPARTMENT_SUB_SUB_NAME }}
                                        </td>
                                   
                                    </tr>
                                @endforeach 
                                </tbody>
                           
                            </table>
                            </div>
                            </div>  

                                  
                                
                              
                                    <div class="tab-pane" id="object3" role="tabpanel">
                                  
                                     test...

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
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >ส่งต่อ</button>
        <a href="{{ url('manager_book/bookreceipt')  }}" class="btn btn-hero-sm btn-hero-danger"  >ยกเลิก</a>
        </div>

</form>



 
@endsection

@section('footer')

<script>jQuery(function(){ Dashmix.helpers(['table-tools-checkable', 'table-tools-sections']); });</script>


<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script type="text/javascript">
    PDFJS.workerSrc = "{{ asset('pdfupload/pdf_upwork.js') }}";
</script>

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
// URL of PDF document
var url = "http://mozilla.github.io/pdf.js/examples/learning/helloworld.pdf";

// Asynchronous download PDF
PDFJS.getDocument(url)
  .then(function(pdf) {
    return pdf.getPage(1);
  })
  .then(function(page) {
    // Set scale (zoom) level
    var scale = 1.5;

    // Get viewport (dimensions)
    var viewport = page.getViewport(scale);

    // Get canvas#the-canvas
    var canvas = document.getElementById('the-canvas');

    // Fetch canvas' 2d context
    var context = canvas.getContext('2d');

    // Set dimensions to Canvas
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Prepare object needed by render method
    var renderContext = {
      canvasContext: context,
      viewport: viewport
    };

    // Render PDF page
    page.render(renderContext);
  });
</script>
@endsection