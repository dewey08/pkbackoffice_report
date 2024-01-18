@extends('layouts.asset')

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
  
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

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
      } 

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

      }
      .tablesorter-filter-row{
        font-family: 'Kanit', sans-serif;
      }
      
      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
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

  function getAge($day) {
    $then = strtotime($day);
    return(floor((time()-$then)/31556926));
}

  
?>

<?php

$infoasset= DB::table('asset_article')->where('asset_article.ARTICLE_ID','=',902)->first(); 

$depreciation= DB::table('supplies_decline')->where('supplies_decline.DECLINE_ID','=',$infoasset->DECLINE_ID)->first(); 




$start = $month = strtotime($infoasset->RECEIVE_DATE. ' + 1 month');

$yearend = date("Y",strtotime($infoasset->RECEIVE_DATE))+60;
$dateend = $yearend.'-01-01';
$end = strtotime($dateend);

echo '



<br><br>'.$infoasset->ARTICLE_NUM.':::'.$infoasset->ARTICLE_NAME.'<br>
<table class="gwt-table table-striped table-vcenter " style="width: 100%;">
<thead style="background-color: #FFEBCD;">
    <tr height="40">

                   
                   <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;" width="5%">ปีงบ</th>
                   <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;" width="10%">เดือน</th>    
                   <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;"  width="15%">ราคาตั้งต้น</th>
                   <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;"   width="15%">ค่าเสื่อมยกมา</th>
                   <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;"   width="15%">ค่าเสื่อม</th>
                   <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;"   width="15%">ค่าเสื่อมสะสม</th>
                   <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;"   width="15%">มูลค่า</th>

            </tr>
            </thead>
            <tbody >';

     //--------------------------------สูตรคำนวน-----------------------------------------------         
     $PICE = $infoasset->PRICE_PER_UNIT; 
     $per_year = $depreciation->DECLINE_PERSEN;
     $Depreciation_mont =  ($PICE*($per_year/100))/12; 

     //-------------------------คำนวณเดือนแรก----------------------------
     
     $fristYear= date("Y",strtotime($infoasset->RECEIVE_DATE))+543;
     $fristMonth= date("m",strtotime($infoasset->RECEIVE_DATE));
     $fristdate= date("d",strtotime($infoasset->RECEIVE_DATE));

     $amountdate = 30 - $fristdate;
     $Depdate = $Depreciation_mont/30;

   $fristDepreciation_mont = $amountdate * $Depdate;

   $fristDepreciation = $PICE - $fristDepreciation_mont;

     echo '<tr>';
     echo '<td>'.$fristYear.'</td><td>'.$fristMonth.'</td><td>'.number_format($PICE,2).'</td><td>0.00</td><td>'.number_format($fristDepreciation_mont,2).'</td><td>'.number_format($fristDepreciation_mont,2).'</td><td>'.number_format($fristDepreciation,2).'</td>';
     echo '</tr>';

     //----------------------------------------------------

     $Depreciation_move = $fristDepreciation_mont;
     $Depreciation = $Depreciation_mont + $Depreciation_move;

            while($month < $end)
{


     $year = date('Y', $month)+543;


     $value_last = ($PICE -$Depreciation_move)-1 ; //-----ตัวตัดค่าเสื่อมตัวสุดท้าย

     $value = $PICE - $Depreciation;
     
     if($value <=0){
        $Depreciation_mont = $value_last;
        $Depreciation = $Depreciation_move+$Depreciation_mont;
        $value = 1;
       
     }

     echo '<tr>';
     echo '<td>'.$year.'</td><td>'.date('m', $month).'</td><td>'.number_format($PICE,2).'</td><td>'.number_format($Depreciation_move,2).'</td><td>'.number_format($Depreciation_mont,2).'</td><td>'.number_format($Depreciation,2).'</td><td>'.number_format($value,2).'</td>';
     echo '</tr>';
 
     if($value ==1){
       break;
     }
     $Depreciation = $Depreciation_mont + $Depreciation;
   
     $Depreciation_move = $Depreciation - $Depreciation_mont;
    


     $month = strtotime("+1 month", $month);
    

    
}

echo '</tbody ></table>';

?>
                 
                  
      
                      

@endsection

@section('footer')




<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
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

 





function depreciate(id){


$.ajax({
           url:"{{route('massete.depreciate')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#depreciate').html(result);
             
           }
            
   })
    
}



function switchsearch(code){

//alert(code);

var _token=$('input[name="_token"]').val();


   $.ajax({
           url:"{{route('massete.switchsearchassetinfo')}}",
           method:"GET",
           data:{code:code,_token:_token},
           success:function(result){
              $('.switch_search').html(result);
              rundatepicker1();
              rundatepicker2();
           }

           })


         

      }

//====================================================================================


    function rundatepicker1() {
            
            $('.datepicker1').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    }

    
    function rundatepicker2() {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    }


//++++++++++++++++++++++++

function location(){
      
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.repairnomal')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.locationlevel').html(result);
                     }
             })
                  
     }

     $('.locationlevel').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.repairnomalsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.locationlevelroom').html(result);
                     }
             })
            // console.log(select);
             }        
     });
  
</script>





@endsection