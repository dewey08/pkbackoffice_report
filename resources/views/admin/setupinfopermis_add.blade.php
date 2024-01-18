@extends('layouts.backend_admin')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')
<style>
  body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
    
      }
      .form-control {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}
?>
  
  <center>
    <!-- Dynamic Table Simple -->
    <div class="block shadow-lg  mt-4" style="width: 95%;">
        <div class="block-header block-header-default" >
            <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>กำหนดข้อมูลสิทธิ์</B></h3>
            </div>
        <div class="block-content block-content-full">

          <form  method="post" action="{{ route('setup.savepermis') }}" >
            @csrf

          <div class="row">
              <div class="col-md-2">
                <label >ชื่อ-นามสกุล</label>
              </div>
              <div class="col-md-4">
                <select  name="USE_ID" id="USE_ID" class="form-control input-sm " required>
                  <option value="" >--กรุณาเลือกชื่อเจ้าหน้าที่--</option>
                      @foreach ($inforpersons as $inforperson)
                          @if($inforperson->PERSON_ID == NULL)  
                              <option value="{{ $inforperson->HR_CID  }}">{{$inforperson->HR_FNAME}} {{$inforperson->HR_LNAME}}</option>                      
                          @endif
                      @endforeach 
                </select>
              </div>
              <div class="col-md-6">
              </div>
          </div>

          <hr>
       
          <div class="row">
            <div class="col-sm-3 ">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                          {{-- <i class="fa fa-3x fa-users text-info mt-3"></i> --}}
                          <div class="font-w600 ml-2  mt-2  text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบบุคลากร</div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GHR001" name="GHR001" >จัดการงานบุคลากร 
                            </div>  
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GRE001" name="GRE001" >ประชุม/อบรม::ตรวจสอบข้อมูล
                            </div>  
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GRE002 " name="GRE002 " >ระบบประชุม/อบรม::อนุมัติ
                            </div>  
                          </div>
                        </div> 
                    </div>
                  </a>
              </div>
          
              <div class="col-sm-3 ">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                        {{-- <i class="fa fa-3x fa-history  mt-3 "></i> --}}
                          <div class="font-w600 ml-2 mt-2  text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบลงเวลา</div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GTS001" name="GTS001" >จัดการงานลงเวลา 
                            </div>  
                          </div>
                        </div> 
                    </div>
                  </a>
              </div>

              <div class="col-sm-3 ">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                        {{-- <i class="fa fa-3x fa-calendar-alt text-info mt-3 "></i> --}}
                        <div class="font-w600 ml-2 mt-2  text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบการลา</div>
                       
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GLE003" name="GLE003" >ตรวจสอบข้อมูลการลา 
                            </div>  
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GLE002" name="GLE002" >อนุมัติผู้ใต้บังคับบัญชา 
                            </div>  
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GLE001" name="GLE001" >อนุมัติทั้งหมด 
                            </div>  
                          </div>
                        </div> 
                    </div>
                  </a>
              </div>

              <div class="col-sm-3 ">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-book-open text-warning mt-3 text-left"></i> --}}
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบสารบรรณ</div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GMB001" name="GMB001" >จัดการงานสารบรรณ 
                            </div>  
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GMB002" name="GMB002" >เสนอผู้อำนวยการ 
                            </div>  
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GMB003" name="GMB003" >เกษียณหนังสือ 
                            </div>  
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GMB004" name="GMB004" >เข้าถึงหนังสือลับ 
                            </div>  
                          </div>
                        </div>    
                    </div>
                  </a>
              </div>
           
                        

          </div>   

        <hr>

          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-tablet-alt text-success mt-3 text-left"></i> --}}
                      <div class="font-w600 mt-2 ml-2  text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบห้องประชุม</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GME001" name="GME001" >ตรวจสอบข้อมูลรับเรื่อง 
                          </div>  
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GME002" name="GME002" >จัดการข้อมูลห้องประชุม 
                          </div>  
                        </div>
                      </div>   
                  </div>
                </a>
            </div>

            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-ambulance text-xpro mt-3"></i> --}}
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบยานพาหนะ</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GCA001" name="GCA001" >จัดการงานยานพาหนะ 
                          </div>  
                        </div>
                      </div>                       
                  </div>
                </a>
            </div>
            <div class="col-sm-3">               
                  <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                        {{-- <i class="fa fa-3x fa-boxes text-info mt-3"></i> --}}
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบงานทรัพย์สิน</div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GAS001" name="GAS001" >จัดการงานทรัพย์สิน 
                            </div>  
                          </div>
                        </div>
                        
                    </div>
                  </a>
            </div>
        
            <div class="col-sm-3">
                <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-donate text-success mt-3"></i> --}}
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบงานพัสดุ</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GSU001" name="GSU001" >จัดการงานพัสดุ 
                          </div>  
                        </div>
                      </div> 
                    
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GSU002" name="GSU002" >เห็นชอบจัดซื้อจัดจ้าง 
                          </div>  
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GSU003" name="GSU003" >อนุมัติจัดซื้อจัดจ้าง 
                          </div>  
                        </div>
                      </div> 
                  </div>
                </a>                
            </div>

          
           

          </div>   
          
        <hr>

          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-wrench text-success mt-3"></i> --}}
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบงานซ่อมบำรุง</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GRP001" name="GRP001" >จัดการงานซ่อมบำรุง 
                          </div>  
                        </div>
                      </div>
                      
                  </div>
                </a>
            </div>
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-tv text-warning mt-3"></i> --}}
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบศูนย์คอมพิวเตอร์</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GRC001" name="GRC001" >จัดการศูนย์คอมพิวเตอร์ 
                          </div>  
                        </div>
                      </div>                       
                  </div>
                </a>
            </div>
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                <div class="block-content block-content-full ">
                    {{-- <i class="fa fa-3x fa-stethoscope text-danger mt-3"></i> --}}
                    <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบศูนย์เครื่องมือแพทย์</div>
                    <div class="row">
                      <div class="col-md-12 ml-2 mt-2 text-left">
                        <div class="form-check form-check-inline">
                          <input type="checkbox" class="form-check-input " id="GRM001" name="GRM001" >จัดการเครื่องมือแพทย์ 
                        </div>  
                      </div>
                    </div>
                    
                </div>
              </a>
          </div>
          <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                <div class="block-content block-content-full ">
                    {{-- <i class="fa fa-3x fa-shield-alt text-xmodern mt-3"></i> --}}
                    <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบ รปภ.</div>
                    <div class="row">
                      <div class="col-md-12 ml-2 mt-2 text-left">
                        <div class="form-check form-check-inline">
                          <input type="checkbox" class="form-check-input " id="GSA001" name="GSA001" >จัดการงานรักษาความปลอดภัย 
                        </div>  
                      </div>
                    </div>
                                          
                </div>
              </a>
          </div> 
              
          </div> 

        <hr>

          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                        {{-- <i class="fa fa-3x fa-box-open text-danger mt-3"></i> --}}
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบคลังวัสดุ</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GMW001" name="GMW001" >จัดการข้อมูลคลังวัสดุ 
                          </div>  
                        </div>
                      </div> 
                  </div>
                </a>
            </div>
        
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-notes-medical text-info mt-3 "></i> --}}
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบยาและเวชภัณฑ์</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GMM001" name="GMM001" >จัดการข้อมูลยาและเวชภัณฑ์ 
                          </div>  
                        </div>
                      </div> 
                  </div>
                </a>
            </div>

            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-project-diagram text-xInspire mt-3 "></i> --}}
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบแผนงาน</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GMP001" name="GMP001" >จัดการข้อมูลแผนงาน 
                          </div>  
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GMP003" name="GMP003" >อนุมัติโครงการ 
                          </div>  
                        </div>
                      </div>
                     
                  </div>
                </a>
            </div>
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    {{-- <i class="fa fa-3x fa-book-open text-warning mt-3 text-left"></i> --}}
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบการเงิน</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GMC002" name="GMC002" >จัดการเงินเดือนค่าตอบแทน 
                          </div>  
                        </div>
                      </div>
                     
                  </div>
                </a>
            </div>
          </div>

            <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-child text-warning mt-3"></i> --}}
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบตรวจสุขภาพ</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="HEAL" name="HEAL" >จัดการข้อมูลสุขภาพ 
                          </div>  
                        </div>
                      </div>
                       
                  </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                        {{-- <i class="fa fa-3x fa-file-signature text-xmodern mt-3"></i> --}}
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบรายงานความเสี่ยง</div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GMR001" name="GMR001">จัดการข้อมูลควบคุมภายในและ                              
                            </div>                              
                          </div>
                        </div>     
                        <div class="row">
                          <div class="col-md-12 ml-4 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="hidden" class="form-check-input ">ความเสี่ยง                              
                            </div>                              
                          </div>
                        </div>                       
                    </div>
                  </a>
            </div>
        
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-dolly-flatbed text-primary mt-3 "></i> --}}
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบงานจ่ายกลาง</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GMP002" name="GMP002" >จัดการข้อมูลจ่ายกลาง 
                          </div>  
                        </div>
                      </div> 
                  </div>
                </a>
            </div>

            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-tshirt text-warning mt-3 "></i> --}}
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบซักฟอก</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GML001" name="GML001" >จัดการข้อมูลซักฟอก 
                          </div>  
                        </div>
                      </div> 
                    
                    
                  </div>
                </a>
            </div>

           
          </div> 
          
          
          <hr>

          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    {{-- <i class="fa fa-3x fa-hotel text-xmodern-lighter mt-3 text-left"></i> --}}
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบบริหารบ้านพัก</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GMG001" name="GMG001" >จัดการข้อมูลบ้านพัก 
                          </div>  
                        </div>
                      </div>
                    
                  </div>
                </a>
            </div>
        
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-leaf text-success mt-3"></i> --}}
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบสาธารณูปโภค</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GMN001" name="GMN001" >จัดการข้อมูลสาธารณูปโภค
                          </div>  
                        </div>
                      </div>
                      
                  </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                        {{-- <i class="fa fa-3x fa-utensils text-xsmooth mt-3"></i> --}}
                        <div class="font-w600 mt-2 ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบโภชนศาสตร์</div>
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input " id="GMF001" name="GMF001">จัดการข้อมูลงานบริการอาหาร 
                            </div>  
                          </div>
                        </div>                       
                    </div>
                  </a>
            </div>
        
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-headset text-info mt-3 "></i> --}}
                        <div class="font-w600 mt-2 ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบทะเบียนรับบริจาค</div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="GMC001" name="GMC001" >จัดการข้อมูลทะเบียนผู้บริจาค 
                          </div>  
                        </div>
                      </div> 
                  </div>
                </a>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                      {{-- <i class="fa fa-3x fa-users text-success mt-3 "></i> --}}
                        <div class="font-w600 mt-2 ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ผู้อำนวยการ </div>
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " id="HORG" name="HORG" >การอนุมัติระดับผู้อำนวยการ 
                          </div>  
                        </div>
                      </div> 
                  </div>
                </a>
            </div>

          </div>   
          <hr>
          <div class="block-footer block-footer-default">
            <div align="right">
            <button type="submit"  class="btn btn-hero-sm btn-hero-info" > <i class="fas fa-save mr-2"></i> บันทึกข้อมูล</button>
             <a href="{{ url('admin_permis/setupinfopermis')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a> 
             </div>    
           
            </div>
            </form>  
      </div>               
  </div>  
@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>


<script>


$(document).ready(function() {
    $('select').select2({
    width: '100%'
});

    });

  function check_use_id()
  {                         
    use_id = document.getElementById("USE_ID").value;             
          if (use_id==null || use_id==''){
          document.getElementById("use_id").style.display = "";     
          text_use_id = "*กรุณาเลือกชื่อเจ้าหน้าที่";
          document.getElementById("use_id").innerHTML = text_use_id;
          }else{
          document.getElementById("use_id").style.display = "none";
          }
  }
  function check_permis_id()
  {                         
    permis_id = document.getElementById("PERMIS_ID").value;             
          if (permis_id==null || permis_id==''){
          document.getElementById("permis_id").style.display = "";     
          text_permis_id = "*กรุณาเลือกสิทธิ์เจ้าหน้าที่";
          document.getElementById("permis_id").innerHTML = text_permis_id;
          }else{
          document.getElementById("permis_id").style.display = "none";
          }
  }

</script>
<script>      
  $('form').submit(function () {
    var use_id,text_use_id;
    var permis_id,text_permis_id;

    use_id = document.getElementById("USE_ID").value;
    permis_id = document.getElementById("PERMIS_ID").value;

    if (use_id==null || use_id==''){
    document.getElementById("use_id").style.display = "";     
    text_use_id= "*กรุณาเลือกชื่อเจ้าหน้าที่";
    document.getElementById("use_id").innerHTML = text_use_id;
    }else{
    document.getElementById("use_id").style.display = "none";
    }
    if (permis_id==null || permis_id==''){
    document.getElementById("permis_id").style.display = "";     
    text_permis_id= "*กรุณาเลือกสิทธิ์เจ้าหน้าที่";
    document.getElementById("permis_id").innerHTML = text_permis_id;
    }else{
    document.getElementById("permis_id").style.display = "none";
    }

    if(use_id==null || use_id==''||
    permis_id==null || permis_id==''          
    )
{
alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
return false;   
}
}); 

</script>


<script>
  $('#edit_modal').on('show.bs.modal', function(e) {
    var Id = $(e.relatedTarget).data('id');
    var VUTId = $(e.relatedTarget).data('vutid');
    $(e.currentTarget).find('input[name="ID"]').val(Id);
    $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);

});

</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker3').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

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

<script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   

        <!-- Page JS Code -->
        <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

        <script>
            $(document).ready(function(){
              $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
        </script>
@endsection