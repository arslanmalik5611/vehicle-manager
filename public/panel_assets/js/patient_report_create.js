
$(document).ready(function () {
    var reportRemarksOptions = ``;
    $.ajax({
        url: api_url + 'report-remarks',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (reportRemarks, id) {
                reportRemarksOptions += `<option value="${reportRemarks.id}" data-notes="${reportRemarks.notes}">${reportRemarks.name}</option>`;
            });
            test_detail_load();
        }
    });

    function test_detail_load() {
        $.ajax({
            url: api_url + 'patient/patients-without-report-test-data',
            dataType: "JSON",
            type: "POST",
            data: {
                'mrs': mrs,
            },
            success: function (response) {
                if (!response.status) {
                    //unblock_page();
                    $('.submit-btn').hide();
                    $('#error-message').html(response.message);
                    Lobibox.notify('error', {
                        size: 'mini',
                        sound: false,
                        delay: 5000,
                        msg: response.message
                    });
                    return false;
                }
                var report_area = '';
                var patients_label = '';
                $.each(response.patients_label, function (key, valueObj) {
                    patients_label += `<span class='px-1'><button type="button" class="btn btn-primary text-white btn-sm position-relative">
                                                ${valueObj.first_name + ' ' + valueObj.last_name} <span class="badge position-absolute top-0 start-50 translate-middle bg-success">${key}</span>
                                            </button></span>`;
                });
                $('#patients-label').html(patients_label);

                $.each(response.data, function (key, valueObj) {
                    report_area += `<div class="col-md-10 test-area" data-test-id="${valueObj.test_data.id}" data-patients-mr="${valueObj.patients}">
                        <table class="table table-bordered">
                            <tr class="colored-bg">
                                <th colspan="3">${valueObj.test_data.name}</th>
                            </tr>
                            <tr class="colored-bg-2">
                                <th class="w-25">Mr(s)</th>
                                <th class="w-75" colspan="2">${valueObj.patients}</th>
                            </tr>
                            <tr>
                                <th class="w-25">Title</th>
                                <th class="w-25">Unit</th>
                                <th class="w-50">Result</th>
                            </tr>`;


                    $.each(valueObj.test_data.details, function (i, k) {
                        default_result = k.default_result;
                        if (k.input_type == 'select') {
                            var _input = `<select class="form-control test_datail_input" data-test-detail-id="${k.id}">`;
                            options = JSON.parse(k.input_options);
                            for (var keys in options) {
                                var selected = '';
                                if (options[keys] == default_result) {
                                    selected = `selected='selected'`;
                                }
                                _input += `<option value="${options[keys]}" ${selected}>${options[keys]}</option>`;
                            }
                            _input += `</select>`;
                        } else if (k.input_type == 'input') {
                            var _input = `<input type="text" class="form-control test_datail_input" data-test-detail-id="${k.id}" value="${default_result}">`;
                        }

                        report_area += `<tr>
                                <td>
                                    ${k.name}
                                </td>
                                <td>
                                    ${k.unit.name}
                                </td>
                                <td>
                                    ${_input}
                                </td>
                            </tr>`;
                    });


                    report_area += `<tr class="colored-bg-3">
                                <td>Remarks</td>
                                <td colspan="2">
                                    <select class="form-control report-remarks" data-test-id="${valueObj.test_data.id}">
                                        <option value="0" data-notes="">Choose any remarks</option>
                                        ${reportRemarksOptions}
                                    </select>
                                    <br/>
                                    <textarea id="report-remarks-textarea${valueObj.test_data.id}" class="tinymce-custom form-control report-remarks-textarea"></textarea>
                                </td>
                            </tr>`;
                    report_area += `</table>
                    </div>`;
                });


                $('#report-create-area').html(report_area);
                initialize_tinymce();
                //unblock_page();
            }
        });
    }

    function initialize_tinymce() {
        tinymce.init({
            selector: '.tinymce-custom',
            plugins: 'code textcolor textcolor colorpicker emoticons preview',
            toolbar: 'code textcolor forecolor backcolor emoticons preview fontsizeselect ',
            cleanup: true,
            height: '100',
        });
    }

    $(document).on('change', '.report-remarks', function () {
        tinyMCE.get('report-remarks-textarea' + $(this).attr('data-test-id')).setContent($(this).find('option:selected').attr('data-notes'));
    });

    $("#form-data").on('submit', function (e) {
        e.preventDefault();
        var data = {
            'tests': []
        };
        tinyMCE.triggerSave();
        $('.test-area').each(function () {
            var testObj = {
                'test_id': $(this).attr('data-test-id'),
                'patients': $(this).attr('data-patients-mr'),
                'report_remarks_id': $(this).find('.report-remarks').val(),
                'report_remarks_value': $(this).find('.report-remarks-textarea').val(),
                'details': []
            };
            test_datail_input = $(this).find('.test_datail_input');
            $(test_datail_input).each(function (iind, ielem) {
                var detailObj = {
                    'test_detail_id': $(ielem).attr('data-test-detail-id'),
                    'result': $(ielem).val()
                };
                testObj.details.push(detailObj);
            });
            data.tests.push(testObj);
        });
        $('.submit-btn').attr('disabled', true);
        $('.go-icon').hide();
        $('.spinner-icon').show();
        e.preventDefault();
        $.ajax({
            url: api_url + "patient/create-report",
            type: "POST",
            data: JSON.stringify(data),
            dataType: "JSON",
            contentType: "application/json",
            success: function (data) {
                if (data.status) {
                    $('.go-icon').show();
                    $('.spinner-icon').hide();
                    Lobibox.notify('success', {
                        size: 'mini',
                        sound: false,
                        msg: data.message
                    });
                    setTimeout(function () {
                        window.location = base_url + 'patients/pending-report-email';
                    }, 1500);
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
