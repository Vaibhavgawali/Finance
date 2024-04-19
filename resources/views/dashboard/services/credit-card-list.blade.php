@extends('dashboard/layouts/dashboard-layout')
@section('main-section')
<!-- partial -->

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-credit-card-multiple"></i>
            </span>Credit Card
        </h3>

    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">Bank</label>
                                <select class="form-control form-control-sm" name="filterbybank" id="filterbybank">
                                    <option value="" selected disabled>--Select --</option>
                                    <option value="">All</option>
                                    <option value="HDFC Bank">HDFC Bank</option>
                                    <option value="IDFC Bank">IDFC Bank</option>
                                    <option value="IndusInd Bank">IndusInd Bank</option>
                                    <option value="Bajaj RBL SuperCard">Bajaj RBL SuperCard</option>
                                    <option value="SBI Bank">SBI Bank</option>
                                    <option value="AU Bank">AU Bank</option>
                                </select>
                            </div>




                        </div>
                        <div class="col-md-4">
                            <label for="start_date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>
                    </div>

                    <table id='Credit_Card' class="table table-striped  ">
                        <div class="form-sample">
                        </div>
                        <thead class="">
                            <tr>
                                <th class="">Sr. No</th>
                                <th class="">Application Name</th>
                                <th class="">Mobile</th>
                                <th class="">Application Date</th>
                                <th class="">Status</th>
                                <th class="">Application Stage</th>
                                <th class="">Approval Date</th>
                                <th class="">Agent Name</th>
                                <th class="">Bank</th>
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
                                        <input type="hidden" class="form-control" id="credit_card_id">

                                        <div class="form-group pb-2">
                                            <label for="status">Status :</label>
                                            <select class="form-control p-3" id="status" name="status">
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
                                            <select class="form-control p-3" id="application_stage"
                                                name="application_stage">
                                                <option value="">-- Select --</option>
                                                <option value="Initiated">Initiated</option>
                                                <option value="Login">Login</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Disbursed">Disbursed</option>
                                                <option value="Rejected">Rejected</option>
                                                <option value="Revoked">Revoked</option>
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
                                            <input type="text" class="form-control" id="remark" name="remark">
                                        </div>

                                        <button type="submit" class="btn btn-primary" id="submitButton">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="statusModal"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel">View Application</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body bg-white">
                                    <form>
                                        <div class="row">
                                            <h3 class="my-3">User Details</h3>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-gradient-primary text-white p-3">
                                                                <i class="mdi mdi-account"></i></span>
                                                        </div>
                                                        <input type="text" id="name" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="pan_num">Pan Number</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-gradient-primary text-white p-3"><i
                                                                    class="mdi mdi-credit-card"></i></span>
                                                        </div>
                                                        <input type="text" id="pan_num" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="email">Email</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-gradient-primary text-white p-3"><i
                                                                    class="mdi mdi-email"></i></span>
                                                        </div>
                                                        <input type="text" id="email" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="annual_income">Net Annual Income</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-gradient-primary text-white p-3"><i
                                                                    class="mdi mdi-currency-inr"></i></span>
                                                        </div>
                                                        <input type="text" id="annual_income" class="form-control"
                                                            disabled>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="adhar_num">Adhar Number</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-gradient-primary text-white p-3"><i
                                                                    class="mdi mdi-account-card-details"></i></span>
                                                        </div>
                                                        <input type="text" id="adhar_num" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="card">Card</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-gradient-primary text-white p-3"><i
                                                                    class="mdi mdi-account-card-details"></i></span>
                                                        </div>
                                                        <input type="text" id="card" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="mobile">Mobile Number</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-gradient-primary text-white p-3"><i
                                                                    class="mdi mdi-cellphone"></i></span>
                                                        </div>
                                                        <input type="text" id="mobile" class="form-control" disabled>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="residence_address">Residence Address</label>
                                                    <div class="input-group">

                                                        <textarea class="form-control" id="residence_address" rows="3"
                                                            disabled></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="office_address">Office Address</label>
                                                    <div class="input-group">

                                                        <textarea class="form-control" id="office_address" rows="3"
                                                            disabled></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="my-3">User Documents</h3>
                                            <div class="col-lg-4 stretch-card grid-margin">
                                                <div class="card bg-gradient-primary card-img-holder text-white">
                                                    <div class="card-body">
                                                        <img src="{{ asset('admin-assets/assets/images/dashboard/circle.svg') }}"
                                                            class="card-img-absolute" alt="circle-image">
                                                        <h4 class="font-weight-normal mb-2">
                                                        </h4>
                                                        <h2 class="mb-2">Pancard File</h2>
                                                        <div class="d-flex gap-3">
                                                            <a href="" target="_blank" id="pancardLink"
                                                            class="btn btn-gradient-secondary btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>View</a>
                                                            <a href="" target="_blank" download id="pancardDownload"
                                                            class="btn btn-gradient-danger btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 stretch-card grid-margin">
                                                <div class="card bg-gradient-secondary card-img-holder text-white">
                                                    <div class="card-body ">
                                                        <img src="{{ asset('admin-assets/assets/images/dashboard/circle.svg') }}"
                                                            class="card-img-absolute" alt="circle-image">
                                                        <h4 class="font-weight-normal mb-2">
                                                        </h4>
                                                        <h2 class="mb-2">Aadhar Front File</h2>
                                                        <div class="d-flex gap-3">
                                                            <a href="" target="_blank" id="aadharFrontLink"
                                                            class="btn btn-gradient-success btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>View</a>
                                                            <a href="" target="_blank" download id="aadharFrontDownload"
                                                            class="btn btn-gradient-danger btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 stretch-card grid-margin">
                                                <div class="card bg-gradient-success card-img-holder text-white">
                                                    <div class="card-body">
                                                        <img src="{{ asset('admin-assets/assets/images/dashboard/circle.svg') }}"
                                                            class="card-img-absolute" alt="circle-image">
                                                        <h4 class="font-weight-normal mb-2">
                                                        </h4>
                                                        <h2 class="mb-2">Aadhar Back File</h2>
                                                        <div class="d-flex gap-3">
                                                            <a href="" target="_blank" id="aadharBackLink"
                                                            class="btn btn-gradient-warning btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>View</a>
                                                            <a href="" target="_blank" download id="aadharBackDownload"
                                                            class="btn btn-gradient-danger btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 stretch-card grid-margin">
                                                <div class="card bg-gradient-warning card-img-holder text-white">
                                                    <div class="card-body">
                                                        <img src="{{ asset('admin-assets/assets/images/dashboard/circle.svg') }}"
                                                            class="card-img-absolute" alt="circle-image">
                                                        <h4 class="font-weight-normal mb-2">
                                                        </h4>
                                                        <h2 class="mb-2">ITR (1,2 year)</h2>
                                                        <div class="d-flex gap-3">
                                                            <a href="" target="_blank" id="itrLink"
                                                            class="btn btn-gradient-info btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>View</a>
                                                            <a href="" target="_blank" download id="itrDownload"
                                                            class="btn btn-gradient-danger btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 stretch-card grid-margin">
                                                <div class="card bg-gradient-info card-img-holder text-white">
                                                    <div class="card-body">
                                                        <img src="{{ asset('admin-assets/assets/images/dashboard/circle.svg') }}"
                                                            class="card-img-absolute" alt="circle-image">
                                                        <h4 class="font-weight-normal mb-2">
                                                        </h4>
                                                        <h2 class="mb-2">Bank Statement <div class="card-text fs-6">
                                                                (last 6
                                                                month)</div>
                                                        </h2>

                                                        <div class="d-flex gap-3">
                                                            <a href="" target="_blank" id="bankStatementLink"
                                                            class="btn btn-gradient-light btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>View</a>
                                                            <a href="" target="_blank" download id="bankStatementDownload"
                                                            class="btn btn-gradient-danger btn-icon-text">
                                                            <i class="mdi mdi-file-check btn-icon-prepend"></i>Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
                        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

                    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js">
                    </script>
                    <script type="text/javascript" charset="utf8"
                        src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
                    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

                    <script type="text/javascript">
                        $(document).ready(function() {
                                // Declare table variable in a wider scope
                                var table = $('#Credit_Card').DataTable({
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
                                        url: "{{ route('getCreditCardTableData') }}",
                                        data: function(d) {
                                            d.search = $('input[type="search"]').val();

                                            var bankFilter = document.getElementById('filterbybank');
                                            d.bankFilter = bankFilter.value;

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
                                            data: 'created_at',
                                            render: function(data, type, row) {
                                                return new Date(row.created_at).toISOString()
                                                    .split('T')[0];
                                            }
                                        },
                                        {
                                            data: 'status'
                                        },
                                        {
                                            data: 'application_stage'
                                        },
                                        {
                                            data: 'approval_date'
                                        },
                                        {
    data: 'credit_card_refer',
    render: function(data, type, row) {
        if (data && data.name) { // Check if data and data.name are not null
            let {name} = data;
            console.log("name", name);
            return name.charAt(0).toUpperCase() + name.slice(1);
        } else {
            return ""; // Return an empty string or handle it as appropriate
        }
    }
},

                                        {
                                            data: 'card'
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

                                $('#filterbybank').on('change', function() {
                                    // Reload the DataTable when the filter value changes
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

                                $(document).on('click', '.viewButton', function() {
                                    var creditCardId = $(this).data("credit-card-id");
                                    viewModal(creditCardId);
                                });

                                // Function to show modal and fetch crtedit card details
                                function viewModal(creditCardId) {
                                    $.ajax({
                                        url: "/credit-card/" + creditCardId,
                                        type: "GET",
                                        success: function(response) {
                                            // console.log(response);

                                            $("#name").val(response.name);
                                            $("#card").val(response.card);
                                            $("#pan_num").val(response.pan_num);
                                            $("#adhar_num").val(response.adhar_num);
                                            $("#email").val(response.email);
                                            $("#mobile").val(response.mobile);
                                            $("#annual_income").val(response.annual_income);
                                            $("#residence_address").val(response.residence_address);
                                            $("#office_address").val(response.office_address);

                                            // Function to update file links
                                            function updateFileLink(linkId, fileName) {
                                                var fileUrl = "{{ asset('storage/credit-card/') }}/" + fileName;
                                                $(linkId).attr("href", fileUrl);
                                            }

                                            // Inside the success callback of your AJAX request
                                            updateFileLink("#pancardLink", response.pan_file);
                                            updateFileLink("#pancardDownload", response.pan_file);
                                            updateFileLink("#aadharFrontLink", response.adhar_front_file);
                                            updateFileLink("#aadharDownload", response.adhar_front_file);
                                            updateFileLink("#aadharBackLink", response.adhar_back_file);
                                            updateFileLink("#aadharDownload", response.adhar_back_file);
                                            updateFileLink("#itrLink", response.itr_file);
                                            updateFileLink("#itrDownload", response.itr_file);
                                            updateFileLink("#bankStatementLink", response.bank_statement_file);
                                            updateFileLink("#bankStatementDownload", response.bank_statement_file);

                                            $("#viewModal").modal("show");
                                        },
                                        error: function(error) {
                                            console.error(error);
                                        },
                                    });
                                }

                                $(document).on('click', '.statusButton', function() {
                                    var creditCardId = $(this).data("credit-card-id");
                                    showModal(creditCardId);
                                });

                                // Function to show modal and fetch crtedit card details
                                function showModal(creditCardId) {
                                    $.ajax({
                                        url: "credit-card/" + creditCardId,
                                        type: "GET",
                                        success: function(response) {
                                            $("#credit_card_id").val(creditCardId);

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

                                    var creditCardId = $("#credit_card_id").val();
                                    var formData = $("#statusForm").serialize();

                                    $("#submitButton").prop("disabled", true);

                                    $.ajax({
                                        url: "credit-card-update-status/" + creditCardId,
                                        type: "PATCH",
                                        data: formData,
                                        headers: {
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                        },
                                        success: function(response) {
                                            hideModal();

                                            swal({
                                                title: "Credit Card Status  Updated",
                                                text: "Your credit card status have been successfully updated.",
                                                icon: "success",
                                                buttons: {
                                                    confirm: {
                                                        text: "OK",
                                                        value: true,
                                                        visible: true,
                                                        className: "swal-button--confirm",
                                                        closeModal: true
                                                    }
                                                },
                                                closeOnClickOutside: false // Prevent closing on click outside
                                            }).then((willRefresh) => {
                                                if (willRefresh) {
                                                    location.reload(); // Reload the page
                                                }
                                            });

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