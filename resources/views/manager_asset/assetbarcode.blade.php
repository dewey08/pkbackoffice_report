
<body onload="window.print()">
    <center style="margin-top: 10px;">       
        <?php
            $generator = new \Picqer\Barcode\BarcodeGeneratorJPG();
            $Pi = '<img src="data:image/jpeg;base64,' . base64_encode($generator->getBarcode($infoasset->ARTICLE_NUM, $generator::TYPE_CODE_128,1,60)) . '" " > ';
            echo $Pi;
        ?>              
        <br>
        {{ $infoasset->ARTICLE_NUM }}      
    </center> 
</body>
        
                     
