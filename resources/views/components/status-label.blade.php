@props(['status' => 'active'])

@php
    $classes="py-0.75 inline-flex items-center rounded-md px-2.5 font-medium text-xs text-white";


    if($status === 'active'){
        $classes .= " bg-green-500";
    }

    if($status === 'paused'){
        $classes .= " bg-blue-500";
    }

    if($status === 'canceled'){
        $classes .= " bg-red-500";
    }

@endphp

<span {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</span>
