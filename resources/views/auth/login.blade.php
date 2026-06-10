<x-layout>

    <x-form title="Login to your account" description="Enter your email and password below to log in">

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-success text-center">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <x-form.field label="Email Address" name="email" type="email" />
            <x-form.field label="Password" name="password" type="password" />

            <div class="flex justify-between">
                <div class="flex">
                    <input type="checkbox" name="remember"
                        class="mt-0.5 shrink-0 rounded-sm border-gray-200 text-blue-600 focus:ring-blue-500"
                        id="remember">
                    <label for="remember" class="text-dark ms-3 text-sm">Remember this Device</label>
                </div>
                <a href="{{ route('password.request') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-700">Forgot Password ?</a>
            </div>

            <button type="submit" class="btn my-4 w-full py-2.5 text-base font-medium text-white hover:bg-blue-700">
                Login
            </button>

            <div class="flex items-center justify-center gap-2">
                <p class="text-sm font-medium text-gray-500">New to SubsTrack?</p>
                <a href="{{ route('register') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Create
                    an account</a>
            </div>
        </form>
    </x-form>

</x-layout>
