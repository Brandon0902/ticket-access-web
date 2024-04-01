<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
{
    try {
        $socialUser = Socialite::driver($provider)->user();

        // Verificar si el usuario ya existe en la base de datos
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Si el usuario existe, iniciar sesión y redirigir al dashboard
            Auth::login($user);
            return redirect('/inicio');
        }

        // Buscar un usuario existente con el mismo proveedor y ID de proveedor
        $user = User::where([
            'provider' => $provider,
            'provider_id' => $socialUser->id
        ])->first();

        if (!$user) {
            // Si no se encuentra un usuario, crear uno nuevo
            $password = Str::random(12);
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'username' => User::generateUserName($socialUser->getNickname()),
                'password' => bcrypt($password),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
                'avatar' => $socialUser->getAvatar(),
            ]);

            // Enviar notificación de verificación de correo electrónico
            $user->sendEmailVerificationNotification();
        }

        // Iniciar sesión con el usuario
        Auth::login($user);

        // Redirigir al panel de control
        return redirect('/dashboard');
    } catch (\Exception $e) {
        // Manejar cualquier excepción
        var_dump($e);
        return redirect('/login');
        }   
    }

}
