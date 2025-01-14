<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlashFoods Password Reset</title>
    <link href="{{ asset('css/resetLinkEmail.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Header component: resources/views/components/mail/mail-header.blade.php -->
    <x-mail.mail-header />

    <div class="content">
        <h1 class="title">Restablecer contraseña</h1>
        <p class="message">Hemos recibido una solicitud para restablecer tu contraseña. Haz clic en el siguiente enlace
            para crear una nueva contraseña:</p>
        <p>
            <a href="{{ $actionUrl }}" class="button">
                Click para restablecer tu contraseña
            </a>
        </p>
        <p class="support-text">
            Si no puedes hacer clic en el botón, copia y pega el siguiente enlace en un navegador:<br>
            <span class="reset-link">{{ $actionUrl }}</span>
        </p>
        <p class="warning-text">
            Si no fuiste tú quien solicitó este cambio de contraseña, por favor, ignora este correo.
        </p>
    </div>
    <div class="footer">
        © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
    </div>
    </div>
</body>

</html>