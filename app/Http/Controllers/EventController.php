<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Muestra una lista de los eventos.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        $events = Event::with('admin')->get();
        return view('admin.event.index', compact('events'));
    }*/

    /**
     * Muestra el formulario para crear un nuevo evento.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Almacena un evento recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'location' => 'required',
            'adminName' => 'required',
            'description' => 'required',
            'image' => 'nullable|image', // Image validation, if required
            'ticket_quantity' => 'required|integer|min:1', // Validation for ticket quantity
            'ticket_price' => 'required|numeric|min:0', // Validation for ticket price
        ]);

        $event = new Event([
            'adminName' => $request->input('adminName'),
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'ticket_quantity' => $request->input('ticket_quantity'),
            'ticket_price' => $request->input('ticket_price'),
        ]);
        

        if ($request->hasFile('image')){

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            //$path = $image->storePublicly('eventos', 's3');
            $path = Storage::disk('s3')->put('eventos', $image);
            $url = Storage::disk('s3')->url($path);
            $event->image = $url;
        }

        $event->save();

        return redirect()->route('events.store')->with('success', 'Event created successfully.');
    }

    /**
     * Muestra el evento especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('views_client.event_details', compact('event'));
    }


    public function index(Request $request)
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    /**
     * Muestra el formulario para editar el evento especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.edit', compact('event'));
    }

    /**
     * Actualiza el evento especificado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'location' => 'required',
            'adminName' => 'required',
            'description' => 'required',
            'image' => 'nullable|image', // Validación para la imagen, si es requerida
            'ticket_quantity' => 'required|integer|min:1', // Validación para la cantidad de boletos
            'ticket_price' => 'required|numeric|min:0', // Validación para el precio por boleto
        ]);

        $event = Event::findOrFail($id);
        $event->update([
            'adminName' => $request->input('adminName'),
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'ticket_quantity' => $request->input('ticket_quantity'),
            'ticket_price' => $request->input('ticket_price'),
        ]);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = Storage::disk('s3')->put('eventos', $image);
            $url = Storage::disk('s3')->url($path);
            $event->image = $url;
        }

        $event->save();

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Elimina el evento especificado de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function showEvents()
    {
        $events = Event::all();
        return view('views_client.home', compact('events'));
    }
}
