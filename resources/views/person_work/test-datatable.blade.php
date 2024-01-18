@extends('layouts.backend')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="/css/plugins/dataTables/responsive.dataTables.min.css" rel="stylesheet">

@section('content')

<div class="card-body">
    <div id="wrapper">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive" style="margin-top: 25px;">
                        <table class="table table-md" id="viewListDataTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>card code</th>
                                    <th>full name</th>
                                    <th>address</th>
                                    <th>tel</th>
                                    <th>image</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                    <th>tool</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script src="/js/plugins/dataTables/dataTables.responsive.min.js"></script>

@section('script')
    <script>
        var viewListDataTable = $('#viewListDataTable').DataTable();
    </script>
@endsection