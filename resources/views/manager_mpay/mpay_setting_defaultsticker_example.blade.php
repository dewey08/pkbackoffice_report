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
            if($sticker->CAPY_STICK_FOR_LIST){
                        $temp_row_setequpment   = $sticker->CPAY_STICKER_HTML_FORMAT_LIST;
                        $template               = $sticker->CAPY_STICK_HTML_FORMAT;
                        $row_setequpment = '';
                        for($i=0;$i<5;$i++){
                            $row_setequpment .= $temp_row_setequpment;
                        }
                        $template = str_replace('[[row_setequp_list]]',$row_setequpment,$template);
                    }else{
                        $template  = $sticker->CAPY_STICK_HTML_FORMAT;
                    }
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