var selected_item = {};
$(document).ready(function () {
    initialize_notes();
    initialize_item_select2();
});

function initialize_item_select2() {
    /*************************************
     * &ITEMS LIST& *
     * ***********************************/
    $(".item_id").select2({
        ajax: {
            url: api_url + "item/search",
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
        placeholder: 'Search for an item',
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
            "<div class='select2-result-repository__phoneno'><i class='fa fa-box'></i> </div>" +
            "<div class='select2-result-repository__contacts'><i class='fas fa-tag'></i> </div>" +
            "<div class='select2-result-repository__projects'><i class='fas fa-dollar-sign'></i> </div>" +
            "</div>" +
            "</div>" +
            "</div>"
        );

        $container.find(".select2-result-repository__title").text(repo.name);
        $container.find(".select2-result-repository__description").text(repo.item_type.name);
        $container.find(".select2-result-repository__phoneno").append(repo.item_unit.name);
        $container.find(".select2-result-repository__contacts").append('Pieces in Pack: ' + repo.pieces);
        $container.find(".select2-result-repository__projects").append(repo.price + ' £');

        return $container;
    }

    function formatRepoSelection(repo) {
        return repo.name || repo.text;
    }

    $(".item_id").on('select2:select', function (selection) {
        selected_item = selection.params.data;

        $('#qty').focus();
    });
}

$(document).on('click', '#add-to-table-btn', function () {
    add_to_table();
});

function add_to_table() {
    qty = $('#qty').val();
    if (qty == '' || selected_item == '' || $.isEmptyObject(selected_item)) {
        Lobibox.notify('error', {
            size: 'mini',
            sound: false,
            msg: 'Some data is missing. Fill it correctly please'
        });
        return false;
    }
    var item_data = {
        'item': selected_item,
        'quantity': qty,
    };
    create_item_row(item_data);
    $('#qty').val('');
}

function create_item_row(item_data) {
    var newRow = `<tr class="item-row">
                                <td class="item" item-id=${item_data.item.id}>${item_data.item.name + ' / ' + item_data.item.item_type.name + ' / ' + item_data.item.item_unit.name}</td>
                                <td class="quantity">${item_data.quantity}</td>
                                <td>
                                    <span class="fa fa-times-circle fa-2x text-danger remove-btn"></span>
                                </td>
                            </tr>`;
    $('#items-table').append(newRow);
}

$(document).on('click', '.remove-btn', function () {
    $(this).parents('tr').remove();
});

function initialize_notes() {
    /*INITIALIZE TINYMCE*/
    tinymce.init({
        selector: '#notes',
        plugins: 'code fullpage textcolor textcolor colorpicker emoticons preview',
        toolbar: 'code fullpage textcolor forecolor backcolor emoticons preview fontsizeselect ',
        cleanup: false,
        height: '100',
    });
}


$('#qty').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        event.preventDefault();
        add_to_table();
    }
});

$("#form-data").on('submit', function (e) {
    if ($('#qty').val() != '') {
        Lobibox.notify('error', {
            size: 'mini',
            sound: false,
            msg: 'It seems you are forgetting something to add in table.'
        });
        $('#amount').val('').focus();
        return false;
    }
    tinyMCE.triggerSave();
    if ($('.item-row').length < 1) {
        Lobibox.notify('error', {
            size: 'mini',
            sound: false,
            msg: 'Please enter atleast one item'
        });
        return false;
    }
    $('.submit-btn').attr('disabled', true);
    $('.go-icon').hide();
    $('.spinner-icon').show();
    e.preventDefault();
    $.ajax({
        url: api_url + "consumption/create",
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
        'date': $('#date').val(),
        'type': $('#type').val(),
        'notes': $('#notes').val(),
        'items': []
    };
    $('.item-row').each(function () {
        var item_row = {
            'item_id': $(this).find('.item').attr('item-id'),
            'quantity': $(this).find('.quantity').text(),
        };

        data.items.push(item_row);
    });

    return data;
}
