<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Web</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{url('assets/css/qstyle.css')}}" rel="stylesheet">
    <link href="{{url('assets/ckeditor5/ckeditor.css')}}" rel="stylesheet">
    <script src="{{url('assets/ckeditor5/ckeditor.js')}}"></script>


    <script type='text/javascript'>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <script src="{{url('assets/js/embedly.js')}}"></script>

    <style>
        body {
            font-family: 'Noto Sans HK', sans-serif;
        }
    </style>
</head>

<body>
<div id="app">

</div>
@vite(['resources/js/admin/admin.js'])
</body>
</html>
