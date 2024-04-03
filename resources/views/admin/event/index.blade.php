<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Eventos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Imagen</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Lugar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Descripción</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Organizador</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Cantidad de Boletos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Precio por Boleto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($events as $event)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $event->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">
                                    <img class="h-10 w-10 rounded-full" src="{{ $event->image }}" alt="">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $event->date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $event->location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $event->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $event->adminName}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $event->ticket_quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-black">{{ $event->ticket_price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="mb-2">
                                        <a href="{{ route('events.edit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 block">Editar</a>
                                    </div>
                                    <div>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600 block">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
