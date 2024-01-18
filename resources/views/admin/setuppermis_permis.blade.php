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
            <h3 class="block-title text-left" style="color:rgb(4, 72, 173)"><B>กำหนดข้อมูลสิทธิ์ของ {{$infopermislist->HR_PREFIX_NAME}}{{$infopermislist->HR_FNAME}}  {{$infopermislist->HR_LNAME}}</B></h3>
            </div>
        <div class="block-content block-content-full">

          <form  method="post" action="{{ route('setup.savepermis') }}" >
            @csrf
           <input type="hidden" id="USER_ID" name="USER_ID" value="{{$infopermislist->ID}}">
           
          <div class="row">
           
            <div class="col-sm-3 ">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                      <div class="text-left">
                        <i class="fa fa-3x fa-users text-info mt-3  ml-2"></i>
                      </div>
                          <div class="font-w600 ml-2  mt-2  text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบบุคลากร</div>
                          @foreach ($infopermisperson as $item1) 
                            <div class="row">                          
                                <div class="col-md-12 ml-2 mt-2 text-left">
                                      <div class="form-check form-check-inline"> 
                                          <?php  
                                          $pp01 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item1->PERMIS_ID)->count();
                                          ?>
                                          @if($pp01 > 0)                                     
                                              <input type="checkbox" class="form-check-input" id="{{$item1->PERMIS_ID}}" name="{{$item1->PERMIS_ID}}" checked>{{$item1->PERMIS_NAME}} 
                                            @else
                                            <input type="checkbox" class="form-check-input" id="{{$item1->PERMIS_ID}}" name="{{$item1->PERMIS_ID}}" >{{$item1->PERMIS_NAME}} 
                                            @endif
                                      </div>                                   
                                </div>                         
                            </div>
                          @endforeach  
                        @foreach ($infopermisperson_gre as $item2) 
                        <div class="row">                           
                              <div class="col-md-12 ml-2 mt-2 text-left">                                      
                                  <?php  
                                        $pp02 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item2->PERMIS_ID)->count();
                                  ?>
                                <div class="form-check form-check-inline"> 
                                    @if($pp02 > 0)                                     
                                      <input type="checkbox" class="form-check-input" id="{{$item2->PERMIS_ID}}" name="{{$item2->PERMIS_ID}}" checked>{{$item2->PERMIS_NAME}} 
                                    @else
                                      <input type="checkbox" class="form-check-input" id="{{$item2->PERMIS_ID}}" name="{{$item2->PERMIS_ID}}" >{{$item2->PERMIS_NAME}} 
                                    @endif  
                                </div> 
                              </div>                         
                        </div> 
                        @endforeach  
                     
                     
                    </div>
                  </a>
              </div>
            
              <div class="col-sm-3 ">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                      <div class="text-left">
                        <i class="fa fa-3x fa-history text-dark mt-3 ml-2"></i>
                      </div>
                          <div class="font-w600 ml-2 mt-2  text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบลงเวลา</div>

                          @foreach ($infopermisperson_gts as $item3) 
                          <div class="row">
                            <div class="col-md-12 ml-2 mt-2 text-left">
                              <?php  
                                    $pp03 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item3->PERMIS_ID)->count();
                              ?>
                              <div class="form-check form-check-inline">
                                  @if($pp03 > 0)                                     
                                    <input type="checkbox" class="form-check-input" id="{{$item3->PERMIS_ID}}" name="{{$item3->PERMIS_ID}}" checked>{{$item3->PERMIS_NAME}} 
                                  @else
                                    <input type="checkbox" class="form-check-input" id="{{$item3->PERMIS_ID}}" name="{{$item3->PERMIS_ID}}" >{{$item3->PERMIS_NAME}} 
                                  @endif 
                              </div>  
                            </div>
                          </div> 
                          @endforeach 

                    </div>
                  </a>
              </div>

              <div class="col-sm-3 ">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                      <div class="text-left">                     
                        <i class="fa fa-3x fa-calendar-alt text-info mt-3 ml-2"></i>
                      </div>
                        <div class="font-w600 ml-2 mt-2  text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบการลา</div>
                        @foreach ($infopermisperson_gle as $item4) 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <?php  
                                $pp04 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item4->PERMIS_ID)->count();
                            ?>
                            <div class="form-check form-check-inline">
                                @if($pp04 > 0)                                     
                                    <input type="checkbox" class="form-check-input" id="{{$item4->PERMIS_ID}}" name="{{$item4->PERMIS_ID}}" checked>{{$item4->PERMIS_NAME}} 
                                  @else
                                    <input type="checkbox" class="form-check-input" id="{{$item4->PERMIS_ID}}" name="{{$item4->PERMIS_ID}}" >{{$item4->PERMIS_NAME}} 
                                  @endif 
                              
                            </div>  
                          </div>
                        </div>
                        @endforeach 
                      
                    </div>
                  </a>
              </div>

              <div class="col-sm-3 ">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                      <div class="text-left">                     
                        <i class="fa fa-3x fa-book-open text-warning mt-3 ml-2"></i>
                      </div>
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบสารบรรณ</div>
                        
                        @foreach ($infopermisperson_gmb as $item5) 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <?php  
                                $pp05 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item5->PERMIS_ID)->count();
                            ?>

                            <div class="form-check form-check-inline">
                              @if($pp05 > 0)                                     
                                <input type="checkbox" class="form-check-input" id="{{$item5->PERMIS_ID}}" name="{{$item5->PERMIS_ID}}" checked>{{$item5->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item5->PERMIS_ID}}" name="{{$item5->PERMIS_ID}}" >{{$item5->PERMIS_NAME}} 
                              @endif 
                            </div>  
                          </div>
                        </div>
                        @endforeach                     

                    </div>
                  </a>
              </div>   

          </div>   

        <hr>

          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-tablet-alt text-success mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2 ml-2  text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบห้องประชุม</div>
                      @foreach ($infopermisperson_gme as $item6) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                              $pp06 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item6->PERMIS_ID)->count();
                          ?>
                          <div class="form-check form-check-inline">
                            
                            @if($pp06 > 0)                                     
                            <input type="checkbox" class="form-check-input" id="{{$item6->PERMIS_ID}}" name="{{$item6->PERMIS_ID}}" checked>{{$item6->PERMIS_NAME}} 
                            @else
                              <input type="checkbox" class="form-check-input" id="{{$item6->PERMIS_ID}}" name="{{$item6->PERMIS_ID}}" >{{$item6->PERMIS_NAME}} 
                            @endif 

                          </div>  
                        </div>
                      </div>
                      @endforeach                      
                      
                  </div>
                </a>
            </div>

            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-ambulance text-xpro mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบยานพาหนะ</div>
                      
                      @foreach ($infopermisperson_gca as $item7) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                              $pp07 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item7->PERMIS_ID)->count();
                          ?>
                          <div class="form-check form-check-inline">
                            @if($pp07 > 0)                                     
                            <input type="checkbox" class="form-check-input" id="{{$item7->PERMIS_ID}}" name="{{$item7->PERMIS_ID}}" checked>{{$item7->PERMIS_NAME}} 
                            @else
                              <input type="checkbox" class="form-check-input" id="{{$item7->PERMIS_ID}}" name="{{$item7->PERMIS_ID}}" >{{$item7->PERMIS_NAME}} 
                            @endif 

                          </div>  
                        </div>
                      </div> 
                      @endforeach   
                  </div>
                </a>
            </div>
            <div class="col-sm-3">               
                  <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                      <div class="text-left">                     
                        <i class="fa fa-3x fa-boxes text-info mt-3 ml-2"></i>
                      </div>
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบงานทรัพย์สิน</div>
                        @foreach ($infopermisperson_gas as $item8) 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <?php  
                            $pp08 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item8->PERMIS_ID)->count();
                        ?>
                            <div class="form-check form-check-inline">
                              @if($pp08 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item8->PERMIS_ID}}" name="{{$item8->PERMIS_ID}}" checked>{{$item8->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item8->PERMIS_ID}}" name="{{$item8->PERMIS_ID}}" >{{$item8->PERMIS_NAME}} 
                              @endif 
                            </div>  
                          </div>
                        </div>
                        @endforeach
                    </div>
                  </a>
            </div>
        
            <div class="col-sm-3">
                <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-donate text-success mt-3 ml-2"></i>
                    </div>
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบงานพัสดุ</div>
                        @foreach ($infopermisperson_gsu as $item9) 
                        <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp09 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item9->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp09 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item9->PERMIS_ID}}" name="{{$item9->PERMIS_ID}}" checked>{{$item9->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item9->PERMIS_ID}}" name="{{$item9->PERMIS_ID}}" >{{$item9->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div> 
                      @endforeach
                    
                  </div>
                </a>                
            </div>
          </div>  
          
        <hr>

          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-wrench text-success mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบงานซ่อมบำรุง</div>
                      @foreach ($infopermisperson_grp as $item10) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp10 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item10->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp10 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item10->PERMIS_ID}}" name="{{$item10->PERMIS_ID}}" checked>{{$item10->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item10->PERMIS_ID}}" name="{{$item10->PERMIS_ID}}" >{{$item10->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach

                  </div>
                </a>
            </div>
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-tv text-warning mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบศูนย์คอมพิวเตอร์</div>
                      @foreach ($infopermisperson_grc as $item11) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp11 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item11->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp11 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item11->PERMIS_ID}}" name="{{$item11->PERMIS_ID}}" checked>{{$item11->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item11->PERMIS_ID}}" name="{{$item11->PERMIS_ID}}" >{{$item11->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach                   
                  </div>
                </a>
            </div>
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                <div class="block-content block-content-full ">
                  <div class="text-left">                     
                    <i class="fa fa-3x fa-stethoscope text-danger mt-3 ml-2"></i>
                  </div>
                    <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบศูนย์เครื่องมือแพทย์</div>
                    @foreach ($infopermisperson_grm as $item12) 
                    <div class="row">
                      <div class="col-md-12 ml-2 mt-2 text-left">
                        <?php  
                        $pp12 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item12->PERMIS_ID)->count();
                    ?>
                        <div class="form-check form-check-inline">
                          @if($pp12 > 0)                                     
                            <input type="checkbox" class="form-check-input" id="{{$item12->PERMIS_ID}}" name="{{$item12->PERMIS_ID}}" checked>{{$item12->PERMIS_NAME}} 
                            @else
                              <input type="checkbox" class="form-check-input" id="{{$item12->PERMIS_ID}}" name="{{$item12->PERMIS_ID}}" >{{$item12->PERMIS_NAME}} 
                            @endif 
                        </div>  
                      </div>
                    </div>
                    @endforeach         
                    
                </div>
              </a>
          </div>
          <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                <div class="block-content block-content-full ">
                  <div class="text-left">                     
                    <i class="fa fa-3x fa-shield-alt text-xmodern mt-3 ml-2"></i>
                  </div>
                    <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบ รปภ.</div>
                    @foreach ($infopermisperson_gsa as $item13) 
                    <div class="row">
                      <div class="col-md-12 ml-2 mt-2 text-left">
                        <?php  
                        $pp13 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item13->PERMIS_ID)->count();
                    ?>
                        <div class="form-check form-check-inline">
                          @if($pp13 > 0)                                     
                            <input type="checkbox" class="form-check-input" id="{{$item13->PERMIS_ID}}" name="{{$item13->PERMIS_ID}}" checked>{{$item13->PERMIS_NAME}} 
                            @else
                              <input type="checkbox" class="form-check-input" id="{{$item13->PERMIS_ID}}" name="{{$item13->PERMIS_ID}}" >{{$item13->PERMIS_NAME}} 
                            @endif 
                        </div>  
                      </div>
                    </div>
                    @endforeach    
                                          
                </div>
              </a>
          </div> 
              
          </div> 

        <hr>

          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-box-open text-danger mt-3 ml-2"></i>
                    </div>
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบคลังวัสดุ</div>
                        @foreach ($infopermisperson_gmw as $item14) 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <?php  
                            $pp14 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item14->PERMIS_ID)->count();
                        ?>
                            <div class="form-check form-check-inline">
                              @if($pp14 > 0)                                     
                                <input type="checkbox" class="form-check-input" id="{{$item14->PERMIS_ID}}" name="{{$item14->PERMIS_ID}}" checked>{{$item14->PERMIS_NAME}} 
                                @else
                                  <input type="checkbox" class="form-check-input" id="{{$item14->PERMIS_ID}}" name="{{$item14->PERMIS_ID}}" >{{$item14->PERMIS_NAME}} 
                                @endif 
                            </div>  
                          </div>
                        </div>
                        @endforeach    
                  </div>
                </a>
            </div>
        
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-notes-medical text-info mt-3 ml-2"></i>
                    </div>
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบยาและเวชภัณฑ์</div>
                        @foreach ($infopermisperson_gmm as $item15) 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <?php  
                            $pp15 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item15->PERMIS_ID)->count();
                        ?>
                            <div class="form-check form-check-inline">
                              @if($pp15 > 0)                                     
                                <input type="checkbox" class="form-check-input" id="{{$item15->PERMIS_ID}}" name="{{$item15->PERMIS_ID}}" checked>{{$item15->PERMIS_NAME}} 
                                @else
                                  <input type="checkbox" class="form-check-input" id="{{$item15->PERMIS_ID}}" name="{{$item15->PERMIS_ID}}" >{{$item15->PERMIS_NAME}} 
                                @endif 
                            </div>  
                          </div>
                        </div>
                        @endforeach   
                  </div>
                </a>
            </div>

            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-project-diagram text-xInspire mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบแผนงาน</div>
                      @foreach ($infopermisperson_gmp as $item16) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp16 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item16->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp16 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item16->PERMIS_ID}}" name="{{$item16->PERMIS_ID}}" checked>{{$item16->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item16->PERMIS_ID}}" name="{{$item16->PERMIS_ID}}" >{{$item16->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach   
                     
                  </div>
                </a>
            </div>
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-hand-holding-usd text-xplay mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบการเงิน</div>
                      @foreach ($infopermisperson_gmc as $item17) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp17 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item17->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp17 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item17->PERMIS_ID}}" name="{{$item17->PERMIS_ID}}" checked>{{$item17->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item17->PERMIS_ID}}" name="{{$item17->PERMIS_ID}}" >{{$item17->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach   
                     
                  </div>
                </a>
            </div>
          </div>
<hr>
            <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-child text-warning mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบตรวจสุขภาพ</div>
                      @foreach ($infopermisperson_heal as $item18) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp18 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item18->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp18 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item18->PERMIS_ID}}" name="{{$item18->PERMIS_ID}}" checked>{{$item18->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item18->PERMIS_ID}}" name="{{$item18->PERMIS_ID}}" >{{$item18->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach   
                       
                  </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                      <div class="text-left">                     
                        <i class="fa fa-3x fa-file-signature text-xmodern mt-3 ml-2"></i>
                      </div>
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบรายงานความเสี่ยง</div>
                        @foreach ($infopermisperson_gmr as $item19) 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <?php  
                            $pp19 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item19->PERMIS_ID)->count();
                        ?>
                            <div class="form-check form-check-inline">
                              @if($pp19 > 0)                                     
                                <input type="checkbox" class="form-check-input" id="{{$item19->PERMIS_ID}}" name="{{$item19->PERMIS_ID}}" checked>{{$item19->PERMIS_NAME}} 
                                @else
                                  <input type="checkbox" class="form-check-input" id="{{$item19->PERMIS_ID}}" name="{{$item19->PERMIS_ID}}" >{{$item19->PERMIS_NAME}} 
                                @endif 
                            </div>  
                          </div>
                        </div>
                        @endforeach   
                       
                    </div>
                  </a>
            </div>
        
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-dolly-flatbed text-primary mt-3 ml-2"></i>
                    </div>
                        <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบงานจ่ายกลาง</div>
                        @foreach ($infopermisperson_gmp002 as $item20) 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <?php  
                            $pp20 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item20->PERMIS_ID)->count();
                        ?>
                            <div class="form-check form-check-inline">
                              @if($pp20 > 0)                                     
                                <input type="checkbox" class="form-check-input" id="{{$item20->PERMIS_ID}}" name="{{$item20->PERMIS_ID}}" checked>{{$item20->PERMIS_NAME}} 
                                @else
                                  <input type="checkbox" class="form-check-input" id="{{$item20->PERMIS_ID}}" name="{{$item20->PERMIS_ID}}" >{{$item20->PERMIS_NAME}} 
                                @endif 
                            </div>  
                          </div>
                        </div>
                        @endforeach   
                  </div>
                </a>
            </div>

            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-tshirt text-warning mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบซักฟอก</div>
                      @foreach ($infopermisperson_gml as $item21) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp21 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item21->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp21 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item21->PERMIS_ID}}" name="{{$item21->PERMIS_ID}}" checked>{{$item21->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item21->PERMIS_ID}}" name="{{$item21->PERMIS_ID}}" >{{$item21->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach                      
                    
                  </div>
                </a>
            </div>

           
          </div> 
          
          
          <hr>

          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-hotel text-xmodern-lighter mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบบริหารบ้านพัก</div>
                      @foreach ($infopermisperson_gmg as $item22) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp22 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item22->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp22 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item22->PERMIS_ID}}" name="{{$item22->PERMIS_ID}}" checked>{{$item22->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item22->PERMIS_ID}}" name="{{$item22->PERMIS_ID}}" >{{$item22->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach         
                    
                  </div>
                </a>
            </div>
        
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-leaf text-success mt-3 ml-2"></i>
                    </div>
                      <div class="font-w600 mt-2  ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบสาธารณูปโภค</div>
                      @foreach ($infopermisperson_gmn as $item23) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp23 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item23->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp23 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item23->PERMIS_ID}}" name="{{$item23->PERMIS_ID}}" checked>{{$item23->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item23->PERMIS_ID}}" name="{{$item23->PERMIS_ID}}" >{{$item23->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach        
                      
                  </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a class="block block-link-pop text-center" target="_blank">
                    <div class="block-content block-content-full ">
                      <div class="text-left">                     
                        <i class="fa fa-3x fa-utensils text-xsmooth mt-3 ml-2"></i>
                      </div>
                        <div class="font-w600 mt-2 ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบโภชนศาสตร์</div>
                        @foreach ($infopermisperson_gmf as $item24) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp24 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item24->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp24 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item24->PERMIS_ID}}" name="{{$item24->PERMIS_ID}}" checked>{{$item24->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item24->PERMIS_ID}}" name="{{$item24->PERMIS_ID}}" >{{$item24->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach                       
                    </div>
                  </a>
            </div>
        
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-headset text-info mt-3 ml-2"></i>
                    </div>
                        <div class="font-w600 mt-2 ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบทะเบียนรับบริจาค</div>
                        @foreach ($infopermisperson_gmc002 as $item25) 
                        <div class="row">
                          <div class="col-md-12 ml-2 mt-2 text-left">
                            <?php  
                            $pp25 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item25->PERMIS_ID)->count();
                        ?>
                            <div class="form-check form-check-inline">
                              @if($pp25 > 0)                                     
                                <input type="checkbox" class="form-check-input" id="{{$item25->PERMIS_ID}}" name="{{$item25->PERMIS_ID}}" checked>{{$item25->PERMIS_NAME}} 
                                @else
                                  <input type="checkbox" class="form-check-input" id="{{$item25->PERMIS_ID}}" name="{{$item25->PERMIS_ID}}" >{{$item25->PERMIS_NAME}} 
                                @endif 
                            </div>  
                          </div>
                        </div>
                        @endforeach         
                  </div>
                </a>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa-user-tie text-success mt-3 ml-2"></i>
                    </div>
                        <div class="font-w600 mt-2 ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ผู้อำนวยการ </div>
                     
                      @foreach ($infopermisperson_horg as $item26) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp26 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item26->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp26 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item26->PERMIS_ID}}" name="{{$item26->PERMIS_ID}}" checked>{{$item26->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item26->PERMIS_ID}}" name="{{$item26->PERMIS_ID}}" >{{$item26->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach         
                  </div>
                </a>
            </div>

            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-heartbeat fa-3x text-warning mt-3 ml-2"></i>
                    </div>
                        <div class="font-w600 mt-2 ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ระบบความสุขของบุคลากร </div>
                        
                      @foreach ($infopermisperson_happy as $item27) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp26 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item27->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp26 > 0)                                   
                               <input type="checkbox" class="form-check-input" id="{{$item27->PERMIS_ID}}" name="{{$item27->PERMIS_ID}}" checked>{{$item27->PERMIS_NAME}} 
                            @else
                                <input type="checkbox" class="form-check-input" id="{{$item27->PERMIS_ID}}" name="{{$item27->PERMIS_ID}}" >{{$item27->PERMIS_NAME}} 
                            @endif
                          </div>  
                        </div>
                      </div>
                      @endforeach         
                  </div>
                </a>
            </div>



            <div class="col-sm-3">
              <a class="block block-link-pop text-center" target="_blank">
                  <div class="block-content block-content-full ">
                    <div class="text-left">                     
                      <i class="fa fa-3x fa fa-table text-info mt-3 ml-2"></i>
                    </div>
                        <div class="font-w600 mt-2 ml-2 text-left" style="font-size: 15px;color:rgb(4, 72, 173)">ตารางเวรปฏิบัติงาน </div>
                     
                      @foreach ($infopermisperson_opa as $item28) 
                      <div class="row">
                        <div class="col-md-12 ml-2 mt-2 text-left">
                          <?php  
                          $pp27 = DB::table('gsy_permis_list')->where('PERSON_ID','=',$infopermislist->ID)->where('PERMIS_ID','=',$item28->PERMIS_ID)->count();
                      ?>
                          <div class="form-check form-check-inline">
                            @if($pp27 > 0)                                     
                              <input type="checkbox" class="form-check-input" id="{{$item28->PERMIS_ID}}" name="{{$item28->PERMIS_ID}}" checked>{{$item28->PERMIS_NAME}} 
                              @else
                                <input type="checkbox" class="form-check-input" id="{{$item28->PERMIS_ID}}" name="{{$item28->PERMIS_ID}}" >{{$item28->PERMIS_NAME}} 
                              @endif 
                          </div>  
                        </div>
                      </div>
                      @endforeach         
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