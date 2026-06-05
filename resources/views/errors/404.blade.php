<x-layout.blank>

    <main class="bg-info/5 grid min-h-full place-items-center px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-7xl font-bold text-blue-900">404</p>
            <h1 class="mt-4 text-balance text-4xl font-semibold tracking-tight text-blue-700 sm:text-5xl">
                Page not found
            </h1>
            <p class="mt-6 text-pretty text-lg font-medium text-gray-700 sm:text-xl/8">
                {{-- Sorry, we couldn't find the page you're looking for. --}}
                {{ $exception->getMessage() }}
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('landing') }}" class="btn hover:bg-blue-700/80">
                    Go back home
                </a>
                <a href="{{ route('contact') }}" class="btn-outline-primary hover:bg-blue-700/80 hover:text-white">
                    Contact support
                    <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </main>

    </x-layout>
