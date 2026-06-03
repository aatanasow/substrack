<aside id="applicationSidebar" {{--  top-0 lg:  hs-overlay-open:translate-x-0 --}}
    class="hs-overlay left-sidebar w-67.5 xl:inset-e-autotop-19.5 absolute z-30 block shrink-0 -translate-x-full transform border-r border-gray-400/20 bg-white transition-all duration-300 lg:sticky lg:bottom-0 lg:block lg:translate-x-0">

    <!-- Start Vertical Layout Sidebar -->
    <div class="scroll-sidebar">
        <div class="px-6 pt-8">
            <nav class="sidebar-nav flex w-full flex-col">
                <ul id="sidebarnav" class="text-dark text-sm">
                    <li class="pb-4 text-xs font-bold">
                        <i class="ti ti-dots nav-small-cap-icon hidden text-center text-lg"></i>
                        <span>HOME</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link hover:text-primary hover:bg-primary/15 flex w-full items-center gap-3 rounded-md px-3 py-3"
                            href="#">
                            <i class="ti ti-layout-dashboard text-xl"></i>
                            <span>Dashboard</span>
                        </a>

                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link hover:text-primary hover:bg-primary/15 flex w-full items-center justify-between gap-3 rounded-md px-3 py-3"
                            href="#">
                            <span class="flex items-center gap-3">
                                <i class="ti ti-calendar-event text-xl"></i>
                                <span>Calendar</span>
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link hover:text-primary hover:bg-primary/15 flex w-full items-center justify-between gap-3 rounded-md px-3 py-3"
                            href="{{ route('subscription.index') }}">
                            <span class="flex items-center gap-3">
                                <i class="ti ti-wallet text-xl"></i>
                                <span>Subscriptions</span>
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link hover:text-primary hover:bg-primary/15 flex w-full items-center justify-between gap-3 rounded-md px-3 py-3"
                            href="#">
                            <span class="flex items-center gap-3">
                                <i class="ti ti-settings text-xl"></i>
                                <span>Settings</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- </aside> -->
    </div>


</aside>

<div id="sidebarBackdrop"
    class="fixed inset-0 hidden bg-gray-900/40 transition z-30 duration-300 lg:bg-transparent dark:bg-neutral-900/40 dark:lg:bg-transparent">
</div>

