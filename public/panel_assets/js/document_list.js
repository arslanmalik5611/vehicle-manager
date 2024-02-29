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
                return `<a href="${base_url}documents/${row.number}/view">${row.title}</a>`;
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
                var actionBtns = '';
                if (can_view_timeline) {
                    actionBtns = `<a href="${base_url + 'documents/' + row.number + '/timeline'}" class="btn btn-primary btn-sm btn-clean btn-icon text-white mb-1" title="Edit Record" data-id="${row.id}" data-bs-toggle="tooltip" target="_blank"> <i class="fa fa-thumbtack"></i> </a> `;
                }
                if (can_edit) {
                    actionBtns += `<a href="${base_url + 'documents/' + row.id + '/edit'}" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Edit Record" data-id="${row.id}" data-bs-toggle="tooltip"> <i class="fa fa-edit"></i> </a> `;
                }
                if (can_delete) {
                    actionBtns += `<a href="#" class="btn btn-danger btn-sm btn-clean btn-icon text-white mb-1 delete-btn" title="Delete document" data-action="document" data-id="${row.id}" data-bs-toggle="tooltip"> <i class="fa fa-trash"></i> </a> `;
                }
                return actionBtns;
            }
        }
    ];
    $.ajax({
        url: api_url + 'documents',
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
                url: api_url + "documents/" + id + "/delete",
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
