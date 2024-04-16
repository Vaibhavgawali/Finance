@extends('dashboard/layouts/dashboard-layout')
@section('main-section')
    <!-- partial -->

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-currency-inr"></i>
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

                        <!-- Modal -->
                        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog"
                            aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Loan Application Form</h5>
                                        <button type="button" class="close close-btn" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body bg-white">
                                        <form class="">
                                            <!-- One "tab" for each step in the form: -->
                                            <div class="tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="loan_type">Loan Type</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i class="mdi mdi-cash-multiple"></i></span>
                                                                </div>
                                                                <select name="loan_type" id="loan_type"
                                                                    class="form-control p-3">
                                                                    <option value="null" selected disabled>
                                                                        --Select Loan Type--
                                                                    </option>
                                                                    <option value="Home Loan">Home Loan</option>
                                                                    <option value="Business Loan">Business Loan</option>
                                                                    <option value="Personal Loan">Personal Loan</option>
                                                                    <option value="Vehicle Loan">Vehicle Loan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i class="mdi mdi-account"></i></span>
                                                                </div>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control" placeholder="Name" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i class="mdi mdi-email"></i></span>
                                                                </div>
                                                                <input type="text" name="email" id="email"
                                                                    class="form-control" placeholder="Email" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mobile">Mobile</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i class="mdi mdi-cellphone"></i></span>
                                                                </div>
                                                                <input type="text" name="mobile" id="mobile"
                                                                    class="form-control" placeholder="Mobile Number" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="income_source">Income Source</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i class="mdi mdi-hospital-building"></i></span>
                                                                </div>
                                                                <select name="income_source" id="income_source"
                                                                    class="form-control p-3">
                                                                    <option value="" selected disabled>
                                                                        --Select Income Source--
                                                                    </option>
                                                                    <option value="Salaried">Salaried</option>
                                                                    <option value="Business">Business</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="monthly_income">Monthly Income</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i class="mdi mdi-cards"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="monthly_income" id="monthly_income"
                                                                    placeholder="Monthly Income" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pincode">Pincode</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i
                                                                            class="mdi mdi-google-maps
                                                                        "></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="pincode"
                                                                    id="pincode" placeholder="Pincode" />
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="dob">Date of Birth</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i
                                                                            class="mdi mdi-calendar
                                                                        "></i></span>
                                                                </div>
                                                                <input type="text" placeholder="Date of Birth"
                                                                    onfocus="(this.type='date')"
                                                                    onblur="(this.type='text')" class="form-control"
                                                                    name="dob" id="dob" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pan_num">Pancard</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i
                                                                            class="mdi mdi-credit-card
                                                                        "></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" name="pan_num"
                                                                    id="pan_num" placeholder="Pancard" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="marital_status">Marital Status</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i
                                                                            class="mdi mdi-account-multiple
                                                                        "></i></span>
                                                                </div>
                                                                <select name="marital_status" id="marital_status"
                                                                    class="form-control p-3">
                                                                    <option value="null" selected disabled>--Select
                                                                        Marital
                                                                        Status--</option>
                                                                    <option value="married">Married</option>
                                                                    <option value="unmarried">Unmarried</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="adhar_num">Adhar Card Number</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i
                                                                            class="mdi mdi-credit-card-scan
                                                                        "></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="adhar_num" id="adhar_num"
                                                                    placeholder="Adhar Card Number" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="loan_amount">Loan Amount</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i
                                                                            class="mdi mdi-cash-100
                                                                        "></i></span>
                                                                </div>
                                                                <input type="text" class="loan_amount form-control"
                                                                    name="loan_amount" id="loan_amount"
                                                                    placeholder="Loan Amount" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="credit_score">Credit Score</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i
                                                                            class="mdi mdi-credit-card
                                                                        "></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="credit_score" id="credit_score"
                                                                    placeholder="Credit Score" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mother_name">Mother's Name</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-gradient-primary text-white p-3">
                                                                        <i
                                                                            class="mdi mdi-account
                                                                        "></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="mother_name" id="mother_name"
                                                                    placeholder="Mother's Name" />
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="tab">
                                                <div class="row">
                                                    <div class="col-12 mb-1">
                                                        <label for="" class="text-left fs-bold fs-3 my-3">Present
                                                            Address</label>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="form-group pb-3">
                                                            <label for="present_line1">Address Line 1</label>
                                                            <textarea name="present_line1" id="present_line1" class="form-control" cols="1" rows="1"
                                                                placeholder="Address Line 1"></textarea>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label for="present_line2">Address Line 2</label>
                                                            <textarea name="present_line2" id="present_line2" class="form-control" cols="1" rows="1"
                                                                placeholder="Address Line 2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="form-group pb-3">
                                                            <label for="present_line3">Address Line 3</label>
                                                            <textarea name="present_line3" id="present_line3" class="form-control" cols="1" rows="1"
                                                                placeholder="Address Line 3"></textarea>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label for="present_landmark">Landmark</label>
                                                            <input class="form-control" type="text"
                                                                name="present_landmark" id="present_landmark"
                                                                placeholder="Landmark">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="form-group pb-3">
                                                            <label for="present_state">State</label>
                                                            <input class="form-control" type="text"
                                                                name="present_state" id="present_state"
                                                                placeholder="State">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label for="present_city">City</label>
                                                            <input class="form-control" name="present_city"
                                                                id="present_city" type="text" placeholder="City">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="form-group pb-3">
                                                            <label for="present_pincode">Pincode</label>
                                                            <input class="form-control" name="present_pincode"
                                                                id="present_pincode" type="text"
                                                                placeholder="Pincode">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label for="present_phone">Phone Number</label>
                                                            <input class="form-control" name="present_phone"
                                                                id="present_phone" type="number"
                                                                placeholder="Phone Number">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab">
                                                <div class="row">
                                                    <div class="col-12 mb-1">
                                                        <label for="" class="text-left fs-bold fs-3 mb-3">Office
                                                            Address</label>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="form-group pb-3">
                                                            <label for="office_line1">Address Line 1</label>
                                                            <textarea name="office_line1" id="office_line1" class="form-control" cols="1" rows="1"
                                                                placeholder="Address Line 1"></textarea>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label for="office_line2">Address Line 2</label>
                                                            <textarea name="office_line2" id="office_line2" class="form-control" cols="1" rows="1"
                                                                placeholder="Address Line 2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="form-group pb-3">
                                                            <label for="office_line3">Address Line 3</label>
                                                            <textarea name="office_line3" id="office_line3" class="form-control" cols="1" rows="1"
                                                                placeholder="Address Line 3"></textarea>
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label for="office_landmark">Landmark</label>
                                                            <input class="form-control" type="text"
                                                                name="office_landmark" id="office_landmark"
                                                                placeholder="Landmark">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="form-group pb-3">
                                                            <label for="office_state">State</label>
                                                            <input class="form-control" type="text"
                                                                name="office_state" id="office_state"
                                                                placeholder="State">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label for="office_city">City</label>
                                                            <input class="form-control" name="office_city"
                                                                id="office_city" type="text" placeholder="City">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="form-group pb-3">
                                                            <label for="office_pincode">Pincode</label>
                                                            <input class="form-control" name="office_pincode"
                                                                id="office_pincode" type="text" placeholder="Pincode">
                                                        </div>
                                                        <div class="form-group pb-3">
                                                            <label for="office_phone">Phone Number</label>
                                                            <input class="form-control" name="office_phone"
                                                                id="office_phone" type="number"
                                                                placeholder="Phone Number">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab">
                                                <div class="row">
                                                    <div class="flex justify-center items-center bg-gray-200 h-screen">
                                                        <div class="w-96 p-4 shadow rounded-md bg-white">
                                                            <label for="upload_document"
                                                                class="text-left fs-bold fs-3 my-3 mx-2">Uploaded
                                                                Document</label>
                                                            <select name="document_type" id="document_type"
                                                                class="p-3">
                                                                <option value="" selected disabled>--Select
                                                                    Document--</option>
                                                                <option value="pancard">Pancard</option>
                                                                <option value="adhar_front">Adhar Card Front</option>
                                                                <option value="adhar_back">Adhar Card Back</option>
                                                                <option value="other">Other</option>
                                                            </select>
                                                            <div class="mt-4">
                                                                <a href="#" id="upload_document" target="_blank"
                                                                    class="btn btn-primary">View</a>
                                                            </div>
                                                            <div class="mt-4">
                                                                <a href="#" id="download_upload_document" download
                                                                    class="btn btn-primary">Download</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary close-btn"
                                            data-dismiss="modal">Close</button>
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

                                $(document).on('click', '.viewButton', function() {
                                    var loanId = $(this).data("loan-id");
                                    viewModal(loanId);
                                });
                                $(document).on('click', '.close-btn', function() {
                                    $('#viewModal').modal('hide');
                                    $('input, textarea, select').prop('disabled', false);

                                })

                                // Function to show modal and fetch loan details
                                function viewModal(loanId) {

                                    $('input, textarea, select').prop('disabled', true);

                                    $('input, textarea').removeAttr('name placeholder');
                                    $('select').removeAttr('name');

                                    $('input[type="date"]').removeAttr('placeholder');

                                    $.ajax({
                                        url: "loan/" + loanId,
                                        type: "GET",
                                        success: function(response) {
                                            console.log(response)

                                            $("#loan_type").val(response.loan_type);
                                            $("#name").val(response.name);
                                            $("#email").val(response.email);
                                            $("#mobile").val(response.mobile);
                                            $("#income_source").val(response.income_source);
                                            $("#monthly_income").val(response.monthly_income);
                                            $("#pincode").val(response.pincode);

                                            $("#dob").val(response.dob);
                                            $("#pan_num").val(response.pan_num);
                                            $("#marital_status").val(response.marital_status);
                                            $("#adhar_num").val(response.adhar_num);
                                            $("#loan_amount").val(response.loan_amount);
                                            $("#credit_score").val(response.credit_score);
                                            $("#mother_name").val(response.mother_name);

                                            $("#present_line1").val(response.loan_address.present_line1);
                                            $("#present_line2").val(response.loan_address.present_line2);
                                            $("#present_line3").val(response.loan_address.present_line3);
                                            $("#present_landmark").val(response.loan_address.present_landmark);
                                            $("#present_state").val(response.loan_address.present_state);
                                            $("#present_city").val(response.loan_address.present_city);
                                            $("#present_pincode").val(response.loan_address.present_pincode);
                                            $("#present_phone").val(response.loan_address.present_phone);
                                            $("#office_line1").val(response.loan_address.office_line1);
                                            $("#office_line2").val(response.loan_address.office_line2);
                                            $("#office_line3").val(response.loan_address.office_line3);
                                            $("#office_landmark").val(response.loan_address.office_landmark);
                                            $("#office_state").val(response.loan_address.office_state);
                                            $("#office_city").val(response.loan_address.office_city);
                                            $("#office_pincode").val(response.loan_address.office_pincode);
                                            $("#office_phone").val(response.loan_address.office_phone);

                                            $("#document_type").val(response.document_type);
                                            console.log(response.document_type)

                                            var fileUrl = "{{ asset('storage/loan/') }}/" + response.upload_document;
                                            $("#upload_document, #download_upload_document").attr("href", fileUrl);

                                            $("#viewModal").modal("show");
                                        },
                                        error: function(error) {
                                            console.error(error);
                                        },
                                    });
                                }

                                $(document).on('click', '.statusButton', function() {
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
                                            hideModal();

                                            swal({
                                                title: "Loan Status  Updated",
                                                text: "Your Loan status have been successfully updated.",
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
