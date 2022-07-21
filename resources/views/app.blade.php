<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Web</title>

        <script type='text/javascript'>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>

        <style>
            body {
                font-family: 'Noto Sans HK', sans-serif;
            }
        </style>
        <link href="{{url('assets/css/quasar.css')}}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
        </div>

        @vite(['resources/js/web/app.js'])
hihi
        hi
    </body>
</html>

