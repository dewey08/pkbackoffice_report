<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_PERSON.xls"');//ชื่อไฟล์
?>


      
<div class="table-responsive">
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>

                                        <th style="border-color:#F0FFFF;text-align: center;" width="10%">สถานะ</th>
                                        <th  style="border-color:#F0FFFF;text-align: center;" width="5%">สรุป</th>
                                        <th  class="text-font" class="text-font" style="border-color:#F0FFFF;text-align: center;" width="12%">วันที่ไป</th>
                                        <th  class="text-font" class="text-font" style="border-color:#F0FFFF;text-align: center;" >ประเภทการไป</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เรื่อง</th>
                                        <th  class="text-font" class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">สถานที่</th>
                                        <th  class="text-font" class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ผู้ร่วมประชุม</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ชื่อผู้บันทึก</th>



                                    </tr >
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($inforrecordindexs as $inforrecordindex)
                                <?php $number++;

                                $status =  $inforrecordindex -> STATUS;
                                if( $status === 'APPLY'){
                                    $statuscol =  "badge badge-warning";

                                }else if($status === 'EDIT'){
                                   $statuscol =  "badge badge-danger";

                                }else if($status === 'RECEIVE'){
                                    $statuscol =  "badge badge-info";
                                }else if($status === 'SUCCESS'){
                                    $statuscol =  "badge badge-success";
                                }else{
                                    $statuscol =  "badge badge-secondary";
                                }



                                ?>

                                    <tr height="20">
                                        <td align="center">{{$number}}</td>

                                        <td align="center"><span class="{{$statuscol}}" >{{ $inforrecordindex->STATUS_NAME}}</span></td>
                                        @if($inforrecordindex->SAVE_BACK == True)

                                            <td align="center"><p class="btn btn btn-success  fa fa-check"></p></td>
                                        @elseif($inforrecordindex->STATUS == 'SUCCESS')
                                            <td align="center"><p class="btn btn-warning  fa fa-edit"></p></td>

                                        @else
                                        <td align="center"><i class="fa fa-sync-alt"> </i></td>
                                        @endif
                                        <td class="text-font text-pedding" align="center">{{ DateThai($inforrecordindex->DATE_GO)}}<br>{{ DateThai($inforrecordindex->DATE_BACK)}}</td>
                                        <td class="text-font text-pedding" >{{ $inforrecordindex->RECORD_TYPE_NAME}} </td>
                                        
                                        <td class="text-font text-pedding" >{{ $inforrecordindex->RECORD_HEAD_USE}}</td>
                                        <td class="text-font text-pedding" >{{ $inforrecordindex->LOCATION_ORG_NAME}}</td>
                                   
                                        <td class="text-font text-pedding" >
                                          <?php
                                                        $query= DB::table('grecord_index_person')->where('RECORD_ID','=',$inforrecordindex->ID)->get();
                                                                                    
                                                                                    
                                                        $num = 1;
                                                        foreach ($query as $row){
                                                            if($num == 1){
                                                                echo $row->HR_FULLNAME."<br>";
                                                            }else{
                                                                echo $row->HR_FULLNAME."<br>";
                                                            }
                                                            
                                                                $num++;
                                                        }
                                            ?>
                                        
                                        </td>
                                        <td class="text-font text-pedding" >{{ $inforrecordindex->USER_POST_NAME}}</td>
                 
@endforeach

                                </tbody>
                            </table>
