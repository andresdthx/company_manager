<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p><b>New company:</b> {{$item->name}} </p>
    <p><a href="{{ url('/company/'.$item->id) }}">Link</a> </p>
</body>
</html>
