@extends('layouts.personhealth')
@section('content')
<style>
    .layout-form1{
        margin-top: 20px;
        margin-bottom: 10px;
    }
    .input-style-font-center{
        font-family: 'Kanit', sans-serif; 
        font-size: 13px;
        font-weight:normal;
        text-align: center;
    }
    .input-style-font-left{
        font-family: 'Kanit', sans-serif; 
        font-size: 13px;
        font-weight:normal;
        margin-left: 10px;
    }
    .font-top{
        margin-top: 5px;
    }
    .font-content-form-add{
        font-family: 'Kanit', sans-serif; 
        font-size: 14px;
        margin-left: 20px;
    }
</style>
<div class="row">
    <div class="col-lg-10" style="margin-left: auto; margin-right:auto; margin-top:50px;">
        <div class="block block-rounded block-bordered">
            <div class="row" style="margin-top: 50px;">
                <div class="block-header block-header-default">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;" style="margin-top: 30px;"><B>เพิ่มข้อมูลการทดสอบสมรรถภาพ</B></h3>  
                </div>
            </div>
            <div class="row">
                <div class="block-content block-content-full" style="width: 100%; margin-top:30px; margin-left:auto; margin-right:auto;">
                    <div class="block-content">
                        <div class="row font-content-form-add">

                            
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <span>เลขที่บัตรประชาขน :</span>
                                        <span style="margin-lift: 10px;"><input type="text" class="form-control input-style-font-left" name="cardCode" id="cardCode" value="591610016-0" size="5px;"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <span>ชื่อ - นามสกุล : </span>
                                        <span><input type="text" class="form-control input-style-font-left" name="fullname" id="fullname" value="nipitphon wanprapa"></span>
                                    </div>
                                    <div class="col-md-3" style="margin-top: 20px;">
                                        <div class="row">
                                            <div class="col-2" style="margin-top: 10px;"><span>เพศ :</span></div>
                                            <div class="col-3"><span><input type="text" class="form-control input-md input-style-font"></span></div>
                                            <div class="col-2" style="margin-top: 10px;"><span>อายุ :</span></div>
                                            <div class="col-3">
                                                <span><input type="text" class="form-control input-sm input-style-font"></span>
                                            </div>
                                            <div class="col-2" style="margin-top: 10px;">ปี</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <span style="margin-left: 30px;">วันรับการตรวจ : </span>
                                        <span >
                                            <input type="date" class="form-control" name="day" id="day" value="20" style="width: 200px; margin-left:40px;">
                                        </span>
                                    </div>
                                </div>
                            </div>
            
            
                            <div class="col-md-12" style="margin-top: 50px;">
                                <div class="row">
                                    <div class="col-md-6" >
                                        <span>สัญญาณชีพ :</span>
                                    </div>
                                    <div class="col-md-6" >
                                        <span>สัดส่วนร่างกาย</span>
                                        <span>เส้นรอบเอว/สะโพก</span>
                                    </div>
            
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <span>หัวใจเต้น : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                            <span>ครั้ง/นาที</span>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span>ความดันโลหิต : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                            <span>มม. ปรอท</span>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span>ความจุปอด : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                            <span>มม.</span>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span>ความอ่อน : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                            <span>มม.</span>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="col-md-12" style="margin-top: 10px;">
                                            <div class="row">
                                                <span>สูง : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                        </div>
                                                    </div>
                                                </span>
                                                <span>หนัก : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                        </div>
                                                    </div>
                                                </span>
                                                <span>เอว : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                        </div>
                                                    </div>
                                                </span>
                                                <span>สะโพก : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" style="margin-top: 40px;">
                                        <span>Skin fold Caliper :</span>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                            <div class="row">
                                                <span>Bi : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                            <span>มม.</span>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span>Tri : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                            <span>มม.</span>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span>Subscu : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                            <span>มม.</span>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span>Supra : 
                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-md-6"><input type="text" class="form-control input-sm" size="7"></div>
                                                        <div class="col-md-6" style="margin-top:10px;">
                                                            <span>มม.</span>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
            
                            <div class="col-md-12" style="margin-top: 40px;">
                                <div class="row"  style="margin-top: 30px;">
                                    <div class="col-md-6">
                                        <div><span>ความอดทนของหัวและปอด</span></div>
                                        <div style="margin-top:30px; margin-left:15px;">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <span>หัวใจเต้น (ครั้ง/นาที)</span>
                                                    </div>
                                                    <div class="col-md">
                                                        <span style="margin-left: 60px;">นาที</span>
                                                        <span style="margin-left: 130px;">วินาที</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="row" style="margin-left: 30px;">
                                            <div class="form-inline" style="margin-top: 10px;">
                                                <div class="form-group mb-2">
                                                    <span>Rockport walk test :</span>
                                                </div>
                                                <div class="col-3 form-group mx-sm-3 mb-2">
                                                    <span style="margin-left: 60px;">
                                                        <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                                <div class="col-3 form-group mx-sm-3 mb-2">
                                                    <span style="margin-left: 60px;">
                                                        <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                            </div>
                
                                            <div class="form-inline" style="margin-top: 10px;">
                                                <div class="form-group mb-2">
                                                    <span>Rockport walk test :</span>
                                                </div>
                                                <div class="col-3 form-group mx-sm-3 mb-2">
                                                    <span style="margin-left: 60px;">
                                                        <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                                <div class="col-3 form-group mx-sm-3 mb-2">
                                                    <span style="margin-left: 60px;">
                                                        <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                            </div>
                
                                            <div class="form-inline" style="margin-top: 10px;">
                                                <div class="form-group mb-2">
                                                    <span>Step test :</span>
                                                </div>
                                                <div class="col-3 form-group mx-sm-3 mb-2">
                                                    <span style="margin-left: 120px;">
                                                    <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
            
                                    </div>
                                    <div class="col-md-6">
                                        <div style="margin-top: 10px;">
                                            <span>สมรรถภาพของกล้ามเนื้อ</span>
                                        </div>
                                        <div style="margin-top: 30px;">
                                            <div class="col-md-12">
                                                <div class="row text-center">
                                                    <div class="col-md-6"  >ความแข็งแรง</div>
                                                    <div class="col-md-6" >ความอดทน</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="margin-left: 30px;">
                                            <div class="form-inline" style="margin-top: 10px;">
                                                <div class="form-group mb-2">
                                                    <span>แรงบีบมือ :</span>
                                                </div>
                                                <div class="col-2 form-group mx-sm-3 mb-2">
                                                    <span style="margin-left: 30px;">
                                                        <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                                <div class="col-2 form-group mb-2">
                                                    <span style="margin-left: 30px;">ครั้ง</span>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <span style="margin-left: 35px;">วิคพื้น :</span>
                                                </div>
                                                <div class="col-2 form-group mx-sm-3 mb-2">
                                                    <span style="margin-left: 30px;">
                                                        <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                                <div class="col-2 form-group mb-2">
                                                    <span>ครั้ง</span>
                                                </div>
                                            </div>
                                            <div class="form-inline" style="margin-top: 10px;">
                                                <div class="form-group mb-2">
                                                    <span>แรงเหยียดขา :</span>
                                                </div>
                                                <div class="col-2 form-group mx-sm-3 mb-2">
                                                    <span style="margin-left: 10px;">
                                                        <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                                <div class="col-2 form-group mb-2">
                                                    <span style="margin-left: 10px;">ครั้ง</span>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <span style="margin-left: 20px;">งอตัว :</span>
                                                </div>
                                                <div class="col-2 form-group mx-sm-3 mb-2">
                                                    <span style="margin-left: 30px;">
                                                        <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                                <div class="col-2 form-group mb-2">
                                                    <span>ครั้ง</span>
                                                </div>
                                            </div>
                                            <div class="form-inline" style="margin-top: 10px;">
                                                <div class="form-group mb-2">
                                                    <span>แรงเหยียดแขน :</span>
                                                </div>
                                                <div class="col-2 form-group mx-sm-3 mb-2">
                                                    <span>
                                                        <input type="text" class="form-control input-style-font-center" size="5">
                                                    </span>
                                                </div>
                                                <div class="col-2 form-group mb-2">
                                                    <span>กก.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
            
                            <div class="col-md-10 text-center" style="margin-top: 30px; margin-left:auto; margin-right:auto;">
                                <div class="row">
                                    <span style="margin-left: 1000px; margin-right:10px;">
                                        <button type="button" class="btn btn-hero-sm btn-hero-info btn-submit-save">
                                        <i class="fas fa-save"></i> บันทึกข้อมูล </button>
                                    </span>
                                    <span>
                                        <button type="button" class="btn btn-hero-sm btn-hero-danger">
                                            <i class="fas fa-window-close"></i> ยกเลิก </button>
                                    </span>
                                </div>
                            </div>
            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection