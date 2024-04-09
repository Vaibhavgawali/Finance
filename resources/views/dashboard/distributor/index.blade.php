@extends('dashboard/layouts/dashboard-layout')
@section('main-section')
    <!-- partial -->

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-card-details"></i>
                </span>Distributor
            </h3>

        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body table-responsive">

                        @if (Auth::user()->hasRole('Superadmin') || Auth::user()->hasRole('Admin') || Auth::user()->can('add_distributor'))
                            <a href="/distributor/create" class="btn btn-primary btn-sm mb-4">Add Distributor</a>
                        @endif

                        <table id='example' class="table table-striped  ">
                            <div class="form-sample">
                            </div>
                            <thead class="">
                                <tr>
                                    <th class="">Sr. No</th>
                                    <th class="">Name</th>
                                    <th class="">Phone</th>
                                    <th class="">User Id</th>
                                    <th class="">Referral Id</th>
                                    <th class="text-center" id="actionColumn">Actions</th>
                                </tr>
                            </thead>
                        </table>

                        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                        <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
                        <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
                        <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {
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
                                        url: "{{ route('getDistributorTableData') }}",
                                        data: function(d) {
                                            d.search = $('input[type="search"]').val();
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
                                            data: 'name',
                                            render: function(data, type, row) {
                                                return data.length > 20 ? data.substring(0, 20) + '...' : data;
                                            }
                                        },
                                        {
                                            data: 'phone',
                                            orderable: false,
                                        },
                                        {
                                            data: 'user_id',
                                        },
                                        {
                                            data: 'referral_id',
                                        },
                                        {
                                            data: 'actions',
                                            orderable: false,
                                            searchable: false
                                        },
                                    ],
                                    createdRow: function(row, data, dataIndex) {
                                        var actionsColumn = $(row).find('td:eq(5)');
                                        actionsColumn.addClass('custom-actions');
                                    },
                                    initComplete: function() {
                                        // Check if action column should be hidden
                                        var userHasRole =
                                            {{ auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin') ? 'true' : 'false' }};

                                        if (!userHasRole) {
                                            $('#actionColumn').hide();
                                        }

                                    }
                                });

                                $('input[type="search"]').on('keyup', function() {
                                    dataTable.ajax.reload();
                                });

                                $(document).on('click', '.editButton', function() {
                                    var userId = $(this).data("user-id");
                                    showModal(userId);
                                });

                                function showModal(userId) {
                                    $.ajax({
                                        url: "get-role/" + userId,
                                        type: "GET",
                                        success: function(response) {
                                            $("#user_id").val(response.user_id);
                                            $("#currentRole").val(response.current_role);

                                            var newRoleDropdown = $("#newRole");

                                            newRoleDropdown.empty();
                                            $.each(response.all_roles, function(index, role) {
                                                var option = $("<option>").val(role).text(role);

                                                if (role === response.current_role) {
                                                    option.prop("selected", true);
                                                }
                                                newRoleDropdown.append(option);
                                            });

                                            $("#editUserModal").modal("show");
                                        },
                                        error: function(error) {
                                            console.error(error);
                                        },
                                    });
                                }

                                // Function to hide modal
                                function hideModal() {
                                    $("#editUserModal").hide();
                                }

                                // Event listener for Close button click
                                $("#closeModal").on("click", function() {
                                    hideModal();
                                });

                                // Event listener for Submit button click
                                $("#editUserRoleForm").submit(function(e) {
                                    e.preventDefault();

                                    var userId = $("#user_id").val();
                                    var formData = $("#editUserRoleForm").serialize();

                                    $.ajax({
                                        url: "assign-role/" + userId,
                                        type: "POST",
                                        data: formData,
                                        headers: {
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                        },
                                        success: function(response) {
                                            hideModal();
                                            userUpdateAlert();
                                            var currentURL = window.location.href;
                                            setTimeout(function() {
                                                window.location.href = currentURL;
                                            }, 2000);
                                        },
                                        error: function(error) {
                                            console.error(error);
                                        },
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
