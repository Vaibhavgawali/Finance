<!-- resources/views/auth/register.blade.php -->
@extends('dashboard/layouts/dashboard-layout')
@section('main-section')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-plus"></i>
            </span>Reset Password</h3>
        <x-breadcrumb :breadcrumbs="$breadcrumbs??[]"></x-breadcrumb>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form  class="form-sample"  id="reset_password">
                        <div id="error-container" class="alert alert-danger" style="display: none;"></div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Email ID</label>
                            <div class="col-sm-9">
                            <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Registered Email ID">
                                <div id="email_error"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Old Password</label>
                            <div class="col-sm-9">
                            <input type="password" name="old_password" class="form-control" id="old_password" aria-describedby="passwordHelp" placeholder="Enter Your Old Password">
                               <div id="old_password_error"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                            <input type="password" name="new_password" class="form-control" id="new_password" aria-describedby="passwordHelp" placeholder="Enter Your New Password">
                               <div id="new_password_error"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">New Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" aria-describedby="passwordHelp" placeholder="Enter Your New Confirm Password">
                                <div id="password_confirmation_error"></div>
                            </div>
                        </div>

                        <button type="submit" id="reset_password_button" class="btn btn-gradient-primary me-2">Reset Password</button>
                        <a href="/dashboard" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection