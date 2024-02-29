@extends('layout.master')
@section('page_title','Fee Structure Edit')

@section('content')
    <style>
        .left-side {
            max-height: 420px;
            overflow: auto;
        }
    </style>
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-edit fa-icon"></i> Edit </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'fee-structures'}}" class="btn btn-outline-success btn-sm">Fee Structure
                        List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="name" class="form-label"><span class="required">*</span> Name </label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Enter Name" required>
                            </div>
                        </div><!--End of row-->

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="name" class="form-label">Notes </label>
                                <textarea name="notes" id="notes" class="tinymce"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 left-side">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr class="colored-bg">
                                <th style="width: 260px">
                                    <label for="fee_head_id" class="form-label">Fee Head </label>
                                </th>
                                <th>
                                    <label for="total-amount" class="form-label">Amount </label>
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 260px">
                                    <select name="fee_head_id" id="fee_head_id" class="fee_head_id select2"></select>
                                </th>
                                <th>
                                    <input type="number" class="form-control total-amount" name="total-amount">
                                </th>
                                <th>
                                    <span id="addMoreBtn" data-bs-toggle="tooltip"
                                          data-bs-placement="bottom"
                                          title="Add More Row" class="fa fa-plus-circle fa-2x text-primary">
                                                    </span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="mainBody">

                            </tbody>
                        </table>
                    </div>
                    <div class="total-show d-flex justify-content-end mb-3">
                        <span>Total :</span> <input type="number" class="form-control" id="totalShow" readonly>
                    </div>
                </div>


                <div class="card-footer text-end">
                    <input type="hidden" name="id" id="id">
                    <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i
                            class="fas fa-chevron-right ms-3 go-icon"></i> <i
                            class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        tinymce_initialize(200);
        var id = "{{ request()->id }}";

        $(document).ready(function () {

            fee_heads_load();
            fee_structure_manage();

            $.ajax({
                url: api_url + `fee-structures/${id}/show`,
                dataType: "JSON",
                success: function (response) {
                    $('#id').val(response.data.id);
                    $('#name').val(response.data.name);
                    // $('#notes').val(response.data.notes);
                    if (response.data.notes)
                        tinymce.get('notes').setContent(response.data.notes);


                    var mainTr = '';
                    $(response.data.fee_structure_detail).each(function (i, data) {
                        console.log(data)
                        mainTr = `<tr class="mainTr">
                        <td> <input type="hidden" name="fee_head_id_input" class="fee_head_id_input" value="${data.fee_head.id}" data-id="${data.fee_head.id}"> ${data.fee_head.name}</td>
                        <td> <input type="number" name="amount" class="amount form-control" value="${data.amount}" data-amount="${data.amount}"></td>
                         <td><span class="removeBtn btnRemoveFee fa fa-times-circle fa-2x text-danger" data-id="${data.id}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete This Record"></span></td>
                        </tr>`;
                        $('.mainBody').append(mainTr);


                        $('#totalShow').val(calaulate_total());
                    });
                }
            });

            $(document).on('change keydown keyup', '.amount', function (e) {
                $('#totalShow').val(calaulate_total());
            });

            $(document).on('click', '.btnRemoveFee', function (e) {
                e.preventDefault();
                var thisElem = $(this);
                var id = $(thisElem).attr('data-id');
                $.ajax({
                    url: api_url + "fee-structures/delete-fee-structure-detail",
                    type: "POST",
                    data: {'id': id},
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) {
                            $(thisElem).parents('.mainTr').remove();
                            $('#totalShow').val(calaulate_total());
                            success_notify(data.message)
                        } else {
                            error_notify(data.message);
                        }
                    }
                });
            });
        });


        $("#form-data").on('submit', function (e) {

            name = $("#name").val();
            key = $("#key").val();
            notes = tinymce.get('notes').getContent();
            e.preventDefault();
            $.ajax({
                url: api_url + "fee-structures/update",
                type: "POST",
                data: JSON.stringify(getFormData()),
                contentType: "application/json",
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

        function getFormData() {
            var fee_structure_detail = '';
            var data = {
                'id': id,
                'name': $('#name').val(),
                'notes': $('#notes').val(),
                'fee_structure_details': []
            }

            $('.amount').each(function () {
                fee_structure_detail = {
                    'amount': $(this).val(),
                    'fee_head_id': $(this).parents('tr').find('.fee_head_id_input').val()
                }
                data.fee_structure_details.push(fee_structure_detail);
            });
            return data;
        }

    </script>
@endsection

