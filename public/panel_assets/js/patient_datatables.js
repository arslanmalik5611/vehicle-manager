function load_patient_table(cols, url) {
    block_page();
    $.ajax({
        url: api_url + url,
        type: "POST",
        data: $("#form-data").serialize(),
        dataType: "JSON",
        success: function (dataSet) {
            $('#datatable').DataTable({
                destroy: true,
                dom: 'B<"toolbar">flrtip',
                buttons: [
                    'copy', 'csv', 'pdf', 'print'
                ],
                "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
                data: dataSet.data,
                columns: cols,
                createdRow: function (row, data, index) {
                    if (!data.is_report_created) {
                        $(row).addClass('pending-report-row');
                    }
                    else if(data.is_report_created && data.email_sent==0){
                        $(row).addClass('pending-email-report-row');
                    }
                }

            });
            $("div.toolbar").html(`<div class="dt-yellow-box"></div> <div class="dt-info-box"> > Indicates pending reports</div> <div class="dt-pending-email-box"></div> <div class="dt-info-box"> > Indicates pending emails</div>`);

            unblock_page();
        }
    });

}


$(document).on('click', '.send-email', function (e) {
    var mrs = $(this).attr('patient-mr');
    e.preventDefault();
    block_page();
    $.ajax({
        url: api_url + 'patient/send-mail',
        dataType: "JSON",
        type: "POST",
        data: {
            'mrs': mrs,
        },
        success: function (response) {
            unblock_page();
            if (!response.status) {
                Lobibox.notify('error', {
                    size: 'mini',
                    sound: false,
                    delay: 20000,
                    msg: response.message
                });
                return false;
            } else {
                Lobibox.notify('success', {
                    size: 'mini',
                    sound: false,
                    delay: 5000,
                    msg: response.message
                });
            }

        }
    });
});

$(document).on('click', '.delete-btn', function () {
    var id = $(this).attr('data-id');
    var action = $(this).attr('data-action');
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
                url: api_url + "patient/" + id + "/delete",
                data: {"id": id, 'action': action},
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
                            "Your record could not be deleted.",
                            'danger'
                        )
                    }

                },
                error: function (returnData) {
                    Swal.fire(
                        "Problem!",
                        "Your record could not be deleted.",
                        'danger'
                    )
                },

            });

        }
    });
});
