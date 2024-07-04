<!doctype html>
<html lang="en" class="h-100">
    <head>
        <x-metatag />
        <!-- Custom styles for this template -->
        <link href="{{ asset('assets/css/sticky-footer-navbar.css') }}" rel="stylesheet">
    </head>
    <body class="d-flex flex-column h-100">
        <x-ui.icondarkmode/>
        <x-ui.buttondarkmode/>
        <header>
        @if (Route::has('login'))
            <livewire:menu.homenavigation />
        @endif
        </header>
        <!-- Begin page content -->
        <main class="app-main">
            {{ $slot }}
        </main>
        <footer class="footer mt-auto py-3 bg-body-tertiary">
            <div class="container">
                <x-footer />
            </div>
        </footer>
        <x-script />
  </body>
</html>