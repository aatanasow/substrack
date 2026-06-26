@props(['transaction' => new \App\Models\SubscriptionPayment(), 'subsList' => [0 => 'Empty']])

<x-card class="lg:max-w-2/3 mx-auto">

    <form action="{{ $transaction->exists ? route('transaction.update', $transaction) : route('transaction.store') }}"
        method="POST">
        @csrf
        @if ($transaction->exists)
            @method('PATCH')
        @endif

        <div class="space-y-1">
            @if ($transaction->exists)
                <div class="card-section my-5 flex items-center justify-center gap-3">
                    @if ($transaction->subscription->image_path)
                        <img class="h-15 w-15 rounded-full object-cover"
                            src="{{ asset('storage/' . $transaction->subscription->image_path) }}" alt aria-hidden="true">
                    @else
                        <img class="h-15 w-15 rounded-full object-cover" src="/images/logos/no-image.png" alt
                            aria-hidden="true">
                    @endif

                    <div>
                        <h3 class="text-dark line-clamp-1 font-semibold">{{ $transaction->subscription->title }}
                        </h3>
                    </div>
                </div>
            @else
                <div class="flex-1">
                    <div class="space-y-2">
                        <x-form.select label="Select subscription" name="subscription_id" :options="$subsList" />
                    </div>
                </div>
            @endif

            <div class="flex gap-3">

                <div class="flex-1">
                    <x-form.field label="Price {{ $transaction->exists ? '('.$transaction->subscription->currency->label().')' : '' }}" name="price" placeholder="Add price" required
                        value="{{ $transaction->price ? round($transaction->price, 2) : '' }}" />
                </div>

                <div class="flex-1">
                    <div class="mb-4 space-y-2">
                        <label for="payment_date" class="text-dark mb-2 block text-sm font-semibold">Payment
                            Date</label>
                        <input type="date" id="payment_date" name="payment_date"
                            value="{{ ($transaction->payment_date ?? now())->format('Y-m-d') }}"
                            class="w-full rounded-md border-gray-200 px-4 py-3 text-sm focus:border-blue-600 focus:ring-0" />
                        <x-form.error name='payment_date' />
                    </div>
                </div>

            </div>


            <div class="flex justify-end gap-x-5">
                <a href="{{ url()->previousPath() }}"
                    class="btn-outline-primary hover:bg-blue-700/80 hover:text-white">Cancel</a>
                <button type="submit"
                    class="btn hover:bg-blue-700/80">{{ $transaction->exists ? 'Update' : 'Create' }}</button>
            </div>

        </div>
    </form>

</x-card>
