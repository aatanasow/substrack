<x-layout>
    <div class="container space-y-6 py-5">

        <h1 class="mt-5 text-center text-3xl">
            Edit transaction
        </h1>

        <x-transaction-form :transaction="$transaction" />
    </div>
</x-layout>
