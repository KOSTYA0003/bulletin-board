<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Подтверждение Email</title>
</head>

<body style="font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #333;">Подтвердите ваш email</h2>

        <p>Для завершения регистрации нажмите на кнопку ниже:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $verificationUrl }}"
                style="background: #007bff; color: white; padding: 12px 24px; 
                      text-decoration: none; border-radius: 5px; display: inline-block;">
                Подтвердить Email
            </a>
        </div>

        <p>Или скопируйте ссылку в браузер:</p>
        <p style="word-break: break-all; color: #007bff;">{{ $verificationUrl }}</p>

        <p style="color: #666; font-size: 14px;">
            Если это были не вы, просто проигнорируйте это письмо.
        </p>
    </div>
</body>

</html>