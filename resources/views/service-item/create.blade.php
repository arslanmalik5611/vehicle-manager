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
                <a href="{{env('BASE_URL').'service-item'}}" class="btn btn-outline-success btn-sm">Service Item
                    List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" id="form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label"><span class="required"></span> Service Item </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                </div>
                <div class="col-md-6 ">
                    <label for="material_type_id" class="form-label"><span class="required"></span>Type </label>
                    <select name="material_type_id" id="material_type_id" class="select2 material_type_id">
                        <option value="Maintenance">Maintenance</option>
                        <option value="Inspection">Inspection</option>
                        <option value="Repair">Repair</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="is_repeat" class="form-label"><span class="required"></span> Repeat Every: </label>
                            <input type="checkbox" class="form-check-input" id="is_repeat" name="is_repeat" checked>
                            <input type="number" class="form-control" id="repeat_times" name="repeat_times" value="6">
                        </div>
                        <div class="col-md-3">
                            <label for="repeat_type" class="form-label"><span class="required"></span> Type </label>

                            <select name="repeat_type" id="repeat_type" class="select2 repeat_type">
                                <option value="Days">Days</option>
                                <option value="Weeks">Weeks</option>
                                <option value="Months" selected>Months</option>
                                <option value="Years">Years</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="repeat_odometer_units" class="form-label"><span class="required"></span> (Odometer Units) </label>
                            <input type="number" class="form-control" id="repeat_odometer_units" name="repeat_odometer_units" value="1000">
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <label for="show_reminder" class="form-label"><span class="required"></span> Show Reminder: </label>
                    <input type="number" class="form-control" id="show_reminder" name="show_reminder" placeholder="" required>
                </div>
                <div class="col-md-3">
                    <label for="reminder_type" class="form-label"><span class="required"></span> Type </label>

                    <select name="reminder_type" id="reminder_type" class="select2 reminder_type">
                        <option value="Days">Days</option>
                        <option value="Weeks" selected>Weeks</option>
                        <option value="Months">Months</option>
                        <option value="Years">Years</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="reminder_odometer_units" class="form-label"><span class="required"></span> (Odometer Units) </label>
                    <input type="number" class="form-control" id="reminder_odometer_units" name="reminder_odometer_units" value="500">
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
        $("#form-data").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "service-item/store",
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