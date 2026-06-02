@props(['label', 'name', 'type' => 'text', 'value' => null])

<div class="mb-4">
    <label for="{{ $name }}" class="text-dark mb-2 block text-sm font-semibold">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" {{ $attributes }}
        class="block w-full rounded-md border-gray-200 px-4 py-3 text-sm focus:border-blue-600 focus:ring-0">

    <x-form.error name="{{ $name }}" />
</div>
