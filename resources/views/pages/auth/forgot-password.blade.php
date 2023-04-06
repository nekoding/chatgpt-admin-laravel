<x-guest-layout>
    {{-- <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <form
        method="POST"
        action="{{ route('password.email') }}"
    >
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label
                for="email"
                :value="__('Email')"
            />
            <x-text-input
                class="block mt-1 w-full"
                id="email"
                name="email"
                type="email"
                :value="old('email')"
                required
                autofocus
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-guest-layout>
