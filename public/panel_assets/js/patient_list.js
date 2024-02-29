var mrs = '';
$('.toggle-search-btn').click(function () {
    toggleSearchArea();
});

function toggleSearchArea() {
    $('#filter-form-div').slideToggle();
}

$(document).ready(function () {

    /*SEARCH & FILTER AREA*/
    references_load();
    collection_centers_load();
    archives_filter_load();
    archives_load();
    is_collection_center();
    $(document).on('keyup change', '.filter-input', function () {
        localStorage.setItem($(this).attr('id'), $(this).val());
    });
    $(".filter-select").on('select2:select', function (e) {
        localStorage.setItem($(e.currentTarget).attr('id'), $(e.currentTarget).val());
    });
    var storages = ['mr', 'name', 'passport_number', 'from_date', 'to_date', 'reference_id', 'collection_center_id', 'booking'];
    $(document).ajaxComplete(function () {
        storages.forEach(function (value, index) {
            $('#' + value).val(localStorage.getItem(value)).change();
        });
    });

    $(document).on('click', '.clear-search', function () {
        storages.forEach(function (value, index) {
            $('#' + value).val('');
            localStorage.removeItem(value);
        });

    });

    $(document).on('click', '.patient-checkbox', function () {
        get_checked_patients();
    });

    $(document).on('click', '.check-all-patients', function () {
        $('.patient-checkbox').prop('checked', $(this).is(':checked'));
        get_checked_patients();
    });

    $(document).on('click', '.archive-patients-btn', function () {
        if ($('.patient-checkbox:checked').length < 1) {
            Lobibox.notify('error', {
                size: 'mini',
                sound: false,
                msg: 'Please check atleast one patient'
            })
            return false;
        } else {
            $('#archive-count').html($('.patient-checkbox:checked').length);
            $('#archivePatientsModal').appendTo("body").modal('show');
        }
    });

    $(document).on('click', '.create-new-archive', function () {
        $('#createArchiveModal').appendTo("body").modal('show');
    });

    $(document).on('click', '.create-archive-btn', function () {
        if ($('#title').val()) {
            save_archive();
        }
    });

    function save_archive() {
        $.ajax({
            url: api_url + "archive/create",
            type: "POST",
            data: {
                'title': $('#title').val(),
                'notes': $('#notes').val()
            },
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    $('#createArchiveModal').modal('hide');
                    $('#archive_id').append(`<option value="${data.archive_id}">${$('#title').val()}</option>`);
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
    }

    $(document).on('click', '.archive-patients-save-btn', function () {
        if ($('.patient-checkbox:checked').length > 0) {
            save_patient_archive();
        }
    });

    function save_patient_archive() {
        $.ajax({
            url: api_url + "patient/archive-save",
            type: "POST",
            data: {
                'mrs': mrs,
                'archive_id': $('#archive_id').val()
            },
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    //$('.patient-checkbox:checked').parents('tr').remove();
                    $('.filter-btn').click();
                    $('#archivePatientsModal').modal('hide');
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
    }

    function get_checked_patients() {
        mrs = '';
        $('.patient-checkbox:checked').each(function () {
            mrs += $(this).attr('patient-mr');
            mrs += '\n';
        });
    }

    function get_checked_patients_separated_by_comma() {
        mrs = '';
        $('.patient-checkbox:checked').each(function () {
            mrs += $(this).attr('patient-mr') + ',';
        });
        return mrs;
    }

    function get_checked_export_cols() {
        var cols = '';
        $('.export_cols:checked').each(function () {
            cols += $(this).val() + ',';
        });
        return cols;
    }

    function archives_filter_load() {
        /*************************************
         * &ARCHIVES LIST& *
         * ***********************************/
        var archivesFilterOptions = `<option value="exclude">Exclude All Archived</option>`;
        archivesFilterOptions += `<option value="include">Include All Archived</option>`;
        $.ajax({
            url: api_url + 'archive',
            dataType: "JSON",
            success: function (response) {
                response.data.forEach(function (archive, id) {
                    archivesFilterOptions += `<option value="${archive.id}">${archive.title}</option>`;
                });
                $(".archive_id_filter").html(archivesFilterOptions);
            }
        });
    }


    $(document).on('click', '.export-patients-btn', function () {
        if ($('.patient-checkbox:checked').length < 1) {
            Lobibox.notify('error', {
                size: 'mini',
                sound: false,
                msg: 'Please check atleast one patient'
            })
            return false;
        } else {
            $('#xls-count').html($('.patient-checkbox:checked').length);
            $('#exportPatientsModal').appendTo("body").modal('show');
        }
    });

    $(document).on('click', '.print-barcodes-btn', function () {
        if ($('.patient-checkbox:checked').length < 1) {
            Lobibox.notify('error', {
                size: 'mini',
                sound: false,
                msg: 'Please check atleast one patient'
            })
            return false;
        } else {
            window.open(web_url + 'barcodes?mrs=' + get_checked_patients_separated_by_comma());
        }
    });

    $(document).on('click', '.export-patients-save-btn', function () {
        window.open(api_url + 'patient/export?export_type=' + $(this).val() + '&mrs=' + get_checked_patients_separated_by_comma() + '&cols=' + get_checked_export_cols());
    });

    $(document).on('click', '.filter-btn', function () {
        toggleSearchArea();
        filter_patients();
    });
    /*END OF-SEARCH & FILTER AREA*/
});

function filter_patients() {
    $('.filtered-patients-card').show();
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
                    if (row.form_code == 'PCR2DAYS') {
                        actionBtns = `<a href="${base_url + 'patients/day-2-pcr/' + row.id + '/edit'}" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Edit Record" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fa fa-edit"></i> </a> `;
                    } else if (row.form_code == 'FIT2FLYPCR') {
                        actionBtns = `<a href="${base_url + 'patients/fit-to-fly-pcr/' + row.id + '/edit'}" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Edit Record" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fa fa-edit"></i> </a> `;
                    } else {
                        actionBtns = `<a href="${base_url + 'patients/' + row.id + '/edit'}" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Edit Record" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fa fa-edit"></i> </a> `;
                    }
                }
                actionBtns += `<a href="${web_url + 'barcodes?mrs=' + row.mr}" class="btn btn-secondary btn-sm btn-clean btn-icon text-white mb-1" title="View Patient Details" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fa fa-barcode"></i> </a> `;
                actionBtns += `<a href="${web_url + 'patient-detail/' + row.mr}" class="btn btn-success btn-sm btn-clean btn-icon text-white mb-1" title="View Patient Details" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fa fa-eye"></i> </a> `;
                actionBtns += `<a href="${web_url + 'invoice-print/' + row.mr}" class="btn btn-secondary btn-sm btn-clean btn-icon text-white mb-1" title="Print Pay Invoice" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fas fa-print"></i> </a> `;
                actionBtns += `<a href="#" class="btn btn-primary btn-sm btn-clean btn-icon text-white mb-1 send-email" title="Send Email" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip"> <i class="fa fa-envelope"></i> </a> `;
                if (row.is_report_created) {
                    actionBtns += `<a href="${web_url + 'report-print/' + row.mr}" class="btn btn-success btn-sm btn-clean btn-icon text-white mb-1" title="Patient Report" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fas fa-file-pdf"></i> </a> `;
                    actionBtns += `<a href="${web_url + 'public/reports_pdf/' + row.mr + '.pdf'}" class="btn btn-secondary btn-sm btn-clean btn-icon text-white mb-1" title="Patient Report Email (PDF View)" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fas fa-file-pdf"></i> </a> `;
                    if (can_delete) {
                        actionBtns += `<a href="#" class="btn btn-warning btn-sm btn-clean btn-icon text-white mb-1 delete-btn" data-action="report" title="Delete Patient Report Only" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip"> <i class="fa fa-times-circle"></i> </a> `;
                    }
                } else {
                    actionBtns += `<a href="${base_url + 'patients/report-create?mrs=' + row.mr}" class="btn btn-primary btn-sm btn-clean btn-icon text-white mb-1" title="Create Patient Report" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fas fa-pen-square"></i> </a> `;
                }
                if (can_delete) {
                    actionBtns += `<a href="#" class="btn btn-danger btn-sm btn-clean btn-icon text-white mb-1 delete-btn" title="Delete Patient Record" data-action="patient" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip"> <i class="fa fa-trash"></i> </a> `;
                }
                actionBtns += `<a href="${base_url + 'patients/' + row.mr + '/audit-trail'}" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Patient Audit Trail" data-id="${row.id}" patient-mr="${row.mr}" data-bs-toggle="tooltip" target="_blank"> <i class="fa fa-window-restore "></i> </a> `;
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
            title: "C. Center",
            data: 'collection_center.name',
            defaultContent: ""
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
    load_patient_table(cols, 'patient/filter');
}
