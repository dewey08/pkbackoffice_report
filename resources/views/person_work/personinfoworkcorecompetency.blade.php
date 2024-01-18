@extends('layouts.general.person_work')
@section('css_after_infowork')

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

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }


    .text-pedding {
        padding-left: 10px;
        padding-right: 10px;
    }

    .text-font {
        font-size: 13px;
    }

    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
    }

    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
    }
</style>
@endsection
@section('content_infowork')
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
    // date_default_timezone_set("Asia/Bangkok");
?>                    
<!-- Advanced Tables -->
<div class="content">

  <!-- Dynamic Table Simple -->
  <div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
      <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>Core competency</B></h3>
      <a href="" class="btn btn-info">ตั้งค่า</a>
    </div>
    <div class="block-content block-content-full">


      <div class="row">
        <div class="col-md-2">
          ปีงบประมาณ
        </div>
        <div class="col-md-2">
          <select class="form-control" id="exampleFormControlSelect1">
            <option>2563</option>
            <option>2562</option>
          </select>
        </div>
        <div class="col-md-2">
          ครั้งที่
        </div>
        <div class="col-md-2">
          <select class="form-control" id="exampleFormControlSelect1">
            <option>1</option>
            <option>2</option>

          </select>
        </div>
        <div class="col-md-2">
          ผู้ประเมิน
        </div>
        <div class="col-md-2">
          นเดช หล่อมาก
        </div>

      </div>
      <br>
      <table class="gwt-table table-striped table-vcenter" width="100%">
        <thead style="background-color: #FFEBCD;">

          <tr height="40">
            <th class="text-font" width="5%" style="border-color:#F0FFFF; text-align: center;">ลำดับ</th>
            <th class="text-font" style="border-color:#F0FFFF; text-align: center;">รายการ</th>
            <th class="text-font" width="25%" style="border-color:#F0FFFF; text-align: center;">ระดับ</th>
            <th class="text-font" width="7%" style="border-color:#F0FFFF; text-align: center;">คะแนน</th>
            <th class="text-font" width="15%" style="border-color:#F0FFFF; text-align: center;">หมายเหตุ</th>
          </tr>


        </thead>
        <tbody>
          @foreach ($infoworkcorcoms as $infoworkcorcom)
          <tr height="20">
            <td class="text-font text-pedding" colspan="5" style="background-color: #FFF8DC;">
              {{$infoworkcorcom->COR_COM_NAME}} :: {{$infoworkcorcom->COR_COM_DETAIL}}</td>
          </tr>
          <?php 
        $infoworkcorcomlevels = DB::table('infowork_cor_com_level')->where('COR_COM_ID','=',$infoworkcorcom->COR_COM_ID)->get();
        ?>
          @foreach ($infoworkcorcomlevels as $infoworkcorcomlevel)
          <tr height="20">
            <td class="text-font text-pedding" colspan="5" style="background-color: #F0F8FF">
              {{$infoworkcorcomlevel->COR_COM_LEVEL_DETAIL}}</td>
          </tr>
          <?php 
            $infoworkcorcomlevelsubs = DB::table('infowork_cor_com_level_sub')->where('COR_COM_LEVEL_ID','=',$infoworkcorcomlevel->COR_COM_LEVEL_ID)->get();
            $idhead = $infoworkcorcomlevel->COR_COM_LEVEL_ID;
            $count = DB::table('infowork_cor_com_level_sub')->where('COR_COM_LEVEL_ID','=',$infoworkcorcomlevel->COR_COM_LEVEL_ID)->count();
            
            ?>

          <input type="hidden" name="count{{$idhead}}" id="count{{$idhead}}" class="form-control input-sm"
            style=" font-family: \'Kanit\', sans-serif;" value="{{$count}}">
          <?php $number= 0; ?>
          @foreach ($infoworkcorcomlevelsubs as $infoworkcorcomlevelsub)
          <?php $number++; 
                  $infoworktypescoresubs = DB::table('infowork_type_score_sub')->where('TYPE_SCORE_ID','=',$infoworkcorcomlevelsub->TYPE_SCORE_ID)->get();
                  ?>
          <tr height="20">
            <td class="text-font text-pedding" style="text-align: center;">{{$number}}</td>
            <td class="text-font text-pedding">{{$infoworkcorcomlevelsub->COR_COM_LEVEL_SUB_DETAIL}}</td>
            <td class="text-font text-pedding">
              <select name="SCORE[]" id="SCORE{{$idhead}}{{$number}}" class="form-control"
                onchange="checkscore({{$idhead}},{{$number}},{{$count}})">
                @foreach ($infoworktypescoresubs as $infoworktypescoresub)
                <option value="{{$infoworktypescoresub->TYPE_SCORE_SUB_ID}}">
                  {{$infoworktypescoresub->TYPE_SCORE_SUB_NAME}}</option>
                @endforeach
              </select>
            </td>
            <td class="text-font text-pedding" style="text-align: center;">
              <div class="showscore{{$idhead}}{{$number}}">
                </div</td> <td class="text-font text-pedding"><input name="comment[]" id="comment" class="form-control">
            </td>
          </tr>
          @endforeach
          <tr height="20">
            <td class="text-font text-pedding" colspan="3" style="background-color: #FBE2FA">คะแนนรวม</td>
            <td class="text-font text-pedding" style="background-color: #FBE2FA"><input class="form-control input-sm "
                style="text-align: center;background-color: #E0FFFF;font-size: 13px;" type="text"
                name="showscoresum{{$idhead}}" id="showscoresum{{$idhead}}" readonly></td>
            <td class="text-font text-pedding" style="background-color: #FBE2FA"></td>
          </tr>
          @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('footer')
<script>
  function checklogin() {
    window.location.href = '{{route("index")}}';
  }
</script>
<script>
  jQuery(function () {
    Dashmix.helpers(['easy-pie-chart', 'sparkline']);
  });
</script>
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

  function chkmunny(ele) {
    var vchar = String.fromCharCode(event.keyCode);
    if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
    ele.onKeyPress = vchar;
  }
</script>
@endsection
