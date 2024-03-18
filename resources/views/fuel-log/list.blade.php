@extends('layout.master')
@section('page_title','Fuel Log')
​
@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="row mb-3">
            <div class="col-md-6 ">
                <label for="vehicle_id" class="form-label"><span class="required"></span>Select Vehicle </label>
                <select name="vehicle_id" id="vehicle_id" class="select2 vehicle_id">
                    <option>Select Vehicle</option>
                    <option value='all' selected>All Vehicles</option>
                    @foreach ($Vehicle as $vehicles )
                    <option value="{{$vehicles['id']}}">{{$vehicles['vehicle_no'] . ' ' . $vehicles['make']}}</option>

                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> Fuel Log List </h2>
            </div>
            <div>
                <a href="{{env('BASE_URL').'fuel-log/create'}}" class="btn btn-outline-secondary btn-sm">Create
                    Fuel Log</a>
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
    $(document).ready(function() {
        function fuelLogLoad(vehicle_id) {
            var count = 0;

            var cols = [{
                    title: "SN",
                    render: function(data, type) {
                        return ++count;
                    }

                },
                {
                    title: "Date",
                    render: function(data, type, row, meta) {
                        return row.fill_up_date ?? '';
                    }
                },
                {
                    title: "Starting Odometer",
                    render: function(data, type, row, meta) {
                        return row.starting_odometer + ' ' + (row.odometer_unit ?? '') ?? '';
                    }
                },

                {
                    title: "Miles",
                    render: function(data, type, row, meta) {
                        return (row.odometer_changes) ?? 0;
                    }
                },
                {
                    title: "Liters",
                    render: function(data, type, row, meta) {
                        return (row.us_gallons) ?? 0;
                    }
                },
                {
                    title: "Cost",
                    render: function(data, type, row, meta) {
                        return (row.total_cost) ?? 0;
                    }
                },
                {
                    title: "US MPG",
                    render: function(data, type, row, meta) {
                        var us_mpg = parseFloat(row.odometer_changes) / parseFloat(row.total_cost)
                        return (parseFloat(us_mpg).toFixed(2)) ?? 0;
                    }
                },


                {
                    title: "Action",
                    data: 'id',
                    render: function(data, type, row, meta) {
                        var actionBtns = '';

                        actionBtns += `<a href="<?php echo env('BASE_URL') ?>fuel-log/${row.id}/edit/" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Edit Record"
                                    > <i class="fa fa-edit"></i> </a> `;

                        actionBtns += `<a href="javascript:;" data-id="${row.id}" data-method='' class="deletebtn btn-danger btn btn-sm btn-clean btn-icon" title="Delete Record">
                                        <i class="fa fa-times-circle"></i>
                                    </a>`;
                        return actionBtns;
                    }
                }
            ];

            $.ajax({
                url: api_url + 'api/fuel-log/get-fuel-log/',
                dataType: "JSON",
                type: "POST",
                data: {
                    'vehicle_id': vehicle_id
                },
                success: function(dataSet) {
                    if (dataSet.data.length != 0) {
                        $('#datatable').DataTable({
                            "bDestroy": true,
                            dom: 'Bflrtip',
                            buttons: [
                                'copy', 'csv', 'pdf', 'print'
                            ],
                            data: dataSet.data,
                            columns: cols

                        });
                    } else {
                        alert('No Data Founds');
                    }
                }
            });
        }

        fuelLogLoad('all');
        nav_bar_hide();
        $(document).on('change', '#vehicle_id', function() {
            var vehicle_id = $('#vehicle_id').val();
            fuelLogLoad(vehicle_id);
        })

    });

    $(document).on('click', '.deletebtn', function(e) {
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
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: api_url + 'fuel-log/' + id + '/delete',
                    type: "POST",
                    dataType: "JSON",
                    success: function(response) {
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