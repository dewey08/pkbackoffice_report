<style>
        .center {
        margin: auto;
        width: 100%;
        padding: 10px;
        }
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;            
            }
        label{
            font-family: 'Kanit', sans-serif;
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

        function timeformate($strtime)
        {   
        list($a,$b) = explode(':',$strtime);
        return $a.":".$b;
        }
?>