<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Our Platform</title>
  <link href="{{ asset('css/welcomeEmail.css') }}" rel="stylesheet">
</head>

<body>
  <div class="container">
    <!-- Header component: resources/views/components/mail/mail-header.blade.php -->
    <x-mail.mail-header />

    <div class="form-card">
      <h1>Welcome, {{ $user->name }}!</h1>
      <p>We're thrilled to have you on board! Our team is excited to help you get started.</p>

      <p>If you need any assistance, feel free to reach out to us at any time.</p>

      <p>We hope you have a great experience with us!</p>
    </div>

    <!-- Footer component -->
    <div class="footer">
      <p>Thank you for joining us.</p>
      <p><a href="{{ url('/') }}">Visit our platform</a></p>
    </div>
  </div>
</body>


</html>