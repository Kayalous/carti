<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\PaymentIntent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{

    private function setupPaymentEvent(User $user){
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];

        $items = Cart::getFormattedProducts($user->carts);


        foreach ($items as $item) {
            $lineItem = [
                'price_data' => [
                    'currency' => 'egp',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => (int)($item['price'] * 100),
                ],
                'quantity' => $item['qty'],
            ];
            array_push($lineItems, $lineItem);
        }


        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => env('APP_URL') . '/payment/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => env('APP_URL') . '/user/cart',
        ]);


         PaymentIntent::create([
            'user_id' => $user->id,
            'payment_intent_id' => $session->payment_intent,
            'payment_session_id' => $session->id
        ]);

         return $session;
    }

    public function issuePaymentEvent(Request $request)
    {

        $session = $this->setupPaymentEvent($request->user());

        return redirect($session->url);

    }

    public function apiIssuePaymentEvent(Request $request)
    {

        $session = $this->setupPaymentEvent($request->user());

        return response()->json([
            'url' => $session->url
        ]);

    }




    public function stripeCallback(Request $request)
    {
        $event = \Stripe\Event::constructFrom($request->all());

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $stripePaymentIntent = $event->data->object;

                $paymentIntent = PaymentIntent::where('payment_intent_id', $stripePaymentIntent->id)->firstOrFail();

                $paymentIntent->user->completePurchase();


                return response(null, 200);
                break;
            default:
                return response(null, 405);
                break;
        }
    }

    public function showCallbackPage (Request $request) {
        $paymentIntent = PaymentIntent::where('payment_session_id', $request->session_id)
            ->where('user_notified', false)->first();
        if ($paymentIntent) {
            $paymentIntent->user_notified = true;
            $paymentIntent->save();
            return Inertia::render('PaymentSuccess');
        } else
            return redirect('/');
    }
}
