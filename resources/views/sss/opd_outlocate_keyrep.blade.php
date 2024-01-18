@extends('layouts.pkclaim')
@section('title', 'PK-BACKOFFice || ประกันสังคม')
@section('content')
<script>
    function TypeAdmin() {
        window.location.href = '{{ route('index') }}';
    }
    
</script>
    <style>
        .table th {
            font-family: sans-serif;
            font-size: 12px;
        }

        .table td {
            font-family: sans-serif;
            font-size: 12px;
        }
    </style>
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
    ?>
    <div class="container-fluid">  
        <div class="row mt-3"> 
            <h5 class="mb-sm-0">รายงานจำนวนผู้ป่วยนอก ปกส.นอกเขต</h5>
            <div class="col-xl-12 mt-2">
                <div class="card">
                    <div class="card-body py-0 px-2 mt-2">
                        <div class="table-responsive"> 
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">ลำดับ</th>
                                        <th class="text-center">HN</th>
                                        <th class="text-center">PDX</th>
                                        <th class="text-center">วันที่รับบริการ</th> 
                                        <th class="text-center">ชื่อ - สกุล</th> 
                                        <th class="text-center">เลขบัตรประชาชน</th> 
                                        <th class="text-center">อุปกรณ์</th> 
                                        <th class="text-center">ค่าใช้จ่าย HOSxP</th> 
                                        <th class="text-center">สิทธิ</th> 
                                        <th class="text-center">เรียกเก็บ</th> 
                                        <th class="text-center">เลขหนังสือ</th> 
                                        <th class="text-center">เรียกเก็บเงิน</th> 
                                        <th class="text-center">หมายเหตุ</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($data_opd_outlocate_keyrep as $item)                                            
                                            <tr>
                                                <td>{{$i++ }}</td>
                                                <td>{{$item->hn}}</td>  
                                                <td>{{ $item->pdx }} </td>                                            
                                                <td class="text-center" >{{ $item->vstdate }}</td>  
                                                <td >{{ $item->fullname }}</td> 
                                                <td >{{ $item->cid }}</td>  
                                                <td class="text-center" >{{ $item->inc08 }}</td>   
                                                <td class="text-center" >{{ $item->income }}</td> 
                                                <td class="text-center" >{{ $item->pttype }}</td> 
                                                <td class="text-center" >{{ $item->claim_code }}</td> 
                                                <td class="text-center" >{{ $item->nhso_docno }}</td> 
                                                <td class="text-center" >{{ $item->nhso_ownright_pid }}</td> 
                                                <td class="text-center" >{{ $item->nhso_ownright_name }}</td>   
                                            </tr>                                            
                                    @endforeach
                                    
                                </tbody>
                                <tr>
                                    <td colspan="10" ></td>
                                    <td class="text-right">รวม</td>
                                    @foreach ($data_opd_outlocate_keyreptotal as $item2)
                                    <td class="text-center"><label for="" style="color: red">{{$item2->sumtotal}}</label></td>
                                    @endforeach
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
            $('#example').DataTable();
            $('#example2').DataTable();
  
        });
    </script>

@endsection
