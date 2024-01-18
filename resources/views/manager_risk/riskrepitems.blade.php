@extends('layouts.risk')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
@section('content')
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


    <center>    
            <div class="block shadow-lg mt-5" style="width: 95%;">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">                        
                        <div align="left">
                            <h2 class="block-title" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;"><B>อุบัติการณ์ความเสี่ยง</B></h2>
                        </div> 
                        <div align="left">                       
                           <button class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target="#addRiskModal" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;"><i class="fas fa-plus mr-2"></i>เพิ่มข้อมูล</button> 
                        </div>       
                    </div>
                <div class="block-content block-content-full">
                  <div class="table-responsive"> 
                <table class="gwt-table table-striped table-vcenter js-dataTable-full" style="width: 100%;">
                    <thead style="background-color: #C39BD3;">
                        <tr height="40">
                            <th class="text-font" style="text-align: center;" width="7%">ลำดับ</th>
                            <th class="text-font" style="text-align: center;" width="10%">รหัส</th>
                            <th class="text-font" style="text-align: center;" width="20%">ชื่อ</th>
                            <th class="text-font" style="text-align: center;" >รายละเอียด</th>
                            <th class="text-font" style="text-align: center;" width="7%" >คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($risks as $todo)
                        <?php $number++;  ?>
                                <tr id="todo_${todo.RISK_REPDETAIL_ID}">
                                    <td class="text-font" style="text-align: center;" width="7%">{{ $number}}</td>
                                    <td class="text-font text-pedding" width="10%">&nbsp;&nbsp;{{$todo->RISK_REPITEMS_CODE}}</td>
                                    <td class="text-font text-pedding" width="20%">&nbsp;&nbsp;{{$todo->RISK_REPITEMS_NAME}}</td>   
                                     <td class="text-font text-pedding" >
                                         &nbsp;&nbsp;กลุ่มอุบัติการณ์ความเสี่ยง :&nbsp;&nbsp;{{$todo->RISK_GROUP_NAME}}<br>
                                         &nbsp;&nbsp;หมวดอุบัติการณ์ความเสี่ยง :&nbsp;&nbsp;{{$todo->RISK_GROUPSUB_NAME}}<br>
                                         &nbsp;&nbsp;ประเภทอุบัติการณ์ความเสี่ยง :&nbsp;&nbsp;{{$todo->RISK_GROUPSUBSUB_NAME}}<br>
                                         &nbsp;&nbsp;ประเภทอุบัติการณ์ความเสี่ยงย่อย :&nbsp;&nbsp;{{$todo->RISK_REPDETAIL_NAME}}<br>
                                         &nbsp;&nbsp;นิยาม คำอธิบาย ความหมายของอุบัติการณ์ความเสี่ยง :&nbsp;&nbsp;{{$todo->RISK_REPITEMS_DETAIL}}<br>
                                         &nbsp;&nbsp;หมายเหตุ :&nbsp;&nbsp;{{$todo->RISK_REPITEMS_COMMENT}}<br>
                                    
                                    </td>       
                                    <td align="center" width="7%">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu fo13" style="width:10px"> 
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#editRiskModal{{$todo->RISK_REPITEMS_ID}}"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('manager_risk/riskrepitems_destroy/'.$todo->RISK_REPITEMS_ID)}}" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')"><i class="fas fa-trash text-danger mr-2"></i>ลบข้อมูล</a>
                                                </div>
                                            </div>
                                    </td>                                    
                                </tr>

                                 {{-- Modal editModal--}}
                                <div class="modal fade" id="editRiskModal{{$todo->RISK_REPITEMS_ID}}" tabindex="-1" aria-labelledby="addModalModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info shadow-lg">
                                                <h5 class="modal-title text-white" id="addModalModalLabel" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">แก้ไขอุบัติการณ์ความเสี่ยง</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('mrisk.riskrepitems_update') }}" enctype="multipart/form-data">
                                                    @csrf
                                                <input type="hidden" name="risk_id" id="risk_id" value="{{$todo->RISK_REPITEMS_ID}}">
                                                    <div class="row text-left">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">รหัส :</label>
                                                                <input type="text" class="form-control fo13" name="RISK_REPITEMS_CODE" id="RISK_REPITEMS_CODE" value="{{$todo->RISK_REPITEMS_CODE}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">   
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">ชื่อ :</label>
                                                                <input type="text" class="form-control fo13" name="RISK_REPITEMS_NAME" id="RISK_REPITEMS_NAME" value="{{$todo->RISK_REPITEMS_NAME}}" required>
                                                            </div>
                                                        </div>                                                      
                                                    </div> 
                                                    <div class="row text-left">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">กลุ่มอุบัติการณ์ความเสี่ยง </label><label style="color:red;"> **</label><label> :</label>
                                                                <select name="RISK_GROUP_ID" id="RISK_GROUP_ID" class="form-control group fo13" style="width: 100%" required>
                                                                    <option value="">--เลือก--</option>                           
                                                                        @foreach($riskgroups as $riskgroup) 
                                                                        @if ($todo ->RISK_GROUP_ID == $riskgroup-> RISK_GROUP_ID)
                                                                        <option value="{{ $riskgroup-> RISK_GROUP_ID}}" selected>{{ $riskgroup-> RISK_GROUP_CODE}} :: {{ $riskgroup-> RISK_GROUP_NAME}}</option>
                                                                            
                                                                        @else
                                                                        <option value="{{ $riskgroup-> RISK_GROUP_ID}}" >{{ $riskgroup-> RISK_GROUP_CODE}} :: {{ $riskgroup-> RISK_GROUP_NAME}}</option>
                                                                            
                                                                        @endif                                                    
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">หมวดอุบัติการณ์ความเสี่ยง :</label>
                                                                <select name="RISK_GROUPSUB_ID" id="RISK_GROUPSUB_ID" class="form-control groupsub fo13" style="width: 100%" required>
                                                                    <option value="">--เลือก--</option>                           
                                                                        @foreach($riskgroupsubs as $riskgroupsub)  
                                                                        @if ($todo->RISK_GROUPSUB_ID == $riskgroupsub-> RISK_GROUPSUB_ID)
                                                                        <option value="{{ $riskgroupsub-> RISK_GROUPSUB_ID}}" selected>{{ $riskgroupsub-> RISK_GROUPSUB_CODE}} :: {{ $riskgroupsub-> RISK_GROUPSUB_NAME}}</option>
                                                                            
                                                                        @else
                                                                        <option value="{{ $riskgroupsub-> RISK_GROUPSUB_ID}}" >{{ $riskgroupsub-> RISK_GROUPSUB_CODE}} :: {{ $riskgroupsub-> RISK_GROUPSUB_NAME}}</option>
                                                                            
                                                                        @endif                                                   
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        
                                                    </div>  
                                                    <div class="row text-left">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">ประเภทอุบัติการณ์ความเสี่ยง :</label>
                                                                <select name="RISK_GROUPSUBSUB_ID" id="RISK_GROUPSUBSUB_ID" class="form-control groupsubsub fo13" style="width: 100%" required>
                                                                    <option value="">--เลือก--</option>                           
                                                                        @foreach($riskgroupsubsubs as $riskgroupsubsub)   
                                                                        @if ($todo->RISK_GROUPSUBSUB_ID == $riskgroupsubsub-> RISK_GROUPSUBSUB_ID)
                                                                        <option value="{{ $riskgroupsubsub-> RISK_GROUPSUBSUB_ID}}" selected>{{ $riskgroupsubsub-> RISK_GROUPSUBSUB_CODE}}:: {{ $riskgroupsubsub-> RISK_GROUPSUBSUB_NAME}}</option>
                                                                            
                                                                        @else
                                                                        <option value="{{ $riskgroupsubsub-> RISK_GROUPSUBSUB_ID}}" >{{ $riskgroupsubsub-> RISK_GROUPSUBSUB_CODE}}:: {{ $riskgroupsubsub-> RISK_GROUPSUBSUB_NAME}}</option>
                                                                            
                                                                        @endif                                                  
                                                                        @endforeach
                                                                </select>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">ประเภทย่อยอุบัติการณ์ความเสี่ยง :</label>
                                                                <select name="RISK_REPDETAIL_ID" id="RISK_REPDETAIL_ID" class="form-control groupdetail fo13" style="width: 100%" required>
                                                                    <option value="">--เลือก--</option>                           
                                                                        @foreach($riskrepdetails as $riskrepdetail) 
                                                                        @if ($todo->RISK_REPDETAIL_ID == $riskrepdetail-> RISK_REPDETAIL_ID)
                                                                        <option value="{{ $riskrepdetail-> RISK_REPDETAIL_ID}}" selected>{{ $riskrepdetail-> RISK_REPDETAIL_CODE}} :: {{ $riskrepdetail-> RISK_REPDETAIL_NAME}}</option>
                                                                            
                                                                        @else
                                                                        <option value="{{ $riskrepdetail-> RISK_REPDETAIL_ID}}" >{{ $riskrepdetail-> RISK_REPDETAIL_CODE}} :: {{ $riskrepdetail-> RISK_REPDETAIL_NAME}}</option>
                                                                            
                                                                        @endif                                                    
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div> 
                                                                                        
                                                    </div>  
                                                    <div class="row text-left">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">คำอธิบาย ความหมายของอุบัติการณ์ความเสี่ยง :</label>
                                                                <textarea name="RISK_REPITEMS_COMMENT" id="RISK_REPITEMS_COMMENT" class="form-control input-lg fo13"  rows="2" >{{$todo->RISK_REPITEMS_COMMENT}} </textarea>
                                                            </div>
                                                        </div>   
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">รายละเอียด :</label>
                                                                <textarea name="RISK_REPITEMS_DETAIL" id="RISK_REPITEMS_DETAIL" class="form-control input-lg fo13"  rows="2" >{{$todo->RISK_REPITEMS_DETAIL}}  </textarea>
                                                            </div>
                                                        </div> 
                                                    </div>                                                                                                 
                                                </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                <a href="{{ url('manager_risk/riskrepitems')  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                        @endforeach   
                    </tbody>
                </table>
                </div>        
            </div>


            {{-- Modal addriskleModal--}}
            <div class="modal fade" id="addRiskModal" tabindex="-1" aria-labelledby="addModalModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-info shadow-lg">
                            <h5 class="modal-title text-white" id="addModalModalLabel" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">เพิ่มอุบัติการณ์ความเสี่ยง</h5>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('mrisk.riskrepitems_save') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row text-left">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">รหัส </label><label style="color:red;"> **</label><label> :</label>
                                            <input class="form-control fo13" name="RISK_REPITEMS_CODE" id="RISK_REPITEMS_CODE" required>
                                            <span id="risk_groupsubsub_codeError" class="alert-message"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-8">   
                                        <div class="form-group">
                                            <label for="" class="col-form-label">ชื่อ </label><label style="color:red;"> **</label><label> :</label>
                                            <input class="form-control fo13" name="RISK_REPITEMS_NAME" id="RISK_REPITEMS_NAME" required>
                                            <span id="risk_groupsubsub_nameError" class="alert-message"></span>
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">กลุ่มอุบัติการณ์ความเสี่ยง </label><label style="color:red;"> **</label><label> :</label>
                                            <select name="RISK_GROUP_ID" id="RISK_GROUP_ID" class="form-control group fo13" style="width: 100%" required>
                                                <option value="">--เลือก--</option>                           
                                                    @foreach($riskgroups as $riskgroup)                                                     
                                                        <option value="{{ $riskgroup-> RISK_GROUP_ID}}" >{{ $riskgroup-> RISK_GROUP_CODE}} :: {{ $riskgroup-> RISK_GROUP_NAME}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">หมวดอุบัติการณ์ความเสี่ยง :</label>
                                            <select name="RISK_GROUPSUB_ID" id="RISK_GROUPSUB_ID" class="form-control groupsub fo13" style="width: 100%" required>
                                               
                                            </select>
                                        </div>
                                    </div> 
                                    
                                </div>  
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">ประเภทอุบัติการณ์ความเสี่ยง :</label>
                                            <select name="RISK_GROUPSUBSUB_ID" id="RISK_GROUPSUBSUB_ID" class="form-control groupsubsub fo13" style="width: 100%" required>
                                               
                                            </select>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">ประเภทย่อยอุบัติการณ์ความเสี่ยง :</label>
                                            <select name="RISK_REPDETAIL_ID" id="RISK_REPDETAIL_ID" class="form-control groupdetail fo13" style="width: 100%" required>
                                               
                                            </select>
                                        </div>
                                    </div> 
                                                                    
                                </div>  
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">คำอธิบาย ความหมายของอุบัติการณ์ความเสี่ยง :</label>
                                            <textarea name="RISK_REPITEMS_COMMENT" id="RISK_REPITEMS_COMMENT" class="form-control input-lg fo13"  rows="2" > </textarea>
                                        </div>
                                    </div>   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">รายละเอียด :</label>
                                            <textarea name="RISK_REPITEMS_DETAIL" id="RISK_REPITEMS_DETAIL" class="form-control input-lg fo13"  rows="2" > </textarea>
                                        </div>
                                    </div> 
                                </div>                                                                                                 
                            </div> 
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>                           
                            <a href="{{ url('manager_risk/riskrepitems')  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                        </div>
                    </div>
                     </form>
                </div>
            </div>



           

@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
   <!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
   <!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script> 
<script> 
    $(document).ready(function () {            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });  
    $('.group').change(function(){
             if($(this).val()!=''){
                var select=$(this).val();
                var _token=$('input[name="_token"]').val();

                $.ajax({
                    url:"{{route('mrisk.fectgroup')}}",
                    method:"GET",
                    data:{select:select,_token:_token},
                    success:function(result){
                    $('.groupsub').html(result);
                    }
                })
             }        
        });  
        $('.groupsub').change(function(){
             if($(this).val()!=''){
                var select=$(this).val();
                var _token=$('input[name="_token"]').val();

                $.ajax({
                    url:"{{route('mrisk.fectgroupsub')}}",
                    method:"GET",
                    data:{select:select,_token:_token},
                    success:function(result){
                    $('.groupsubsub').html(result);
                    }
                })
             }        
        });   
        $('.groupsubsub').change(function(){
             if($(this).val()!=''){
                var select=$(this).val();
                var _token=$('input[name="_token"]').val();

                $.ajax({
                    url:"{{route('mrisk.fectgroupsubsub')}}",
                    method:"GET",
                    data:{select:select,_token:_token},
                    success:function(result){
                    $('.groupdetail').html(result);
                    }
                })
             }        
        });   
</script>

@endsection