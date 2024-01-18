@extends('layouts.car')

<link rel="stylesheet" href="{{ asset('asset/js/plugins/nestable2/jquery.nestable.min.css') }}">

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
<body>
<center>
<div class="block" style="width: 95%;">

<div style="width: 95%;"> 
   <!-- Connected lists -->
   <h2 class="content-heading" style="font-family: 'Kanit', sans-serif;font-weight:normal;">รายงานระบบบริหารยานพาหนะ</h2>
                    <div class="row">
                        <div class="col-xl-4">
                            <!-- Simple -->
                            <div class="block block-rounded block-bordered">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ทะเบียนรถทั่วไป</h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="js-nestable-connected-simple dd">
                                        <ol class="dd-list">
                                    
                                            
                                            <li class="dd-item"  data-id="1">
                                            <a href=""><div class="dd-handle" style="text-align: left;font-weight:normal;">-</div></a>
                                            </li>
                                            <li class="dd-item"  data-id="2">
                                            <a href="">    <div class="dd-handle" style="text-align: left;font-weight:normal;">-</div></a>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <!-- END Simple -->

<!--<a href="{{ url('manager_book/report/disposereceipt') }}" class="btn btn-info btn-lg active"  role="button" aria-pressed="true">ทะเบียนรับที่ถูกจำหน่าย</a>
<a href="{{ url('manager_book/report/disposeout') }}" class="btn btn-info btn-lg active"  role="button" aria-pressed="true">ทะเบียนส่งที่ถูกจำหน่าย</a>
<br>-->
<br>
 </div>

                     
 </div>
 </body>
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

    <!-- Page JS Plugins -->

    <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script>

<!--
    Dashmix JS

    Custom functionality including Blocks/Layout API as well as other vital and optional helpers
    webpack is putting everything together at assets/_es6/main/app.js
-->




@endsection