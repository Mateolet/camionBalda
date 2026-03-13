<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Nuevo contacto</title>
    </head>
    <body>
        <h2>Nuevo contacto desde web</h2>
        <p><strong>Nombre:</strong> {{ $nombre }}</p>
        <p><strong>Empresa:</strong> {{ $empresa ?? '-' }}</p>
        <p><strong>Numero:</strong> {{ $numero ?? '-' }}</p>
        <p><strong>Mail:</strong> {{ $mail }}</p>
        <p><strong>Mensaje:</strong></p>
        <p>{{ $contacto }}</p>
    </body>
</html>
