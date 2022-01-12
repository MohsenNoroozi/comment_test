<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Test project for Mohsen Noroozi<mnoroozi28@gmail.com>">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="32x32">
    <title>Comments</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<noscript>
    <strong>We're sorry but <%= htmlWebpackPlugin.options.title %> doesn't work properly without JavaScript enabled.
        Please enable it to continue.</strong>
</noscript>
<div id="app"></div>
<script src="{{ mix('js/main.js') }}"></script>
</body>

</html>
