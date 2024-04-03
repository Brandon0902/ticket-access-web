@extends('layouts.frontend')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Tus Boletos</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($tickets as $ticket)
                <div class="ticket bg-black text-white rounded-lg overflow-hidden shadow-md mb-8">
                    <header class="bg-gray-900 p-4 rounded-t-lg">
                        <div class="company-name font-bold text-left">Evento: {{ $ticket->event->name }}</div>
                        <div class="gate absolute top-4 right-4 font-semibold text-center">
                        </div>
                    </header>
                    <section class="py-4">
                        <div class="flex justify-between mb-4 px-4">
                            <div class="airport">
                                <div class="airport-name text-yellow-500">Ticket ID: {{ $ticket->id }}</div>
                                @if ($ticket->user)
                                    <div class="dep-arr-label text-xs text-white">Comprador: {{ $ticket->user->name }}</div>
                                @endif
                            </div>
                            <div class="airport">
                                <div class="airport-name text-yellow-500">Ubicación</div>
                                <div class="airport-code text-3xl font-bold">{{ $ticket->event->location}}</div>
                                <div class="dep-arr-label text-xs text-white">Fecha: {{ $ticket->event->date}}</div>
                            </div>
                        </div>
                        <div class="flex justify-between px-4">
                            <div class="place-block">
                                <div class="place-label  text-yellow-500">Precio</div>
                                <div class="place-value text-3xl font-bold">${{ $ticket->price }}</div>
                            </div>
                            <div class="place-block">
                                <div class="place-label  text-yellow-500">Estado</div>
                                <div class="place-value text-3xl font-bold">{{ $ticket->active ? 'Activo' : 'Inactivo' }}</div>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <div class="qr w-40 h-40 mx-auto overflow-hidden">
                                <img src="{{ $ticket->qr_code_url }}" alt="Ticket QR Code">
                            </div>
                        </div>
                    </section>
                </div>
            @endforeach
        </div>
    </div>
@endsection
