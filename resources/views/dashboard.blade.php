<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        {{-- <h1 class="my-5 text-center text-2xl">
            <span class="font-bold">Welcome {{ auth()->user()->name }}</span>
        </h1> --}}

        <div class="flex w-full flex-col gap-6 py-5">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <x-card class="lg:col-span-2">
                    <div class="mb-5 block sm:flex sm:justify-between">
                        <h4 class="text-dark mb-2 text-lg font-semibold sm:mb-0">Spending Overview</h4>
                    </div>
                    <script>
                        const monthlyChartLabels = @json($monthlyChart['labels']);
                        const monthlyChartValues = @json($monthlyChart['values']);
                    </script>
                    <canvas id="monthlyChart"></canvas>
                </x-card>

                <div class="flex flex-col gap-6">
                    <x-card class="flex-1">
                        <h4 class="text-dark mb-5 text-lg font-semibold">Yearly Breakup</h4>
                        <div class="flex items-center justify-between gap-6 max-w-full">
                            <div class="flex flex-col gap-4 max-w-1/2">
                                <h3 class="text-dark text-[21px] font-semibold">$36,358</h3>
                                <div class="flex items-center gap-1">
                                    <span class="bg-success/20 flex h-5 w-5 items-center justify-center rounded-full">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark text-sm font-normal">+9%</p>
                                    <p class="text-nowrap text-sm font-normal text-gray-500">last year</p>
                                </div>
                                <div class="flex gap-3">
                                    <div class="flex items-center gap-2">
                                        <span class="bg-primary h-2 w-2 rounded-full"></span>
                                        <p class="text-xs font-normal text-gray-500">2024</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="h-2 w-2 rounded-full bg-gray-500/20"></span>
                                        <p class="text-xs font-normal text-gray-500">2025</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center max-w-1/2">
                                <script>
                                    const yearlyChartLabels = @json($yearlyChart['labels']);
                                    const yearlyChartValues = @json($yearlyChart['values']);
                                </script>
                                <canvas id="yearlyChart"></canvas>
                            </div>
                        </div>
                    </x-card>
                    <x-card class="flex-1">
                        <div class="flex items-center justify-between gap-6">
                            <div class="flex flex-col gap-5">
                                <h4 class="text-dark text-lg font-semibold">Monthly Spending</h4>
                                <div class="gap-4.5 flex flex-col">
                                    <h3 class="text-dark text-[21px] font-semibold">$6,820</h3>
                                    <div class="flex items-center gap-1">
                                        <span class="bg-error/20 flex h-5 w-5 items-center justify-center rounded-full">
                                            <i class="ti ti-arrow-down-right text-error"></i>
                                        </span>
                                        <p class="text-dark text-sm font-normal">+9%</p>
                                        <p class="text-sm font-normal text-gray-500">last month</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="bg-info flex h-11 w-11 items-center justify-center self-start rounded-full text-white">
                                <i class="ti ti-currency-dollar text-xl"></i>
                            </div>

                        </div>
                        <div id="earning"></div>
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

                    @if ($transactions->isEmpty())
                        <p class="text-dark text-md font-normal">No recent transactions</p>
                    @else
                        <ul class="relative">
                            @foreach ($transactions as $transaction)
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
                                            {{ $transaction->subscription->formatPrice($transaction->price, $transaction->subscription->currency) }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </x-card>
                <x-card class="lg:col-span-2">
                    <div class="mb-1 block justify-between sm:flex">
                        <h4 class="text-dark mb-1 text-lg font-semibold sm:mb-0">Expiring Subscriptions</h4>

                        <a href="{{ route('subscription.index') }}" type="button"
                            class="ml-auto cursor-pointer text-sm font-semibold text-blue-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                            aria-label="Clear all filters"> View all</a>
                    </div>
                    <div class="relative overflow-x-auto">

                        @if ($upcomingPayments->isEmpty())
                            <p class="text-dark text-lg font-semibold">No expiring subscriptions found</p>
                        @else
                            <x-table :captions="['Name', 'Next Payment', 'Price']">

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
                                                class="text-dark text-base font-semibold">{{ $item['subscription']->formatPrice($item['subscription']->price, $item['subscription']->currency) }}
                                            </span>
                                        </x-table.data>
                                    </x-table.row>
                                @endforeach
                            </x-table>
                        @endif
                    </div>
                </x-card>
            </div>
        </div>


    </div>
</x-layout>
