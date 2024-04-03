@extends('layouts.frontend')

@section('content')
<div class="container px-4 mx-auto mt-8">
    <div class="flex justify-center items-center mb-8">
        <div class="w-32 h-32 overflow-hidden rounded-full">
            <img class="w-full h-full object-cover" src="{{ $user->avatar }}" alt="User Avatar">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Información de Perfíl') }}</h2>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">{{ __('Nombre') }}</label>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">{{ __('Email') }}</label>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->email }}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Acciones') }}</h2>
                <div class="flex justify-between">
                    <a href="{{ route('profile.edit') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">{{ __('Editar Perfil') }}</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">{{ __('Cerrar Sesión') }}</button>
                    </form>
                    <form action="{{ route('profile.destroy') }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estas seguro de borrar la cuenta?')" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">{{ __('Borrar cuenta') }}</button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Insignias') }}</h2>
                <div class="flex justify-between">
                    <div class="text-center">
                        <div class="bg-white rounded-full overflow-hidden w-20 h-20">
                            <img src="{{ asset('images/badge.png') }}" alt="Insignia 1" class="w-full h-full object-cover">
                        </div>
                        <p class="mt-2 text-sm text-gray-600">{{ __('Apoyo en Redes') }}</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-white rounded-full overflow-hidden w-20 h-20">
                            <img src="{{ asset('images/best-seller.png') }}" alt="Insignia 2" class="w-full h-full object-cover">
                        </div>
                        <p class="mt-2 text-sm text-gray-600">{{ __('Crecimiento $') }}</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-white rounded-full overflow-hidden w-20 h-20">
                            <img src="{{ asset('images/reward.png') }}" alt="Insignia 3" class="w-full h-full object-cover">
                        </div>
                        <p class="mt-2 text-sm text-gray-600">{{ __('Cliente Reconocido') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('footer')
@endsection