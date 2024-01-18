@extends('layouts.backend')

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

      .text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }

        .text-font {
    font-size: 13px;
                  }
     

</style>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;

            }
            .form-control {
            font-family: 'Kanit', sans-serif;
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
    $name_user = Auth::user()->name;
}else{
    echo "<body onload=\"checklogin()\"></body>";
    exit();
}

$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos);


use Illuminate\Support\Facades\DB;
?>
<?php
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');
?>

<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block-content">
        <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ประเมิน FUNTIONAL COMPETENCY   {{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</B></h3>
              
                <a href="{{ url('person_work/personworkfuntionalcompetency_detail/'.$id_user)}}"   class="btn btn-success" >ย้อนกลับ</a>
            </div>
            <div class="block-content block-content-full">
                  
              <form  method="post" action="" enctype="multipart/form-data">
              @csrf

              <input type="hidden" name="IDHR" id="IDHR" value="{{$id_user}}">
              <input type="hidden" name="COR_RESULT_PERSON_ID" id="COR_RESULT_PERSON_ID" value="{{$infoperson->ID}}">
              
                  <div class="row">    
                        <div class="col-md-2">
                          ปีงบประมาณ
                        </div>  
                        <div class="col-md-2">
                        <select  name="FUN_RESULT_YEAR" id="FUN_RESULT_YEAR"  class="form-control" id="exampleFormControlSelect1">
                       
                      {{$infocorresult->FUN_RESULT_YEAR}}
                        </select>
                          </div>
                          <div class="col-md-2">
                          ครั้งที่
                        </div> 
                        <div class="col-md-2">
                        <select  name="FUN_RESULT_NO" id="FUN_RESULT_NO"  class="form-control" id="exampleFormControlSelect1">
                    {{$infocorresult->FUN_RESULT_NO}}
                        </select>
                      </div>  
                      <div class="col-md-2">
                          ผู้ประเมิน
                        </div> 
                        <div class="col-md-2">
                      {{$name_user}}
                      </div> 

                      <input type="hidden"  class="form-control" name="COR_RESULT_HEAD_ID" id="COR_RESULT_HEAD_ID" value="{{$id_user}}"> 
                     
                  </div> 
                  <br>
                  <table class="gwt-table table-striped table-vcenter" width="100%">         
                                <thead style="background-color: #FFEBCD;">
                             
                          <tr height="40">
                               <th class="text-font"  width="5%"style="border-color:#F0FFFF; text-align: center;">ลำดับ</th>
                               <th class="text-font"  style="border-color:#F0FFFF; text-align: center;" >รายการ</th>
                               <th class="text-font"  width="25%"style="border-color:#F0FFFF; text-align: center;" >ระดับ</th>
                               <th class="text-font"  width="7%"style="border-color:#F0FFFF; text-align: center;" >คะแนน</th>
                               <th class="text-font"  width="15%" style="border-color:#F0FFFF; text-align: center;" >หมายเหตุ</th>
                           </tr>
                    
                    
                          </thead>
                          <tbody>
                          @foreach ($infoworkfuntions as $infoworkfuntion)
                            <tr height="20">
                            <td class="text-font text-pedding" colspan="5" style="background-color: #FFF8DC;" >{{$infoworkfuntion->FUNTION_NAME}} :: {{$infoworkfuntion->FUNTION_DETAIL}}</td>
                            </tr>
                            <?php 
                            $infoworkfunctionlevels = DB::table('infowork_function_level')->where('FUNTION_ID','=',$infoworkfuntion->FUNTION_ID)->get();
                            ?>
                                @foreach ($infoworkfunctionlevels as $infoworkfunctionlevel)
                                <tr height="20">
                                <td class="text-font text-pedding" colspan="5" style="background-color: #F0F8FF" >{{$infoworkfunctionlevel->FUNTION_LEVEL_DETAIL}}</td>
                                </tr>
                                <?php 
                                $infoworkfunctionlevelsubs = DB::table('infowork_function_level_sub')->where('FUNTION_LEVEL_ID','=',$infoworkfunctionlevel->FUNTION_LEVEL_ID)->get();
                                $idhead = $infoworkfunctionlevel->FUNTION_LEVEL_ID;
                                $count = DB::table('infowork_function_level_sub')->where('FUNTION_LEVEL_ID','=',$infoworkfunctionlevel->FUNTION_LEVEL_ID)->count();
                                
                                ?>
        
                                      <?php $number= 0; ?>
                                      @foreach ($infoworkfunctionlevelsubs as $infoworkfunctionlevelsub)
                                      <?php $number++; 
                                      
        
                                      $infoworktypescoresubs = DB::table('infowork_type_score_sub')->where('TYPE_SCORE_ID','=',$infoworkfunctionlevelsub->TYPE_SCORE_ID)->get();
                                      
                                      $infofunresultsub = DB::table('infowork_fun_result_sub')    
                                      ->leftjoin('infowork_type_score_sub','infowork_fun_result_sub.SCORE_ID','=','infowork_type_score_sub.TYPE_SCORE_SUB_ID')
                                      ->where('FUN_COM_NUMBER','=',$number)->where('FUN_COM_LEVEL_ID','=',$infoworkfunctionlevel->FUNTION_LEVEL_ID)->first();
                                      
                                      
                                      ?>
        
                                          <tr height="20">
                                            <td class="text-font text-pedding">{{$number}}</td> 
                                            <td class="text-font text-pedding">{{$infoworkfunctionlevelsub->FUNTION_LEVEL_SUB_DETAIL}}</td>  
                                            <td class="text-font text-pedding"> 
                                                
                                            {{$infofunresultsub->TYPE_SCORE_SUB_NAME}} 
                                            
                                            </td> 
                                            <td class="text-font text-pedding" style="text-align: center;" ><div class="showscore{{$idhead}}{{$number}}">
                                            {{$infofunresultsub->TYPE_SCORE_SUB_TOTAL}}
                                            </div</td> 
                                            <td class="text-font text-pedding">{{$infofunresultsub->COMMENT}}</td> 
                                          </tr> 
                                        

                                      @endforeach
        
                                      <tr height="20">
                                      <td class="text-font text-pedding" colspan="3" style="background-color: #FBE2FA" >คะแนนรวม</td>
                                      <td class="text-font text-pedding"  style="background-color: #FBE2FA" ><input class="form-control input-sm " style="text-align: center;background-color: #E0FFFF;font-size: 13px;" type="text" name="showscoresum{{$idhead}}" id="showscoresum{{$idhead}}" readonly></td>
                                      <td class="text-font text-pedding" style="background-color: #FBE2FA" ></td>
                                      </tr>
        
                                @endforeach
        
                          @endforeach
                                     
                           </tbody>
                           </table>
                  


@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



 <!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>


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
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>
<script>


 
function checkscore(idhead,number,count){
      
    
      var SCORE=document.getElementById("SCORE"+idhead+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mperson.checkscore')}}",
                   method:"GET",
                   data:{SCORE:SCORE,idhead:idhead,_token:_token},
                   success:function(result){
                      $('.showscore'+idhead+number).html(result);
                      scoreTotal(idhead,count);
                   }
           })

  }


      function scoreTotal(idhead,count){

       
        var arr = document.getElementsByName('sum'+idhead);
        var tot=0;

        //alert(arr);

        for(var i=0;i<count;i++){
          tot += parseFloat(arr[i].value);
        }
       
       //alert(tot);
        document.getElementById('showscoresum'+idhead).value =tot;

        //alert(tot);
    }

 </script>


@endsection
