@extends('layout.master')
@section('page_title','Subject Combination')
​
@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> Subject Combination List </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'subject-combinations/create'}}"
                       class="btn btn-outline-secondary btn-sm">Create
                        Subject Combination</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="datatable">
            </table>
        </div>
    </div>
@endsection
​
@section('page_level_scripts')
    <script src="{{asset('panel_assets/js/common_datatables.js?v='.date('ymdhis'))}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var count = 0;

            var cols = [
                {
                    title: "SN",
                    render: function (data, type) {
                        return ++count;
                    }
                },
                {
                    title: "Name",
                    render: function (data, type, row, meta) {
                        return row.name;
                    }
                },
                {
                    title: "Short Name",
                    render: function (data, type, row, meta) {
                        return row.short_name;
                    }
                },
                {
                    title: "Class",
                    render: function (data, type, row, meta) {
                        if (row.school_class)
                            return row.school_class.name;
                        else
                            return '';
                    }
                },
                {
                    title: "Group",
                    render: function (data, type, row, meta) {
                        return row.group.name;
                    }
                },
                {
                    title: "Action",
                    data: 'id',
                    render: function (data, type, row, meta) {
                        var actionBtns = '';
                        actionBtns += `<a href="<?php echo env('BASE_URL') ?>subject-combinations/${row.id}/edit/" class="btn btn-info btn-sm btn-clean btn-icon text-white" title="Edit Record"
                                    > <i class="fa fa-edit"></i> </a> `;
                        actionBtns += `<a href="javascript:;" data-id="${row.id}" data-method='' class="deletebtn btn-danger btn btn-sm btn-clean btn-icon" title="Delete Record">
                                        <i class="fa fa-times-circle"></i>
                                    </a>`;
                        return actionBtns;
                    }
                }
            ];

            $.ajax({
                url: api_url + 'subject-combinations/',
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
        });


        $(document).on('click', '.deletebtn', function (e) {
            thisElem = $(this);
            id = $(this).attr('data-id');
            console.log(id);
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
                        url: api_url + 'subject-combinations/' + id + '/delete',
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
    </script>
@endsection
