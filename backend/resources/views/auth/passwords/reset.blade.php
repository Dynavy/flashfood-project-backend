<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password View</title>
    <link href="{{ asset('css/resetPasswordForm.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="form-card">
            <!-- Header component: resources/views/components/mail/mail-header.blade.php -->
            <x-mail.mail-header />

            <form action="/reset-password" method="POST">
                @csrf
                <input type="hidden" id="token" name="token">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="submit-btn">Reset Password</button>
            </form>
        </div>
    </div>
    <script>
        // Get token from URL and set it in the hidden input
        const token = window.location.pathname.split('/').pop();
        document.getElementById('token').value = token;
    </script>
</body>

</html>