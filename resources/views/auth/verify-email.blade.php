<x-layout>

    <x-form title="Please verify your email address"
        description="Please verify your email address by clicking the link we emailed to you. If you did not receive the email, please check your spam folder.">

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-medium text-success text-center">
                A new email verification link has been emailed to you!
            </div>
        @endif

        <form action="{{ route('verification.send') }}" method="POST">
            @csrf

            <button type="submit" class="btn my-4 w-full py-2.5 text-base font-medium text-white hover:bg-blue-700">
                Resend email
            </button>

        </form>

    </x-form>

</x-layout>
