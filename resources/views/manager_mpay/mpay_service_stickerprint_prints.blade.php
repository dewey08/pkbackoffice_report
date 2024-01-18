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
    use App\Models\Cpay_setequpment_list;
?>
    <div class="block d-print-none">
        <div class="block-header border ">
            <div class="block-title fs-18 fw-7">ปริ้นสติกเกอร์</div> <a href="{{route('mpay.mpay_service_stickerprint_add')}}" class="btn btn-danger">กลับไปยังหน้าพิมพ์สติ๊กเกอร์</a>
            <div class="block-options fs-18 fw-7">
                <button type="button" class="btn btn-sm btn-primary f-kanit" onclick="printSmall()">
                    <div class="fa fa-barcode mr-2"></div>ปริ้นสติ๊กเกอร์เล็ก
                </button>
                <button type="button" class="btn btn-sm btn-primary f-kanit" onclick="printBig()">
                    <div class="fa fa-barcode mr-2"></div>ปริ้นสติ๊กเกอร์ใหญ่
                </button>
            </div>
        </div>
        <div class="block-body d-block justify-content-center">
            <?php
                foreach($production_prints as $product){
                    if($product->CPAY_SET_HAVE_LIST){
                        
                        $setequpments   = Cpay_setequpment_list::where('CPAY_SET_ID',$product->CPAY_SET_ID)
                                        ->leftJoin('cpay_setequpment_sub','cpay_setequpment_sub.CPAY_SET_SUB_ID','cpay_setequpment_list.CPAY_SET_SUB_ID')->get();
         
                        $round = -1;
                        $set_list_round = array();
                        foreach ($setequpments as $key => $row) {
                            if($key%11 == 0){
                                $round++;
                            }
                            $set_list_round[$round] = !empty($set_list_round[$round])?$set_list_round[$round]:'';
                            $temp_row_setequpment   = $template_big_list;
                            $row_list               = str_replace('[[equp_list]]',$row->CPAY_SET_SUB_NAME_INSIDE,$temp_row_setequpment);
                            $row_list               = str_replace('[[num]]',$row->CPAY_SETLIST_QUANTITY,$row_list);
                            $set_list_round[$round] .= $row_list;
                        }
                        $template = '';
                        foreach($set_list_round as $template_list){
                            $row_setequpment = $template_list;
                            if(empty($template)){
                                $template       = $template_big;
                            }else{
                                $template       .= $template_big;
                            }
                            $template = str_replace('[[type_steam]]',$product->CPAY_TYPEMACH_NAME,$template);
                            $template = str_replace('[[hospital_name]]',$hostpital_name,$template);
                            $template = str_replace('[[dep_name]]',$product->DEP_CODE,$template);
                            $template = str_replace('[[equpment]]',$product->CPAY_SET_NAME,$template);
                            $template = str_replace('[[production_date]]',toDatePicker($product->PRODUCTION_DATE),$template);
                            $template = str_replace('[[expire_date]]',toDatePicker($product->EXPIRATION_DATE),$template);
                            $template = str_replace('[[p_production]]',$product->MANUFACTURER_PERSON_NAME,$template);
                            $template = str_replace('[[p_check]]',$product->CEHCK_PERSON_NAME,$template);
                            $template = str_replace('[[p_sterilize]]',$product->STERLIZE_PERSON_NAME,$template);
                            $template = str_replace('[[mach_num]]',$product->CPAY_MACH_NUMBER,$template);
                            $template = str_replace('[[mach_name]]',$product->CPAY_MACH_NAME_INSIDE,$template);
                            $template = str_replace('[[around]]',$product->PRODUCTION_AROUND,$template);
                            $template = str_replace('[[label]]',$product->PRODUCT_BARCODE,$template);
                            $barcode = $barcode_generator->getBarcode($product->PRODUCT_BARCODE,$barcode_generator::TYPE_CODE_128);
                            $template = str_replace('[[barcode_label]]',base64_encode($barcode),$template);
                            $template = str_replace('[[expire_day]]',$product->CPAY_SET_STERILE_DAY,$template);
                            $template = str_replace('[[row_setequp_list]]',$row_setequpment,$template);
                        }
                    }else{
                        $template  = $template_small;
                        $template = str_replace('[[type_steam]]',$product->CPAY_TYPEMACH_NAME,$template);
                        $template = str_replace('[[hospital_name]]',$hostpital_name,$template);
                        $template = str_replace('[[dep_name]]',$product->DEP_CODE,$template);
                        $template = str_replace('[[equpment]]',$product->CPAY_SET_NAME,$template);
                        $template = str_replace('[[production_date]]',toDatePicker($product->PRODUCTION_DATE),$template);
                        $template = str_replace('[[expire_date]]',toDatePicker($product->EXPIRATION_DATE),$template);
                        $template = str_replace('[[p_production]]',$product->MANUFACTURER_PERSON_NAME,$template);
                        $template = str_replace('[[p_check]]',$product->CEHCK_PERSON_NAME,$template);
                        $template = str_replace('[[p_sterilize]]',$product->STERLIZE_PERSON_NAME,$template);
                        $template = str_replace('[[mach_num]]',$product->CPAY_MACH_NUMBER,$template);
                        $template = str_replace('[[mach_name]]',$product->CPAY_MACH_NAME_INSIDE,$template);
                        $template = str_replace('[[around]]',$product->PRODUCTION_AROUND,$template);
                        $template = str_replace('[[label]]',$product->PRODUCT_BARCODE,$template);
                        $barcode = $barcode_generator->getBarcode($product->PRODUCT_BARCODE,$barcode_generator::TYPE_CODE_128);
                        $template = str_replace('[[barcode_label]]',base64_encode($barcode),$template);
                        $template = str_replace('[[expire_day]]',$product->CPAY_SET_STERILE_DAY,$template);
                    }
                    for($i=0;$i<$product->PRODUCTION_QUANTITY;$i++){
                        echo $template;
                    }
                }
                
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
        printSmall()
        printBig()

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
        
        window.location = "{{route('mpay.mpay_service_stickerprint_add')}}";
    </script>
</body>

</html>