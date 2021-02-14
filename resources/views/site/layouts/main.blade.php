<!doctype html>
<html lang="en" class="font-sans antialiased">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! meta()->render() !!}

    <script src="{{ asset('site/cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js') }}"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>

    <link rel="stylesheet"
        href="{{ asset('site/cdn.jsdelivr.net/gh/highlightjs/cdn-release%409.13.1/build/styles/sunburst.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('site/css/main.css?id=50f9b785cb9b0883434d') }}" rel="stylesheet">
    @yield('css')

    <script>
        if (window.matchMedia &&
            window.matchMedia('(prefers-color-scheme: light)').matches) {
            var head = document.getElementsByTagName('head')[0];
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.type = 'text/css';
            link.href = '../cdn.jsdelivr.net/gh/highlightjs/cdn-release%409.13.1/build/styles/github.min.css';
            head.appendChild(link);
        }
    </script>

    <style>
        @media (prefers-color-scheme: light) {
            body {
                background-color: #ffffff;
                background-image: linear-gradient(315deg, #ffffff 0%, #d7e1ec 74%);
            }

            .text-white,
            .text-text-color,
            a {
                color: #4a5568;
            }

            .border-light {
                border-color: #dbe6ef;
            }

            .text-muted {
                color: #3e5780;
            }

            .text-white:hover,
            a:hover {
                color: #000 !important;
            }

            .bg-light {
                background-color: #e9eef2;
            }

            .post-body code:not(.hljs) {
                background: #cde0ef;
                color: #205378;
            }

            .post-body pre {
                background: #e9eef2;
                color: #000;
            }
        }
    </style>
</head>

<body class="text-white body-bg-gradient bg-repeat-x ">
    @include('site.partials.header')
    @yield('content')
    @include('site.partials.footer')
    <script src="{{ asset('site/jquery.min.js') }}"></script>
    @yield('js')
</body>

</html>
