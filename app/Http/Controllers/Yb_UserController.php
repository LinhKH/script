<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\str;
use Illuminate\Support\Carbon;
use Mail;
use App\Models\User;
use App\Models\Plan;
use App\Models\PasswordReset;
use App\Models\Booking;
use App\Models\Payment;
use App\PaymentGateway\Stripe;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Yb_UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = User::latest('id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if ($row->image != '') {
                        $img = '<img src="' . asset("public/user/" . $row->image) . '" width="70px">';
                    } else {
                        $img = '<img src="' . asset("public/user/default.png") . '" width="70px">';
                    }
                    return $img;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $status = '<label class="badge badge-gradient-info">Active</label>';
                    } else {
                        $status = '<label class="badge badge-gradient-danger">Inactive</label>';
                    }
                    return $status;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="users/' . $row->id . '/edit" class="btn btn-gradient-success btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
        return view('admin.users.index');
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
        $user = User::where('id', $id)->first();
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // $id = session()->get('id');
        $request->validate([
            'username' => 'required',
            'phone' => 'required',
        ]);

        $user = User::where(['id' => $id])->update([
            "username" => $request->username,
            "phone" => $request->phone,
            "country" => $request->country,
            "state" => $request->state,
            "city" => $request->city,
            "status" => $request->status,
        ]);
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function update_image(Request $request)
    {
        $id = session()->get('id');
        // Update User Image
        if ($request->img != '') {
            $path = public_path() . '/user/';
            //code for remove old file
            if ($request->old_img != ''  && $request->old_img != null) {
                $file_old = $path . $request->old_img;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->img;
            $image = $request->img->getClientOriginalName();
            $file->move($path, $image);
        } else {
            $image = $request->old_img;
        }

        $user = User::where(['id' => $id])->update([
            "image" => $image,
        ]);
        return '1';
    }

    public function yb_signup(Request $request)
    {
        if (session()->has('id')) {
            return redirect('profile');
        }
        if ($request->input()) {
            $request->validate([
                'username' => 'required',
                'country' => 'required',
                'phone' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);

            $user = new User();
            $user->username = $request->input("username");
            $user->country = $request->input("country");
            $user->phone = $request->input("phone");
            $user->email = $request->input("email");
            $user->password = Hash::make($request->input("password"));
            $result = $user->save();
            return $result;
        } else {
            return view('public.signup');
        }
    }

    public function yb_login(Request $req)
    {
        if (session()->has('id')) {
            return redirect('profile');
        }
        if ($req->input()) {
            $req->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = $req->input('email');
            $pass = $req->input('password');

            $login = User::select(['id', 'username', 'email', 'password', 'status'])
                ->where('email', $user)
                ->first();
            // return $login;   
            if ($login) {
                //return $login['id'];
                if ($login['status'] == '1') {
                    if (Hash::check($pass, $login['password'])) {
                        $req->session()->put('id', $login['id']);
                        $req->session()->put('username', $login['username']);
                        return '1';
                    } else {
                        return 'Email Address and Password Not Matched.';
                    }
                } else {
                    return 'Your account is blocked by Site Administrator.';
                }
            } else {
                return 'Email Does Not Exists';
            }
        } else {
            return view('public.login');
        }
    }

    public function yb_change_password(Request $request)
    {
        if (!session()->has('id')) {
            return redirect('login');
        }
        if ($request->input()) {
            $request->validate([
                'password' => 'required',
                'new_pass' => 'required',
                'new_confirm' => 'required'
            ]);
            $id = session()->get('id');
            $select = DB::table('users')->where('id', $id)->pluck('password');
            if (Hash::check($request->password, $select[0])) {
                $update = DB::table('users')->where('id', $id)->update([
                    'password' => Hash::make($request->new_pass)
                ]);
                return 1;
            } else {
                return 'Please Enter Correct Old Password';
            }
        } else {
            return view('public.change-password');
        }
    }

    public function yb_logout(Request $request)
    {
        $request->session()->forget('id');
        $request->session()->forget('username');
        return redirect('/');
    }

    public function yb_forgot_password(Request $request)
    {
        if (!session()->has('id')) {
            if ($request->input()) {
                try {
                    $user = User::where('email', $request->email)->first();
                    if ($user) {
                        if ($user->status == '0') {
                            return json_encode(['error' => 'Your account is blocked by Site Administrator']);
                        }
                        $check = PasswordReset::where('email', $request->email)->first();
                        if ($check) {
                            return json_encode(['success' => 'Email Already Sent, Please check your mail to reset your password']);
                        }
                        $token = Str::random(40);
                        $domain = URL::to('/');
                        $url = $domain . '/reset-password?token=' . $token;

                        $data['url'] = $url;
                        $data['email'] = $request->email;
                        $data['title'] = 'Password Reset';
                        $data['body'] = 'Please click on below link to reset you password.';

                        Mail::send('public.forgotPasswordMail', ['data' => $data], function ($message) use ($data) {
                            $message->to($data['email'])->subject($data['title']);
                        });
                        $dataTime = Carbon::now()->format('Y-m-d H:i:s');
                        PasswordReset::updateOrCreate(
                            ['email' => $request->email],
                            [
                                'email' => $request->email,
                                'token' => $token,
                                'created_at' => $dataTime
                            ]
                        );
                        return json_encode(['success' => 'Please check your mail to reset your password']);
                    } else {
                        return json_encode(['error' => 'Email Does Not Exists!']);
                    }
                } catch (\Exception $e) {
                    return response()->json(['error', $e->getMessage()]);
                }
            } else {
                return view('public.forgot-password');
            }
        } else {
            return redirect('profile');
        }
    }

    public function yb_reset_password(Request $request)
    {
        $resetData = PasswordReset::where('token', $request->token)->first();
        if ($request->token && $resetData) {
            $user = User::where('email', $resetData->email)->get();
            return view('public.reset-password', compact('user'));
        } else {
            return abort('404');
        }
    }

    public function yb_reset_passwordUpdate(Request $request)
    {
        //  return $request->input();
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        $data = User::where(['id' => $request->id])->update([
            "password" => Hash::make($request->input("password")),
        ]);
        $user = User::where('id', $request->id)->first();
        PasswordReset::where('email', $user->email)->delete();
        return '1';
        //return 'Your Password has been reset successfully.';
    }


    public function yb_profile()
    {
        if (!session()->has('id')) {
            return redirect('login');
        }
        if (session()->has('id')) {
            $user = session()->get('id');
            $user = User::select('users.*')->WHERE(['id' => $user])->first();
            //  return $user;
            return view('public.profile', ['user' => $user]);
        } else {
            return redirect('/login');
        }
    }

    public function yb_profileUpdate(Request $request)
    {
        //
        $id = session()->get('id');
        $request->validate([
            'username' => 'required',
            'phone' => 'required',
        ]);

        $user = User::where(['id' => $id])->update([
            "username" => $request->username,
            "phone" => $request->phone,
            "country" => $request->country,
            "state" => $request->state,
            "city" => $request->city,
        ]);
        return '1';
    }

    public function yb_checkout(Request $request, $slug)
    {
        if (session()->has('id')) {
            $plan = Plan::select('plans.*', 'categories.title as category', 'categories.title_slug as category_slug')
                ->leftJoin('categories', 'plans.category', '=', 'categories.id')
                ->where('plans.title_slug', $slug)->first();
            return view('public.checkout', ['plan' => $plan]);
        } else {
            return redirect('login');
        }
    }

    public function payWithStripe(Request $request)
    {
        session()->put('grand_total', $request->get('grand_total'));
        Session::put('tourism_management', $request->input());
        
        if ($request->pay_method == 'stripe') {
            $stripe = new Stripe();
            return $stripe->create();
        }
    }

    function stripeSuccess(Request $request)
    {
        $requestData = Session::get('tourism_management');
        // dd($requestData);
        $sessionId = $request->session_id;
        $stripe = new Stripe();
        $response = $stripe->retrieve($sessionId);
        // dump($response);
        if ($response->payment_status === 'paid') {

            $payment = new Payment();
            $payment->amount = $requestData['seats'] * $requestData['amount'];
            $payment->txn_id = $response['id'];
            $payment->pay_method = 'stripe';
            $payment->save();


            $booking = new Booking();
            $booking->plan_id = $requestData['plan_id'];
            $booking->user_id = $requestData['user_id'];
            $booking->pay_id = $payment->id;
            $booking->seats = $requestData['seats'];
            $booking->amount = $requestData['seats'] * $requestData['amount'];
            $result = $booking->save();
            // return $result; 

            if ($result == '1') {
                return redirect('success')->with('payment_success', $response['status']);
            }
        } else {
            return redirect('appointment/payment/failed')->with('payment_error', $response['error']);
        }
    }

    function stripeCancel()
    {
        return redirect('appointment/payment/failed')->with('payment_error', 'Cancelled stripe payment');
    }

    public function yb_booking()
    {
        if (session()->has('username')) {
            $user = session()->get('id');
            $booking = Booking::with('plan')->where('booking.user_id', $user)->get();
            return view('public.my_booking', ['booking' => $booking]);
        } else {
            return redirect('login');
        }
    }
}
