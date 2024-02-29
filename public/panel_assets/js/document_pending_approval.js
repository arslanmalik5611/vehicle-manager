$(document).ready(function () {
    documents_datatable();
});

function documents_datatable() {
    var count = 0;
    var cols = [
        {
            title: "SN",
            render: function (data, type) {
                return ++count;
            }
        },
        {
            title: "Document Number",
            data: 'number',
            render: function (data, type, row, meta) {
                return `<a href="${base_url}documents/${row.number}/view">${row.number}</a>`;
            }
        },
        {
            title: "Title",
            data: 'title',
            render: function (data, type, row, meta) {
                return `<a href="${base_url}documents/${row.number}/view">${row.title}</a>`;
            }
        },
        {
            title: "Document Type",
            data: 'document_type.name',
            defaultContent: ""
        },
        {
            title: "Status",
            data: 'document_status.name',
            defaultContent: ""
        },
        {
            title: "Author",
            data: 'author'
        },
        {
            title: "Owner",
            data: 'owner'
        },
        {
            title: "Revision",
            data: 'revision'
        }
        ,
        {
            title: "Active At",
            data: 'active_at_formatted',
        },
        {
            title: "Action",
            data: 'id',
            render: function (data, type, row, meta) {
                return actionBtns = `<a href="#" class="btn btn-success btn-sm btn-clean btn-icon text-white mb-1 approve-btn" title="Approve Patient Record" data-action="document" data-id="${row.id}" data-bs-toggle="tooltip"> <i class="fa fa-check-circle"></i> </a> `;

            }
        }
    ];
    $.ajax({
        url: api_url + 'documents/pending-approval',
        type: 'POST',
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
            });
        }
    });
}

$(document).on('click', '.approve-btn', function () {
    var id = $(this).attr('data-id');
    Swal.fire({
        title: "Are you sure?",
        text: "Document will be available to all users!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes, approve it!"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: api_url + "documents/approve",
                data: {"id": id},
                dataType: "JSON",
                success: function (returnData) {
                    if (returnData.status) {

                        $("[data-id=" + id + "]").parents('tr').remove();
                        Swal.fire(
                            "Approved!",
                            returnData.message,
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
