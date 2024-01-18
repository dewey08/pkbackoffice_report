<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_RECEIPT.xls"');
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



  
?>        
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
         
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>มูลค่าแผนวัสดุ</B></h3>
         
            </div>
            <div class="block-content block-content-full">
            
           
                <table class="gwt-table table-striped table-vcenter" width="100%">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th class="text-font" width="5%">ลำดับ</th>
                            <th class="text-font" width="30%">
                                ประเภทวัสดุ
                            </th>
                            <th class="text-font" width="30%"> แผนจัดซื้อ
                                (บาท)
                            </th>
                            <th class="text-font" width="12%">ปี
                            </th>

                          
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count=1;?>
                    @foreach ($excel as $row)


                    
                        <tr height="20">
                            <td class="text-font" align="center">{{$count}}</td>
                            <td class="text-font text-pedding" >{{ $row->SUP_TYPE_NAME }}</td> 
                            <td class="text-font text-pedding" align="center">{{ $row->SUP_MATERIAL_VALUE }}</td> 
                            <td class="text-font text-pedding" align="center"> {{ $row->BUDGET_YEAR_MATERIAL }}</td> 

                             
                        </tr>

                        <?php  $count++;?>



                        @endforeach 

                    </tbody>
                </table>
            </div>
        </div>
    </div>    

