<link  href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gotowin Barcode</title>
</head>
<body>
                
            <?php
                $generator = new \Picqer\Barcode\BarcodeGeneratorJPG();
                $Pi = '<img src="data:image/jpeg;base64,' . base64_encode($generator->getBarcode($infoasset->ARTICLE_NUM, $generator::TYPE_CODE_128,2,30)) . '" height="30px" width="150px" > ';
                echo $Pi;
            ?>              
                <br>
                    {{ $infoasset->ARTICLE_NUM }}
                <br>
            <br>

           
   </body>
</html>
   
