<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\PurchaseTicket;
use Illuminate\Support\Facades\Storage;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

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

        // Verificar si hay suficientes boletos disponibles en el evento
        if ($event->ticket_quantity < $quantity) {
            return redirect()->back()->with('error', 'No hay suficientes boletos disponibles.');
        }

        // Crear una nueva compra
        $purchase = new Purchase();
        $purchase->user_id = $userId;
        $purchase->event_id = $event->id;
        $purchase->total_price = $totalPrice;
        $purchase->quantity = $quantity; // Asignar la cantidad comprada
        $purchase->save();

        // Restar la cantidad de boletos comprados a la cantidad de boletos disponibles
        $event->ticket_quantity -= $quantity;
        $event->save();

        // Crear los boletos y generar los códigos QR
        for ($i = 0; $i < $quantity; $i++) {
            $ticket = new Ticket();
            $ticket->event_id = $event->id;
            $ticket->user_id = $userId;
            $ticket->price = $eventPrice;
            $ticket->active = true;

            // Generar el código QR
            $renderer = new ImageRenderer(
                new RendererStyle(400),
                new ImagickImageBackEnd()
            );
            $writer = new Writer($renderer);
            $qrCode = $writer->writeString('Datos a codificar');

            // Guardar la imagen del código QR en el disco de almacenamiento S3
            $qrCodeFilename = 'qrcodes/' . $ticket->id . '.png';
            Storage::disk('s3')->put($qrCodeFilename, $qrCode);

            // Obtener la URL del código QR guardado en S3
            $qrCodeUrl = Storage::disk('s3')->url($qrCodeFilename);

            // Guardar la URL del código QR en el ticket
            $ticket->qr_code_url = $qrCodeUrl;
            $ticket->save();

            // Asociar el boleto con la compra utilizando el modelo intermedio
            $purchaseTicket = new PurchaseTicket();
            $purchaseTicket->purchase_id = $purchase->id;
            $purchaseTicket->ticket_id = $ticket->id;
            $purchaseTicket->save();
        }

        // Redirigir al usuario a la vista de proceder con el pago
        return view('views_client.proceed_with_payment', compact('totalPrice'));
    }
}
