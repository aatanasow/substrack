<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        <div class="flex w-full flex-col gap-6">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <x-card class="lg:col-span-2">
                    <div class="mb-4 block sm:flex sm:justify-between">
                        <h4 class="text-dark mb-2 text-lg font-semibold sm:mb-0">Monthly Spending</h4>
                    </div>
                    @if (!$monthlySpending['datasets'])
                        <p class="text-dark text-sm font-normal">No spending's last year</p>
                    @else
                        <script>
                            const monthlyChartLabels = @json($monthlySpending['labels']);
                            const monthlyChartDatasets = @json($monthlySpending['datasets']);
                        </script>
                        <canvas id="monthlyChart"></canvas>
                    @endif
                </x-card>

                <div class="flex flex-col gap-6">
                    <x-card class="flex-1">
                        <div class="mb-4 block sm:flex sm:justify-between">
                            <h4 class="text-dark mb-2 text-lg font-semibold sm:mb-0">Yearly Breakup</h4>
                        </div>
                        <div class="flex items-center justify-end gap-2 text-xs font-semibold">
                            @foreach ($yearlyBreakdown['currencies'] as $currency)
                                <a href="{{ route('dashboard') . '?currency=' . $currency }}"
                                    class="{{ $yearlyBreakdown['datasets']['label'] === $currency ? 'bg-info' : 'bg-gray-400' }} flex h-5 w-11 items-center justify-center rounded-full text-white">
                                    {{ $currency }}
                                </a>
                            @endforeach
                        </div>
                        @if (!$yearlyBreakdown['datasets'])
                            <p class="text-dark text-sm font-normal">No spending's last year</p>
                        @else
                            <div class="flex max-w-full items-center justify-between gap-6">
                                <div class="max-w-1/2 flex flex-col gap-4">
                                    <h3 class="text-dark text-[21px] font-semibold">
                                        {{ Helpers::formatPrice($yearlyBreakdown['datasets']['data'][1], $yearlyBreakdown['datasets']['label']) }}
                                    </h3>
                                    <div class="flex items-center gap-1">

                                        @if ($yearlyBreakdown['datasets']['data'][0] == $yearlyBreakdown['datasets']['data'][1])
                                            <span
                                                class="bg-info/20 flex h-5 w-5 items-center justify-center rounded-full">
                                                <i class="ti ti-arrow-left text-info"></i>
                                            </span>
                                        @elseif($yearlyBreakdown['datasets']['data'][0] > $yearlyBreakdown['datasets']['data'][1])
                                            <span
                                                class="bg-success/20 flex h-5 w-5 items-center justify-center rounded-full">
                                                <i class="ti ti-arrow-down-left text-success"></i>
                                            </span>
                                        @else
                                            <span
                                                class="bg-error/20 flex h-5 w-5 items-center justify-center rounded-full">
                                                <i class="ti ti-arrow-up-left text-error"></i>
                                            </span>
                                        @endif

                                        <p class="text-dark text-sm font-normal">
                                            {{ Helpers::formatDifference($yearlyBreakdown['datasets']['data'][0], $yearlyBreakdown['datasets']['data'][1]) }}
                                        </p>
                                        <p class="text-nowrap text-sm font-normal text-gray-500">last year</p>
                                    </div>

                                </div>
                                <div class="max-w-1/2 flex items-center">
                                    <script>
                                        const yearlyChartLabels = @json($yearlyBreakdown['labels']);
                                        const yearlyChartDatasets = @json($yearlyBreakdown['datasets']);
                                    </script>
                                    <canvas id="yearlyChart"></canvas>
                                </div>
                            </div>
                        @endif

                    </x-card>
                    <x-card class="flex-1">
                        <div class="mb-4 block sm:flex sm:justify-between">
                            <h4 class="text-dark mb-2 text-lg font-semibold sm:mb-0">Spending Overview</h4>
                        </div>
                        <div class="flex items-center justify-end gap-2 text-xs font-semibold">
                            @foreach ($yearlyBreakdown['currencies'] as $currency)
                                <a href="{{ route('dashboard') . '?currency=' . $currency }}"
                                    class="{{ $yearlyBreakdown['datasets']['label'] === $currency ? 'bg-info' : 'bg-gray-400' }} flex h-5 w-11 items-center justify-center rounded-full text-white">
                                    {{ $currency }}
                                </a>
                            @endforeach
                        </div>

                        <div class="flex justify-between gap-2">
                            <div>
                                <h3 class="text-dark text-xl font-semibold">{{ Helpers::formatPrice($spendingOverview['this_month'], $yearlyBreakdown['datasets']['label']) }}</h3>
                                <p class="text-sm font-normal text-gray-500">This Month</p>
                            </div>
                            <div>
                                <h3 class="text-dark text-xl font-semibold">{{ Helpers::formatPrice($spendingOverview['this_year'], $yearlyBreakdown['datasets']['label']) }}</h3>
                                <p class="text-sm font-normal text-gray-500">This Year</p>
                            </div>
                            <div>
                                <h3 class="text-dark text-xl font-semibold">{{ Helpers::formatPrice($spendingOverview['lifetime'], $yearlyBreakdown['datasets']['label']) }}</h3>
                                <p class="text-sm font-normal text-gray-500">Lifetime</p>
                            </div>
                        </div>
                    </x-card>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <x-card>
                    <div class="mb-4 flex items-center justify-between">
                        <h4 class="text-dark text-lg font-semibold">Recent Transactions</h4>

                        <a href="{{ route('transaction.index') }}" type="button"
                            class="ml-auto cursor-pointer text-sm font-semibold text-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                            aria-label="Clear all filters"> View all</a>
                    </div>

                    @if ($recentTransactions->isEmpty())
                        <p class="text-dark text-sm font-normal">No recent transactions</p>
                    @else
                        <ul class="relative">
                            @foreach ($recentTransactions as $transaction)
                                <li class="relative flex min-h-20 overflow-hidden">
                                    <div class="text-dark w-2/6 py-1.5 text-end text-sm">
                                        {{ $transaction->payment_date->toFormattedDateString() }}
                                    </div>
                                    <div class="flex w-1/6 flex-col items-center">
                                        <div
                                            class="border-primary my-2.5 h-3 w-3 shrink-0 rounded-full border-2 bg-transparent">
                                        </div>
                                        <div class="block h-full w-px bg-gray-100"></div>
                                    </div>
                                    <div class="text-dark w-3/6 py-1.5 text-sm font-normal">
                                        <div>{{ $transaction->subscription->title }}</div>
                                        <div class="text-gray-500">
                                            {{ Helpers::formatPrice($transaction->price, $transaction->subscription->currency->value) }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </x-card>
                <x-card class="lg:col-span-2">
                    <div class="mb-4 block justify-between sm:flex">
                        <h4 class="text-dark mb-1 text-lg font-semibold sm:mb-0">Expiring Subscriptions</h4>

                        <a href="{{ route('subscription.index') }}" type="button"
                            class="ml-auto cursor-pointer text-sm font-semibold text-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                            aria-label="Clear all filters"> View all</a>
                    </div>


                    @if ($upcomingPayments->isEmpty())
                        <div class="relative overflow-x-auto">
                            <p class="text-dark text-sm font-normal">No expiring subscriptions</p>

                        </div>
                    @else
                        <x-table :captions="['Name', 'Next Payment', 'Price']" class="-mt-3">

                            @foreach ($upcomingPayments as $item)
                                <x-table.row>
                                    <x-table.data>
                                        <a href="{{ route('subscription.show', $item['subscription']) }}">
                                            <div class="flex items-center gap-3">
                                                @if ($item['subscription']->image_path)
                                                    <img class="h-9 w-9 rounded-full object-cover"
                                                        src="{{ asset('storage/' . $item['subscription']->image_path) }}"
                                                        alt aria-hidden="true">
                                                @else
                                                    <img class="h-9 w-9 rounded-full object-cover"
                                                        src="/images/logos/no-image.png" alt aria-hidden="true">
                                                @endif

                                                <div>
                                                    <h3 class="text-dark line-clamp-1 font-semibold">
                                                        {{ $item['subscription']->title }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </a>
                                    </x-table.data>
                                    <x-table.data class="w-25">
                                        <span
                                            class="font-normal text-gray-500">{{ $item['next_payment']->toFormattedDateString() }}</span>
                                    </x-table.data>
                                    <x-table.data class="w-25">
                                        <span
                                            class="text-dark text-base font-semibold">{{ Helpers::formatPrice($item['subscription']->price, $item['subscription']->currency->value) }}
                                        </span>
                                    </x-table.data>
                                </x-table.row>
                            @endforeach
                        </x-table>
                    @endif
                </x-card>
            </div>
        </div>


    </div>
</x-layout>
