<x-layout>

    <x-form title="Register an account" description="Start tracking your subscriptions">
        <form action="/register" method="POST">
            @csrf

            <x-form.field label="Name" name="name" />
            <x-form.field label="Email Address" name="email" type="email" />
            <x-form.field label="Password" name="password" type="password" />

            <button type="submit" class="btn my-4 w-full py-2.5 text-base font-medium text-white hover:bg-blue-700">
                Create Account
            </button>

            <div class="flex items-center justify-center gap-2">
                <p class="text-base font-medium text-gray-500">Already have an Account?</p>
                <a href="/login" class="text-sm font-medium text-blue-600 hover:text-blue-700">Sign In</a>
            </div>
        </form>
    </x-form>

</x-layout>
