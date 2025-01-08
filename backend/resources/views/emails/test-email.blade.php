<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo de Prueba</title>
    <link href="{{ asset('css/testEmail.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Header component: resources/views/components/mail/mail-header.blade.php -->
    <x-mail.mail-header />

    <div class="content">
        <h1 class="title">Correo de Prueba</h1>
        <p class="message">Este es un correo de prueba enviado desde el proyecto FlashFood.</p>
        <p class="support-text">
            Si tienes alguna pregunta, por favor contacta a nuestro equipo de soporte.
        </p>
    </div>

    <div class="footer">
        © {{ date('Y') }} FlashFoods. Todos los derechos reservados.
    </div>
    </div>
</body>