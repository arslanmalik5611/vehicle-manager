$(document).ready(function () {
    var trail = '';
    /*************************************
     * &PATIENT AUDIT TRAIL& *
     * ***********************************/
    $.ajax({
        url: api_url + 'patient/'+mr+'/audit-trail',
        dataType: "JSON",
        type: "POST",
        success: function (response) {

            $('.patient-name').prepend(response.patient.first_name + ' ' + response.patient.last_name);
            $('.patient-mr').html(response.patient.mr);
            if (response.data.length == 0 || response.data == '' || response.data == undefined) {
                trail += noRecordFound();
            }
            $(response.data).each(function (i, data) {
                if (data.action == 'patient_create') {
                    trail += patientCreate(data);
                } else if (data.action == 'patient_report_created') {
                    trail += patientReportCreated(data);
                } else if (data.action == 'patient_tests_deleted') {
                    trail += patientTestsDeleted(data);
                } else if (data.action == 'patient_tests_created') {
                    trail += patientTestsCreated(data);
                } else if (data.action == 'patient_report_deleted') {
                    trail += patientReportDeleted(data);
                } else if (data.action == 'patient_edit') {
                    trail += patientEdit(data);
                } else if (data.action == 'patient_report_email') {
                    trail += patientReportEmail(data);
                }

            });

            $('#audit-trail-table').append(trail);
        }
    });
});

function patientCreate(data) {
    return `<tr class="patient-create">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-success">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>${data.message}</td>
                    </tr>`;
}

function patientReportCreated(data) {
    return `<tr class="patient-report-created">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-success">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>${data.message}</td>
                    </tr>`;
}

function patientTestsDeleted(data) {
    var returndata = `<tr class="patient-tests-deleted">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-warning text-dark">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>
                            <b>Following Test(s) deleted:</b>
                            <br/>`;
    $(data.tests).each(function (k, x) {
        returndata += `<div>${x.name}</div>`;
    });

    returndata += `</td>
                    </tr>`;
    return returndata;
}

function patientTestsCreated(data) {
    var returndata = `<tr class="patient-tests-added">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-primary">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>
                            <b>Following Test(s) added:</b>
                            <br/>`;
    $(data.tests).each(function (k, x) {
        returndata += `<div>${x.name}</div>`;
    });

    returndata += `</td>
                    </tr>`;
    return returndata;
}

function patientEdit(data) {
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

function patientReportDeleted(data) {
    var returndata = `<tr class="patient-report-deleted">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-danger">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>
                        Report Results Deleted. <br>
                        <b>Following are the details:</b> <br>`;

    $.each(data.data, function (key, valueObj) {
        returndata += `<br/>
                        Test Name:<span><b>${valueObj.test.name}</b></span>
                        <br/>
                        <table class="table table-bordered">
                            <tr>
                                <th>Detail</th>
                                <th>Results</th>
                            </tr>`;
        $.each(valueObj.patient_test_details, function (ind, val) {
            returndata += `<tr>
                                <td>${val.name}</td>
                                <td>${val.result}</td>
                            </tr>`;
        });

        returndata += `</table>
                        Remarks: <span>${valueObj.report_remarks.name}</span> <br/> <br/>`;
    });
    returndata += `</td>
                    </tr>`;

    return returndata;
}

function patientReportEmail(data) {
    return `<tr class="patient-report-email">
                        <td class="small-text">${data.action_at}</td>
                        <td><span class="badge bg-success">${data.title}</span></td>
                        <td>${data.user}</td>
                        <td>${data.message}</td>
                    </tr>`;
}

function noRecordFound() {
    return `<tr class="no-record-found">
                        <td colspan="4">No audit trail found for this patient</td>
                    </tr>`;
}
