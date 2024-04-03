<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class PasswordResetApiController extends Controller
{
    /**
     * Send reset password link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validar la entrada del usuario
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        // Enviar el correo para restablecer la contraseña
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Verificar el estado del envío del correo
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => trans($status)], 200);
        } else {
            return response()->json(['message' => trans($status)], 500);
        }
    }
}
