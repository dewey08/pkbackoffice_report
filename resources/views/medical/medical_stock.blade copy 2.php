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
            <div class="row ">   
                @foreach ($medical_typecat as $item)
                    
                        <div class="col-6 col-md-4 col-xl-2 mt-3">  
                          
                                @if ($id == $item->medical_typecat_id)
                                    <div class="card">
                                        <div class="card-body text-center shadow-lg"> 
                                            {{-- <i class="fa-solid fa-3x fa-warehouse text-danger"></i>  --}}
                                            @if ( $item->img == Null )
                                            <img src="{{asset('assets/images/default-image.jpg')}}" height="100px" width="auto;" alt="Image" class="img-thumbnail">
                                            @else
                                            <img src="{{asset('storage/article/'.$item->img)}}" height="100px" alt="Image" class="img-thumbnai">                                 
                                            @endif 
                                           
                                            <label for="" class="mt-2" style="color: red">{{$item->medical_typecatname}}</label>
                                            <br>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#insertdata">รับเข้าคลัง</button>
                                            {{-- <a href="" class="btn btn-outline-danger btn-sm">คืน</a> --}}
                                            {{-- <a href="" class="btn btn-outline-danger btn-sm">คลัง</a> --}}
                                        </div>
                                    </div>
                                @else
                                    <div class="card">
                                        <div class="card-body text-center shadow-lg"> 
                                            {{-- <i class="fa-solid fa-3x fa-warehouse text-primary"></i>  --}}
                                            {{-- <br> --}}
                                            <a href="{{url('med_store')}}">
                                                @if ( $item->img == Null )
                                                <img src="{{asset('assets/images/default-image.jpg')}}" height="100px" width="auto;" alt="Image" class="img-thumbnail">
                                                @else
                                                <img src="{{asset('storage/article/'.$item->img)}}" height="100px" alt="Image" class="img-thumbnai">                                 
                                                @endif
                                                <label for="" class="mt-2">{{$item->medical_typecatname}}</label>
                                            </a>
                                        </div>
                                    </div>                                    
                                @endif
                                
                          
                        </div>
                  
                @endforeach                       
                
            </div>
            <div class="row "> 
                <div class="card">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รูปภาพ</th>
                                    <th>เลขครุภัณฑ์</th>
                                    <th>ชื่อครุภัณฑ์</th>
                                    <th>หน่วยงาน</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                <?php $i = 1; ?>
                                @foreach ($article_data as $item) 
                                    <tr style="font-size: 12px;" id="sid{{$item->article_id }}">  
                                    <td width="5%">{{ $i++ }}</td>
                                    <td width="10%">
                                        @if ( $item->article_img == Null )
                                        <img src="{{asset('assets/images/default-image.jpg')}}" height="50px" width="50px" alt="Image" class="img-thumbnail">
                                        @else
                                        <img src="{{asset('storage/article/'.$item->article_img)}}" height="50px" width="50px" alt="Image" class="img-thumbnail">                                 
                                        @endif 
                                    </td>
                                    <td class="text-start">{{ $item->article_num }}</td>
                                    <td class="text-start">{{ $item->article_name }}</td>
                                    <td class="text-start">{{ $item->article_deb_subsub_name }}</td>
                                    <td class="text-start">{{ $item->article_deb_subsub_name }}</td>
                                   
                                </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--  Modal content for the insert example -->
    <div class="modal fade" id="insertdata" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">เพิ่มบิลรับเข้าคลัง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1">
                        <label for="year">ปีงบ :</label>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select id="year" name="year"
                                class="form-control" style="width: 100%">
                                <option value="">--เลือก--</option>
                                @foreach ($budget_year as $ye)
                                    @if ($ye->leave_year_id == $date)
                                        <option value="{{ $ye->leave_year_id }}" selected>
                                            {{ $ye->leave_year_id }} </option>
                                    @else
                                        <option value="{{ $ye->leave_year_id }}"> {{ $ye->leave_year_id }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="year">วันที่ :</label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="date" id="date_rep" name="date_rep" class="form-control" >
                        </div>   
                    </div>
                    <div class="col-md-1">
                        <label for="year">เวลา :</label>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="time" id="time_rep" name="time_rep" class="form-control" >
                        </div>   
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="col-md-12 text-end">
                    <div class="form-group">
                        <button type="button" id="Savebtn" class="btn btn-outline-info btn-sm">
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            บันทึกข้อมูล
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i
                                class="fa-solid fa-xmark me-2"></i>Close</button>

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
        $('#Savebtn').click(function() {
            var medical_typecatname = $('#medical_typecatname').val();  
            $.ajax({
                url: "{{ route('med.med_consave') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    medical_typecatname 
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
