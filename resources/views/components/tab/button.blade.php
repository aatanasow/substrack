@props(['route', 'tab', 'icon'=>'user', 'active'=>false])

<a href="{{ route($route) }}{{ $active ? '' : '?tab=' . $tab }}" role="tab" id="{{ $tab }}Tab" aria-selected="true"
    aria-controls="{{ $tab }}Content"
    class="{{ request('tab') === $tab || ($active && !request('tab')) ? 'border-blue-700 text-blue-700' : 'border-transparent' }} tab relative top-px flex cursor-pointer items-center gap-2 border-b-2 px-3.5 py-2 transition-colors hover:text-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
    <i class="ti ti-{{ $icon }} text-xl"></i>
    {{ $slot }}
</a>
