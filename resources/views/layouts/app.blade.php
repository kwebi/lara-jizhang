<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- 样式 -->
    <script src="{{asset('cdn/tailwindcss3.4.js')}}"></script>
    <script src="{{asset('layui/layui.js')}}"></script>        
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}">
    <title>@yield('title', '记账') 记账 </title>
    
</head>
<body>
    <div id="app" class="flex flex-col w-full">
        @include('layouts._header')
        <div class="container grid card rounded-box place-items-center">
            @yield('content')
        </div>
        @include('layouts._footer')
    </div>
    <!-- JS 脚本 -->
    <script src="{{asset('cdn/alpine.min.js')}}"></script>
    @yield('scriptsAfterJs')
</body>
</html>