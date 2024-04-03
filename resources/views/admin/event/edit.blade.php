<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                    <form method="POST" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-black dark:text-black text-sm font-bold mb-2" for="adminName">
                                Nombre de Admin
                            </label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="adminName" name="adminName" value="{{ $event->adminName }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-black dark:text-black text-sm font-bold mb-2" for="name">
                                Nombre
                            </label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" value="{{ $event->name }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-black dark:text-black text-sm font-bold mb-2" for="image">
                                Imagen
                            </label>
                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" name="image">
                        </div>

                        <div class="mb-4">
                            <label class="block text-black dark:text-black text-sm font-bold mb-2" for="description">
                                Descripción
                            </label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description">{{ $event->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-black dark:text-black text-sm font-bold mb-2" for="date">
                                Date
                            </label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" name="date" value="{{ $event->date }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-black dark:text-black text-sm font-bold mb-2" for="location">
                                Ubicación
                            </label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location" name="location" value="{{ $event->location }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-black dark:text-black text-sm font-bold mb-2" for="ticket_quantity">
                                Cantidad de Boletos
                            </label>
                            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ticket_quantity" name="ticket_quantity" value="{{ $event->ticket_quantity }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-black dark:text-black text-sm font-bold mb-2" for="ticket_price">
                                Precio por Boleto
                            </label>
                            <input type="number" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ticket_price" name="ticket_price" value="{{ $event->ticket_price }}">
                        </div>

                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Update Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
