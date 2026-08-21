<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Libs CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" />

    <!-- Theme CSS -->
    {{--
    <link rel="stylesheet" href="./assets/css/theme.min.css"> --}}
    <!-- Analytics Code -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-M8S4MT3EYG");
    </script>

    <link rel="stylesheet" href="./assets/libs/apexcharts/dist/apexcharts.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/style.css','resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <!-- start sidebar -->
            @include('layouts.sidebar')
            <!--end of sidebar-->

            <!-- app layout content -->
            <div id="app-layout-content"
                class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
                <!-- start navbar -->
                @include('layouts.navbar')
                <!-- end of navbar -->

                <!-- <div> -->

                    {{ $slot }}



                    <footer>
                        <div class="px-6 border-t border-gray-300 py-3 flex justify-between items-center">
                            <p class="m-0 leading-6">
                                Made by
                                <a href="https://codescandy.com/" target="_blank" class="text-indigo-600">Codescandy</a>
                            </p>
                            <a href="https://github.com/codescandy/dashui-tailwindcss" target="_blank">
                                <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-gray-800">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.463 2 11.97c0 4.404 2.865 8.14 6.839 9.458.5.092.682-.216.682-.48 0-.236-.008-.864-.013-1.695-2.782.602-3.369-1.337-3.369-1.337-.454-1.151-1.11-1.458-1.11-1.458-.908-.618.069-.606.069-.606 1.003.07 1.531 1.027 1.531 1.027.892 1.524 2.341 1.084 2.91.828.092-.643.35-1.083.636-1.332-2.22-.251-4.555-1.107-4.555-4.927 0-1.088.39-1.979 1.029-2.675-.103-.252-.446-1.266.098-2.638 0 0 .84-.268 2.75 1.022A9.607 9.607 0 0 1 12 6.82c.85.004 1.705.114 2.504.336 1.909-1.29 2.747-1.022 2.747-1.022.546 1.372.202 2.386.1 2.638.64.696 1.028 1.587 1.028 2.675 0 3.83-2.339 4.673-4.566 4.92.359.307.678.915.678 1.846 0 1.332-.012 2.407-.012 2.734 0 .267.18.577.688.48 3.97-1.32 6.833-5.054 6.833-9.458C22 6.463 17.522 2 12 2Z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </footer>
                <!-- </div> -->
            </div>
        </div>
        <!-- end of project -->
    </main>

    <!-- Libs JS -->
    <!-- {{-- <script src="./assets/libs/feather-icons/dist/feather.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/libs/simplebar/dist/simplebar.min.js"></script> --}} -->

    <!-- Theme JS -->
    <!-- {{-- <script src="./assets/js/theme.min.js"></script> --}} -->
</body>

</html>