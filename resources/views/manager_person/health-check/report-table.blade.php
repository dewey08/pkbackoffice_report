@extends('layouts.personhealth')
@section('content')
<style>
    #fontSize{
        font-size: 30px;
    }
    h1{
        font-size: 150px;
    }
    .font-tap-menu{
        font-family: 'Kanit', sans-serif;
        font-size:12px;
        font-size: 1.0rem;
        font-weight:normal;
    }
    .font-table-view{
        font-family: 'Kanit', sans-serif; 
        font-size: 18px;
        font-weight:normal;
        text-align: center;
    }
</style>

<div class="col-md-12" style="margin-top:0px;">
    <div class="block-header block-header-default" style="margin-top:50px;" style="background-color: #fff;">
        <h3 class="block-title text-center" style="font-family: 'Kanit', sans-serif;"><B>รายงานระบบสมรรถภาพ</B></h3>
    </div>
    <div class="block-content" stype="margin-top:20px;">
        <div class="col-md-12" style="margin-left:auto; margin-right:auto;" style="background-color: #E6E6FA">
            <div class="block block-rounded block-bordered">

                {{-- report vital signs สัญญาณชีพ --}}
                @if ($type == 1)
                    <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active " href="#object1">การเต้นหัวใจขณะพัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object2">ความดันโลหิต</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object3">ภาพรวมองค์กร</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object4">ผลตามรายชื่อ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object5">เฉพาะหัวข้อ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object6">รายชื่อเจ้าหน้าที่</a>
                        </li>
                    </ul>

                    <div class="block-content tab-content">
                        {{-- Object1 การเต้นของหัวใจขณะพัก --}}
                        <div class="tab-pane active" id="object1" role="tabpane1">
                            @include('manager_person.health-check.vital-signs.table-heart')
                        </div>

                        {{-- Object2 ความดันโลหิต --}}
                        <div class="tab-pane" id="object2" role="tabpane1">
                            @include('manager_person.health-check.vital-signs.table-blood-pressure')
                        </div>

                        {{-- Object3 ภาพรวมองค์กร --}}
                        <div class="tab-pane" id="object3" role="tabpane1">

                        </div>

                        {{-- Object4 ผลตามรายชื่อ --}}
                        <div class="tab-pane" id="object4" role="tabpane1">

                        </div>

                        {{-- Object5 เฉพาะหัวข้อ --}}
                        <div class="tab-pane" id="object5" role="tabpane1">

                        </div>

                        {{-- Object6 รายชื่อเจ้าหน้าที่ --}}
                        <div class="tab-pane" id="object6" role="tabpane1">

                        </div>
                    </div>

                {{-- body proportions สัดส่วนร่างกาย --}}
                @elseif ($type == 2)
                    <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active " href="#object1">ดัชนีมวลกาย</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object2">ค่า BMI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object3">ปริมาณไขมันในร่างกาย</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object4">เส้นรอบเอวสะโพก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object5">ภาพรวมองค์กร</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object6">ผลตามรายชื่อ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object7">เฉพาะหัวข้อ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object8">รายชื่อเจ้าหน้าที่</a>
                        </li>
                    </ul>

                    <div class="block-content tab-content">
                        {{-- Object1 ดัชนีมวลกาย --}}
                        <div class="tab-pane active" id="object1" role="tabpane1">
                            @include('manager_person.health-check.body-proportions.table-body-mass-index')
                        </div>

                        {{-- Object2 ค่า BMI --}}
                        <div class="tab-pane" id="object2" role="tabpane1">
                            
                        </div>

                        {{-- Object3 ปริมาณไขมันในร่างกาย --}}
                        <div class="tab-pane" id="object3" role="tabpane1">

                        </div>

                        {{-- Object4 เส้นรอบเอวสะโพก --}}
                        <div class="tab-pane" id="object4" role="tabpane1">

                        </div>

                        {{-- Object5 ภาพรวมองค์กร --}}
                        <div class="tab-pane" id="object5" role="tabpane1">

                        </div>

                        {{-- Object6 ผลตามรายชื่อ --}}
                        <div class="tab-pane" id="object6" role="tabpane1">

                        </div>

                        {{-- Object6 เฉพาะหัวข้อ --}}
                        <div class="tab-pane" id="object7" role="tabpane1">

                        </div>

                        {{-- Object6 รายชื่อเจ้าหน้าที่ --}}
                        <div class="tab-pane" id="object8" role="tabpane1">

                        </div>
                    </div>

                {{-- lung capacity ความจุปอด --}}
                @elseif ($type == 3)
                    <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#object1">ความจุปอด</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object2">ภาพรวมองค์กร</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object3">ผลตามรายชื่อ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object4">เฉพาะหัวข้อ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#object5">รายชื่อเจ้าหน้าที่</a>
                        </li>
                    </ul>

                    <div class="block-content tab-content">
                        {{-- Object5 ความจุปอด --}}
                        <div class="tab-pane active" id="object1" role="tabpane1">
                            @include('manager_person.health-check.lung-capacity.table-lung-capacity')
                        </div>

                        {{-- Object5 ภาพรวมองค์กร --}}
                        <div class="tab-pane" id="object2" role="tabpane1">

                        </div>

                        {{-- Object6 ผลตามรายชื่อ --}}
                        <div class="tab-pane" id="object3" role="tabpane1">

                        </div>

                        {{-- Object6 เฉพาะหัวข้อ --}}
                        <div class="tab-pane" id="object4" role="tabpane1">

                        </div>

                        {{-- Object6 รายชื่อเจ้าหน้าที่ --}}
                        <div class="tab-pane" id="object5" role="tabpane1">

                        </div>
                    </div>

                {{-- weakness ความอ่อนตัว --}}
                @elseif ($type == 4)
                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#object1">นั่งงอตัวไปข้างหน้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#object2">แรงบีบมือ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#object3">แรงเหยียดแขน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#object2">แรงเหยียดขา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#object2">วิดพื้น</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#object2">ภาพรวมองค์กร</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#object3">ผลตามรายชื่อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#object4">เฉพาะหัวข้อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#object5">รายชื่อเจ้าหน้าที่</a>
                    </li>
                </ul>

                <div class="block-content tab-content">
                    {{-- Object1 นั่งงอตัวไปข้างหน้า --}}
                    <div class="tab-pane active" id="object1" role="tabpane1">
                        @include('manager_person.health-check.weakness.table-squat')
                    </div>

                    {{-- Object2 แรงบีบมือ --}}
                    <div class="tab-pane" id="object2" role="tabpane1">
                        
                    </div>

                    {{-- Object3 แรงเหยียดแขน --}}
                    <div class="tab-pane" id="object3" role="tabpane1">
                        
                    </div>

                    {{-- Object4 แรงเหยียดขา --}}
                    <div class="tab-pane" id="object4" role="tabpane1">
                        
                    </div>

                    {{-- Object5 วิดพื้น --}}
                    <div class="tab-pane" id="object5" role="tabpane1">
                        
                    </div>

                    {{-- Object6 ภาพรวมองค์กร --}}
                    <div class="tab-pane" id="object6" role="tabpane1">

                    </div>

                    {{-- Object7 ผลตามรายชื่อ --}}
                    <div class="tab-pane" id="object7" role="tabpane1">

                    </div>

                    {{-- Object8 เฉพาะหัวข้อ --}}
                    <div class="tab-pane" id="object8" role="tabpane1">

                    </div>

                    {{-- Object9 รายชื่อเจ้าหน้าที่ --}}
                    <div class="tab-pane" id="object9" role="tabpane1">

                    </div>
                </div>

                @endif

                <div class="col-md-12 text-center" style="margin-top: 30px; margin-left:auto; margin-right:auto;">
                    <div class="row">
                        <span style="margin-left: 90%; margin-top:10px;">
                        <span>
                            <button type="button" class="btn btn-hero-sm btn-hero-danger" onclick="window.location.href='{{ route('manager_person.health-check.report') }}'">กลับ </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection