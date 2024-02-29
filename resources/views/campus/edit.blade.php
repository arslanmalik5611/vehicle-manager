@extends('layout.master')
@section('page_title','Campus Edit')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-edit fa-icon"></i> Edit </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'campus'}}" class="btn btn-outline-success btn-sm">Campus
                        List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label"><span class="required">*</span> Name </label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter Name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label"><span class="required">*</span> Short Name </label>
                        <input type="text" class="form-control" id="short_name" name="short_name"
                               placeholder="Enter Short Name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="session_id" class="form-label"><span class="required"></span> Active Session </label>
                        <select name="session_id" id="session_id" class="form-control session_id select2"></select>
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label"><span class="required"></span> Phone </label>
                        <input type="text" class="form-control" id="phone" name="phone"
                               placeholder="Enter phone" >
                        <input type="hidden" value="{{ request()->id }}" name="id">
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label"><span class="required"></span> Fax </label>
                        <input type="text" class="form-control" id="fax" name="fax"
                               placeholder="Enter Fax">
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label"><span class="required"></span> Email </label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Enter Email" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label"> Web </label>
                        <input type="text" class="form-control" id="web" name="web"
                               placeholder="Enter Short Web">
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label"><span class="required"></span> Address </label>
                        <input type="text" class="form-control" id="address" name="address"
                               placeholder="Enter address">
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label"> Campus Type </label>
                        <select class="form-control select2" id="campus_type_id" name="campus_type_id">
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="notes" class="form-label"> Notes </label>
                        <textarea class="form-control tinymce" id="notes" name="notes"
                                  placeholder="Enter Notes"></textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i
                            class="fas fa-chevron-right ms-3 go-icon"></i> <i
                            class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        var id = "{{ request()->id }}";
        $(document).ready(function () {
            campus_type_load_data();
            session_load();
            tinymce_initialize(200);
        });

        function campus_type_load_data() {
            $.ajax({
                url: api_url + `campus/${id}/show`,
                dataType: "JSON",
                success: function (response) {
                    $('#name').val(response.data.name);
                    $('#short_name').val(response.data.short_name);
                    $('#phone').val(response.data.phone);
                    $('#fax').val(response.data.fax);
                    $('#email').val(response.data.email);
                    $('#web').val(response.data.web);
                    $('#address').val(response.data.address);
                    $('#campus_type_id').val(response.data.campus_type.id).change();
                    $('#session_id').val(response.data.session.id).change();
                    if (response.data.notes)
                        tinyMCE.get('notes').setContent(response.data.notes);
                }
            });
        }

        $("#form-data").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "campus/update",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        success_notify(data.message)
                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });

    </script>
@endsection

