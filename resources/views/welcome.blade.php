<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        <h1 class="my-5 text-center text-4xl">Easily keep the track of your subscriptions with
            <span class="font-bold">SubsTrack</span>
        </h1>

        <div class="flex w-full flex-row gap-6">
            <x-card class="flex-1">
                <h3 class="text-dark text-center text-3xl font-semibold">Free Version</h3>
                <p class="text-dark text-center text-lg font-semibold">Perfect for getting started with subscription
                    management</p>


                <div class="mt-4 space-y-10 text-center">
                    <img src="/images/free.jpg" class="max-w-full rounded" aria-hidden="true" alt="Free version">

                    <a href="{{ route('login') }}" class="btn hover:bg-blue-700/80">
                        Free version
                    </a>
                </div>

                <p class="text-center text-sm">Track your subscriptions, stay organized, and avoid unexpected
                    charges—all at no cost. The Free plan provides the essential tools individuals need to monitor
                    recurring payments and gain visibility into their spending.</p>

                <ul class="ml-5">
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-muted me-2"></span> Track up to 10 active subscriptions
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-muted me-2"></span>Automatic renewal reminders
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-muted me-2"></span>Monthly spending overview
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-muted me-2"></span>Basic subscription analytics
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-muted me-2"></span>Category-based organization
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-muted me-2"></span>Email notifications
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-muted me-2"></span>Mobile-friendly dashboard
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-muted me-2"></span>Community support
                    </li>
                </ul>

                <h3 class="text-dark text-center text-3xl font-semibold">Best For</h3>
                <p class="text-center text-sm">Individuals who want a simple way to manage personal subscriptions and
                    understand where their money is going.</p>

            </x-card>
            <x-card class="flex-1">
                <h3 class="text-dark text-center text-3xl font-semibold">Pro Version</h3>
                <h3 class="text-dark text-center text-lg font-semibold">Complete control over your recurring expenses
                </h3>

                <div class="mt-4 space-y-10 text-center">
                    <img src="/images/premium.jpg" class="max-w-full rounded" aria-hidden="true" alt="Free version">

                    <a href="{{ route('login') }}" class="btn hover:bg-blue-700/80">
                        Pro version
                    </a>
                </div>

                <p class="text-center text-sm">Unlock powerful tools designed for users who want deeper insights,
                    advanced automation, and unlimited subscription tracking. Save time, reduce unnecessary spending,
                    and make smarter financial decisions.</p>

                <ul class="ml-5">
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-primary me-2"></span>Unlimited subscription tracking
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-primary me-2"></span>Advanced spending analytics and trends
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-primary me-2"></span>Smart renewal forecasting
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-primary me-2"></span>Custom alerts and notification rules
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-primary me-2"></span>Multi-currency support
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-primary me-2"></span>Budget planning and spending limits
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-primary me-2"></span>Export reports (CSV, Excel, PDF)
                    </li>
                    <li class="text-dark py-2">
                        <span class="icon-circle circle-primary me-2"></span>Priority support
                    </li>
                </ul>

                <h3 class="text-dark text-center text-3xl font-semibold">Best For</h3>
                <p class="text-center text-sm">Power users, freelancers, families, and professionals who want comprehensive subscription management and advanced financial insights.</p>

            </x-card>
        </div>


    </div>
</x-layout>
