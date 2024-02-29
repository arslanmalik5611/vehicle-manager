@extends('layout.master')
@section('page_title','User')
​
@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> User List </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'users/create'}}" class="btn btn-outline-secondary btn-sm">Create
                    User</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="datatable">
            </table>
        </div>
    </div>
@endsection
​
@section('page_level_scripts')
    <script src="{{asset('panel_assets/js/common_datatables.js?v='.date('ymdhis'))}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var datatableObj = {
                'url': api_url+'user',
                'cols': {
                    'username': 'Name',  //data_column_name : Title
                    'email': 'Email',
                    'collection_center.name': 'Collection Center',
                    'role.name': 'Role',
                },
                'editMethod': 'users', //false-if not show edit button
                'deleteMethod': 'user' //false-if not to show delete button
            };
            drawTable(datatableObj);
        });
    </script>
@endsection
