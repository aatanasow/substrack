@props(['title', 'description'])

<div class="relative flex h-full w-full flex-col items-center justify-center overflow-hidden px-4">

    <div class="card w-full max-w-md items-center justify-center lg:flex">
        <div class="card-body w-full space-y-9">

            <div class="space-y-2 text-center">
                <h1 class="text-3xl font-bold tracking-tight">{{ $title }}</h1>
                <p class="mb-4 text-center text-sm text-gray-500">{{ $description }}</p>
            </div>

            {{ $slot }}

        </div>
    </div>

</div>
