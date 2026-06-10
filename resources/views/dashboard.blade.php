<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        <h1 class="my-5 text-center text-2xl">
            <span class="font-bold">Welcome {{ auth()->user()->name }}</span>
        </h1>

        <div class="flex w-full flex-row gap-6">
            <x-card class="flex-1">
                <p class="text-dark text-center text-lg font-semibold">section 1</p>

            </x-card>
            <x-card class="flex-1">
                <p class="text-dark text-center text-lg font-semibold">section 2</p>

            </x-card>
        </div>


    </div>
</x-layout>
