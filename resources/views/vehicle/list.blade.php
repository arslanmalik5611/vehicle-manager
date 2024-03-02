@extends('layout.master')
@section('page_title','User')
​
@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> User List </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'vehicle/create'}}" class="btn btn-outline-secondary btn-sm">Create
                    Vehicle</a>
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
            nav_bar_hide();
            var count = 0;

            var cols = [
                {
                    title: "SN",
                    render: function (data, type) {
                        return ++count;
                    }
                },
                {
                    title: "Image",
                    render: function (data, type, row, meta) {
                        var image = `<image src='${row.image_url}' style="width:50px;height:40px" /> `;
                        return  image;
                    }
                },
                {
                    title: "Model Year",
                    render: function (data, type, row, meta) {
                        return row.model_year ?? '';
                    }
                },
                {
                    title: "Make",
                    render: function (data, type, row, meta) {
                        return row.make ?? '';
                    }
                },

                {
                    title: "Vin #",
                    render: function (data, type, row, meta) {
                        return row.vin_no ?? '';
                    }
                },

                {
                    title: "Color",
                    render: function (data, type, row, meta) {
                        return row.color ?? '';
                    }
                },
                {
                    title: "Type",
                    render: function (data, type, row, meta) {
                        return row.vehicle_type.name ?? '';
                    }
                },
                
               
                {
                    title: "Action",
                    data: 'id',
                    render: function (data, type, row, meta) {
                        var actionBtns = '';

                        actionBtns += `<a href="<?php echo env('BASE_URL') ?>vehicle/${row.id}/edit/" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Edit Record"
                                    > <i class="fa fa-edit"></i> </a> `;

                        actionBtns += `<a href="javascript:;" data-id="${row.id}" data-method='' class="deletebtn btn-danger btn btn-sm btn-clean btn-icon" title="Delete Record">
                                        <i class="fa fa-times-circle"></i>
                                    </a>`;
                        return actionBtns;
                    }
                }
            ];

            $.ajax({
                url: api_url + 'vehicle/',
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
                        url: api_url + 'vehicle/' + id + '/delete',
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

        // GENERATE USER CARD
        $(document).on('click', '.cardGenerateBtn', function(e) {
            e.preventDefault();
            thisElem = $(this);
            id = $(this).attr('data-id');
            $.ajax({
                url: api_url + 'users/card-generate',
                type: "POST",
                data: {
                    'id': id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status) {
                        success_notify(response.message);
                        // window.location.href = `${response.card_path}`;
                        window.open(`${response.card_path}`, '_blank');
                    } else {
                        error_notify(response.message);
                    }


                }
            });
        });
    </script>
@endsection
