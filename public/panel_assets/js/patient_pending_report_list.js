var ExcelToJSON = function () {

    this.parseExcel = function (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            mrs = '';
            workbook.SheetNames.forEach(function (sheetName) {
                var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {
                    header: 1
                });
                if (roa.length) {
                    $(roa).each(function (e, j) {
                        mrs += j + ',';
                    });
                    $('#mrs').val(mrs.slice(0, -1));
                } else {
                    Lobibox.notify('error', {
                        size: 'mini',
                        sound: false,
                        msg: 'No data found in file. Upload again!'
                    });
                }

            })
        };

        reader.onerror = function (ex) {
            Lobibox.notify('error', {
                size: 'mini',
                sound: false,
                msg: 'Error occurred while processing file. Upload again!'
            });
        };

        reader.readAsBinaryString(file);
    };
};

function handleFileSelect(evt) {

    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('import_mrs').addEventListener('change', handleFileSelect, false);

$(document).ready(function () {
    draw_table();
});

function draw_table() {
    var count = 0;
    var cols = [
        {
            title: "SN",
            render: function (data, type) {
                return ++count;
            }
        },
        {
            title: `<input type="checkbox" class="check-all-patients">`,
            data: 'id',
            render: function (data, type, row, meta) {
                return `<input type="checkbox" class="patient-checkbox" value="${row.id}" patient-mr="${row.mr}">`;
            }
        },
        {
            title: "Action",
            data: 'id',
            render: function (data, type, row, meta) {
                var actionBtns = '';
                if (can_edit) {
                    actionBtns = `<a href="${base_url + 'patients/' + row.id + '/edit'}" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Edit Record" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fa fa-edit"></i> </a> `;
                }

                actionBtns += `<a href="${web_url + 'patient-detail/' + row.mr}" class="btn btn-success btn-sm btn-clean btn-icon text-white mb-1" title="View Patient Details" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fa fa-eye"></i> </a> `;
                actionBtns += `<a href="${web_url + 'invoice-print/' + row.mr}" class="btn btn-secondary btn-sm btn-clean btn-icon text-white mb-1" title="Print Pay Invoice" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fas fa-print"></i> </a> `;
                if (row.is_report_created) {
                    actionBtns += `<a href="${web_url + 'report-print/' + row.mr}" class="btn btn-success btn-sm btn-clean btn-icon text-white mb-1" title="Patient Report" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fas fa-file-pdf"></i> </a> `;
                } else {
                    actionBtns += `<a href="${base_url + 'patients/report-create?mrs=' + row.mr}" class="btn btn-primary btn-sm btn-clean btn-icon text-white mb-1" title="Create Patient Report" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fas fa-pen-square"></i> </a> `;
                }

                actionBtns += `<a href="#" class="btn btn-primary btn-sm btn-clean btn-icon text-white mb-1 send-email" title="Send Email" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip"> <i class="fa fa-envelope"></i> </a> `;
                if (can_delete) {
                    actionBtns += `<a href="#" class="btn btn-danger btn-sm btn-clean btn-icon text-white mb-1 delete-btn" title="Delete Patient" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip"> <i class="fa fa-trash"></i> </a> `;
                }
                return actionBtns;
            }
        },
        {
            title: "MR.No",
            data: 'mr'
        },
        {
            title: "First Name",
            data: 'first_name'
        },
        {
            title: "Last Name",
            data: 'last_name'
        },
        {
            title: "Passport Number",
            data: 'passport_number'
        },
        {
            title: "Email",
            data: 'email'
        }
        ,
        {
            title: "Phone No",
            data: 'phone_no'
        }
        ,
        {
            title: "Registered At",
            data: 'registered_at_formatted',
        }
        ,
        {
            title: "Collection At",
            data: 'collection_datetime_formatted'
        }

    ];
    load_patient_table(cols, 'patient/patients-without-report');
}

$(document).on('click', '.patient-checkbox', function () {
    get_checked_patients();
});

$(document).on('click', '.check-all-patients', function () {
    $('.patient-checkbox').prop('checked', $(this).is(':checked'));
    get_checked_patients();
});

function get_checked_patients() {
    var mrs = '';
    $('.patient-checkbox:checked').each(function () {
        mrs += $(this).attr('patient-mr');
        mrs += '\n';
    });
    $('#mrs').val(mrs);
}
