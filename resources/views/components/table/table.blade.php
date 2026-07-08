@props(['captions' => [], 'sort' => [], 'sort_def' => ''])

<div class="relative overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'my-2.5 w-full whitespace-nowrap text-left text-sm']) }}>
        <thead class="text-gray-700">
            <tr class="text-dark font-semibold">
                @if ($captions)
                    @foreach ($captions as $key => $caption)
                        <th scope="col" class="p-4">
                            @if ($sort && $sort[$key] !== '')
                                <a
                                    href="{{ request()->fullUrlWithQuery([
                                        'sort' => $sort[$key],
                                        'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                    ]) }}">
                                    {{ $caption }}
                                </a>

                                @if (request('sort') === $sort[$key])
                                    {{ request('direction') == 'asc' ? '↑' : '↓' }}
                                @endif
                                @if (! request('sort') && $sort_def && $sort[$key] === $sort_def)
                                    {{ '↓' }}
                                @endif
                            @else
                                {{ $caption }}
                            @endif

                        </th>
                    @endforeach ()
                @endif
            </tr>
        </thead>
        <tbody>

            {{ $slot }}

        </tbody>
    </table>
</div>
