var count = 0;

function drawTable(datatableObj) {
    var cols = [
        {
            title: "SN",
            render: function (data, type) {
                return ++count;
            }
        }
    ];

    for (key in datatableObj.cols) {
        cols.push({
            title: datatableObj.cols[key],
            data: key
        });
    }

    cols.push({
        title: "Action",
        data: 'id',
        render: function (data, type) {
            var actionBtns = '';
            if (datatableObj.editMethod) {
                actionBtns += `<a href="${base_url + datatableObj.editMethod + '/' + data + '/edit'}" class="btn btn-info btn-sm btn-clean btn-icon text-white" title="Edit Record"
                                    > <i class="fa fa-edit"></i> </a> `;
            }
            if (datatableObj.deleteMethod) {
                actionBtns += `<a href="javascript:;" data-id="${data}" data-method='${datatableObj.deleteMethod}' class="deletebtn btn-danger btn btn-sm btn-clean btn-icon" title="Delete Record">
                                        <i class="fa fa-times-circle"></i>
                                    </a>`;
            }
            return actionBtns;
        }
    });
    $.ajax({
        url: datatableObj.url,
        type: "GET",
        dataType: "JSON",
        success: function (dataSet) {
            $('#datatable').DataTable({
                dom: 'Bflrtip',
                buttons: [
                    'copy', 'csv', 'pdf', 'print'
                ],
                data: dataSet.data,
                columns: cols

            });
        }
    });
}

$(document).on('click', '.deletebtn', function (e) {
    thisElem = $(this);
    id = $(this).attr('data-id');
    deleteMethod = $(this).attr('data-method');
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: api_url + deleteMethod + '/' + id + '/delete',
                type: "POST",
                dataType: "JSON",
                success: function (response) {
                    if (response.status) {
                        $(thisElem).parents('tr').remove();
                        Swal.fire(
                            "Deleted!",
                            response.message,
                            "success"
                        )
                    } else {
                        Swal.fire(
                            "Sorry!",
                            "Your record could not deleted.",
                            "error"
                        )
                    }

                }
            });

        }
    });
});
