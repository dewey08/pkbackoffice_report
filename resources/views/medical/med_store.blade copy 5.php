@extends('layouts.medicalslide')
@section('title', 'PK-BACKOFFice || เครื่องมือแพทย์')
 
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

    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y') + 543;
    $datefull = date('Y-m-d H:i:s');
    $time = date("H:i:s");
    $loter = $date.''.$time

    ?>
        <style>
            #button{
                   display:block;
                   margin:20px auto;
                   padding:30px 30px;
                   background-color:#eee;
                   border:solid #ccc 1px;
                   cursor: pointer;
                   }
                   #overlay{	
                   position: fixed;
                   top: 0;
                   z-index: 100;
                   width: 100%;
                   height:100%;
                   display: none;
                   background: rgba(0,0,0,0.6);
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
                   border: 5px #ddd solid;
                   border-top: 10px #12c6fd solid;
                   border-radius: 50%;
                   animation: sp-anime 0.8s infinite linear;
                   }
                   @keyframes sp-anime {
                   100% { 
                       transform: rotate(360deg); 
                   }
                   }
                   .is-hide{
                   display:none;
                   }
        </style>
       <div class="container-fluid">
            <div id="preloader">
                <div id="status">
                    <div class="spinner">
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h4 class="card-title">Detail Medical</h4>
                    <p class="card-title-desc">รายละเอียดคลังเครื่องมือแพทย์</p>
                </div>
                <div class="col"></div>
                <div class="col-md-2 text-end"> 
                    {{-- <button type="button" style="font-size: 17px" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#insertdata"><i class="fa-solid fa-wand-magic-sparkles me-3"></i>รับเข้าคลัง</button> --}}
                </div>
            </div>
            <div class="row "> 
                
                @foreach ($medical_typecat as $item)
                        <div class="col-lg-12 col-xl-4">
                            <div class="main-card mb-3 card">
                                <div class="grid-menu-col">
                                    <div class="g-0 row">
                                        
                                        <div class="col-sm-12">
                                            <div class="widget-chart widget-chart-hover">
                                                <div class="icon-wrapper rounded-circle" >
                                                    <div class="icon-wrapper-bg bg-primary"></div>
                                                    @if ( $item->img == Null )
                                                    <img src="{{asset('assets/images/default-image.jpg')}}" height="50px" width="auto;" alt="Image" class="img-thumbnail">
                                                    @else
                                                    <img src="{{asset('storage/article/'.$item->img)}}" height="50px" alt="Image" class="img-thumbnai">                                 
                                                    @endif 
                                                </div>
                                                <div class="widget-numbers"> <label for="" style="color: red;font-size:17px">{{$item->medical_typecatname}}</label></div>
                                              
                                                   
                                                <div class="widget-description ">
                                                    <?php 
                                                    
                                                     $dataqty = DB::connection('mysql')->select('   
                                                        SELECT SUM(qty) as Totalqty FROM medical_stock
                                                        WHERE medical_typecat_id="'.$item->medical_typecat_id.'"
                                                    ');
                                                     ?>
                                                    <div class="row">
                                                        <div class="col-lg-4 text-danger"> 
                                                            @foreach ($dataqty as $itemc)
                                                                @if ($itemc->Totalqty > 0) 
                                                                <a href="{{url('med_store_rep/'.$item->medical_typecat_id)}}" class="mb-1 me-1 btn btn-primary">คลัง
                                                                    <span class="badge rounded-pill bg-light">{{$itemc->Totalqty}} </span>
                                                                </a>
                                                                @else 
                                                                <a href="{{url('med_store_rep/'.$item->medical_typecat_id)}}" class="mb-1me-1 btn btn-primary">คลัง
                                                                    <span class="badge rounded-pill bg-light">0</span>
                                                                </a>  
                                                                @endif                                          
                                                            @endforeach 
                                                        </div>
                                                        <div class="col-lg-4 text-info">  
                                                            
                                                            <button class="mb-1 me-1 btn btn-info">ยืม
                                                                <span class="badge rounded-pill bg-light">0</span>
                                                            </button>  
                                                        </div>
                                                        <div class="col-lg-4 text-success"> 
                                                           
                                                            <button class="mb-1 me-1 btn btn-success">คืน
                                                                <span class="badge rounded-pill bg-light">0</span>
                                                            </button> 
                                                           
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                @endforeach 
            </div>
            
        </div>
 
        
@endsection
@section('footer')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#example2').DataTable();
        $('#p4p_work_month').select2({
            placeholder:"--เลือก--",
            allowClear:true
        }); 
        $('select').select2();                        
        $('#product_id').select2({
            placeholder: "--เลือก--",
            allowClear: true
        });          
        $('#year').select2({ 
            dropdownParent: $('#insertdata') 
        });
        $('#medical_typecat_id').select2({ 
            dropdownParent: $('#insertdata') 
        });
        
        $('#Savebtn').click(function() {
            var year = $('#year').val();  
            var date_rep = $('#date_rep').val(); 
            var time_rep = $('#time_rep').val(); 
            var medical_typecat_id = $('#medical_typecat_id').val(); 
            var user_rep = $('#user_rep').val(); 
            $.ajax({
                url: "{{ route('med.med_store_save') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    year,date_rep,time_rep,medical_typecat_id,user_rep
                },
                success: function(data) {
                    if (data.status == 200) {
                        Swal.fire({
                            title: 'บันทึกข้อมูลสำเร็จ',
                            text: "You Insert data success",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#06D177',
                            confirmButtonText: 'เรียบร้อย'
                        }).then((result) => {
                            if (result
                                .isConfirmed) {
                                console.log(
                                    data);
                                window.location.reload();
                                // window.location="{{url('warehouse/warehouse_index')}}";
                            }
                        })
                    } else {
                        Swal.fire({
                            title: 'ข้อมูลมีแล้ว',
                            text: "You Have data ",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#06D177',
                            confirmButtonText: 'เรียบร้อย'
                        }).then((result) => {
                            if (result
                                .isConfirmed) {
                                console.log(
                                    data);
                                window.location.reload();
                                // window.location="{{url('warehouse/warehouse_index')}}";
                            }
                        })

                    }

                },
            });
        });
         
    });
    
</script>

@endsection
