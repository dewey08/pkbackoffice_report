@extends('layouts.personhealth')
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
  font-size: 13px;    
  }
  label{
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
       
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
.form-control {
    font-family: 'Kanit', sans-serif;
    font-size: 13px;
        }

        table, th, td {
border: 1px solid #A9A9A9;
}
</style>
<style>
   
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
    }else{
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    }

    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);



    use App\Http\Controllers\PerdevController;
    $checkapp = PerdevController::checkapp($user_id);
    $checkver = PerdevController::checkver($user_id);

    $countapp = PerdevController::countapp($user_id);
    $countver = PerdevController::countver($user_id);


?>
<?php
function RemoveDateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    }


    function Removeformate($strDate)
    {
    $strYear = date("Y",strtotime($strDate));
    $strMonth= date("m",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));

    return $strDay."/".$strMonth."/".$strYear;
    }
    function Removeformatetime($strtime)
    {
    $H = substr($strtime,0,5);
    return $H;
    }
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');
?>






@endsection