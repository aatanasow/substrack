<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        <x-card>

            <section class="px-4 py-6 md:px-6">
                <div class="mx-auto grid max-w-5xl items-start gap-16 md:grid-cols-2">
                    <div>
                        <div class="mb-2">
                            <h1 class="mb-6 text-3xl font-bold text-slate-900 md:text-4xl">
                                How to Use SubsTrack
                            </h1>
                            <p class="text-base leading-relaxed text-slate-600">
                                Welcome to SubsTrack! SubsTrack helps you keep all of your subscriptions in one place so
                                you always know what you're paying for and when your next payment is due.
                            </p>


                            <ol class="mt-6 list-decimal space-y-2 pl-4 text-slate-600">
                                <li>
                                    <h2 class="text-dark text-lg font-semibold">Add Your First Subscription</h2>
                                    <p class="mt-4 text-sm">Click Add Subscription and enter the details. Save the subscription to start tracking it.</p>
                                </li>
                                <li>
                                    <h2 class="text-dark text-lg font-semibold">View Your Dashboard</h2>
                                    <p class="mt-4 text-sm">The dashboard gives you an overview of Active subscriptions, Upcoming renewals, Monthly and yearly spending estimates, Recently added subscriptions </p>
                                </li>
                                <li>
                                    <h2 class="text-dark text-lg font-semibold">Edit or Remove Subscriptions</h2>
                                    <p class="mt-4 text-sm">Need to update a price or billing date? Open any subscription and select Edit. If you no longer use a service, you can delete or archive it.</p>
                                </li>
                                <li>
                                    <h2 class="text-dark text-lg font-semibold">Stay on Top of Renewals</h2>
                                    <p class="mt-4 text-sm">Check your upcoming renewals regularly so you know which subscriptions are about to renew. This helps you avoid unexpected charges and decide whether to keep or cancel a service.</p>
                                </li>
                                <li>
                                    <h2 class="text-dark text-lg font-semibold">Review Your Spending</h2>
                                    <p class="mt-4 text-sm">Use your subscription list to understand how much you're spending each month and year. Reviewing your subscriptions periodically can help you identify services you no longer use.</p>
                                </li>
                        </div>

                    </div>

                    <div>
                        <h2 class="text-dark text-lg font-semibold">Frequently Asked Questions</h2>


                        <div class="mt-6">
                            <div class="mx-auto max-w-7xl space-y-4">
                                <div
                                    class="parent-container rounded-md border-2 border-blue-600 bg-white transition-all [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] hover:border-blue-600">
                                    <h3>
                                        <button type="button" aria-expanded="true" aria-controls="faq-1"
                                            id="faq-1-button"
                                            class="accordion-button flex w-full cursor-pointer items-center gap-4 p-4 text-left text-base font-medium text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                                            <span>How do I add a new subscription?</span>
                                            <i class="ti ti-chevron-down rotate-180 arrow-icon ml-auto text-2xl transition-transform duration-300" aria-hidden="true"></i>
                                        </button>
                                    </h3>
                                    <div id="faq-1" role="region" aria-labelledby="faq-1-button" aria-hidden="false"
                                        class="accordion-content overflow-hidden transition-all duration-300 ease-in-out">
                                        <div class="px-4 pb-4">
                                            <p class="text-base leading-relaxed text-slate-600">
                                                Click Add Subscription, fill in the required information such as the service name, price, billing frequency, and next billing date, then click Save.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="parent-container rounded-md border-2 border-transparent bg-white transition-all [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] hover:border-blue-600">
                                    <h3>
                                        <button type="button" aria-expanded="false" aria-controls="faq-2"
                                            id="faq-2-button"
                                            class="accordion-button flex w-full cursor-pointer items-center gap-4 p-4 text-left text-base font-medium text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                                            <span>Can I edit a subscription after creating it?</span>
                                            <i class="ti ti-chevron-down arrow-icon ml-auto text-2xl transition-transform duration-300" aria-hidden="true"></i>
                                        </button>
                                    </h3>
                                    <div id="faq-2" role="region" aria-labelledby="faq-2-button" aria-hidden="true"
                                        class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                        <div class="px-4 pb-4">
                                            <p class="text-base leading-relaxed text-slate-600">
                                                Yes. Open the subscription you want to update and select Edit. You can change details such as the price, billing cycle, renewal date, notes, or category.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="parent-container rounded-md border-2 border-transparent bg-white transition-all [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] hover:border-blue-600">
                                    <h3>
                                        <button type="button" aria-expanded="false" aria-controls="faq-3"
                                            id="faq-3-button"
                                            class="accordion-button flex w-full cursor-pointer items-center gap-4 p-4 text-left text-base font-medium text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                                            <span>How are my monthly and yearly totals calculated?</span>
                                            <i class="ti ti-chevron-down arrow-icon ml-auto text-2xl transition-transform duration-300" aria-hidden="true"></i>
                                        </button>
                                    </h3>
                                    <div id="faq-3" role="region" aria-labelledby="faq-3-button" aria-hidden="true"
                                        class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                        <div class="px-4 pb-4">
                                            <p class="text-base leading-relaxed text-slate-600">
                                                SubsTrack estimates your spending based on the billing amount and frequency for each active subscription. The totals update automatically whenever you add, edit, or remove a subscription.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="parent-container rounded-md border-2 border-transparent bg-white transition-all [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] hover:border-blue-600">
                                    <h3>
                                        <button type="button" aria-expanded="false" aria-controls="faq-4"
                                            id="faq-4-button"
                                            class="accordion-button flex w-full cursor-pointer items-center gap-4 p-4 text-left text-base font-medium text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                                            <span>What happens if I cancel a subscription?</span>
                                            <i class="ti ti-chevron-down arrow-icon ml-auto text-2xl transition-transform duration-300" aria-hidden="true"></i>
                                        </button>
                                    </h3>
                                    <div id="faq-4" role="region" aria-labelledby="faq-4-button" aria-hidden="true"
                                        class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                        <div class="px-4 pb-4">
                                            <p class="text-base leading-relaxed text-slate-600">
                                                You can delete or archive the subscription to remove it from your active list. Archived subscriptions remain available for your records but are not included in spending calculations.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="parent-container rounded-md border-2 border-transparent bg-white transition-all [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] hover:border-blue-600">
                                    <h3>
                                        <button type="button" aria-expanded="false" aria-controls="faq-5"
                                            id="faq-5-button"
                                            class="accordion-button flex w-full cursor-pointer items-center gap-4 p-4 text-left text-base font-medium text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                                            <span>Why should I keep my billing dates up to date?</span>
                                            <i class="ti ti-chevron-down arrow-icon ml-auto text-2xl transition-transform duration-300" aria-hidden="true"></i>
                                        </button>
                                    </h3>
                                    <div id="faq-5" role="region" aria-labelledby="faq-5-button" aria-hidden="true"
                                        class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                        <div class="px-4 pb-4">
                                            <p class="text-base leading-relaxed text-slate-600">
                                                Keeping billing dates accurate helps ensure your upcoming renewals are displayed correctly, making it easier to plan your expenses and avoid unexpected charges.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="parent-container rounded-md border-2 border-transparent bg-white transition-all [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] hover:border-blue-600">
                                    <h3>
                                        <button type="button" aria-expanded="false" aria-controls="faq-6"
                                            id="faq-6-button"
                                            class="accordion-button flex w-full cursor-pointer items-center gap-4 p-4 text-left text-base font-medium text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                                            <span>Does SubsTrack send renewal reminders?</span>
                                            <i class="ti ti-chevron-down arrow-icon ml-auto text-2xl transition-transform duration-300" aria-hidden="true"></i>
                                        </button>
                                    </h3>
                                    <div id="faq-6" role="region" aria-labelledby="faq-6-button" aria-hidden="true"
                                        class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                        <div class="px-4 pb-4">
                                            <p class="text-base leading-relaxed text-slate-600">
                                                Yes. SubsTrack can send reminders before a subscription renews so you have time to review or cancel the service before you are charged. You can choose how far in advance you want to be notified (for example, 1 day, 3 days, or 7 days before renewal).
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="parent-container rounded-md border-2 border-transparent bg-white transition-all [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] hover:border-blue-600">
                                    <h3>
                                        <button type="button" aria-expanded="false" aria-controls="faq-7"
                                            id="faq-7-button"
                                            class="accordion-button flex w-full cursor-pointer items-center gap-4 p-4 text-left text-base font-medium text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                                            <span>Is my subscription data secure?</span>
                                            <i class="ti ti-chevron-down arrow-icon ml-auto text-2xl transition-transform duration-300" aria-hidden="true"></i>
                                        </button>
                                    </h3>
                                    <div id="faq-7" role="region" aria-labelledby="faq-7-button" aria-hidden="true"
                                        class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                        <div class="px-4 pb-4">
                                            <p class="text-base leading-relaxed text-slate-600">
                                                Yes. SubsTrack is designed to protect your subscription information using secure connections and encrypted data storage. We do not store your payment card details unless explicitly stated, and you remain in control of the subscription information you add to your account.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </section>

        </x-card>

    </div>
</x-layout>
