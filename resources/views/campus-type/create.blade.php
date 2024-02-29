@extends('layout.master')
@section('page_title','Campus Type')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'campus-types'}}" class="btn btn-outline-success btn-sm">Campus Type
                        List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="name" class="form-label"><span class="required">*</span>  Name </label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter Name" required>
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="name" class="form-label"><span class="required"></span> Code </label>
                        <input type="text" class="form-control" id="name" name="code"
                               placeholder="Enter Code" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="notes" class="form-label"> Notes </label>
                        <textarea class="form-control tinymce" id="notes" name="notes"
                                  placeholder="Enter Notes"></textarea>
                    </div>
                </div><!--End of row-->


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
            $("#form-data").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: api_url + "campus-types/store",
                    type: "POST",
                    data: $(this).serialize(),
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

