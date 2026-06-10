@props(['title', 'description'])

<div class="relative flex h-full w-full flex-col items-center justify-center overflow-hidden px-4">

    <x-card class="w-full max-w-md space-y-3">
        <div class="space-y-2 text-center">
            <h1 class="text-3xl font-bold tracking-tight">{{ $title }}</h1>
            <p class="mb-4 text-center text-sm text-gray-500">{{ $description }}</p>
        </div>

        {{ $slot }}
    </x-card>

</div>
