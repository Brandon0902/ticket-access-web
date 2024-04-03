<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LEONMEE</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-...tu-integridad-aquí..." crossorigin="anonymous">
    <link rel="icon" href="{{ asset('images/logo-ticket.png') }}">
</head>
<body>
    <div>
        <header class="mb-16">
            <nav class="text-white bg-gradient-to-r from-black to-yellow-500 flex justify-between items-center hover:bg-gradient-to-r hover:from-yellow-500 hover:to-black transition duration-300 ease-in-out rounded-none shadow-lg p-4 md:p-6">
                <div class="flex flex-col sm:flex-row">
                    <a href="/" class="hidden md:block">
                        <img src="{{ asset('images/logo-ticket.png') }}" alt="Logotipo" class="h-8">
                    </a>
                    <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="{{ route('events.showEvents') }}">Inicio</a>
                    <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="{{ route('user.tickets') }}">Boletos</a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('profile.show') }}" class="mx-4 text-gray-600 focus:outline-none">
                        <i class="fas fa-user"></i>
                    </a>
                    <span class="text-gray-600">{{ auth()->user()->name }}</span>
                </div>
            </nav>
        </header>
        
        <main class="my-8">
            @yield('content')
        </main>

        <footer class="text-white bg-gradient-to-r from-black to-yellow-500 flex justify-between items-center hover:bg-gradient-to-r hover:from-yellow-500 hover:to-black transition duration-300 ease-in-out rounded-none shadow-lg p-4 md:p-6">
            <div class="container mx-auto flex justify-center items-center">
                <a href="#" class="mr-4 text-xl"><i class="fab fa-facebook"></i></a>
                <a href="#" class="mr-4 text-xl"><i class="fab fa-twitter"></i></a>
                <a href="#" class="mr-4 text-xl"><i class="fab fa-instagram"></i></a>
                <a href="#" class="mr-4 text-xl"><i class="fab fa-whatsapp"></i></a>
            </div>
            <div class="text-center mt-2">Derechos Reservados a TICKETACCESS</div>
        </footer>
    </div>
</body>
</html>