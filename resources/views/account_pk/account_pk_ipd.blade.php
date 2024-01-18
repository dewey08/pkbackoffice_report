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
        <form action="{{ route('acc.account_pk_ipd') }}" method="POST">
            @csrf
        <div class="row"> 
            <div class="col"></div>
            <div class="col-md-1 text-end mt-2">วันที่</div>
            <div class="col-md-4 text-end">
                <div class="input-daterange input-group" id="datepicker1" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker1'>
                    <input type="text" class="form-control" name="startdate" id="datepicker" placeholder="Start Date" data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true"
                        data-date-language="th-th" value="{{ $startdate }}" required/>
                    <input type="text" class="form-control" name="enddate" placeholder="End Date" id="datepicker2" data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true"
                        data-date-language="th-th" value="{{ $enddate }}"/>  
                </div> 
            </div>
            <div class="col-md-4">
                <button type="submit" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-primary">
                    <i class="fa-solid fa-magnifying-glass"></i> 
                    ค้นหา 
                </button>   
                <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-info" id="Save_ipd">
                    <i class="fa-solid fa-1 me-2"></i> 
                    ดึงข้อมูล</button>    
                {{-- <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-secondary" id="Check_sitipd">
                    <i class="fa-solid fa-2 me-2"></i> 
                    ตรวจสอบสิทธิ์
                </button>    --}}
                                      
            </div>
            <div class="col"></div>
        </div>
            {{-- <div class="row"> 
                <div class="col"></div>
                <div class="col-md-1 text-end">วันที่</div>
                <div class="col-md-2 text-center">
                    <div class="input-group" id="datepicker1">
                        <input type="text" class="form-control" name="startdate" id="datepicker"  data-date-container='#datepicker1'
                            data-provide="datepicker" data-date-autoclose="true" data-date-language="th-th"
                            value="{{ $startdate }}">

                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                    </div>
                </div>
                <div class="col-md-1 text-center">ถึงวันที่</div>
                <div class="col-md-2 text-center">
                    <div class="input-group" id="datepicker1">
                        <input type="text" class="form-control" name="enddate" id="datepicker2" data-date-container='#datepicker1'
                            data-provide="datepicker" data-date-autoclose="true" data-date-language="th-th"
                            value="{{ $enddate }}">

                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                    </div>
                </div>                         
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i> 
                        ค้นหา 
                    </button>  
                   
                    <button type="button" class="btn btn-info" id="Save_ipd">
                        <i class="fa-solid fa-1 me-2"></i> 
                        ดึงข้อมูล</button>    
                    <button type="button" class="btn btn-secondary" id="Check_sitipd">
                        <i class="fa-solid fa-2 me-2"></i>
                 
                        ตรวจสอบสิทธิ์
                    </button>   
                                          
                </div>
                <div class="col"></div>
            </div>  --}}
        </form>
        <div class="row mt-3 text-center">  
            <div id="overlay">
                <div class="cv-spinner">
                  <span class="spinner"></span>
                </div>
              </div>
        </div> 
        <div class="row mt-3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                      
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="card-title">Detail IPD</h4>
                                <p class="card-title-desc">รายละเอียดตั้งลูกหนี้</p>
                            </div>
                            <div class="col"></div>
                            {{-- <div class="col-md-2 text-end">
                                <button type="button" class="btn btn-warning Savestamp" data-url="{{url('account_pk_debtor')}}">
                                    <i class="fa-solid fa-file-waveform me-2"></i>
                                    ตั้งลูกหนี้
                                </button>
                            </div> --}}
                        </div>

                        <p class="mb-0">
                            <div class="table-responsive">
                                {{-- <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> --}}
                                {{-- <table id="example" class="table table-hover table-sm table-light dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">   --}}
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                                    <thead>
                                        <tr>
                                          
                                            <th width="5%" class="text-center">ลำดับ</th> 
                                            {{-- <th width="5%" class="text-center"><input type="checkbox" name="stamp" id="stamp"> </th>  --}}
                                            <th class="text-center" width="5%">vn</th> 
                                            <th class="text-center">an</th>
                                            <th class="text-center" >hn</th>
                                            {{-- <th class="text-center" >cid</th> --}}
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                            <th class="text-center">dchdate</th>  
                                            <th class="text-center">สิทธิ์ Hos</th> 
                                            <th class="text-center">สิทธิ์ สปสช</th> 
                                            <th class="text-center">ผังบัญชี</th> 
                                            {{-- <th class="text-center">income</th>  --}}
                                            <th class="text-center">ลูกหนี้</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($acc_debtor as $item) 
                                            <tr>                                                  
                                                <td class="text-center" width="5%">{{ $i++ }}</td>  
                                                {{-- <td class="text-center" width="5%"><input type="checkbox" class="sub_chk" data-id="{{$item->acc_debtor_id}}"> </td>   --}}
                                                <td class="text-center" width="5%">{{ $item->vn }}</td> 
                                                <td class="text-center" width="5%">{{ $item->an }}</td> 
                                                <td class="text-center" width="5%">{{ $item->hn }}</td>  
                                                {{-- <td class="text-center" width="5%">{{ $item->cid }}</td>   --}}
                                                <td class="p-2">{{ $item->ptname }}</td> 
                                                <td class="text-center" width="5%">{{ $item->dchdate }}</td>   
                                                <td class="text-center" style="color:rgb(73, 147, 231)" width="10%">{{ $item->pttype }}</td> 
                                                <td class="text-center" style="color:rgb(251, 185, 92)" width="10%">{{ $item->pttype_spsch }}</td> 
                                                <td class="text-center"  width="10%">{{ $item->account_code }}</td>  
                                                {{-- <td class="text-center">{{ $item->income }}</td>   --}}
                                                 <td class="text-center"  width="12%">{{ $item->debit }}</td>  

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>account_pk </h5>
                            </div>
                            <div class="col"></div> 
                            <div class="col-md-2 text-end">
                           
                            </div>
    
                        </div>
                    </div>
                    <div class="card-body shadow-lg">
                        <div class="table-responsive">
                           
 
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    </div>
  

    @endsection
    @section('footer')
    
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#datepicker2').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#stamp').on('click', function(e) {
            if($(this).is(':checked',true))  
            {
                $(".sub_chk").prop('checked', true);  
            } else {  
                $(".sub_chk").prop('checked',false);  
            }  
            }); 
            // $.ajaxSetup({
            //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            // });
            
            $('.Savestamp').on('click', function(e) {
                // alert('oo');
                var allValls = [];
                $(".sub_chk:checked").each(function () {
                    allValls.push($(this).attr('data-id'));
                });
                if (allValls.length <= 0) {
                    // alert("SSSS");
                    Swal.fire({
                        title: 'คุณยังไม่ได้เลือกรายการ ?',
                        text: "กรุณาเลือกรายการก่อน",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33', 
                        }).then((result) => {
                        
                        })
                } else {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "คุณต้องการตั้งลูกหนี้รายการนี้ใช่ไหม!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Debtor it.!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var check = true;
                                if (check == true) {
                                    var join_selected_values = allValls.join(",");
                                    // alert(join_selected_values);
                                    $.ajax({
                                        url:$(this).data('url'),
                                        type: 'POST',
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                        data: 'ids='+join_selected_values,
                                        success:function(data){ 
                                                if (data.status == 200) {
                                                    $(".sub_chk:checked").each(function () {
                                                        $(this).parents("tr").remove();
                                                    });
                                                    Swal.fire({
                                                        title: 'ตั้งลูกหนี้สำเร็จ',
                                                        text: "You Debtor data success",
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
                                                    
                                                }
                                                

                                            // } else {
                                            //     alert("Whoops Something went worng all"); 
                                            // }
                                        }
                                    });
                                    $.each(allValls,function (index,value) {
                                        $('table tr').filter("[data-row-id='"+value+"']").remove();
                                    });
                                }
                            }
                        }) 
                    // var check = confirm("Are you want ?");  
                }
            });
             

            $("#spinner-div").hide(); //Request is complete so hide spinner

            // $('#Save_ipd').click(function() {
            //     var datepicker = $('#datepicker').val(); 
            //     var datepicker2 = $('#datepicker2').val(); 
           
            //     $.ajax({
            //         url: "{{ route('acc.account_pk_ipdsave') }}",
            //         type: "POST",
            //         dataType: 'json',
            //         data: {
            //             datepicker,
            //             datepicker2                        
            //         },
            //         success: function(data) {
            //             if (data.status == 200) {
            //                 Swal.fire({
            //                     title: 'ดึงข้อมูลสำเร็จ',
            //                     text: "You Pull data success",
            //                     icon: 'success',
            //                     showCancelButton: false,
            //                     confirmButtonColor: '#06D177',
            //                     confirmButtonText: 'เรียบร้อย'
            //                 }).then((result) => {
            //                     if (result
            //                         .isConfirmed) {
            //                         console.log(
            //                             data);
            //                         window.location.reload();
            //                         // window.location="{{url('warehouse/warehouse_index')}}";
            //                     }
            //                 })
            //             } else {
                            
            //             }

            //         },
            //     });
            // });
            $('#Save_ipd').click(function() {
                var datepicker = $('#datepicker').val(); 
                var datepicker2 = $('#datepicker2').val(); 
                Swal.fire({
                        title: 'ต้องการดึงข้อมูลใช่ไหม ?',
                        text: "You Warn Pull Data!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, pull it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#overlay").fadeIn(300);　
                                $("#spinner").show(); //Load button clicked show spinner 
                                
                                $.ajax({
                                    url: "{{ route('acc.account_pk_ipdsave') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    data: {
                                        datepicker,
                                        datepicker2                        
                                    },
                                    success: function(data) {
                                        if (data.status == 200) { 
                                            Swal.fire({
                                                title: 'ดึงข้อมูลสำเร็จ',
                                                text: "You Pull data success",
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
                                                    $('#spinner').hide();//Request is complete so hide spinner
                                                        setTimeout(function(){
                                                            $("#overlay").fadeOut(300);
                                                        },500);
                                                }
                                            })
                                        } else {
                                            
                                        }
                                    },
                                });
                                
                            }
                })
            });
            $('#Check_sitipd').click(function() {
                var datepicker = $('#datepicker').val(); 
                var datepicker2 = $('#datepicker2').val(); 
                //    alert(datepicker);
                Swal.fire({
                        title: 'ต้องการตรวจสอบสอทธิ์ใช่ไหม ?',
                        text: "You Check Sit Data!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, pull it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#overlay").fadeIn(300);　
                                $("#spinner-div").show(); //Load button clicked show spinner 
                            $.ajax({
                                url: "{{ route('acc.account_pkCheck_sitipd') }}",
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    datepicker,
                                    datepicker2                        
                                },
                                success: function(data) {
                                    if (data.status == 200) { 
                                        Swal.fire({
                                            title: 'เช็คสิทธิ์สำเร็จ',
                                            text: "You Check sit success",
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
                                                $('#spinner-div').hide();//Request is complete so hide spinner
                                                    setTimeout(function(){
                                                        $("#overlay").fadeOut(300);
                                                    },500);
                                            }
                                        })
                                    } else {
                                        
                                    }

                                },
                            });
                        }
                })
            });
        });
    </script>
    @endsection
