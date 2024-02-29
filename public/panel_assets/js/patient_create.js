$(document).ready(function () {
    references_load();
    collection_centers_load();
    live_date_time('live_date_time');
    is_collection_center();
    /*************************************
     * &QUICK TESTS LIST& *
     * ***********************************/
    var quickTestOptions = '';
    $.ajax({
        url: api_url + 'quick-tests',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (test, id) {
                quickTestOptions += `<button type="button" class="btn btn-outline-success quick-test mt-1 mb-1" test-id="${test.id}" test-name="${test.name}" turn-around-time="${test.turn_around_time}" sample-type="${test.sample_type.name}" amount="${test.amount}"> <i class="fa fa-plus"></i> ${test.name}</button> `;
            });
            $('.quick-tests-div').html(quickTestOptions);
        }
    });
    /*************************************
     * &TESTS LIST& *
     * ***********************************/
    $(".test_id").select2({
        ajax: {
            url: api_url + "search",
            dataType: 'json',
            type: "POST",
            delay: 250,
            data: function (params) {
                return {
                    name: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                    results: data.data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        placeholder: 'Search for a test',
        minimumInputLength: 1,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo(repo) {
        if (repo.loading) {
            return repo.text;
        }
        var $container = $(
            "<div class='select2-result-repository clearfix'>" +
            `<div class='select2-result-repository__avatar'><img src='${base_url}/public/panel_assets/images/test_placeholder.png' /></div>` +
            "<div class='select2-result-repository__title'></div>" +
            "<div class='select2-result-repository__description'></div>" +
            "<div class='select2-result-repository__statistics'>" +
            "<div class='select2-result-repository__phoneno'><i class='fa fa-history'></i> </div>" +
            "<div class='select2-result-repository__contacts'><i class='fa fa-tags'></i> </div>" +
            "<div class='select2-result-repository__projects'><i class='fa fa-money'></i> </div>" +
            "</div>" +
            "</div>" +
            "</div>"
        );

        $container.find(".select2-result-repository__title").text(repo.name);
        $container.find(".select2-result-repository__description").text(repo.sample_type.name);
        $container.find(".select2-result-repository__phoneno").append(repo.turn_around_time);
        $container.find(".select2-result-repository__contacts").append('Test Code: ' + repo.code);
        $container.find(".select2-result-repository__projects").append(repo.amount + ' £');

        return $container;
    }

    function formatRepoSelection(repo) {
        return repo.name || repo.text;
    }

    $(".test_id").on('select2:select', function (selection) {
        repo = selection.params.data;
        var test_data = {
            id: repo.id,
            name: repo.name,
            sample_type: repo.sample_type.name,
            turn_around_time: repo.turn_around_time,
            amount: repo.amount
        };
        create_test_row(test_data);
        calculate();
    });
});

$(document).on('click', '.quick-test', function () {
    $(this).removeClass('btn-outline-success');
    $(this).addClass('btn-outline-info');
    var test_data = {
        id: $(this).attr('test-id'),
        name: $(this).attr('test-name'),
        sample_type: $(this).attr('turn-around-time'),
        turn_around_time: $(this).attr('sample-type'),
        amount: $(this).attr('amount')
    };
    create_test_row(test_data);
    calculate();
});

$(document).on('click', '.remove-test', function () {
    $(this).parents('tr').remove();
    calculate();
});

$(document).on('keyup', '#paid-amount', function () {
    calculate();
});

function create_test_row(test) {
    var newRow = `<tr>
                                    <td>${test.name}</td>
                                    <td>${test.name}</td>
                                    <td>${test.turn_around_time}</td>
                                    <td class="selected-test-amount">${test.amount}</td>
                                    <td>
                                        <input type="hidden" class="selected_test_id" value="${test.id}">
                                           <span class='btn btn-danger remove-test'><i class='fa fa-times-circle'></i></span>
                                    </td>
                               </tr>`;
    $('#tests').append(newRow);
}

function calculate() {
    var net_amount = 0;
    var paid_amount = 0;
    if ($('#paid-amount').val() > 0) {
        paid_amount = $('#paid-amount').val();
    }
    $('.selected-test-amount').each(function (index, element) {
        net_amount += parseFloat($(element).text());
    });
    $('#net-amount').text(net_amount + ' £');
    $('#due-amount').text(net_amount - paid_amount + ' £');
}

function live_date_time(id) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    h = date.getHours();
    if (h < 10) {
        h = "0" + h;
    }
    m = date.getMinutes();
    if (m < 10) {
        m = "0" + m;
    }
    s = date.getSeconds();
    if (s < 10) {
        s = "0" + s;
    }
    result = '' + days[day] + ' ' + months[month] + ' ' + d + ' ' + year + '<br> ' + h + ':' + m + ':' + s;
    document.getElementById(id).innerHTML = result;
    setTimeout('live_date_time("' + id + '");', '1000');
    return true;
}

$(document).ready(function () {
    $("#form-data").on('submit', function (e) {
        if ($('.selected_test_id').length < 1) {
            Lobibox.notify('error', {
                size: 'mini',
                sound: false,
                msg: 'Please select atleast one test'
            });
            return false;
        }
        // block_page();
        $('.submit-btn').attr('disabled', true);
        $('.go-icon').hide();
        $('.spinner-icon').show();
        e.preventDefault();
        $.ajax({
            url: api_url + "patient/create",
            type: "POST",
            data: JSON.stringify(getFormData()),
            dataType: "JSON",
            contentType: "application/json",
            success: function (data) {
                //unblock_page();
                if (data.status) {
                    window.open(`${web_url}invoice-print/${data.patient_mr}`, '_blank').focus();
                    $('.go-icon').show();
                    $('.spinner-icon').hide();
                    Lobibox.notify('success', {
                        size: 'mini',
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

function getFormData() {
    var data = {
        title: $('#title').val(),
        first_name: $('#first_name').val(),
        last_name: $('#last_name').val(),
        dob: $('#dob').val(),
        gender: $('#gender').val(),
        phone_no: $('#phone_no').val(),
        email: $('#email').val(),
        address: $('#address').val(),
        postal_code: $('#postal_code').val(),
        passport_number: $('#passport_number').val(),
        date_arrived: $('#date_arrived').val(),
        date_left: $('#date_left').val(),
        nhs_number: $('#nhs_number').val(),
        ethnicity: $('#ethnicity').val(),
        vaccination_status: $('#vaccination_status').val(),
        phe_report_date: $('#phe_report_date').val(),
        received_at: $('#received_at').val(),
        collection_datetime: $('#collection_datetime').val(),
        collection_center_id: $('#collection_center_id').val(),
        reference_id: $('#reference_id').val(),
        paid_amount: $('#paid-amount').val(),
        tests: []
    };
    $('.selected_test_id').each(function () {
        data.tests.push({test_id: $(this).val()});
    });

    return data;
}
