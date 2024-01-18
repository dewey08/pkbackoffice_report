@extends('layouts.elearning')
@section('content')
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

</style>
<style>
        .tab {
            display: none;
        }

        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #516BEB;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active {
            opacity: 1;
        }

        .step.finish {
            background-color: #CDDEFF;
        }

    </style>

<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">

        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24"> {{$info_lesson->NAME_LESSON}}</h3>
        </div>      
    <hr> <!-- -ขีด -->
    <div class="row">
        <div class="col-md-1">
            <span><a href="{{ url('e_learning/lesson_video/'.$info_lesson->ID_LESSON) }}"><button type="submit" class="btn btn-hero-sm btn-hero-warning foo14 loadscreen" ><i class="fas fa-angle-left mr-1"></i></button></a></span> 
        </div>
        <div class="col-md-10">
            <br>
             <!-- <div class="progress push">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>             -->
        </div>
        <div class="col-md-1">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- <span><a href="{{ url('e_learning/information_group') }}" ><button type="submit" class="btn btn-hero-sm btn-hero-warning foo14" ><i class="fas fa-angle-right mr-1"></i></button></a></span>  -->
        </div>
    </div>
    
    <div class="block-content my-3 shadow">
            <div class="row">
                <div class="col-md-12">
                    @if (session('alert'))
                    <div class="alert alert-warning alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h3 class="alert-heading font-size-h4 my-2">Warning</h3>
                                        <p class="mb-0"> {{ session('alert') }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" align = 'left'>
                    <h3 class="block-title  fs-24"> แบบทดสอบหลังเรียน</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="block bg-info-lighter" style="  border-radius: 25px;"> 
                        <div class="block-content">
                        <form  id="post_exam" method="post" action="{{url('e_learning/lesson_post_exam/save/'.$info_lesson->ID_LESSON) }}" enctype="multipart/form-data">
                        @csrf 
                                <?php $number = 0; ?>
                                @foreach ($info_question as $row_question)
                                <?php $number++; ?>
                                    <div class="tab">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h1 class="text-center text fs-26">คำถามที่ : {{ $number }}</h1>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" name="STATUS_EXAM" value="1">   
                                            <input type="hidden" name="ID_USER" value="{{ Auth::user()->id }}">  
                                            <input type="hidden" name="ID_EXAM_GROUP" value="{{ $row_question->ID_EXAM_GROUP }}">
                                            <input type="hidden" name="ID_EXAM" value="{{ $row_question->ID_EXAM }}">

                                            <div class="col-md-1"></div>
                                            <div class="col-md-8"><br>
                                                @if($row_question->QUESTION_IMG_EXAMP == '' || $row_question->QUESTION_IMG_EXAMP == NULL )

                                                @else
                                                    <img  alt="" width="200px" src="data:image/png;base64,{{ chunk_split(base64_encode($row_question->QUESTION_IMG_EXAMP)) }}">
                                                @endif
                                                <h3 class="block-title text fs-28">{{$row_question->QUESTION_EXAM}}</h3>
                                                <?php $number_radio = 0; ?>
                                                @foreach ($info_choice as $row_choice)
                                                <?php $number_radio++; ?>
                                                @if($row_question->ID_EXAM == $row_choice->ID_EXAM)
                                                    <div class="form-check fs-22"> 
                                                        <div class="custom-control custom-radio custom-control-primary mb-1">
                                                            <input type="radio" class="custom-control-input" id="example-radio-custom{{$number_radio}}" name="{{ $row_choice->ID_EXAM }}"  onclick="nextPrev(1)" value="{{ $row_choice->ID_EXAM_CHOICE }}">
                                                            <label class="custom-control-label" for="example-radio-custom{{$number_radio}}">{{$row_choice->EXAM_CHOICE}}</label>
                                                        </div>                                                        
                                                    </div>
                                                @endif
                                                @endforeach 
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                        <div style="overflow:auto;">
                                            <div style="float:right;">
                                                    <button type="button" class="btn btn-hero-sm btn-rounded bg-info foo24 text-white text fs-18 " id="prevBtn" onclick="nextPrev(-1)">ถอยกลับ</button>
                                                    <button type="button" class="btn btn-hero-sm btn-rounded bg-success foo24 text-white text fs-18 " name id="nextBtn"onclick="nextPrev(1)">ถัดไป</button>
                                            </div>
                                           
                                        </div>

                                        <div style="text-align:center;margin-top:40px; ">
                                            <?php $number = 0; ?>
                                            @foreach ($info_question as $row_question)
                                                <?php $number++; ?>
                                                <span class="step"></span>
                                            @endforeach
                                        </div>

                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection


@section('footer')
<script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) { 
                document.getElementById("nextBtn").innerHTML = "ส่งคำตอบ";
            }else  {
                document.getElementById("nextBtn").innerHTML = "ถัดไป";
            }


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
                currentTab = currentTab+ n;
            // if you have reached the end of the form...
            if (currentTab == x.length) {
                // ... the form gets submitted:
            
                if (confirm("ท่านต้องการที่จะส่งคำตอบ ?") == false) {
                    currentTab = currentTab - n;
                }else{
                    currentTab = currentTab - n;
                    document.getElementById("post_exam").submit();
                }
                
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
    </script>

<!-- css, js dataTables --> 
    <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
    <script src="{{ asset('asset/js/pages/be_ui_progress.min.js') }}"></script>
    <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script>

    <script src="{{ asset('asset/js/pages/be_ui_progress.min.js') }}"></script>




@endsection

