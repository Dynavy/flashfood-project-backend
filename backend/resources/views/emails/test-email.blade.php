<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Email</title>
  <link href="{{ asset('css/email-styles.css') }}" rel="stylesheet">
</head>

<body>
  <div class="email-container">
    <!-- Header component: resources/views/components/mail/mail-header.blade.php -->
    <x-mail.mail-header />

    <div class="content-wrapper">
      <div class="form-card">
        <h1 class="title">Test Email</h1>
        <p class="message">This is a test email sent from the FlashFood project.</p>
        <p class="support-text">
          If you have any questions, please contact our support team.
        </p>
      </div>
    </div>

    <!-- Footer component -->
    <div class="footer">
      © {{ date('Y') }} FlashFoods. All rights reserved.
    </div>
  </div>
</body>

</html>