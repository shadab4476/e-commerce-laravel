@extends('layouts.app')

@section('content')
    <div class="all_section_parent dark_image_bg ">
        @include('layouts.header')
        <div class="container mx-auto">


            <div class="email_otp_form_parent md:pb-10 ">
                <div class="flex my-3">
                    <h1 class="md:text-5xl  text-yellow-500 font-medium">OTP Validation</h1>
                </div>
                <div class="form_parent   md:py-5 md:px-10  md:w-[35%] md:mx-auto">
                    <form method="POST" class="w-full gap-y-2 flex flex-wrap" action="{{ route('verify.otp') }}">

                        @csrf
                        @if (session()->has('email_otp'))
                            <p class="text-green-600 font-medium">{{ session()->get('email_otp') }}</p>
                        @endif
                        <p style="display: none" class="status_redirect text-green-600 font-medium"></p>
                        <p style="display: none" class="error_redirect text-red-600 font-medium "></p>

                        <div class="w-full">
                            <label for="email_otp" class="text-white">Enter Your Email Otp</label>
                            <input required autofocus value="{{ old('email_otp') }}"
                                class="w-full focus:outline-0 px-2 py-3" type="text" placeholder="Email Otp"
                                name="email_otp" id="email_otp">
                        </div>

                        <div class="w-full gap-x-10 mt-2 flex justify-between">
                            <button type="submit"
                                class="w-1/2 bg-yellow-600 hover:bg-yellow-500 transition-all text-white px-2 py-3">Confirm</button>
                            <button disabled type="button"
                                class="w-1/2 bg-gray-500 cursor-not-allowed resend_otp text-white px-2 py-3">Resend</button>

                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            var resend_otp = setInterval(removeAttrDisabled, 10000);

            function removeAttrDisabled() {
                $(".resend_otp").removeAttr("disabled").addClass("bg-yellow-600 cursor-pointer").removeClass(
                    "cursor-not-allowed");
            }

            function addAttrDisabled() {
                $(".resend_otp").attr("disabled", "true").removeClass(
                    "bg-yellow-600 cursor-pointer").addClass(
                    "cursor-not-allowed");
            }

            $(".resend_otp").click(function() {
                clearInterval(resend_otp);
                addAttrDisabled();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    type: "post",
                    url: "{{ route('resend.emailOtp') }}",
                    success: function(success_data) {
                        if (success_data.status) {
                            setInterval(removeAttrDisabled, 10000);
                            $(".status_redirect").text(success_data.status).fadeIn().delay(3000)
                                .fadeOut();

                        } else {
                            $(".error_redirect").text(success_data.error).fadeIn().delay(3000)
                                .fadeOut();
                        }
                    },
                });
            });
        });
    </script>
@endsection
