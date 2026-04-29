<?php

// app/Http/Controllers/Auth/EmailVerificationController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        $user = $request->user();

        if ($user->isEmailVerified()) {
            return back()->with('error', 'Email уже подтвержден');
        }

        // Генерируем токен
        $token = $user->generateVerificationToken();

        // Создаем URL для подтверждения
        $verificationUrl = route('verification.verify', ['token' => $token]);

        // Отправляем письмо
        \Mail::send('emails.verification', ['verificationUrl' => $verificationUrl], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Подтверждение email на сайте');
        });

        return back()->with('success', 'Письмо с подтверждением отправлено! Проверь MailHog.');
    }

    public function verify($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (! $user) {
            return redirect('/')->with('error', 'Неверная ссылка подтверждения');
        }

        $user->markEmailAsVerified();

        return redirect('/')->with('success', 'Email успешно подтвержден!');
    }
}
