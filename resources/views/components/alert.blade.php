@props(['type' => 'success'])

@php
    $color = match ($type) {
        'success' => ['border-green-100', 'bg-green-50', 'text-green-900'],
        'warning' => ['border-yellow-100', 'bg-yellow-50', 'text-yellow-900'],
        'error' => ['border-red-100', 'bg-red-50', 'text-red-900'],
        'info' => ['border-blue-100', 'bg-blue-50', 'text-blue-900'],
    }
@endphp
<div class="mt-6 max-w-4xl space-y-6 px-4">

    <div class="rounded-md border {{ $color[0] }} {{ $color[1] }} p-3 text-sm" role="alert">
        <div class="flex items-center gap-2.5 font-medium {{ $color[2] }}">
            <i class="ti ti-message-exclamation text-xl"></i>
            <p>Info!</p>
            <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-center">
                {{ $slot }}
            </div>
        </div>
    </div>

</div>
