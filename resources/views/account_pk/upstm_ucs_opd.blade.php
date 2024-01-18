@extends('layouts.accountpk')
@section('title', 'PK-BACKOFFice || ACCOUNT')

@section('content')
    <script>
        function TypeAdmin() {
            window.location.href = '{{ route('index') }}';
        }
    </script>
    <?php
    if (Auth::check()) {
        $type = Auth::user()->type;
        $iduser = Auth::user()->id;
    } else {
        echo "<body onload=\"TypeAdmin()\"></body>";
        exit();
    }
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $ynow = date('Y') + 543;
    $yb = date('Y') + 542;
    ?>

    <style>
        #button {
            display: block;
            margin: 20px auto;
            padding: 30px 30px;
            background-color: #eee;
            border: solid #ccc 1px;
            cursor: pointer;
        }

        #overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 250px;
            height: 250px;
            border: 10px #ddd solid;
            border-top: 10px #fd6812 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }
        .bar{
            height: 50px;
            background-color: rgb(10, 218, 55);
        }
        .percent{
            position: absolute;
            left: 50%;
            color: black;
        }       
        .card{
            border-radius: 3em 3em 3em 3em;
            /* box-shadow: 0 0 10px teal; */
        }
        .card-ucs{
            border-radius: 3em 3em 3em 3em;
            box-shadow: 0 0 10px rgb(3, 136, 252);
        }
        .card-ofc{
            border-radius: 3em 3em 3em 3em;
            box-shadow: 0 0 10px rgb(10, 110, 223);
        }
        .card-lgo{
            border-radius: 3em 3em 3em 3em;
            box-shadow: 0 0 10px teal;
        }
        .card-ucsti{
            border-radius: 3em 3em 3em 3em;
            box-shadow: 0 0 10px rgb(252, 144, 3);
        }
        .card-ofcti{
            border-radius: 3em 3em 3em 3em;
            box-shadow: 0 0 10px rgb(252, 3, 82);
        }
        .card-sssti{
            border-radius: 3em 3em 3em 3em;
            box-shadow: 0 0 10px rgb(94, 93, 93);
        }
        .card-lgoti{
            border-radius: 3em 3em 3em 3em;
            box-shadow: 0 0 10px teal;
        }
        .nav{
         
            border-radius: 3em 3em 20 20;
            background-color: aliceblue;
            /* box-shadow: 0 0 10px teal; */
        }
        .nav-link{
            border-radius: 20 20 10 10;
            box-shadow: 0 0 10px teal;
        }
    </style>
    <?php
    use App\Http\Controllers\StaticController;
    use Illuminate\Support\Facades\DB;
    $count_meettingroom = StaticController::count_meettingroom();
    ?>

        <div class="tabs-animation">
            <div id="preloader">
                <div id="status">
                    <div class="spinner">
    
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div id="overlay">
                    <div class="cv-spinner">
                        <span class="spinner"></span>
                    </div>
                </div>
        
            </div>

        <div class="row">

            <div class="col-md-12">
                {{-- <div class="card shadow-lg rounded-pill"> --}}
                    <div class="card-body ">

                        <h4 class="card-title">STM DETAIL GROUP</h4>
                        <p class="card-title-desc">รายการ stm ที่อัพโหลดแล้ว</p>
                        {{-- btn-shadow btn-dashed btn btn-outline-info bt mb-2 --}} 
                        {{-- <button type="button" class="btn btn-info btn-rounded waves-effect waves-light">Info</button> --}}
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-ucs" role="tabpanel" aria-labelledby="v-pills-ucs-tab">
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="card p-4 card-ucs">
                                                    <h4 class="card-title" style="color:rgb(10, 151, 85)">STM DETAIL UCS OPD</h4>
                                                    <div class="table-responsive">
                                                        <table id="example" class="table table-striped table-bordered "
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">ลำดับ</th> 
                                                                    <th class="text-center">STMDoc</th> 
                                                                    {{-- <th class="text-center">total</th> --}}
                                
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $number = 0;
                                                                $total1 = 0; ?>
                                                                @foreach ($datashow as $item)
                                                                    <?php $number++; ?>
                                
                                                                    <tr height="20">
                                                                        <td class="text-font" style="text-align: center;" width="4%" style="color:rgb(248, 12, 12)">{{ $number }}</td>
                                                                        <td class="text-start" style="color:rgb(34, 90, 243);font-size:15px">  
                                                                            <a href="{{url('upstm_ucs_detail_opd/'.$item->STMDoc)}}" target="_blank"> {{ $item->STMDoc }}</a>  
                                                                        </td>  
                                                                        {{-- <td class="text-end" style="color:rgb(10, 151, 85);font-size:15px" width="30%">{{ number_format($item->total, 2) }}</td> --}}
                                                                    </tr>
                                                                @endforeach
                                
                                                            </tbody> 
                                                        </table>
                                                    </div>
                                                </div>
                                                {{-- <div class="card p-4 card-ucs">
                                                    <h4 class="card-title" style="color:rgb(10, 151, 85)">STM DETAIL UCS OPD 216</h4>
                                                    <div class="table-responsive">
                                                        <table id="example12" class="table table-striped table-bordered "
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">ลำดับ</th> 
                                                                    <th class="text-center">STMDoc</th> 
                                                                    <th class="text-center">total</th>
                                
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $number = 0;
                                                                $total1 = 0; ?>
                                                                @foreach ($ucs_216 as $item_216)
                                                                    <?php $number++; ?>
                                
                                                                    <tr height="20">
                                                                        <td class="text-font" style="text-align: center;" width="4%" style="color:rgb(248, 12, 12)">{{ $number }}</td>
                                                                        <td class="text-start" style="color:rgb(34, 90, 243);font-size:15px">  
                                                                            <a href="{{url('upstm_ucs_detail_opd_216/'.$item_216->STMDoc)}}" target="_blank"> {{ $item_216->STMDoc }}</a>  
                                                                        </td>  
                                                                        <td class="text-end" style="color:rgb(10, 151, 85);font-size:15px" width="30%">{{ number_format($item_216->total, 2) }}</td>
                                                                    </tr>
                                                                @endforeach
                                
                                                            </tbody> 
                                                        </table>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            
                                        </div> 
                                    </div>

                                    

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
                <!-- end card -->
            </div>
        </div>
   

@endsection
@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();
            $('#example3').DataTable();
            $('#example4').DataTable();
            $('#example5').DataTable();
            $('#example6').DataTable();
            $('#example7').DataTable();
            $('#example8').DataTable();
            $('#example9').DataTable();
            $('#example10').DataTable();
            $('#example11').DataTable();
            $('#example12').DataTable();
            $('#example13').DataTable();
            $('#example14').DataTable();
            $('#example15').DataTable();
            $('#example16').DataTable();
            $('#example17').DataTable();
            $('#example18').DataTable();
            $('#example19').DataTable();
            $('#example20').DataTable();

            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#datepicker2').datepicker({
                format: 'yyyy-mm-dd'
            });

            var bar = $('.bar');
            var percent = $('.percent');
            $('form').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete+'%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },
                complete: function(xhr) { 
                    Swal.fire({
                        title: 'UP STM สำเร็จ',
                        text: "You UP STM success",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#06D177',
                        // cancelButtonColor: '#d33',
                        confirmButtonText: 'เรียบร้อย'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "{{ url('upstm_ucs') }}";
                        }
                    })
                }
            })

            $('#Upstm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                // alert('OJJJJOL');
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            Swal.fire({
                                title: 'Up Statment สำเร็จ',
                                text: "You Up Statment data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                // cancelButtonColor: '#d33',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })

                        } else {
                            Swal.fire({
                                title: 'UP Statment ซ้ำ',
                                text: "You Up Statment data success",
                                icon: 'warning',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                // cancelButtonColor: '#d33',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }
                    }
                });
            });

            

        });
    </script>
@endsection
