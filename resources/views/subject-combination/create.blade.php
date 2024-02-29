@extends('layout.master')
@section('page_title','Subject Combination')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'subject-combinations'}}" class="btn btn-outline-success btn-sm">Subject
                        Combination
                        List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="name" class="form-label"><span class="required">*</span>Combination Name </label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Enter Name" required>
                            </div>
                        </div><!--End of row-->

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="short_name" class="form-label">Short Name </label>
                                <input type="text" class="form-control" id="short_name" name="short_name"
                                       placeholder="Enter Short Name">
                            </div>
                        </div><!--End of row-->

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="class_id" class="form-label">Select Class </label>
                                <select name="class_id" id="class_id" class="class_id select2"></select>
                            </div>
                        </div><!--End of row-->

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="group_id" class="form-label">Select Group </label>
                                <select name="group_id" id="group_id" class="group_id select2"></select>
                            </div>
                        </div><!--End of row-->
                    </div>
                    <div class="col-md-6 col-12">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Subject</td>
                            </tr>
                            </thead>
                            <tbody class="subject_id" id="subjectIdBody">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i
                            class="fas fa-chevron-right ms-3 go-icon"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            class_load();
            group_load();
            subject_load();

            function get_checked_subject() {
                subjectArray = [];
                var choose_subject = '';
                $('.subject_id:checked').each(function () {
                    subjectArray.push($(this).val());
                });
                return subjectArray;
            }


            $("#form-data").on('submit', function (e) {
                name = $("#name").val();
                short_name = $("#short_name").val();
                class_id = $('#class_id').val();
                group_id = $('#group_id').val();
                subjects = get_checked_subject();
                e.preventDefault();
                $.ajax({
                    url: api_url + "subject-combinations/store",
                    type: "POST",
                    data: {
                        'name': name,
                        'short_name': short_name,
                        'class_id': class_id,
                        'group_id': group_id,
                        'subjects': subjects
                    },
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) {
                            success_notify(data.message);

                        } else {
                            error_notify(data.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection

