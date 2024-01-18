@extends('layouts.risk')   
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

    use App\Http\Controllers\ManagerriskController;
    use App\Models\Riskrep;
?>
       
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานหน่วยงานที่รายงานอุบัติการณ์ความเสี่ยงของตนเอง</B></h3>   
               
                <div align="right ">
                    <a href="{{ url('manager_risk/report_riskdepartment_self_subsub_excel')}}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" ><li class="fa fa-file-excel"></li>&nbsp;Excel</a>
                    <a class="btn btn-success" href="{{url('manager_risk/report')}}" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fas fa-chevron-circle-left text-white-70" style="font-size:17px;"></i>&nbsp;&nbsp;ย้อนกลับ</a> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                  </div>
                </div> 
          
                            <form action="{{ route('mrisk.report_riskdepartment_self_subsub_search') }}" method="post">
                                @csrf
            
                                <div class="row">
                         
                                    <div class="col-sm-4 date_budget">
                                        <div class="row">
                                            <div class="col-sm">
                                                วันที่
                                            </div>
                                            <div class="col-md-4">
            
                                                <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}" readonly>
            
                                            </div>
                                            <div class="col-sm">
                                                ถึง
                                            </div>
                                            <div class="col-md-4">
            
                                                <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>
            
                                            </div>
                                        </div>
            
                                    </div>
                                  
                                    <div class="col-sm-30">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-1.5">
                                        <span>
                                            <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i
                                                    class="fas fa-search mr-2"></i>ค้นหา</button>
                                        </span>
                                    </div>
                                </div>
            
            
            
                            </form>                


                  
                 
        <div class="block-content">  
            <div class="table-responsive"> 
                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" >ระดับความรุนแรง</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">A</th>
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">B</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">C</th>
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">D</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">E</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">F</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">G</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">H</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">I</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">1</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">2</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">3</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">4</th> 
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">5</th>    
                            <th  class="text-font" style="border: 1px solid black;text-align: center;" width="3%">ไม่ระบุ</th>  
                            <th  class="text-font" style="border: 1px solid black;ext-align: center" width="5%">จำนวนรวม</th>                        
                            <th  class="text-font" style="border: 1px solid black;ext-align: center" width="5%">ร้อยละ</th> 
                        </tr >
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($infodepsubsubs as $infodepsubsub)
                            <?php
                            $number++;

                               $number01 = number_format(ManagerriskController::countriskdepsubsub_self_sum('0',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end));
                               $number02 = number_format(ManagerriskController::countriskdepsubsub_self_all('0',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID,$displaydate_bigen,$displaydate_end));
                            
                                   if($number02 == 0  ){
                                    $sumper = 0;
                                   }else{
                                    $sumper = ($number01/$number02)*100;
                                   }

                                    $from = date($displaydate_bigen);
                                    $to = date($displaydate_end);

                                        $information =  Riskrep::leftjoin('risk_account_detail','.RISKREP_ACC_ID','=','risk_account_detail.RISK_ACC_ID')
                                        ->where('RISKREP_DEPARTMENT_SUB','=',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID)
                                        ->where('RISK_ACC_AGENCY','=',$infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID)
                                        ->WhereBetween('RISKREP_DATESAVE',[$from,$to]) 
                                        ->get();

                                        $A=0;$B=0;$C=0;$D=0;$E=0;$F=0;$G=0;$H=0;$I=0;
                                        $num1=0;$num2=0;$num3=0;$num4=0;$num5=0;$null=0;
                                        foreach ($information as $info){

                                             if($info->RISKREP_LEVEL == 'A'){ $A++; }
                                             elseif($info->RISKREP_LEVEL== 'B'){ $B++; }
                                             elseif($info->RISKREP_LEVEL== 'C'){ $C++; }
                                             elseif($info->RISKREP_LEVEL== 'D'){ $D++; }
                                             elseif($info->RISKREP_LEVEL== 'E'){ $E++; }
                                             elseif($info->RISKREP_LEVEL== 'F'){ $F++; }
                                             elseif($info->RISKREP_LEVEL== 'G'){ $G++; }
                                             elseif($info->RISKREP_LEVEL== 'H'){ $H++; }
                                             elseif($info->RISKREP_LEVEL== 'I'){ $I++; }
                                             elseif($info->RISKREP_LEVEL== '1'){ $num1++; }
                                             elseif($info->RISKREP_LEVEL== '2'){ $num2++; }
                                             elseif($info->RISKREP_LEVEL== '3'){ $num3++; }
                                             elseif($info->RISKREP_LEVEL== '4'){ $num4++; }
                                             elseif($info->RISKREP_LEVEL== '5'){ $num5++; }
                                             else{$null++; }
                                         

                                        }

                                    

                            ?>
                   
                            <tr height="20">                       
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" style="text-align: left;">  {{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($A)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($B)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($C)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($D)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($E)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($F)}}</td> 
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($G)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($H)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($I)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num1)}}</td> 
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num2)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num3)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num4)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($num5)}}</td>    
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($null)}}</td>    
                                <td class="text-font text-pedding" style="text-align: center;">{{$number01}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumper,2)}}</td>
                            </tr>

                            @endforeach


                           <tr style="background-color: #E0FFFF;" height="20">                       
                    
                                <td class="text-font text-pedding" style="text-align: center;" colspan="2" >รวม</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumA)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumB)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumC)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumD)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumE)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumF)}}</td> 
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumG)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumH)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumI)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum1)}}</td> 
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum2)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum3)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum4)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum5)}}</td>  
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnull)}}</td>      
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumuse)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{number_format(($sumuse/$sumall )* 100,2)}}</td>
                            </tr>
                            
                           <tr style="background-color: #E0FFFF;" height="20">                       
                          
                            <td class="text-font text-pedding" style="text-align: center;" colspan="2" >ร้อยละ</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumA_re,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumB_re,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumC_re,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumD_re,2)}}</td>  
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumE_re,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumF_re,2)}}</td> 
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumG_re,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumH_re,2)}}</td>  
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumI_re,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum1_re,2)}}</td> 
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum2_re,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum3_re,2)}}</td>  
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum4_re,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnum5_re,2)}}</td>    
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumnull_re,2)}}</td>      
                            <td class="text-font text-pedding" style="text-align: center;">{{number_format($sumuse_re,2)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;"></td>
                        </tr>



                    </tbody>
                </table>
            </div>                
               
        </div>
    </div>    
</div> 
  
@endsection

@section('footer')

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
            });  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection