<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($title)?$title:'Não existe'}}</title>
</head>
<body>
    @yield('content')

    @stack('scripts')
</body>
</html>
