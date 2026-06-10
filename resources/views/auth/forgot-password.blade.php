<x-layout>

    <x-form title="Forgot your password?"
        description="No problem. Just let us know your email address and we will email you a password reset link.">

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-success text-center">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <x-form.field label="Email Address" name="email" type="email" />

            <button type="submit" class="btn my-4 w-full py-2.5 text-base font-medium text-white hover:bg-blue-700">
                Send reset link
            </button>

        </form>

    </x-form>

</x-layout>
