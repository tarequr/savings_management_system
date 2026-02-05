@extends('layouts.app')

@push('styles')
    <!-- Dropify CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet">
    <style>
        .dropify-message p { font-size: 16px; }
    </style>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{ __('My Profile Settings') }}</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Profile Information Card -->
                    <div class="card shadow-sm border-0 m-b-30">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="card-title text-primary mb-0"><i class="fas fa-user-edit me-2"></i> {{ __('Update Profile Information') }}</h5>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Password Update Card -->
                    <div class="card shadow-sm border-0 m-b-30 mt-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="card-title text-primary mb-0"><i class="fas fa-key me-2"></i> {{ __('Change Password') }}</h5>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Dropify JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.dropify').dropify();
        });
    </script>
@endpush
