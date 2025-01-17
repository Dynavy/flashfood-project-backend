<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FlashFoods Password Reset</title>
  <link href="{{ asset('css/email-styles.css') }}" rel="stylesheet">
</head>

<body>
  <div class="email-container">
    <!-- Header component: resources/views/components/mail/mail-header.blade.php -->
    <x-mail.mail-header />

    <div class="content-wrapper">
      <div class="form-card">
        <h1 class="title">Reset Password</h1>
        <p class="message">We received a request to reset your password. Click the link below to create a new
          password:</p>
        <p>
          <a href="{{ $actionUrl }}" class="button">
            Click here to reset your password
          </a>
        </p>
        <p class="support-text">
          If you can’t click the button, copy and paste the following link into your browser:<br>
          <span class="reset-link">{{ $actionUrl }}</span>
        </p>
        <p class="warning-text">
          If you didn’t request this password change, please ignore this email.
        </p>
      </div>
    </div>

    <!-- Footer component -->
    <div class="footer">
      © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</body>

</html>