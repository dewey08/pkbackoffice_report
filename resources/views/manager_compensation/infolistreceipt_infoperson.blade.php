@extends('layouts.compensation')   
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
 
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);

    use Illuminate\Support\Facades\DB;

?>
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
      
            <div align="left">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>
               รายการรายรับบุคคล >> {{$infolist->HR_RECEIVE_NAME }}</B></h3>
                </div>
                <div align="right">
              @if($infolist->ID == '3' || $infolist->ID == '4' || $infolist->ID == '5' || $infolist->ID == '6')
                    <a href="#add_personot"  data-toggle="modal"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มข้อมูลค่าตอบแทน</a>
             @endif
                    <a href="#add_person"  data-toggle="modal"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มบุคคล</a>
                    <a href="{{ url('manager_compensation/infolistreceipt_infopersonsaveall/'.$infolist->ID)}}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="return confirm('ต้องการที่จะเพิ่มผู้ใช้ทั้งหมด ?')" ><i class="fas fa-plus"></i> เพิ่มทั้งหมด</a>
                    <a href="#add_value"  data-toggle="modal"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ปรับค่าทั้งหมด</a>
                    <a href="{{ url('manager_compensation/infolistreceipt_infopersondeleteall/'.$infolist->ID)}}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="return confirm('ต้องการที่จะลบข้อมูลทั้งหมด ?')" >ลบทั้งหมด</a>
                    
                    <a href="{{ url('manager_compensation/infolistreceipt_infopersonexcel/'.$infolist->ID)}}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" ><li class="fa fa-file-excel"></li>&nbsp;Excel</a>
                    <a href="{{ url('manager_compensation/infolistreceipt/'.$infolist->HR_RECEIVE_TYPE)}}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ย้อนกลับ</a>

                   
                </div>
            </div>
            
            <div class="block-content block-content-full">

            <form action="{{ route('mcompensation.infolistreceipt_infopersonsearch',['idlist' => $infolist->ID]) }}" method="post">
                        @csrf

             <div class="row" >
            
     
                  <div class="col-md-3" >
                    <span>
                    <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                    </span>
                 </div>
               
          
                 <div class="col-md-1">
                 <span>
                 <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >ค้นหา</button>
                 </span> 
                 </div>
                 </form>  
                 <div class="col-md-5">
                 &nbsp;
                 </div>
                 <div class="col-md-3">
                 จำนวนรวมข้อมูล <B> {{$count_list}} </B> ยอดรวมเงิน  <B class="detailsum">{{number_format($sum_list,2)}}</B> 
                </div> 
                
                </div>
          <br>
           
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อนามสกุล</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ตำแหน่ง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภทข้าราชการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >สถานะการทำงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >บัญชี</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="20%">จำนวนเงิน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ลบข้อมูล</th> 
                        </tr >
                    </thead>
                    <tbody>
                    <?php $count=1;?>
                     @foreach ($infolistpersons as $infolistperson)

                    
                        <tr height="20">
                            <td class="text-font" style="border: 1px solid black;" align="center">{{$count}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;">{{$infolistperson->HR_PREFIX_NAME}}{{$infolistperson->HR_FNAME}} {{$infolistperson->HR_LNAME}}</td> 
                            <td class="text-font text-pedding" style="border: 1px solid black;">{{$infolistperson->POSITION_IN_WORK}}</td> 
                            <td class="text-font text-pedding" style="border: 1px solid black;" >{{$infolistperson->HR_DEPARTMENT_SUB_SUB_NAME}}</td> 
                            <td class="text-font text-pedding" style="border: 1px solid black;">{{$infolistperson->HR_PERSON_TYPE_NAME}}</td> 
                            <td class="text-font text-pedding" style="border: 1px solid black;">{{$infolistperson->HR_STATUS_NAME}}</td> 
                            <td class="text-font text-pedding" style="border: 1px solid black;">
                                    @if($infolist->HR_RECEIVE_NAME == 'compen')
                                        {{$infolistperson->BOOK_BANK_OT_NUMBER}}
                                    @else
                                        {{$infolistperson->BOOK_BANK_NUMBER}}
                                    @endif
                            </td> 
                            <td class="text-font text-pedding" style="border: 1px solid black;">
     
                            <input id="receipt{{$infolistperson->ID}}" name="receipt{{$infolistperson->ID}}" class="form-control input-sm inputs{{$count}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="amountreceipt({{$infolistperson->ID}},{{$infolistperson->SALARY_RECEIVE_ID}},{{$count}});" value="{{$infolistperson->AMOUNT}}">
                            </td> 
                          
                            
                            <td align="center" style="border: 1px solid black;">
                                <a href="{{ url('manager_compensation/infolistreceipt_infopersondestroy/'.$infolistperson->ID.'/'.$infolist->ID) }}"  onclick="return confirm('ต้องการที่จะลบข้อมูล {{$infolistperson->HR_FNAME}} {{$infolistperson->HR_LNAME}} ?')"    class="btn btn-danger fa fa-window-close"></a>
                            </td>
                           
                           
                        </tr>

                        <?php  $count++;?>
                   

                        @endforeach 

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>


                 
<div id="add_person" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มบุคคล</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('mcompensation.infolistreceipt_infopersonsave') }}">
        @csrf
      
      <input type="hidden" name="SALARY_RECEIVE_ID" id="SALARY_RECEIVE_ID" value="{{$infolist->ID}}">
     
        <div class="row push">
      <div class="col-sm-3">  
      <label >บุคคล</label>
      </div>
      <div class="col-sm-7">  
                <select name="HR_PERSON_ID" id="HR_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; ">
                        <option value="" style=" text-align: left;">--กรุณาเลือก--</option>
                  
                   @foreach ($infopersons as $infoperson) 
                          <?php $checkperson = DB::table('salary_receive_person')->where('HR_PERSON_ID','=',$infoperson->ID)->where('SALARY_RECEIVE_ID','=',$infolist->ID)->count();?>
                          @if($checkperson == 0)
                          <option value="{{ $infoperson->ID  }}"  >{{ $infoperson->HR_FNAME}} {{ $infoperson->HR_LNAME}}</option>
                          @endif
                   @endforeach 
               </select>


      </div>
      </div>
       <br>
      <div class="row push">
      <div class="col-sm-3">  
      <label >จำนวนเงิน</label>
      </div>
      <div class="col-sm-5">  
      <input id="AMOUNT" name="AMOUNT" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
      </div>
      <div class="col-sm-2">  
      <label >บาท</label>
      </div>
      </div>   


     
      

      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">บันทึก</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ยกเลิก</button>
        </div>
        </div>
        </form>  







        
</body>
     
     
    </div>
  </div>
</div>
<!----->
  
<div id="add_personot" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
       
            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มข้อมูลค่าตอบแทน</h2>
          </div>
          <div class="modal-body">
          <body>
              

          <form  method="post" action="{{ route('mcompensation.infolistreceipt_infootsave') }}">
          @csrf
        
        <input type="hidden" name="SALARY_RECEIVE_ID" id="SALARY_RECEIVE_ID" value="{{$infolist->ID}}">
       
        <div class="row push">
            <div class="col-sm-1">
                ปี : 
            </div>
            <div class="col-sm-3">
                <select name="OT_YEAR" id="OT_YEAR" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="2564">2564</option>
                    <option value="2565">2565</option>   
                    <option value="2566">2566</option>   
                    <option value="2567">2567</option>   
                    <option value="2568">2568</option>   
                    <option value="2569">2569</option>   
                    <option value="2569">2570</option> 
                </select>    
            </div>
            <div class="col-sm-3">  
            <label >เดือน</label>
            </div>
         
            <div class="col-sm-5">  
                <select name="MONTH_OT" id="MONTH_OT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; ">
                    <option value="0">กรุณาเลือกเดือน</option>      
                    <option value="1">มกราคม</option>    
                    <option value="2" >กุมภาพันธ์</option> 
                    <option value="3" >มีนาคม</option>  
                    <option value="4" >เมษายน</option> 
                    <option value="5" >พฤษภาคม</option>
                    <option value="6" >มิถุนายน</option>  
                    <option value="7" >กรกฎาคม</option> 
                    <option value="8" >สิงหาคม</option>  
                    <option value="9" >กันยายน</option> 
                    <option value="10" >ตุลาคม</option>
                    <option value="11" >พฤศจิกายน</option>
                    <option value="12" >ธันวาคม</option>     
                 </select>
     
             
                 

      
            </div>
            </div>
         
            
        
            </div>
              <div class="modal-footer">
              <div align="right">
              <button type="submit"  class="btn btn-hero-sm btn-hero-info" style=" font-family: 'Kanit', sans-serif;" >บันทึก</button>
              <button type="button" class="btn btn-hero-sm btn-hero-danger" style=" font-family: 'Kanit', sans-serif;" data-dismiss="modal" >ยกเลิก</button>
              </div>
              </div>
              </form>  
        </body>
           
           
          </div>
        </div>
        </div>
<!----->

               
<div id="add_value" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มบุคคล</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('mcompensation.infolistreceipt_infovalueall') }}">
        @csrf
     
     
        <div class="row push">
      <div class="col-sm-3">  
      <label >จำนวนเงิน</label>
      </div>
   
      <div class="col-sm-7">  
      <input id="allvalue" name="allvalue" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;"  >

      <input type="hidden" id="idlist" name="idlist" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" value="{{$infolist->ID}}" >
      </div>
      </div>
   
      

      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">บันทึก</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>

<!---------------->


  
@endsection

@section('footer')

<script>

$(document).ready(function() {

    $('select:not(.normal)').each(function () {
                $(this).select2({
                    width: '100%',
                    dropdownParent: $(this).parent()
                });
            });
      
});

function amountreceipt(idreceipt,idlist,count){


var x = event.which || event.keyCode;
if(x == 13){
            var value=document.getElementById('receipt'+idreceipt).value;
            var number = count+1;
            
            var value=document.getElementById('receipt'+idreceipt).value;

      var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('mcompensation.updateamountreceipt')}}",
              method:"GET",
              data:{value:value,idreceipt:idreceipt,_token:_token},
              success:function(result){
                summoneyreceipt(idlist);
                $(".inputs"+number).focus();
                     }
      })

        
        
}

}

 function summoneyreceipt(idlist){

var _token=$('input[name="_token"]').val();
$.ajax({
        url:"{{route('mcompensation.summoneyreceipt')}}",
        method:"GET",
        data:{idlist:idlist,_token:_token},
        success:function(result){
                  $('.detailsum').html(result);
               }
})
}
  
</script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
    <script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
    <!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

<script>


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
              //alert("Hello! I am an alert box!!");
           }
            
   })
    
}


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    
</script>

@endsection