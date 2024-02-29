$(document).ready(function () {
    $('#nav-bar').addClass('show');
    $('#main-pd').addClass('main-pd');
    document_timeline_load();
    acknowledged_users_datatable();
    unacknowledged_users_datatable();
    document_timeline_activities_load();
    setTimeout(function () {
        $('#document-timeline-wrapper').css({"display": "flex"});
    }, 1000);

});


function document_timeline_activities_load() {
    $.ajax({
        type: "POST",
        url: api_url + "documents/activities",
        data: {"number": number,},
        dataType: "JSON",
        success: function (response) {
            var activity = ``;
            if (response.status) {
                $(response.data.activities).each(function (index, act) {
                    var message = comment_text = '';
                    if (act.type == 'acknowledge') {
                        message = act.actor.name + ' has acknowledged the document';
                    } else if (act.type == 'comment') {
                        message = act.actor.name + ' has commented on the document';
                        comment_text = `<p class="m-b-5 m-t-10"><i class="far fa-comment-dots text-primary"></i> ${act.comment ?? ''}</p>`;
                    }
                    activity += `<div class="d-flex flex-row comment-row">
                                    <div class="p-2">
                                                <span class="round">
                                                   <div class="profileImage">${act.actor.name.charAt(0)}</div>
                                                </span>
                                    </div>
                                    <div class="comment-text w-100">
                                        <h5>${act.actor.name}</h5>
                                        <div class="comment-footer">
                                            <span class="activity-datetime"><i class="fas fa-clock text-info"></i> ${act.created_at_datetime_formatted}</span>
                                        </div>
                                         <div class="activity-message">${message}</div>
                                            ${comment_text}
                                    </div>
                                </div>`;
                });
            }
            $('#recent_activity').html(activity);
        }
    });
}

function document_timeline_load() {
    $.ajax({
        type: "POST",
        url: api_url + "documents/timeline",
        data: {"number": number,},
        dataType: "JSON",
        success: function (response) {
            var timeline = ``;
            if (response.status) {
                var document_title = `<a href="${base_url + 'documents/' + response.data.number + '/view'}">${response.data.title}</a>`;
                $('.document-title').html(document_title);
                $(response.data.timeline_history_formatted).each(function (ind, data) {
                    if (data.action == 'create') {
                        timeline += documentCreate(data);
                    } else if (data.action == 'approve') {
                        timeline += documentApprove(data);
                    } else if (data.action == 'update') {
                        timeline += documentUpdate(data);
                    } else if (data.action == 'new_attachment') {
                        timeline += documentNewAttachment(data);
                    } else if (data.action == 'delete_attachment') {
                        timeline += documentDeleteAttachment(data);
                    }
                });
            } else {
                timeline = noRecordFound();
            }
            $('#timeline-table').append(timeline);
        }
    });
}

function documentCreate(data) {
    return `<tr class="patient-create">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-info">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>${data.message}</td>
                    </tr>`;
}

function documentApprove(data) {
    return `<tr class="patient-create">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-success">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>${data.message}</td>
                    </tr>`;
}

function documentUpdate(data) {
    var returndata = `<tr class="patient-edit">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-info">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>
                            <b>Following Information Updated:</b>
                            <br/>
                            <table class='table table-bordered'>
                                <tr>
                                    <th>Title</th>
                                    <th>Old Value</th>
                                    <th>Updated Value </th>
                                </tr>`;
    $.each(data.data, function (key, valueObj) {
        returndata += `<tr>
                                    <td class="col-name">${key.split('_').join(' ')}</td>
                                    <td>${valueObj.old_value}</td>
                                    <td>${valueObj.new_value}</td>
                                </tr>`;
    });

    returndata += `</table></td>
                    </tr>`;
    return returndata;
}

function documentNewAttachment(data) {
    return `<tr class="patient-create">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-primary">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>${data.message} <br/> ${data.attachment}</td>
                    </tr>`;
}

function documentDeleteAttachment(data) {
    return `<tr class="patient-create">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-danger">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>${data.message} <br/> ${data.attachment}</td>
                    </tr>`;
}

function noRecordFound() {
    return `<tr class="no-record-found">
                        <td colspan="4">No data found for this document</td>
                    </tr>`;
}

function acknowledged_users_datatable() {
    var count = 0;
    var cols = [
        {
            title: "SN",
            render: function (data, type) {
                return ++count;
            }
        },
        {
            title: "User",
            data: 'name'
        },
        {
            title: "Email",
            data: 'email'
        }
    ];
    $.ajax({
        url: api_url + 'documents/acknowledged-users',
        type: 'POST',
        data: {'number': number},
        dataType: "JSON",
        success: function (dataSet) {
            $('#acknowledged-users-table').DataTable({
                destroy: true,
                "dom": '<f<t>ip>',
                data: dataSet.data,
                columns: cols,
            });
        }
    });
}

function unacknowledged_users_datatable() {
    var count = 0;
    var cols = [
        {
            title: "SN",
            render: function (data, type) {
                return ++count;
            }
        },
        {
            title: "User",
            data: 'name'
        },
        {
            title: "Email",
            data: 'email'
        }
    ];
    $.ajax({
        url: api_url + 'documents/unacknowledged-users',
        type: 'POST',
        data: {'number': number},
        dataType: "JSON",
        success: function (dataSet) {
            $('#unacknowledged-users-table').DataTable({
                destroy: true,
                "dom": '<f<t>ip>',
                data: dataSet.data,
                columns: cols,
            });
        }
    });
}
