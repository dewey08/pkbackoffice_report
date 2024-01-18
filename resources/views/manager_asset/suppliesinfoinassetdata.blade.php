@extends('layouts.asset')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

@section('content')

<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 



?>

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

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    @media only screen and (min-width: 1200px) {
        label {
            float: right;
        }

    }


    .text-pedding {
        padding-left: 10px;
    }

    .text-font {
        font-size: 13px;
    }
    }
</style>

<center>
    <div class="block" style="width: 95%;">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลครุภัณฑ์</B></h3>

        </div>
        <div class="block-content block-content-full" align="left">

            <div class="row">

                <div class="col-lg-4" align="center">
                    <div class="form-group">

                       
                    @if ($infosupplie->IMG == Null )
                            <img id="image_upload_preview" src="{{asset('image/default.jpg')}}" alt="กรุณาเพิ่มรูปภาพ" height="150px" width="150px"/>
                    @else
                            <img id="image_upload_preview" src="data:image/png;base64,{{ chunk_split(base64_encode($infosupplie->IMG)) }}" height="150px" width="150px"> 
                    @endif


                    </div>

                </div>

                <div class="col-sm-8">

                    <div class="row">
                        <div class="col-lg-2">
                            <label>เลขครุภัณฑ์:</label>
                        </div>
                        <div class="col-lg-4">
                            {{$infosupplie->SUP_FSN_NUM}}
                        </div>
                        <div class="col-lg-2">
                            <label>ชื่อครุภัณฑ์ :</label>
                        </div>
                        <div class="col-lg-4">
                            {{$infosupplie->SUP_NAME}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <label>ลักษณะ:</label>
                        </div>
                        <div class="col-lg-4">
                            {{$infosupplie->SUP_PROP}}
                        </div>
                        <div class="col-lg-2">
                            <label>รายละเอียด :</label>
                        </div>
                        <div class="col-lg-4">
                            {{$infosupplie->CONTENT}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <label>ราคากลาง:</label>
                        </div>
                        <div class="col-lg-4">
                            {{$infosupplie->PRICE_CENTER}}
                        </div>
                        <div class="col-lg-2">
                            <label>ประเภทค่าเสื่อม :</label>
                        </div>
                        <div class="col-lg-4">
                            {{$infosupplie->DECLINE_NAME}}
                        </div>
                    </div>

                </div>
            </div>

            <div class="row push">
                <div class="col-lg-12">
                    <!-- Block Tabs Default Style -->
                    <div class="block block-rounded block-bordered">
                        <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist"
                            style="background-color: #FFEBCD;">
                            <li class="nav-item">

                                <a class="nav-link active" href="#object1"
                                    style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ครุภัณฑ์</a>

                            </li>

                        </ul>
                        <div class="block-content tab-content">

                            <div class="tab-pane active" id="object1" role="tabpanel">

                                <a href="{{ url('manager_asset/suppliesinfoarticle_suppliesinfo_add/'.$infosupplie->ID)  }}"
                                    class="btn btn-hero-sm btn-hero-info"
                                    ><i class="fas fa-plus"></i> เพิ่มครุภัณฑ์</a>
                                <br><br>

                                <div id="detail_accessory">
                                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple"
                                        style="width: 100%;">
                                        <thead style="background-color: #99CCFF;">
                                            <tr height="40">
                                                <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"
                                                    width="5%">ลำดับ</th>
                                                <th class="text-font"
                                                    style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"
                                                    width="10%">เลขครุภัณฑ์</th>
                                                <th class="text-font"
                                                    style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"
                                                    width="5%">วันที่รับเข้า</th>
                                                <th class="text-font"
                                                    style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"
                                                    width="18%">ประเภทครุภัณฑ์</th>
                                                <th class="text-font"
                                                    style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">
                                                    ชื่อ</th>
                                                <th class="text-font"
                                                    style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"
                                                    width="8%"> ประจำอยู่หน่วยงาน</th>
                                                <th class="text-font"
                                                    style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"
                                                    width="8%">ความเสี่ยง</th>
                                                <th class="text-font"
                                                    style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"
                                                    width="8%">การเบิกใช้</th>

                                                <th class="text-font" style="border-color:#F0FFFF;text-align: center;"
                                                    width="12%">คำสั่ง</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $number = 0; ?>
                                            @foreach ($infosupplieinassets as $infosupplieinasset)
                                            <?php $number++; ?>
                                            <tr height="20">
                                                <td class="text-font" align="center">{{$number}}</td>
                                                <td class="text-font text-pedding">{{$infosupplieinasset->ARTICLE_NUM}}
                                                </td>
                                                <td class="text-font" align="center">
                                                    {{ DateThai($infosupplieinasset->RECEIVE_DATE) }}</td>
                                                <td class="text-font text-pedding">
                                                    {{ $infosupplieinasset->DECLINE_NAME }}</td>
                                                <td class="text-font text-pedding">
                                                    {{ $infosupplieinasset->ARTICLE_NAME }}</td>
                                                <td class="text-font text-pedding">
                                                    {{ $infosupplieinasset->HR_DEPARTMENT_SUB_SUB_NAME }}</td>

                                                @if( $infosupplieinasset->RISK_TYPE_ID == '0')
                                                <td align="center"><span class="badge badge-info">ต่ำ</span></td>
                                                @elseif($infosupplieinasset->RISK_TYPE_ID== '1')
                                                <td align="center"><span class="badge badge-success">กลาง</span></td>
                                                @elseif($infosupplieinasset->RISK_TYPE_ID == '2')
                                                <td align="center"><span class="badge badge-danger">สูง</span></td>
                                                @else
                                                <td align="center"></td>
                                                @endif

                                                @if( $infosupplieinasset->OPENS == 'True')
                                                <td class="text-font" align="center"><span
                                                        class="btn btn-success"><i class="fa-xs fa fa-check"></i></span></td>
                                                @else
                                                <td class="text-font" align="center"></td>

                                                @endif

                                                <td align="center">
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn btn-outline-info dropdown-toggle"
                                                            id="dropdown-align-outline-info" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                            ทำรายการ
                                                        </button>
                                                        <div class="dropdown-menu" style="width:10px">
                                                            <a class="dropdown-item"
                                                                href="{{ url('manager_asset/suppliesinfoarticle_suppliesinfo_edit/'.$infosupplie->ID.'/'.$infosupplieinasset->ARTICLE_ID)  }}"
                                                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a>
                                                            <a class="dropdown-item" href="#detail_FSNNUM"
                                                                data-toggle="modal"
                                                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"
                                                                onclick="CREATE_FSNNUM({{$infosupplieinasset->ARTICLE_ID}});"><i class="fas fa-copy text-success mr-2"></i>คัดลอกข้อมูล</a>
                                                            <a class="dropdown-item"
                                                                href="{{ url('manager_asset/suppliesinfo/destroysuppliesinfoinassetsub/'.$infosupplie->ID.'/'.$infosupplieinasset->ARTICLE_ID)  }}"
                                                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"
                                                                onclick="return confirm('ต้องการที่ลบข้อมูล {{$infosupplieinasset->ARTICLE_NUM}} ?')"><i class="fas fa-trash-alt text-danger mr-2"></i>ลบ</a>

                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- editaccessory -->

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                </div>

                                <div id="detail_FSNNUM" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <div class="row">
                                                    <div>
                                                        <h3 style="font-family: 'Kanit', sans-serif;">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;กำหนดเลข FSN รายการคัดลอก&nbsp;&nbsp;</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body">

                                                <body>

                                                    <form  method="post" action="{{ route('massete.detailfsn_save') }}" >
                                                        @csrf

                                                    <div id="detailfsn"></div>

                                            </div>
                                            <div class="modal-footer">
                                                <div align="right">
                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึก</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"
                                                        data-dismiss="modal"
                                                        >ยกเลิก</button>
                                                </div>
                                            </div>
                                            </form>
                                            </body>

                                        </div>
                                    </div>
                                </div>

                                @endsection

                                @section('footer')

                                <script
                                    src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}">
                                </script>
                                <script>
                                    jQuery(function() {
                                        Dashmix.helpers(['masked-inputs']);
                                    });
                                </script>

                                <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
                                <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}"
                                    charset="UTF-8"></script>

                                <!-- Page JS Plugins -->
                                <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}">
                                </script>
                                <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}">
                                </script>
                                <script
                                    src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}">
                                </script>
                                <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}">
                                </script>
                                <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}">
                                </script>
                                <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}">
                                </script>
                                <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}">
                                </script>
                                <!-- Page JS Code -->
                                <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

                                <script>
                                    function CREATE_FSNNUM(id) {
                                        $.ajax({
                                            url: "{{route('massete.detailfsn')}}",
                                            method: "GET",
                                            data: {
                                                id: id
                                            },
                                            success: function(result) {
                                                $('#detailfsn').html(result);
                                              
                                            }
                                        })
                                    }
                                </script>
                                @endsection