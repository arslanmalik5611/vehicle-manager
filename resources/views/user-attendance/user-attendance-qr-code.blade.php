@extends('layout.master')
@section('page_title','Attendance')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-qrcode fa-icon"></i> User Attendance with QR </h2>
                </div>
                {{--                <div>--}}
                {{--                    <a href="{{env('BASE_URL').'attendances'}}" class="btn btn-outline-success btn-sm">Attendance--}}
                {{--                        List</a>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <label for="registration_no" class="form-label d-flex justify-content-between">
                            <span>User Personal Number</span>
                        </label>
                        <input type="number" class="personal_number form-control"
                               name="personal_number" id="personal_number" autocomplete="off"
                               placeholder="100010101">
                    </div>

                    <div class="col-md-6 col-12">
                        <button type="submit" class="btn btn-primary searchStudent" style="margin-top: 31px">Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card text-dark shadow-2 mb-3 user-main-card" style="max-width: 18rem; display: none">
        <div class="card-body">
            <div class="container mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt=""
                                     src=""
                                     id="user_Image">
                            </div>
                            <div class="info">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th>Name</th>
                                        <td class="name"></td>
                                        <th>Email</th>
                                        <td class="email"></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td class="phone"></td>
                                        <th>DOB</th>
                                        <td class="dob"></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td class="address"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <figure class="" style="margin-bottom: 0">
                                                <blockquote class="blockquote" style="margin-bottom: 0">
                                                    <p>Academic Info</p>
                                                </blockquote>
                                            </figure>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Joining Date</th>
                                        <td class="joining_date"></td>
                                        <th>Qualification</th>
                                        <td class="qualification"></td>
                                    </tr>
                                    <tr>
                                        <th>Session</th>
                                        <td class="session"></td>
                                        <th>Designation</th>
                                        <td class="designation"></td>
                                    </tr>
                                    <tr>
                                        <th>Salary</th>
                                        <td class="salary"></td>
                                    </tr>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.personal_number').focus();
        });

        // GET STUDENT FOR ATTENDANCE
        $(document).ready(function () {
            $("#form-data").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: api_url + "user-attendances/attendance-using-qr",
                    type: "GET",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (response) {
                        $('.user-main-card').show();
                        var user = response.data;
                        $('#user_Image').attr('src', user.user_picture_url);
                        $('.dob').html(user.dob_formatted);
                        $('.address').html(user.address);
                        $('.email').html(user.email);
                        $('.phone').html(user.phone);
                        $('.name').html(`<a href="{{env('BASE_URL')}}users/${user.user_session.id}/detail" target="_blank">${user.first_name ?? '' + ' ' + user.last_name ?? ''}</a>`);
                        $('.joining_date').html(user.user_session.joining_date);
                        $('.qualification').html(user.user_session.qualification);
                        $('.session').html(user.user_session.session);
                        $('.designation').html(user.user_session.designation);
                        $('.salary').html(user.user_session.salary);
                        if (response.status == true) {
                            success_notify(response.message);
                        } else {
                            error_notify(response.message);
                        }
                    }
                });
            });
        });



    </script>
@endsection

