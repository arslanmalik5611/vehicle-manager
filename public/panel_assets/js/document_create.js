var testing = '';
$(document).ready(function () {
    document_type_load();
    document_status_load();
});

$(document).on('change', '.file-input', function () {
    add_more_files();
});

$(document).on('click', '.remove-file-input', function () {
    $(this).parents('.file-input-div').remove();
});

$(document).on('click', '.add-more-files', function () {
    add_more_files();
});

function add_more_files() {
    fileInput = `<div class="col-md-4 file-input-div">
                        <label for="file" class="form-label"> Choose file (s) </label>
                        <input type="file" class="form-control file-input" name="attachments[]">
                        <button class="btn btn-danger remove-file-input"><i class="fa fa-times-circle"></i></button>
                    </div>`;
    $('#file-inputs-wrapper').append(fileInput);
}

$("#form-data").on('submit', function (e) {
    $('.submit-btn').attr('disabled', true);
    $('.go-icon').hide();
    $('.spinner-icon').show();
    e.preventDefault();
    tinyMCE.triggerSave();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: api_url + "documents/create",
        type: "POST",
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
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
