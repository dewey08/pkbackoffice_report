@extends('layouts.warehouse')



@section('content')

<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 


?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
           
            }

            p {
	
                word-wrap:break-word;
                }
                .text{
                    font-family: 'Kanit', sans-serif;
                     
                }
</style>

<center>
<body>
<div class="block" style="width: 95%;">

<div class="content">


                     
 </div>
 </body>
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>


@endsection