@props(['subscription' => new \App\Models\Subscription()])

<x-card class="lg:max-w-2/3 mx-auto">
    <form
        action="{{ $subscription->exists ? route('subscription.update', $subscription) : route('subscription.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if ($subscription->exists)
            @method('PATCH')
        @endif

        <div class="space-y-1">
            <div class="flex gap-3">
                <div class="flex-1">
                    <x-form.field label="Title" name="title" placeholder="Enter a title" required :value="$subscription->title" />
                </div>
                <div class="flex-1">
                    <div class="space-y-2">
                        <x-form.select label="Status" name="status" :options="App\Enums\SubscriptionStatus::options()" required :value="$subscription->status->value" />
                        {{-- <div class="text-dark mb-2 block text-sm font-semibold">Status</div>
                                @foreach (App\SubscriptionStatus::cases() as $status)
                                    <input class="hidden" id="{{ $status->value }}" type="radio" name="status"
                                        value="{{ $status->value }}" {{ $status->value === 'active' ? 'checked' : '' }}>
                                    <label class="flex h-10 flex-1 items-center justify-center" for="{{ $status->value }}">
                                        {{ $status->label() }}
                                    </label>
                                @endforeach
                        <x-form.error name='status' /> --}}
                    </div>
                </div>
            </div>

            <div>
                <x-form.field label="Description" name="description" type="textarea"
                    placeholder="Describe your subscription" :value="$subscription->description" />
            </div>

            <div class="flex gap-3">
                <div class="flex-1">
                    <x-form.field label="Price" name="price" placeholder="Add price" required value="{{ $subscription->price ? round($subscription->price, 2) : '' }}" />
                </div>
                <div class="flex-1">
                    <x-form.select label="Currency" name="currency" :options="App\Enums\SubscriptionCurrency::options()" required :value="$subscription->currency->value" />
                </div>
            </div>

            <div class="flex gap-3">
                <div class="flex-1">
                    <div class="mb-4 space-y-2">
                        <label for="start_date" class="text-dark mb-2 block text-sm font-semibold">Start
                            Date</label>
                        <input type="date" id="start_date" name="start_date"
                            value="{{ ($subscription->start_date ?? now())->format('Y-m-d') }}"
                            class="w-full rounded-md border-gray-200 px-4 py-3 text-sm focus:border-blue-600 focus:ring-0" />
                        <x-form.error name='start_date' />
                    </div>
                </div>

                <div class="flex-1">
                    <x-form.select label="Frequency" name="frequency" :options="App\Enums\SubscriptionFrequency::options()" required
                        :value="$subscription->frequency->value" />

                </div>


            </div>

            <div class="flex gap-3">
                <div class="flex-1">
                    <x-form.field label="Link" name="link" placeholder="https://mysubs.com"
                        :value="$subscription->link" />
                </div>
                <div class="flex-1">
                    <x-form.field label="Reminder days" name="notify" placeholder="Add Reminder"
                        required :value="$subscription->notify ? $subscription->notify : 3" />
                </div>
            </div>

            <div class="mb-4 space-y-2">
                <label for="image_path" class="text-dark mb-2 block text-sm font-semibold">Icon
                    image</label>

                @if ($subscription->image_path)
                    <div class="card-section flex items-center justify-center gap-9">
                        <img src="{{ asset('storage/' . $subscription->image_path) }}" alt="{{ $subscription->title }}"
                            class="h-15 w-15 rounded-full object-cover">
                        <button class="btn-empty hover:bg-blue-700/80 hover:text-white" form="delete-image-form">
                            <i class="ti ti-x hover:text-primary text-sm"></i> Remove image
                        </button>
                    </div>
                @endif

                <input type="file" name="image_path" id="image_path" accept="image/*"
                    class="block w-full rounded-md border border-gray-200 px-1 py-1 text-sm focus:border-blue-600 focus:ring-0">
                <x-form.error name='image_path' />
            </div>

            <div class="flex justify-end gap-x-5">
                <a href="{{ url()->previousPath() }}"
                    class="btn-outline-primary hover:bg-blue-700/80 hover:text-white">Cancel</a>
                <button type="submit"
                    class="btn hover:bg-blue-700/80">{{ $subscription->exists ? 'Update' : 'Create' }}</button>
            </div>

        </div>

    </form>

    @if ($subscription->image_path)
        <form action="{{ route('subscription.image.destroy', $subscription) }}" method="POST" id="delete-image-form">
            @csrf
            @method('DELETE')

        </form>
    @endif
</x-card>
