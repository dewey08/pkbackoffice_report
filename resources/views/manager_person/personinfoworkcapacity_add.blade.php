@extends('layouts.personhealth')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />


@section('content')

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

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
        
      }

       .text-pedding{
   padding-left:10px;
}

.text-font {
    font-size: 13px;
}   

.form-control {
    font-size: 13px;
}   
</style>
<script>
function checklogin(){
 window.location.href = '{{route("index")}}'; 
}
</script>
<?php

if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;   
}else{
    
    echo "<body onload=\"checklogin()\"></body>";
    exit();
} 

$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 

?>
           
           <br>
           <br>
        <center>
                   
                <div style="width:95%;" >
          <div class="block block-rounded block-bordered">
          <div class="block-content">  


          <div class="table-responsive">      

          <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการตรวจสมรรถภาพประจำปีของ {{$infouser->HR_FNAME}} {{$infouser->HR_LNAME}}</B></h3>

            </div>
            <br>

           

        <form  method="post" action="{{route('mperson.capacity_save')}}" enctype="multipart/form-data">
        @csrf

            <input type="hidden" name = "CAPACITY_PERSON_ID"  id="CAPACITY_PERSON_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infouser->ID}}">
            <input type="hidden" name = "IDREF"  id="IDREF" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infouser->ID}}">
             
              
               <div class="row" align="left">  

                    <div class="col-sm-3 text-left">
                    <div class="row">
                            <div class="col-sm-6">
                              ปีงบประมาณ 
                            </div>
                            <div class="col-sm-6">
                                <select name="CAPACITY_YEAR" id="TYPE_SCORE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                            
                                            <option value="2563">2563</option>                   
                                            <option value="2562">2562</option>                 
                                          
                                    </select> 
                             </div>
                             </div>
                    </div>      
                    <div class="col-sm-2">
                            <div class="row">
                            <div class="col-sm-4">
                            ส่วนสูง 
                            </div>
                            <div class="col-sm-6">
                            <input  name = "CAPACITY_HEIGHT"  id="CAPACITY_HEIGHT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                            </div>
                            <div class="col-sm-2">
                           ซ.ม.
                             </div>
                            </div> 
                     </div>  

                    <div class="col-sm-2">
                          <div class="row">
                            <div class="col-sm-4">
                            น้ำหนัก 
                            </div>
                            <div class="col-sm-6">
                            <input  name = "CAPACITY_WEIGHT"  id="CAPACITY_WEIGHT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                            </div>
                            <div class="col-sm-2">
                             กก. 
                             </div>
                          </div> 
                    </div> 

                  

                    <div class="col-sm-2">
                          <div class="row">
                            <div class="col-sm-5">
                            วันที่ทดสอบ 
                            </div>
                            <div class="col-sm-7">
                            <input name="CAPACITY_TEST_DATE" id="CAPACITY_TEST_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" value="{{formate(date('Y-m-d'))}}"  readonly>
                            </div>
                          </div> 
                    </div>     
                 
                 </div>
                <br>
                  <table class="table gwt-table table-striped table-vcenter">
                  <thead>
                  
                   <tr>
                      <th>ประเภท</th>
                      <th>ผลการทดสอบ</th>
                      <th>ระดับสมรรถภาพ</th>
                      <th>ค่าเฉลี่ย</th>
                      <th>ค่าปกติ</th>
                    </tr>
                   </tr>
                   </thead>
                   <tbody>
                  
                   <tr>
                     <td colspan="5"><B>สัญญาณชีพ</B></td> 
                    
                   </tr> 
                   <tr>
                   <td>อัตตราการเต้นหัวใจขณะพัก</td>
                 
                   <td> 
                   <div class="row">
                      <div class="col-sm-8">
                   
                              <input  name = "CAPACITY_HEARTRATE_RESULT"  id="CAPACITY_HEARTRATE_RESULT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                          </div>
                            <div class="col-sm-4">
                                ครั้ง/นาที
                            </div>
                        </div>
                   </td>

                   <td><input  name = "CAPACITY_HEARTRATE_LEVEL"  id="CAPACITY_HEARTRATE_LEVEL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   <td><input  name = "CAPACITY_HEARTRATE_AVG"  id="CAPACITY_HEARTRATE_AVG" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"></td>
                   <td><input  name = "CAPACITY_HEARTRATE_NOMAL"  id="CAPACITY_HEARTRATE_NOMAL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   </tr>
                   <tr>
                   <td>ความดันโลหิต</td>
                  
                   <td>
                   <div class="row">
                      <div class="col-sm-8">
                   <input  name = "CAPACITY_BLOOD_RESULT"  id="CAPACITY_BLOOD_RESULT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > 
                   </div>
                      <div class="col-sm-4">
                   มม./ปรอท
                   </div>
                        </div>
                   </td>
                   <td><input  name = "CAPACITY_BLOOD_LEVEL"  id="CAPACITY_BLOOD_LEVEL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td><input  name = "CAPACITY_BLOOD_AVG"  id="CAPACITY_BLOOD_AVG" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td><input  name = "CAPACITY_BLOOD_NOMAL"  id="CAPACITY_BLOOD_NOMAL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   </tr>

                   <td colspan="5"><B>สัดส่วนร่างกาย</B></td> 
                   <tr>
                   <td>ดัชนีมวลกาย</td>
                   <td>
                   <div class="row">
                      <div class="col-sm-8">
                      <input  name = "CAPACITY_BODY_RESULT"  id="CAPACITY_BODY_RESULT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                      </div>
                      <div class="col-sm-4">
                        กก./ตร.ม
                        </div>
                        </div>
                    
                    </td>
                   <td><input  name = "CAPACITY_BODY_LEVEL"  id="CAPACITY_BODY_LEVEL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td><input  name = "CAPACITY_BODY_AVG"  id="CAPACITY_BODY_AVG" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td><input  name = "CAPACITY_BODY_NOMAL"  id="CAPACITY_BODY_NOMAL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   </tr>
                   <tr>
                   <td>เส้นรอบเอว/สะโพก</td>
                   <td><input  name = "CAPACITY_WAISTLINE_RESULT"  id="CAPACITY_WAISTLINE_RESULT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   <td><input  name = "CAPACITY_WAISTLINE_LEVEL"  id="CAPACITY_WAISTLINE_LEVEL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td><input  name = "CAPACITY_WAISTLINE_AVG"  id="CAPACITY_WAISTLINE_AVG" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td><input  name = "CAPACITY_WAISTLINE_NOMAL"  id="CAPACITY_WAISTLINE_NOMAL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   </tr>
                   <tr>
                   <td>ปริมาณไขมันในร่างกาย</td>
                   <td><input  name = "CAPACITY_FAT_RESULT"  id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"></td>
                   <td><input  name = "CAPACITY_FAT_LEVEL"  id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   <td><input  name = "CAPACITY_FAT_AVG"  id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td><input  name = "CAPACITY_FAT_NOMAL"  id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   </tr>
                   <tr>
                   <td><B>ความจุปอด</B></td>
                   <td><input  name = "CAPACITY_LUNG_RESULT"  id="CAPACITY_LUNG_RESULT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   <td><input  name = "CAPACITY_LUNG_LEVEL"  id="CAPACITY_LUNG_LEVEL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   <td><input  name = "CAPACITY_LUNG_AVG"  id="CAPACITY_LUNG_AVG" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td><input  name = "CAPACITY_LUNG_NOMAL"  id="CAPACITY_LUNG_NOMAL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   </tr>
                   <td colspan="5"><B>ความแข็งแรงของกล้ามเนื้อ</B></td> 
                   <tr>
                   <td><B>แรงบีบมือ</B></td>
                   <td>
                   <div class="row">
                      <div class="col-sm-8">
                        <input  name = "CAPACITY_HAND_RESULT"  id="CAPACITY_HAND_RESULT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                        </div>
                        <div class="col-sm-4">
                        กก./นน.ตัว
                        </div>
                      </div>
                   
                   </td>

                   <td><input  name = "CAPACITY_HAND_LEVEL"  id="CAPACITY_HAND_LEVEL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td><input  name = "CAPACITY_HAND_AVG"  id="CAPACITY_HAND_AVG" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td></td>
                   </tr>
                   <tr>
                   <td><B>แรงเหยียดขา</B></td>
                   <td>
                   <div class="row">
                      <div class="col-sm-8">
                        <input  name = "CAPACITY_LEG_RESULT"  id="CAPACITY_LEG_RESULT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;">
                      </div>
                      <div class="col-sm-4">
                        กก./นน.ตัว
                        </div>
                      </div>
                   
                   </td>
                   <td><input  name = "CAPACITY_LEG_LEVEL"  id="CAPACITY_LEG_LEVEL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   <td><input  name = "CAPACITY_LEG_AVG"  id="CAPACITY_LEG_AVG" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" > </td>
                   <td></td>
                   </tr>
                   <td colspan="5"><B>ความอ่อนตัว</B></td> 
                   <tr>
                   <td><B>นั่งงอตัวไปข้างหน้า</B></td>
                   <td>

                   <div class="row">
                      <div class="col-sm-8">
                      <input  name = "CAPACITY_CULEDUP_RESULT"  id="CAPACITY_CULEDUP_RESULT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                      </div>
                      <div class="col-sm-4">
                      ซม.
                      </div>

                   </div>

                   </td>
                   <td><input  name = "CAPACITY_CULEDUP_LEVEL"  id="CAPACITY_CULEDUP_LEVEL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   <td><input  name = "CAPACITY_CULEDUP_AVG"  id="CAPACITY_CULEDUP_AVG" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" ></td>
                   <td></td>
                   </tr>
                   </tbody>
                  </table>

                 

                  <div align="right">
                        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;" >บันทึก</button>
                        <a href="{{ url('manager_person/capacity/'.$infouser->ID)  }}" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
                  </div>

             <br>  
             <br>        
             </form>
@endsection
@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });
</script>
@endsection