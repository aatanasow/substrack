@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
<img src="{{ asset('images/logos/logo-substrack-dark.svg') }}" width="200px" class="logo" alt="SubsTrack Logo">

{{-- {!! $slot !!} --}}
</a>
</td>
</tr>
