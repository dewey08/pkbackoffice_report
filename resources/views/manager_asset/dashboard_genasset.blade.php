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

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

      }

      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 14px;
                  }   
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
<!-- Advanced Tables -->
<div class="bg-body-light">
<div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>มูลค่าทรัพย์สิน</B></h3>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div>
                                <a href="{{ url('general_asset/dashboard/'.$inforpersonuserid -> ID)}}" class="btn btn-warning" >Dashboard</a> 
                                </div>
                                <div>&nbsp;</div>     
                                <div>
                                <a href="{{ url('general_asset/genassetindex/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนครุภัณฑ์</a> 
                                </div>
                                <div>&nbsp;</div>                      
                                <div>
                                <a href="{{ url('general_asset/genassetdisburseindex/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนเบิกครุภัณฑ์  
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infolendindex/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนยืม
                                </a>   
                                </div>           
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infogiveindex/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนถูกยืม
                                </a>   
                                </div>    
                         
                                
                                </div>
                                </ol>
                            </nav> 
            </div>
            <div class="block-content">
            <form action="#" method="post">
                    @csrf 
            <div class="row" >
        
           
            <div class="col-md-2">
                &nbsp;ประจำปีงบประมาณ : &nbsp;
            </div>
            <div class="col-md-2">
                <span>
                             <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">--ทั้งหมด--</option>     
                                    @foreach ($budgets as $budget)
                           
                        <option value="{{ $budget->YEAR_ID  }}">{{ $budget->YEAR_ID}}</option>
                                                             
                            @endforeach                         
                                </select>

                 
                   
                </span>

                </div> 
                <div class="col-md-1">
                            <span>
                                <button type="submit" class="btn btn-info" >แสดง</button>
                            </span> 
                        </div>
                </div>

             </form>     
            <br>
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                            <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="item">
                                        <i class="fa fa-2x fa fa-laptop-medical text-white"></i>
                                    </div>
                                    <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                         {{number_format($costasset,2)}} บาท
                                        </p>
                                        <p class="text-white mb-0">
                                        มูลค่าครุภัณฑ์ {{number_format($countasset)}} รายการ
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <a class="block block-rounded block-link-pop bg-danger" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="item">
                                        <i class="fa fa-2x fa fa-hospital-alt text-white"></i>
                                    </div>
                                    <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                          {{number_format($costbuilding,2)}} บาท
                                        </p>
                                        <p class="text-white mb-0">
                                        มูลค่าสิ่งก่อสร้าง {{number_format($countbuilding)}} รายการ
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <a class="block block-rounded block-link-pop bg-warning" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        <i class="fa fa-2x fa fa-comment-dollar text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                        {{number_format($costasset + $costbuilding,2)}} บาท
                                        </p>
                                        <p class="text-white mb-0">
                                        มูลค่าครุภัณฑ์และสิ่งก่อสร้างทั้งหมด
                                        </p>
                                    </div>
                                    
                                </div>
                            </a>
                        </div>
                    </div>
                 
                    </div> 
                    </div> 
                    </div> 
                <center>
                  <div style="width: 95%;">
                   <div class="row">
                   <div class="col-md-8">
                      
                         <br>
                         <div class="block block-content">
                        <div id="columnchart_material" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                        </div>
                        <br>

                        <div class="block block-content">
                        <div id="piechart_3d_1" style="width: 100%; height: 550px;"></div>
                        </div>

                   </div>
                   <div class="col-md-4 ">

                   <div class="col-md-12">
                            <a class="block block-rounded block-link-pop bg-info" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        <i class="fa fa-2x fa fa-hand-holding-usd text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                         {{number_format($budget1,2)}} บาท
                                        </p>
                                        <p class="text-white mb-0">
                                        งบประมาณ
                                        </p>
                                    </div>
                                    
                                </div>
                            </a>
                        </div>

                   
                    <div class="col-md-12">
                            <a class="block block-rounded block-link-pop bg-success" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        <i class="fa fa-2x fa fa-money-bill-wave text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                        {{number_format($budget2,2)}} บาท
                                        </p>
                                        <p class="text-white mb-0">
                                        เงิน UC
                                        </p>
                                    </div>
                                    
                                </div>
                            </a>
                        </div>

                   

                    <div class="col-md-12">
                            <a class="block block-rounded block-link-pop bg-secondary" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        <i class="fa fa-2x fa fa-search-dollar text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                        {{number_format($budget3,2)}} บาท
                                        </p>
                                        <p class="text-white mb-0">
                                        เงินบำรุง
                                        </p>
                                    </div>
                                    
                                </div>
                            </a>
                        </div>

                  

                    <div class="col-md-12">
                            <a class="block block-rounded block-link-pop bg-primary" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        <i class="fa fa-2x fa fa-donate text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                        {{number_format($budget4,2)}} บาท
                                        </p>
                                        <p class="text-white mb-0">
                                        เงินบริจาค
                                        </p>
                                    </div>
                                    
                                </div>
                            </a>
                        </div>

                 
                    <div class="col-md-12">
                            <a class="block block-rounded block-link-pop bg-danger" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        <i class="fa fa-2x fa fa-money-check-alt text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                        {{number_format($budget5,2)}} บาท
                                        </p>
                                        <p class="text-white mb-0">
                                        เงินอื่นๆ
                                        </p>
                                    </div>
                                    
                                </div>
                            </a>
                        </div>

                  
                    <div class="col-md-12">
                            <a class="block block-rounded block-link-pop bg-warning" href="javascript:void(0)">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="item">
                                        <i class="fa fa-2x fa fa-syringe text-white"></i>
                                    </div>
                                <div class="ml-3 text-right">
                                        <p class="text-white font-size-lg font-w600 mb-0">
                                        {{number_format($budget6,2)}} บาท
                                        </p> 
                                        <p class="text-white mb-0">
                                        เงินค่าบริการทางการแพทย์ที่เบิกจ่ายในลักษณะงบลงทุน
                                        </p>
                                    </div>
                                    
                                </div>
                            </a>
                        </div>

                    </div>

                 
                    
                    
                    </div> 

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

<script src="{{ asset('google/Charts.js') }}"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['ปีงบประมาณ ','มูลค่าครุภัณฑ์'],
        [ '<?php echo $y5; ?>', <?php echo $Value5; ?>],
        [ '<?php echo $y4; ?>', <?php echo $Value4; ?>],
        [ '<?php echo $y3; ?>', <?php echo $Value3;?>],
        [ '<?php echo $y2; ?>', <?php echo $Value2;?>],
        [ '<?php echo $y1; ?>', <?php echo $Value1;?>],
      
        ]);

        

        var options = {
            fontName: 'Kanit',
          chart: {
            title: 'มูลค่าครุภัณฑ์ ย้อนหลัง 5 ปี',
          
          
          }

       
        
        };

     
        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

       
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ประเภททรัพย์สิน', 'จำนวนร้อยละ'],
          ['ครุภัณฑ์', <?php echo $costasset; ?>],
          ['สิ่งก่อสร้าง', <?php echo $costbuilding; ?>],
        
         
        ]);

        var options = {
          title: 'อัตราส่วนมูลค่าทรัพย์สิน',
          fontName: 'Kanit',
        
           
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_1'));
        chart.draw(data, options);
      }
    </script>



@endsection