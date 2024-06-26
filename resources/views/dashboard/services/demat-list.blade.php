@extends('dashboard/layouts/dashboard-layout')
@section('main-section')
    <!-- partial -->

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-chart-areaspline"></i>
                </span>Demat
            </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control mb-3">
                            </div>
                            <div class="col-md-4">
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
                                    <th class="">Application Name</th>
                                    <th class="">Mobile</th>
                                    <th class=''>Bank</th>
                                    <th class="">Application Date</th>
                                    <th class="">Status</th>
                                    {{-- <th class="">Application Stage</th> --}}
                                    <th class="">Approval Date</th>
                                    <th class="">Agent Name</th>
                                    <th class="">Remarks</th>
                                    <th class="text-center" id="actionColumn">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
                                     <input type="hidden" class="form-control" id="demat_id">

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
                                     {{-- <div class="form-group pb-2">
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
                                     </div> --}}


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
                 <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="viewModalLabel">Demat Form Details</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 <div class="container">
                                     <div class="row bg-white p-3 rounded-3">
                                         <div class="col-md-12 col-12 border border-2 p-3 rounded-3">
                                             <form class="bg-white">
                                                 <div class="form-group">
                                                     <label for="name">Name:</label>
                                                     <div class="input-group">
                                                         <div class="input-group-prepend">
                                                             <span
                                                                 class="input-group-text bg-gradient-primary text-white p-3">
                                                                 <i class="mdi mdi-account"></i></span>
                                                         </div>
                                                         <input type="text" name="name" id="name"
                                                             class="form-control" disabled />
                                                     </div>
                                                 </div>
                                                 <div class="form-group">
                                                     <label for="pan_num">Pan Number:</label>
                                                     <div class="input-group">
                                                         <div class="input-group-prepend">
                                                             <span
                                                                 class="input-group-text bg-gradient-primary text-white p-3">
                                                                 <i class="mdi mdi-credit-card"></i></span>
                                                         </div>
                                                         <input type="text" name="pan_num" id="pan_num"
                                                             class="form-control" disabled />
                                                     </div>
                                                 </div>
                                                 <div class="form-group">
                                                     <label for="adhar_num">Aadhar Number:</label>
                                                     <div class="input-group">
                                                         <div class="input-group-prepend">
                                                             <span
                                                                 class="input-group-text bg-gradient-primary text-white p-3">
                                                                 <i class="mdi mdi-credit-card-scan"></i></span>
                                                         </div>
                                                         <input type="text" name="adhar_num" id="adhar_num"
                                                             class="form-control" disabled />
                                                     </div>
                                                 </div>
                                                 <div class="form-group">
                                                     <label for="phone">Mobile Number:</label>
                                                     <div class="input-group">
                                                         <div class="input-group-prepend">
                                                             <span
                                                                 class="input-group-text bg-gradient-primary text-white p-3">
                                                                 <i class="mdi mdi-cellphone"></i></span>
                                                         </div>
                                                         <input type="text" name="phone" id="phone"
                                                             class="form-control" disabled />
                                                     </div>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary"
                                     data-bs-dismiss="modal">Close</button>
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
                                 url: "{{ route('getDematTableData') }}",
                                 data: function(d) {
                                     d.search = $('input[type="search"]').val();

                                     var startDate = document.getElementById('start_date');
                                     d.startDate = startDate.value;

                                     var endDate = document.getElementById('end_date');
                                     d.endDate = endDate.value;

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
                                     data: 'phone'
                                 },
                                 {
                                     data: 'bank',
                                     render: function(data, type, row) {
                                         return data.toUpperCase();
                                     }
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
                                 // {
                                 //     data: 'application_stage'
                                 // },
                                 {
                                     data: 'approval_date'
                                 },
                                 {
                                     data: 'demat_refer',
                                     render: function(data, type, row) {
                                         if (data && data.name) { // Check if data and data.name are not null
                                             let {
                                                 name
                                             } = data;
                                             console.log("name", name);
                                             return name.charAt(0).toUpperCase() + name.slice(1);
                                         } else {
                                             return ""; // Return an empty string or handle it as appropriate
                                         }
                                     }
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
                             var dematId = $(this).data("demat-id");
                             viewModal(dematId);
                         });

                         // Function to show modal and fetch crtedit card details
                         function viewModal(dematId) {
                             $.ajax({
                                 url: "demat/" + dematId,
                                 type: "GET",
                                 success: function(response) {

                                     $("#name").val(response.name);
                                     $("#pan_num").val(response.pan_num);
                                     $("#phone").val(response.phone);
                                     $("#adhar_num").val(response.adhar_num);

                                     $("#viewModal").modal("show");
                                 },
                                 error: function(error) {
                                     console.error(error);
                                 },
                             });
                         }

                         $(document).on('click', '.statusButton', function() {
                             var dematId = $(this).data("demat-id");
                             showModal(dematId);
                         });

                         // Function to show modal and fetch crtedit card details
                         function showModal(dematId) {
                             $.ajax({
                                 url: "demat/" + dematId,
                                 type: "GET",
                                 success: function(response) {
                                     console.log(response);

                                     $("#demat_id").val(dematId);

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

                             var dematId = $("#demat_id").val();
                             var formData = $("#statusForm").serialize();

                             $("#submitButton").prop("disabled", true);

                             $.ajax({
                                 url: "demat-update-status/" + dematId,
                                 type: "PATCH",
                                 data: formData,
                                 headers: {
                                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                 },
                                 success: function(response) {
                                     hideModal();
                                     swal({
                                         title: "Demat Status  Updated",
                                         text: "Your Demat status have been successfully updated.",
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
                                     // var currentURL = window.location.href;
                                     // setTimeout(function() {
                                     //     window.location.href = currentURL;
                                     // }, 1000);
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
@endsection
