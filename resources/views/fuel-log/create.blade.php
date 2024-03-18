<?php
// echo "<pre>";
// print_r($Vehicle);
// die();

?>
@extends('layout.master')
@section('page_title','Fuel Log')

@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create </h2>
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
                <div class="col-md-6 ">
                    <label for="vehicle_id" class="form-label"><span class="required"></span>Select Vehicle </label>
                    <select name="vehicle_id" id="vehicle_id" class="select2 vehicle_id">
                        <option>Select Vehicle</option>
                        @foreach ($Vehicle as $vehicles )
                        <option value="{{$vehicles['id']}}">{{$vehicles['vehicle_no'] . ' ' . $vehicles['make']}}</option>

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fill_up_date" class="form-label"><span class="required"></span> Fill Up Date: </label>
                    <input type="date" class="form-control" id="fill_up_date" name="fill_up_date" placeholder="Enter Name" required value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="us_gallons" class="form-label"><span class="required"></span> Liter: </label>
                    <input type="number" class="form-control" id="us_gallons" name="us_gallons">
                </div>

                <div class="col-md-6">
                    <label for="Odometer Unit" class="form-label"><span class="required"></span> Odometer Unit: </label>
                    <select name="odometer_unit" id="odometer_unit" class="select2">
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
                <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i class="fas fa-chevron-right ms-3 go-icon"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page_level_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // $(document).on('focusout', '#starting_odometer', function() {
        //     var starting_odometer = $(this).val();
        //     var ending_odometer = $("#ending_odometer").val();
        //     var changes_odometer = starting_odometer - ending_odometer;
        //     $('#odometer_changes').val(changes_odometer);
        //     console.log(changes_odometer);
        // });
        $(document).on('focusout', '#starting_odometer', function() {
            var ending_odometer = $(this).val();
            var starting_odometer = $("#starting_odometer").val();
            var changes_odometer = starting_odometer;
            $('#odometer_changes').val(changes_odometer);
        });
        $("#form-data").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "fuel-log/store",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        success_notify(data.message);

                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });
    });
</script>
@endsection