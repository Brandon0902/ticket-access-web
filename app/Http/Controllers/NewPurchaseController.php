<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\PurchaseTicket;
use Illuminate\Support\Facades\Http; // Importar la clase Http para realizar peticiones HTTP
use Illuminate\Support\Facades\Storage;

class NewPurchaseController extends Controller
{
        public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'event_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Obtener el evento
        $event = Event::findOrFail($request->input('event_id'));

        // Calcular el precio total de la compra
        $eventPrice = $event->ticket_price;
        $quantity = $request->input('quantity');
        $totalPrice = $eventPrice * $quantity;

        // Verificar si hay suficientes boletos disponibles
        $availableTickets = $event->ticket_quantity - $quantity;
        if ($availableTickets < 0) {
            return back()->with('error', 'No hay suficientes boletos disponibles.');
        }

        // Crear una nueva compra
        $purchase = new Purchase();
        $purchase->user_id = $userId;
        $purchase->event_id = $event->id;
        $purchase->total_price = $totalPrice;
        $purchase->quantity = $quantity;
        $purchase->save();

        // Crear los boletos y asociarlos con la compra
        for ($i = 0; $i < $quantity; $i++) {
            $ticket = new Ticket();
            $ticket->event_id = $event->id;
            $ticket->user_id = $userId;
            $ticket->price = $eventPrice;
            $ticket->active = true; // Definir el ticket como activo

            // Guardar el ticket para obtener su ID
            $ticket->save();

            // Obtener el ID del ticket después de guardarlo
            $ticketId = $ticket->id;

            // Datos del boleto para la API
            $ticketData = [
                'ticket_id' => $ticketId, // Utilizar el ID del ticket
                'event_name' => $event->name,
                'active' => $ticket->active, // Agregar el campo active
                // Otros datos del boleto que quieras incluir
            ];

            // Generar el código QR llamando a la API
            $apiUrl = 'https://bzlx5qm4u2zkllggmnzdxstx6q0dauig.lambda-url.us-east-1.on.aws/?data=' . urlencode(json_encode($ticketData));
            
            // Realizar la petición HTTP GET a la API para obtener el código QR
            $response = Http::get($apiUrl);

            // Verificar si la petición fue exitosa
            if ($response->successful()) {
                // Guardar la imagen del código QR en el disco de almacenamiento S3
                $qrCode = $response->body();
                $uniqueId = uniqid(); // La respuesta de la API es la imagen del código QR
                $qrCodeFilename = 'qrcodes/' .$uniqueId. '.png';
                Storage::disk('s3')->put($qrCodeFilename, $qrCode);

                // Obtener la URL del código QR guardado en S3
                $qrCodeUrl = Storage::disk('s3')->url($qrCodeFilename);

                // Guardar la URL del código QR en el ticket
                $ticket->qr_code_url = $qrCodeUrl;
                $ticket->save();

                // Asociar el boleto con la compra utilizando el modelo intermedio
                $purchaseTicket = new PurchaseTicket([
                    'purchase_id' => $purchase->id,
                    'ticket_id' => $ticketId, // Utilizar el ID del ticket
                ]);
                $purchaseTicket->save();
            } else {
                // Manejar el error si la petición a la API falla
                return back()->with('error', 'Error al generar el código QR.');
            }
        }
        // Actualizar la cantidad de boletos disponibles para el evento
        $event->ticket_quantity = $availableTickets;
        $event->save();

        // Redirigir u otra lógica según tus necesidades
        return view('views_client.proceed_with_payment', compact('totalPrice'));
    }



    public function completePurchase($purchase_id)
    {
        // Obtener la compra y sus tickets asociados
        $purchase = Purchase::with('tickets')->findOrFail($purchase_id);

        // Puedes acceder a los tickets asociados a la compra de la siguiente manera
        $tickets = $purchase->tickets;

        // Aquí puedes realizar cualquier otra lógica que necesites con los tickets

        // Por ejemplo, podrías pasar los tickets a la vista
        return view('views_client.compra_exitosa', compact('tickets'));
    }

    public function show()
    {
        // Obtener todas las compras de la base de datos
        $purchases = Purchase::all();

        // Pasar las compras a la vista
        return view('admin.purchases.index', compact('purchases'));
    }
}
