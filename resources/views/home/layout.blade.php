<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欧子博客 | @yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    @include('home.partials.head')
</head>
<body>
<div id="app">
<!-- 头部 -->
@include('home.partials.header')

<!-- 主体 -->
<main>
    @include('home.partials.sidebar')

    <!-- 主要内容 -->
    <article>
        @section('article')

        @show
    </article>
</main>

<!-- 底部 -->
@include('home.partials.footer')
</div>
</body>
</html>