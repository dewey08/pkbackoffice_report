@extends('layouts.pkclaim')
@section('title', 'PK-BACKOFFice || PCT')

     <?php
     use App\Http\Controllers\StaticController;
     use Illuminate\Support\Facades\DB;   
     $count_meettingroom = StaticController::count_meettingroom();
 ?>


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
    ?>
    <div class="container-fluid">
        
        <div class="row mt-3">
            <div class="col"></div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>รายการยาเบิก</h5>
                            </div>
                            <div class="col"></div> 
                            <div class="col-md-2 text-end">
                           
                            </div>
    
                        </div>
                    </div>
                    <div class="card-body shadow-lg">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap myTable"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ลำดับ</th>
                                    <th class="text-center">HN</th> 
                                    <th class="text-center">VN</th> 
                                    <th class="text-center">ชื่อ - สกุล</th> 
                                    <th class="text-center">เลขบัตร</th> 
                                    <th class="text-center">อายุ</th> 
                                    <th class="text-center">วันที่</th> 
                                    <th class="text-center">icd10</th> 
                                    <th class="text-center">ยา HOSxP</th> 
                                    <th class="text-center" width="7%">LAB HOSxP</th> 

                                    <th class="text-center">เลขบัตรที่บันทึก WEB</th> 
                                    <th class="text-center">วันที่บันทึก WEB</th> 
                                    <th class="text-center">ให้เลือด WEB</th> 
                                    <th class="text-center">ยา WEB</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($datashow_opd as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>                                        
                                        <td class="text-center">{{ $item->hn }}</td>
                                        <td class="text-center">{{ $item->vn }}</td>
                                        <td class="text-center">{{ $item->fullname }}</td>
                                        <td class="text-center">{{ $item->cid }}</td>
                                        <td class="text-center">{{ $item->age }}</td>
                                        <td class="text-center">{{ $item->vstdate }}</td>
                                        <td class="text-center">
                                            <a href="{{url('thalassemia_opdsubdrug_hn/'.$item->hn.'/'.$startdate.'/'.$enddate)}}" target="_blank">{{ $item->pdx }}</a>  
                                        </td> 
                                        <td class="text-center">
                                            <a href="{{url('thalassemia_opdsubdrug_hos/'.$item->vn.'/'.$startdate.'/'.$enddate)}}" target="_blank">{{ $item->xx }}</a>  
                                         </td>
                                        <td class="text-center" width="7%">{{ $item->lab }}</td>

                                        <td class="text-center" >{{ $item->tpid }}</td>
                                         <td class="text-center">{{ $item->tvstdate }}</td>
                                         <td class="text-center">{{ $item->maxblood }}</td>
                                         <td class="text-center">{{ $item->tmed }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
            
        </div>
    </div>
    </div>
 

    @endsection
    @section('footer')
        <script>
            
            $(document).ready(function() {
                $('#example').DataTable();
                $('#example2').DataTable();
                $('#example3').DataTable();
     
               
            });
        </script>
    
    
    @endsection
