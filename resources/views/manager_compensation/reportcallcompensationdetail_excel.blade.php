<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="reportcallcompensationdetail.xls"');
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
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
                    }
                    
                    table, th, td {
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

  
    use App\Http\Controllers\ManagercompensationController;
?>
<?php
    function month($strMonth)
    {

    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strMonthThai";
    }

    
?>   

                        

<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูล วันที่ {{$infohead->SALARYALL_HEAD_DAY_ID}}  เดือน {{month($infohead->SALARYALL_HEAD_MONTH_ID)}}   ปี {{$infohead->SALARYALL_HEAD_YEAR_ID}}  ประเภท 
                    @if($infohead->SALARYALL_HEAD_TYPE == 'compen')
                               ค่าตอบแทน
                           @else
                                เงินเดือน
                           @endif </B></h3>
             
           
            </div>

                <table class="gwt-table table-striped table-hover table-vcenter" style="width: 300%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เลขที่บัญชี</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="7%" >ชื่อ</th>
                                     @foreach ($inforeceive_lists as $inforeceive_list)
                                     <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >{{$inforeceive_list->HR_RECEIVE_NAME}}</th>
                                     @endforeach 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รวมรับทั้งสิ้น</th>
                                     @foreach ($infopay_lists as $infopay_list)
                                     <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >{{$infopay_list->HR_PAY_NAME}}</th>
                                     @endforeach 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รวมหัก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >คงเหลือสุทธิ</th>
     
                         
                        </tr >
                    </thead>
                    <tbody>

                
                    <?php $count=1;?>
                     @foreach ($infopersons as $infoperson)

                     <tr height="40">
                        <td class="text-font" align="center">{{$count}}</td>
                        <td class="text-font text-pedding" >
                            
                            @if($infohead->SALARYALL_HEAD_TYPE == 'compen')
                            {{$infoperson->BOOK_BANK_OT_NUMBER}}
                            @else
                            {{$infoperson->BOOK_BANK_NUMBER}}
                            @endif
                        
                        </td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_PREFIX_NAME}}{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</td>
                        @foreach ($inforeceive_lists as $inforeceive_list)
                        <th  class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::call_receive_type($infohead->SALARYALL_HEAD_TYPE,$infoperson->ID,$inforeceive_list->HR_RECEIVE_NAME,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</th>
                        @endforeach 
                        <td class="text-font" style="border-color:#000000;text-align: right;">{{number_format(ManagercompensationController::call_receive_type_sum($infohead->SALARYALL_HEAD_TYPE,$infoperson->ID,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</td>
                        @foreach ($infopay_lists as $infopay_list)
                        <th  class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::call_pay_type($infohead->SALARYALL_HEAD_TYPE,$infoperson->ID,$inforeceive_list->HR_RECEIVE_NAME,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</th>
                        @endforeach 
                        <td class="text-font" style="border-color:#000000;text-align: right;">{{number_format(ManagercompensationController::call_pay_type_sum($infohead->SALARYALL_HEAD_TYPE,$infoperson->ID,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</td>
                        <td class="text-font" style="text-align: right;" >{{number_format(ManagercompensationController::call_all($infoperson->ID,$infohead->SALARYALL_HEAD_TYPE),2)}}</td>        
                    </tr>
                        
                        <?php  $count++;?>
                        @endforeach 
                       
                            
                        <tr height="20">
                            <td class="text-font" align="center" colspan="3">รวามทั้งสิ้น</td>
                            @foreach ($inforeceive_lists as $inforeceive_list)
                            <th  class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::call_receive_type_sumperson($infohead->SALARYALL_HEAD_TYPE,$inforeceive_list->HR_RECEIVE_NAME,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</th>
                            @endforeach 
                            <td class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::call_receive_type_sumallperson($infohead->SALARYALL_HEAD_TYPE,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</td>
                            @foreach ($infopay_lists as $infopay_list)
                            <th  class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::call_pay_type_sumperson($infohead->SALARYALL_HEAD_TYPE,$inforeceive_list->HR_RECEIVE_NAME,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</th>
                            @endforeach 
                            <td class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::call_pay_type_sumallperson($infohead->SALARYALL_HEAD_TYPE,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</td>   
                            <td class="text-font" style="text-align: right;" >{{number_format($total,2)}}</td>                         
                
                            </tr>

                            @foreach ($infohrdpersontypes as $infohrdpersontype)
                            
                            <tr height="20">
                                
                                <td class="text-font" align="left" colspan="3">{{$infohrdpersontype->HR_PERSON_TYPE_NAME}}</td>
                                @foreach ($inforeceive_lists as $inforeceive_list)
                                <th  class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::calltp_receive_type($infohead->SALARYALL_HEAD_TYPE,$infohrdpersontype->HR_PERSON_TYPE_ID,$inforeceive_list->HR_RECEIVE_NAME,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</th>
                                @endforeach 
                                <td class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::calltp_receive_type_sum($infohead->SALARYALL_HEAD_TYPE,$infohrdpersontype->HR_PERSON_TYPE_ID,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</td>
                                @foreach ($infopay_lists as $infopay_list)
                                <th  class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::calltp_pay_type($infohead->SALARYALL_HEAD_TYPE,$infohrdpersontype->HR_PERSON_TYPE_ID,$infopay_list->HR_PAY_NAME,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</th>
                                @endforeach 
                                <td class="text-font" style="border-color:#000000;text-align: right;" >{{number_format(ManagercompensationController::calltp_pay_type_sum($infohead->SALARYALL_HEAD_TYPE,$infohrdpersontype->HR_PERSON_TYPE_ID,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</td>   
                                
                                <?php 
                                $number1 = ManagercompensationController::calltp_receive_type_sum($infohead->SALARYALL_HEAD_TYPE,$infohrdpersontype->HR_PERSON_TYPE_ID,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID);
                                $number2 = ManagercompensationController::calltp_pay_type_sum($infohead->SALARYALL_HEAD_TYPE,$infohrdpersontype->HR_PERSON_TYPE_ID,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID);
                                ?>
                                
                                
                                
                                <td class="text-font" style="text-align: right;">{{number_format(($number1- $number2),2)}}</td>                         
                    
                                </tr>

                            @endforeach 
                   

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
