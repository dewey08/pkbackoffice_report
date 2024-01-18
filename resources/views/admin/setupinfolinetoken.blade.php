@extends('layouts.backend_admin')


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

  .text-pedding {
    padding-left: 10px;
  }

  .text-font {
    font-size: 13px;
  }
</style>
<script>
  function checklogin() {
    window.location.href = '{{ route("index") }}';
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
?>


<!-- Advanced Tables -->

<div class="content">
  <div class="block block-rounded block-bordered">


    <div class="block-content">
      <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่า LINE GROUP</h2>



      <div class="mt-3">
        <div class="table-responsive">

          <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
            <thead style="background-color: #FFEBCD;">
              <tr height="40">
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">รหัส</th>
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">กลุ่มของระบบ</th>
                <th class="text-font" style="border-color:#F0FFFF;text-align: center;">เลข TOKEN</th>
                <th class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th>
              </tr>
            </thead>
            <tbody>
              @foreach($infolinetokens as $infolinetoken)
                <tr height="40">
                  <td class="text-font" align="center">{{ $infolinetoken-> ID_LINE_TOKEN }}</td>
                  <td class="text-font text-pedding">{{ $infolinetoken-> ID_LINE_TOKEN_NAME }}</td>
                  <td class="text-font text-pedding">{{ $infolinetoken-> LINE_TOKEN }}</td>
                  <td align="center">
                    <div class="dropdown">
                      <button type="button" class="btn btn-outline-info dropdown-toggle"
                        id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"
                        style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                        ทำรายการ
                      </button>
                      <div class="dropdown-menu" style="width:10px">
                        <a class="dropdown-item" href=".bd-example-modal-lg{{ $infolinetoken -> ID_LINE_TOKEN }}"
                          data-toggle="modal"
                          style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                      </div>
                    </div>
                  </td>
                </tr>

                {{-- <div id="edit_modal{{ $infolinetoken -> ID_LINE_TOKEN }}" class="modal fade edit" tabindex="-1"
                  role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h2 class="modal-title"
                          style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">
                          แก้ไขข้อมูล TOKEN</h2>
                      </div>
                      <div class="modal-body">
                        <body>
                          <form method="post" action="{{ route('admin.updateinfolinetoken') }}">
                            @csrf
                            <input type="hidden" name="ID_LINE_TOKEN"
                              value="{{ $infolinetoken -> ID_LINE_TOKEN }}" />

                            <div class="form-group">
                              <div class="row">
                                <div class="col-sm-3 text-left">
                                  <label>กลุ่มของระบบ</label>
                                </div>
                                <div class="col-sm-9">
                                  {{ $infolinetoken -> ID_LINE_TOKEN_NAME }}
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                                <div class="col-sm-3 text-left">
                                  <label>เลข TOKEN</label>
                                </div>
                                <div class="col-sm-9">
                                  <input name="LINE_TOKEN" id="LINE_TOKEN" class="form-control input-lg "
                                    style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                    value="{{ $infolinetoken -> LINE_TOKEN }}">
                                </div>
                              </div>
                            </div>

                      </div>
                      <div class="modal-footer">
                        <div align="right">
                          <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save mr-2"></i>บันทึกแก้ไขข้อมูล</button>
                          <button type="button" class="btn btn-hero-sm btn-hero-danger"
                            data-dismiss="modal"> <i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                        </div>
                      </div>
                      </form>
                      </body>

                    </div>
                  </div>
                </div> --}}

                <div class="modal fade bd-example-modal-lg{{ $infolinetoken -> ID_LINE_TOKEN }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h2 class="modal-title"
                          style="font-family: 'Kanit', sans-serif; font-size:14px;font-size: 1.5rem;font-weight:normal;">
                          แก้ไขข้อมูล TOKEN</h2>
                      </div>
                      <div class="modal-body">
                        
                      <form method="post" action="{{ route('admin.updateinfolinetoken') }}">
                        @csrf
                        <input type="hidden" name="ID_LINE_TOKEN"
                          value="{{ $infolinetoken -> ID_LINE_TOKEN }}" />

                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-3 text-left">
                              <label style=" font-family: 'Kanit', sans-serif;font-size: 14px;">กลุ่มของระบบ :</label>
                            </div>
                            <div class="col-sm-9">
                              <label style=" font-family: 'Kanit', sans-serif;font-size: 14px;">{{ $infolinetoken -> ID_LINE_TOKEN_NAME }}</label>
                              
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-3 text-left">
                              <label style=" font-family: 'Kanit', sans-serif;font-size: 14px;">เลข TOKEN :</label>
                            </div>
                            <div class="col-sm-9">
                              <input name="LINE_TOKEN" id="LINE_TOKEN" class="form-control input-lg "
                                style=" font-family: 'Kanit', sans-serif;font-size: 14px;"
                                value="{{ $infolinetoken -> LINE_TOKEN }}">
                            </div>
                          </div>
                        </div>

                  </div>
                  <div class="modal-footer">
                    <div align="right">
                      <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save mr-2"></i>บันทึกแก้ไขข้อมูล</button>
                      <button type="button" class="btn btn-hero-sm btn-hero-danger"
                        data-dismiss="modal"> <i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                    </div>
                  </div>
                  </form>
                    </div>
                  </div>
                </div>

              @endforeach
            </tbody>
          </table>
          <br>

          @endsection

          @section('footer')

          <!-- Page JS Plugins -->
          <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}">
          </script>
          <script
            src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}">
          </script>
          <script
            src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}">
          </script>

          <!-- Page JS Code -->
          <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>


          {{-- <script>
            $(document).ready(function () {
              $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
          </script> --}}

          @endsection