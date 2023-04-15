<section>
    <div class="card mb-4">
        <div class="card-header">
            <span class="fw-bold">{{ __('Profile Information') }}</span>
        </div>
        <div class="card-body">
            <p><i>{{ __("Update your account's profile information and email address.") }}</i></p>

            <form
                method="post"
                action="{{ route('profile.update') }}"
            >
                @csrf
                @method('patch')

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="name"
                    >{{ __('Name') }}<span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $user->name) }}"
                        >

                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="email"
                    >{{ __('Email') }}<span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('name', $user->email) }}"
                            required
                        >

                        @error('email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}

                                <button
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    form="send-verification"
                                >
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="mb-3 row">
                    <button class="btn btn-tosca text-white col-lg-1 col-12 ms-2 mt-3">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        @if (session()->has('success'))
            <script>
                Swal.fire('Success', '{{ session()->get('success') }}', 'success')
            </script>
        @endif
    @endpush
</section>
