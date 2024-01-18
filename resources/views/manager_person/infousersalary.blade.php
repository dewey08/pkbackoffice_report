@extends('layouts.person')   
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<link rel="stylesheet"  href="{{ asset('css/toastr.min.css') }}">

@section('content')

<style>
        .center {
        margin: auto;
        width: 100%;
        padding: 10px;
        }
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
            }

            label{
                    font-family: 'Kanit', sans-serif;
                    font-size: 10px;
                    font-size: 1.0rem;
            } 

            @media only screen and (min-width: 1200px) {
        label {
            float:right;
        }

            }

            
            .text-pedding{
        padding-left:10px;
                            }

                .text-font {
            font-size: 13px;
                        }   
            
            
            .form-control{
            font-size: 13px;
                  }   

                  table, td, th {
            border: 1px solid black;
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

  date_default_timezone_set("Asia/Bangkok");
  $datenow  = date('Y-m-d');
  use Illuminate\Support\Facades\DB;
  
?>         

<center>    
    <div class="block mt-2" style="width: 98%;">
        <div class="block block-rounded block-bordered">
           
           

              <div class="block-header block-header-default">
                <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>เลื่อนขั้นเงินเดือน</B></h3>
                &nbsp;&nbsp;
          
                <a href="{{ url('manager_person/inforperson')  }}"   class="btn btn-hero-sm btn-hero-success foo15" ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
            </div>  
    <div class="block-content">

      
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
            <div class="table-responsive">    
             
                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="3%">ลำดับ</th>
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">ชื่อ - นามสกุล</th>                               
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">ตำแหน่ง</th> 
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">ระดับ</th> 
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">หน่วยงาน</th> 
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">เงินเดือนปัจุบัน</th>  
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="13%">เลขที่คำสั่ง</th>    
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">ลงวันที่</th> 
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">เงินเดือนใหม่</th>    
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">หมายเหตุ</th>                                               
                            <th  class="text-font foo14" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody id="myTable">
                    
                    <?php $number = 0; ?>
                        @foreach ($inforpersonuser as $inforpersonuser)
                        <?php $number++; ?>
                            <tr height="20">

                                <td class="text-font" align="center" width="3%">{{$number}}</td>                        
                                <td class="text-font text-pedding" width="8%">
                                    <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforpersonuser->ID }} ">
                                     {{$inforpersonuser->HR_FNAME}} {{$inforpersonuser->HR_LNAME}}
                                </td>  
                               
                                <td class="text-font text-pedding" width="8%">
                                    <input type="hidden" name="POSITION_ID{{$inforpersonuser->ID}}" id="POSITION_ID{{$inforpersonuser->ID}}"  value="{{ $inforpersonuser->HR_POSITION_ID }} ">
                                     {{$inforpersonuser->POSITION_IN_WORK}} 
                                    </td> 
                                <td class="text-font text-pedding" width="7%"> 
                                    <input type="hidden" name="HR_LEVEL_ID{{$inforpersonuser->ID}}" id="HR_LEVEL_ID{{$inforpersonuser->ID}}"  value="{{ $inforpersonuser->HR_LEVEL_ID }} ">
                                    {{$inforpersonuser->HR_LEVEL_NAME}} 
                                </td>  
                                <td class="text-font text-pedding" width="8%"> 
                                    <input type="hidden" name="LAVEL_ID{{$inforpersonuser->ID}}" id="LAVEL_ID{{$inforpersonuser->ID}}"  value="{{ $inforpersonuser->HR_DEPARTMENT_SUB_SUB_ID }} ">
                                    {{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}} 
                                </td>   
                                <td class="text-font text-pedding" width="7%"> 
                                    <input type="hidden" name="HR_SALARY{{$inforpersonuser->ID}}" id="HR_SALARY{{$inforpersonuser->ID}}"  value="{{ $inforpersonuser->HR_SALARY }} ">
                                    {{$inforpersonuser->HR_SALARY}} 
                                </td>   
                                <td width="13%">
                                    <input type="text" class="form-control input-sm" name = "SALARY_NUMBER{{$inforpersonuser->ID}}"  id="SALARY_NUMBER{{$inforpersonuser->ID}}">  
                                </td>  
                                <td width="5%">
                                    <input type="text" class="form-control input-sm datepicker" name = "DATE_CHANGE{{$inforpersonuser->ID}}"  id="DATE_CHANGE{{$inforpersonuser->ID}}" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 12px;" readonly>  
                                </td> 
                                <td width="7%">
                                    <input type="text" class="form-control input-sm" name = "SALARYNEW{{$inforpersonuser->ID}}"  id="SALARYNEW{{$inforpersonuser->ID}}">  
                                 
                                </td> 
                                <td width="7%">
                                    <input type="text" class="form-control input-sm" name = "COMMENT{{$inforpersonuser->ID}}"  id="COMMENT{{$inforpersonuser->ID}}">  
                                </td> 
                                <td align="center" width="7%">


                                    <span type="button" onclick="savesalarylist({{$inforpersonuser->ID}})"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i></span>
                                  

                                    <span type="button" class="btn btn-hero-sm btn-hero-success" href="#edit_modal{{ $inforpersonuser->ID }}" data-toggle="modal" ><i class="fas fa-info-circle"></i></span>
                                  
                                </td>  
                                
                                <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">
                            </form> 


                            <div id="edit_modal{{ $inforpersonuser->ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                  <div class="modal-header">                                  
                                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:13px;font-size: 1.2rem;font-weight:normal;color: #9449f7;">ข้อมูลการเลือนขั้นเงินเดือน &nbsp;::&nbsp; {{$inforpersonuser->HR_PREFIX_NAME}}{{$inforpersonuser->HR_FNAME}} &nbsp;&nbsp; {{$inforpersonuser->HR_LNAME}}</h2>
                                      </div>
                                      <div class="modal-body">
                                      <body>
                                   
                                        <?php 
                                             $infosalarys= DB::table('hrd_tr_salary')->where('PERSON_ID','=',$inforpersonuser->ID)
                                            ->orderBy('hrd_tr_salary.ID', 'desc')  
                                            ->get();

                                        ?>

                                      <div class="form-group">
                                      <div class="row">                                       
                                        <div class="col-sm-12">                                            
                                            <div class="row">
                                                <div class="col-md-1" style="font-size:7px;font-size: 1rem;font-weight:normal;color: #9449f7;">ลำดับ</div>
                                                <div class="col-md-2" style="font-size:7px;font-size: 1rem;font-weight:normal;color: #9449f7;">เลขที่คำสั่ง</div>
                                                <div class="col-md-2" style="font-size:7px;font-size: 1rem;font-weight:normal;color: #9449f7;">ลงวันที่</div>
                                                <div class="col-md-2" style="font-size:7px;font-size: 1rem;font-weight:normal;color: #9449f7;">ตำแหน่ง</div>
                                                <div class="col-md-1" style="font-size:7px;font-size: 1rem;font-weight:normal;color: #9449f7;">ระดับ</div>
                                                <div class="col-md-2" style="font-size:7px;font-size: 1rem;font-weight:normal;color: #9449f7;">เงินเดือนใหม่</div>
                                                <div class="col-md-2" style="font-size:7px;font-size: 1rem;font-weight:normal;color: #9449f7;">หมายเหตุ</div>
                                            </div>
                                            <hr >
                                            <?php $number2 = 0; ?>
                                            @foreach ($infosalarys as $infosalary)
                                            <?php $number2++; ?>
                                            <div class="row">
                                                <div class="col-md-1">{{$number2}}</div>
                                                <div class="col-md-2 text-left">{{$infosalary->SALARY_NUMBER}}</div>
                                                <div class="col-md-2">{{Datethai($infosalary->DATE_CHANGE)}}</div>
                                                <div class="col-md-2 text-left" >{{$infosalary->POSITION_IN_WORK}}</div>
                                                <div class="col-md-1">{{$infosalary->LAVEL_NAME}}</div>
                                                <div class="col-md-2">{{$infosalary->SALARYNEW}}</div>
                                                <div class="col-md-2 text-left">{{$infosalary->COMMENT}}</div>
                                            </div>  
                                            <hr>                                          
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>

                                  
                                      <div class="modal-footer">
                                      <div align="right">
                                   
                                      <span type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ปิด</span>
                                      </div>
                                      </div>
                                      </form>  
                              </body>
                                  
                                  
                                </div>
                              </div>
                            </div>



                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
         
<div class="modal fade addlevel" id="addlevel" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modallevel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info shadow-lg">
                <h2 class="modal-title text-white"
                    style="font-family: 'Kanit', sans-serif; font-size:19px;font-size: 1rem;font-weight:normal;color:rgb(0,0,128);">
                    รายละเอียดความรุนแรง</h2>
            </div>
        <div class="modal-body">

            <body>
                <div style='overflow:scroll; height:300px;'>
                    <table class="table">
                        <thead>
                            <tr>
                                <td style="text-align: center;font-size:13px;" width="10%">รหัส
                                </td>
                                <td style="text-align: center;font-size:13px;" width="10%">
                                    ความรุนแรง</th>
                                <td style="text-align: center;font-size:13px;">รายละเอียด</td>

                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach ($infosalarys as $infosalary)
                                <tr>
                                    <td style="text-align: center;font-size:13px;">
                                       
                                    </td>
                                    <td style="text-align: center;font-size:13px;">
                                       
                                    </td>
                                    <td style="text-align:left;font-size:13px;">
                                        {{$infosalary->SALARYNEW}}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
        </body>
        <div class="modal-footer ">
            <div align="right">
                <a href="" class="btn btn-hero-sm btn-hero-danger foo15" data-dismiss="modal"><i
                        class="fas fa-window-close mr-2"></i>Close</a>
            </div>
        </div>
    </div>
</div>
</div>
  
  
@endsection

@section('footer')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="{{ asset('js/toastr.min.js') }}"></script>
  <!--start Datatable -->
<script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script> 
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
  <!--end Datatable -->

 <script src="{{ asset('select2/select2.min.js') }}"></script>

    <!-- Calenda -->
 <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
 <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

 <script>

        $('#buttons').on('click',function(){
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
    }
            // toastr["info"]("ok", "ไปงานสัมมนา")
        })
           
        function detail(id) {
                        $.ajax({
                            url: "{{ route('suplies.detailapp') }}",
                            method: "GET",
                            data: {
                                id: id
                            },
                            success: function(result) {
                                $('#detail').html(result);
                            }
                        })
                    }
</script>

 <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>

<script>
        $(document).ready(function() {
            $("select").select2();
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
              
              
              
              $('.btn-submit-add').click(function (e) { 
              
              
              
              var form = $('#form_add');
              formSubmit(form)
                     
              });
              
              function editnumber(number){ 
                          var form = $('#form_edit'+number);
                          formSubmit(form)      
                          }



</script>

<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });


    function savesalarylist(idlist){



            var SALARY_NUMBER=document.getElementById('SALARY_NUMBER'+idlist).value;
            var DATE_CHANGE=document.getElementById('DATE_CHANGE'+idlist).value;
            var SALARYNEW=document.getElementById('SALARYNEW'+idlist).value;
            var COMMENT=document.getElementById('COMMENT'+idlist).value;
            var POSITION_ID=document.getElementById('POSITION_ID'+idlist).value;
            var HR_LEVEL_ID=document.getElementById('HR_LEVEL_ID'+idlist).value;
            var LAVEL_ID=document.getElementById('LAVEL_ID'+idlist).value;
            var HR_SALARY=document.getElementById('HR_SALARY'+idlist).value;

      var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('mperson.infousersalarynewsave')}}",
              method:"GET",
              data:{POSITION_ID:POSITION_ID,HR_LEVEL_ID:HR_LEVEL_ID,LAVEL_ID:LAVEL_ID,HR_SALARY:HR_SALARY,SALARY_NUMBER:SALARY_NUMBER,DATE_CHANGE:DATE_CHANGE,SALARYNEW:SALARYNEW,COMMENT:COMMENT,idlist:idlist,_token:_token},
              success:function(result){
                  alert("บันทึกข้อมูลเรียบร้อย !!");
                }
      })

        

}
    </script>





@endsection