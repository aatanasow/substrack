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


        <x-card class="w-full">
            <h1 class="mt-5 text-center text-2xl">
                <div class="card-section flex items-center justify-between gap-3">

                    <div class="flex items-center gap-3">

                        @if ($subscription->image_path)
                            <img class="h-9 w-9 rounded-full object-cover"
                                src="{{ asset('storage/' . $subscription->image_path) }}" alt aria-hidden="true">
                        @else
                            <img class="h-9 w-9 rounded-full object-cover" src="/images/logos/no-image.png" alt
                                aria-hidden="true">
                        @endif

                        {{ $subscription->title }}
                    </div>

                    <div class="flex items-center gap-3">

                        <x-status-label status="{{ $subscription->status->value }}">
                            {{ $subscription->status->label() }}
                        </x-status-label>

                        @if ($subscription->link)
                            <div class="text-blue-500">
                                <a href="{{ $subscription->link }}" target="_blank">
                                    <i class="ti ti-external-link text-2xl"></i>
                                </a>
                            </div>
                        @endif
                    </div>



                </div>
            </h1>


            <div class="space-y-3">

                <div class="mt-1 flex items-center gap-3 text-sm">

                    <div class="card-section flex flex-1 flex-col items-center justify-center gap-3">
                        <div class="font-bold">
                            {{ $subscription->formatPrice($subscription->price, $subscription->currency) }}</div>
                        <div class="font-normal text-gray-500">{{ $subscription->frequency->label() }}</div>
                    </div>

                    <div class="card-section flex flex-1 flex-col items-center justify-center gap-3">
                        <div>Started {{ $subscription->start_date->diffForHumans() }}
                        </div>
                        <div>Remind {{ $subscription->notify }} days before
                        </div>
                    </div>

                    <div class="card-section flex flex-1 flex-col items-center justify-center gap-3">
                        <div><span class="font-bold">Next payment:</span> ...After 22 days</div>
                        <div><span class="font-bold">Total Spent:</span> ...123</div>
                    </div>

                </div>

                <div class="card-section">
                    @if ($subscription->description)
                        <div class="text-foreground prose prose-invert max-w-none">
                            {{ $subscription->description }}
                        </div>
                    @endif
                </div>
            </div>
        </x-card>
    </div>
</x-layout>
