<x-layout>
    <div class="container flex flex-col gap-6 py-5">


        <div class="flex items-center justify-end">
            <a href="{{ route('subscription.create') }}" class="btn hover:bg-blue-700/80">
                <i class="ti ti-edit text-base"></i>
                Add Subscription
            </a>
        </div>

        <div class="grid gap-6">

            <x-card>
                {{-- <h1 class="mt-5 text-center text-3xl">Subscription list</h1> --}}

                <div class="card-section space-x-2">
                    <div class="w-full px-4 py-2 md:px-6" role="region" aria-labelledby="filter-heading">

                        <div class="mb-6 flex items-center border-b border-slate-300 pb-2">
                            <h2 id="filter-heading" class="text-lg font-semibold text-slate-900">Filter</h2>
                            <a href="{{ route('subscription.index') }}" type="button"
                                class="ml-auto cursor-pointer rounded text-sm font-semibold text-red-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                                aria-label="Clear all filters"><i class="ti ti-x text-md"></i> Clear all</a>
                        </div>

                        <form method="get">
                            <div class="flex gap-6">
                                <div class="flex-1">
                                    <x-form.select label="Frequency" name="frequency" :options="['' => 'All frequencies', ...App\Enums\SubscriptionFrequency::options()]"
                                        value="{{ request('frequency') }}" />
                                </div>

                                <div class="flex-1">
                                    <x-form.select label="Status" name="status" :options="['' => 'All statuses', ...App\Enums\SubscriptionStatus::options()]"
                                        value="{{ request('status') }}" />
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

                    {{-- <a href="{{ route('subscription.index') }}"
                        class="pill {{ request()->has('st') ? 'outlined' : '' }}">All
                        <span class="pl-3 text-xs">{{ $statusCount->get('all') }}</span>
                    </a>
                    @foreach (App\Enums\SubscriptionStatus::cases() as $status)
                        <a href="{{ route('subscription.index') . '?st=' . $status->value }}"
                            class="pill {{ request('st') === $status->value ? '' : 'outlined' }}">
                            {{ $status->label() }}
                            <span class="pl-3 text-xs">{{ $statusCount->get($status->value) }}</span>
                        </a>
                    @endforeach --}}

                </div>

                {{-- @dd($subscriptions->isEmpty()); --}}

                @if ($subscriptions->isEmpty())
                    <p class="text-dark text-lg font-semibold">No subscriptions found</p>
                @else
                    <x-table :captions="['Name', 'Frequency', 'Status', 'Price', ' ']" :sort="['start_date','frequency','status','price','']" sort_def="start_date">

                        @foreach ($subscriptions as $subscription)
                            <x-table.row>
                                <x-table.data>
                                    <a href="{{ route('subscription.show', $subscription) }}">
                                        <div class="flex items-center gap-3">
                                            @if ($subscription->image_path)
                                                <img class="h-9 w-9 rounded-full object-cover"
                                                    src="{{ asset('storage/' . $subscription->image_path) }}" alt
                                                    aria-hidden="true">
                                            @else
                                                <img class="h-9 w-9 rounded-full object-cover"
                                                    src="/images/logos/no-image.png" alt aria-hidden="true">
                                            @endif

                                            <div>
                                                <h3 class="text-dark line-clamp-1 font-semibold">
                                                    {{ $subscription->title }}
                                                </h3>
                                                <span
                                                    class="text-xs font-normal text-gray-500">{{ $subscription->start_date->toFormattedDateString() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </x-table.data>
                                <x-table.data class="w-25">
                                    <span
                                        class="font-normal text-gray-500">{{ $subscription->frequency->label() }}</span>
                                </x-table.data>
                                <x-table.data class="w-25">
                                    <x-status-label status="{{ $subscription->status }}">
                                        {{ $subscription->status->label() }}
                                    </x-status-label>
                                </x-table.data>
                                <x-table.data class="w-25">
                                    <span
                                        class="text-dark text-base font-semibold">{{ Helpers::formatPrice($subscription->price, $subscription->currency->value) }}
                                    </span>
                                </x-table.data>
                                <x-table.data class="w-25 text-right">
                                    <div class="space-x-2">
                                        <a href="{{ route('subscription.show', $subscription) }}">
                                            <i class="ti ti-eye hover:text-primary text-xl"></i>
                                        </a>
                                        <a
                                            href="{{ route('subscription.edit', ['subscription' => $subscription->id]) }}">
                                            <i class="ti ti-edit hover:text-primary text-xl"></i>
                                        </a>
                                        <form action="{{ route('subscription.destroy', $subscription) }}"
                                            method="POST" class="inline">
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

                    @if ($subscriptions->links()->paginator->hasPages())
                        <div class="box has-text-centered mt-4 p-4">
                            {{ $subscriptions->links() }}
                        </div>
                    @endif

                @endif

            </x-card>

        </div>
    </div>
</x-layout>
