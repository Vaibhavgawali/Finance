@extends('dashboard/layouts/dashboard-layout')
@section('main-section')
    <!-- partial -->

    @if (auth()->user()->hasRole('Superdmin') ||
            auth()->user()->hasRole('Admin') ||
            auth()->user()->hasRole('Distributor') ||
            auth()->user()->hasRole('Retailer'))
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span><i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row">

                <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/credit-card'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Credit Card'" :totalCountLabel="'Total Count'"
                    :totalCount="$creditCardCount" />
                <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/loan'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Loan'" :totalCountLabel="'Total Count'"
                    :totalCount="$loanCount" />
                <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/demat'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Demat'"
                    :totalCountLabel="'Total Count'" :totalCount="$dematCount" />

                <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/insurance'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Insurance'"
                    :totalCountLabel="'Total Count'" :totalCount="$insuraceCount" />

                {{-- <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Health Insurance'"
                    :totalCountLabel="'Total Count'" :totalCount="0" />
                <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Life Insurance'"
                    :totalCountLabel="'Total Count'" :totalCount="0" />
                <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Motor Insurance'"
                    :totalCountLabel="'Total Count'" :totalCount="0" /> --}}

                @php
                    function generateUniqueSessionId($length)
                    {
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $sessionId = '';
                        for ($i = 0; $i < $length; $i++) {
                            $sessionId .= $characters[rand(0, $charactersLength - 1)];
                        }
                        return $sessionId;
                    }

                    $authuser = auth()->user();

                    $ak = generateUniqueSessionId(rand(10, 15));
                    // echo $ak;

                    $nameParts = explode(' ', $authuser->name, 2);
                    $fname = $nameParts[0];
                    $lname = isset($nameParts[1]) ? $nameParts[1] : '';

                    $json_data = json_encode([
                        'urc' => $authuser->phone,
                        'umc' => '555885',
                        'ak' => $ak,
                        'fname' => $fname,
                        'lname' => $lname,
                        'email' => $authuser->email,
                        'phno' => $authuser->phone,
                        'pin' => $authuser->referral_id,
                        'reqtime' => now()->toDateTimeString(),
                    ]);
                    // echo $json_data;
                    $encrypted_data = base64_encode($json_data);
                @endphp

                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white text-decoration-none">
                        <div class="card-body" id="applyInsuranceLink">

                            <img src="{{ asset('admin-assets/assets/images/dashboard/circle.svg') }}"
                                class="card-img-absolute" alt="circle-image" />

                            <h4 class="font-weight-normal mb-3">Insurance<i
                                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                            </h4>

                            <button type="button" class="btn btn-sm btn-primary mb-4 mt-2 text-white"
                                onclick="storeDataAndRedirect()">Apply</button>

                            <form id="retForm" action="https://www.gibl.in/wallet/validate4/" method="POST"
                                style="display: none">
                                <input type="hidden" name="ret_data" value="<?php echo $encrypted_data; ?>">
                                <button type="submit" onclick="proceedToGIBL()">Apply</button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    function proceedToGIBL() {
                        document.getElementById("retForm").submit();
                    }

                    function storeDataAndRedirect() {
                        var encryptedData = $('input[name="ret_data"]').val();

                        // var encryptedData = '<?php echo $json_data; ?>';
                        console.log(encryptedData);
                        $.ajax({
                            url: '/insurance',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token from meta tag
                            },
                            data: {
                                ret_data: encryptedData
                            },
                            success: function() {
                                proceedToGIBL();
                            },
                            error: function(xhr, status, error) {
                                console.error('Error storing data:', error);
                            }
                        });
                    }
                </script>
            </div>

        </div>
    @endif
@endsection
