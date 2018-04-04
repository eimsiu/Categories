<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Categories!!!</title>
    <link rel="stylesheet" href="../public/css/app.css">
</head>
<body>
@include('inc.navbar')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-10">
            @yield('content')
        </div>
    </div>
</div>

<footer id="footer" class="text-center">
    <p>Done by: Eimantas Šiugždinis</p>
</footer>

</body>
</html>