<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Setting;
use Cart;
use App\Helpers\SmsHelper;
use App\Helpers\WhatsAppHelper;
use App\Mail\Register;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $previous;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
        $this->middleware('checkStatus:customer')->except('logout', 'otpVerify', 'underVerification');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        // return route('home');
    }
    
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
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

    protected function authenticated(Request $request, $user)
    {
        if ($request->ajax()) {
            
            Auth::guard('customer')->logoutOtherDevices($request->password);
        
            if (!empty($request->intended)) {
                $this->previous = $request->intended;
            }
            
            if ($user->otp_verification_status !== 1) {
                $customer = Customer::whereId($user->id)->first();
                $customer->verification_otp = $verification_otp = rand(1000, 9999);
                $customer->save();

                // $message = 'Welcome to Hifi Online, your OTP for login is ' . $verification_otp;

                // SmsHelper::sendOtp('+91'.$customer->phone, $verification_otp);
                // WhatsAppHelper::sendOtp('+91'.$customer->phone, $verification_otp);
                
                $phone = $customer->phone;
                $result = substr($phone, 0, 2);
                $result .= "****";
                $result .= substr($phone, 7, 3);

                return response()->json([
                    'customer' => Crypt::encryptString($user->id),
                    //  'otp' => $verification_otp,
                    'intended' => $this->previous ? $this->previous : $this->redirectPath(),
                    'otp_verification_status' => $user->otp_verification_status,
                    'csrf' => csrf_token(),
                    'phone' => $result,
                ]);
            }
            
            return response()->json([
                'auth' => Auth::guard('customer')->check(),
                'intended' => $this->previous ? $this->previous : $this->redirectPath(),
                'otp_verification_status' => $user->otp_verification_status,
            ]);
        }
    }


    protected function credentials(Request $request)
    {
        $this->previous = $request->intended;

        return $request->only($this->username(), 'password');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|email|string',
            'password' => 'required',
        ], [
            $this->username().'required' => 'The email id field is required.',
        ]);
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        // $errors = [$this->username() => trans('auth.failed')];
        if (!Customer::where('email', $request->email)->exists()) {
            $errors['email'] = trans('auth.email_not_found');
        }
        else {
            $customer = Customer::where('email', $request->email)->first();
            if ($customer && (!Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password]))) {
                $errors['password'] = trans('auth.password_incorrect');
            }
        }
        
        throw ValidationException::withMessages($errors);
    }


    public function loginWithOtp(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|digits:10',
        ]);

        if (is_numeric($request->get('phone'))) {

            $customer = Customer::wherePhone($request->phone)->first();
            if ($customer) {
                $customer->verification_otp = $verification_otp = rand(1000, 9999);
                $customer->save();

                // $message = 'Dear '.$customer->name.' The OTP to log in to your account is ' . $verification_otp.' Please don\'t share your OTP with anyone.';
               
                // SmsHelper::sendOtp('+91'.$customer->phone, $verification_otp);
                // WhatsAppHelper::sendOtp('+91'.$customer->phone, $verification_otp);
                
                $phone = $customer->phone;
                $result = substr($phone, 0, 2);
                $result .= "****";
                $result .= substr($phone, 7, 3);

                return response()->json([
                     //'verification_otp' => $verification_otp,
                    'phone' => $result,
                    'user' => Crypt::encryptString($customer->id),
                    'login_type' => '1',
                ]);
            } else {
                
                $phone=request('phone');
                
                if(strlen($phone)==11){
                    
                    if( substr($phone, 0, 1)=='0'){
                        $phone=substr($phone, 1);
                    }
                    
                }

                $customer = new Customer();
                $customer->name = request('phone');
                $customer->phone = $phone;
                $customer->email = request('phone') . '@store.com';
                $customer->verification_otp = $verification_otp = rand(1000, 9999);
                $customer->status = 1;
                $customer->verification_status = 1;
                $customer->reg_type = 1;
                $customer->password = Hash::make(request('phone'));
                $customer->save();

                // $message = 'Dear '.$customer->name.' The OTP to log in to your account is ' . $verification_otp.' Please don\'t share your OTP with anyone.';

                // SmsHelper::sendOtp('+91'.$customer->phone, $verification_otp);
                // WhatsAppHelper::sendOtp('+91'.$customer->phone, $verification_otp);
                
                $phone = $customer->phone;
                $result = substr($phone, 0, 2);
                $result .= "****";
                $result .= substr($phone, 7, 3);
                return response()->json([
                    // 'verification_otp' => $verification_otp,
                    'phone' => $result,
                    'user' => Crypt::encryptString($customer->id),
                    'login_type' => '2',
                ]);

            }
        }

    }

    public function otpVerify(Request $request)
    {

        $this->validate($request, [
            'otp' => 'required',
        ]);
        
        if (!empty($request->intended)) {
            $this->previous = $request->intended;
        }

        $customer = Customer::whereId(Crypt::decryptString($request->user_id))->where('verification_otp', $request->otp)->first();
        if (!empty($customer)) {

            $customer->verification_otp = null;
            $customer->otp_verification_status = 1;
            $customer->save();
            
            if(request()->login_type==0){
                
                try {
                    // Mail::to($customer->email, $customer->name)->send(new Register($customer));
                } catch (\Exception $e) {
                    $e->getMessage();
                }
            }
            
            if ($customer->verification_status != 1) {
                return response()->json([
                    'login' => 'failed',
                    'message1' => 'Your account is under verification.',
                    'message2' => 'Please contact Administrator.',
                    'intended' => $this->previous ? $this->previous : $this->redirectPath(),
                ]);
            }
            elseif ($customer->status != 1) {
                return response()->json([
                    'login' => 'failed',
                    'message1' => 'Your account has been disabled.',
                    'message2' => 'Please contact Administrator.',
                    'intended' => $this->previous ? $this->previous : $this->redirectPath(),
                ]);
            }
            else {
                Auth::guard('customer')->loginUsingId($customer->id);
                return response()->json([
                    'login' => 'success',
                    'intended' => $this->previous ? $this->previous : $this->redirectPath(),
                ]);
            }
            
        } else {
            return response()->json(['errors' => ['otp' => 'Invalid OTP/Credentials']], 422);
        }
    }


    public function resendOTP(Request $request)
    {
        $customer = Customer::whereId(Crypt::decryptString(request()->user_id))->first();
     
        $customer->verification_otp = $verification_otp = rand(1000, 9999);
        $customer->save();
      
        // $message = 'Dear '.$customer->name.' The OTP to log in to your account is ' . $verification_otp.' Please don\'t share your OTP with anyone.';

        // SmsHelper::sendOtp('+91'.$customer->phone, $verification_otp);
        // WhatsAppHelper::sendOtp('+91'.$customer->phone, $verification_otp);
        
        return response()->json([
            'auth' => Auth::guard('customer')->check(),
            'customer' => Crypt::encryptString($customer->id),
             //'otp' => $verification_otp,
            'intended' => $this->previous ? $this->previous : $this->redirectPath(),
        ]);

    }
    
    
    public function underVerification()
    {
        return view('account-under-verification');
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
