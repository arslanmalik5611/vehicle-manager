@extends('layout.master')
@section('page_title','Material')

@section('content')
<style>
    
</style>
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Edit </h2>
            </div>
            <div>
                <a href="{{env('BASE_URL').'material'}}" class="btn btn-outline-success btn-sm">Material
                    List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" id="form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label"><span class="required"></span> Name </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label"><span class="required"></span> Number </label>
                    <input type="text" class="form-control" id="number" name="number" placeholder="Enter Number" required>
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label"><span class="required"></span> Manufacturer </label>
                    <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="Enter Manufacturer" required>
                </div>

                <div class="col-md-6">
                    <label for="vendor_id" class="form-label"><span class="required"></span>Vendor </label>
                    <select name="vendor_id" id="vendor_id" class="form-control vendor_id">
                        @foreach ($vendor as $vendors )
                        <option value="{{$vendors['id']}}">{{$vendors['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label"><span class="required"></span> Price </label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" required>
                </div>

                <div class="col-md-6 ">
                    <label for="material_type_id" class="form-label"><span class="required"></span>Type </label>
                    <select name="material_type_id" id="material_type_id" class="form-control material_type_id">
                        @foreach ($material_type as $type )
                        <option value="{{$type['id']}}">{{$type['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="quantity" class="form-label"><span class="required"></span> Quantity </label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <!-- <label for="odo_meter" class="form-label"><span class="required"></span>Image </label> -->
                        <div class="imgUploadDiv ">
                            <br>
                            <input type="file" name="image" id="image2" class="form-control imgUpload">
                            <img class="img-preview" width="100%" style="height: 500px!important;">
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <label for="name" class="form-label">Notes </label>
                    <textarea name="notes" id="notes" class="tinymce"></textarea>
                </div> -->
                <input type="hidden" class="form-control" id="id" name="id" placeholder="">


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
    var id = "{{ request()->id }}";

    $(document).ready(function() {
        $.ajax({
            url: api_url + `material/${id}/show`,
            dataType: "JSON",
            success: function(response) {
                $('#id').val(response.data.id);
                $('#name').val(response.data.name);
                $('#number').val(response.data.number);
                $('#manufacturer').val(response.data.manufacturer);
                $('#price').val(response.data.price);
                $('#quantity').val(response.data.quantity);
                $('.img-preview').attr('src', response.data.image_url);
                $(`#vendor_id option[value=${response.data.vendor_id}]`).prop("selected", true);
                $(`#material_type_id option[value=${response.data.material_type_id}]`).prop("selected", true);

            }
        });
    });

    $("#form-data").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        // name = $("#name").val();

        id = $('#id').val();
        $.ajax({
            url: api_url + "material/update",
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function(data) {
                if (data.status) {
                    success_notify(data.message)
                } else {
                    error_notify(data.message);
                }
            }
        });
    });
    $(document).on('change', '.imgUpload', function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewId = $(input).siblings('.img-preview');
                $(previewId).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection