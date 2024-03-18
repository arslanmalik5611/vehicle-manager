@extends('layout.master')
@section('page_title','Service Item')

@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Edit </h2>
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required >
                </div>



                <div class="col-md-6 ">
                    <label for="material_type_id" class="form-label"><span class="required"></span>Type </label>
                    <select name="material_type_id" id="material_type_id" class="form-control material_type_id">
                        <option value="Inspection" >Inspection</option>
                        <option value="Maintenance" >Maintenance</option>
                        <option value="Repair" >Repair</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="is_repeat" class="form-label"><span class="required"></span> Repeat Every: </label>
                            <input type="checkbox" class="form-check-input" id="is_repeat" name="is_repeat" >
                            <input type="number" class="form-control" id="repeat_times" name="repeat_times" >
                        </div>
                        <div class="col-md-3">
                            <label for="repeat_type" class="form-label"><span class="required"></span> Type </label>

                            <select name="repeat_type" id="repeat_type" class="form-control repeat_type">
                                <option value="Days">Days</option>
                                <option value="Weeks">Weeks</option>
                                <option value="Months" >Months</option>
                                <option value="Years">Years</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="repeat_odometer_units" class="form-label"><span class="required"></span> (Odometer Units) </label>
                            <input type="number" class="form-control" id="repeat_odometer_units" name="repeat_odometer_units" >
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <label for="show_reminder_times" class="form-label"><span class="required"></span> Show Reminder: </label>
                    <input type="number" class="form-control" id="show_reminder_times" name="show_reminder_times" placeholder="" required>
                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" >
                </div>
                <div class="col-md-3">
                    <label for="reminder_type" class="form-label"><span class="required"></span> Type </label>

                    <select name="reminder_type" id="reminder_type" class="form-control reminder_type">
                        <option value="Days">Days</option>
                        <option value="Weeks">Weeks</option>
                        <option value="Months">Months</option>
                        <option value="Years">Years</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="reminder_odometer_units" class="form-label"><span class="required"></span> (Odometer Units) </label>
                    <input type="number" class="form-control" id="reminder_odometer_units" name="reminder_odometer_units" >
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
            url: api_url + `service-item/${id}/show`,
            dataType: "JSON",
            success: function(response) {
                $('#id').val(response.data.id);
                $('#name').val(response.data.name);
                $(`#material_type_id option[value=${response.data.material_type_id}]`).prop("selected", true);
                if(response.data.is_repeat){
                    $('#is_repeat').prop('checked',true);
                }
                $('#repeat_times').val(response.data.repeat_times);
                $(`#repeat_type option[value=${response.data.repeat_type}]`).prop("selected", true);
                $('#repeat_odometer_units').val(response.data.repeat_odometer_units);
                $('#show_reminder_times').val(response.data.show_reminder_times);
                $(`#reminder_type option[value=${response.data.reminder_type}]`).prop("selected", true);
                $('#reminder_odometer_units').val(response.data.reminder_odometer_units);
                tinymce.get('notes').setContent(response.data.notes);

            }
        });

        $("#form-data").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: api_url + "service-item/update",
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