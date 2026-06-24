<header class="app-topstrip sticky top-0 z-50 w-full px-5 py-2">
    <nav class="h-15 flex flex-row items-center justify-between gap-3" aria-label="Global">

        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}">
                <img src="/images/logos/logo-substrack.svg" alt class="max-w-36" aria-hidden="true">
            </a>
            <span class="hidden h-5 w-px border-e border-gray-400/50 sm:block"></span>
            <a href="{{ route('help') }}"
                class="hover:text-primary hidden items-center gap-2 text-base text-white sm:flex">
                <i class="ti ti-help-circle text-xl"></i>
                Help
            </a>
            <a href="{{ route('contact') }}"
                class="hover:text-primary hidden items-center gap-2 text-base text-white sm:flex">
                <i class="ti ti-mail text-xl"></i>
                Contact Us
            </a>

        </div>
        <div class="flex items-center gap-3">

            @guest

                <a href="{{ route('login') }}" class="btn-empty hover:bg-blue-700/80 hover:text-white">
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn hover:bg-blue-700/80">
                    Register
                </a>

            @endguest


            @auth

                <ul class="icon-nav flex items-center gap-5">
                    <li class="relative lg:hidden">
                        <a class="icon-hover cursor-pointer text-xl text-white" id="headerCollapse"
                            aria-controls="applicationSidebar" aria-label="Toggle navigation" href="javascript:void(0)">
                            <i class="ti ti-menu-2 z-1 relative"></i>
                        </a>
                    </li>

                    <li class="relative">
                        <a class="icon-hover cursor-pointer text-xl text-white" id="headerSearch"
                            aria-controls="applicationSearch" aria-label="Toggle search bar" href="javascript:void(0)">
                            <i class="ti ti-zoom"></i>
                        </a>
                    </li>

                    <li class="relative">

                        <div class="group relative inline-block">
                            <a class="hs-dropdown-toggle icon-hover relative my-5 inline-flex text-white" href="#">
                                <i class="ti ti-bell-ringing z-1 relative text-xl"></i>
                                @if (auth()->user()->unreadNotifications()->exists())
                                    <div
                                        class="bg-secondary absolute -right-1.5 -top-px inline-flex h-2 w-2 items-center justify-center rounded-full text-[11px] font-medium text-white">
                                    </div>
                                @endif
                            </a>

                            <div
                                class="hs-dropdown-menu w-75 absolute right-0 hidden min-w-max rounded-md opacity-0 transition-[opacity,margin] group-hover:block group-hover:opacity-100">
                                <div>
                                    <div class="flex items-center justify-between rounded-t-md bg-gray-50 px-4 py-4">
                                        <h3 class="text-dark text-base font-semibold">
                                            Notifications
                                            <span
                                                class="text-xs text-gray-500">({{ auth()->user()->unreadNotifications()->count() }})</span>

                                        </h3>
                                        @if (auth()->user()->unreadNotifications()->exists())
                                        <form action="{{ route('notification.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-empty hover:bg-blue-700/80 hover:text-white">
                                                Mark all as read
                                            </button>
                                        </form>
                                        @endif

                                    </div>


                                    <ul class="mb-3 flex list-none flex-col">
                                        @if (!auth()->user()->unreadNotifications()->exists())
                                            <li>
                                                <p class="text-dark px-4 py-6 text-sm font-semibold text-center">
                                                    No notifications found
                                                </p>
                                            </li>
                                        @else
                                            @foreach (auth()->user()->unreadNotifications as $notification)
                                                <li
                                                    class="hover:bg-primary/10 flex max-w-80 items-start justify-between gap-3 px-4 py-2">
                                                    <a href="{{ route('subscription.show', $notification->data['subscription_id']) }}"
                                                        class="block">
                                                        <p class="text-dark text-sm font-semibold">
                                                            {{ $notification->data['title'] }}</p>
                                                        <p class="text-xs font-medium text-gray-500">
                                                            {{ $notification->data['message'] }}</p>
                                                    </a>
                                                    <form action="{{ route('notification.update', $notification) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')

                                                        <button type="submit" class="cursor-pointer hover:text-red-700/80">
                                                            <i class="ti ti-x text-xl"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </li>
                    <li class="relative">
                        <div class="group relative inline-block">
                            <button class="relative my-4 inline-flex">
                                @if (auth()->user()->image_path)
                                    <img src="{{ asset('storage/' . auth()->user()->image_path) }}"
                                        class="h-7 w-7 rounded-full object-cover" alt="{{ auth()->user()->name }}"
                                        aria-hidden="true">
                                @else
                                    <img src="/images/profile/user.png" class="h-7 w-7 rounded-full object-cover"
                                        alt="{{ auth()->user()->name }}" aria-hidden="true">
                                @endif
                            </button>

                            <div class="hs-dropdown-menu w-50 absolute right-0 z-20 hidden rounded-lg bg-white py-3 shadow-md transition-[opacity,margin] group-hover:block"
                                role="menu">
                                <div class="space-y-1">
                                    <a href="{{ route('profile') }}"
                                        class="hover:bg-primary/10 flex items-center gap-2 px-4 py-2.5">
                                        <i class="ti ti-user text-xl text-gray-500"></i>
                                        <p class="text-dark text-sm">My Profile</p>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="hover:bg-primary/10 flex items-center gap-2 px-4 py-2.5">
                                        <i class="ti ti-settings text-xl text-gray-500"></i>
                                        <p class="text-dark text-sm">Account Settings</p>
                                    </a>
                                    <a href="{{ route('subscription.create') }}"
                                        class="hover:bg-primary/10 flex items-center gap-2 px-4 py-2.5">
                                        <i class="ti ti-list-check text-xl text-gray-500"></i>
                                        <p class="text-dark text-sm">New Subscription</p>
                                    </a>
                                    <div class="mt-1.75 grid px-4">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="btn-outline-primary w-full hover:bg-blue-700/80 hover:text-white">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

            @endauth

        </div>
    </nav>

</header>
