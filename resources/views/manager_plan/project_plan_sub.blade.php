@extends('layouts.plan')   
  
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
    
    .text-pedding{
        padding-left:10px;
        padding-right:10px;
                            }
    
                .text-font {
            font-size: 13px;
                        }   

                        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

                  
      .text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }

        .text-font {
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

   
    use App\Http\Controllers\ManagerplanController;
    $refnumber = ManagerplanController::refnumberPj();
    
?>
     
<!-- Advanced Tables -->
<br>
<br>
 
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;text-align:center;"><B> แผนงานโครงการย่อย</B></h3>
                <a href="{{ url('manager_plan/project')}}" class="btn btn-hero-sm btn-hero-success f-kanit">ย้อนกลับ</a>
            </div>
            <div class="block-content block-content-full">
                <div class="row push">
                    <div class="col-lg-2" style="text-align: left">
                    <label >                           
                    ปีงบประมาณ :              
                    </label>
                    </div> 
                    <div class="col-lg-2">
                           {{$infoproject->BUDGET_YEAR}}
                            </select>
                    </div> 
                    <div class="col-lg-2" style="text-align: left">
                        <label >                           
                        ชื่อแผนงานโครงการหลัก :              
                        </label>
                    </div> 

                    <div class="col-lg-6">
                        {{$infoproject->PRO_NAME}}
                    </div> 
              
                    </div> 

                    <div class="row push">
                        <div class="col-lg-2" style="text-align: left">
                        <label >                           
                            ยุทธศาสตร์ :              
                        </label>
                        </div> 
                        <div class="col-lg-10">
                            {{$infoproject->STRATEGIC_NAME}}
                        </div> 
                      
                   
                        </div>
                
   
                    
                <div align="right">

                    <a href="{{ url('manager_plan/project_plan_sub_add/'.$infoproject->PRO_ID)  }}"    class="btn btn-hero-sm btn-hero-primary js-click-ripple-enabled" style="font-family: 'Kanit', sans-serif;text-align:center;"><i class="fas fa-plus"></i>&nbsp;เพิ่มข้อมูล</a>
                    </div>
                    <br>
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #adabfd;">
                            <tr height="40">
                                <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                               
                                <th  class="text-font" style="border-color:#7df8f8;text-align: center;border: 1px solid black;"  width="7%">รหัส</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">สถานะ</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อโครงการ</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">ประเภทงบ</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">มูลค่า</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">ผู้รับผิดชอบ</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="7%">คำสั่ง</th>
                                
                                
                            </tr >
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($infoprojectsubs as $infoprojectsub)
                            <?php $number++; ?>

                            <tr height="20">
                                <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{$number}}</td>
                                <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{$infoprojectsub->PRO_SUB_CODE}}</td>
                                <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: center;border: 1px solid black;" >
                                    @if($infoprojectsub->PRO_SUB_STATUS == 'request')
                                        <span class="badge badge-info" >ร้องขอ</span>
                                    @elseif($infoprojectsub->PRO_SUB_STATUS == 'NOTAPP')
                                       <span class="badge badge-danger" >ไม่อนุมัติ</span>
                                    @else
                                       <span class="badge badge-success" >อนุมัติ</span>
                                    @endif
                                
                                </td>
                                <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$infoprojectsub->PRO_SUB_NAME}}</td>
                                <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{$infoprojectsub->BUDGET_NAME}}</td>
                                <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: right;border: 1px solid black;" >{{number_format($infoprojectsub->PRO_SUB_AMOUNT,2)}}</td>
                                <td class="text-font text-pedding" style="vertical-align: text-top;border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{$infoprojectsub->PRO_SUB_HR_NAME}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                            ทำรายการ
                                        </button>
                                        <div class="dropdown-menu" style="width:10px">
                                            <a class="dropdown-item"  href="{{ url('manager_plan/project_plan_sub_edit/'.$infoprojectsub->PRO_ID.'/'.$infoprojectsub->PRO_SUB_ID)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" >รายละเอียด/แก้ไข</a> 
                                            <a class="dropdown-item"  href="{{ url('manager_plan/project_plan_sub_app/'.$infoprojectsub->PRO_ID.'/'.$infoprojectsub->PRO_SUB_ID)  }}" onclick="return confirm('ต้องการที่จะอนุมัติ ?')"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >อนุมัติ</a>  
                                            <a class="dropdown-item"  href="{{ url('manager_plan/project_plan_sub_notapp/'.$infoprojectsub->PRO_ID.'/'.$infoprojectsub->PRO_SUB_ID)  }}" onclick="return confirm('ต้องการที่จะไม่อนุมัติ ?')"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >ไม่อนุมัติ</a>  
                                        </div>
                                    </div> 
                         
                                </td>     

                            </tr>


                            @endforeach
                           
                        </tbody>
                    </table>



           </div>
    </div>    
</div>

  
@endsection

@section('footer')

      

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



@endsection