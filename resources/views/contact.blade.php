<x-layout>
    <div class="container flex flex-col gap-6 py-5">

        <x-card>

            <section class="px-4 py-6 md:px-6">
                <div class="mx-auto grid max-w-5xl items-start gap-16 md:grid-cols-2">
                    <div>
                        <div class="mb-12">
                            <h1 class="mb-6 text-3xl font-bold text-slate-900 md:text-4xl">
                                Let's Talk
                            </h1>
                            <p class="text-base leading-relaxed text-slate-600">
                                Have some big idea or brand to develop and need help? Then reach out we'd love to hear
                                about your project and provide help.
                            </p>
                        </div>

                        <div class="mt-12">
                            <h3 class="text-base font-semibold text-slate-900">Email</h3>
                            <ul class="mt-4">
                                <li class="flex items-center">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 p-2 text-slate-600">
                                        <i class="ti ti-mail text-xl"></i>
                                    </div>
                                    <a href="#" class="ml-4 text-sm">
                                        <small class="block text-slate-900">Mail</small>
                                        <span class="font-semibold text-blue-600">contact@substrack.com</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-base font-semibold text-slate-900">Socials</h3>
                            <ul class="mt-4 flex flex-wrap gap-4">
                                <li>
                                    <a href="#"
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 p-2 text-slate-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                                        aria-label="Facebook">
                                        <i class="ti ti-brand-facebook text-xl"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 p-2 text-slate-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                                        aria-label="LinkedIn">
                                        <i class="ti ti-brand-linkedin text-xl"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 p-2 text-slate-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                                        aria-label="X">
                                        <i class="ti ti-brand-x text-xl"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('contact.send') }}" class="space-y-4">
                        @csrf

                        <div>
                            <x-form.field label="Full Name" name="name" value="{{ old('name') }}" required />
                        </div>
                        <div>
                            <x-form.field label="Email Address" name="email" type="email" value="{{ old('email') }}" required />
                        </div>
                        <div>
                            <x-form.field label="Phone number" name="phone" type="tel" value="{{ old('phone') }}" required />
                        </div>
                        <div>
                            <x-form.field label="Message" name="message" type="textarea" value="{{ old('message') }}" required />
                        </div>

                        <button type="submit" class="btn cursor-pointer hover:bg-blue-700/80">Send message</button>
                    </form>
                </div>
            </section>

        </x-card>

    </div>
</x-layout>
