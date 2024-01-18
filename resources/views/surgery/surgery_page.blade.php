@extends('layouts.surgery')
@section('title', 'PK-BACKOFFice || ศัลยกรรม')
@section('content')
  
<div class="tabs-animation">
    <div class="row"> 
        
        <div class="col-lg-12 col-xl-12">
            <div class="main-card mb-3 card" >
                <div class="grid-menu grid-menu-3col"> 
                    <div class="g-0 row">
                        <div class="col-sm-12"> 
                                <div class="main-card mb-3 card">
                                    <div class="card-header">
                                       ศัลยกรรม 
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group"> 
                                                <button class="active btn btn-focus">ศัลยกรรม</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับ</th>
                                                        <th>vn</th>
                                                        <th>hn</th>
                                                        <th>cid</th>
                                                        <th>vstdate</th>
                                                        <th>vsttime</th>
                                                        <th>fullname</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $ia = 1; ?>
                                                    {{-- @foreach ($department as $item)
                                                      <tr>
                                                            <td>{{ $ia++ }}</td>
                                                            <td>{{ $item->vn }}</td>
                                                            <td>{{ $item->hn }}</td>
                                                            <td>{{ $item->cid }}</td>
                                                            <td>{{ $item->vstdate }}</td>
                                                            <td>{{ $item->vsttime }}</td>
                                                            <td>{{ $item->fullname }}</td>
                                                        </tr>
                                                    @endforeach --}}
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                
                                    </div>
                                </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div> 
      

@endsection
@section('footer')
 
@endsection
 
 