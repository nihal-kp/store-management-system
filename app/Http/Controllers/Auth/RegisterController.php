<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Mail\Register;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $previous;
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    
    protected function redirectTo()
    {
        // return route('login');
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
        ? new JsonResponse([], 201)
        : redirect($this->redirectPath());
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone' => ['numeric', 'unique:customers'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'status' => 1,
            'verification_status' => 0,
        ]);
    }
    
    protected function registered(Request $request, $user)
    {
        if (!empty($request->intended)) {
            $this->previous = $request->intended;
        }
        
        if ($request->ajax()) {
           
            $customer = Customer::whereId($user->id)->first();
            $customer->verification_otp = $verification_otp = null;
            $customer->otp_verification_status = 1;
            $customer->save();
            // $message = 'Dear '.$customer->name.' Thanks for registering with store.com. The OTP to verify your mobile number is ' . $verification_otp.'. Please don\'t share your OTP with anyone';
            //if($user->phone_prefix=='91'){
            // SmsHelper::sendOtp('+91'.$customer->phone, $verification_otp);
            // WhatsAppHelper::sendOtp('+91'.$customer->phone, $verification_otp);
            $result = substr($customer->phone, 0, 4);
            $result .= "****";
            $result . substr($customer->phone, 6, 4);
           // }
           
            //   Mail::to($customer->email, $user->name)->send(new Otp($customer));

            Mail::to($user->email, $user->name)->send(new Register($user));

            return response()->json([
                'customer' => Crypt::encryptString($user->id),
                //'phone' => isset($email_result) ? 'email <b>'.$email_result.'</b>' : 'email & phone number <b>'.$result.'</b>',
                'phone' => $result,
                //'otp'=>$verification_otp,
                'intended' => $this->previous ? $this->previous : $this->redirectPath(),
                'login_type' => '0',
            ]);
        }
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }
}
