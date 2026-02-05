<section>
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="photo" class="form-label">{{ __('Profile Photo') }}</label>
                <input type="file" class="dropify" id="photo" name="photo" 
                    data-height="160" 
                    data-default-file="{{ $user->photo ? asset('upload/members/'.$user->photo) : asset('assets/images/placeholder.png') }}"
                    accept="image/*" />
                @error('photo')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus placeholder="Enter your full name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="small text-warning">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">{{ __('Click here to re-send.') }}</button>
                            </p>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                    <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save me-1"></i> {{ __('Update Profile') }}
            </button>
        </div>
    </form>
</section>
