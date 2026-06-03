@props(['captions' => []])

<div class="relative overflow-x-auto">
    <table {{ $attributes ->merge(['class' => 'my-2.5 w-full whitespace-nowrap text-left text-sm']) }}>
        <thead class="text-gray-700">
            <tr class="text-dark font-semibold">
                @if ($captions)
                    {{-- @dd($captions) --}}
                    @foreach ($captions as $caption)
                        <th scope="col" class="p-4">{{ $caption }}</th>
                    @endforeach ()
                @endif
            </tr>
        </thead>
        <tbody>

            {{ $slot }}

        </tbody>
    </table>
</div>
