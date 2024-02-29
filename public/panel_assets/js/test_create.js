$(document).ready(function () {
    sample_types_load();
    test_categories_load();

    $(document).on('click', '.input-type', function () {
        $(this).siblings('.input-type').attr('checked', false);
        if ($(this).val() == 'input') {
            $(this).parents('tr').find('.input-options').attr('disabled', true);
        } else {
            $(this).parents('tr').find('.input-options').attr('disabled', false);
        }
    });

    $(document).on('click', '.remove-detail', function () {
        $(this).parents('tr').remove();
    });

    $(document).on('click', '.add-detail', function () {
        var details_length = $('#test-detail-table tr').length;
        var newRow = `<tr>
                                <td>
                                    <span class="fa fa-times-circle fa-2x text-danger remove-detail"
                                          title="Remove this detail"></span>
                                </td>
                                <td>
                                    <input type="text" class="form-control detail-name" placeholder="RT-qPCR etc.">
                                </td>
                                <td>
                                    <input type="radio" value="input"  class="input-type" checked>
                                    Input <br/>
                                    <input type="radio" value="select"  class="input-type"> Select
                                </td>
                                <td>
                                    <input type="text" class="form-control input-options"
                                           placeholder="Optional w.r.t Input Type" disabled>
                                    <span> <i class="fa fa-info-circle text-info"></i> <small>Comma separated values for dropdown e.g. Positive,Negative,Uncleared</small></span>
                                </td>
                                <td>
                                    <input type="text" class="form-control default-results" placeholder="e.g. Negative">
                                </td>
                                <td>
                                    <input type="number" class="form-control order" placeholder="e.g. 1,2,3,4...."
                                           value="${details_length}">
                                </td>
                                <td>
                                    <span class="fa fa-plus-circle fa-2x text-success add-detail"
                                          title="add new detail"></span>
                                </td>
                            </tr>`;
        $('#test-detail-table').append(newRow);
    });


    function show_error_message(message) {
        Lobibox.notify('error', {
            size: 'mini',
            sound: false,
            msg: message
        });
    }

    $("#form-data").on('submit', function (e) {
        if ($('#name').val() == '') {
            show_error_message('Please enter correct test name');
            return false;
        } else if ($('#amount').val() == '') {
            show_error_message('Please enter correct test amount');
            return false;
        } else if ($('.detail-name').length < 1) {
            show_error_message('Please enter atleast one detail');
            return false;
        }

        $('.submit-btn').attr('disabled', true);
        $('.go-icon').hide();
        $('.spinner-icon').show();
        e.preventDefault();
        $.ajax({
            url: api_url + "test/create",
            type: "POST",
            data: JSON.stringify(getFormData()),
            dataType: "JSON",
            contentType: "application/json",
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

    function getFormData() {
        var data = {
            'name': $('#name').val(),
            'short_name': $('#short_name').val(),
            'turn_around_time': $('#turn_around_time').val(),
            'note': $('#note').val(),
            'background': $('#background').val(),
            'clinical_indicators': $('#clinical_indicators').val(),
            'special_handling': $('#special_handling').val(),
            'patient_preparation': $('#patient_preparation').val(),
            'amount': $('#amount').val(),
            'sample_type_id': $('#sample_type_id').val(),
            'test_category_id': $('#test_category_id').val(),
            'report_template': $('#report_template').val(),
            'booking_list': '',
            'quick_test': '',
            'test_details': []
        };
        if ($('#booking_list').is(':checked')) {
            data.booking_list = 1;
        } else {
            data.booking_list = 0;
        }
        if ($('#quick_test').is(':checked')) {
            data.quick_test = 1;
        } else {
            data.quick_test = 0;
        }
        $('#test-detail-table tr').each(function () {
            if ($(this).find('.detail-name').val() != '' && $(this).find('.detail-name').val() != undefined) {
                var detail = {
                    'name': $(this).find('.detail-name').val(),
                    'input_type': $(this).find('.input-type:checked').val(),
                    'input_options': $(this).find('.input-options').val(),
                    'default_result': $(this).find('.default-results').val(),
                    'order': $(this).find('.order').val(),
                    'unit_id': '1'
                };
                data.test_details.push(detail);
            }
        });

        return data;
    }
});
