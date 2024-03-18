@extends('layout.master')
@section('page_title','Driver Edit')

@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Edit </h2>
            </div>
            <div>
                <a href="{{env('BASE_URL').'driver'}}" class="btn btn-outline-success btn-sm">Driver
                    List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" id="form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label"><span class="required"></span> Name </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required value="{{$Driver->name}}">
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

        // $(document).ready(function () {
        //     $.ajax({
        //         url: api_url + `driver/${id}/show`,
        //         dataType: "JSON",
        //         success: function (response) {
        //             $('#name').val(response.data.name);
        //         }
        //     });
        // });

        $("#form-data").on('submit', function (e) {
            e.preventDefault();
            name = $("#name").val();
            
            id = "{{ request()->id }}";
            $.ajax({
                url: api_url + "driver/update",
                type: "POST",
                data: {'id': id, 'name': name},
                dataType: "JSON",
                success: function (data) {
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

