i<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h2 class="text-white text-2xl font-bold mb-4">Login</h2>

        <div class="w-full flex justify-center mx-2">
            <a href="/auth/google/redirect" type="button" class="text-black bg-white hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-500 font-medium rounded-lg text-sm px-8 py-4 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-black/30 mr-2 mb-2">
                <svg class="w-6 h-6 mr-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>
                Registrarse o Iniciar con Google
            </a>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
    
            <!-- Email Address -->
            <div class="mb-4"> <!-- Agregamos margen inferior -->
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4 mb-6"> <!-- Añadir margen inferior -->
                <x-input-label for="password" :value="__('Password')" class="text-white" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="mb-4"> <!-- Añadir margen inferior -->
                <button type="submit" class="block w-full px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Login</button>
            </div>
        </form>    
        <div class="text-center text-white">
            ¿No tienes una cuenta? <a href="{{ route('cliente.register') }}" class="underline">Registrarse</a>
            <br>
            <a href="{{ route('password.cliente') }}" class="underline">¿Olvidaste tu contraseña?</a> <!-- Agregar enlace de olvidaste tu contraseña -->
        </div>
    </div>
</body>
</html>
