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

                <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Health Insurance'"
                    :totalCountLabel="'Total Count'" :totalCount="0" />
                <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Life Insurance'"
                    :totalCountLabel="'Total Count'" :totalCount="0" />
                <x-dashboard-card :bgClass="'bg-gradient-danger'" :url="'/'" :imageUrl="asset('admin-assets/assets/images/dashboard/circle.svg')" :title="'Motor Insurance'"
                    :totalCountLabel="'Total Count'" :totalCount="0" />

            </div>

        </div>
    @endif
@endsection
