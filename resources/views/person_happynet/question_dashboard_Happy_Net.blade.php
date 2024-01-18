@extends('layouts.happy')
@section('css_before')
    <?php
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);
    ?>

    <style>
        body * {
            font-family: 'Kanit', sans-serif;
        }

        p {
            word-wrap: break-word;
        }

        .text {
            font-family: 'Kanit', sans-serif;
        }

        .card-white .card-heading {
            color: #333;
            background-color: #fff;
            border-color: #ddd;
            border: 1px solid #dddddd;
        }

        .card-white .card-footer {
            background-color: #fff;
            border-color: #ddd;
        }

        .card-white .h5 {
            font-size: 14px;
            //font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }

        .card-white .time {
            font-size: 12px;
            //font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }

        .post .post-heading {
            height: 95px;
            padding: 20px 15px;
        }

        .post .post-heading .avatar {
            width: 60px;
            height: 60px;
            display: block;
            margin-right: 15px;
        }

        .post .post-heading .meta .title {
            margin-bottom: 0;
        }

        .post .post-heading .meta .title a {
            color: black;
        }

        .post .post-heading .meta .title a:hover {
            color: #aaaaaa;
        }

        .post .post-heading .meta .time {
            margin-top: 8px;
            color: #999;
        }

        .post .post-image .image {
            width: 100%;
            height: auto;
        }

        .post .post-description {
            padding: 15px;
        }

        .post .post-description p {
            font-size: 14px;
        }

        .post .post-description .stats {
            margin-top: 20px;
        }

        .post .post-description .stats .stat-item {
            display: inline-block;
            margin-right: 15px;
        }

        .post .post-description .stats .stat-item .icon {
            margin-right: 8px;
        }

        .post .post-footer {
            border-top: 1px solid #ddd;
            padding: 15px;
        }

        .post .post-footer .input-group-addon a {
            color: #454545;
        }

        .post .post-footer .comments-list {
            padding: 0;
            margin-top: 20px;
            list-style-type: none;
        }

        .post .post-footer .comments-list .comment {
            display: block;
            width: 100%;
            margin: 20px 0;
        }

        .post .post-footer .comments-list .comment .avatar {
            width: 35px;
            height: 35px;
        }

        .post .post-footer .comments-list .comment .comment-heading {
            display: block;
            width: 100%;
        }

        .post .post-footer .comments-list .comment .comment-heading .user {
            font-size: 14px;
            font-weight: bold;
            display: inline;
            margin-top: 0;
            margin-right: 10px;
        }

        .post .post-footer .comments-list .comment .comment-heading .time {
            font-size: 12px;
            color: #aaa;
            margin-top: 0;
            display: inline;
        }

        .post .post-footer .comments-list .comment .comment-body {
            margin-left: 50px;
        }

        .post .post-footer .comments-list .comment>.comments-list {
            margin-left: 50px;
        }

    </style>
    <style>
        .bu1 {
            background-color: #3b9ae1;
        }

        .bu2 {
            background-color: #0e4b89;
        }

        .bu3 {
            background-color: #378fc7;
        }

        .bu4 {
            background-color: #5abcf4;
        }

        .bu5 {
            background-color: #082f5a;
        }

    </style>



    {{-- text --}}
    <style>
        /* * {
                            box-sizing: border-box;
                        } */

        /* body {
                            background-color: #f1f1f1;
                        } */

        /* #regForm {
                            background-color: #ffffff;
                            margin: 100px auto;
                            font-family: Raleway;
                            padding: 40px;
                            width: 70%;
                            min-width: 300px;
                        } */

        /* h1 {
                            text-align: center;
                        } */

        /* input {
                            padding: 10px;
                            width: 100%;
                            font-size: 17px;
                            font-family: Raleway;
                            border: 1px solid #aaaaaa;
                        } */

        /* Mark input boxes that gets an error on validation: */
        /* input.invalid {
                            background-color: #ffdddd;
                        } */

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        .myButton {
            background-color: #38aa57;
            border-radius: 28px;
            border: 1px solid #38aa57;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            
            font-size: 17px;
            padding: 16px 47px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #69ac5e;
        }

        .myButton:hover {
            background-color: #69ac5e;
        }

        .myButton:active {
            position: relative;
            top: 1px;
        }

        .myButton2 {
            background-color: #f01835;
            border-radius: 28px;
            border: 1px solid #f01835;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            
            font-size: 17px;
            padding: 16px 40px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #db4242;
        }

        .myButton2:hover {
            background-color: #db4242;
        }

        .myButton2:active {
            position: relative;
            top: 1px;
        }

        /* button {
                            background-color: #04AA6D;
                            color: #ffffff;
                            border: none;
                            padding: 10px 20px;
                            font-size: 17px;
                            font-family: Raleway;
                            cursor: pointer;
                        } */

        /* button:hover {
                            opacity: 0.8;
                        } */

        /* #prevBtn {
                            background-color: #ff0000;
                        } */

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
        }

    </style>
    {{-- test --}}
@endsection
@section('content')

    <div class="block mb-4" style="width: 95%;margin:auto">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title text-center fs-24">คำถามประจำวันนี้</h3>
            </div>
            <hr>
        </div>
        <!-- content market -->
        <div class="block-content  shadow">
            <form id="score" action="{{ route('happy.sum_question_dashboard') }}" method="get">
                @csrf

                <?php $number = 0; ?>
                @foreach ($question as $Q0)
                    <?php $number++; ?>
                    <!-- One "tab" for each step in the form: -->
                    <div class="tab">
                        <div class="col-12">
                            <div class="col-6">
                                <h1 style="font-size:2em" class="text-center">คำถามที่ : {{ $number }}</h1>
                            </div>
                            <div class="6"></div>
                        </div>
                     
                            <div class="col-12">
                                <input type="hidden" value="{{ $Q0->HAPPY_NET_QUESTION_ID }}">
                                <center>
                                    <img width="300"  src="data:image/png;base64,{{ chunk_split(base64_encode($Q0->HAPPY_NET_QUESTION_IMAGE)) }}">
                                </center>
                            </div>
                            <div class="col-12 text-center"><br>
                                <h1 style="font-size:1.8em"><span style="color: #777777">คำถาม :</span>
                                    {{ $Q0->HAPPY_NET_QUESTION }}</h1>
                            </div>
              

                        <div style="overflow:auto;">
                            <div style="float:center;">
                                <center>
                                    <button type="button" class="myButton"
                                        id="HAPPY_NET_ANSWER_SCORE_YES{{ $Q0->HAPPY_NET_QUESTION_ID }}"
                                        name="HAPPY_NET_ANSWER_SCORE_YES"
                                        onclick="nextPrev(1);inseartdata({{ $Q0->HAPPY_NET_QUESTION_ID }},'yes')">
                                        ใช่</button>
                                    &nbsp;&nbsp;&nbsp;
                                    <button type="button" class="myButton2"
                                        id="HAPPY_NET_ANSWER_SCORE_NO{{ $Q0->HAPPY_NET_QUESTION_ID }}"
                                        name="HAPPY_NET_ANSWER_SCORE_NO"
                                        onclick="nextPrev(1);inseartdata({{ $Q0->HAPPY_NET_QUESTION_ID }},'no')">ไม่ใช่</button>



                                </center>
                            </div>
                        </div>

                    </div>



                @endforeach



                <!-- Circles which indicates the steps of the form: -->

                <div style="text-align:center;margin-top:40px; ">
                    <?php $number = 0; ?>
                    @foreach ($question as $Q0)
                        <?php $number++; ?>

                        <span class="step"></span>

                    @endforeach

                </div>


            </form>


            <br><br>
        </div>
    </div>

@endsection

@section('footer')




    <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script>
    <script src="{{ asset('asset/js/dashmix.app.min.js') }}"></script>



    <script src="{{ asset('asset/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('asset/js/pages/be_forms_wizard.min.js') }}"></script>


    {{-- test --}}
    <script>
        function inseartdata(idref, resultyn) {

            // alert(resultyn);

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('happy.inseartdata') }}",
                method: "GET",
                data: {
                    idref: idref,
                    resultyn: resultyn,
                    _token: _token
                }
            })

        }


        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            // if (n == 0) {
            //     document.getElementById("HAPPY_NET_ANSWER_SCORE").style.display = "inline";
            // } else {
            //     document.getElementById("HAPPY_NET_ANSWER_SCORE").style.display = "inline";
            // }
            // if (n == (x.length - 1)) {
            //     document.getElementById("HAPPY_NET_ANSWER_SCORE").innerHTML = "ใช่";
            // } else {
            //     document.getElementById("HAPPY_NET_ANSWER_SCORE").innerHTML = "ใช่";
            // }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;

            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("score").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }

        //-------------------
    </script>

@endsection
