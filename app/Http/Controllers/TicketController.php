<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
     // Método para mostrar todos los boletos del usuario autenticado
     public function userTickets()
     {
         // Obtener el ID del usuario autenticado
         $userId = Auth::id();
 
         // Obtener todos los boletos asociados al usuario
         $tickets = Ticket::where('user_id', $userId)->get();
 
         // Retornar los boletos a la vista
         return view('views_client.tickets', compact('tickets'));
     }
}
