@extends('layout.master')
@section('page_title','Sms Template')
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
                <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i>Sms Template Create </h2>
            </div>
            <div>
                <a href="{{env('BASE_URL').'sms-template'}}" class="btn btn-outline-success btn-sm">Sms Template List</a>
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
                <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i class="fas fa-chevron-right ms-3 go-icon"></i></button>
            </div>
        </form>
    </div>
    <!-- <div class="card-body">
        <form method="post" id="form-data">
            <div class="row mb-3">
                <div class="col-md-5">
                    <label for="title" class="form-label"><span class="required">*</span> Title </label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-5">
                    <label for="code" class="form-label"><span class="required">*</span> Code </label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="Enter code" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-5">
                    <label for="body" class="form-label"> Body </label>
                    <textarea class="form-control" id="body" name="body" placeholder="Enter Body"></textarea>
                </div>
            </div>


            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i class="fas fa-chevron-right ms-3 go-icon"></i></button>
            </div>
        </form>
    </div> -->
</div>
@endsection
@section('page_level_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#form-data").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "sms-template/store",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        success_notify(data.message);

                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });
        $(".copyToClipBoard").on('click', function(e) {
            copyTd(e);
        })
    });
</script>
@endsection