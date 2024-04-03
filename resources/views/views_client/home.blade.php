@extends('layouts.frontend')

@section('content')

<div class="bg-cover bg-center h-96 flex flex-col items-center justify-center" style="background-image: url('{{ asset('images/Fondo_loggin.jpeg') }}')">
    <h1 class="text-4xl font-bold text-white mb-8">
        Bienvenido a <span class="text-yellow-500">TICKET ACCESS</span>
    </h1>
    <img src="{{ asset('images/logo-ticket.png') }}" alt="Logotipo" class="h-28">
</div>

<!-- Espacio entre la imagen y el contenedor de eventos -->
<div class="mt-8"></div>

<!-- Contenedor de eventos -->
<div class="container mx-auto px-4 py-8 bg-white">
    <h2 class="text-2xl font-bold mb-4">Próximos Eventos</h2>
    <!-- Grid de eventos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <!-- Iterar sobre los eventos y mostrarlos dinámicamente -->
        @foreach($events as $event)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ $event->image }}" alt="{{ $event->name }}" class="w-full h-56 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">{{ $event->name }}</h3>
                <p class="text-gray-600">Fecha: {{ $event->date }}</p>
                <p class="text-gray-600">Ubicación: {{ $event->lugar }}</p>
                <!-- Agregar botón para ver detalles del evento -->
                <a href="{{ route('events.show', $event->id) }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Ver detalles del evento</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
