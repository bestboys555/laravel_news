<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Admin - @yield('pageTitle')</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" href="{!! asset('img/stock.png') !!}" type="image/x-icon" />
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
<link rel="stylesheet" href="{!! asset('plugins/bootstrap/dist/css/bootstrap.min.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/fontawesome-free/css/all.min.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/icon-kit/dist/css/iconkit.min.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/ionicons/dist/css/ionicons.min.css') !!}">
@yield('csspage')
<link rel="stylesheet" href="{!! asset('dist/css/theme.css') !!}">
<script src="{!! asset('src/js/vendor/modernizr-2.8.3.min.js') !!}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
