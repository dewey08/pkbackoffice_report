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
$datenow = date('Y-m-d');
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
            border-top: 10px #1fdab1 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(390deg);
            }
        }

        .is-hide {
            display: none;
        }
    </style>

    <div class="tabs-animation ">

        <div class="row text-center">
            <div id="overlay">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
            </div> 
        </div> 
        <div id="preloader">
            <div id="status">
                <div class="spinner"> 
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail</h4>
    
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Detail</a></li>
                                <li class="breadcrumb-item active">1102050101.216</li>
                            </ol>
                        </div>
    
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div> <!-- container-fluid -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="card cardacc">
                    {{-- <div class="card-header"> 
                       รายละเอียดตั้งลูกหนี้ผัง 1102050101.216  
                        <div class="btn-actions-pane-right">
                           
                        </div>
                    </div> --}}
                    <div class="card-body">  
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">ลำดับ</th>
                                    {{-- <th class="text-center">tranid</th> --}}
                                    <th class="text-center" width="5%">vn</th> 
                                    {{-- <th class="text-center">an</th> --}}
                                    <th class="text-center" >hn</th>
                                    <th class="text-center" >cid</th>
                                    <th class="text-center">ptname</th> 
                                    <th class="text-center">vstdate</th>   
                                    <th class="text-center">ลูกหนี้</th> 
                                    <th class="text-center">Stm 216</th> 
                                    {{-- <th class="text-center">ส่วนต่าง</th>  --}}
                                    <th class="text-center">Stm 202</th> 
                                    <th class="text-center">ยอดชดเชยทั้งสิ้น</th>  
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number = 0; $total1 = 0; $total2 = 0;$total3 = 0;$total4 = 0;?>
                                @foreach ($data as $item)
                                    <?php $number++; ?>
                                    <tr height="20" style="font-size: 14px;">
                                        <td class="text-font" style="text-align: center;" width="4%">{{ $number }}</td>  
                                        <td class="text-center" width="8%">{{ $item->vn }}</td> 
                                                {{-- <td class="text-center" width="6%">{{ $item->an }}</td>  --}}
                                                <td class="text-center" width="5%">{{ $item->hn }}</td>  
                                                <td class="text-center" width="8%">{{ $item->cid }}</td>  
                                                <td class="p-2" width="10%">{{ $item->ptname }}</td>  
                                                <td class="text-center" width="6%">{{ $item->vstdate }}</td>  
                                                <td class="text-end" style="color:rgb(73, 147, 231)" width="7%">{{ number_format($item->debit_total,2)}}</td>
                                                
                                                <td class="text-end" style="color:rgb(184, 12, 169)" width="7%">{{ number_format(($item->stm216),2)}}</td> 
                                                <td class="text-end" style="color:rgb(216, 95, 14)" width="7%">{{ number_format($item->ip_paytrue,2)}}</td> 
                                                <td class="text-end" style="color:rgb(9, 196, 180)" width="8%">{{ number_format($item->total_approve,2)}}</td>  
                                                 
                                                {{-- <td class="text-end" width="10%"> 
                                                    <button type="button" class="btn btn-icon btn-shadow btn-dashed btn-outline-primary" data-bs-toggle="modal" data-bs-target="#DetailModal{{ $item->an }}" data-bs-placement="right" title="ค่าใช้จ่าย">{{ number_format($item->debit,2)}} </button> 
                                                </td>  --}}
                                    </tr>
                                        <?php
                                             $total1 = $total1 + $item->debit_total; 
                                            $total2 = $total2 + $item->stm216;
                                            $total3 = $total3 + $item->ip_paytrue;
                                            $total4 = $total4 + $item->total_approve;
                                        ?>

                                
                                @endforeach  
                               
                            </tbody>
                            <tr style="background-color: #f3fca1">
                                <td colspan="6" class="text-end" style="background-color: #ff9d9d"></td>
                                <td class="text-end" style="background-color: rgb(73, 147, 231)"><label for="" style="color: #FFFFFF">{{ number_format($total1,2)}}</label></td>
                                <td class="text-end" style="background-color: rgb(184, 12, 169)"><label for="" style="color: #FFFFFF">{{ number_format($total2,2)}}</label></td>
                                <td class="text-end" style="background-color: rgb(216, 95, 14)"><label for="" style="color: #FFFFFF">{{ number_format($total3,2)}}</label></td> 
                                <td class="text-end" style="background-color: rgb(9, 196, 180)"><label for="" style="color: #FFFFFF">{{ number_format($total4,2)}}</label></td>  
                            </tr>  
                        </table>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
@section('footer')

    <script> 
        $(document).ready(function() { 

            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#datepicker2').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#example').DataTable();
            $('#hospcode').select2({
                placeholder: "--เลือก--",
                allowClear: true
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
 
        });
    </script>
@endsection
