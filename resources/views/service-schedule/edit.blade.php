@extends('layout.master')
@section('page_title','Service Item')

@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create </h2>
            </div>
            <div>
                <a href="{{env('BASE_URL').'service-item'}}" class="btn btn-outline-success btn-sm">Service Schedule
                    List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" id="form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="vehicle_id" class="form-label"><span class="required"></span>Select Vehicle </label>
                    <select name="vehicle_id" id="vehicle_id" class="form-control vehicle_id">
                        <option>Select Vehicle</option>
                        @foreach ($Vehicle as $vehicles)
                        <option value="{{$vehicles['id']}}">{{$vehicles['vehicle_no'] . ' ' . $vehicles['make']}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 ">
                    <label for="service_item_id" class="form-label"><span class="required"></span>Select Service Item </label>
                    <select name="service_item_id" id="service_item_id" class="form-control service_item_id">
                        <option>Select Service Item</option>
                        @foreach ($ServiceItem as $ServiceItems)
                        <option value="{{$ServiceItems['id']}}">{{$ServiceItems['name']}}</option>

                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="is_repeat" class="form-label"><span class="required"></span> Repeat Every: </label>
                    <input type="checkbox" class="form-check-input" id="is_repeat" name="is_repeat">
                    <input type="number" class="form-control" id="repeat_times" name="repeat_times" >
                </div>
                <div class="col-md-4">
                    <label for="repeat_type" class="form-label"><span class="required"></span> Type </label>

                    <select name="repeat_type" id="repeat_type" class="form-control repeat_type">
                        <option value="Days">Days</option>
                        <option value="Weeks">Weeks</option>
                        <option value="Months">Months</option>
                        <option value="Years">Years</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="repeat_odometer_units" class="form-label"><span class="required"></span> Miles: </label>
                    <input type="number" class="form-control" id="repeat_odometer_units" name="repeat_odometer_units" >
                </div>


                <div class="col-md-4">
                    <label for="show_reminder" class="form-label"><span class="required"></span> Show Reminder: </label>
                    <input type="number" class="form-control" id="show_reminder" name="show_reminder" placeholder="" required>
                </div>
                <div class="col-md-4">
                    <label for="reminder_type" class="form-label"><span class="required"></span> Type </label>

                    <select name="reminder_type" id="reminder_type" class="form-control reminder_type">
                        <option value="Days">Days</option>
                        <option value="Weeks" >Weeks</option>
                        <option value="Months">Months</option>
                        <option value="Years">Years</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="reminder_odometer_units" class="form-label"><span class="required"></span> Miles before due: </label>
                    <input type="number" class="form-control" id="reminder_odometer_units" name="reminder_odometer_units" >
                    <input type="hidden" class="form-control" id="id" name="id" >
                </div>

                <div class="col-md-4">
                    <label for="next_due_date" class="form-label"><span class="required"></span> Next Due: </label>
                    <input type="date" class="form-control" id="next_due_date" name="next_due_date" value="value="<?php echo date('Y-m-d'); ?>"">
                </div>

                <div class="col-md-4">
                    <label for="next_due_miles" class="form-label"><span class="required"></span> Miles: </label>
                    <input type="number" class="form-control" id="next_due_miles" name="next_due_miles" value="1625">
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
        var id = "{{ request()->id }}";
        $.ajax({
            url: api_url + `service-schedule/${id}/show`,
            dataType: "JSON",
            success: function(response) {
                data = response.data;
                $('#id').val(data.id);
                $('#name').val(data.name);
                $(`#vehicle_id option[value=${data.vehicle_id}]`).prop("selected", true);
                $(`#service_item_id option[value=${data.service_item_id}]`).prop("selected", true);
                if(data.is_repeat==true){
                    $('#is_repeat').prop('checked',true);
                }
                $('#repeat_times').val(data.repeat_times);
                $(`#repeat_type option[value=${data.repeat_type}]`).prop("selected", true);
                $('#repeat_odometer_units').val(data.repeat_odometer_units);
                $('#show_reminder').val(data.show_reminder);
                $(`#reminder_type option[value=${data.reminder_type}]`).prop("selected", true);
                $('#reminder_odometer_units').val(data.reminder_odometer_units);
                $('#next_due_date').val(data.next_due_date);
                tinymce.get('notes').setContent(data.notes);

            }
        });

        $("#form-data").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "service-schedule/update",
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