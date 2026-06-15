<x-form.message status="two-factor-authentication-enabled"
    message="Two-factor authentication is enabled. Please complete the configuration below." />
<x-form.message status="two-factor-authentication-disabled" message="Two-factor authentication has been disabled." />
<x-form.message status="two-factor-authentication-confirmed"
    message="Two-factor authentication was confirmed and enabled successfully." />

<p class="mt-2 text-sm leading-relaxed text-slate-600">
    When two factor authentication is enabled, you will be prompted for a secure, random token
    during authentication. You may retrieve this token from your phone's Google Authenticator
    application.
</p>

@if (!$user->two_factor_secret)
    <form action="{{ route('two-factor.enable') }}" method="POST">
        @csrf

        <button type="submit" class="btn my-4 text-base font-medium text-white hover:bg-blue-700">
            Enable 2FA
        </button>
    </form>
@else
    <div class="space-y-5">
        <div class="space-y-5 rounded-xl border border-slate-300 p-5">
            @if (!$user->two_factor_confirmed_at)
                <p class="mt-2 text-center text-sm leading-relaxed text-slate-600">
                    Two factor authentication is now enabled. Scan the following QR code using your
                    phone's authenticator application and provide a valid two-factor authentication
                    code to confirm authentication configuration.
                </p>
                <div class="flex items-center justify-evenly gap-3">
                    <div>
                        {!! $user->twoFactorQrCodeSvg() !!}
                    </div>
                    <form action="{{ route('two-factor.confirm') }}" method="POST">
                        @csrf

                        <x-form.field label="Enter the code here:" name="code"
                            errbag="confirmTwoFactorAuthentication" />

                        <button type="submit"
                            class="btn-outline-primary mt-4 w-full text-base font-medium text-white hover:bg-blue-700/80 hover:text-white">
                            Confirm configuration
                        </button>
                    </form>
                </div>
            @else
                <p class="mt-2 text-center text-sm leading-relaxed text-slate-600">
                    Two-factor authentication confirmed and enabled successfully.
                </p>
            @endif


        </div>

        <div class="space-y-5 rounded-xl border border-slate-300 p-5">
            <p class="mt-2 text-center text-sm leading-relaxed text-slate-600">
                Store these recovery codes in a secure password manager. They can be used to recover
                access to your account if your two factor authentication device is lost.
            </p>
            <div class="flex items-center justify-evenly gap-3">
                <div>
                    @foreach (json_decode(decrypt($user->two_factor_recovery_codes)) as $code)
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

        <button type="submit" class="btn my-4 py-2.5 text-base font-medium text-white hover:bg-blue-700">
            Disable 2FA
        </button>
    </form>
@endif
