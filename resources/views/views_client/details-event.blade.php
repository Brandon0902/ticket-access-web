@extends('layouts.frontend')

@section('content')

<div class="bg-cover bg-center h-96 flex flex-col items-center justify-center" style="background-image: url('images/Fondo_loggin.jpeg')">
    <h1 class="text-4xl font-bold text-black mb-8 font-serif">
        Sobre Este Evento
    </h1>
    <img src="{{ $event->image }}" alt="{{ $event->name }}" class="h-64 object-cover">
</div>

<!-- Contenedor de detalles del evento -->
<div class="container mx-auto px-4 py-8 bg-white grid grid-cols-2 gap-8">
    <!-- Div para la información del evento -->
    <div>
        <h2 class="text-2xl font-bold mb-4">{{ $event->name }}</h2>
        <div class="flex items-center mb-4">
            <svg class="h-8 w-8 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <p class="text-gray-600 font-serif">Organizador: {{ $event->adminName }}</p>
        </div>
        <div class="flex items-center mb-4">
            <svg class="h-8 w-8 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16V8"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 16V8"></path>
            </svg>
            <p class="text-gray-600 font-serif">Fecha: {{ $event->date }}</p>
        </div>
        <div class="flex items-center mb-4">
            <svg class="h-8 w-8 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <p class="text-gray-600">{{ $event->location }}</p>
        </div>
        <div class="flex items-center mb-4">
            <svg class="h-8 w-8 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21V12"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21V12"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10h10"></path>
            </svg>
            <p class="text-gray-600">Precio por Boleto: ${{ $event->ticket_price }}</p>
        </div>
        <p class="text-gray-600 mb-8">Descripción: {{ $event->description }}</p>
    </div>

    <!-- Div para comprar boletos -->
    <div class="flex flex-col justify-center">
        <p class="text-2xl font-bold text-gray-800 mb-4">¿Qué esperas para comprar tu entrada?</p>
        <form action="{{ route('comprar.boleto') }}" method="POST">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <div class="flex items-center mb-4 border border-gray-300 rounded-md px-4 py-2">
                <label class="mr-2 font-semibold text-gray-600">Selecciona tus boletos:</label>
                <input type="number" name="quantity" class="border-none outline-none bg-gray-100 rounded-md focus:bg-gray-200" min="1" value="1">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Comprar Boleto</button>
        </form>
    </div>
</div>

@endsection