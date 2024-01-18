@extends('layouts.backend')

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


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
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforperson -> HR_PREFIX_NAME }}   {{ $inforperson -> HR_FNAME }}  {{ $inforperson -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <div class="row">

                                <div>
                                                <a href="{{ url('person_work/carcalendarhealth/'.$inforpersonid -> ID)}}"  class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ปฎิทิน</a>
                                        </div>
                                        <div>&nbsp;</div>
                                   
                                        <div>
                                        <a href="{{ url('person_work/personworkscreening/checkup/'.$inforpersonid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสุขภาพประจําปี</a>
                                        </div>
                                        <div>&nbsp;</div>
                               
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการตรวจสมถรรภาพประจำปี {{$infocapacity->CAPACITY_YEAR}}</B></h3>
                            
                        </div>

           
                <div class="block-content">    

                <div class="row" align="left">  

                 
                   
                    <div class="col-sm-6">
                            <div class="row">
                            <div class="col-sm-4">
                            ส่วนสูง 
                            </div>
                            <div class="col-sm-6">
                            {{$infocapacity->CAPACITY_HEIGHT}}
                            </div>
                            <div class="col-sm-2">
                           ซ.ม.
                             </div>
                            </div> 
                     </div>  

                    <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-4">
                            น้ำหนัก 
                            </div>
                            <div class="col-sm-6">
                            {{$infocapacity->CAPACITY_WEIGHT}}
                            </div>
                            <div class="col-sm-2">
                             กก. 
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
                   <td>{{$infocapacity->CAPACITY_HEARTRATE_RESULT}} &nbsp;&nbsp;ครั้ง/นาที</td>
                   <td>{{$infocapacity->CAPACITY_HEARTRATE_LEVEL}}</td>
                   <td>{{$infocapacity->CAPACITY_HEARTRATE_AVG}}</td>
                   <td>{{$infocapacity->CAPACITY_HEARTRATE_NOMAL}}</td>
                   </tr>
                   <tr>
                   <td>ความดันโลหิต</td>
                   <td>{{$infocapacity->CAPACITY_BLOOD_RESULT}} &nbsp;&nbsp;มม./ปรอท</td>
                   <td>{{$infocapacity->CAPACITY_BLOOD_LEVEL}} </td>
                   <td>{{$infocapacity->CAPACITY_BLOOD_AVG}} </td>
                   <td>{{$infocapacity->CAPACITY_BLOOD_NOMAL}}</td>
                   </tr>

                   <td colspan="5"><B>สัดส่วนร่างกาย</B></td> 
                   <tr>
                   <td>ดัชนีมวลกาย</td>
                   <td>{{$infocapacity->CAPACITY_BODY_RESULT}} &nbsp;&nbsp; กก./ตร.ม</td>
                   <td>{{$infocapacity->CAPACITY_BODY_LEVEL}} </td>
                   <td>{{$infocapacity->CAPACITY_BODY_AVG}} </td>
                   <td>{{$infocapacity->CAPACITY_BODY_NOMAL}}</td>
                   </tr>
                   <tr>
                   <td>เส้นรอบเอว/สะโพก</td>
                   <td>{{$infocapacity->CAPACITY_WAISTLINE_RESULT}}</td>
                   <td>{{$infocapacity->CAPACITY_WAISTLINE_LEVEL}}</td>
                   <td>{{$infocapacity->CAPACITY_WAISTLINE_AVG}} </td>
                   <td>{{$infocapacity->CAPACITY_WAISTLINE_NOMAL}} </td>
                   </tr>
                   <tr>
                   <td>ปริมาณไขมันในร่างกาย</td>
                   <td>{{$infocapacity->CAPACITY_FAT_RESULT}}</td>
                   <td>{{$infocapacity->CAPACITY_FAT_LEVEL}}</td>
                   <td>{{$infocapacity->CAPACITY_FAT_AVG}} </td>
                   <td>{{$infocapacity->CAPACITY_FAT_NOMAL}} </td>
                   </tr>
                   <tr>
                   <td>ความจุปอด</td>
                   <td>{{$infocapacity->CAPACITY_FAT_NOMAL}}</td>
                   <td>{{$infocapacity->CAPACITY_LUNG_LEVEL}}</td>
                   <td>{{$infocapacity->CAPACITY_LUNG_AVG}} </td>
                   <td>{{$infocapacity->CAPACITY_LUNG_NOMAL}} </td>
                   </tr>
                   <td colspan="5"><B>ความแข็งแรงของกล้ามเนื้อ</B></td> 
                   <tr>
                   <td>แรงบีบมือ</td>
                   <td>{{$infocapacity->CAPACITY_HAND_RESULT}}&nbsp;&nbsp;กก./นน.ตัว</td>
                   <td>{{$infocapacity->CAPACITY_HAND_LEVEL}}</td>
                   <td>{{$infocapacity->CAPACITY_HAND_AVG}}</td>
                   <td></td>
                   </tr>
                   <tr>
                   <td>แรงเหยียดขา</td>
                   <td>{{$infocapacity->CAPACITY_LEG_RESULT}}&nbsp;&nbsp;กก./นน.ตัว</td>
                   <td>{{$infocapacity->CAPACITY_LEG_LEVEL}}</td>
                   <td>{{$infocapacity->CAPACITY_LEG_AVG}} </td>
                   <td></td>
                   </tr>
                   <td colspan="5"><B>ความอ่อนตัว</B></td> 
                   <tr>
                   <td>นั่งงอตัวไปข้างหน้า</td>
                   <td>{{$infocapacity->CAPACITY_CULEDUP_RESULT}}&nbsp;&nbsp;ซม.</td>
                   <td>{{$infocapacity->CAPACITY_CULEDUP_LEVEL}}</td>
                   <td>{{$infocapacity->CAPACITY_CULEDUP_AVG}}</td>
                   <td></td>
                   </tr>
                   </tbody>
                  </table>

              <div align = 'right' >
                  <a href="{{ url('person_work/personworkability/'.$infocapacity->CAPACITY_PERSON_ID)  }}" class="btn btn-secondary" >ปิดหน้าต่าง</a>
      
             </div>   
             <br>  
             <br>        

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
  $('#edit_modal').on('show.bs.modal', function(e) {
    var Id = $(e.relatedTarget).data('id');
    var VUTId = $(e.relatedTarget).data('vutid');
    $(e.currentTarget).find('input[name="ID"]').val(Id);
    $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);

});

</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker3').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});

  
</script>



@endsection