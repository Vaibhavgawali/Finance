@extends('dashboard/layouts/dashboard-layout')
@section('main-section')
    <!-- partial -->

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-card-details"></i>
                </span>Loan
            </h3>

        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect3">Status</label>
                                    <select class="form-control form-control-sm" name="filterbyStatus" id="filterbyStatus">
                                        <option value="" selected disabled>--Select --</option>
                                        <option value="">All</option>
                                        <option value="Initiated">Initiated</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect3">Income Source</label>
                                    <select class="form-control form-control-sm" name="filterbyIncomeSource"
                                        id="filterbyIncomeSource">
                                        <option value="" selected disabled>--Select --</option>
                                        <option value="">All</option>
                                        <option value="Salaried">Salaried</option>
                                        <option value="Business">Business</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date">End Date:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control">
                            </div>
                        </div>

                        <table id='example' class="table table-striped  ">
                            <div class="form-sample">
                            </div>
                            <thead class="">
                                <tr>
                                    <th class="">Sr. No</th>
                                    <th class="">Name</th>
                                    <th class="">Mobile</th>
                                    <th class="">Loan Amount</th>
                                    <th class="">Loan Type</th>
                                    <th class="">Income Source</th>
                                    <th class="">Status</th>
                                    <th class="">Applied Date</th>
                                    <th class="">Applied By</th>
                                    <th class="">Application Stage</th>
                                    <th class="">Approval Date</th>
                                    <th class="">Remarks</th>
                                    <th class="text-center" id="actionColumn">Actions</th>
                                </tr>
                            </thead>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModal"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="statusModalLabel">Edit Application Status</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="statusForm">
                                            <input type="hidden" class="form-control" id="loan_id">

                                            <div class="form-group pb-2">
                                                <label for="status">Status :</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="">-- Select --</option>
                                                    <option value="Initiated">Initiated</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Rejected">Rejected</option>
                                                </select>
                                            </div>

                                            <!-- Select tags -->
                                            <div class="form-group pb-2">
                                                <label for="application_stage">Application Stage :</label>
                                                <select class="form-control" id="application_stage"
                                                    name="application_stage">
                                                    <option value="">-- Select --</option>
                                                    <option value="Initial">Initial</option>
                                                    <option value="Processing">Processing</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>

                                            <!-- Date input -->
                                            <div class="form-group">
                                                <label for="approval_date">Approval Date :</label>
                                                <input type="date" class="form-control" id="approval_date"
                                                    name="approval_date">
                                            </div>

                                            <div class="form-group">
                                                <label for="remark">Remarks :</label>
                                                <input type="text" class="form-control" id="remark"
                                                    name="remark">
                                            </div>

                                            <button type="submit" class="btn btn-primary"
                                                id="submitButton">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                        <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
                        <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
                        <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                // Declare table variable in a wider scope
                                var table = $('#example').DataTable({
                                    dom: "lBfrtip",
                                    buttons: [{
                                            extend: 'excelHtml5',
                                            className: 'btn btn-sm mx-3 btn-primary',
                                            id: "download_to_excel",
                                            exportOptions: {
                                                columns: ':not(#actionColumn)'
                                            }
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            className: 'btn btn-sm mx-3 btn-primary',
                                            id: 'download_to_pdf',
                                            exportOptions: {
                                                columns: ':not(#actionColumn)'
                                            }
                                        }
                                    ],
                                    processing: true,
                                    serverSide: true,
                                    ajax: {
                                        url: "{{ route('getLoanTableData') }}",
                                        data: function(d) {
                                            d.search = $('input[type="search"]').val();

                                            var statusFilter = document.getElementById('filterbyStatus');
                                            d.statusFilter = statusFilter.value;

                                            var incomeSourecFilter = document.getElementById('filterbyIncomeSource');
                                            d.incomeSourecFilter = incomeSourecFilter.value;

                                            var startDate = document.getElementById('start_date');
                                            d.startDate = startDate.value;

                                            var endDate = document.getElementById('end_date');
                                            d.endDate = endDate.value;

                                            // Return the data object
                                            return d;

                                        }
                                    },
                                    columns: [{
                                            data: 'DT_RowIndex',
                                            name: 'DT_RowIndex',
                                            orderable: true,
                                            searchable: false,
                                            className: 'text-center'
                                        },
                                        {
                                            data: 'name'
                                        },
                                        {
                                            data: 'mobile'
                                        },
                                        {
                                            data: 'loan_amount'
                                        },
                                        {
                                            data: 'loan_type'
                                        },
                                        {
                                            data: 'income_source'
                                        },
                                        {
                                            data: 'status'
                                        },
                                        {
                                            data: 'created_at',
                                            render: function(data, type, row) {
                                                return new Date(row.created_at).toISOString()
                                                    .split('T')[0];
                                            }
                                        },
                                        {
                                            data: 'loan_refer',
                                            render: function(data, type, row) {
                                                var firstWord = data.name.split(' ')[0];
                                                return firstWord.charAt(0).toUpperCase() + firstWord.slice(1);
                                            }
                                        },
                                        {
                                            data: 'application_stage'
                                        },
                                        {
                                            data: 'approval_date'
                                        },
                                        {
                                            data: 'remark'
                                        },
                                        {
                                            data: 'actions'
                                        },
                                    ],
                                    initComplete: function() {
                                        // Check if action column should be hidden
                                        var userHasRole =
                                            {{ auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin') ? 'true' : 'false' }};

                                        if (!userHasRole) {
                                            $('#actionColumn').hide();
                                        }

                                    }
                                });

                                $('#filterbyStatus').on('change', function() {
                                    table.ajax.reload();
                                });

                                $('#filterbyIncomeSource').on('change', function() {
                                    table.ajax.reload();
                                });

                                $('#start_date').on('change', function() {
                                    table.ajax.reload();
                                });

                                $('#end_date').on('change', function() {
                                    table.ajax.reload();
                                });

                                $('input[type="search"]').on('keyup', function() {
                                    dataTable.ajax.reload();
                                });

                                $(document).on('click', '.editButton', function() {
                                    var loanId = $(this).data("loan-id");
                                    showModal(loanId);
                                });

                                // Function to show modal and fetch crtedit card details
                                function showModal(loanId) {
                                    $.ajax({
                                        url: "loan/" + loanId,
                                        type: "GET",
                                        success: function(response) {
                                            $("#loan_id").val(loanId);

                                            $("#status").val(response.status);
                                            $("#application_stage").val(response.application_stage);
                                            $("#approval_date").val(response.approval_date);
                                            $("#remark").val(response.remark);

                                            $("#statusModal").modal("show");
                                        },
                                        error: function(error) {
                                            console.error(error);
                                        },
                                    });
                                }

                                // Event listener for Submit button click
                                $("#statusForm").submit(function(e) {
                                    e.preventDefault();

                                    var loanId = $("#loan_id").val();

                                    var formData = $("#statusForm").serialize();

                                    $("#submitButton").prop("disabled", true);

                                    $.ajax({
                                        url: "loan/" + loanId,
                                        type: "PATCH",
                                        data: formData,
                                        headers: {
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                        },
                                        success: function(response) {
                                            // hideModal();
                                            var currentURL = window.location.href;
                                            setTimeout(function() {
                                                window.location.href = currentURL;
                                            }, 1000);
                                        },
                                        error: function(error) {
                                            console.error(error);
                                        },
                                    });
                                });

                                // Function to hide modal
                                function hideModal() {
                                    $("#statusModal").hide();
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
