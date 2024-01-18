<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_CALLCOMPENSATIONDETAIL.xls"');
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

                <table class="gwt-table table-striped table-hover table-vcenter" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ชื่อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ตำแหน่ง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ประเภทข้าราชการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เลขบัญชี</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >มูลค่าสุทธิ</th>
     
                         
                        </tr >
                    </thead>
                    <tbody>

                
                    <?php $count=1;?>
                     @foreach ($infopersons as $infoperson)

                   
                        <tr height="20" onclick="salarydetailperson({{$infoperson->ID}},'{{$infohead->SALARYALL_HEAD_TYPE}}')">
                        <td class="text-font" align="center">{{$count}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_PREFIX_NAME}}{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->POSITION_IN_WORK}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_DEPARTMENT_SUB_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_PERSON_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >

                            @if($infohead->SALARYALL_HEAD_TYPE == 'compen')
                            {{$infoperson->BOOK_BANK_OT_NUMBER}}
                            @else
                            {{$infoperson->BOOK_BANK_NUMBER}}
                            @endif
                            
                        </td>
                        <td class="text-font text-pedding" style="text-align: right;" >{{number_format(ManagercompensationController::call_all($infoperson->ID,$infohead->SALARYALL_HEAD_TYPE),2)}}</td>
                     
            
                        </tr>
                        
                        <?php  $count++;?>
                        @endforeach 
                       
                            
                        <tr height="20">
                            <td class="text-font" align="center" colspan="6">ยอดรวมทั้งหมด</td>
                      
                            <td class="text-font text-pedding" style="text-align: right;" >{{number_format($total,2)}}</td>
                         
                
                            </tr>


                   

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
