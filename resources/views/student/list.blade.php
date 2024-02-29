@extends('layout.master')
@section('page_title','Student')
​
@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> Student </h2>
            </div>
            <div>
                <div>
                    <a href="{{env('BASE_URL').'student/create'}}" class="btn btn-outline-secondary btn-sm">Create
                        Student</a>
                </div>
                <div class="mt-2">
                    <select class="form-control" name="class_id" id="class_id">
                    </select>
                </div>
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
    $(document).ready(function() {
        nav_bar_hide();
        class_option_load();
        studentDataTableLoad();
        $(document).on('change', '#class_id', function() {
            var id = $(this).val();
            studentDataTableLoad(id);
        });
    });

    $(document).on('click', '.cardGenerateBtn', function(e) {
        e.preventDefault();
        thisElem = $(this);
        id = $(this).attr('data-id');
        $.ajax({
            url: api_url + 'student/' + id + '/card-generate',
            type: "POST",
            data: {
                'id': id
            },
            dataType: "JSON",
            success: function(response) {
                if (response.status) {
                    success_notify(response.message);
                    window.open(`${response.card_path}`, '_blank');
                } else {
                    error_notify(response.message);
                }


            }
        });
    });
</script>
@endsection