<?php
  
namespace App\Http\Controllers;
  
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use App\Models\Purchase;
  
class PayPalController extends Controller
{
    /**
     * Muestra el formulario de pago de PayPal.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('views_client.paypal');
    }
  
    /**
     * Maneja el pago de PayPal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment(Request $request)
    {
        // Obtener el precio total de la compra desde la solicitud
        $totalPrice = $request->input('total_price');
        
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
  
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "MXN",
                        "value" => $totalPrice,
                    ]
                ]
            ]
        ]);
  
        if (isset($response['id']) && $response['id'] != null) {
  
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
  
            return redirect()
                ->route('paypal.payment.cancel')
                ->with('error', 'Algo salió mal.');
  
        } else {
            return redirect()
                ->route('paypal.payment')
                ->with('error', $response['message'] ?? 'Algo salió mal.');
        }
    
    }
  
    /**
     * Maneja la cancelación del pago de PayPal.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paymentCancel()
    {
        return redirect()
              ->route('paypal')
              ->with('error', $response['message'] ?? 'Has cancelado la transacción.');
    }
  
    /**
     * Maneja el éxito del pago de PayPal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
  
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('paypal')
                ->with('success', 'Transacción completada.');
        } else {
            return redirect()
                ->route('paypal')
                ->with('error', $response['message'] ?? 'Algo salió mal.');
        }
    }
}
