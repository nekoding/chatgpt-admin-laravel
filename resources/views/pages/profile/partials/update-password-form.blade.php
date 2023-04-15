<section>
    <div class="card mb-4">
        <div class="card-header">
            <span class="fw-bold">{{ __('Update Password') }}</span>
        </div>
        <div class="card-body">
            <p>
                <i>{{ __('Ensure your account is using a long, random password to stay secure.') }}</i>
            </p>

            <form
                class="mt-6 space-y-6"
                method="post"
                action="{{ route('password.update') }}"
            >
                @csrf
                @method('put')

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="current_password"
                    >{{ __('Current Password') }}<span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('current_password') is-invalid @enderror"
                            id="current_password"
                            name="current_password"
                            type="password"
                        >

                        @error('current_password')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="password"
                    >{{ __('New Password') }}<span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            type="password"
                        >

                        @error('password')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="password_confirmation"
                    >{{ __('Confirm Password') }}<span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                        >
                    </div>
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
