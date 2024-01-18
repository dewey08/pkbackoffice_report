<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="riskincedentsprofile.xls"');//ชื่อไฟล์
?>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานการบริหารจัดการความเสี่ยงขององค์กร/หน่วยงาน(Risk Incidents Profile)</B></h3>   

        <div class="block-content">  
            <div class="table-responsive"> 
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">

                            <th class="text-font" style="text-align: center;" width="4">ลำดับ</th>
                            <th class="text-font" style="text-align: center;" width="8%">สถานะ</th>
                            <th class="text-font" style="text-align: center;" width="9%">ความรุนแรง</th>
                            <th class="text-font" style="text-align: center;" width="10%">วันที่บันทึก</th>
                            <th class="text-font" style="text-align: center;" width="13%">ที่มา</th>
                            <th class="text-font" style="text-align: center;">รายละเอียดเหตุการณ์</th>
                            <th class="text-font" style="text-align: center;" width="20%">การจัดการเบื้องต้น</th>
                        


                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($rigreps as $rigrep)
                            <?php
                            $number++;
                            $status = $rigrep->RISKREP_STATUS;

                            if ($status === 'CONFIRM') {
                            $statuscol = 'badge badge-primary';
                            } elseif ($status === 'REPORT') {
                            $statuscol = 'badge badge-warning';
                            } elseif ($status === 'ACCEPT') {
                            $statuscol = 'badge badge-danger';
                            } elseif ($status === 'CHECK') {
                            $statuscol = 'badge badge-info';
                            } elseif ($status === 'SUCCESS') {
                            $statuscol = 'badge badge-success';
                            } else {
                            $statuscol = 'badge badge-secondary';
                            }

                            $level = $rigrep->RISKREP_LEVEL;

                            if ($level === '1') {
                                    $statuslevel = 'badge badge-success';
                                    } elseif ($level === '2') {
                                    $statuslevel = 'badge badge-success';
                                    } elseif ($level === '3') {
                                    $statuslevel = 'badge badge-info';
                                    } elseif ($level === '4') {
                                    $statuslevel = 'badge badge-info';
                                    } elseif ($level === '5') {
                                    $statuslevel = 'badge badge-warning';
                                    } elseif ($level === '6') {
                                    $statuslevel = 'badge badge-warning';                                  
                                    } elseif ($level === '7') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '8') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '9') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '10') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '11') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '12') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '13') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '14') {
                                    $statuslevel = 'badge badge-danger';
                                    } else {
                                    $statuslevel = '';
                                    }

                            
                            ?>

                            <tr height="20">
                                <td class="text-font text-pedding" align="center" width="4%">{{ $number }}</td>

                                <td align="center" style="vertical-align: top;" class="text-pedding"> <span class="{{ $statuscol }}"
                                        width="8%">{{ $rigrep->RISK_STATUS_NAME_TH }}</span></td>

                                <td align="center" style="vertical-align: top;" class="text-pedding"> <span class="{{ $statuslevel }}" width="8%" style=" font-size: 20px;">{{ $rigrep->RISK_REP_LEVEL_NAME }}</span></td>
                                <td class="text-font text-pedding" style="text-align: center;vertical-align: top;"  width="10%">
                                    {{ DateThai($rigrep->RISKREP_DATESAVE) }}</td>
                                <td class="text-font text-pedding" style="text-align: left;vertical-align: top;"width="13%">
                                    {{ $rigrep->INCIDENCE_LOCATION_NAME }}</td>
                                <td class="text-font text-pedding">{!! $rigrep->RISKREP_DETAILRISK !!}</td>
                                <td class="text-font text-pedding" style="text-align: left;">{!! $rigrep->RISKREP_BASICMANAGE !!}
                                </td>
        
                          
                            </tr>
                        @endforeach

                    </tbody>

                </table>
     