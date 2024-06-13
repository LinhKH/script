<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use App\PaymentGateway\Stripe;
use Razorpay\Api\Api;
use Session;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            //$data = Booking::orderBy('id','desc')->get();
            $data = Booking::with('plan', 'user')->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($row) {
                    return $row->user->username;
                })
                ->addColumn('plan_name', function ($row) {
                    return $row->plan->title;
                })
                ->addColumn('seats', function ($row) {
                    $seat = '<div class="d-flex flex-column">
                            <h6 class="text-capitalize mb-0">Seats : ' . $row->seats . '</h6>
                            <span class="text-sm">Price : ' . $row->amount . '</span>
                        </div>';
                    return $seat;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->rawColumns(['seats'])
                ->make(true);
        }
        return view('admin.booking.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // return $request->input();
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                // return  $response;
                $payment = new Payment();
                $payment->amount = $request->seats * $request->amount;
                $payment->txn_id = $input['razorpay_payment_id'];
                $payment->pay_method = 'razorpay';
                $payment->save();


                $booking = new Booking();
                $booking->plan_id = $request->plan_id;
                $booking->user_id = $request->user_id;
                $booking->pay_id = $payment->id;
                $booking->seats = $request->seats;
                $booking->amount = $request->seats * $request->amount;
                $result = $booking->save();
                // return $result; 

                session()->flash('success', 'Payment Confirmed Successfully');
                return redirect('success');
            } catch (Exception $e) {
                Session::flash('error', $e->getMessage());
                return redirect()->back();
            }
        }

        Session::put('success', 'Payment successful');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function success()
    {
        return view('public.success');
    }
    public function failedPayment()
    {
        return view('public.failed');
    }
}
