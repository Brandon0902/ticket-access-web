<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Compras') }}
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Evento</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Precio Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black dark:text-black uppercase tracking-wider">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-black">{{ $purchase->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black">{{ $purchase->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black">{{ $purchase->event->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black">{{ $purchase->total_price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black">{{ $purchase->quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
