<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceder con el Pago</title>
    <!-- Agregar estilos CSS para mejorar la apariencia -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #343a40;
        }

        p {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .paypal-button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .paypal-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .paypal-button:hover {
            background-color: #0056b3;
        }

        .paypal-icon {
            width: 100px; /* Tamaño del icono */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Procede con tu pago</h1>
        <p>Haz clic en el botón para continuar con el pago a través de PayPal.</p>
        <form action="{{ route('paypal.payment') }}" method="POST">
            @csrf
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            <div class="paypal-button-container">
                <button type="submit" class="paypal-button">
                    <img src="{{ asset('images/logo-paypal.png') }}" alt="PayPal" class="paypal-icon">
                    Pagar con PayPal
                </button>
                <div>
                    <img src="{{ asset('images/logo-paypal.png') }}" alt="PayPal" class="paypal-icon">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
