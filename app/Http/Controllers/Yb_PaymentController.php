<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Session;
use Exception;
use App\Models\Payment;

use Illuminate\Http\Request;

class Yb_PaymentController extends Controller
{
    //
    function yb_payWithRazorpay(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                // return  $response;
                $payment = new Payment();
                $payment->amount = 100;
                $payment->txn_id = $input['razorpay_payment_id'];
                $payment->pay_method = 'razorpay';
                $payment->save();
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        Session::put('success', 'Payment successful');
        return redirect()->back();
    }
}
