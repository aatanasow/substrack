<header class="app-topstrip sticky top-0 z-50 w-full px-5 py-2">
    <nav class="flex flex-row items-center justify-between gap-3 h-15" aria-label="Global">

        <div class="flex items-center gap-6">
            <a href="{{ route('landing') }}">
                <img src="/images/logos/logo-substrack.svg" alt class="max-w-36" aria-hidden="true">
            </a>
            <span class="hidden h-5 w-px border-e border-gray-400/50 sm:block"></span>
            <a href="{{ route('help') }}" class="hover:text-primary hidden items-center gap-2 text-base text-white sm:flex">
                <i class="ti ti-help-circle text-xl"></i>
                Help
            </a>
            <a href="{{ route('contact') }}" class="hover:text-primary hidden items-center gap-2 text-base text-white sm:flex">
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
                            <div
                                class="bg-secondary absolute -right-1.5 -top-px inline-flex h-2 w-2 items-center justify-center rounded-full text-[11px] font-medium text-white">
                            </div>
                        </a>

                        <div
                            class="hs-dropdown-menu w-75 absolute right-0 hidden min-w-max rounded-md opacity-0 transition-[opacity,margin] group-hover:block group-hover:opacity-100">
                            <div>
                                <h3 class="text-dark px-6 py-3 text-base font-semibold">Notification
                                </h3>
                                <ul class="flex list-none flex-col">
                                    <li>
                                        <a href="#" class="hover:bg-primary/15 block px-6 py-3">
                                            <p class="text-dark text-sm font-semibold">Notification 1
                                            </p>
                                            <p class="text-xs font-medium text-gray-500">Description</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="hover:bg-primary/15 block px-6 py-3">
                                            <p class="text-dark text-sm font-semibold">Notification 2
                                            </p>
                                            <p class="text-xs font-medium text-gray-500">Description</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="hover:bg-primary/15 block px-6 py-3">
                                            <p class="text-dark text-sm font-semibold">Notification 3
                                            </p>
                                            <p class="text-xs font-medium text-gray-500">Description</p>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>

                </li>
                <li class="relative">
                    <div class="group relative inline-block">
                        <button class="relative my-4 inline-flex">
                            <img class="h-7 w-7 rounded-full object-cover" src="/images/profile/user.png" alt
                                aria-hidden="true">
                        </button>

                        <div class="hs-dropdown-menu w-50 absolute right-0 z-20 hidden rounded-lg bg-white py-3 shadow-md transition-[opacity,margin] group-hover:block"
                            role="menu">
                            <div class="space-y-1">
                                <a href="javascript:void(0)"
                                    class="hover:bg-primary/10 flex items-center gap-2 px-4 py-2.5">
                                    <i class="ti ti-user text-xl text-gray-500"></i>
                                    <p class="text-dark text-sm">My Profile</p>
                                </a>
                                <a href="javascript:void(0)"
                                    class="hover:bg-primary/10 flex items-center gap-2 px-4 py-2.5">
                                    <i class="ti ti-mail text-xl text-gray-500"></i>
                                    <p class="text-dark text-sm">My Account</p>
                                </a>
                                <a href="{{ route('subscription.create') }}"
                                    class="hover:bg-primary/10 flex items-center gap-2 px-4 py-2.5">
                                    <i class="ti ti-list-check text-xl text-gray-500"></i>
                                    <p class="text-dark text-sm">New Subscription</p>
                                </a>
                                <div class="mt-1.75 grid px-4">
                                    <form action="/logout" method="POST">
                                        @csrf

                                        <button
                                            type="submit"
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
