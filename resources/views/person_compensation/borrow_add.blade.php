@extends('layouts.backend')    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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
        .form-control{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
                }
    label{
                font-family: 'Kanit', sans-serif;
                font-size: 14px;            
        }  
        input::-webkit-calendar-picker-indicator{   
        font-family: 'Kanit', sans-serif;
                font-size: 14px; 
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
<?php 
    $datenow = date('Y-m-d');
?>  

<body onload="run01();">
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div >
                                <a href="{{ url('person_compensation/dashboard/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                        <a href="{{ url('person_compensation/cominfosalary/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">         
                                        ข้อมูลเงินเดือน
                                        </a>
                                    </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_compensation/certificate/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ขอใบรับรอง</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_compensation/salaryslip/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">สลิปเงินเดือน</a>
                                </div>
                                <div>&nbsp;</div>  <div>
                                <a href="{{ url('person_compensation/borrow/'.$id_user)}}" class="btn btn-info" >
                                <span class="nav-main-link-name">ยืม-คืน</span>
                                </a>
                                </div>
                                <div>&nbsp;</div>




                             

                                </div>
                                </ol>
                            </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มรายการยืม-คืน</h2> 
                <form  method="post" action="{{ route('compensation.infoborrow_save') }}" enctype="multipart/form-data"> 
                @csrf
                <div class="row push">
                    <div class="col-sm-2">
                        <label>เลขทะเบียน :</label>
                    </div> 
                    <div class="col-lg-3">        
                        <input name="BORROW_NUMBER" id="BORROW_NUMBER"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$refnumber}}" readonly>
                             
                    </div>
                    <div class="col-sm-1 text-right">                    
                        <label>จังหวัด :</label>
                    </div> 
                    <div class="col-lg-2"> 
                        <select name="BORROW_PROVINCE" id="BORROW_PROVINCE"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                            <option value="เลย">เลย</option>
                        </select>       
                        
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ปีงบประมาณ :</label>
                    </div>         
                    <div class="col-lg-2">        
                    <select name="BORROW_YEAR" id="BORROW_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
                    </div>
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>ยื่นต่อ :</label>
                    </div> 
                    <div class="col-sm-3 text-left">
                        <select name="BORROW_LOCATION" id="BORROW_LOCATION"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                            <option value="ผู้อำนวยการโรงพยาบาลสมเด็จยุพราชด่านซ้าย">ผู้อำนวยการโรงพยาบาลสมเด็จยุพราชด่านซ้าย</option>
                        </select>   
                    </div> 
                    <div class="col-sm-1 text-right">
                        <label>วันที่ยืม :</label>
                    </div> 
                    <div class="col-lg-2">        
                        <input name="BORROW_DATE" id="BORROW_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($datenow)}}" readonly>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>เวลา :</label>
                    </div> 
                    <div class="col-sm-2">
                        <input  value="{{ date('H:i')}}" name="BORROW_TIME" id="BORROW_TIME" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;" >
                    </div> 
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>ข้าพเจ้า :</label>
                    </div> 
                    <div class="col-sm-2">
                    {{ $inforpersonuser -> HR_PREFIX_NAME }}{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
                    <input type="hidden" value=" {{ $inforpersonuser -> HR_PREFIX_NAME }}{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}" name="BORROW_MY_HR_PERSON_NAME" id="BORROW_MY_HR_PERSON_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                   
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>ตำแหน่ง :</label>
                    </div> 
                    <div class="col-sm-2">
                    {{ $inforpersonuser -> HR_PERSON_TYPE_NAME }}
                    <input type="hidden" value=" {{ $inforpersonuser -> HR_PERSON_TYPE_NAME }}" name="BORROW_POSITION_IN_WORK" id="BORROW_POSITION_IN_WORK" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>สังกัด :</label>
                    </div> 
                    <div class="col-sm-2">
                        <input name="BORROW_AFFILIATION" id="BORROW_AFFILIATION" value="{{$ORG_NAME}}"class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </div> 
                </div>

                <div class="row push">
                <div class="col-sm-2">
                        <label>ประเภทเงิน :</label>
                    </div> 
                    <div class="col-lg-2">        
                        <select name="BORROW_TYPE_MONEY" id="BORROW_TYPE_MONEY"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                            <option value="เงินบำรุง">เงินบำรุง</option>
                        </select>  
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ประสงค์ขอยืมเงินจาก :</label>
                    </div> 
                    <div class="col-sm-6">
                    <select name="BORROW_FUND" id="BORROW_FUND" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                        <option value="กองทุน">กองทุน </option>
                    
                    </select>
                     
                    </div> 
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>อ้างหนังสือราชการ :</label>
                    </div> 
                    <div class="col-sm-7 detali_booknum" >
                        <input name="BORROW_GOVERNMENT_BOOK" id="BORROW_GOVERNMENT_BOOK" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </div>    
                    <div class="col-lg-3">
                        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addbook"  >หนังสืออ้างถึง</button>
                </div> 
                                 
         
                </div>
                <div class="row push">
                    <div class="col-sm-2">
                        <label>ประเภทการยืมเงิน :</label>
                    </div> 
                    <div class="col-sm-9">
                      

                                <select name="BORROW_GOVERNMENT_GO" id="BORROW_GOVERNMENT_GO" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                <option value="0">--ทั้งหมด--</option>                                    
                                                <option value="1">การเดินทางไปราชการ ในราชอาณาจักรชั่วคราว</option>   
                                                <option value="2">การเดินทำงไปราชการ ต่ำงประเทศชั่วคราว</option>  
                                                <option value="3">การฝึกอบรม/สัมมนา/ประชุมวิชาการ กรณีส่วนราชการเป็นผู้จัด</option>  
                                                <option value="4">การฝึกอบรม/สัมมนา/ประชุมวิชาการ กรณีผู้จัดให้เบิกจากต้นสังกัด</option>  
                                                <option value="5">การประชุมราชการ</option>                               
                                    
                                </select>

                    </div>    
                                 
           
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>เพื่อเป็นค่าใช้จ่าย :</label>
                    </div> 
                    <div class="col-sm-10">
                        <input name="BORROW_COMMENT" id="BORROW_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </div>  
                </div>

                <div class="row push">
                    <div class="col-sm-2 ">
                        <label>ตั้งแต่วันที่ :</label>
                    </div> 
                    <div class="col-lg-2">        
                        <input name="BORROW_START_DATE" id="BORROW_START_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($datenow)}}" readonly>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ครบกำหนดวันที่</label>
                    </div> 
                    <div class="col-sm-2">
                        <input name="BORROW_END_DATE" id="BORROW_END_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($datenow)}}" readonly>
                    </div> 
                    <div class="col-sm-1 text-right">
                        <label>ภายใน</label>
                    </div> 
                    <div class="col-lg-2">        
                        <input name="BORROW_DATE_AMOUNT" id="BORROW_DATE_AMOUNT" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                    </div>
                    <div class="col-sm-1 text-right">
                        <label>วัน</label>
                    </div> 
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>ผู้รายงาน :</label>
                    </div> 
                    <div class="col-lg-2">
                    {{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
                    <input type="hidden" name="BORROW_HR_PERSON_ID" id="BORROW_HR_PERSON_ID" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{$inforperson -> ID}}">
                    <input type="hidden" name="BORROW_HR_PERSON_NAME" id="BORROW_HR_PERSON_NAME" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}">                       
                        </select>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>หน่วยงานผู้เบิก :</label>
                    </div>
                    <div class="col-lg-3">       
                    {{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }}
                    <input type="hidden" name="BORROW_HR_DEP_SUB_SUB_NAME" id="BORROW_HR_DEP_SUB_SUB_NAME" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }}">                       
                    </div>       
                   
                </div>

                <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">รายการขอยืม</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">อื่นฯ</a>
                                    </li>


                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                    <div class="row push">
                                    <div class="col-sm-2">
                                    <label>รวมเป็นเงิน </label>
                                    </div>
                                    <div class="col-sm-1">   
                                    <label> <div id="money1">0</div></label> 
                                    </div>
                                    <div class="col-sm-1">
                                    <label>บาท</label>
                                    </div>
                                    </div>
                                     <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                                                            
                                                <td style="text-align: center;border: 1px solid black;">รายการ</td>
                                                <td style="text-align: center;border: 1px solid black;" width="20%">จำนวนเงิน</td>
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1">   
                                    <tr>
                                      
                                        <td>
                                            <select name="BORROW_SUB_TYPE[]" id="BORROW_SUB_TYPE[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$refnumber}}">
                                                <option value="">--กรุณาเลือกรายการ--</option>
                                                    @foreach ($grecord_moneys as $grecord_money)                                                     
                                                        <option value="{{ $grecord_money ->MONEY_ID  }}">{{ $grecord_money->MONEY_NAME}}</option>
                                                    @endforeach 
                                            </select>    
                                        </td> 
                                        <td> <input name="BORROW_SUB_PICE[]" id="BORROW_SUB_PICE[]" class="form-control input-sm items1" onkeyup="callmoney1()"></td>    
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    </tbody>   
                                    </table>


                                    </div>

                                    <div class="tab-pane" id="object2" role="tabpanel">
                                    <div class="row push">
                                    <div class="col-sm-2">
                                    <label>รวมเป็นเงิน </label>
                                    </div>
                                    <div class="col-sm-1">   
                                    <label> <div id="money2">0</div></label> 
                                    </div>
                                    <div class="col-sm-1">
                                    <label>บาท</label>
                                    </div>
                                    </div>

                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">รายการ</td>
                                                <td style="text-align: center;border: 1px solid black;" width="20%">จำนวนเงิน</td>
                                                <td style="text-align: center;border: 1px solid black;" width="15%"><a  class="btn btn-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody2">   
                                    <tr>
                                        <td> <input name="BORROW_SUB_TYPE2[]" id="BORROW_SUB_TYPE2[]" class="form-control input-sm"  > </td>

                                        <td> <input name="BORROW_SUB_PICE2[]" id="BORROW_SUB_PICE2[]" class="form-control input-sm items" onkeyup="callmoney()" > </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    </tbody>   
                                    </table>
                                    </div>

                                   
       </div>

            <br> 
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('person_compensation/borrow/'.$inforperson -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
                </div>
            </div>
        </form> 
        
        
        
        <div class="modal fade addbook" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalbook">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">          
                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกหนังสืออ้างถึง</h2>
                    </div>
                <div class="modal-body">
            <body>
                <div class="container mt-3">
                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
            <br>
                    <div style='overflow:scroll; height:300px;'>
                    <table class="table">
                        <thead>
                            <tr>
                                <td style="text-align: center;border: 1px solid black;" width="20%">เลขที่หนังสือ</td>
                                <td style="text-align: center;border: 1px solid black;">หนังสือ</th>
                                <td style="text-align: center;border: 1px solid black;" width="15%">ลงวันที่</td>
                                <td style="text-align: center;border: 1px solid black;" width="5%">เลือก</td>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach ($books as $book) 
                                <tr>
                                    <td >{{$book->BOOK_NUMBER}}</td>
                                    <td >{{$book->BOOK_NAME}}</td>
                                    <td >{{DateThai($book->BOOK_DATE)}}</td>                                
                                    <td >
                                         <button type="button" class="btn btn-hero-sm btn-hero-info"    onclick="selectbook_check({{$book->BOOK_ID}});">เลือก</button> 
                                        {{-- <button type="button" class="btn btn-hero-sm btn-hero-info"   >เลือก</button> --}}
                                    </td>
                                </tr>
                            @endforeach   
                        </tbody>
                    </table>    
                </div>
            </div>
            </div>
                <div class="modal-footer">
                    <div align="right">
                            <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
                    </div>
                </div>
            </body>
        </div>
      </div>

 
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>



function selectbook_check(book_id){
      
      var _token=$('input[name="_token"]').val();

           $.ajax({
                   url:"{{route('compensation.selectbooknum_check')}}",
                   method:"GET",
                   data:{book_id:book_id,_token:_token},
                   success:function(result){
                    $('.detali_booknum').html(result);
                   }
           })


           $('#modalbook').modal('hide');

}

$(document).ready(function() {
    $('select').select2();
});

  $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


//============================================
function callmoney1(){    
    var items = document.getElementsByClassName("items1");
    var itemCount = items.length;
    var total = 0;
    for(var i = 0; i < itemCount; i++)
    {
        total = total +  parseInt(items[i].value);
    }
    document.getElementById("money1").innerHTML = total;  
}
//==============
    $('.addRow').on('click',function(){
         addRow();
         $('select').select2();
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
         var tr ='<tr>'+
        
                '<td>'+ 
                '<select name="BORROW_SUB_TYPE[]" id="BORROW_SUB_TYPE'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="">--กรุณาเลือกรายการ--</option>'+
                '@foreach ($grecord_moneys as $grecord_money)'+                                                    
                '<option value="{{ $grecord_money ->MONEY_ID  }}">{{ $grecord_money->MONEY_NAME}}</option>'+
                '@endforeach '+
                '</select>' +  
                '</td>'+      
                '<td><input name="BORROW_SUB_PICE[]" id="BORROW_SUB_PICE[]" class="form-control input-sm items1" onkeyup="callmoney1()"></td>'+ 
                '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
            callmoney1();
     });
//=================================//
//====================================
function callmoney(){    
    var items = document.getElementsByClassName("items");
    var itemCount = items.length;
    var total = 0;
    for(var i = 0; i < itemCount; i++)
    {
        total = total +  parseInt(items[i].value);
    }
    document.getElementById("money2").innerHTML = total;  
}
$('.addRow2').on('click',function(){
         addRow2();
     });
function addRow2(){
        var count = $('.tbody2').children('tr').length;
         var tr ='<tr>'+
                '<td><input name="BORROW_SUB_TYPE2[]" id="BORROW_SUB_TYPE2[]" class="form-control input-sm"></td>'+ 
                '<td><input name="BORROW_SUB_PICE2[]" id="BORROW_SUB_PICE2[]" class="form-control input-sm items" onkeyup="callmoney()"></td>'+ 
                '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody2').append(tr);
     };

     $('.tbody2').on('click','.remove', function(){
            $(this).parent().parent().remove();
            callmoney();
     });
//=================================//

</script>
<script> 
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

function chkNumber(ele){
    var vchar = String.fromCharCode(event.keyCode);
    if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
    ele.onKeyPress=vchar;
    }
 
</script>

@endsection