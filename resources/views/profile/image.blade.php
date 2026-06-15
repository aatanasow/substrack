<x-form.message status="profile-image-updated" message="Profile image has been updated." />
<x-form.message status="profile-image-removed" message="Profile image has been removed." />

<form action="{{ route('user.image.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="mb-4 space-y-2">
        @if ($user->image_path)
            <div class="card-section flex items-center justify-center gap-9">
                <img src="{{ asset('storage/' . $user->image_path) }}" alt="{{ $user->name }}"
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

    <button type="submit" class="btn mt-4 py-2.5 text-base font-medium text-white hover:bg-blue-700">
        {{ $user->image_path ? 'Update' : 'Add' }} Account Image
    </button>

</form>

@if ($user->image_path)
    <form action="{{ route('user.image.destroy', $user) }}" method="POST" id="delete-image-form">
        @csrf
        @method('DELETE')

    </form>
@endif
