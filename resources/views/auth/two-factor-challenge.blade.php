<x-layout>

    <x-form title="Two-factor authentication" description="Enter your token here">

        @if (session('status'))
            <div class="text-success mb-4 text-center text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('two-factor.login.store') }}" method="POST">
            @csrf

            <x-form.field name="code" required />

            <button type="submit" class="btn my-4 w-full py-2.5 text-base font-medium text-white hover:bg-blue-700">
                Confirm
            </button>

            <div class="flex items-center justify-center gap-2">
                <p class="text-sm font-medium text-gray-500">Have Recovery Code?</p>
                <a href="{{ route('auth.challenge-recovery') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Use it
                    instead</a>
            </div>

        </form>

    </x-form>

</x-layout>
