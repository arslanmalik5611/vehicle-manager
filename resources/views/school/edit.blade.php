@extends('layout.master')
@section('page_title','School Edit')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-edit fa-icon"></i> Edit </h2>
                </div>
{{--                <div>--}}
{{--                    <a href="{{env('BASE_URL').'school'}}" class="btn btn-outline-success btn-sm">School--}}
{{--                        List</a>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="name" class="form-label"><span class="required">*</span> Name </label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter Name" required>
                    </div>
                    <div class="col-md-5">
                        <label for="name" class="form-label"><span class="required"></span> Short Name </label>
                        <input type="text" class="form-control" id="short_name" name="short_name"
                               placeholder="Enter Short Name" required>
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="name" class="form-label"><span class="required"></span> Phone </label>
                        <input type="text" class="form-control" id="phone" name="phone"
                               placeholder="Enter phone" required>
                        <input type="hidden" value="{{ request()->id }}" name="id">
                    </div>
                    <div class="col-md-5">
                        <label for="name" class="form-label"><span class="required"></span> Fax </label>
                        <input type="text" class="form-control" id="fax" name="fax"
                               placeholder="Enter Fax">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="name" class="form-label"><span class="required"></span> Email </label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Enter Email" required>
                    </div>
                    <div class="col-md-5">
                        <label for="name" class="form-label"> Web </label>
                        <input type="text" class="form-control" id="web" name="web"
                               placeholder="Enter Short Web">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="name" class="form-label"><span class="required"></span> Address </label>
                        <input type="text" class="form-control" id="address" name="address"
                               placeholder="Enter address">
                    </div>
                    <div class="col-md-5">
                        <label for="name" class="form-label"> Slogan </label>
                        <input type="text" class="form-control" id="slogan" name="slogan"
                               placeholder="Enter Slogan" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-5 col-12">
                        <label for="picture" class="form-label"> Logo </label>
                        <div class="col-md-12" for="picture">
                            <img src="{{asset('panel_assets/images/img.png')}}" id="image" alt="" >
                            <input type="file" class="form-control" id="picture" name="logo" onchange=""
                                   style="width: 200px; background-color: #e9ecef">
                        </div>
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
            show_img();
        });

        function campus_type_load_data() {
            $.ajax({
                url: api_url + `school/${id}/show`,
                dataType: "JSON",
                success: function (response) {
                    $('#name').val(response.data.name);
                    $('#short_name').val(response.data.short_name);
                    $('#phone').val(response.data.phone);
                    $('#email').val(response.data.email);
                    $('#web').val(response.data.web);
                    $('#address').val(response.data.address);
                    $('#slogan').val(response.data.slogan);
                    $('#image').attr('src', response.data.logo_url);
                }
            });
        }

        $("#form-data").on('submit', function (e) {
            e.preventDefault();
            formData = new FormData($(this)[0]);
            $.ajax({
                url: api_url + "school/update",
                type: "POST",
                data: formData,
                contentType : false,
                processData : false,
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

