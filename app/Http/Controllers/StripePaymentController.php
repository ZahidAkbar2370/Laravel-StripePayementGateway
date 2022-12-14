<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Session;
use Stripe;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
       $payment =  Stripe\Charge::create ([
                "amount" =>  100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from Code With Zahid." 
        ]);
        
        
        FacadesSession::flash('success', 'Payment successful!');
              
        return back();
    }
}