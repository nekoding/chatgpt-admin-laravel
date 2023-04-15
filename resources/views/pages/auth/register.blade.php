<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4 mx-4">
                <form
                    class="card-body p-4"
                    method="POST"
                    action="{{ route('register') }}"
                >
                    @csrf
                    <h1>Register</h1>
                    <p class="text-medium-emphasis">Create your account</p>
                    <div class="input-group mb-3"><span class="input-group-text">
                            <i class="cil-user icon"></i></span>
                        <input
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            placeholder="{{ __('Name') }}"
                            required
                            autofocus
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <i class="cil-user icon"></i></span>
                        <input
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="username@yourmail.com"
                            required
                            autofocus
                        >

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <i class="cil-lock-locked icon"></i></span>
                        <input
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            type="password"
                            value="{{ old('password') }}"
                            placeholder="Password"
                            required
                            autofocus
                        >

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <i class="cil-lock-locked icon"></i></span>
                        <input
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation"
                            type="password"
                            value="{{ old('password') }}"
                            placeholder="Password confirmation"
                            required
                            autofocus
                        >

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <button
                        class="btn btn-block btn-tosca text-white"
                        type="button"
                    >{{ __('Register') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
