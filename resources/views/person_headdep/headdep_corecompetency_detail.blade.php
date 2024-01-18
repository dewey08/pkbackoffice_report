@extends('layouts.headdep')

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
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ประเมิน CORE COMPETENCY  {{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</B></h3>
              
                <a href="{{ url('person_headdep/headdep_corecompetency/'.$id_user)}}"   class="btn btn-success" >ย้อนกลับ</a>
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
                        <select  name="COR_RESULT_YEAR" id="COR_RESULT_YEAR"  class="form-control" id="exampleFormControlSelect1">
                       
                          @if($infocorresult->COR_RESULT_YEAR == '2563'  )<option value="2563" selected>2563</option>@else<option value="2563">2563</option>@endif
                          @if($infocorresult->COR_RESULT_YEAR == '2562'  )<option value="2562" selected>2563</option>@else<option value="2562">2562</option>@endif
                        
                        </select>
                          </div>
                          <div class="col-md-2">
                          ครั้งที่
                        </div> 
                        <div class="col-md-2">
                        <select  name="COR_RESULT_NO" id="COR_RESULT_NO"  class="form-control" id="exampleFormControlSelect1">
                        @if($infocorresult->COR_RESULT_NO == '1'  )<option value="1" selected>1</option>@else<option value="1">1</option>@endif
                        @if($infocorresult->COR_RESULT_NO == '2'  )<option value="2" selected>2</option>@else<option value="2">2</option>@endif
                        
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
                        @foreach ($infoworkcorcoms as $infoworkcorcom)
                          <tr height="20">
                          <td class="text-font text-pedding" colspan="5" style="background-color: #FFF8DC;" >{{$infoworkcorcom->COR_COM_NAME}} :: {{$infoworkcorcom->COR_COM_DETAIL}}</td>
                          </tr>
                          <?php 
                          $infoworkcorcomlevels = DB::table('infowork_cor_com_level')->where('COR_COM_ID','=',$infoworkcorcom->COR_COM_ID)->get();
                          ?>
                              @foreach ($infoworkcorcomlevels as $infoworkcorcomlevel)
                              <tr height="20">
                              <td class="text-font text-pedding" colspan="5" style="background-color: #F0F8FF" >{{$infoworkcorcomlevel->COR_COM_LEVEL_DETAIL}}</td>
                              </tr>
                              <?php 
                              $infoworkcorcomlevelsubs = DB::table('infowork_cor_com_level_sub')->where('COR_COM_LEVEL_ID','=',$infoworkcorcomlevel->COR_COM_LEVEL_ID)->get();
                              $idhead = $infoworkcorcomlevel->COR_COM_LEVEL_ID;
                              $count = DB::table('infowork_cor_com_level_sub')->where('COR_COM_LEVEL_ID','=',$infoworkcorcomlevel->COR_COM_LEVEL_ID)->count();
                              
                              ?>
                  
                              <input type="hidden" name="count{{$idhead}}" id="count{{$idhead}}" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{$count}}">
                  
                                    <?php $number= 0; ?>
                                    @foreach ($infoworkcorcomlevelsubs as $infoworkcorcomlevelsub)
                                    <?php $number++; 

                                    $infoworktypescoresubs = DB::table('infowork_type_score_sub')->where('TYPE_SCORE_ID','=',$infoworkcorcomlevelsub->TYPE_SCORE_ID)->get();
                                    
                                    $infocorresultsub = DB::table('infowork_cor_result_sub')    
                                    ->leftjoin('infowork_type_score_sub','infowork_cor_result_sub.SCORE_ID','=','infowork_type_score_sub.TYPE_SCORE_SUB_ID')
                                    ->where('COR_COM_NUMBER','=',$number)->where('COR_COM_LEVEL_ID','=',$infoworkcorcomlevel->COR_COM_LEVEL_ID)->first();
                                    
                                    ?>
                                 
                  
                                        <tr height="20">
                                          <td class="text-font text-pedding" style="text-align: center;" >{{$number}}</td> 
                                          <td class="text-font text-pedding">{{$infoworkcorcomlevelsub->COR_COM_LEVEL_SUB_DETAIL}}</td>  
                                          <td class="text-font text-pedding"> 
                                              
                                              <select  name="SCORE_ID[]" id="SCORE{{$idhead}}{{$number}}" class="form-control" onchange="checkscore({{$idhead}},{{$number}},{{$count}})" >
                                              <option value="0">กรุณาเลือก</option>
                                              @foreach ($infoworktypescoresubs as $infoworktypescoresub)
                                              @if($infocorresultsub->SCORE_ID == $infoworktypescoresub->TYPE_SCORE_SUB_ID)
                                              <option value="{{$infoworktypescoresub->TYPE_SCORE_SUB_ID}}" selected>{{$infoworktypescoresub->TYPE_SCORE_SUB_NAME}}</option>

                                              @else
                                              <option value="{{$infoworktypescoresub->TYPE_SCORE_SUB_ID}}">{{$infoworktypescoresub->TYPE_SCORE_SUB_NAME}}</option>
                                              @endif
                                              
                                          
                                             
                                             
                                              @endforeach
                                              </select>
                                          
                                          </td> 
                                          <td class="text-font text-pedding" style="text-align: center;" ><div class="showscore{{$idhead}}{{$number}}">
                                          {{$infocorresultsub->TYPE_SCORE_SUB_TOTAL}}
                                          </div</td> 
                                          <td class="text-font text-pedding"><input name="COMMENT[]" id="COMMENT" class="form-control" value="{{$infocorresultsub->COMMENT}}"> </td> 
                                        </tr> 
                                    </div>

                                    
                                          <input type="hidden" name="COR_COM_NUMBER[]" id="COR_COM_NUMBER" value="{{$number}}">
                                          <input type="hidden" name="COR_COM_ID[]" id="COR_COM_ID" value="{{$infoworkcorcom->COR_COM_ID}}">
                                          <input type="hidden" name="COR_COM_LEVEL_ID[]" id="COR_COM_LEVEL_ID" value="{{$infoworkcorcomlevel->COR_COM_LEVEL_ID}}">
                                          <input type="hidden" name="TYPE_SCORE_ID[]" id="TYPE_SCORE_ID" value="{{$infoworkcorcomlevelsub->TYPE_SCORE_ID}}">
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
                  
                  
                       
                     <br>
                     
                      </div>

       
        </div>
        </form>  
        
        <br>
                      <br>
                  


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
