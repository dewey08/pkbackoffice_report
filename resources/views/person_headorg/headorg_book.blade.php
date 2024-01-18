@extends('layouts.headorg')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')
<script>
  function checklogin() {
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
  date_default_timezone_set("Asia/Bangkok");
   $date = date('Y-m-d');
?>

<style>
  body {
    font-family: 'Kanit', sans-serif;
    font-size: 15px;

  }

  .text-pedding {
    padding-left: 10px;
  }

  .text-font {
    font-size: 13px;
  }

  .form-control {
    font-size: 13px;
  }

  table,
  td,
  th {
    border: 1px solid black;
  }
</style>

<br>
<br>
<center>
  <!-- Dynamic Table Simple -->
  <div class="block" style="width: 95%;">
    <div class="block-header block-header-default">
      <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนหนังสือรอลงนาม</B></h3>
    </div>
    <div class="block-content block-content-full">

      <form action="{{ route('horg.infobooksearch') }}" method="post">
        @csrf
        <div class="row">
          <div class="col-sm-0.5">
            &nbsp;&nbsp; ปี พ.ศ &nbsp;
          </div>
          <div class="col-sm-1.5">
            <span>
              <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg budget"
                style=" font-family: 'Kanit', sans-serif;">
                @foreach ($budgets as $budget)
                @if($budget->LEAVE_YEAR_ID== $year_id)
                <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                @else
                <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                @endif
                @endforeach
              </select>
            </span>
          </div>
          <div class="col-sm-4 date_budget">
            <div class="row">
              <div class="col-sm">
                วันที่
              </div>
              <div class="col-md-4">
                <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                  data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}" readonly>
              </div>
              <div class="col-sm">
                ถึง
              </div>
              <div class="col-md-4">
                <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                  data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>
              </div>
            </div>
          </div>
          <div class="col-md-0.5">
            &nbsp;สถานะ &nbsp;
          </div>
          <div class="col-md-2">
            <span>
              <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg"
                style=" font-family: 'Kanit', sans-serif;">
                <option value="">--ทั้งหมด--</option>
                @foreach ($infobook_sendstatuss as $infobook_sendstatus)
                @if($infobook_sendstatus->BOOK_STATUS_ID == $status_check)
                <option value="{{ $infobook_sendstatus->BOOK_STATUS_ID  }}" selected>
                  {{ $infobook_sendstatus->BOOK_STATUS_NAME}}</option>
                @else
                <option value="{{ $infobook_sendstatus->BOOK_STATUS_ID  }}">{{ $infobook_sendstatus->BOOK_STATUS_NAME}}
                </option>
                @endif
                @endforeach
              </select>
            </span>
          </div>
          <div class="col-md-0.5">
            &nbsp;ค้นหา &nbsp;
          </div>
          <div class="col-md-2">
            <span>
              <input type="search" name="search" class="form-control"
                style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
            </span>
          </div>
          <div class="col-md-30">
            &nbsp;
          </div>
          <div class="col-md-1">
            <span>
              <button type="submit" class="btn btn-info"
                style="font-family: 'Kanit', sans-serif;font-weight:normal;">ค้นหา</button>
            </span>
          </div>
        </div>
      </form>

      <div class="row">
        <div class="col-md-4">
          ชั้นความเร็ว ::
          <p class="fa fa-circle" style="color:#008000;"></p> ปกติ
          <p class="fa fa-circle" style="color:#87CEFA;"></p> ด่วน
          <p class="fa fa-circle" style="color:#FFA500;"></p> ด่วนมาก
          <p class="fa fa-circle" style="color:#FF4500;"></p> ด่วนที่สุด
        </div>
      </div>

      <!-- Block Tabs Default Style -->
      <div class="block block-rounded block-bordered">
        <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
          <li class="nav-item">
            <a class="nav-link active" href="#object1"
              style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">หนังสือรับ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#object2"
              style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">หนังสือส่ง</a>
          </li>
        </ul>

        <div class="block-content tab-content">
          <div class="tab-pane active" id="object1" role="tabpanel">
            <div class="table-responsive" style="height:500px;">
              <B>หนังสือรับ</B>
            
              <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                <thead style="background-color: #FFEBCD;">
                  <tr height="40">
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                      width="5%">ลำดับ</th>

                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                      width="5%">File</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                      width="5%">ชั้นความเร็ว</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                      width="8%">สถานะ</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                      width="7%">เลขรับ</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                      width="8%">เลขหนังสือ</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                      ชื่อเรื่อง</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                      รายละเอียด</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                      ความเห็น ผอ.</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                      width="7%">วันที่รับ</th>
                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                      width="12%">คำสั่ง</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $number = 0; ?>
                  @foreach ($infobookreceipts as $infobookreceipt)
                  <?php $number++;  ?>
                  <tr height="40">
                    <td class="text-font" align="center">{{$number}}</td>
                    @if($infobookreceipt->BOOK_HAVE_FILE == 'True')
                    <?php $bookpdf = storage_path('app/public/bookpdf/'.$infobookreceipt->BOOK_FILE_NAME) ; ?>
                    @if(file_exists($bookpdf))
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn"
                        style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span>
                    </td>
                    @else
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn"
                        style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span>
                    </td>
                    @endif
                    @else
                    <td align="center"></td>
                    @endif

                    @if($infobookreceipt->BOOK_URGENT_ID == 1)
                    <td class="text-font" align="center"><span class="fa fa-2x fa-circle" style="color:#008000;"></span>
                    </td>
                    @elseif($infobookreceipt->BOOK_URGENT_ID == 2)
                    <td class="text-font" align="center"><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span>
                    </td>
                    @elseif($infobookreceipt->BOOK_URGENT_ID == 3)
                    <td class="text-font" align="center"><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span>
                    </td>
                    @elseif($infobookreceipt->BOOK_URGENT_ID == 4)
                    <td class="text-font" align="center"><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span>
                    </td>

                    @endif

                    @if($infobookreceipt->SEND_STATUS == '1')
                    <td align="center"><span class="badge badge-danger">ลงรับ</span></td>
                    @elseif($infobookreceipt->SEND_STATUS == '2')
                    <td align="center"><span class="badge badge-warning">นำเสนอ</span></td>
                    @elseif($infobookreceipt->SEND_STATUS == '3')
                    <td align="center"><span class="badge badge-success">ผอ.ลงนาม</span></td>
                    @elseif($infobookreceipt->SEND_STATUS == '4')
                    <td align="center"><span class="badge badge-info">เสนอ ผอ.</span></td>
                    @else
                    <td class="text-font" align="center"></td>
                    @endif

                    <td class="text-font" align="center">{{ $infobookreceipt->BOOK_NUM_IN}}</td>
                    <td class="text-font text-pedding">{{ $infobookreceipt->BOOK_NUMBER}}</td>

                    @if($infobookreceipt->BOOK_SECRET_ID == 2)
                    <td class="text-font text-pedding" style="color: red;">ลับ :: {{ $infobookreceipt->BOOK_NAME}}</td>
                    @elseif($infobookreceipt->BOOK_SECRET_ID == 3)
                    <td class="text-font text-pedding" style="color: red;">ลับมาก :: {{ $infobookreceipt->BOOK_NAME}}
                    </td>
                    @elseif($infobookreceipt->BOOK_SECRET_ID == 4)
                    <td class="text-font text-pedding" style="color: red;">ลับที่สุด :: {{ $infobookreceipt->BOOK_NAME}}
                    </td>
                    @else
                    <td class="text-font text-pedding"> {{ $infobookreceipt->BOOK_NAME}}</td>
                    @endif
                    <td class="text-font text-pedding">{{ $infobookreceipt->BOOK_DETAIL}}</td>
                    <td class="text-font text-pedding">{{ $infobookreceipt->TOP_LEADER_AC_CMD}}</td>
                    <td class="text-font" align="center">{{ DateThai($infobookreceipt->DATE_SAVE)}}</td>
                    <td align="center">
                      <a href="{{ url('person_headorg/infobookreceipt/control/'.$infobookreceipt->BOOK_ID) }}"
                        class="btn btn-success"
                        style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">อ่าน/จัดการหนังสือ</a>
                    </td>
                  </tr>
                  </body>
                  @endforeach
                </tbody>
                </table>
            </div>
          </div>
          <div class="tab-pane" id="object2" role="tabpanel">
            <br><B>หนังสือส่ง </B>
            <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
              <thead style="background-color: #FFEBCD;">
                <tr height="40">
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                    ลำดับ</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                    File</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                    ชั้นความเร็ว</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                    สถานะ</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">
                    อ่าน</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">
                    เลขที่หนังสือส่ง</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ชื่อเรื่อง
                  </th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รายละเอียด
                  </th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">
                    วันที่รับ</th>
                  <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">
                    คำสั่ง</th>
                </tr>
              </thead>
              <tbody>
                <?php $number = 0; ?>
                @foreach ($inforbookinsides as $inforbookinside)
                <?php $number++; ?>
                <tr height="40">
                  <td class="text-font" align="center">{{$number}}</td>
                  @if($inforbookinside->BOOK_HAVE_FILE == 'True')
                  <?php $bookpdf = storage_path('app/public/bookpdf/'.$inforbookinside->BOOK_FILE_NAME) ; ?>
                  @if(file_exists($bookpdf))
                  <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn"
                      style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                  @else
                  <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn"
                      style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                  @endif
                  @else
                  <td align="center"></td>
                  @endif
                  @if($inforbookinside->BOOK_URGENT_ID == 1)
                  <td class="text-font" align="center"><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td>
                  @elseif($inforbookinside->BOOK_URGENT_ID == 2)
                  <td class="text-font" align="center"><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                  @elseif($inforbookinside->BOOK_URGENT_ID == 3)
                  <td class="text-font" align="center"><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>
                  @elseif($inforbookinside->BOOK_URGENT_ID == 4)
                  <td class="text-font" align="center"><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>
                  @endif
                  @if($inforbookinside->SEND_STATUS == '1')
                  <td align="center"><span class="badge badge-danger">ลงรับ</span></td>
                  @elseif($inforbookinside->SEND_STATUS == '2')
                  <td align="center"><span class="badge badge-warning">นำเสนอ</span></td>
                  @elseif($inforbookinside->SEND_STATUS == '3')
                  <td align="center"><span class="badge badge-success">ผอ.ลงนาม</span></td>
                  @elseif($inforbookinside->SEND_STATUS == '4')
                  <td align="center"><span class="badge badge-success">เสนอ ผอ.</span></td>
                  @else
                  <td class="text-font" align="center"></td>
                  @endif
                  @if($inforbookinside->READ_STATUS == 'True')
                  <td align="center"><span class="btn si si-book-open" style="background-color:#32CD32;color:#F0FFFF;"></span>
                  </td>
                  @else
                  <td align="center"><span class="btn si si-book-open" style="background-color:#DCDCDC;color:#F0FFFF;"></span>
                  </td>
                  @endif
                  <td class="text-font text-pedding">{{ $inforbookinside->BOOK_NUMBER}}</td>
                  <td class="text-font text-pedding">{{ $inforbookinside->BOOK_NAME}}</td>    
                  <td class="text-font text-pedding">{{ $inforbookinside->BOOK_DETAIL}}</td>
                  <td class="text-font" align="center">{{ DateThai($inforbookinside->DATE_SAVE)}}</td>
                  <td align="center">
                    <a href="{{ url('person_headorg/infobookinside/control/'.$inforbookinside->BOOK_ID) }}"
                      class="btn btn-success"
                      style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">อ่าน/จัดการหนังสือ</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</center>

  @endsection

  @section('footer')


  <script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
  <script>
    jQuery(function () {
      Dashmix.helpers(['masked-inputs']);
    });
  </script>
  <script>
    jQuery(function () {
      Dashmix.helpers(['table-tools-checkable', 'table-tools-sections']);
    });
  </script>

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

  <script>
    $(document).ready(function () {

      $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true,
        autoclose: true //Set เป็นปี พ.ศ.
      }); //กำหนดเป็นวันปัจุบัน
    });




    $('.budget').change(function () {
      if ($(this).val() != '') {
        var select = $(this).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url: "{{route('admin.selectyear')}}",
          method: "GET",
          data: {
            select: select,
            _token: _token
          },
          success: function (result) {
            $('.date_budget').html(result);
            datepick();
          }
        })
        // console.log(select);
      }
    });


    function datepick() {

      $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true,
        autoclose: true //Set เป็นปี พ.ศ.
      }); //กำหนดเป็นวันปัจุบัน
    }
    // If absolute URL from the remote server is provided, configure the CORS
    // header on that server.
    var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';

    // Loaded via <script> tag, create shortcut to access PDF.js exports.
    var pdfjsLib = window['pdfjs-dist/build/pdf'];

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

    var pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      scale = 0.8,
      canvas = document.getElementById('the-canvas'),
      ctx = canvas.getContext('2d');

    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num) {
      pageRendering = true;
      // Using promise to fetch the page
      pdfDoc.getPage(num).then(function (page) {
        var viewport = page.getViewport({
          scale: scale
        });
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        // Render PDF page into canvas context
        var renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        var renderTask = page.render(renderContext);

        // Wait for rendering to finish
        renderTask.promise.then(function () {
          pageRendering = false;
          if (pageNumPending !== null) {
            // New page rendering is pending
            renderPage(pageNumPending);
            pageNumPending = null;
          }
        });
      });

      // Update page counters
      document.getElementById('page_num').textContent = num;
    }

    /**
     * If another page rendering in progress, waits until the rendering is
     * finised. Otherwise, executes rendering immediately.
     */
    function queueRenderPage(num) {
      if (pageRendering) {
        pageNumPending = num;
      } else {
        renderPage(num);
      }
    }

    /**
     * Displays previous page.
     */
    function onPrevPage() {
      if (pageNum <= 1) {
        return;
      }
      pageNum--;
      queueRenderPage(pageNum);
    }
    document.getElementById('prev').addEventListener('click', onPrevPage);

    /**
     * Displays next page.
     */
    function onNextPage() {
      if (pageNum >= pdfDoc.numPages) {
        return;
      }
      pageNum++;
      queueRenderPage(pageNum);
    }
    document.getElementById('next').addEventListener('click', onNextPage);

    /**
     * Asynchronously downloads PDF.
     */
    pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
      pdfDoc = pdfDoc_;
      document.getElementById('page_count').textContent = pdfDoc.numPages;

      // Initial/first page rendering
      renderPage(pageNum);
    });


    //--------------------------------



    // If absolute URL from the remote server is provided, configure the CORS
    // header on that server.
    var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';

    // Loaded via <script> tag, create shortcut to access PDF.js exports.
    var pdfjsLib = window['pdfjs-dist/build/pdf'];

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

    var pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      scale = 0.8,
      canvas = document.getElementById('the-canvas'),
      ctx = canvas.getContext('2d');

    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num) {
      pageRendering = true;
      // Using promise to fetch the page
      pdfDoc.getPage(num).then(function (page) {
        var viewport = page.getViewport({
          scale: scale
        });
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        // Render PDF page into canvas context
        var renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        var renderTask = page.render(renderContext);

        // Wait for rendering to finish
        renderTask.promise.then(function () {
          pageRendering = false;
          if (pageNumPending !== null) {
            // New page rendering is pending
            renderPage(pageNumPending);
            pageNumPending = null;
          }
        });
      });

      // Update page counters
      document.getElementById('page_num2').textContent = num;
    }

    /**
     * If another page rendering in progress, waits until the rendering is
     * finised. Otherwise, executes rendering immediately.
     */
    function queueRenderPage(num) {
      if (pageRendering) {
        pageNumPending = num;
      } else {
        renderPage(num);
      }
    }

    /**
     * Displays previous page.
     */
    function onPrevPage() {
      if (pageNum <= 1) {
        return;
      }
      pageNum--;
      queueRenderPage(pageNum);
    }
    document.getElementById('prev2').addEventListener('click', onPrevPage);

    /**
     * Displays next page.
     */
    function onNextPage() {
      if (pageNum >= pdfDoc.numPages) {
        return;
      }
      pageNum++;
      queueRenderPage(pageNum);
    }
    document.getElementById('next2').addEventListener('click', onNextPage);

    /**
     * Asynchronously downloads PDF.
     */
    pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
      pdfDoc = pdfDoc_;
      document.getElementById('page_count2').textContent = pdfDoc.numPages;

      // Initial/first page rendering
      renderPage(pageNum);
    });
  </script>
  @endsection