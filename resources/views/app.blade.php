<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
{{--        <link href="" type="image/x-icon" rel="icon">--}}

        <title>{{$title}}</title>

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
        <link href="{{url('assets/css/qstyle.css')}}" rel="stylesheet">
    </head>
    <body>

<!--    --><?php
//    $results = DB::select("select value from settings where `key`='title'");
//    $value=json_encode($results);
//    echo ($value);
//    ?>
        <div id="app">
        </div>

        @vite(['resources/js/web/app.js'])
    </body>
</html>

