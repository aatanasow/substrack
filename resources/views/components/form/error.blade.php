@props(['name', 'errbag' => ''])

@if ($errbag)
    @error($name, $errbag)
        <p class="text-error text-sm">{{ $message }}</p>
    @enderror
@else
    @error($name)
        <p class="text-error text-sm">{{ $message }}</p>
    @enderror
@endif

