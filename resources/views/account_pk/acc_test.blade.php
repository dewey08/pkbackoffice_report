@extends('layouts.accountpk')
@section('title', 'PK-BACKOFFice || ACCOUNT')
@section('content')
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

    <div class="tabs-animation">

        <div class="row text-center">
            <div id="overlay">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
            </div>

        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"> 
                       เที่ยบ 217
                        <div class="btn-actions-pane-right">
                           
                        </div>
                    </div>
                    <div class="card-body">  
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">ลำดับ</th>
                                    <th class="text-center">vn</th>
                                    <th class="text-center">pang_stamp_vn</th> 
                                    <th class="text-center">hn</th> 
                                    <th class="text-center">pang_stamp_hn</th>
                                    <th class="text-center">vstdate</th>
                                    <th class="text-center">pang_stamp_vstdate</th>
                                    <th class="text-center">dchdate</th>                                     
                                    <th class="text-center">pang_stamp_dchdate</th> 
                                    <th class="text-center">debit_total</th> 
                                    <th class="text-center">pang_stamp_uc_money</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number = 0; ?>
                                @foreach ($data as $item)
                                    <?php $number++; ?>
                                    <tr height="20">
                                        <td class="text-font" style="text-align: center;">{{ $number }}</td> 
                                        <td class="text-font text-pedding" style="text-align: center;color: red" > {{ $item->vn }}</td>   
                                        <td class="text-font text-pedding" style="text-align: center;"> {{ $item->pang_stamp_vn }}</td> 
                                        <td class="text-font text-pedding" style="text-align: left;color: red"> {{ $item->hn }} </td> 
                                        <td class="text-font text-pedding" style="text-align: center;"> {{ $item->pang_stamp_hn }} </td> 
                                        <td class="text-font text-pedding" style="text-align: center;color: red"> {{ $item->vstdate }} </td> 
                                        <td class="text-font text-pedding" style="text-align: center;"> {{ $item->pang_stamp_vstdate }}</td> 
                                        <td class="text-font text-pedding" style="text-align: center;color: red"> {{ $item->dchdate }} </td> 
                                        <td class="text-font text-pedding" style="text-align: center;"> {{ $item->pang_stamp_dchdate }} </td> 
                                        <td class="text-font text-pedding" style="text-align: right;color: red">&nbsp;&nbsp; {{ number_format($item->debit_total,2) }} </td> 
                                        <td class="text-font text-pedding" style="text-align: right;"> &nbsp;&nbsp;{{ number_format($item->pang_stamp_uc_money,2) }} </td>                                          
                                    </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
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
