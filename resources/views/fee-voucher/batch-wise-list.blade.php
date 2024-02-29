@extends('layout.master')
@section('page_title','Batch wise list')
​
@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-clipboard-list fa-icon"></i> Voucher Batch Wise List </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'fee-vouchers/create'}}" class="btn btn-outline-secondary btn-sm">Generate
                    Voucher</a>
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


            $(document).ready(function () {

                var count = 0;

                var cols = [
                    {
                        title: "SN",
                        render: function (data, type) {
                            return ++count;
                        }
                    },
                    {
                        title: "Batch Number",
                        render: function (data, type, row, meta) {
                            return row.batch_number;
                        }
                    },
                    {
                        title: "Action",
                        data: 'id',
                        render: function (data, type, row, meta) {
                            var actionBtns = '';
                            actionBtns += `<span class="generateFeeVoucher" data-batch-number="${row.batch_number}" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Click to see Voucher"> <i class="fas fa-download fa-2x text-info"></i> </span> `;
                            return actionBtns;
                        }
                    }
                ];

                $.ajax({
                    url: api_url+'fee-vouchers/batch-wise-voucher',
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

            $(document).on('click', '.generateFeeVoucher', function (e) {
                e.preventDefault();
                generate_voucher_batch_no_pdf($(this).attr('data-batch-number'));
            });
        });
    </script>
@endsection
