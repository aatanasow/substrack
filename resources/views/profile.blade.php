<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        <h1 class="my-5 text-center text-2xl">
            <span class="font-bold">{{ auth()->user()->name }} profile</span>
        </h1>

        {{-- @if (session('status'))
            <div class="text-success mb-4 text-center text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif --}}

        <x-card>

            <ul role="tablist" aria-label="Profile sections"
                class="inline-flex flex-wrap gap-2 border-b border-slate-300 text-sm font-medium text-slate-600">
                <li>
                    <a href="{{ route('profile') }}" role="tab" id="profileInfoTab" aria-selected="true"
                        aria-controls="profileInfoContent"
                        class="{{ !request('tab') ? 'border-blue-700 text-blue-700' : 'border-transparent' }} tab relative top-px flex cursor-pointer items-center gap-2 border-b-2 px-3.5 py-2 transition-colors hover:text-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                        <i class="ti ti-user text-xl"></i>
                        Profile info
                    </a>
                </li>
                <li>
                    {{-- <a class=""> --}}
                    <a href="{{ route('profile') }}?tab=password" role="tab" id="passwordTab" aria-selected="false"
                        aria-controls="passwordContent"
                        class="{{ request('tab') === 'password' ? 'border-blue-700 text-blue-700' : 'border-transparent' }} tab relative top-px flex cursor-pointer items-center gap-2 border-b-2 px-3.5 py-2 transition-colors hover:text-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                        <i class="ti ti-key text-xl"></i>
                        Password
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile') }}?tab=security" role="tab" id="securityTab" aria-selected="false"
                        aria-controls="securityContent"
                        class="{{ request('tab') === 'security' ? 'border-blue-700 text-blue-700' : 'border-transparent' }} tab relative top-px flex cursor-pointer items-center gap-2 border-b-2 px-3.5 py-2 transition-colors hover:text-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                        <i class="ti ti-lock text-xl"></i>
                        Security
                    </a>
                </li>
            </ul>

            <!-- Tab Panels -->
            <div class="px-3">
                <div id="profileInfoContent" role="tabpanel" aria-labelledby="profileInfoTab"
                    class="{{ !request('tab') ? 'block' : 'hidden' }} tab-content mt-8 max-w-xl space-y-9">
                    <h4 class="text-base font-semibold text-slate-900">Update your profile information</h4>

                    @if (session('status') === 'profile-information-updated')
                        <div class="text-success mb-4 text-sm font-medium">
                            Profile info has been updated.
                        </div>
                    @endif

                    <form action="{{ route('user-profile-information.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <x-form.field label="Name" name="name" value="{{ auth()->user()->name }}" errbag="updateProfileInformation" required />
                        <x-form.field label="Email Address" name="email" type="email"
                            value="{{ auth()->user()->email }}" errbag="updateProfileInformation" required />

                        <button type="submit"
                            class="btn my-4 py-2.5 text-base font-medium text-white hover:bg-blue-700">
                            Update Account Info
                        </button>


                    </form>
                </div>

                <div id="passwordContent" role="tabpanel" aria-labelledby="passwordTab"
                    class="{{ request('tab') === 'password' ? 'block' : 'hidden' }} tab-content mt-8 max-w-xl space-y-9">
                    <h4 class="text-base font-semibold text-slate-900">Update your password</h4>

                    @if (session('status') === 'password-updated')
                        <div class="text-success mb-4 text-sm font-medium">
                            Password has been updated.
                        </div>
                    @endif

                    <form action="{{ route('user-password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <x-form.field label="Current Password" name="current_password" type="password" errbag="updatePassword" required />
                        <x-form.field label="Password" name="password" type="password" errbag="updatePassword" required />
                        <x-form.field label="Repeat Password" name="password_confirmation" type="password" errbag="updatePassword" required />

                        <button type="submit"
                            class="btn my-4 py-2.5 text-base font-medium text-white hover:bg-blue-700">
                            Update Password
                        </button>

                    </form>
                </div>

                <div id="securityContent" role="tabpanel" aria-labelledby="securityTab"
                    class="{{ request('tab') === 'security' ? 'block' : 'hidden' }} tab-content mt-8 max-w-2xl space-y-9">
                    <h4 class="text-base font-semibold text-slate-900">Two factor authentication (2FA)</h4>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600">
                        When two factor authentication is enabled, you will be prompted for a secure, random token
                        during authentication. You may retrieve this token from your phone's Google Authenticator
                        application.
                    </p>

                    {{-- @if (session('status') === 'two-factor-authentication-enabled')
                        <div class="text-success mb-4 text-sm font-medium">
                            Please finish configuring two-factor authentication below.
                        </div>
                    @endif --}}

                    @if (session('status') === 'two-factor-authentication-disabled')
                        <div class="text-success mb-4 text-sm font-medium">
                            Two-factor authentication has been disabled.
                        </div>
                    @endif

                    @if (session('status') == 'two-factor-authentication-confirmed')
                        <div class="mb-4 text-sm font-medium">
                            Two-factor authentication confirmed and enabled successfully.
                        </div>
                    @endif

                    @if (!auth()->user()->two_factor_secret)
                        <form action="{{ route('two-factor.enable') }}" method="POST">
                            @csrf

                            <button type="submit" class="btn my-4 text-base font-medium text-white hover:bg-blue-700">
                                Enable 2FA
                            </button>
                        </form>
                    @else
                        <div class="space-y-5">
                            <div class="space-y-5 rounded-xl border border-slate-300 p-5">
                                <p class="mt-2 text-center text-sm leading-relaxed text-slate-600">
                                    Two factor authentication is now enabled. Scan the following QR code using your
                                    phone's authenticator application.
                                </p>
                                <div class="flex items-center justify-evenly gap-3">
                                    <div>
                                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                    </div>
                                    @if (!auth()->user()->two_factor_confirmed_at)
                                        <form action="{{ route('two-factor.confirm') }}" method="POST">
                                            @csrf

                                            <x-form.field label="Enter the code here:" name="code"
                                                errbag="confirmTwoFactorAuthentication" />

                                            <button type="submit"
                                                class="btn-outline-primary mt-4 w-full text-base font-medium text-white hover:bg-blue-700/80 hover:text-white">
                                                Confirm configuration
                                            </button>
                                        </form>
                                    @endif

                                </div>

                            </div>

                            <div class="space-y-5 rounded-xl border border-slate-300 p-5">
                                <p class="mt-2 text-center text-sm leading-relaxed text-slate-600">
                                    Store these recovery codes in a secure password manager. They can be used to recover
                                    access to your account if your two factor authentication device is lost.
                                </p>
                                <div class="flex items-center justify-evenly gap-3">
                                    <div>
                                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                            <div>{{ $code }}</div>
                                        @endforeach
                                    </div>


                                    <form action="{{ route('two-factor.regenerate-recovery-codes') }}" method="POST">
                                        @csrf

                                        <button type="submit"
                                            class="btn-outline-primary mt-4 text-base font-medium text-white hover:bg-blue-700/80 hover:text-white">
                                            Regenerate codes
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>


                        <form action="{{ route('two-factor.enable') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn my-4 py-2.5 text-base font-medium text-white hover:bg-blue-700">
                                Disable 2FA
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        </x-card>

    </div>
</x-layout>
