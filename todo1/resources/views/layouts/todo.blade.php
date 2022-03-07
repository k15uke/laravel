<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @yield('style')
</head>

<body>
    <div class="container-md my-3">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1>@yield('title')</h1>
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
