@props(['name'])

@error($name)
    <p class="text-error text-sm">{{ $message }}</p>
@enderror
