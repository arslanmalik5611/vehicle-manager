@extends('layout.master')
@section('page_title','Group')
​
@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> Group List </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'groups/create'}}" class="btn btn-outline-secondary btn-sm">Create
                    Group</a>
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
                'url': api_url+'groups',
                'cols': {
                    'name': 'Name',  //data_column_name : Title
                    'notes': 'Notes',  //data_column_name : Title
                },
                'editMethod': 'groups', //false-if not show edit button
                'deleteMethod': 'groups' //false-if not to show delete button
            };
            drawTable(datatableObj);
        });
    </script>
@endsection
