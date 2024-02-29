$(document).on('click', '#check-all', function () {
    $('.menu').prop('checked', $(this).is(':checked'));
});

$(document).on('change', '#employee_id', function () {
    if ($(this).val() != '' && $(this).val() != undefined) {
        user_menus_list($(this).val());
        $('#menu-wrapper').show();
    } else {
        $('#menu-wrapper').hide();
    }

});

$(document).ready(function () {
    user_load();
    employees_optional_load();

    $("#form-data").on('submit', function (e) {
        if ($('#employee_id').val() == '' || $('#employee_id').val() == undefined) {
            Lobibox.notify('error', {
                size: 'mini',
                sound: false,
                msg: 'Please choose user from dropdown'
            });
            return false;
        }
        $('.submit-btn').attr('disabled', true);
        $('.go-icon').hide();
        $('.spinner-icon').show();
        e.preventDefault();
        $.ajax({
            url: api_url + "user/menus-update",
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
});

function getFormData() {
    var data = {
        'user_id': $('#employee_id').val(),
        'menus': []
    };
    $('.menu:checked').each(function (j, k) {
        data.menus.push($(k).attr('menu-key'));
    });
    return data;
}

function user_menus_list(user_id) {
    /*************************************
     * &USER MENUS LIST& *
     * ***********************************/
    $.ajax({
        url: api_url + 'user/' + user_id + '/menus-list',
        dataType: "JSON",
        type: 'POST',
        success: function (response) {
            $(response.data).each(function (j, k) {
                $(`[menu-key='${k}']`).attr('checked', true);
            });
        }
    });
}

function user_load() {
    $.ajax({
        url: api_url + 'user/' + user_id,
        dataType: "JSON",
        success: function (response) {
            $('#user').html(response.data.first_name + ' ' + response.data.last_name + ' (' + response.data.email + ')');
        }
    });
}
