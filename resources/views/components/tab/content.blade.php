@props(['tab', 'title', 'active'=>false])

<div id="{{ $tab }}Content" role="tabpanel" aria-labelledby="{{ $tab }}Tab"
    class="{{ request('tab') === $tab || ($active && !request('tab')) ? 'block' : 'hidden' }} tab-content mt-8 max-w-xl space-y-9">
    <h4 class="text-base font-semibold text-slate-900">{{ $title }}</h4>

    {{ $slot }}

</div>
