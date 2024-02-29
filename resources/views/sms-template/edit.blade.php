@extends('layout.master')
@section('page_title','Sms Template Edit')
<style>
    .sms-textarea {
        height: 300px;
    }

    .copyToClipBoard {
        cursor: pointer;
        color: #0dcaf0;
    }

    #custom-tooltip {
        display: none;
        margin-left: 40px;
        padding: 5px 12px;
        background-color: #0dcaf0;
        border-radius: 4px;
        color: #fff;
    }
</style>
@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-edit fa-icon"></i>Sms Template Edit </h2>
            </div>
            <div>
                <a href="{{env('BASE_URL').'sms-template'}}" class="btn btn-outline-success btn-sm">Sms Tempalte
                    List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" id="form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="title" class="form-label"><span class="required">*</span> Title </label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                    <label for="code" class="form-label"><span class="required">*</span> code </label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="Enter code" required>
                    <table class="table table-bordered">
                        <thead>
                            <th>Place Holder</th>
                            <th>Column Name</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Student Name</td>
                                <td>{student_name} <i class="copyToClipBoard far fa-copy"></i></td>
                            </tr>
                            <tr>
                                <td>Father Name</td>
                                <td>{father_name} <i class="copyToClipBoard far fa-copy"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <label for="body" class="form-label"> Body </label>
                    <textarea class="form-control sms-textarea" id="body" name="body" placeholder="Enter Body"></textarea>
                </div>

            </div>
            <div class="card-footer text-end">
                <input type="hidden" name="id" id="id">
                <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i class="fas fa-chevron-right ms-3 go-icon"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page_level_scripts')
<script type="text/javascript">
    var id = "{{ request()->id }}";
    $(document).ready(function() {
        sms_template_load_data();
    });

    function sms_template_load_data() {
        $.ajax({
            url: api_url + `sms-template/${id}/show`,
            dataType: "JSON",
            success: function(response) {
                $('#id').val(id);
                $('#title').val(response.data.title);
                $('#code').val(response.data.code);
                $('#body').val(response.data.body);
            }
        });
    }

    $("#form-data").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: api_url + "sms-template/update",
            type: "POST",
            data: $(this).serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    success_notify(data.message)
                } else {
                    error_notify(data.message);
                }
            }
        });
    });
    $(".copyToClipBoard").on('click', function(e) {
        copyTd(e);
    })
</script>
@endsection