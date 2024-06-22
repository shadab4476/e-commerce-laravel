<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\forgotPass;
use App\Mail\MailOtp;
use App\Mail\registerMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function PHPSTORM_META\map;

class AuthController extends Controller
{
    //
    public function home()
    {
        $title = "Home";
        return view("dashboard.home.home", compact('title'));
    }
    public function getRegister()
    {
        $title = "Register";
        return view("auth.register", compact('title'));
    }
    public function getLogin()
    {
        $title = "Login";
        return view("auth.login", compact('title'));
    }

    public function login(Request $request)
    {
        $verify_username = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? "email" : "name";
        if ($verify_username == "email") {
            $credential = array("email" => $request->input('email'),  "password" => $request->input('password'));
        } else {
            $credential = array("name" => $request->input('email'),  "password" => $request->input('password'));
        }

        if (auth()->attempt($credential)) {
            return redirect('/');
        }
        return redirect()->back()->with(["error" => "Please enter valid credentials."]);
    }

    public function getVerifyOtp()
    {
        $title = "Verify Otp";
        return view("auth.verify_otp", compact('title'));
    }
    public function getEmailPhoneVerify()
    {
        $title = "Auth";
        return view('auth.mailPhoneVerify', compact('title'));
    }
    public function emailPhoneVerify(Request $request)
    {
        $request->validate([
            "email" => "required"
        ]);
        try {
            $email = $request->input('email');
            $otp = rand("111111", "999999");
            session()->put("email_otp", $otp);
            $user = array("email" => $request->input('email'), "name" => "", "otp" => $otp);
            $this->sendEmail((object) $user);
            session()->put("user_email",  $email);
            return redirect()->route('get.verifyOtp')->with(["status" => "OTP sent.."]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(["error" => $exception->getMessage()]);
        }
    }
    public function verifyOtp(Request $request)
    {
        $email_otp_login = $request->input('email_otp');
        $email_check = User::where("email", session("user_email"))->pluck("email", "email");
        if ($email_otp_login == session("email_otp")) {
            session()->put("verify_otp_true", "Otp verified..");
            if ($email_check->has(session("user_email"))) {
                $loginUser = User::whereEmail($email_check)->first();
                Auth::guard()->login($loginUser);
                if ($loginUser) {
                    return redirect('/');
                }
                return redirect()->route("get.login");
            }
            return redirect()->route("get.register");
        }
        return redirect()->back()->with(["error" => "Invalid OTP!!"]);
    }

    public function register(Request $request)
    {

        $request->validate([
            "name" => "required|string|max:15|unique:users,name",
            "image" => "nullable|image|mimes:jpeg,png,jpg",
            "password" => "required|min:4",
            "email" => "email:rfc,dns|unique:users,email",
        ]);
        $image = $request->file('image');
        if ($image) {
            $fileName = time() . '.' . $image->extension();
            $image->move(public_path('/assets/images'), $fileName);
        } else {
            $fileName = null;
        }
        try {
            $user = User::create([
                "name" => $request->input('name'),
                "password" => bcrypt($request->input('password')),
                "email" => session()->get('user_email'),
                "phone" =>  null,
                "image" => $fileName,
            ]);
            $user->assignRole("user");
            Mail::to(session("user_email"))->send(new RegisterMail($user));
            auth()->guard()->login($user);
            return redirect('/')->with(["status" => "Account successfully registered."]);
            // return redirect()->route('home')->with(["status" => "Account successfully registered."]);
        } catch (\Exception $e) {
            return redirect()->back()->with(["error" => $e->getMessage()]);
        }
    }
    public function sendEmail($user)
    {
        Mail::to($user->email)->send(new MailOtp($user));
    }
    public function resendOTP()
    {
        try {
            $otp = rand("111111", "999999");
            session()->put("email_otp", $otp);
            $user = array("email" => session("user_email"), "name" => "", "otp" => $otp);
            $this->sendEmail((object) $user);
            return response()->json([
                "status" => "Otp sent.."
            ]);
        } catch (\Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }


    public function getForgotPassword()
    {
        $title = "Forgot Password";
        return view("auth.forgot", compact('title'));
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required'
        ]);
        try {
            $user_id = User::whereEmail(session("user_email"))->pluck("id");
            if ($user_id->has(0)) {
                $user =   User::find($user_id[0]);
                if (Hash::check($request->input('password'), $user->password)) {
                    return redirect()->route('get.forgot.password')->with(["status" => "Password not to be same.."]);
                }
                $user->password = bcrypt($request->input('password'));
                $user->update();
                Mail::to($user->email)->send(new forgotPass($user));
                return redirect()->route('get.login')->with(["status" => "Password Changed.."]);
            }
            return redirect()->route('get.forgot.password')->with(["error" => session("user_email") . " Data not found... Please Register Now"]);
        } catch (\Exception $exception) {
            return redirect()->route("get.forgot.password")->with(["error" => $exception->getMessage()]);
        }
    }

    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('index');
    }
}
