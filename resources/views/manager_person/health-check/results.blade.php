@extends('layouts.personhealth')
<style>
    .font-content{
        font-family: 'Kanit', sans-serif; 
        font-size: 14px;
        font-weight:normal;
    }
    .tap-span{
        margin-top:20px;
        margin-bottom: 10px;
    }
    .layout-form1-right{
        margin-left:120px;
    }
    .layout-input-form-left{
        margin-left:20px;
        margin-right:20px;
        width: 3;
    }
    
    #inputTextCenter{
        text-align: center;
    }
    .layout-form1{
        margin-top: 20px;
        margin-bottom: 10px;
    }
    .input-style-font-center{
        font-family: 'Kanit', sans-serif; 
        font-size: 14px;
        font-weight:normal;
        text-align: center;
    }
    .input-style-font-left{
        font-family: 'Kanit', sans-serif; 
        font-size: 14px;
        font-weight:normal;
        margin-left: 10px;
    }
    .font-top{
        margin-top: 5px;
    }
    .font-content-day{
        font-family: 'Kanit', sans-serif; 
        font-size: 14px;
    }

</style>
@section('content')
<div class="row">
    <?php 
    $day = date("d");
    $month = date("m");
    $year = (date("Y")+543); 
?><br><br><br>
    <div class="col-md-10" style="margin-left:auto;margin-rigth:auto;">
        <div class="block block-header block-rounded block-bordered" style="margin-left: auto; margin-right:auto;">
            <div class="block-title" style="margin-top:50px;">
                <span style="margin-top:50px;"><b>ข้อมูลการทดสอบสมรรถภาพ</b></span>
                <span>:</span>
                <span class="font-content-day">วันที่บันทึก <?php echo $day."/".$month."/".$year; ?></span>
            </div>
        </div>
        <div class="font-content" style="margin-left:auto;margin-rigth:auto;">
            <div class="col-md-10" style="height: 150px;">
                <div class="row">
                    <div class="col-md-6" style="background-color: #ffcccc;">
                        <div class="form-inline" style="margin-top: 20px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6 form-group mb-2">
                                        <span>เลขที่บัตรประขาชน :</span>
                                    </div>
                                    <div class="col-6 form-group mx-sm-3 mb-2">
                                        <span style="margin-left: 30px;">
                                            <input type="text" class="form-control font-content" size="50" value="1409901241582">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="background-color: #ffcccc;">
                        <div class="form-inline" style="margin-top: 20px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6 form-group mb-2">
                                        <span>ชื่อ - นามสกุล :</span>
                                    </div>
                                    <div class="col-6 form-group mx-sm-3 mb-2">
                                        <span style="margin-left: 30px;">
                                            <input type="text" class="form-control input-style-font-left" size="50" value="นิพิฐพนธ์ วรรณประภา">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="background-color: #ffcccc; height:70px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-2">
                                        <span>
                                            ส่วนสูง :
                                        </span>
                                    </div>
                                    <div class="col-2">
                                        <span >
                                            <input type="text" class="form-control input-style-font-center">
                                        </span>
                                    </div>
                                    <div class="col">
                                        <span>เซนติเมตร</span>
                                    </div>
                                    <div class="col-2">
                                        <span>น้ำหนัก :</span>
                                    </div>
                                    <div class="col-2"><input type="text" class="form-control input-style-font-center"></div>
                                    <div class="col">
                                        <span>กิโลกรัม</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-1">
                                        <span style="margin-left: 30px;">
                                            เพศ
                                        </span>
                                    </div>
                                    <div class="col-2">
                                        <span >
                                            <input style="margin-left: 30px;" type="text" class="form-control input-style-font-center">
                                        </span>
                                    </div>
                                    <div class="col-1" style="margin-left: 30px;">อายุ</div>
                                    <div class="col-2"><input style="margin-left: 30px;" type="text" class="form-control input-style-font-center"></div>
                                    <div class="col-1" style="margin-left: 30px;">ปี</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10" style="margin-top:0px; background-color: #fff5cc;">
                <span style="margin-top: 30px;"><br><b>ความอดทนของหัวใจและปอด</b></span>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <span>หัวใจเต้น(ครั้ง/นาที)</span>
                    </div>
                    <div class="col-md-3">
                        <span style="margin-left: 30px;">เวลา (นาที : วินาที)</span>
                    </div>
                    <div class="col-md-3">
                        <span style="margin-left: 30px;">VO2 max(มล./กก./นาที)</span>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <span>Rockport walk test :</span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" class="form-control" width="5" id="inputTextCenter"></span>
                    </div>
                    <div class="col-md-3 form-inline" style="margin-left: 210px;">
                        <span><input type="text" size="3" class="form-control" id="inputTextCenter"></span>
                        <span style="margin-left: 15px;"><input type="text" size="3" class="form-control" id="inputTextCenter"></span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" size="5" id="inputTextCenter" class="form-control" style="margin-left: 60px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <span>UKK walk test :</span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" class="form-control" width="5" id="inputTextCenter"></span>
                    </div>
                    <div class="col-md-3 form-inline" style="margin-left: 210px;">
                        <span><input type="text" size="3" class="form-control" id="inputTextCenter"></span>
                        <span style="margin-left: 15px;"><input type="text" size="3" class="form-control" id="inputTextCenter"></span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" size="5" id="inputTextCenter" class="form-control" style="margin-left: 60px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <span>Step test :</span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" class="form-control" width="5" id="inputTextCenter"></span>
                    </div>
                    <div class="col-md-3 form-inline" style="margin-left: 210px;">
                        <span><input type="text" size="3" class="form-control" id="inputTextCenter"></span>
                        <span style="margin-left: 15px;"><input type="text" size="3" class="form-control" id="inputTextCenter"></span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" size="5" id="inputTextCenter" class="form-control" style="margin-left: 60px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <span>วิ่ง/เดิน 2.4 กิโลเมตร :</span>
                    </div>
                    <div class="col-md-1">
                        {{-- <span><input type="text" class="form-control" width="5" id="inputTextCenter"></span> --}}
                    </div>
                    <div class="col-md-3 form-inline" style="margin-left: 210px;">
                        <span><input type="text" size="3" class="form-control" id="inputTextCenter"></span>
                        <span style="margin-left: 15px;"><input type="text" size="3" class="form-control" id="inputTextCenter"></span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" size="5" id="inputTextCenter" class="form-control" style="margin-left: 60px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <span>จักรยานวัดงาน :</span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" class="form-control" width="5" id="inputTextCenter"></span>
                    </div>
                    <div class="col-md-3 form-inline" style="margin-left: 210px;">
                        {{-- <span><input type="text" size="3" class="form-control" id="inputTextCenter"></span>
                        <span style="margin-left: 15px;"><input type="text" size="3" class="form-control" id="inputTextCenter"></span> --}}
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" size="5" id="inputTextCenter" class="form-control" style="margin-left: 60px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <span>วิ่ง 12 นาที :</span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" class="form-control" width="5" id="inputTextCenter"></span>
                    </div>
                    <div class="col-md-3 form-inline" style="margin-left: 210px;">
                        <span>เมตร</span>
                    </div>
                    <div class="col-md-1">
                        <span><input type="text" size="5" id="inputTextCenter" class="form-control" style="margin-left: 60px;"></span>
                    </div>
                </div>
                <div class="row" style="margin-top: 30px; background-color:rgb(231, 225, 141);">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <span style="font-size: 16px;margin-left:100px;">
                            <b>ระดับสมรรถภาพ</b> 
                        </span>
                        <span class="layout-form1-right" style="font-size: 16px;">
                            <b>ค่าเฉลี่ย/ค่าปกติ</b>
                        </span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-top">สัญญาณชีพ หัวใจเต้นขณะพัก :</span>
                                </div>
                                <div class="col-2"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-3">
                                    <span>ครั้ง/นาที</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span style="margin-left:140px;">ต่ำ</span>
                        <span style="margin-left:180px;">68-70 ไม่เกิน 100</span>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-top">ความดันโลหิต :</span>
                                </div>
                                <div class="col-2"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-3">
                                    <span>มม. ปรอท</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span style="margin-left:140px;">ปกติ</span>
                        <span style="margin-left:180px;">ไม่เกิน 140/90</span>
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-top">สัดส่วนร่างการ BMI  :</span>
                                </div>
                                <div class="col-2"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-3">
                                    <span>กก./ตร.ม.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span style="margin-left:110px;">น้ำหนักเกิน/ท้วม</span>
                        <span style="margin-left:160px;">18.5-24.9</span>
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-top">เส้นรอบเอวต่อสะโพก  :</span>
                                </div>
                                <div class="col-2"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-3">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span style="margin-left:100px;">ความเสี่ยงปานกลาง</span>
                        <span style="margin-left:150px;">ไม่เกิน1</span>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-top">ปริมาณไขมันในร่างกาย  :</span>
                                </div>
                                <div class="col-2"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-3">
                                    <span>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span style="margin-left: 120px;">ปานกลาง</span>
                        <span style="margin-left: 180px;">22.0-25.0</span>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-top">ความจุปอด :</span>
                                </div>
                                <div class="col-2"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-3">
                                    <span>มิลลิลิตร/กก.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span style="margin-left: 120px;">ปานกลาง</span>
                        <span style="margin-left: 180px;">39.6-48.0</span>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <span>ความอ่อนตัว</span>
                                    <span class="font-top">นั่งงอตัวไปข้างหน้า :</span>
                                </div>
                                <div class="col-2"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-3">
                                    <span>ชม.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span style="margin-left: 160px;">ต่ำ</span>
                        <span style="margin-left: 180px;">5 - 12</span>
                    </div>
                </div>

                <div class="row" style="margin-top: 40px; background-color:rgb(231, 225, 141);">
                    <span style="margin-left: 15px;"><b>สมรรถภาพของกล้ามเนื้อ</b></span>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-3">
                        <span>ความแข็งแรง</span>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-4">
                                    <span class="font-top">แรงบีบมือ  :</span>
                                </div>
                                <div class="col-4"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-4">
                                    <span>กก./กก.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span style="margin-left: 50px;">ต่ำมาก</span>
                        <span style="margin-left: 140px;">0.61 - 0.71</span>
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-3">
                        <span></span>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-4">
                                    <span class="font-top">แรงเหยียดขา  :</span>
                                </div>
                                <div class="col-4"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-4">
                                    <span>กก./กก.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span style="margin-left: 50px;">ต่ำมาก</span>
                        <span style="margin-left: 140px;">0.61 - 0.71</span>
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-3">
                        <span></span>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-4">
                                    <span class="font-top">แรงเหยียดแขน  :</span>
                                </div>
                                <div class="col-4"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-4">
                                    <span>กก./กก.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span style="margin-left: 50px;">ต่ำมาก</span>
                        <span style="margin-left: 140px;">0.61 - 0.71</span>
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-3">
                        <span>ตวามอดทน</span>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-4">
                                    <span class="font-top">วิคพื้น  :</span>
                                </div>
                                <div class="col-4"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-4">
                                    <span>ครั้ง</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span style="margin-left: 50px;">ต่ำมาก</span>
                        <span style="margin-left: 140px;">0.61 - 0.71</span>
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-3">
                        <span></span>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-4">
                                    <span class="font-top">งอตัว  :</span>
                                </div>
                                <div class="col-4"><input type="text" class="form-control input-sm input-style-font-center"></div>
                                <div class="col-4">
                                    <span>ครั้ง</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span style="margin-left: 50px;">ต่ำมาก</span>
                        <span style="margin-left: 140px;">0.61 - 0.71</span>
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div class="row" style="height: 100px;">
                    <span style="margin-left: 1000px; margin-right:10px; margin-top:30px;">
                        <button type="button" class="btn btn-hero-sm btn-hero-danger">
                            <i class="fas fa-window-close"></i> ยกเลิก </button>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection