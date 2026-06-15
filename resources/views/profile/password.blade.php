<x-form.message status="password-updated" message="Password has been updated." />

<form action="{{ route('user-password.update') }}" method="POST">
    @csrf
    @method('PUT')

    <x-form.field label="Current Password" name="current_password" type="password" errbag="updatePassword" required />
    <x-form.field label="Password" name="password" type="password" errbag="updatePassword" required />
    <x-form.field label="Repeat Password" name="password_confirmation" type="password" errbag="updatePassword"
        required />

    <button type="submit" class="btn my-4 py-2.5 text-base font-medium text-white hover:bg-blue-700">
        Update Password
    </button>

</form>
