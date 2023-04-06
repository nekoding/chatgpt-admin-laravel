<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
                <div class="card col-md-7 p-4 mb-0">
                    <form
                        class="card-body needs-validation"
                        method="POST"
                        action="{{ route('login') }}"
                    >
                        @csrf
                        <h1>Login</h1>
                        <p class="text-medium-emphasis">Sign In to your account</p>
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
                        <div class="input-group mb-2"><span class="input-group-text">
                                <i class="cil-lock-locked icon"></i></span>
                            <input
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                type="password"
                                placeholder="Password"
                                required
                            >

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="form-check mb-4">
                            <input
                                class="form-check-input"
                                id="remember_me"
                                name="remember"
                                type="checkbox"
                            >
                            <label
                                class="form-check-label"
                                for="remember_me"
                            >
                                {{ __('Remember me') }}
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button
                                    class="btn btn-primary px-4"
                                    type="submit"
                                >Login</button>
                            </div>

                            <div class="col-6 text-end text-nowrap">
                                @if (Route::has('password.request'))
                                    <a
                                        class="btn btn-link px-0"
                                        href="{{ route('password.request') }}"
                                    >{{ __('Forgot your password?') }}</a>
                                @endif
                            </div>

                        </div>
                    </form>
                </div>
                @if (Route::has('register'))
                    <div class="card col-md-5 text-white bg-primary py-5">
                        <div class="card-body text-center">
                            <div>
                                <h2 class="mb-5">Sign up</h2>
                                <a
                                    class="btn btn-lg btn-outline-light mt-3"
                                    href="{{ route('register') }}"
                                >Register Now!</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
