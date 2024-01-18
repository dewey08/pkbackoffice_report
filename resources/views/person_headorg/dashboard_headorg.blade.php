@extends('layouts.headorg')
@section('css_before')


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


?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
           
            }

            p {
	
                word-wrap:break-word;
                }
                .text{
                    font-family: 'Kanit', sans-serif;
                     
                }
</style>

<style>
    body * {
        font-family: 'Kanit', sans-serif;
    }

    p {
        word-wrap: break-word;
    }

    .text {
        font-family: 'Kanit', sans-serif;
    }

    .card-white .card-heading {
        color: #333;
        background-color: #fff;
        border-color: #ddd;
        border: 1px solid #dddddd;
    }

    .card-white .card-footer {
        background-color: #fff;
        border-color: #ddd;
    }

    .card-white .h5 {
        font-size: 14px;
        //font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    }

    .card-white .time {
        font-size: 12px;
        //font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    }

    .post .post-heading {
        height: 95px;
        padding: 20px 15px;
    }

    .post .post-heading .avatar {
        width: 60px;
        height: 60px;
        display: block;
        margin-right: 15px;
    }

    .post .post-heading .meta .title {
        margin-bottom: 0;
    }

    .post .post-heading .meta .title a {
        color: black;
    }

    .post .post-heading .meta .title a:hover {
        color: #aaaaaa;
    }

    .post .post-heading .meta .time {
        margin-top: 8px;
        color: #999;
    }

    .post .post-image .image {
        width: 100%;
        height: auto;
    }

    .post .post-description {
        padding: 15px;
    }

    .post .post-description p {
        font-size: 14px;
    }

    .post .post-description .stats {
        margin-top: 20px;
    }

    .post .post-description .stats .stat-item {
        display: inline-block;
        margin-right: 15px;
    }

    .post .post-description .stats .stat-item .icon {
        margin-right: 8px;
    }

    .post .post-footer {
        border-top: 1px solid #ddd;
        padding: 15px;
    }

    .post .post-footer .input-group-addon a {
        color: #454545;
    }

    .post .post-footer .comments-list {
        padding: 0;
        margin-top: 20px;
        list-style-type: none;
    }

    .post .post-footer .comments-list .comment {
        display: block;
        width: 100%;
        margin: 20px 0;
    }

    .post .post-footer .comments-list .comment .avatar {
        width: 35px;
        height: 35px;
    }

    .post .post-footer .comments-list .comment .comment-heading {
        display: block;
        width: 100%;
    }

    .post .post-footer .comments-list .comment .comment-heading .user {
        font-size: 14px;
        font-weight: bold;
        display: inline;
        margin-top: 0;
        margin-right: 10px;
    }

    .post .post-footer .comments-list .comment .comment-heading .time {
        font-size: 12px;
        color: #aaa;
        margin-top: 0;
        display: inline;
    }

    .post .post-footer .comments-list .comment .comment-body {
        margin-left: 50px;
    }

    .post .post-footer .comments-list .comment>.comments-list {
        margin-left: 50px;
    }

</style>

<link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>

<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
<link rel="stylesheet" id="css-main" href="{{ asset('asset/css/dashmix.css') }}">
<link rel="stylesheet" id="css-theme" href="{{ asset('asset/css/themes/xpro.css') }}">
<link rel="stylesheet" href="{{asset('css/stylesl.css')}}">
<!-- END Stylesheets -->
<style>
    #page-container.main-content-boxed>#page-header .content-header,
    #page-container.main-content-boxed>#page-header .content,
    #page-container.main-content-boxed>#main-container .content,
    #page-container.main-content-boxed>#page-footer .content {
        max-width: 1399px;
    }

    .fix {
        position: fixed;
        width: 100%;
        z-index: 5;
    }
</style>
<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/js/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
{{-- <link rel="stylesheet" href="{{ asset('assets/js/sweetalert2/sweetalert2.min.css') }}">
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.min.js"
    integrity="sha512-33a7z5UWvWHAxBi0waVWN71V1WSXylTH1Iier1lEZdKxvE4RdoYkOKWazVr9av5O1GS6aaOcE3nUB3sPQRA7Jg=="
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.min.css"
    integrity="sha512-EeZYT52DgUwGU45iNoywycYyJW/C2irAZhp2RZAA0X4KtgE4XbqUl9zXydANcIlEuF+BXpsooxzkPW081bqoBQ=="
    crossorigin="anonymous" />


<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>

@endsection
@section('content')
<br><br><br>
<center>    
    {{-- <div class="block " style="width: 95%;"> --}}
    <div class="block mb-4" style="width: 95%;margin:auto">
        <div class="block-content shadow">
            <div class="block-header block-header-default">
                <div class="col-12">
                    <h1 class="block-title" style="font-family: 'Kanit', sans-serif; font-size:23px"><B>ข้อมูลบุคลากร</B></h1>
                </div>

            </div>
            <br>
        </div>
        <hr>

     <div class="col-12">
        <div class="panel bg-sl2-b1 p-1">
            <div class="pane-heading py-2 pl-1 text-white text-left" style="font-size: 14px;">แผนภูมิแสดงรายละเอียดจำนวนเจ้าหน้าที่ในกลุ่มงาน</div>
            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
            <div class="col-11">
                <br>
                <?php $data[] = array('กลุ่มงาน','จำนวนคน'); ?>
                @foreach ($groupworks as $groupwork)
                <?php $data[] = array($groupwork->HR_DEPARTMENT_NAME,$groupwork->person_count); ?>   
                @endforeach  
                <div id="columnchart_material" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                <br><br>
            </div>
            </div>
        </div>
     </div>

     
                    <div class="block block-content my-3 shadow">
                        <div class="row mb-2">
                            <div class="col-md-12 mb-2">
                                <div class="row">
                                    <?php $data_2[] = array('กลุ่มบุคลากร','จำนวนคน'); ?>
                                    @foreach ($grouppersons as $groupperson)
                                    <?php $data_2[] = array($groupperson->HR_PERSON_TYPE_NAME,$groupperson->person_count); ?>   
                                    @endforeach  
                                    <div class="col-md-6">
                                        <div class="panel bg-sl-o2 p-1">
                                            <div class="pane-heading py-2 pl-5 text-white">แผนภูมิแสดงรายละเอียดจำนวนกลุ่มบุคลากร</div>
                                            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden"><div class="col-1"></div>
                                             <div class="col-10">   <div id="piechart_3d_1" style="width: 100%; height: 450px;"></div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel bg-sl-g2 p-1 mb-2">
                                            <div class="pane-heading py-2 pl-5 text-white">แผนภูมิแสดงรายละเอียดจำนวนบุคลากรจำแนกเพศ</div>
                                            <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden"><div class="col-2"></div>
                                                <div class="col-10"><div id="piechart_3d_2" style="width: 100%; height: 450px;"></div></div>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                                
                            </div>
                        </div>
                    </div>
                
        
                <div class="block block-content my-3 shadow">
                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <div class="block-header block-header-default">
                                <div class="col-12">
                                    <h1 class="block-title" style="font-family: 'Kanit', sans-serif; font-size:23px"><B>ข้อมูลการลา</B></h1>
                                </div>
      
                            </div>
                        </div>
                    </div>
              


       


                    <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="col-md-4 col-xl-3">
                                        <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
                                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                <div class="item">
                                                    <i class="fa fa-2x fa fa-user-injured text-white"></i>
                                                </div>
                                                <div class="ml-3 text-right" >
                                                <p class="text-white mb-0">
                                                        ลาป่วย (ครั้ง)
                                                    </p>
                                                    <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                     {{$count1}}
                                                    </p>
                                             
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <a class="block block-rounded block-link-pop bg-danger" href="javascript:void(0)">
                                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                <div class="item">
                                                    <i class="fa fa-2x fa fa fa-baby text-white"></i>
                                                </div>
                                                <div class="ml-3 text-right">
                                                <p class="text-white mb-0">
                                                        ลาคลอดบุตร (ครั้ง)
                                                    </p>
                                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                        {{$count2}}
                                                    </p>
                                               
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <a class="block block-rounded block-link-pop bg-warning" href="javascript:void(0)">
                                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                            <div class="item">
                                                    <i class="fa fa-2x fa-envelope-open text-white"></i>
                                                </div>
                                            <div class="ml-3 text-right">
                                            <p class="text-white mb-0">
                                                    ลากิจ (ครั้ง)
                                                    </p>
                                            <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                    {{$count3}}
                                                    </p>
                                                
                                                </div>
                                                
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-xl-3">
                                        <a class="block block-rounded block-link-pop bg-info" href="javascript:void(0)">
                                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                            <div class="item">
                                                    <i class="fa fa-2x fa fa-coffee text-white"></i>
                                                </div>
                                            <div class="ml-3 text-right">
                                            <p class="text-white mb-0">
                                                    ลาพักผ่อน (ครั้ง)
                                                    </p>
                                            <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                    {{$count4}}
                                                    </p>
                                               
                                                </div>
                                                
                                            </div>
                                        </a>
                                    </div>   
                            </div>
                            <div class="row">
                                    <div class="col-md-4 col-xl-3">
                                            <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
                                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                    <div class="item">
                                                        <i class="fa fa-2x fa fa-bookmark text-white"></i>
                                                    </div>
                                                    <div class="ml-3 text-right" >
                                                    <p class="text-white mb-0">
                                                            ลาอุปสมบท (ครั้ง)
                                                        </p>
                                                        <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                                {{$count5}}
                                                        </p>
                                                 
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4 col-xl-3">
                                            <a class="block block-rounded block-link-pop bg-danger" href="javascript:void(0)">
                                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                    <div class="item">
                                                        <i class="fa fa-2x fa fa-baby-carriage text-white"></i>
                                                    </div>
                                                    <div class="ml-3 text-right">
                                                    <p class="text-white mb-0">
                                                            ลาช่วยภริยาคลอด (ครั้ง)
                                                        </p>
                                                    <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                            {{$count6}}
                                                        </p>
                                                   
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4 col-xl-3">
                                            <a class="block block-rounded block-link-pop bg-warning" href="javascript:void(0)">
                                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                <div class="item">
                                                        <i class="fa fa-2x fa fa-users text-white"></i>
                                                    </div>
                                                <div class="ml-3 text-right">
                                                <p class="text-white mb-0">
                                                        ลาเกณฑ์ทหาร (ครั้ง)
                                                        </p>
                                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                        {{$count7}}
                                                        </p>
                                                    
                                                    </div>
                                                    
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4 col-xl-3">
                                            <a class="block block-rounded block-link-pop bg-info" href="javascript:void(0)">
                                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                <div class="item">
                                                        <i class="fa fa-2x fa fa-graduation-cap text-white"></i>
                                                    </div>
                                                <div class="ml-3 text-right">
                                                <p class="text-white mb-0">
                                                        ลาศึกษา ฝึกอบรม (ครั้ง)
                                                        </p>
                                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                        {{$count8}}
                                                        </p>
                                                   
                                                    </div>
                                                    
                                                </div>
                                            </a>
                                        </div>   
                            
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 col-xl-3">
                                            <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
                                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                    <div class="item">
                                                        <i class="fa fa-2x fa fa-plane-departure text-white"></i>
                                                    </div>
                                                    <div class="ml-3 text-right" >
                                                    <p class="text-white mb-0">
                                                            ลาทำงานต่างประเทศ (ครั้ง)
                                                        </p>
                                                        <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                                {{$count9}}
                                                        </p>
                                                 
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4 col-xl-3">
                                            <a class="block block-rounded block-link-pop bg-danger" href="javascript:void(0)">
                                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                    <div class="item">
                                                        <i class="fa fa-2x fa fa-transgender text-white"></i>
                                                    </div>
                                                    <div class="ml-3 text-right">
                                                    <p class="text-white mb-0">
                                                            ลาติดตามคู่สมรส (ครั้ง)
                                                        </p>
                                                    <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                            {{$count10}}
                                                        </p>
                                                   
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4 col-xl-3">
                                            <a class="block block-rounded block-link-pop bg-warning" href="javascript:void(0)">
                                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                <div class="item">
                                                        <i class="fa fa-2x fa fa-pencil-ruler text-white"></i>
                                                    </div>
                                                <div class="ml-3 text-right">
                                                <p class="text-white mb-0">
                                                        ลาฟื้นฟูอาชีพ (ครั้ง)
                                                        </p>
                                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                        {{$count11}}
                                                        </p>
                                                    
                                                    </div>
                                                    
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4 col-xl-3">
                                            <a class="block block-rounded block-link-pop bg-info" href="javascript:void(0)">
                                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                <div class="item">
                                                        <i class="fa fa-2x fa fa-share text-white"></i>
                                                    </div>
                                                <div class="ml-3 text-right">
                                                <p class="text-white mb-0">
                                                        ลาออก (ครั้ง)
                                                        </p>
                                                <p class="text-white mb-0" style="font-size: 2.25rem;">
                                                        {{$count12}}
                                                        </p>
                                                   
                                                    </div>
                                                    
                                                </div>
                                            </a>
                                        </div>   
                                    </div>
                                </div>
                        
                            </div> 
                       
             
                        </div>
                    </div>
                 
                      

                            <div class="block block-content my-3 shadow">
                                <div class="panel bg-sl2-b1 p-1">
                                <div class="pane-heading py-2 pl-5 text-white">แผนภูมิแสดงรายละเอียดจำนวนการลา ปีปัจจุบัน</div>
                                <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                                   <div class="col-11"><br>
                                    <div id="columnchart_leave" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
                                    <br>
                                   </div>
                                </div> 
                            </div> 
                            <br><br>
                </div>


      
                
            


















        

      
        @endsection

        @section('footer')
        
        <script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
        <script src="{{ asset('google/Charts.js') }}"></script>
    
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php
            echo json_encode($data);
            ?>);

        var options = {
            fontName: 'Kanit',
            hAxis: { slantedText: true, 
                      slantedTextAngle: 45
            },
          chart: {
            title: 'จำนวนเจ้าหน้าที่ในกลุ่มงาน',
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
        var data = google.visualization.arrayToDataTable( <?php
            echo json_encode($data_2);
            ?>);

        var options = {
          title: 'จำนวนกลุ่มบุคลากร ',
          fontName: 'Kanit',

      
        
           
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_1'));
        chart.draw(data, options);
      }
    </script>


<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['เพศ', 'จำนวน'],
          ['ชาย',<?php echo $man ?>],
          ['หญิง', <?php echo $women ?>],
         
         
        ]);

        var options = {
          title: 'จำนวนบุคลากรจำแนกเพศ ',
          fontName: 'Kanit',

      
        
           
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_2'));
        chart.draw(data, options);
      }
    </script>


    
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['เดือน','จำนวนครั้ง'],
        ['ม.ค', <?php echo $m1_1; ?>],
        ['ก.พ', <?php echo $m2_1; ?>],
        ['มี.ค', <?php echo $m3_1;?>],
        ['เม.ย', <?php echo $m4_1;?>],
        ['พ.ค', <?php echo $m5_1;?>],
        ['มิ.ย', <?php echo $m6_1;?>],
        ['ก.ค', <?php echo $m7_1;?>],
        ['ส.ค', <?php echo $m8_1;?>],
        ['ก.ย', <?php echo $m9_1;?>],
        ['ต.ค', <?php echo $m10_1;?>],
        ['พ.ย', <?php echo $m11_1; ?>],
        ['ธ.ค', <?php echo  $m12_1;?>]
      ]);
      var options = {
          fontName: 'Kanit',
          hAxis: { slantedText: true, 
                    slantedTextAngle: 45
          },
        chart: {
          title: 'จำนวนการลา ปีปัจจุบัน',
        }        
      };     
      var chart = new google.charts.Bar(document.getElementById('columnchart_leave'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }      
</script>





@endsection