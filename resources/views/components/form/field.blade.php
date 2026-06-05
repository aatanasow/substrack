@props(['label' => false, 'name', 'type' => 'text', 'value' => null])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="text-dark mb-2 block text-sm font-semibold">{{ $label }}</label>
    @endif


    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}"
            class="block w-full rounded-md border-gray-200 px-4 py-3 text-sm focus:border-blue-600 focus:ring-0"
            {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @else
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" {{ $attributes }}
            class="block w-full rounded-md border-gray-200 px-4 py-3 text-sm focus:border-blue-600 focus:ring-0">
    @endif
    <x-form.error name="{{ $name }}" />
</div>
