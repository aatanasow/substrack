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

                    <div class="w-full px-4 py-2 md:px-6" role="region" aria-labelledby="filter-heading">

                        <div class="mb-6 flex items-center border-b border-slate-300 pb-2">
                            <h2 id="filter-heading" class="text-lg font-semibold text-slate-900">Filter</h2>
                            <a href="{{ route('transaction.index') }}" type="button"
                                class="ml-auto cursor-pointer rounded text-sm font-semibold text-red-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                                aria-label="Clear all filters"><i class="ti ti-x text-md"></i> Clear all</a>
                        </div>

                        <form method="get">
                            <div class="flex gap-6">

                                <div class="flex-1">
                                    <x-form.select label="Subscription" name="subscription_id" :options="$subscriptions"
                                        value="{{ request('subscription_id') }}" />
                                </div>

                                <div class="flex-1">
                                    <x-form.select label="Status" name="confirmed" :options="['' => 'All statuses', '1' => 'Confirmed', '0' => 'Pending']"
                                        value="{{ request('confirmed') }}" />
                                </div>

                                <div class="flex-1">
                                    <x-form.field label="Min Price" name="min_price"
                                        value="{{ request('min_price') }}" />
                                </div>

                                <div class="flex-1">
                                    <x-form.field label="Max Price" name="max_price"
                                        value="{{ request('max_price') }}" />
                                </div>

                                <div class="mb-4 mt-7">
                                    <button type="submit"
                                        class="btn-outline-primary w-full hover:bg-blue-700/80 hover:text-white">
                                        <i class="ti ti-filter text-2xl"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>


                @if ($transactions->isEmpty())
                    <p class="text-dark text-lg font-semibold">No transactions found</p>
                @else
                    <x-table :captions="['Subscription', 'Price', 'Date', 'Status', ' ']" :sort="['subscription_id','price','payment_date','confirmed','']" sort_def="payment_date">

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
                                                    <i class="ti ti-checkbox text-xl hover:text-green-700"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('transaction.edit', ['transaction' => $transaction->id]) }}"
                                            title="Edit">
                                            <i class="ti ti-edit hover:text-primary text-xl"></i>
                                        </a>
                                        <form action="{{ route('transaction.destroy', $transaction) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button title="Delete" class="cursor-pointer">
                                                <i class="ti ti-x text-xl hover:text-red-700"></i>
                                            </button>
                                        </form>
                                    </div>
                                </x-table.data>
                            </x-table.row>
                        @endforeach

                    </x-table>

                    @if ($transactions->links()->paginator->hasPages())
                        <div class="box has-text-centered mt-4 p-4">
                            {{ $transactions->links() }}
                        </div>
                    @endif

                @endif

            </x-card>

        </div>
    </div>
</x-layout>
