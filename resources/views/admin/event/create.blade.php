<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white dark:text-gray-100">
                    {{ __("Agregar un evento") }}
                </div>
            </div>

            <a href="{{ route('events.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="h-6 w-6 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                </svg>
                Regresar a la lista de eventos
            </a>

            <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-black dark:text-black text-sm font-bold mb-2" for="adminName">
                        Nombre de Admin
                    </label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="adminName" name="adminName">
                </div>

                <div class="mb-4">
                    <label class="block text-black dark:text-black text-sm font-bold mb-2" for="name">
                        Nombre
                    </label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="name" name="name">
                </div>

                <div class="mb-4">
                    <label class="block text-black dark:text-black text-sm font-bold mb-2" for="date">
                        Fecha
                    </label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="date" name="date">
                </div>

                <div class="mb-4">
                    <label class="block text-black dark:text-black text-sm font-bold mb-2" for="location">
                        Location
                    </label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="location" name="location">
                </div>

                <div class="mb-4">
                    <label class="block text-black dark:text-black text-sm font-bold mb-2" for="ticket_quantity">
                        Cantidad de Boletos
                    </label>
                    <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="ticket_quantity" name="ticket_quantity">
                </div>

                <div class="mb-4">
                    <label class="block text-black dark:text-black text-sm font-bold mb-2" for="ticket_price">
                        Precio por Boleto
                    </label>
                    <input type="number" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="ticket_price" name="ticket_price">
                </div>

                <div class="mb-4">
                    <label class="block text-black dark:text-black text-sm font-bold mb-2" for="description">
                        Descripción
                    </label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="description" name="description">
                </div>

                <div class="mb-4">
                    <label class="block text-black dark:text-black text-sm font-bold mb-2" for="image">
                        Imagen
                    </label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="image" name="image">
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Crear Evento
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>