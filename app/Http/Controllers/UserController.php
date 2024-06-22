<?php

namespace App\Http\Controllers;

use App\Mail\EmailUpdate;
use App\Mail\forgotPass;
use App\Mail\ReminderMail;
use App\Models\User;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function reminder()
    {
        try {
            $this->email();
            return response()->json([
                "status" => "Reminder is set.."
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "error" => $exception->getMessage(),
            ]);
        };
    }


    public function email()
    {
        $user = auth()->user();
        Mail::to($user->email)->send(new ReminderMail($user));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $title = "Profile Info";
        return view("dashboard.profile.edit", compact('title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    // name image update
    public function update(Request $request)
    {
        $request->validate([
            "name" => "required",
            "image" => "image|nullable|mimes:jpeg,jpg,png"
        ]);
        $user = User::find(auth()->user()->id);
        if ($user->image || $user->image != null) {
            $image = $user->image;
        } else {
            $image = null;
        }
        $user_names = User::get('name');
        foreach ($user_names as $user_name) {
            if (strtolower($request->input('name')) != strtolower($user->name) && strtolower($request->input('name')) == strtolower($user_name->name)) {
                return redirect()->back()->with(["error" => "This name is already exist.."]);
            }
        }
        if ($request->hasFile('image')) {
            $image_value = $request->file('image');
            $image = time() . '.' . $image_value->extension();
            $image_value->move(public_path('assets/images'), $image);
        }

        $user->name = $request->input('name');
        $user->image = $image;
        $user->update();
        return redirect()->route('get.accountDetail')->with(["status" => "Profile Updated.."]);
    }

    // email update

    public function emailUpdate(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if ($request->create_otp) {
            $otp = rand("111111", "999999");
            session()->put("email_update_otp", $otp);
            $user_emails = User::get(['email']);
            foreach ($user_emails as $user_email) {
                if (strtolower($request->email) == strtolower($user_email->email)) {
                    return response()->json(["error" => "This Mail ID is already exist.."]);
                }
            }
            session()->put("updated_email_user", $request->email);
            $user->otp = $otp;
            Mail::to($request->email)->send(new EmailUpdate($user));
            return response()->json(["status" => "OTP has been sent your email.."]);
        } else if ($request->confirm_otp) {
            if (session("email_update_otp") == $request->otp) {
                $user->email = session("updated_email_user");
                $user->update();
                return response()->json(["status" => "Email ID is verify and  update successfully.."]);
            } else {
                return response()->json(["error" => "Please enter correct otp.."]);
            }
        }
    }

    // phone update
    /* public function phoneUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "phone" => "required|numeric|unique:users,phone|min:1111111111|max:9999999999"
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->first("phone")]);
        }
        $user = User::find(auth()->user()->id);
        if ($request->fillOtp) {
            try {
                $sid    = getenv("TWILIO_SID");
                $token    = getenv("TWILIO_TOKEN");
                $phone_number    = getenv("TWILIO_PHONE");

                $otp =    rand("111111", "999999");
                session()->put("otp_phone_verify", $otp);
                $twilio = new Client($sid, $token);

                $twilio->messages->create(
                    "+91" . $request->phone, // to
                    array(
                        "from" => $phone_number,
                        "body" => "Hello $user->name Your phone number OTP: $otp"
                    )
                );
                return response()->json(["status" => "OTP is sent your mobile number.."]);
            } catch (\Exception $exception) {
                return response()->json(["error" => "Incorrect number!!!!"]);
            }
        } else if ($request->verifyOtp) {
            if (session("otp_phone_verify") == $request->otp) {
                $user->phone = $request->phone;
                $user->update();
                return response()->json(["status" => "Your mobile number is updated successfully.."]);
            } else {
                return response()->json(["error" => "Please Entered a correct otp..."]);
            }
        }
    }  */
    public function phoneUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "phone" => "required|unique:users,phone"
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->first("phone")]);
        }
        $user = User::find(auth()->user()->id);
        $user->phone = $request->phone;
        $user->update();
        return response()->json(["status" => "Your mobile number is updated successfully.."]);
    }



    public function updateAddress()
    {
    }

    public function changePass(Request $request)
    {
        $request->validate([
            "current_pass" => "required",
            "password" => "required|min:4"
        ]);
        $user = User::find(auth()->user()->id);
        if (!Hash::check($request->input('current_pass'), $user->password)) {
            return redirect()->back()->with(["error" => "Wrong Password.."]);
        }
        if (Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->with(["error" => "Password Is Not To Be Same.."]);
        }
        $user->password = bcrypt($request->input('password'));
        $user->update();
        return redirect()->route('get.accountDetail')->with(["status" => "Password Updated.."]);
    }
}

// <div class="phone_edit relative  mt-10">
// <h2 class="text-3xl flex items-end font-medium text-yellow-500">
//     {{ auth()->user()->phone ? 'Phone Number' : 'Add Your Mobile Number' }}
//     <button
//         class="ml-7 show_hide_btn text-sm hover:text-blue-400 px-4 py-1 bg-white transition text-blue-600 inline-block"
//         type="button">Edit</button>
// </h2>
// <p style="display: none" class="absolute left-0 text-green-500 status_phone"></p>

// <div class="flex w-full mt-7">
//     @if (auth()->user()->phone)
//         <input type="number"disabled
//             class="cursor-not-allowed phone_value_update bg-neutral-200 focus:outline-none w-1/2 py-2 px-5"
//             name="phone" value="{{ auth()->user()->phone }}">
//     @else
//         <input disabled type="number" required placeholder="Enter Your Number.."
//             class="cursor-not-allowed phone_value_update bg-neutral-200 focus:outline-none w-1/2 py-2 px-5"
//             name="phone">
//     @endif
//     <div class="w-1/2 flex">
//         <input type="number" name="otp" id="" placeholder="Enter OTP.."
//             class="border-l hidden boder-black focus:outline-none w-1/2 py-2 px-5 otp_check_phone">
//         <button type="button" style="display: none;" disabled
//             class="w-1/2 phone_data_submit bg-yellow-600 py-3 hover:bg-yellow-500 font-bold transition">Send
//             Otp <svg aria-hidden="true"
//                 class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600 hidden"
//                 viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
//                 <path
//                     d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
//                     fill="currentColor"></path>
//                 <path
//                     d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
//                     fill="currentFill"></path>
//             </svg></button>
//     </div>
// </div>
// </div>


// Phone edit
// $(".phone_edit button.show_hide_btn").click(function() {
//     $(".phone_value_update").toggleClass("cursor-not-allowed bg-neutral-200");
//     if ($(".phone_value_update,.phone_data_submit").attr("disabled")) {
//         $(".phone_value_update,.phone_data_submit").removeAttr("disabled");
//         $(this).text("Cancel");
//     } else {
//         $(".phone_value_update,.phone_data_submit").attr("disabled", "true");
//         $(this).text("Edit");
//     }
//     $(".otp_check_phone").addClass("hidden");
//     $(".phone_value_update").focus();
//     $(".phone_data_submit").fadeToggle();
// });


// $(document).on("click", ".phone_data_submit ", function(e) {
//     e.preventDefault();
//     var this_btn_phone = $(this);
//     var phone_value = $(".phone_value_update").val();
//     if ("{{ auth()->user()->phone }}" != phone_value) {
//         if (!$(".phone_value_update").attr("disabled") && $(".otp_check_phone").hasClass(
//                 "hidden") && $(".otp_check_phone").val() == '') {
//             $(this_btn_phone).children("svg").removeClass("hidden");

//             $.ajax({
//                 url: "{{ route('phone.update') }}",
//                 headers: {
//                     'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
//                 },
//                 data: {
//                     fillOtp: "otp created?..",
//                     phone: phone_value,
//                 },
//                 method: "post",
//                 success: function(response) {
//                     if (response.error) {
//                         $(this_btn_phone).children("svg").addClass("hidden");
//                         alert(response.error);
//                     } else {

//                         $(this_btn_phone).children("svg").addClass("hidden");
//                         $(".status_phone").text(response.status).fadeIn().delay(
//                                 5000)
//                             .fadeOut();
//                         $(".otp_check_phone").removeClass("hidden");
//                     }
//                 },
//             });
//         } else {
//             $(this_btn_phone).children("svg").removeClass("hidden");
//             $.ajax({
//                 url: "{{ route('phoneOtp.verify') }}",
//                 headers: {
//                     'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
//                 },
//                 data: {
//                     verifyOtp: "otp verified?..",
//                     phone: phone_value,
//                     otp: $(".otp_check_phone").val(),
//                 },
//                 method: "post",
//                 success: function(response) {
//                     if (response.error) {
//                         alert(response.error);
//                         $(this_btn_phone).children("svg").addClass("hidden");
//                     } else {
//                         $(this_btn_phone).children("svg").addClass("hidden");
//                         $(".otp_check_phone").toggleClass("hidden");
//                         $(".phone_data_submit").attr("disabled", "true").fadeOut();
//                         $(".phone_value_update").attr("disabled", "true").addClass(
//                             "bg-neutral-200 cursor-not-allowed");
//                         $(".phone_edit .show_hide_btn ").text("Edit");
//                         $(".status_phone").text(response.status).fadeIn().delay(
//                             5000).fadeOut();
//                     }
//                 },
//             });
//         }
//     } else {
//         alert("Phone number updated..");
//     }
// });