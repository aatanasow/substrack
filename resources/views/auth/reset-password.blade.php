<x-layout>

    <x-form title="Reset password" description="Enter your new password bellow">
        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <x-form.field label="Email Address" name="email" type="email" value="{{ $request->email }}" />
            <x-form.field label="Password" name="password" type="password" />
            <x-form.field label="Repeat Password" name="password_confirmation" type="password" />
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <button type="submit" class="btn my-4 w-full py-2.5 text-base font-medium text-white hover:bg-blue-700">
                Login
            </button>

            <div class="flex items-center justify-center gap-2">
                <p class="text-sm font-medium text-gray-500">New to SubsTrack?</p>
                <a href="{{ route('register') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-700">Create an account</a>
            </div>
        </form>
    </x-form>

</x-layout>
