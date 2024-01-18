@extends('layouts.asset')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />


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
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }
</style>

<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>

                            @if( $typedetail == 'parcel')
                             รายละเอียด/แก้ไขข้อมูลพัสดุขององค์กร
                            @elseif( $typedetail == 'article')
                            รายละเอียด/แก้ไขข้อมูลครุภัณฑ์ขององค์กร
                            @elseif( $typedetail == 'service')
                            รายละเอียด/แก้ไขข้อมูลบริการ
                            @else
                            รายละเอียด/แก้ไขข้อมูลสิ่งปลูกสร้าง
                            @endif


</B></h3>

</div>
<div class="block-content block-content-full" align="left">


        <form  method="post" id="form_edit" action="{{ route('massete.updatesuppliesinfoarticle') }}" enctype="multipart/form-data">
        @csrf
      
    <div class="row push">
    <input type="hidden" name="ID" id="ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupplie->ID}}">
    <input type="hidden" name="typedetail" id="typedetail" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$typedetail}}">
    
       <div class="col-lg-4">
            <div class="form-group">
            <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>    

            @if ( $infosupplie->IMG == Null )
            <img id="image_upload_preview" src="{{asset('image/default.jpg')}}" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="80%"/>
            @else
            <img id="image_upload_preview"
                    src="data:image/png;base64,{{ chunk_split(base64_encode($infosupplie->IMG)) }}"
                    height="300px" width="80%">
                  
            @endif

   
        
        </div>
            <div class="form-group">
            *ขนาดรูปไม่เกิน 350 x 350 pixel
            <input type="file" name="picture" id="picture" class="form-control">
            </div>                                                                                                                                          
        </div>

        <div class="col-sm-8">
        <div class="row">
        <div class="col-lg-2">
        <label style="text-align: left">
        
        @if( $typedetail == 'parcel')
        กำหนดเลขวัสดุ :
        @elseif( $typedetail == 'article')
        กำหนดเลขครุภัณฑ์ :
        @elseif( $typedetail == 'service')
        กำหนดเลขบริการ :
        @else
        กำหนดเลขสิ่งปลูกสร้าง :
        @endif

</label>
        </div> 
        @if($typedetail == 'parcel')
        <div class="col-lg-7 number_parcel">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupplie->SUP_FSN_NUM}}">
        </div> 
        @else
        <div class="col-lg-7 detali_fsn">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupplie->SUP_FSN_NUM}}">
        </div> 
        @endif

       
        <div class="col-lg-3">
        @if( $typedetail == 'article')
        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addfsn"  ><i class="fas fa-sort-numeric-up mr-2"></i>ออกเลข FSN</button>
        @endif
        </div> 
        </div>
        <br>
        
       <div class="row push">
        <div class="col-lg-2">
        <label>
        
        @if( $typedetail == 'parcel')
        รายการวัสดุ :
        @elseif( $typedetail == 'article')
        รายการครุภัณฑ์ :
        @elseif( $typedetail == 'service')
        รายการบริการ :
        @else
        รายการสิ่งปลูกสร้าง :
        @endif

</label>
        </div> 
        <div class="col-lg-3">
        <select name="SUP_TYPE_KIND_ID" id="SUP_TYPE_KIND_ID" class="form-control input-lg typekind_sub js-example-basic-single {{ $errors->has('SUP_TYPE_KIND_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกรายการพัสดุ--</option>
            @foreach ($suppliestypekinds as $suppliestypekind)

                     

                             
                            @if( $typedetail == 'parcel')
                            @if($suppliestypekind ->SUP_TYPE_KIND_ID  == $infosupplie->SUP_TYPE_KIND_ID  )
                                            <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}" selected>{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option> 
                                            @else
                                            <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}">{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option>
                                            @endif
                            @elseif( $typedetail == 'article')

                                             @if($suppliestypekind ->SUP_TYPE_KIND_ID  == $infosupplie->SUP_TYPE_KIND_ID  )
                                            <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}" selected>{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option> 
                                            @else
                                            <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}">{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option>
                                            @endif

                            @elseif( $typedetail == 'service')

                                            @if($suppliestypekind ->SUP_TYPE_KIND_ID  == $infosupplie->SUP_TYPE_KIND_ID )
                                            <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}" selected>{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option> 
                                            @else
                                            <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}">{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option>
                                            @endif

                            @elseif( $typedetail == 'building')

                                            @if($suppliestypekind ->SUP_TYPE_KIND_ID  == $infosupplie->SUP_TYPE_KIND_ID )
                                            <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}" selected>{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option> 
                                            @else
                                            <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}">{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option>
                                            @endif
                               
                            @else
                                            <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}">{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option>
                            @endif
            
            
            @endforeach 
        </select>    
        </div> 
        <div class="col-lg-1">
        <label>
        
                           @if( $typedetail == 'parcel')
                            วัสดุ :
                            @elseif( $typedetail == 'article')
                            ครุภัณฑ์ :
                            @elseif( $typedetail == 'service')
                            บริการ :
                            @else
                            สิ่งปลูกสร้าง :
                            @endif
        
        
        
        </label>
        </div> 
        <div class="col-lg-6">
        <input name="SUP_NAME" id="SUP_NAME" class="form-control input-sm {{ $errors->has('SUP_NAME') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupplie->SUP_NAME}}">
        </div>
       </div>

       <div class="row push">
        <div class="col-lg-2">
        <label>ลักษณะ :</label>
        </div> 
        <div class="col-lg-10">
        <input name="SUP_PROP" id="SUP_PROP" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupplie->SUP_PROP}}">
        </div> 
       </div>


       <div class="row push">
        <div class="col-lg-2">
        <label>รายละเอียด :</label>
        </div> 
        <div class="col-lg-10">
        <input name="CONTENT" id="CONTENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infosupplie->CONTENT}}">
        </div> 
       </div>
       @if( $typedetail == 'parcel')
       <div class="row push">
       <div class="col-lg-2">
        <label>ราคาสืบ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="CONTINUE_PRICE_ID" id="CONTINUE_PRICE_ID" class="form-control input-lg js-example-basic-single {{ $errors->has('CONTINUE_PRICE_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;">
            
            <option value="">--กรุณาเลือกราคาสืบ--</option>
             @if($infosupplie->CONTINUE_PRICE_ID == 1 )<option value="1" selected>ราคาสืบจังหวัด</option>@else<option value="1">ราคาสืบจังหวัด</option>@endif
             @if($infosupplie->CONTINUE_PRICE_ID == 2 )<option value="2" selected>ราคาสืบเขต</option>@else<option value="2">ราคาสืบเขต</option>@endif
             @if($infosupplie->CONTINUE_PRICE_ID == 3 )<option value="3" selected>ราคาจัดซื้อเอง</option>@else<option value="3">ราคาจัดซื้อเอง</option>@endif
           
        
        </select>   
        </div>
        <div class="col-lg-2">
        <label>เลขพัสดุ :</label>
        </div> 
        <div class="col-lg-4">
        <input name="TPU_NUMBER" id="TPU_NUMBER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupplie->TPU_NUMBER}}"> 
        </div>
        </div>

     
       @endif

       <div class="row push">
        <div class="col-lg-2">
        <label>หมวดพัสดุ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="SUP_TYPE_ID" id="SUP_TYPE_ID" class="form-control input-lg type_sub js-example-basic-single {{ $errors->has('SUP_TYPE_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;">
            
            <option value="">--กรุณาเลือกหมวดพัสดุ--</option>
             @foreach ($suppliestypes as $suppliestype)

             @if( $suppliestype ->SUP_TYPE_ID == $infosupplie->SUP_TYPE_ID)
                <option value="{{ $suppliestype ->SUP_TYPE_ID  }}" selected>{{ $suppliestype->SUP_TYPE_NAME}}</option>
             @else
                <option value="{{ $suppliestype ->SUP_TYPE_ID  }}">{{ $suppliestype->SUP_TYPE_NAME}}</option>
             @endif

           
            @endforeach 
        </select>   
        </div> 
        <div class="col-lg-2">
        <label>ประเภทพัสดุ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="SUP_TYPE_MASTER_ID" id="SUP_TYPE_MASTER_ID" class="form-control input-lg js-example-basic-single  {{ $errors->has('SUP_TYPE_MASTER_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;">
            <option value="">--กรุณาเลือกประเภทพัสดุ--</option>
            @foreach ($suppliestypemasters as $suppliestypemaster)

@if( $typedetail == 'parcel')
                @if($suppliestypemaster ->SUP_TYPE_MASTER_ID == 1 )
                <option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}" selected>{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option> 
                @else
                <option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}" >{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option> 
                @endif
@elseif( $typedetail == 'article')
                @if($suppliestypemaster ->SUP_TYPE_MASTER_ID == 2 )
                <option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}" selected>{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option> 
                @else
                <option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}" >{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option> 
                @endif
@elseif( $typedetail == 'service')
            @if($suppliestypemaster ->SUP_TYPE_MASTER_ID == 3 )
                <option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}" selected>{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option> 
                @else
                <option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}" >{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option> 
                @endif
@elseif( $typedetail == 'building')

      @if($suppliestypemaster ->SUP_TYPE_MASTER_ID == 5  )
      <option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}" selected>{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option> 
      @else
      <option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}" >{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option> 
      @endif
   
@else
<option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}">{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option>
@endif



@endforeach 
        </select>   
        </div>
       </div>


       @if( $typedetail == 'parcel')

<div class="row push">

 <div class="col-lg-2">
 <label>จำนวนต่ำสุด :</label>
 </div> 
 <div class="col-lg-4">
 <input name="MIN" id="MIN" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infosupplie->MIN}}" >
 </div>
 <div class="col-lg-2">
 <label>จำนวนสูงสุด :</label>
 </div> 
 <div class="col-lg-4">
 <input name="MAX" id="MAX" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infosupplie->MAX}}" >
 </div>
</div>

@endif
 


     

<div class="medicine"> </div>  

       <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">หน่วยนับ</a>
                                    </li>
                                 


                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                      
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">รายละเอียด</td>
                                                <td style="text-align: center;">หน่วยนับ</td>
                                                <td style="text-align: center;" width="20%">จำนวน</td>
                    
                                            </tr>
                                        </thead> 
                                        <tbody> 
                                 
                                    <tr>
                                        <td > 
                                         หน่วยย่อย

                                            @if($infounitref1 == 'null')
                                            <input type="hidden" name="checkid1" id="checkid1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="null" >
                                            @else
                                            <input type="hidden" name="checkid1" id="checkid1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="{{$infounitref1->ID}}" >
                                            @endif

                                        </td>
                                        <td> 
                                        <select name="SUP_UNIT_ID0" id="SUP_UNIT_ID0" class="form-control input-lg js-example-basic-single {{ $errors->has('SUP_UNIT_ID0') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;">
            
                                                <option value="">--กรุณาเลือกหน่วย--</option>
                                                @foreach ($suppliesunits as $suppliesunit)
                                                   
                                                    @if($infounitref1 == 'null')
                                                        <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}">{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                    @else
                                                        @if($infounitref1->SUP_UNIT_ID == $suppliesunit ->SUP_UNIT_ID)
                                                        <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}" selected>{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                        @else
                                                        <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}">{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach 
                                            
                                            </select>  
                                        </td>
                                        <td>
                                        <input name="SUP_TOTAL0" id="SUP_TOTAL0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="1" readonly>
                                        </td>
            
                                    
        
                                    </tr>


                                    <tr>
                                        <td>
                                         หน่วยบรรจุ

                                            @if($infounitref2 == 'null')
                                            <input type="hidden" name="checkid2" id="checkid2" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="null" >
                                            @else
                                            <input type="hidden" name="checkid2" id="checkid2" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="{{$infounitref2->ID}}" >
                                            @endif

                                        </td>
                                        <td> 
                                        <select name="SUP_UNIT_ID1" id="SUP_UNIT_ID1" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;">
                                               

                                                <option value="">--กรุณาเลือกหน่วย--</option>
                                                @foreach ($suppliesunits as $suppliesunit)
                                                
                                                        @if($infounitref2 == 'null')
                                                            <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}">{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                        @else
                                                            @if($infounitref2->SUP_UNIT_ID == $suppliesunit ->SUP_UNIT_ID)    
                                                            <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}" selected>{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                             @else
                                                            <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}">{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                            @endif
                                                        @endif

                                                @endforeach 
                                            
                                            </select>  
                                        </td>
                                        <td>
                                        @if($infounitref2 == 'null')
                                        <input name="SUP_TOTAL1" id="SUP_TOTAL1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center; "  >
                                         @else
                                        <input name="SUP_TOTAL1" id="SUP_TOTAL1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center; " value="{{$infounitref2 ->SUP_TOTAL}}" >
                                        @endif
                                        </td>
                                  
                                    
                                       
                                    </tr>
                                  
                                
                                       
                               
                                    
                            
                                    </tbody>   
                                    </table>

                                    </div>
                                    </div>
                                </div>
                                </div>
      
</div>
</div>
</div>




        <div class="modal-footer">
        <div align="right">

        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</button>
        <a href="{{ url('manager_asset/suppliesinfoarticle')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</a>
    
    
    </div>

       
        </div>
        </form>  


       
       
               <!--    เมนูเลือก   -->
       
               <div class="modal fade addfsn" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalfsn">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">ออกเลข FSN</h2>
                        </div>
                    <div class="modal-body">
                <body>
                    <div class="container mt-3">
                        <input class="form-control" id="myInput" type="text" placeholder="ค้นหา..">
                <br>
                        <div style='overflow:scroll; height:300px;'>
                        <table class="table">
                            <thead>
                      
                                <tr>
                                    <td style="text-align: center;" width="20%">เลข FSN</td>
                                    <td style="text-align: center;">ชื่อพัสดุ</th>
                                
                                    <td style="text-align: center;" width="5%">เลือก</td>
                                </tr>

                            </thead>
                            <tbody id="myTable">
                            @foreach ($suppliesprops as $suppliesprop)
                                    <tr>
                                        <td >{{$suppliesprop->NUM}}</td>
                                        <td >{{$suppliesprop->PROPOTIES_NAME}}</td>
                                                                
                                        <td >
                                             <button type="button" class="btn btn-hero-sm btn-hero-info"    onclick="selectfsn({{$suppliesprop->PROPOTIES_ID}})">เลือก</button> 
                                            {{-- <button type="button" class="btn btn-hero-sm btn-hero-info"   >เลือก</button> --}}
                                        </td>
                                    </tr>

                                    @endforeach 
                           
                            </tbody>
                        </table>    
                    </div>
                </div>
                </div>
                    <div class="modal-footer">
                        <div align="right">
                                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
                        </div>
                    </div>
                </body>
            </div>
          </div>
        </div>
               
       
               
                      

@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    
    

<script>

$('.btn-submit-edit').click(function (e) { 

var form = $('#form_edit');
formSubmit(form)
       
});


function selectfsn(id){
      
    
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.selectfsn')}}",
                   method:"GET",
                   data:{id:id,_token:_token},
                   success:function(result){
                    $('.detali_fsn').html(result);
                   }
           })

           $('#modalfsn').modal('hide');

  }





        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });

</script> 
    

<script>
  
  $('.typekind_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.fetchsubtype')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.type_sub').html(result);
                     }
             })
            // console.log(select);

            $.ajax({
                     url:"{{route('msupplies.checkfetchsubtype')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.checktypesub').html(result);
                     }
             })



             }        
     });

//-------------------------------------------------------------------------

$('.type_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.parcel')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.number_parcel').html(result);
                     }
             })
            // console.log(select);
             }        
     });

$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });





function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}

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




function readURL(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
        var numb = input.files[0].size/1024;
   
   if(numb > 64){
       alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
           fileInput.value = '';
           return false;
       }	
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();
            
                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                        }
            
                        reader.readAsDataURL(input.files[0]);
                    }else{
        
                                alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                                fileInput.value = '';
                                return false;
       
                        }
                }
            
                $("#picture").change(function () {
                    readURL(this);
                });




  
</script>




@endsection