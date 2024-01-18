<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('asset/media/favicons/logo_cir.png') }}">
    <title>print</title>
    <link rel="stylesheet" id="css-main" href="{{ asset('asset/css/dashmix.css') }}">
    <link rel="stylesheet" href="{{asset('css/stylesl.css').'?v='.time()}}">
    <style>
        body * {
            font-family: 'Kanit', sans-serif;
        }
    </style>
    <style>
        @media print {

            /* html,
            body {
                -webkit-print-color-adjust: exact;
                width: 100mm;
                width: 100mm;
            } */
            @page {
                size: auto;
                /* size: 50mm 20mm; */
                margin: 0px;
            }

            .pageSmall {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
                /* overflow:hidden; */
            }

            .pageBig {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <?php
    $barcode_generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    use App\Models\cpay_setequpment_list;
?>
    <div class="block d-print-none">
        <div class="block-header border ">
            <div class="block-title fs-18 fw-7">ปริ้นสติกเกอร์</div>
            <div class="block-options fs-18 fw-7">
                <button type="button" class="btn btn-sm btn-primary f-kanit" onclick="printSmall()">
                    <div class="fa fa-barcode mr-2"></div>ปริ้นสติกเกอร์เล็ก
                </button>
                <button type="button" class="btn btn-sm btn-primary f-kanit" onclick="printBig()">
                    <div class="fa fa-barcode mr-2"></div>ปริ้นสติกเกอร์ใหญ่
                </button>
            </div>
        </div>
        <div class="block-body d-block justify-content-center">
            <?php
                        $temp_row_setequpment   = '
                        <tr>
                        <td class="p-0 overflow-hidden" style="width:165px;vertical-align: text-top;">[[equp_list]]</td>
                        <td class="p-0 text-center overflow-hidden" style="width:66px;vertical-align: text-top;">[[num]]</td>
                        </tr>';
                        $template               = '<div class="boreder pageBig overflow-hidden position-relative" style="
                                            width:calc(5.08cm*1.50);
                                            height:calc(7.302cm*1.49);
                                            background:white;
                                            overflow:hidden;
                                            padding:1mm;
                                            color:black;
                                            ">
                                                <div class="fs-12 fw-6 position-absolute" style="
                                                    width: 200px;
                                                    transform-origin: top left;
                                                    transform: rotate(-90deg);
                                                    text-align:center;
                                                    top:405px;left:10px">[[hospital_name]]</div>

                                                <div class="fs-12 fw-b position-absolute text-left text-nowrap overflow-hidden" style="
                                                    top:5px;left: 70px;width: 100px;">[[type_steam]]</div>
                                                <div class="fs-12 fw-8 position-absolute" style="
                                                    width: 100px;
                                                    top:5px;left:188px">[[dep_name]]</div>
                                                
                                                <div class="fs-14 fw-6 position-absolute text-center" style="line-height:1;overflow-wrap:anywhere;
                                                    top:35px;left:70px;width:210px;">[[equpment]]</div>

                                                <div class="fs-14 position-absolute text-nowrap overflow-hidden" style="top:70px;left:80px;width:150px">วันที่ผลิต
                                                [[production_date]]</div>
                                                <div class="fs-10 position-absolute text-nowrap overflow-hidden" style="top:75px;left:235px;width:45px">อายุ 
                                                [[expire_day]] วัน</div>
                                                <div class="fs-14 position-absolute text-nowrap overflow-hidden" style="top:100px;left:80px;width:190px">วันหมดอายุ
                                                [[expire_date]]</div>
                                                    
                                                <div class="position-absolute" style="top:120px;left:70px">
                                                    <table width="200px" class="fs-12" style="color:black;table-layout:fixed;height:170px">
                                                        <thead>
                                                            <tr>
                                                                <th width="160px" class="pl-1">รายการ</th>
                                                                <th width="40px" class="text-center">จำนวน</th>
                                                            </tr>
                                                        </thead>
                                                        <col width="160px" />
                                                        <col width="40px" />
                                                        <tbody>
                                                            [[row_setequp_list]]
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <div class="fs-12 position-absolute text-nowrap overflow-hidden" style="top:295px;left:75px;width:100px">ผู้ผลิต [[p_production]]</div>
                                                <div class="fs-12 position-absolute text-nowrap overflow-hidden" style="top:310px;left:75px;width:100px">ผู้ตรวจ [[p_check]]</div>
                                                <div class="fs-12 position-absolute text-nowrap overflow-hidden" style="top:295px;left:175px;width:100px">ผู้นึ่ง/อบ [[p_sterilize]]</div>
                                                <div class="fs-12 position-absolute text-nowrap overflow-hidden" style="top:310px;left:175px;width:75px">รอบผลิต [[around]]</div>
                                                <div class="fs-12 position-absolute text-nowrap overflow-hidden" style="top:325px;left:75px;width:200px">เครื่อง ([[mach_num]]) [[mach_name]]</div>

                                                <div class="fs-10 position-absolute" style="top:350px;left:70px;width:200px;">
                                                    <div class="text-center">[[label]]<br>
                                                        <img src="data:image/png;base64,[[barcode_label]]" style="width:100%;height:40px">
                                                    </div>
                                                </div>
                                            </div>';
                        $template = str_replace('[[row_setequp_list]]',$temp_row_setequpment,$template);
                        echo $template;

                ?>
                <?php 
                        $template  = '<div class="boreder pageSmall overflow-hidden position-relative" style="
                        width:calc(3.0cm*1.50);
                        height:calc(3.9cm*1.49);
                        background:white;
                        overflow:hidden;
                        color:black;
                        ">
                            <div class="fs-9 fw-6 position-absolute  text-nowrap overflow-hidden" style="top:2px;left:5px;width:85px">[[hospital_name]]</div>
                            <div class="fs-9 fw-6 text-right position-absolute text-nowrap overflow-hidden" style="top:2px;right:5px;width:70px;">[[dep_name]]</div>
                            
                            <div class="fs-10 fw-6 position-absolute text-right text-nowrap text-right overflow-hidden" style="
                                top: 35px; 
                                right: 5px;
                                width: 150px;
                                ">[[type_steam]]</div>

                            <div class="fs-16 fw-6 position-absolute text-center" style="
                                line-height:1;
                                overflow-wrap:anywhere;
                                top: 60px;
                                left:15px;
                                width:150px">
                            [[equpment]]</div>
                            <div class="fs-10 position-absolute text-nowrap overflow-hidden" style="top:95px;left:10px;width:100px">วันที่ผลิต
                            [[production_date]]</div>
                            <div class="fs-8 position-absolute text-nowrap overflow-hidden" style="top:95px;left:110px;width:55px">อายุ 
                            [[expire_day]] วัน</div>
                            <div class="fs-13 position-absolute text-nowrap overflow-hidden" style="top:105px;left:10px;width:160px">วันหมดอายุ
                            [[expire_date]]</div>


                            <div class="fs-9 position-absolute text-nowrap overflow-hidden" style="top:130px;left:10px;width:48%">ผู้ผลิต [[p_production]]</div>
                            <div class="fs-9 position-absolute text-nowrap overflow-hidden" style="top:145px;left:10px;width:48%">ผู้ตรวจ [[p_check]]</div>
                            <div class="fs-9 position-absolute text-nowrap overflow-hidden" style="top:130px;left:100px;width:40%">ผู้นึ่ง/อบ [[p_sterilize]]</div>
                            <div class="fs-9 position-absolute text-nowrap overflow-hidden" style="top:145px;left:100px;width:40%">รอบผลิต [[around]]</div>
                            <div class="fs-7 position-absolute text-nowrap overflow-hidden" style="top:160px;left:10px;width:90%">เครื่อง ([[mach_num]]) [[mach_name]]</div>
                            <div class="fs-8 position-absolute" style="
                                top:175px;
                                right:5px;
                                width:156px">
                                <div class="text-center">[[label]]<br>
                                    <img src="data:image/png;base64,[[barcode_label]]" style="width:100%;height:25px">
                                </div>
                            </div>
                        </div>';

                    echo $template;
                ?>

        </div>
        <h3 class="m-0 ml-3">สำหรับขนาดเล็ก (ไม่มีรายการย่อย)</h3>
        <div id="show_cardsmall" style="
                display:grid;
                grid-column-gap:10px;
                grid-row-gap:10px;
                grid-template-columns: auto auto auto auto auto;
                justify-items:center;
                background:#dcdcdc;
                padding:10px
            "></div>
        <h3 class="m-0 ml-3">สำหรับขนาดใหญ่ (มีรายการย่อย)</h3>
        <div id="show_cardbig" style="
                display:grid;
                grid-column-gap:10px;
                grid-row-gap:10px;
                grid-template-columns: auto auto auto auto;
                justify-items:center;
                background:#dcdcdc;
                padding:10px
            "></div>
    </div>
    </div>
    <div id="cardsmall" class="d-none d-print-block"></div>
    <div id="cardbig" class="d-none d-print-block"></div>
    </div>
    </div>
    <script src="{{ asset('asset/js/dashmix.app.js') }}"></script>
    <script>
        // ปริ้นภายในหน้า และเลือกส่วนที่ปริ้นได้
        // const printContentsSmall = $('.pageSmall')
        const printContentsSmall = document.querySelectorAll('.pageSmall');
        let divToShowSmall = document.getElementById('show_cardsmall');
        let divToPrintSmall = document.getElementById('cardsmall');
        // for (const item in printContentsSmall) {
        //     // divToShowSmall.html += printContentsSmall[item];
        // }

        printContentsSmall.forEach(function (ele, index) {
            // let aBlock = document.createElement('block').appendChild();
            divToShowSmall.append(ele.cloneNode(true));
            divToPrintSmall.append(ele);
            // divToPrintSmall.cloneNode(ele);
        });

        const printContentsBig = $('.pageBig')
        let divToShowBig = document.getElementById('show_cardbig');
        let divToPrintBig = document.getElementById('cardbig');
        printContentsBig.each(function (index, ele) {
            divToShowBig.append(ele.cloneNode(true));
            divToPrintBig.appendChild(ele);
        });
        // printSmall()
        // printBig()
        // window.print();
        function printSmall() {
            let divToPrintSmall = document.getElementById('cardsmall');
            var html = '<html>' + // 
                '<head>' +
                '<link rel="shortcut icon" href="{{ asset("asset/media/favicons/logo_cir.png") }}">' +
                '<title>ปริ้่นสติ๊กเกอร์ขนาดเเล็ก</title>' +
                '<link rel="stylesheet" id="css-main" href="{{ asset("asset/css/dashmix.css") }}">' +
                '<link rel="stylesheet" href="{{asset("css/stylesl.css")."?v=".time()}}">' +
                '<style>' +
                'body * {' +
                'font-family: "Kanit", sans-serif;' +
                '}' +
                '@media print {' +
                '@page{' +
                'size: auto;' +
                '}' +
                '.pageSmall {' +
                'margin: 0;' +
                'border: initial;' +
                'border-radius: initial;' +
                'width: initial;' +
                'min-height: initial;' +
                'box-shadow: initial;' +
                'background: initial;' +
                'page-break-after: always;' +
                '}}' +
                '</style>' +
                '</head>' +
                '<body onload="window.print(); window.close();">' + divToPrintSmall.innerHTML +
                '</body>' +
                '</html>';
            console.log(divToPrintSmall);
            // var popupWin = window.open('', "PRINT",
            // "toolbar=no,menubar=no,location=no,resizable=no,status=yes,scrollbars=yes,fullscreen=yes");
            if (divToPrintSmall.innerHTML !== '') {
                var popupWin = window.open();
                popupWin.document.write(html); //โหลด print.css ให้ทำงานก่อนสั่งพิมพ์
                popupWin.focus();
                popupWin.document.close();
            }
        }

        function printBig() {
            let divToPrintBig = document.getElementById('cardbig');
            var html = '<html>' + // 
                '<head>' +
                '<title>ปริ้่นสติ๊กเกอร์ขนาดใหญ่</title>' +
                '<link rel="stylesheet" id="css-main" href="{{ asset("asset/css/dashmix.css") }}">' +
                '<link rel="stylesheet" href="{{asset("css/stylesl.css")."?v=".time()}}">' +
                '<style>' +
                'body * {' +
                'font-family: "Kanit", sans-serif;' +
                '}' +
                '@media print {' +
                '@page{' +
                'size: auto;' +
                '}' +
                '.pageBig {' +
                'margin: 0;' +
                'border: initial;' +
                'border-radius: initial;' +
                'width: initial;' +
                'min-height: initial;' +
                'box-shadow: initial;' +
                'background: initial;' +
                'page-break-after: always;' +
                '}}' +
                '</style>' +
                '</head>' +
                '<body style="padding:0px" onload="window.print(); window.close();">' + divToPrintBig.innerHTML +
                '</body>' +
                '</html>';
            // var popupWin = window.open('', "PRINT",
            // "toolbar=no,menubar=no,location=no,resizable=no,status=yes,scrollbars=yes,fullscreen=yes");
            if (divToPrintBig.innerHTML !== '') {
                var popupWin = window.open();
                popupWin.document.write(html); //โหลด print.css ให้ทำงานก่อนสั่งพิมพ์
                popupWin.document.close();
            }
        }
    </script>

</body>

</html>