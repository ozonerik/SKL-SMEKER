<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-metatag />
    </head>
    <body class="{{ Route::currentRouteName() == 'login' ? 'login-page' : (Route::currentRouteName() == 'register' ? 'register-page' : 'login-page') }} bg-body-secondary">
        <x-ui.icondarkmode/>
        <x-ui.buttondarkmode/>
        {{ $slot }}
        <x-script />
    </body><!--end::Body--> 
</html>
