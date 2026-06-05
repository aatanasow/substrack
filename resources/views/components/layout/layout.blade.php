<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" type="image/png" href="/images/logos/favicon.png" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>SubTrack - track your subscriptions</title>
</head>

<body class="bg-info/5">
        <x-layout.nav>

        </x-layout.nav>
        <!--start the project-->
        <div id="main-wrapper" class="flex">

            @auth

            <x-layout.usernav />

            @endauth


            <div class="page-wrapper w-full overflow-hidden">

                <x-layout.search>

                </x-layout.search>

                <!-- Main Content -->
                <main class="h-full max-w-full overflow-y-auto pt-4">
                    {{ $slot }}
                </main>
                <!-- Main Content End -->

            </div>
        </div>

        <!--end of project-->

    @session('success')
        <div class="bg-primary text-white px-4 py-3 absolute top-25 right-4 rounded-lg animate-flash-fade-out opacity-0">{{ $value }}</div>
    @endsession

</body>
</html>
