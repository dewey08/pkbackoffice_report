<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PAY.xls"');
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

  
    use App\Http\Controllers\ManagercompensationController;
?>       
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
            @if($type == 'salary')
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการรายจ่ายเงินเดือนบุคคล</B></h3>
            @else
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการรายจ่ายค่าตอบแทนบุคคล</B></h3>
            @endif
          
            </div>

                <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายการรายรับ</th>
                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">บุคลากร (คน) </th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">จำนวนเงิน (บาท)</th>

                        </tr >
                    </thead>
                    <tbody>
                    <?php $count=1;?>
                     @foreach ($info_pays as $info_pay)

                    
                        <tr height="20">
                            <td class="text-font" align="center">{{$count}}</td>
                            <td class="text-font text-pedding" >{{$info_pay->HR_PAY_NAME}}</td> 
                            <td class="text-font text-pedding" align="center">{{ManagercompensationController::countpay($info_pay->ID)}}</td> 
                            <td class="text-font text-pedding" align="center">{{ number_format(ManagercompensationController::sumpay($info_pay->ID),2)}}</td> 
                          
                        </tr>

                        <?php  $count++;?>



                        @endforeach 

                    </tbody>
                </table>
            </div>
        </div>
    </div>    


