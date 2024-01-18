@extends('layouts.general.person_work')
@section('css_after_infowork')
@endsection
@section('content_infowork')
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>Job description</B>
            </h3>
            <a href="" class="btn btn-info">ผลประเมินรวม</a>
        </div>
        <div class="block-content block-content-full">
            <form class="mb-2" action="{{route('person.infowork.jobdescriptions',auth::user()->PERSON_ID)}}" method="post">
            @csrf
                <div class="row">
                    <div class="col-md-1 col-form-label">ปีงบประมาณ</div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-sm btn-info">ค้นหา</button>
                    </div>
                </div>
            </form>
            <table class="gwt-table table-striped table-vcenter" width="100%">
                <thead style="background-color: #FFEBCD;">

                    <tr height="40">
                        <th class="text-font" width="5%" style="border-color:#F0FFFF; text-align: center;">ลำดับ</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">ลักษณะหน้าที่(JD-Job description)</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">สถานะ</th>
                        <th>คำสั่ง</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('footer_infowork')
@endsection
