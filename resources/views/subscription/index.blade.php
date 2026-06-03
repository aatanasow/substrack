<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        <h1 class="mt-5 text-center text-3xl">Subscription list</h1>

        <div class="grid gap-6">

            <x-card>

                <div class="space-x-2">

                    <a href="{{ route('subscription.index') }}"
                        class="pill {{ request()->has('st') ? 'outlined' : '' }}">All
                        <span class="pl-3 text-xs">{{ $statusCount->get('all') }}</span>
                    </a>
                    @foreach (App\SubscriptionStatus::cases() as $status)
                        <a href="{{ route('subscription.index') . '?st=' . $status->value}}"
                            class="pill {{ request('st') === $status->value ? '' : 'outlined' }}">
                            {{ $status->label() }}
                            <span class="pl-3 text-xs">{{ $statusCount->get($status->value) }}</span>
                        </a>
                    @endforeach

                </div>

                <x-table :captions="['Name', 'Frequency', 'Status', 'Price', ' ']">

                    @forelse ($subscriptions as $subscription)
                        {{-- @if ($subscription->description)
                        <div class="mt-5 line-clamp-3">{{ $subscription->description }}</div>
                    @endif --}}

                        {{-- @if ($subscription->link)
                        <div class="mt-5 line-clamp-3">{{ $subscription->link }}</div>
                    @endif --}}
                        {{-- <div class="mt-4">{{ $subscription->created_at->diffForHumans() }}</div> --}}


                        <x-table.row>
                            <x-table.data>
                                <div class="flex items-center gap-3">
                                    @if ($subscription->image_path)
                                        <div class="mt-5 line-clamp-3">{{ $subscription->image_path }}</div>
                                    @else
                                        <img class="h-9 w-9 rounded-full object-cover" src="/images/logos/favicon.png"
                                            alt aria-hidden="true">
                                    @endif

                                    <div>
                                        <h3 class="text-dark line-clamp-1 font-semibold">{{ $subscription->title }}</h3>
                                        <span
                                            class="text-xs font-normal text-gray-500">{{ $subscription->start_date->toFormattedDateString() }}</span>
                                    </div>
                                </div>
                            </x-table.data>
                            <x-table.data>
                                <span class="font-normal text-gray-500">{{ $subscription->frequency }}</span>
                            </x-table.data>
                            <x-table.data>
                                <x-status-label status="{{ $subscription->status }}">
                                    {{ $subscription->status->label() }}
                                </x-status-label>
                            </x-table.data>
                            <x-table.data>
                                <span
                                    class="text-dark text-base font-semibold">{{ $subscription->formatPrice($subscription->price, $subscription->currency) }}
                                </span>
                            </x-table.data>
                            <x-table.data>
                                <div class="space-x-2">
                                    <a href="{{ route('subscription.show', $subscription) }}">
                                        <i class="ti ti-eye hover:text-primary text-xl"></i>
                                    </a>
                                    <i class="ti ti-edit text-xl"></i>
                                </div>
                            </x-table.data>
                        </x-table.row>


                    @empty
                        <p class="text-dark text-lg font-semibold">No subscriptions found</p>
                    @endforelse
                </x-table>
            </x-card>

        </div>
    </div>
</x-layout>
