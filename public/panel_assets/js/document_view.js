var document_id = '';
$(document).ready(function () {
    document_view_data_load();
});

function document_view_data_load() {
    $.ajax({
        url: api_url + 'documents/' + doc_number + '/view',
        type: 'POST',
        dataType: "JSON",
        success: function (response) {
            if (response.status) {
                document_id = response.data.id;
                $('.document-title').html(response.data.title);
                $('.document-description').html(response.data.description);
                $('.document-author').html(response.data.author);
                $('.document-owner').html(response.data.owner);
                $('.document-revision').html(response.data.revision);
                $('.document-active-date').html(response.data.active_at_formatted);
                $('.document-type').html(response.data.document_type.name);

                if (response.data.attachments != '') {
                    var attachments_list = ``;
                    $(response.data.attachments).each(function (ind, elem) {
                        attachments_list += `<li class="list-group-item"><a href="${elem.attachment_url}" target="_blank" download>${elem.attachment_label} ${elem.file_name}</a></li>`;
                    });
                    $('.attachments-list').html(attachments_list);
                } else {
                    $('.attachments-list').html(`<span class="no-attachment"><i class="fa fa-times-circle text-danger"></i> No attachment available</span>`);
                }

                if (response.data.comments) {
                    var comments = ``;
                    $(response.data.comments).each(function (key, val) {
                        comments += `<div class="d-flex flex-row comment-row">
                                            <div class="p-2">
                                                <span class="round">
                                                   <div class="profileImage">${val.actor.name.charAt(0)}</div>
                                                </span>
                                            </div>
                                            <div class="comment-text w-100">
                                                <h5>${val.actor.name}</h5>
                                                <div class="comment-footer">
                                                    <span class="date">${val.created_at_formatted}</span>
                                                </div>
                                                <p class="m-b-5 m-t-10">${val.comment}</p>
                                            </div>
                                        </div>`;
                    });

                    $('#comments-section').html(comments);
                } else {
                    $('.comments-section').html('No comments available');
                }

                if (response.data.has_acknowledged) {
                    $('.acknowledged-btn').show();
                } else {
                    $('.acknowledge-btn').show();
                }

                $('.page-card-body').show();
            } else {
                Lobibox.notify('error', {
                    size: 'mini',
                    sound: false,
                    msg: response.message
                });
            }
        }
    });
}

$(document).on('click', '.comment-btn', function () {
    $('.comment-input').removeClass('error');
    if (!$('.comment-input').val()) {
        $('.comment-input').addClass('error');
        return false;
    }
    $.ajax({
        url: api_url + 'documents/comment-add',
        type: 'POST',
        data: {'id': document_id, 'comment': $('.comment-input').val()},
        dataType: "JSON",
        success: function (response) {
            if (response.status) {
                Lobibox.notify('success', {
                    size: 'mini',
                    sound: false,
                    msg: response.message
                });
                var comments = `<div class="d-flex flex-row comment-row">
                                            <div class="p-2">
                                                <span class="round">
                                                   <div class="profileImage">${response.user.charAt(0)}</div>
                                                </span>
                                            </div>
                                            <div class="comment-text w-100">
                                                <h5>${response.user}</h5>
                                                <div class="comment-footer">
                                                    <span class="date">Just now</span>
                                                </div>
                                                <p class="m-b-5 m-t-10">${$('.comment-input').val()}</p>
                                            </div>
                                        </div>`;
                $('#comments-section').prepend(comments);
                $('.comment-input').val('');
            } else {
                Lobibox.notify('error', {
                    size: 'mini',
                    sound: false,
                    msg: response.message
                });
            }

        }
    });
});

$(document).on('click', '.acknowledge-btn', function () {
    $.ajax({
        url: api_url + 'documents/acknowledge-add',
        type: 'POST',
        data: {'id': document_id},
        dataType: "JSON",
        success: function (response) {
            if (response.status) {
                Lobibox.notify('success', {
                    size: 'mini',
                    sound: false,
                    msg: response.message
                });
                $('.acknowledge-btn').hide();
                $('.acknowledged-btn').show();
            }
        }
    });
});
