@extends('layout.master')
@section('page_title','User')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'users'}}" class="btn btn-outline-success btn-sm">Users List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="first_name" class="form-label"><span class="required">*</span> First Name </label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="Enter First Name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="last_name" class="form-label"> Last Name </label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                               placeholder="Enter Last Name">
                    </div>
                    <div class="col-md-4">
                        <label for="username" class="form-label">User Name </label>
                        <input type="text" class="form-control" id="username" name="username"
                               placeholder="Enter User Name">
                    </div>
                </div><!--End of row-->
                <div class="row">
                    <div class="col-md-4">
                        <label for="email" class="form-label"><span class="required">*</span> Email </label>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="Enter Email" required>
                    </div>
                    <div class="col-md-4">
                        <label for="password" class="form-label"><span class="required">*</span> Password </label>
                        <input type="text" class="form-control" id="password" name="password"
                               placeholder="Enter Password" required>
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label"> Phone </label>
                        <input type="text" class="form-control" id="phone" name="phone"
                               placeholder="Enter Phone">
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="collection_center_id" class="form-label">Collection Centers</label>
                        <div class="input-group mb-3">
                            <select name="collection_center_id" id="collection_center_id"
                                    class="select2 form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="role_id" class="form-label">Role</label>
                        <div class="input-group mb-3">
                            <select name="role_id" id="role_id" class="select2 form-control"></select>
                        </div>
                    </div>
                </div><!--End of row-->

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address"
                                  placeholder="Enter Address"></textarea>
                    </div>
                </div><!--End of row-->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="notes" class="form-label">Note </label>
                        <textarea class="form-control" id="notes" name="notes"
                                  placeholder="Enter Note"></textarea>
                    </div>
                </div> <!--End of row-->
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
        $(document).ready(function () {
            collection_centers_load();
            roles_load();
            $("#form-data").on('submit', function (e) {
                $('.submit-btn').attr('disabled', true);
                $('.go-icon').hide();
                $('.spinner-icon').show();
                e.preventDefault();
                $.ajax({
                    url: api_url + "user/create",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) {
                            $('.go-icon').show();
                            $('.spinner-icon').hide();
                            $('.submit-btn').attr('disabled', false);
                            Lobibox.notify('success', {
                                size: 'mini',
                                sound: false,
                                msg: data.message
                            });

                        } else {
                            $('.submit-btn').attr('disabled', false);
                            $('.go-icon').show();
                            $('.spinner-icon').hide();
                            Lobibox.notify('error', {
                                size: 'mini',
                                sound: false,
                                msg: data.message
                            });

                        }
                    }
                });
            });
        });
    </script>
@endsection

