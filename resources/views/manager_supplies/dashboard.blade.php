@extends('layouts.supplies')

@section('css_before')
<script>
    function checklogin() {
        window.location.href = '{{route("index")}}';
    }
</script>
<?php
    if (Auth::check()) {
        $status  = Auth::user()->status;
        $id_user = Auth::user()->PERSON_ID;
        $url     = Request::url();
        $pos     = strrpos($url, '/') + 1;
        $user_id = substr($url, $pos);
    } else {
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    }
    ?>
    <?php
        use App\Http\Controllers\Report\SuppliesReportController;
       
    ?>
@endsection

@section('content')
<div class="d-flex justify-content-center">
    <div class="block shadow" style="width: 95%;">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title text-center fs-24">ข้อมูลงานพัสดุ</h3>
            </div>
                <hr>
            <div class="block-content">
            <form action="{{ url('manager_supplies/dashboard') }}" method="get">
                    <!-- @csrf -->
                <div class="row">
                    <div class="col-md-2">
                    &nbsp;ประจำปีงบประมาณ : &nbsp;
                    </div>
                    <div class="col-md-2">
                                    <select name="yearbudget_select" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                            @foreach($year_ as $year)
                                        @if($year == $yearbudget_select )
                                <option value="{{$year}}" selected>พ.ศ. {{$year}}</option>
                                        @else
                                <option value="{{$year}}">พ.ศ. {{$year}}</option>
                                        @endif
                                    @endforeach
                                        </select> 
                    </div>
                        <div class="col-md-1">
                                    <span>
                                        <button type="submit" class="btn btn-hero-sm btn-hero-info" >แสดง</button>
                                    </span>
                                </div>
                        </div>
                </div>
             </form>

            <br>
                <div class="row shadow mb-3">
                    <div class="col-12 mt-2">
                        <h3 class="fs-20 fw-5 ml-5">ข้อมูลขอซื้อขอจ้าง</h3>
                    </div>
                    <div class="col-md-12 col-xl-12">
                        <div class="block block-link-pop1 radius-5 bg-sl-b2" href="{{url('manager_supplies/requestforbuy')}}">
                                <div
                                    class="block-content block-content-full  d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$suppliesreqAll}} <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ขอซื้อ/ขอจ้าง ทั้งหมด</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-book text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">100%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-y2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$amount_Approve}} <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">หน.เห็นชอบ</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-paper-plane text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perreqstatus['amount_Approve']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-g2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$amount_Verify}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">พัสดุตรวจสอบ</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-inbox text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perreqstatus['amount_Verify']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-g3">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$amount_Allow}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ผอ.อนุมัติ
                                        </p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-hand-point-up text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perreqstatus['amount_Allow']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-gb2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$amount_Pending}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2"> รอเห็นชอบ </p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-book text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perreqstatus['amount_Pending']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-r2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$amount_Disapprove}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ไม่เห็นชอบ
                                        </p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-paper-plane text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perreqstatus['amount_Disapprove']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-r2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$amount_Disverify}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ตรวจสอบไม่ผ่าน</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-inbox text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perreqstatus['amount_Disverify']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-r2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$amount_Disallow}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ไม่อนุมัติ</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-hand-point-up text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perreqstatus['amount_Disallow']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-r3">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$amount_Cancel}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ยกเลิกคำขอ</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-book text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perreqstatus['amount_Cancel']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row shadow mb-3">
                    <div class="col-12 mt-2">
                        <h3 class="fs-20 fw-5 ml-5">ข้อมูลจัดซื้อจัดจ้าง</h3>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-gb2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">
                                        {{$budget_all}} <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ลงทะเบียนคุม</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-paper-plane text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">100%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-p2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$budget_CreatePurchaseOrder}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">จัดทำใบสั่งซื้อ</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-inbox text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perconstatus['budget_CreatePurchaseOrder']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-g2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$budget_Confirm}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ยืนยันตรวจรับ</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-hand-point-up text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perconstatus['budget_Confirm']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-g3">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$budget_Success}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ส่งข้อมูลเรียบร้อย</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-book text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perconstatus['budget_Success']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-gb3">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$budget_Offerprice}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ใบเสนอราคา</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-paper-plane text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perconstatus['budget_Offerprice']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-o2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$budget_Makepurchase}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ทำรายการขอซื้อ</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-inbox text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perconstatus['budget_Makepurchase']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-y2">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$budget_Check}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ตรวจรับ</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-hand-point-up text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perconstatus['budget_Check']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="block block-link-pop1 radius-5 bg-sl-r3">
                                <div
                                    class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                                    <div class="ml-3 text-left">
                                        <p class="text-white mb-0" style="font-size: 2.5rem;">{{$budget_Cancel}}
                                             <span class="text-font">เรื่อง</span>
                                        </p>
                                        <p class="text-white m-0 pt-2">ยกเลิกรายการ</p>
                                    </div>
                                    <div class="text-white text-center mr-3">
                                        <i class="m-0 fa fa-2x fa fa-book text-white pt-3 pb-4" ></i> <br>
                                        <p class="mb-0 fs-20">{{$perconstatus['budget_Cancel']}}%</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    
                </div>

                <div class="row shadow mb-3 mt-3">
                    <div class="col-12 mt-3">
                        <h3 class="fs-16 fw-5">แผนภาพข้อมูลงานพัสดุ</h3>
                    </div>
                    <div class="row col-12 mb-2">
                        <div class="col-md-6">
                            <div class="panel bg-sl-blue p-1">
                                <div class="pane-heading py-2 pl-5 text-white">กราฟแสดงจำนวนรายการจัดซื้อจัดจ้าง แยกรายเดือน (จำแนกตามวันที่ตรวจรับตามปีงบประมาณ)</div>
                                <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                                    <div id="amountPurchase_cahrt" style="font-family: 'Kanit', sans-serif;width: 100%; height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel bg-sl-blue p-1">
                                <div class="pane-heading py-2 pl-5 text-white">กราฟแสดงงบประมาณจัดซื้อจัดจ้าง แยกรายเดือน (จำแนกตามวันที่ตรวจรับตามปีงบประมาณ)</div>
                                <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                                    <div id="budgetPurchase_cahrt" style="font-family: 'Kanit', sans-serif;width: 100%; height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 mb-2">
                        <div class="col-md-6 mb-2">
                            <div class="panel bg-sl-o2 p-1">
                                <div class="pane-heading py-2 pl-5 text-white">ข้อมูลจัดซื้อจัดจ้าง แยกตามประเภทวัสดุ (จำแนกตามวันที่ตรวจรับตามปีงบประมาณ และอยู่ในแบบแผน)</div>
                                <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ประเภทวัสดุ</th>
                                                <th>แผนจัดซื้อ (บาท)</th>
                                                <th>ผลการดำเนินงาน (บาท)</th>
                                                <th>ร้อยละ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sumpurches_type1 = 0 ;
                                        $sumperformance_type1 = 0 ;
                                        ?>
                                            @foreach($budgetplanType1 as $value)
                                            <?php  $numbersumcount =   SuppliesReportController::valuepicesup($value['suptype_type_id'],$yearbudget_select);  
                                                   $numbersumcountuse =   SuppliesReportController::valuepicesupuse($value['suptype_type_id'],$yearbudget_select);
                                            
                                                    if($numbersumcount == 0){
                                                        $pernumber =   0;
                                                    }else{
                                                        $pernumber = (100/$numbersumcount)*$numbersumcountuse;
                                                    }
                                                 
                                            ?>
                                          
                                            <tr>
                                                <td class="py-1">{{$value['suptype_name']}}</td>
                                                <td class="py-1 text-right">{{number_format($numbersumcount,2)}}</td>
                                                <td class="py-1 text-right">{{number_format($numbersumcountuse,2)}}</td>
                                                 <td class="py-1 text-right">{{number_format($pernumber,2)}} %</td>
                                            </tr>
                                            <?php 
                                            
                                            $sumpurches_type1 += $numbersumcount;
                                            $sumperformance_type1 += $numbersumcountuse;
                                            ?> 
                                            @endforeach
                                     <?php 
                                            if($sumpurches_type1 == 0){
                                                $pernumbersum = 0;
                                            }else{
                                                $pernumbersum = (100/$sumpurches_type1)*$sumperformance_type1;
                                            }

                                            ?>
                            
                                            <tr class="bg-sl-o1 fw-4">
                                                <td class="py-1">รวม</td>
                                                <td class="py-1 text-right">{{number_format($sumpurches_type1,2)}}</td>
                                                <td class="py-1 text-right">{{number_format($sumperformance_type1,2)}}</td>

                                                <td class="py-1 text-right">{{number_format($pernumbersum,2)}} %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="panel bg-sl-g2 p-1 mb-2">
                                <div class="pane-heading py-2 pl-5 text-white">ข้อมูลจัดซื้อจัดจ้าง แยกตามประเภทครุภัณฑ์ (จำแนกตามวันที่ตรวจรับตามปีงบประมาณ และอยู่ในแบบแผน)</div>
                                <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                                <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ประเภทครุภัณฑ์</th>
                                                <th>แผนจัดซื้อ (บาท)</th>
                                                <th>ผลการดำเนินงาน (บาท)</th>
                                                <th>ร้อยละ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sumpurches_type2 = 0 ;
                                        $sumperformance_type2 = 0 ;
                                        ?>
                                            @foreach($budgetplanType2 as $value)

                                            <?php  $numbersumcount =   SuppliesReportController::valuepicesup($value['suptype_type_id'],$yearbudget_select); 
                                              $numbersumcountuse =   SuppliesReportController::valuepicesupuse($value['suptype_type_id'],$yearbudget_select);        
                                            if($numbersumcount == 0){
                                                $pernumber =   0;
                                            }else{
                                                $pernumber = (100/$numbersumcount)*$numbersumcountuse;
                                            }
                                         
                                    ?>
                                            <tr>
                                                <td class="py-1">{{$value['suptype_name']}}</td>
                                                <td class="py-1 text-right">{{number_format($numbersumcount,2)}}</td>
                                                <td class="py-1 text-right">{{number_format($numbersumcountuse,2)}}</td>
                                                 <td class="py-1 text-right">{{number_format($pernumber,2)}} %</td>

                                           
                                            </tr>
                                            <?php 
                                            
                                            $sumpurches_type2 += $numbersumcount;
                                            $sumperformance_type2 += $numbersumcountuse;
                                            ?> 
                                            @endforeach
                                            <?php  
                                             if($sumpurches_type2 == 0){
                                                $pernumber2 = 0;
                                            }else{
                                                $pernumber2 = (100/$sumpurches_type2)*$sumperformance_type2; 
                                            }
                                            
                                            
                                            ?>
                                            <tr class="bg-sl-g1 fw-4">
                                                <td class="py-1">รวม</td>
                                                <td class="py-1 text-right">{{number_format($sumpurches_type2,2)}}</td>
                                                <td class="py-1 text-right">{{number_format($sumperformance_type2,2)}}</td>
                                                <td class="py-1 text-right">{{number_format($pernumber2,2)}} %</td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                            <div class="panel bg-sl-gb2 p-1">
                                <div class="pane-heading py-2 pl-5 text-white">ข้อมูลจัดซื้อจัดจ้าง แยกตามประเภทสิ่งปลูกสร้าง (จำแนกตามวันที่ตรวจรับตามปีงบประมาณ และอยู่ในแบบแผน)</div>
                                <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                                <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ประเภทสิ่งปลูกสร้าง</th>
                                                <th>แผนจัดซื้อ (บาท)</th>
                                                <th>ผลการดำเนินงาน (บาท)</th>
                                                <th>ร้อยละ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sumpurches_type5 = 0 ;
                                        $sumperformance_type5 = 0 ;
                                        ?>
                                            @foreach($budgetplanType5 as $value)
                                            <tr>
                                                <td class="py-1">{{$value['suptype_name']}}</td>
                                                <td class="py-1 text-right">{{number_format($value['supreq_purchas'],2)}}</td>
                                                <td class="py-1 text-right">{{number_format($value['supcon_performance'],2)}}</td>
                                                <td class="py-1 text-right">{{$value['supreq_budgetplanper']}}</td>
                                            </tr>
                                            <?php 
                                            $sumpurches_type5 += $value['supreq_purchas'];
                                            $sumperformance_type5 += $value['supcon_performance'];
                                            ?> 
                                            @endforeach
                                            <tr class="bg-sl-gb1 fw-4">
                                                <td class="py-1">รวม</td>
                                                <td class="py-1 text-right">{{number_format($sumpurches_type5,2)}}</td>
                                                <td class="py-1 text-right">{{number_format($sumperformance_type5,2)}}</td>
                                                <td class="py-1 text-center"></td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="panel bg-sl-r2 p-1">
                                <div class="pane-heading py-2 pl-5 text-white">ข้อมูลจัดซื้อจัดจ้าง แยกตามประเภทที่ดิน (จำแนกตามวันที่ตรวจรับตามปีงบประมาณ และอยู่ในแบบแผน)</div>
                                <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                                <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ประเภทที่ดิน</th>
                                                <th>แผนจัดซื้อ (บาท)</th>
                                                <th>ผลการดำเนินงาน (บาท)</th>
                                                <th>ร้อยละ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sumpurches_type4 = 0 ;
                                        $sumperformance_type4 = 0 ;
                                        ?>
                                            @foreach($budgetplanType4 as $value)
                                            <tr>
                                                <td class="py-1">{{$value['suptype_name']}}</td>
                                                <td class="py-1 text-right">{{number_format($value['supreq_purchas'],4)}}</td>
                                                <td class="py-1 text-right">{{number_format($value['supcon_performance'],4)}}</td>
                                                <td class="py-1 text-right">{{$value['supreq_budgetplanper']}}</td>
                                            </tr>
                                            <?php 
                                            $sumpurches_type4 += $value['supreq_purchas'];
                                            $sumperformance_type4 += $value['supcon_performance'];
                                            ?> 
                                            @endforeach
                                            <tr class="bg-sl-r1 fw-4">
                                                <td class="py-1">รวม</td>
                                                <td class="py-1 text-right">{{number_format($sumpurches_type4,2)}}</td>
                                                <td class="py-1 text-right">{{number_format($sumperformance_type4,2)}}</td>
                                                <td class="py-1 text-center"></td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="panel bg-sl-y2 p-1">
                                <div class="pane-heading py-2 pl-5 text-white">ข้อมูลจัดซื้อจัดจ้าง แยกตามประเภทจ้างเหมา (จำแนกตามวันที่ตรวจรับตามปีงบประมาณ และอยู่ในแบบแผน)</div>
                                <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                                <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ประเภทจ้างเหมา</th>
                                                <th>แผนจัดซื้อ (บาท)</th>
                                                <th>ผลการดำเนินงาน (บาท)</th>
                                                <th>ร้อยละ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sumpurches_type3 = 0 ;
                                        $sumperformance_type3 = 0 ;
                                        ?>
                                            @foreach($budgetplanType3 as $value)
                                            <tr>
                                                <td class="py-1">{{$value['suptype_name']}}</td>
                                                <td class="py-1 text-right">{{number_format($value['supreq_purchas'],2)}}</td>
                                                <td class="py-1 text-right">{{number_format($value['supcon_performance'],2)}}</td>
                                                <td class="py-1 text-right">{{$value['supreq_budgetplanper']}}</td>
                                            </tr>
                                            <?php 
                                            $sumpurches_type3 += $value['supreq_purchas'];
                                            $sumperformance_type3 += $value['supcon_performance'];
                                            ?> 
                                            @endforeach
                                            <tr class="bg-sl-y1 fw-4">
                                                <td class="py-1">รวม</td>
                                                <td class="py-1 text-right">{{number_format($sumpurches_type3,2)}}</td>
                                                <td class="py-1 text-right">{{number_format($sumperformance_type3,2)}}</td>
                                                <td class="py-1 text-center"></td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('google/Charts.js') }}"></script>


<script type="text/javascript">
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'เดือน');
            data.addColumn('number', 'เรื่อง');
            data.addRows([
                ['ต.ค.',<?php echo $amount_con_M[10] ; ?>],
                ['พ.ย.',<?php echo $amount_con_M[11] ; ?>],
                ['ธ.ค.',<?php echo $amount_con_M[12] ; ?>],
                ['ม.ค.',<?php echo $amount_con_M[1] ; ?>],
                ['ก.พ.',<?php echo $amount_con_M[2] ;?>],
                ['มี.ค.',<?php echo $amount_con_M[3] ; ?>],
                ['เม.ย.',<?php echo $amount_con_M[4] ; ?>],
                ['พ.ค.',<?php echo $amount_con_M[5] ; ?>],
                ['มิ.ย.',<?php echo $amount_con_M[6] ; ?>],
                ['ก.ค.',<?php echo $amount_con_M[7] ; ?>],
                ['ส.ค.',<?php echo $amount_con_M[8] ; ?>],
                ['ก.ย.',<?php echo $amount_con_M[9] ; ?>],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                }
            ]);

            var options = {
                fontName:'Kanit',
                fontSize:16,
                width: "100%",
                colors:['#F67A37'],
                legend:{position:'center'},
                bar: {
                    groupWidth: "80%"
                },
                height: '90%',
                vAxis: {
                    title: 'เรื่อง'
                },
                hAxis: {
                    title: 'เดือน',
                    fontName:'Kanit'
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('amountPurchase_cahrt'));
            chart.draw(view, options);
        }
    </script>
    
<script type="text/javascript">
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'เดือน');
            data.addColumn('number', 'บาท');
            data.addRows([
                ['ต.ค.',<?php echo $amount_conbudget_M[10] ; ?>],
                ['พ.ย.',<?php echo $amount_conbudget_M[11] ; ?>],
                ['ธ.ค.',<?php echo $amount_conbudget_M[12] ; ?>],
                ['ม.ค.',<?php echo $amount_conbudget_M[1] ; ?>],
                ['ก.พ.',<?php echo $amount_conbudget_M[2] ; ?>],
                ['มี.ค.',<?php echo $amount_conbudget_M[3] ; ?>],
                ['เม.ย.',<?php echo $amount_conbudget_M[4] ; ?>],
                ['พ.ค.',<?php echo $amount_conbudget_M[5] ; ?>],
                ['มิ.ย.',<?php echo $amount_conbudget_M[6] ; ?>],
                ['ก.ค.',<?php echo $amount_conbudget_M[7] ; ?>],
                ['ส.ค.',<?php echo $amount_conbudget_M[8] ; ?>],
                ['ก.ย.',<?php echo $amount_conbudget_M[9] ; ?>],
            ]);
            var formatNumber = new google.visualization.NumberFormat({
                pattern: '#,###,###,###,###,##0'
            });
            formatNumber.format(data, 1);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                }
            ]);

            var options = {
                fontName:'Kanit',
                fontSize:16,
                width: "100%",
                colors:['#F67A37'],
                legend:{position:'center'},
                bar: {
                    groupWidth: "80%"
                },
                height: '90%',
                vAxis: {
                    title: 'บาท'
                },
                hAxis: {
                    title: 'เดือน',
                    fontName:'Kanit'
                },
                annotations: {
                    textStyle: {
                        fontSize: 14,
                        color: 'black',
                        strokeSize: 0,
                        auraColor: 'transparent'
                    },
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('budgetPurchase_cahrt'));
            chart.draw(view, options);
        }
    </script>

@endsection