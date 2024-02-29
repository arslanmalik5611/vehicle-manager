$(document).ready(function () {
    document_type_load();
    document_status_load();
    document_data_load();
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

function document_data_load() {
    $.ajax({
        url: api_url + 'documents/'+doc_id,
        dataType: "JSON",
        success: function (response) {
            $('#title').val(response.data.title);
            $('#owner').val(response.data.owner);
            $('#author').val(response.data.author);
            $('#revision').val(response.data.revision);
            $('#document_type_id').val(response.data.document_type_id);
            $('#document_status_id').val(response.data.document_status_id);
            $('#active_at').val(reformatDatePickerDate(response.data.active_at));
            $('#next_review_at').val(reformatDatePickerDate(response.data.next_review_at));
            if (response.data.description)
                tinyMCE.get('description').setContent(response.data.description);
            if (response.data.admin_notes)
                tinyMCE.get('admin_notes').setContent(response.data.admin_notes);

            if (response.data.attachments) {
                var filesRow = ``;
                $(response.data.attachments).each(function (ind, elem) {
                    filesRow += `<tr>
                                        <td><a href="${elem.attachment_url}" download>${elem.file_name}</a></td>
                                        <td>
                                            <span class="fa fa-times-circle text-danger remove-file" data-document-id="${response.data.id}" data-id="${elem.id}"></span>
                                        </td>
                                      </tr>`;
                });
                $('#files-table').append(filesRow);
            }
        }
    });
}

$("#form-data").on('submit', function (e) {
    $('.submit-btn').attr('disabled', true);
    $('.go-icon').hide();
    $('.spinner-icon').show();
    e.preventDefault();
    tinyMCE.triggerSave();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: api_url + "documents/update",
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

$(document).on('click', '.remove-file', function () {
    var id = $(this).attr('data-id');
    var document_id = $(this).attr('data-document-id');
    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: api_url + "documents/delete-attachment",
                data: {"id": id, "document_id": document_id},
                dataType: "JSON",
                success: function (returnData) {
                    if (returnData.status) {

                        $("[data-id=" + id + "]").parents('tr').remove();
                        Swal.fire(
                            "Deleted!",
                            "Your record has been deleted.",
                            'success'
                        )
                    } else {
                        Swal.fire(
                            "Problem!",
                            returnData.message,
                            'danger'
                        )
                    }

                },
                error: function (returnData) {
                    Swal.fire(
                        "Problem!",
                        returnData.message,
                        'danger'
                    )
                },

            });

        }
    });
});
