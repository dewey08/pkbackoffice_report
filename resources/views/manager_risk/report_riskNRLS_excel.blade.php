
<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="report_riskNRLS.xls"');//ชื่อไฟล์


?>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงาน EXPORT NRLS</B></h3>   
         
                </div>
            
              
        <div class="block-content">  
            <div class="table-responsive"> 
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">

                            <th class="text-font" style="text-align: center;" width="4">ลำดับ</th>
                            <th class="text-font" style="text-align: center;" width="8%">รหัสหน่วยงาน</th>
                            <th class="text-font" style="text-align: center;" width="8%">รหัส IR</th>
                            <th class="text-font" style="text-align: center;" width="8%">รหัส</th>
                            <th class="text-font" style="text-align: center;" width="20%">หัวข้ออุบัติการณ์</th>
                            <th class="text-font" style="text-align: center;" width="7%">เพศของผู้ได้รับผลกระทบ</th>
                            <th class="text-font" style="text-align: center;" width="5%">อายุ</th>
                            <th class="text-font" style="text-align: center;" width="5%">ผู้ได้รับผลกระทบ</th>
                            <th class="text-font" style="text-align: center;" width="10%">สถานที่เกิดเหตุ</th>
                            <th class="text-font" style="text-align: center;" width="10%">วันที่เกิด</th>
                            <th class="text-font" style="text-align: center;" width="5%">เวร</th>
                            <th class="text-font" style="text-align: center;" width="5%">ระดับ</th>
                            <th class="text-font" style="text-align: center;" width="20%">รายละเอียดเหตุการณ์</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($rigreps as $rigrep)
                            <?php $number++; ?>
                        <tr>
                                <td class="text-font text-pedding" align="center" >{{$number}}</td>
                                <td style="vertical-align: top;" class="text-pedding">{{$info_org->ORG_PCODE}}</td>
                                <td style="vertical-align: top;" class="text-pedding">{{'000'.date('Y').'-'.$rigrep->RISKREP_ID}}</td>
                                <td style="vertical-align: top;" class="text-pedding">{{$rigrep->RISK_REPITEMS_CODE}}</td>
                                <td style="vertical-align: top;" class="text-pedding">{{$rigrep->RISKREP_DETAILRISK2}}</td>
                                <td style="vertical-align: top;" class="text-pedding">{{$rigrep->RISKREP_SEX}} </td>
                                <td style="vertical-align: top;" class="text-pedding"> 0{{$rigrep->RISKREP_AGE}} </td>
                                <td style="vertical-align: top;" class="text-pedding">{{$rigrep->INCEDENCE_USEREFFECT_CODE}}</td>
                                <td style="vertical-align: top;" class="text-pedding">{{$rigrep->LOCATION_NAME}}</td>
                                <td style="vertical-align: top;" class="text-pedding">{{DateThai($rigrep->RISKREP_STARTDATE)}} </td>
                                <td style="vertical-align: top;" class="text-pedding">{{$rigrep->RISK_TIME_COMMENT}} </td>
                                <td style="vertical-align: top;" class="text-pedding">{{$rigrep->RISK_REP_LEVEL_CODE}} </td>
                                <td style="vertical-align: top;" class="text-pedding">{{$rigrep->RISKREP_DETAILRISK}} </td>
                       
        
                          
                            </tr>
                 
                            @endforeach  
                    </tbody>

                </table>
      