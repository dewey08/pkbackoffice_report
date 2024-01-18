@extends('layouts.medical')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@section('content')


<style>
    .center {
    margin: auto;
    width: 100%;
    padding: 10px;
    }
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 14px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
    padding-left:10px;
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
        
                    }   

    .form-control {
        font-size: 13px;
        
                    }   
                    table, td, th {
            border: 1px solid black;
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

    use App\Http\Controllers\ManagermedicalController;

    use App\Http\Controllers\ManagersuppliesController;
    use App\Http\Controllers\ManagerwarehouseController;

?>
         
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>วัสดุคงคลังยาและเวชภัณฑ์
                </B></h3>

           
                  
            </div>
            <div class="block-content block-content-full">
     
                    <form action="{{ route('mmedical.reportInventory') }}" method="post">
                        @csrf
                    
                    <div class="row">
    
            
            <div class="col-sm-0.5">
                &nbsp;&nbsp; รายการพัสดุ  &nbsp;
            </div>
            <div class="col-sm-2">
                <span>
                    <select name="SEND_TYPEKIND" id="SEND_TYPEKIND" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                    <option value="">--ทั้งหมด--</option>
                    @foreach ($suppliestypekinds as $suppliestypekind)
                        @if($suppliestypekind->SUP_TYPE_KIND_ID == $typekind_check)
                        <option value="{{ $suppliestypekind->SUP_TYPE_KIND_ID  }}" selected>{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option>
                        @else
                        <option value="{{ $suppliestypekind->SUP_TYPE_KIND_ID  }}">{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option>
                        @endif
                    
                                                                                            
                    @endforeach 
                

                    </select> 
                    </span>
            </div>
          
            <div class="col-sm-0.5">
                &nbsp;&nbsp; หมวดวัสดุ &nbsp;
            </div>
            <div class="col-sm-2">
                <span>
                    <select name="SEND_TYPE" id="SEND_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                    <option value="">--ทั้งหมด--</option>
                    @foreach ($suppliestypes as $suppliestype)
                        @if($suppliestype->SUP_TYPE_ID == $type_check)
                        <option value="{{ $suppliestype->SUP_TYPE_ID  }}" selected>{{ $suppliestype->SUP_TYPE_NAME}}</option>
                        @else
                        <option value="{{ $suppliestype->SUP_TYPE_ID  }}">{{ $suppliestype->SUP_TYPE_NAME}}</option>
                        @endif
                                                                        
                    @endforeach 

                    </select>
                    </span>
            </div>

            <div class="col-sm-0.5">
                &nbsp;&nbsp; คงเหลือ &nbsp;
            </div>
            <div class="col-sm-2">
                <span>
                    <select name="remaining" id="remaining" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                        @if($remaining == 1)
                            <option value="">--ทั้งหมด--</option>
                            <option value="1" selected>น้อยกว่าจุดต่ำสุด</option>                                       
                            <option value="2">มากกว่าจุดมากกว่า</option> 
                        @elseif($remaining == 2)
                            <option value="">--ทั้งหมด--</option>
                            <option value="1">น้อยกว่าจุดต่ำสุด</option>                                       
                            <option value="2" selected>มากกว่าจุดมากกว่า</option> 
                        @else
                            <option value="" selected>--ทั้งหมด--</option>
                            <option value="1">น้อยกว่าจุดต่ำสุด</option>                                       
                            <option value="2">มากกว่าจุดมากกว่า</option> 
                        @endif
                    </select>
                    </span>
            </div>

            <div class="col-sm-0.5" >
                &nbsp;&nbsp; ค้นหา &nbsp;
            </div>
            <div class="col-sm-2">
                <input type="search"  name="search" class="form-control"  value="{{$search}}">
            </div>
           
                  <div class="col-sm">
                  <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;" >ค้นหา</button>
                   </div>
    
    </div>
    </form>
         
            <div class="table-responsive"> 
                <form onsubmit="dosubmit(this)">
                <div align="right">
                 
                  <span id="sendData" class="btn btn-hero-sm btn-hero-info" url="{{ url('manager_medical/reportinventorysave')}}" style="font-family: 'Kanit', sans-serif;" >สร้างรายการขอซื้อ</span>
                 
              </div>
                  <br>
                <table class="table-striped table-vcenter js-dataTable/" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%"  rowspan="2">รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%" rowspan="2">รหัสเดิม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" rowspan="2">ชื่อวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" rowspan="2">ผู้ผลิต</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%" rowspan="2">หมวดวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%" colspan="1">ยอดเบิก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%" colspan="2">จำกัดคลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" rowspan="2">คงคลัง</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%" rowspan="2">ปริมาณยอดสั่งซื้อ</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%" rowspan="2">จำนวนที่จะสั่งซื้อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%"  rowspan="2">ราคาต่อหน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%" rowspan="2">หน่วย</th>
                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="1%" rowspan="2"><span><input type="checkbox" id="select_all" /> เลือก</span></th>

                        </tr >

                        <tr height="40">
                         
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เฉลี่ย/เดือน</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ต่ำสุด</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >สุงสุด</th>


                        </tr >

                    </thead>
                    <tbody>
                        
                        <?php $number = 0 ;?>
                        @foreach ($infowarehousestores as $infowarehousestore)
                        <?php
                        $num1 = ManagerwarehouseController::sumstorereceive($infowarehousestore->STORE_ID);
                        $num2 = ManagerwarehouseController::sumstoreexport($infowarehousestore->STORE_ID);  
                         $resultnum = $num1-  $num2;

                         $number++;
                         $amountbuy = $infowarehousestore->MAX-$resultnum ;
                         

                         $numconvert = ManagermedicalController::convertunit($infowarehousestore->STORE_SUP_ID);
                        ?> 
                
                            <tr height="20">
                                
                              
                                <td  key="{{$infowarehousestore->ID}}" class="text-font text-pedding" >{{$infowarehousestore->SUP_FSN_NUM}}</td>
                                <td class="text-font text-pedding" >{{$infowarehousestore->SUP_CODE}}</td>
                                <td class="text-font text-pedding" >{{$infowarehousestore->SUP_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infowarehousestore->VENDOR_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infowarehousestore->SUP_TYPE_NAME}}</td>

                                <td class="text-font text-pedding" style="text-align: center;">0</td> 
                                <td class="text-font text-pedding" >{{$infowarehousestore->MIN}}</td>
                                <td class="text-font text-pedding" >{{$infowarehousestore->MAX}}</td>
                                <td class="text-font text-pedding" style="text-align: center;">{{(number_format($resultnum))}}</td>
                                
                              
                                <td class="text-font text-pedding" style="text-align: center;">{{$amountbuy}}</td>
                                <td class="text-font text-pedding"  style="text-align: left;"><input key="9" obj="amount" type="text" name="amount{{$number}}" id="amount{{$number}}" class="amount" size="5" value="{{number_format($amountbuy/$numconvert, 0, '.', '')}}"> * {{$numconvert}} </td>
                                <td class="text-font text-pedding"  style="text-align: center;"><input key="10" obj="unitpice" type="text" name="unitpice{{$number}}" id="unitpice{{$number}}" class="unitpice" size="5" value="0"></td>
                                <td class="text-font text-pedding" >{{$infowarehousestore->SUP_UNIT_NAME}}</td>
               
                                <td class="text-font text-pedding" style="text-align: center;">

                                    <input  type="checkbox" class="checkbox" id="checkid{{$number}}" name="checkid{{$number}}" value="{{$number}}">
                                </td>
                           
    
                            </tr>    
           
                            @endforeach  
                       

                    </tbody>
                </table>

            </form>

                                        </body>
                                      
                                            
                         
  
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
    <script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>

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


 
 <script type="text/javascript">

// ###### โอ๋ function การส่งค่า selectbox  
var dataset = [];
$('#v2').html(JSON.stringify(dataset,null, 1));

// function เลือกทั้งหมด
$('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
                var currentRow=$(this).closest("tr"); 
                    var id=currentRow.find("td:eq(0)").attr('key');
                    var amount=currentRow.find('td:eq(10) input').val()
                    var unitpice=currentRow.find('td:eq(11) input').val()
                    var data=id+"\n"+amount+"\n"+unitpice;
                    
                    dataset.push({ id: id, amount: amount, unitpice:unitpice});
                    $('#v2').html(JSON.stringify(dataset,null, 1));

            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
                dataset =[];
            });
        }
    });


    $('.checkbox').click(function (e) { 
                if($(this).prop("checked") == true){
                    var currentRow=$(this).closest("tr"); 
                    var id=currentRow.find("td:eq(0)").attr('key');
                    var amount=currentRow.find('td:eq(10) input').val()
                    var unitpice=currentRow.find('td:eq(11) input').val()
                    var data=id+"\n"+amount+"\n"+unitpice;
                    
                    dataset.push({ id: id, amount: amount, unitpice:unitpice});
                    $('#v2').html(JSON.stringify(dataset,null, 1));
                    console.log(amount);
                }
                else if($(this).prop("checked") == false){
                    var currentRow=$(this).closest("tr"); 
            
                    var id=currentRow.find("td:eq(0)").attr('key');
                    removeItem(id)
                    $('#v2').html(JSON.stringify(dataset,null, 1));

                    console.log("Checkbox is unchecked.");
                }
    }); 

        $('.amount,.unitpice').keyup(function (e) { 
            var currentRow=$(this).closest("tr"); 
            var id=currentRow.find("td:eq(0)").attr('key');
            var type= $(this).attr('obj');
            var value =$(this).val();
            updateItem(id,value,type)

        });

    function updateItem( id,value,type ) {
        for (var i in dataset) {
            if (dataset[i].id == id) {
                if(type == 'amount'){
                    dataset[i].amount = value;
                }else if(type == 'unitpice'){
                    dataset[i].unitpice = value;
                }else{

                }
                break;
            }
        }
        $('#v2').html(JSON.stringify(dataset,null, 1));
    }

    //remove rows
    function removeItem(id){
        const requiredIndex = dataset.findIndex(el => {
            return el.id === String(id);
        });
        if(requiredIndex === -1){
            return false;
        };
            dataset.splice(requiredIndex, 1);
    }

    $('#sendData').click(function (e) { 
        // e.preventDefault();
        var url = $(this).attr('url');
        $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
        $.ajax({
            type: "post",
            url: url,
            data:{dataset: dataset},
            dataType: "json",
            beforeSend: function (){
                $('#v2').html('loading');
            },
            success: function (response) {
                console.log(response)
                $('#v2').html('success');
                Swal.fire(
                    'สร้างรายการขอซื้อเรียบร้อย',
                    '',
                    'success'
                    )
            }
        });
        // console.log(dataset)
        
    });
// ###### โอ๋  End


    function dosubmit( frm )
    {
      var query = getRequestBody( frm ); //เอาค่านี้ไปใช้งาน
      alert( query );

    }
    
    function getRequestBody( pForm ) {//รับ formname
      var nParams = new Array();
      for ( var n = 0 ; n < pForm.elements.length ; n++ )
      {

               if(pForm.elements[n].type !== "submit"){
                
                if(pForm.elements[n].checked == true && pForm.elements[n].type == "checkbox" ){
                    var pParam = encodeURIComponent( pForm.elements[n].name );
                    pParam += "=";
                    pParam += encodeURIComponent( pForm.elements[n].value );
                }else{
                    var pParam = encodeURIComponent( pForm.elements[n].name );
                    pParam += "=";
                    pParam += encodeURIComponent( pForm.elements[n].value );
                }
               


                    nParams.push( pParam ); //นำมาใส่ Array
               }
        
    //   }


      }
      return nParams.join( "&" ); //แปลง Array ให้เป็น String
    }
    
    </script>

@endsection