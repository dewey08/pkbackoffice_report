@extends('layouts.backend_admin')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 10px;
     
      }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
      } 
</style>


@section('content')
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}

  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

?>
<body>
           
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ข้อมูลทะเบียนคุมพัสดุ</h2>    

                

                <form  method="post" action="{{ route('setup.updatesuppliespurchase') }}" enctype="multipart/form-data">
                @csrf
       
 

<div class="row"> 
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>   
    <div class="col-lg-2">
      <div class="form-group">
      <label >ชื่อผู้อนุมัติจ่าย :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
   
    
    <select name="PURCHASE_LEADER_ID" id="PURCHASE_LEADER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
      <option value="">--กรุณาเลือกชื่อผู้อนุมัติจ่าย--</option>
            @foreach ($infopersons as $infoperson)  
                    @if($infosuppliespurchase->PURCHASE_LEADER_ID == $infoperson ->ID )
                    <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                    @else
                    <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                    @endif     
                  
            @endforeach 
      </select>
  
    </div>
    </div> 
</div> 

<div class="row"> 
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>   
    <div class="col-lg-2">
      <div class="form-group">
      <label >เจ้าหน้าที่พัสดุ :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
   
    
    <select name="PURCHASE_OFFICER_ID" id="PURCHASE_OFFICER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
      <option value="">--กรุณาเลือกชื่อเจ้าหน้าที่พัสดุ--</option>
            @foreach ($infopersons as $infoperson)   
            @if($infosuppliespurchase->PURCHASE_OFFICER_ID == $infoperson ->ID )
                    <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                    @else
                    <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                    @endif     
            @endforeach 
      </select>
  
    </div>
    </div> 
</div> 


<div class="row"> 
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>   
    <div class="col-lg-2">
      <div class="form-group">
      <label >หัวหน้าเจ้าหน้าที่ :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
   
    
    <select name="PURCHASE_HEAD_ID" id="PURCHASE_HEAD_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
      <option value="">--กรุณาเลือกชื่อหัวหน้าเจ้าหน้าที่--</option>
            @foreach ($infopersons as $infoperson)   
                    @if($infosuppliespurchase->PURCHASE_HEAD_ID == $infoperson ->ID )
                    <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                    @else
                    <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                    @endif
                  
            @endforeach 
      </select>
  
    </div>
    </div> 
</div> 
                                            <div class="row push">
                                            <div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                            <div class="col-sm-2">
                                            <label>ส่วนราชการ :</label>
                                            </div> 
                                                <div class="col-lg-6">
                                                <input name="PURCHASE_GOV" id="PURCHASE_GOV" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliespurchase->PURCHASE_GOV}}">
                                                </div>
                                            </div>
                                            <div class="row push">
                                            <div>
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                                <div class="col-sm-2">
                                                <label>ปฏิบัติราชการแทน :</label>
                                                </div> 
                                                <div class="col-lg-6">
                                                <input name="PURCHASE_SUBROGATE" id="PURCHASE_SUBROGATE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliespurchase->PURCHASE_SUBROGATE}}">
                                                </div>
                                            </div>
                                            <div class="row push">
                                            <div>
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                                <div class="col-sm-2">
                                                <label>คำสั่งจังหวัดเลขที่ :</label>
                                                </div> 
                                                <div class="col-lg-6">
                                                <input name="PURCHASE_CMD_PROVINCE" id="PURCHASE_CMD_PROVINCE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliespurchase->PURCHASE_CMD_PROVINCE}}">
                                                </div>
                                               
                                            </div>


                                            <div class="row push">
                                            <div>
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                                <div class="col-sm-2">
                                                <label>หนังสือเรียน :</label>
                                                </div> 
                                                <div class="col-lg-6">
                                                <input name="PURCHASE_NOTIFY" id="PURCHASE_NOTIFY" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliespurchase->PURCHASE_NOTIFY}}">
                                                </div>
                                            </div>
                                    </div>



    
    <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
       </div>    

</div> 

</body>
</form>
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
   $(document).ready(function() {
$('select').select2();
});

$('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});
</script>


@endsection