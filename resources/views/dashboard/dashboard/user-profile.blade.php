@extends('dashboard/layouts/dashboard-layout')
@section('main-section')
    <!-- partial -->

    <div class="content-wrapper">
        <div class="page-header">
            <div class="container">

                <div class="row my-3">
                    <div class="col-lg-12">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-account-card-details"></i>
                            </span>{{ $userData->name }} Profile
                        </h3>
                    </div>
                </div>

                <div class="row">
                    <x-profile-image-component :data="$userData" /> <!-- Basic Details Component  -->
                    <x-profile-address-component :data="$userData" /> <!-- Bank Details Component   -->
                    <x-profile-personal-details-component :data="$userData" /> <!-- Professional Details Component  -->

                    @if ($userData->documents->count() > 0)
                        <x-kyc-update-component :data="$userData" /> <!-- Kyc details update Component  -->
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
