<div class="row">
  <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
              <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกรูปแบบการจัดห้อง</h2>
            </div>
            <div class="modal-body">
            <body>
               <div class="row">
            @foreach ($style_rooms as $style_room)                                                     
               <div class="col-md-3 col-xl-3">
                                <a class="block block-rounded"  onclick="selectstyleroom({{$style_room->id}});">
                                    <div class="block-content" style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($style_room->STYLEROOM_IMAGE)) }});">
                                        <p>
                                        <span class="badge badge-info font-w2000 p-2 text-uppercase">
                                       {{$style_room->STYLEROOM_NAME}} 
                                        </span>
                                        </p>
                                    <div class="mb-3 mb-sm-3 d-sm-flex justify-content-sm-between align-items-sm-center">
                                            <img src="data:image/png;base64,{{ chunk_split(base64_encode($style_room->STYLEROOM_IMAGE)) }}"  width="100%"> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                @endforeach 
                </div>  
          </body>
          </div>
            <div class="modal-footer">
            <div align="right">
    
            <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
            </div>
            </div>
        </div>
      </div>
    </div>
 </div>