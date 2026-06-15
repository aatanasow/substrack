<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        <h1 class="my-5 text-center text-2xl">
            <span class="font-bold">{{ $user->name }} profile</span>
        </h1>

        {{-- <x-form.message class="text-center" /> --}}

        <x-card>

            <ul role="tablist" aria-label="Profile sections"
                class="inline-flex flex-wrap gap-2 border-b border-slate-300 text-sm font-medium text-slate-600">
                <li>
                    <x-tab.button tab="info" route="profile" icon="user" active>
                        Profile info
                    </x-tab.button>
                </li>
                <li>
                    <x-tab.button tab="image" route="profile" icon="aperture">
                        Profile image
                    </x-tab.button>
                </li>
                <li>
                    <x-tab.button tab="password" route="profile" icon="key">
                        Password
                    </x-tab.button>
                </li>
                <li>
                    <x-tab.button tab="security" route="profile" icon="key">
                        Security
                    </x-tab.button>
                </li>
            </ul>

            <!-- Tab Panels -->
            <div class="px-3">
                <x-tab.content title="Update your profile information" tab="info" active>
                    {{ view('profile.info', ['user' => $user]) }}
                </x-tab.content>

                <x-tab.content title="{{ $user->image_path ? 'Update' : 'Add' }} your profile image" tab="image">
                    {{ view('profile.image', ['user' => $user]) }}
                </x-tab.content>

                <x-tab.content title="Update your password" tab="password">
                    {{ view('profile.password') }}
                </x-tab.content>

                <x-tab.content title="Two factor authentication (2FA)" tab="security">
                    {{ view('profile.security', ['user' => $user]) }}
                </x-tab.content>

            </div>

        </x-card>

    </div>
</x-layout>
