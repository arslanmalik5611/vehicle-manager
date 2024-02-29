@extends('layout.master')
@section('page_title','Send Email')

<style>
    table {
        width: 100% !important;
    }

    .fixed-hight {
        height: 400px;
        overflow: auto;
    }
</style>
@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i>Send Email </h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-7">
                <form method="post" id="role-form-data">
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-6 col-12">
                            <label for="role_id" class="form-label">User</label>
                            <select name="role_id" id="role_id" class="role_id select2">
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 col-sm-6 fixed-hight">
                            <table class="user_data table table-bordered table-responsive table-condensed">
                                <thead>
                                    <tr class="colored-bg">
                                        <th>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody class="user_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <form method="post" id="template-form-data">
                    <div class="row mb-3">
                        <div class="col-md-12 ">
                            <label for="email_template_id" class="form-label">Email Template</label>
                            <select name="email_template_id" id="email_template_id" class="email_template_id select2">
                            </select>
                        </div>
                        <div class="col-md-12 ">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" id="subject" class="subject form-control" placeholder="Enter Mail Subject">
                        </div>
                        <div class="col-md-12">
                            <label for="body" class="form-label"> Body </label>
                            <textarea class="form-control tinymce-custom" id="body" name="body"></textarea>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12" style="margin-top: 33px">
                            <button class="btn btn-success btn-sm submit-btn">Send <i class="fas fa-chevron-right ms-3 go-icon"></i></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection
@section('page_level_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        nav_bar_hide();
        optional_role_load();
        email_template_load();
    });

    $(".role_id").on('change', function() {
        var id = $(this).val();
        if (id) {
            $.ajax({
                url: api_url + `users/${id}/get-user`,
                type: "Get",
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        $('.voucherCard').show();
                        var userTr = '';
                        data = data.data;
                        data.forEach(function(data, i) {
                            userTr += `<tr>
                                     <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input user_id" type="checkbox" id="user_id" 
                                            value="${data.id}">
                                        </div>
                                    </td>
                                    <td>${data.first_name}</p></td>
                                    <td>${data.phone}</p></td>
                                    <td>${data.email}</p></td>
                                </tr>`;
                        });
                        $(".user_body").html(userTr);
                    }
                }
            })
        } else {
            error_notify("Please Select User");
        }
    });

    $(".email_template_id").on('change', function() {
        var id = $(this).val();
        tinymce_initialize(200, ".tinymce-custom");
        $.ajax({
            url: api_url + `email-template/${id}/show`,
            type: "Get",
            dataType: "JSON",
            success: function(data) {
                if (data.data.body)
                    tinyMCE.get('body').setContent(data.data.body);
            }
        })
    });

    $(".submit-btn").on('click', function(e) {
        e.preventDefault();
        var user_ids = [];
        $('.user_id').each(function() {
            if ($(this).is(":checked")) {
                $(this).val();
                user_ids.push($(this).val());
            }
        });
        $.ajax({
            url: api_url + `email-notification/send`,
            type: "POST",
            data: {
                role_id: $("#role_id").val(),
                subject: $("#subject").val(),
                user_ids: user_ids,
                body: tinyMCE.get('body').getContent()
            },
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    success_notify(data.message);
                } else {
                    error_notify(data.message);
                }
            }
        })
    });

    $(document).on('click', "#checkAll", function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>

@endsection