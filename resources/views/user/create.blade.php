@extends('layout.master')
@section('page_title','User')

@section('content')
    <style>
        #image{
            height: 200px;
        }
    </style>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'users'}}" class="btn btn-outline-success btn-sm">User
                        List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <figure>
                    <blockquote class="blockquote">
                        <p>General Information</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Please fill in <cite title="Source Title">details below</cite>
                    </figcaption>
                </figure>
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="first_name" class="form-label"><span class="required">*</span>First Name </label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="Enter First Name" required>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="last_name" class="form-label"><span class="required"></span>Last Name </label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                               placeholder="Enter Last Name" required>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="dob" class="form-label"><span class="required"></span>DOB </label>
                        <input type="text" class="form-control datepicker" autocomplete="off" id="dob" name="dob"
                               placeholder="dd/mm/YY">
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="gender" class="form-label"><span class="required">*</span>Gender </label>
                        <select type="text" class="form-control" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div><!--End of row-->

                <div class="row mb-3">
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="phone" class="form-label"><span class="required"></span>Phone No </label>
                        <input type="number" class="form-control" id="phone" name="phone"
                               placeholder="Enter Phone No">
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="religion" class="form-label"><span class="required"></span>Religion </label>
                        <select class="form-control" name="religion" id="religion">
                            <option value="muslim">Muslim</option>
                            <option value="non_muslim">Non-Muslim</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="address" class="form-label"><span class="required"></span>Address </label>
                        <input type="text" class="form-control " id="address" name="address"
                               placeholder="Enter Address">
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <label for="address_temporary" class="form-label"><span class="required"></span>Temporary Address </label>
                        <input type="text" class="form-control" id="address_temporary" name="address_temporary"
                               placeholder="Enter Temporary Address">
                    </div>
                </div><!--End of row-->

                <figure>
                    <blockquote class="blockquote">
                        <p>Login Information</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Please fill in <cite title="Source Title">details below</cite>
                    </figcaption>
                </figure>

                <div class="row mb-3">
                    <div class="col-md-4 col-sm-6 col-12">
                        <label for="role_id" class="form-label"><span class="required"></span>Role </label>
                        <select name="role_id" id="role_id" class="role_id select2"></select>
                    </div>
                    <div class="col-sm-4 col-12">
                        <label for="email" class="form-label"><span class="required"></span>Email </label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="example@gmail.com" required>
                    </div>
                    <div class="col-sm-4 col-12">
                        <label for="password" class="form-label"><span class="required"></span>Password </label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Enter Password">
                    </div>
                </div>

                <figure>
                    <blockquote class="blockquote">
                        <p>Academic</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Please fill in <cite title="Source Title">details below</cite>
                    </figcaption>
                </figure>

                <div class="row mb-3">
                    <div class="col-md-8 col-12">
                        <div class="row mb-3">
                            <div class="col-sm-6 col-12">
                                <label for="joining_date" class="form-label"><span class="required"></span>Joining Date </label>
                                <input type="text" class="form-control datepicker" autocomplete="off" id="joining_date" name="joining_date"
                                       placeholder="dd/mm/YY">
                            </div>
                            <div class="col-sm-6 col-12">
                                <label for="qualification" class="form-label"><span class="required"></span>Qualification </label>
                                <input type="text" class="form-control " id="qualification" name="qualification"
                                       placeholder="Enter Qualification">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-12">
                                <label for="session_id" class="form-label"><span class="required"></span>Session </label>
                                <select name="session_id" id="session_id" class="session_id select2"></select>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <label for="designation" class="form-label"><span class="required"></span>Designation </label>
                                <input type="text" class="form-control " id="designation" name="designation"
                                       placeholder="Enter Designation">
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <label for="salary" class="form-label"><span class="required"></span>Salary </label>
                                <input type="number" class="form-control" id="salary" name="salary"
                                       placeholder="Enter Salary">
                            </div>
                            <div class="col-12">
                                <label for="bank_information" class="form-label"><span class="required"></span>Bank Information </label>
                                <textarea name="bank_information" id="bank_information" class="form-control" placeholder="Bank Name, Bank Account Number"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="picture" class="form-label"> Picture </label>
                        <div class="col-md-12" for="picture">
                            <img src="{{asset('panel_assets/images/img.png')}}" id="image" alt=""
                                 style="width: 200px; border: 1px solid #000">
                            <input type="file" class="form-control" id="picture" name="picture" onchange=""
                                   style="width: 200px; background-color: #e9ecef">
                        </div>
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
        $(document).ready(function (){
            role_load();
            session_load();
            show_img();

            $("#form-data").on('submit', function (e) {
                e.preventDefault()
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: api_url + "users/store",
                    type: "POST",
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
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

