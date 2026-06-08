@props(['label' => false, 'name', 'value' => null, 'options' => []])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="text-dark mb-2 block text-sm font-semibold">{{ $label }}</label>
    @endif

    <select  id="{{ $name }}" name="{{ $name }}" {{ $attributes }}
        class="w-full rounded-md border-gray-200 px-4 py-3 text-sm focus:border-blue-600 focus:ring-0">
        @foreach ($options as $key => $option_value)
        {{old($name, $value)}}
            <option value="{{ $key }}" @selected(old($name, $value) == $key)>{{ $option_value }}</option>
        @endforeach
    </select>

    <x-form.error name="{{ $name }}" />
</div>
