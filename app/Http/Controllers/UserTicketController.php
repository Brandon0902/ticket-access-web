<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class UserTicketController extends Controller
{
    public function userTickets(Request $request)
    {
        // Obtener el usuario autenticado a través del token
        $user = $request->user();

        // Obtener todos los boletos asociados al usuario
        $tickets = Ticket::where('user_id', $user->id)->get();

        // Retornar los boletos en formato JSON
        return response()->json([
            'tickets' => $tickets,
        ], 200);
    }
}
