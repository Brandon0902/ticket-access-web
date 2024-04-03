<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Agregar efecto de desenfoque al fondo */
        body {
            background-image: url('{{ asset('images/fondo_loggin.jpeg') }}');
            background-size: cover;
            backdrop-filter: blur(8px); /* Ajustar el valor según prefieras */
        }

        /* Agregar degradado al contenedor del formulario */
        .form-container {
            background: rgb(5,5,5);
            background: linear-gradient(90deg, rgba(5,5,5,0.9360119047619048) 0%, rgba(255,188,0,1) 70%);
            color: white; /* Color del texto */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); /* Agregar sombra al contorno del formulario */
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen">
    <!-- Logo de la empresa -->
    <div class="absolute top-0 left-0 right-0 mx-auto w-40">
        <img src="{{ asset('images/logo-ticket.png') }}" alt="Logo de la empresa">
    </div>

    <div class="bg-yellow-500 p-8 rounded-lg shadow-lg form-container mt-20"> <!-- mt-20 para dejar espacio para el logo -->
        <h2 class="text-white text-2xl font-bold mb-4">Registro</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4"> <!-- Agregamos margen inferior -->
                <x-input-label for="name" :value="__('Name')" class="text-white" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4 mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-white" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mb-4"> <!-- Añadir margen inferior -->
                <button type="submit" class="block w-full px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Register</button>
            </div>
        </form>    
    </div>
</body>
</html>
