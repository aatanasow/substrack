<x-layout>

    <x-form title="Confirm your password" description="">

        @if (session('status'))
            <div class="text-success mb-4 text-center text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.confirm.store') }}" method="POST">
            @csrf

            <x-form.field label="Password" name="password" type="password" />

            <button type="submit" class="btn my-4 w-full py-2.5 text-base font-medium text-white hover:bg-blue-700">
                Confirm
            </button>

        </form>

    </x-form>

</x-layout>
