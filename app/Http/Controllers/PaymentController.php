<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{

   public function __construct()
   {
       $this->middleware('auth');
   }

    /**
     * Redirect the User to Paystack Payment Page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToGateway()
    {
        try{
            Log::alert('Reached here too');
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if (!$paymentDetails['status'])
        {
            return view('errors.e404', ['message' => 'Payment failed to complete please try again']);
        }

        $daysBought = $paymentDetails['data']['metadata']['subscription'];

        $expiryDate = Carbon::now();
        $expiryDate = $expiryDate->addDays($daysBought);

        $loggedUser = Auth::user();

        $user = User::find($loggedUser->id);

        if ($user == null)
        {
            return view('errors.e404', ['message' => 'User was not found']);
        }

        $user->has_subscribed = 1;
        $user->subscription_expiry_date = $expiryDate;
        $user->save();

        session()->put('user', $user);

        return redirect('dashboard');
    }
}
