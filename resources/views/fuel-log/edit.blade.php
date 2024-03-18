@extends('layout.master')
@section('page_title','Fuel Log Edit')

@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-edit fa-icon"></i> Edit </h2>
            </div>
            <div>
                <a href="{{env('BASE_URL').'fuel-log'}}" class="btn btn-outline-success btn-sm">Fuel Log
                    List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" id="form-data">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fill_up_date" class="form-label"><span class="required"></span> Fill Up Date: </label>
                    <input type="date" class="form-control" id="fill_up_date" name="fill_up_date" placeholder="Enter Name" required value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="us_gallons" class="form-label"><span class="required"></span> Us Gallons: </label>
                    <input type="number" class="form-control" id="us_gallons" name="us_gallons">
                </div>

                <div class="col-md-6">
                    <label for="Odometer Unit" class="form-label"><span class="required"></span> Odometer Unit: </label>
                    <select name="odometer_unit" id="odometer_unit" class="form-control">
                        <option value="miles">Miles</option>
                        <option value="kilometer">Kilometers</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="starting_odometer" class="form-label"><span class="required"></span> Starting Odometer: </label>
                    <input type="number" class="form-control" id="starting_odometer" name="starting_odometer">
                </div>

                <!-- <div class="col-md-6"> -->
                    <!-- <label for="ending_odometer" class="form-label"><span class="required"></span> Ending Odometer: </label> -->
                    <input type="hidden" class="form-control" id="ending_odometer" name="ending_odometer" value=0>
                <!-- </div> -->

                <div class="col-md-6">
                    <label for="total_cost" class="form-label"><span class="required"></span> Total Cost: </label>
                    <input type="number" class="form-control" id="total_cost" name="total_cost">
                </div>

                <div class="col-md-6">
                    <label for="odometer_changes" class="form-label"><span class="required"></span> Odometer Change: </label>
                    <input type="number" class="form-control" id="odometer_changes" name="odometer_changes" readonly>
                </div>


                <div class="col-md-6">
                    <label for="name" class="form-label">Notes </label>
                    <textarea name="notes" id="notes" class="tinymce"></textarea>
                </div>
            </div><!--End of row-->


            <div class="card-footer text-end">
                <input type="hidden" value="{{ request()->id }}" name="id" id="id">
                <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i class="fas fa-chevron-right ms-3 go-icon"></i> <i class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i></button>
            </div>
        </form>
    </div>

</div>
@endsection
@section('page_level_scripts')
<script type="text/javascript">
    var id = "{{ request()->id }}";

    $(document).ready(function() {
        // $(document).on('keyup', '#starting_odometer', function() {
        //     var starting_odometer = $(this).val();
        //     var ending_odometer = $("#ending_odometer").val();
        //     var changes_odometer = ending_odometer-starting_odometer;
        //     $('#odometer_changes').val(changes_odometer);
        //     console.log(changes_odometer);
        // });
        // $(document).on('keyup', '#ending_odometer', function() {
        //     var ending_odometer = $(this).val();
        //     var starting_odometer = $("#starting_odometer").val();
        //     var changes_odometer = ending_odometer - starting_odometer;
        //     $('#odometer_changes').val(changes_odometer);
        //     console.log(changes_odometer);
        // });
        $(document).on('focusout', '#starting_odometer', function() {
            var ending_odometer = $(this).val();
            var starting_odometer = $("#starting_odometer").val();
            var changes_odometer = starting_odometer;
            $('#odometer_changes').val(changes_odometer);
        });
        $.ajax({
            url: api_url + `fuel-log/${id}/show`,
            dataType: "JSON",
            success: function(response) {
                $('#fill_up_date').val(response.data.fill_up_date);
                $('#us_gallons').val(response.data.us_gallons);
                $('#total_cost').val(response.data.total_cost);

                $(`#odometer_unit option[value=${response.data.odometer_unit}]`).prop("selected", true);

                $('#starting_odometer').val(response.data.starting_odometer);
                $('#ending_odometer').val(response.data.ending_odometer);
                $('#odometer_changes').val(response.data.odometer_changes);
                // $('#notes').val(response.data.notes);
                if (response.data.notes)
                    tinymce.get('notes').setContent(response.data.notes);
            }
        });
    });

    $("#form-data").on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: api_url + "fuel-log/update",
            type: "POST",
            data: $(this).serialize(),

            // data: {
            //     'id': id,
            //     'name': name,
            //     'level': level,
            //     'short_name': short_name,
            //     'notes': notes
            // },
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    success_notify(data.message)
                } else {
                    error_notify(data.message);
                }
            }
        });
    });
</script>
@endsection