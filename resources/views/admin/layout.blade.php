<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欧子博客 | @yield('title')</title>
    @include('admin.partials.head')
</head>
<body>
<!-- 头部 -->
@include('admin.partials.header')
<!-- 主体 -->
<main>
    @section('main')
        @include('admin.partials.sidebar')
    @show
</main>
<!-- 底部 -->
@include('admin.partials.footer')
</body>
</html>