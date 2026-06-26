@props(['type' => 'success'])

@php
    $color = match ($type) {
        'success' => 'green',
        'warning' => 'yellow',
        'error' => 'red',
        'info' => 'blue',
    }
@endphp

<div class="mt-6 max-w-4xl space-y-6 px-4">

    <div class="rounded-md border border-{{ $color }}-100 bg-{{ $color }}-50 p-3 text-sm" role="alert">
        <div class="flex items-center gap-2.5 font-medium text-{{ $color }}-900">
            <i class="ti ti-message-exclamation text-xl"></i>
            <p>Info!</p>
            <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-center">
                {{ $slot }}
            </div>
        </div>
    </div>

</div>
