$(document).ready(function () {
    $('#nav-bar').addClass('show');
    $('#main-pd').addClass('main-pd');
    document_type_optional_load('#document_type_id');
    documents_datatable();
});

$(document).on('click', '.filter-btn', function () {
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
            render: function(data, type,row, meta){
                return `<a href="${base_url}documents/${row.number}/view">${row.number}</a>`;
            }
        },
        {
            title: "Title",
            data: 'title',
            render: function(data, type,row, meta){
                return `<a href="${base_url}documents/${row.number}/view">${row.title}</a>`;
            }
        },
        {
            title: "Document Type",
            data: 'document_type.name',
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
        }
    ];
    $.ajax({
        url: api_url + 'documents/listing',

        data: JSON.stringify(getFormData()),
        type: "POST",
        dataType: "JSON",
        contentType: "application/json",
        success: function (dataSet) {
            $('#datatable').DataTable({
                destroy: true,
                "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
                data: dataSet.data,
                columns: cols,
                createdRow: function (row, data, index) {
                    if (!data.has_acknowledged) {
                        $(row).addClass('pending-acknowledgement');
                    }
                }
            });
        }
    });
}

function getFormData() {
    return {
        'number': $('#number').val(),
        'title': $('#title').val(),
        'author': $('#author').val(),
        'owner': $('#owner').val(),
        'document_type_id': $('#document_type_id').val(),
    };
}
