<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        {{-- <h1 class="my-5 text-center text-2xl">
            <span class="font-bold">Welcome {{ auth()->user()->name }}</span>
        </h1> --}}

        <div class="flex w-full flex-col gap-6 py-5">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <x-card class="col-span-2">
                    <div class="mb-5 block sm:justify-between sm:flex">
                        <h4 class="text-dark mb-2 text-lg font-semibold sm:mb-0">Sales Overview</h4>
                    </div>
                    <div id="chart"></div>
                </x-card>

                <div class="flex flex-col gap-6">
                    <x-card>
                        <h4 class="text-dark mb-5 text-lg font-semibold">Yearly Breakup</h4>
                        <div class="flex items-center justify-between gap-6">
                            <div class="flex flex-col gap-4">
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
                            <div class="flex items-center">
                                <div id="breakup"></div>
                            </div>
                        </div>
                    </x-card>
                    <x-card>
                        <div class="flex items-center justify-between gap-6">
                            <div class="flex flex-col gap-5">
                                <h4 class="text-dark text-lg font-semibold">Monthly Earnings</h4>
                                <div class="gap-4.5 flex flex-col">
                                    <h3 class="text-dark text-[21px] font-semibold">$6,820</h3>
                                    <div class="flex items-center gap-1">
                                        <span class="bg-error/20 flex h-5 w-5 items-center justify-center rounded-full">
                                            <i class="ti ti-arrow-down-right text-error"></i>
                                        </span>
                                        <p class="text-dark text-sm font-normal">+9%</p>
                                        <p class="text-sm font-normal text-gray-500">last year</p>
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
                    <h4 class="text-dark mb-6 text-lg font-semibold">Recent Transactions</h4>
                    <ul class="timeline-widget relative">
                        <li class="timeline-item min-h-17.5 relative flex overflow-hidden">
                            <div class="timeline-time text-dark min-w-22.5 py-1.5 pr-4 text-end text-sm">
                                9:30 am
                            </div>
                            <div class="timeline-badge-wrap flex flex-col items-center">
                                <div
                                    class="timeline-badge border-primary my-2.5 h-3 w-3 shrink-0 rounded-full border-2 bg-transparent">
                                </div>
                                <div class="timeline-badge-border block h-full w-px bg-gray-100"></div>
                            </div>
                            <div class="timeline-desc px-4 py-1.5">
                                <p class="text-dark text-sm font-normal">Payment received from John
                                    Doe of $385.90</p>
                            </div>
                        </li>
                    </ul>
                </x-card>
                <x-card class="col-span-2">
                    <div class="mb-5 block justify-between sm:flex">
                        <div>
                            <h4 class="text-dark mb-2 text-lg font-semibold sm:mb-0">Expiring Subscriptions</h4>
                            {{-- <p class="text-sm text-gray-500">Best Employees</p> --}}
                        </div>
                    </div>
                    <div class="relative overflow-x-auto">
                        table
                    </div>
                </x-card>
            </div>
        </div>


    </div>
</x-layout>
