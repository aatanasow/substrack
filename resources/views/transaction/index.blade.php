<x-layout>
    <div class="container flex flex-col gap-6 py-5">


        <div class="flex items-center justify-end">
            <a href="{{ route('transaction.create') }}" class="btn hover:bg-blue-700/80">
                <i class="ti ti-edit text-base"></i>
                Add Transaction
            </a>
        </div>

        <div class="grid gap-6">

            <x-card>
                {{-- <h1 class="mt-5 text-center text-3xl">transactions list</h1> --}}

                <div class="card-section space-x-2">

                    filter here
                </div>


                @if ($transactions->isEmpty())
                    <p class="text-dark text-lg font-semibold">No transactions found</p>
                @else
                    <x-table :captions="['Subscription', 'Price', 'Date', 'Status', ' ']">

                        @foreach ($transactions as $transaction)
                            <x-table.row>
                                <x-table.data>
                                    <a href="{{ route('subscription.show', $transaction->subscription) }}">
                                        <div class="flex items-center gap-3">
                                            @if ($transaction->subscription->image_path)
                                                <img class="h-9 w-9 rounded-full object-cover"
                                                    src="{{ asset('storage/' . $transaction->subscription->image_path) }}"
                                                    alt aria-hidden="true">
                                            @else
                                                <img class="h-9 w-9 rounded-full object-cover"
                                                    src="/images/logos/no-image.png" alt aria-hidden="true">
                                            @endif

                                            <div>
                                                <h3 class="text-dark line-clamp-1 font-semibold">
                                                    {{ $transaction->subscription->title }}
                                                </h3>
                                            </div>
                                        </div>
                                    </a>
                                </x-table.data>
                                <x-table.data class="w-25">
                                    <span class="text-dark text-base font-semibold">
                                        {{ $transaction->subscription->formatPrice($transaction->price, $transaction->subscription->currency) }}
                                    </span>
                                </x-table.data>
                                <x-table.data class="w-25">
                                    <span
                                        class="font-normal text-gray-500">{{ $transaction->payment_date->toFormattedDateString() }}</span>
                                </x-table.data>
                                <x-table.data class="w-25">
                                    <x-status-label status="{{ $transaction->confirmed ? 'active' : 'canceled' }}">
                                        {{ $transaction->confirmed ? 'Confirmed' : 'Pending' }}
                                    </x-status-label>
                                </x-table.data>
                                <x-table.data class="w-25 text-right">
                                    <div class="space-x-2">
                                        @if (!$transaction->confirmed)
                                            <form action="{{ route('transaction.confirm', $transaction) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('PUT')

                                                <button title="Confirm" class="cursor-pointer">
                                                    <i class="ti ti-checkbox hover:text-green-700 text-xl"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('transaction.edit', ['transaction' => $transaction->id]) }}" title="Edit">
                                            <i class="ti ti-edit hover:text-primary text-xl"></i>
                                        </a>
                                        <form action="{{ route('transaction.destroy', $transaction) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button title="Delete" class="cursor-pointer">
                                                <i class="ti ti-x hover:text-red-700 text-xl"></i>
                                            </button>
                                        </form>
                                    </div>
                                </x-table.data>
                            </x-table.row>
                        @endforeach
                    </x-table>

                @endif

            </x-card>

        </div>
    </div>
</x-layout>
