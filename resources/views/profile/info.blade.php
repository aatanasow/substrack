<x-form.message status="profile-information-updated" message="Profile information has been updated." />

<form action="{{ route('user-profile-information.update') }}" method="POST">
    @csrf
    @method('PUT')

    <x-form.field label="Name" name="name" value="{{ $user->name }}" errbag="updateProfileInformation" required />
    <x-form.field label="Email Address" name="email" type="email" value="{{ $user->email }}"
        errbag="updateProfileInformation" required />

    <button type="submit" class="btn mt-4 py-2.5 text-base font-medium text-white hover:bg-blue-700">
        Update Account Info
    </button>
</form>
