<x-layout>
    <div class="container flex flex-col items-center gap-6 py-5">


        <div class="flex w-full items-center justify-between">
            <a href="{{ route('subscription.index') }}" class="btn-empty hover:bg-blue-700/80 hover:text-white">
                <i class="ti ti-arrow-back text-base"></i>
                Back to subscriptions
            </a>

            <div class="flex items-center gap-x-2">
                <a href="{{ route('subscription.edit', $subscription) }}" class="btn hover:bg-blue-700/80" id="btn">
                    <i class="ti ti-edit text-base"></i>
                    Edit
                </a>

                <form action="{{ route('subscription.destroy', $subscription) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button class="btn-danger hover:bg-red-700/80">
                        Delete
                    </button>
                </form>
            </div>
        </div>


        <x-card class="lg:max-w-2/3 mx-auto w-full">
            <h1 class="mt-5 text-center text-2xl">
                <div class="card-section flex items-center justify-between gap-3">

                    <div class="flex items-center gap-4">
                        @if ($subscription->image_path)
                            <img class="h-15 w-15 rounded-full object-cover"
                                src="{{ asset('storage/' . $subscription->image_path) }}" alt aria-hidden="true">
                        @else
                            <img class="h-15 w-15 rounded-full object-cover" src="/images/logos/no-image.png" alt
                                aria-hidden="true">
                        @endif

                        <div class="flex flex-col items-start gap-1 text-xl">
                            <div class="font-semibold text-blue-900">{{ $subscription->title }}</div>
                            <x-status-label status="{{ $subscription->status->value }}">
                                {{ $subscription->status->label() }}
                            </x-status-label>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        @if ($subscription->link)
                            <div class="text-blue-500 text-sm font-bold">
                                <a href="{{ $subscription->link }}" target="_blank">
                                   Visit <i class="ti ti-external-link text-xl"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </h1>


            <div class="space-y-4">

                <div class="mt-1 flex items-stretch gap-3 text-base">

                    <div class="flex flex-1 flex-col space-y-1">
                        <div class="text-xs text-gray-500">Price</div>
                        <div class="card-section flex-1">
                            {{ $subscription->formatPrice($subscription->price, $subscription->currency) }}
                        </div>
                    </div>

                    <div class="flex flex-1 flex-col space-y-1">
                        <div class="text-xs text-gray-500">Frequency</div>
                        <div class="card-section flex-1">
                            {{ $subscription->frequency->label() }}
                        </div>
                    </div>

                    <div class="flex flex-1 flex-col space-y-1">
                        <div class="text-xs text-gray-500">Total Spent</div>
                        <div class="card-section flex-1">
                            {{ $subscription->formatPrice($subscription->getSubscriptionTotal(), $subscription->currency) }}
                            <div class="text-xs text-gray-700">{{ $subscription->getSubscriptionPeriods() }} {{ $subscription->getSubscriptionPeriods()===1 ? 'payment' : 'payments' }} </div>
                        </div>
                    </div>

                </div>

                <div class="mt-1 flex items-stretch gap-3 text-base">

                    <div class="flex flex-1 flex-col space-y-1">
                        <div class="text-xs text-gray-500">Started</div>
                        <div class="card-section flex-1">
                            {{ $subscription->start_date->toFormattedDateString() }}
                            <div class="text-xs text-gray-700">{{ $subscription->start_date->diffForHumans() }}</div>
                        </div>
                    </div>

                    @if ($subscription->frequency->recurring())
                        <div class="flex flex-1 flex-col space-y-1">
                            <div class="text-xs text-gray-500">Next payment</div>
                            <div class="card-section flex-1">
                                {{ $subscription->getNextPaymentDate()->next_payment->toFormattedDateString() }}
                                {{-- {{ $subscription->getNextPaymentDate()->toFormattedDateString() }} --}}
                                <div class="text-xs text-gray-700">
                                    {{ $subscription->getNextPaymentDate()->formattedForHumans() }}
                                    {{-- {{ $subscription->getNextPaymentDate()->diffForHumans() }} --}}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($subscription->frequency->recurring())
                        <div class="flex flex-1 flex-col space-y-1">
                            <div class="text-xs text-gray-500">Remind me</div>
                            <div class="card-section flex-1">
                                {{ $subscription->notify }}
                                <div class="text-xs text-gray-700">
                                    {{ $subscription->notify ===1 ? 'day' : 'days' }} before
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                @if ($subscription->description)
                    <div class="space-y-1">
                        <div class="text-xs text-gray-500">Description</div>
                        <div class="card-section text-base">
                            {{ $subscription->description }}
                        </div>
                    </div>
                @endif
            </div>
        </x-card>
    </div>
</x-layout>
