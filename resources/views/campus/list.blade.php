@extends('layout.master')
@section('page_title','Campus')
​
@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> Campus  </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'campus/create'}}" class="btn btn-outline-secondary btn-sm">Create
                        Campus</a>
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
                'url': api_url+'campus',
                'cols': {
                    'name': 'Name',
                    'short_name': 'Short Name',  //data_column_name : Title
                    'phone': ' Phone',
                    'fax': ' Fax',
                    'web': ' Web',
                    'address': 'Address',
                    'campus_type.name': 'Campus Type',
                },
                'editMethod': 'campus', //false-if not show edit button
                'deleteMethod': 'campus' //false-if not to show delete button
            };
            drawTable(datatableObj);
        });
    </script>
@endsection
