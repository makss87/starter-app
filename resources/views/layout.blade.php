<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.2/examples/pricing/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="{{ url('/css/main.css') }}" rel="stylesheet">
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Sarvilin test</h5>

    @if(session('authenticated'))
        <a class="btn btn-outline-danger" href="{{ url('logout') }}">Выйти</a>
    @else
        <a class="btn btn-outline-primary" href="{{ url('login') }}">Войти</a>
    @endif
</div>

<main role="main" class="container">

    @yield('content')

</main><!-- /.container -->


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="/docs/4.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP"
        crossorigin="anonymous"></script>
</body>

</html>