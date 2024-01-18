

<center>

  
<div class="block-content block-content-full">
<div class="row">
   <div class="col-md-7" style="text-align: left">
 
   <div style="text-align:center">

   @if($infomation->BOOK_FILE_NAME == '' || $infomation->BOOK_FILE_NAME == null)
         ไม่มีข้อมูลไฟล์อัปโหลด 
   @else

    <iframe src="{{ asset('storage/bookpdf/'.$infomation->BOOK_FILE_NAME) }}" height="100%" width="100%"></iframe>

   @endif

  
</div>

 



</body>
     
