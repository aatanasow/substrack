<x-layout>
    <div class="container space-y-6 py-5">

        <h1 class="mt-5 text-center text-3xl">
            Add new transaction
        </h1>

        <x-transaction-form :subsList="$subsList" />
    </div>
</x-layout>
