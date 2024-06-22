@extends('layouts.app')
@section('content')
    <div class="all_section_parent dark_image_bg pb-5">
        @include('layouts.header')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/r-2.5.0/datatables.min.css" rel="stylesheet">

        {{-- error and status Message Start --}}
        <p style="display: none" class="absolute status_redirect w-full text-xl text-center text-green-400 font-bold">
        </p>
        <p style="display:none" class="error_redirect absolute w-full text-lg text-center text-red-400 font-bold">
        </p>
        {{-- error and status Message End --}}

        <section class="first_section mt-5">
            <div class="container mx-auto">
                {{-- <div class="flex my-3 justify-between items-center">
                    <h1 class="md:text-5xl  text-yellow-500 font-medium">@<span
                            class="inline-block text-yellow-500">{{ auth()->user()->name }}</span>'s Profile
                    </h1>
                    <a class="inline-block px-8 bg-yellow-500 hover:bg-yellow-400 transition py-2 text-lg"
                        href="{{ route('home') }}">Home</a>
                </div> --}}
                <div class="flex gap-x-3 items-start justify-between  rgb-black">
                    <div class="w-[25%] p-2 pr-0">
                        {{-- include profile edit sidebar --}}
                        @include('layouts.userSidebar')
                    </div>
                    <div class="w-[75%] p-2 pl-0">
                        @if (url()->current() == route('get.accountDetail'))
                            <div class="profile_edit_parent p-6  bg-black ">
                                <div class="personal_info">
                                    <h2 class="text-3xl flex items-end font-medium text-yellow-500">Personal Information
                                        <button
                                            class="ml-7 show_hide_btn text-sm hover:text-blue-400 px-4 py-1 bg-white transition text-blue-600 inline-block"
                                            type="button">Edit</button>
                                    </h2>
                                    <form class="m-0 flex  mt-7 items-center" enctype="multipart/form-data" method="post"
                                        action="{{ route('update.accountDetail') }}">
                                        @csrf
                                        <div class="w-1/2">
                                            <input disabled type="text"
                                                class="bg-neutral-200 name_update_value	focus:outline-none cursor-not-allowed px-3 py-3 w-full "
                                                value="{{ auth()->user()->name }}" name="name" required>
                                            <input disabled type="file" accept=".jpeg,.jpg,.png"
                                                class="mt-3 cursor-not-allowed image_update_value bg-gray-300  pl-3 py-3 w-full "
                                                name="image">
                                        </div>
                                        <div class="w-1/2 text-center">
                                            <button disabled type="submit" style="display: none"
                                                class="w-1/2 personal_data_submit bg-yellow-600 py-3 hover:bg-yellow-500 font-bold transition">
                                                Update</button>
                                            @error('image')
                                                <p class="text-red-500"></p>
                                            @enderror
                                            @error('name')
                                                <p class="text-red-500"></p>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="pass_info mt-10">
                                    <h2 class="text-3xl flex items-end font-medium text-yellow-500">Change Password<button
                                            class="ml-7 show_hide_btn text-sm hover:text-blue-400 px-4 py-1 bg-white transition text-blue-600 inline-block"
                                            type="button">Edit</button>
                                    </h2>
                                    <form class="m-0 hidden flex flex-wrap mt-7 items-center" method="post"
                                        action="{{ route('change.password') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        
                                        <div class="w-1/2">
                                            @error('current_pass')
                                                <p class=" text-red-500">
                                                    {{ $message }}</p>
                                            @enderror
                                            <input type="password" autofocus class=" focus:outline-none py-2 px-3 w-full "
                                                placeholder="Current Password" value="{{ old('current_pass') }}"
                                                name="current_pass">
                                            @error('password')
                                                <p class=" text-red-500">
                                                    {{ $message }}</p>
                                            @enderror
                                            <input type="text" class=" mt-3 focus:outline-none py-2 px-3 w-full "
                                                placeholder="New Password" value="{{ old('password') }}" name="password">
                                        </div>
                                        <div class="w-1/2 flex justify-center items-center">
                                            <button type="submit"
                                                class="w-1/2 pass_data_submit bg-yellow-600 flex gap-x-3 justify-center items-center py-3 hover:bg-yellow-500 font-bold transition">Update</button>
                                        </div>
                                    </form>
                                </div>



                                
                                <div class="email_edit relative mt-10">
                                    <h2 class="text-3xl flex items-end font-medium text-yellow-500">Email Address
                                        <button
                                            class="ml-7 show_hide_btn text-sm hover:text-blue-400 px-4 py-1 bg-white transition text-blue-600 inline-block"
                                            type="button">Edit</button>
                                    </h2>
                                    <p style="display: none" class="absolute left-0 text-red-500 error_email"></p>
                                    <p style="display: none" class="absolute left-0 text-green-500 status_email"></p>
                                    <div class="flex w-full mt-7">
                                        <input type="email" disabled required
                                            class="cursor-not-allowed email_value_update bg-neutral-200 focus:outline-none w-1/2 py-2 px-5"
                                            name="email" value="{{ auth()->user()->email }}">

                                        <div class="w-1/2 flex ">
                                            <input type="number" name="otp" id="" placeholder="Enter OTP.."
                                                class="border-l hidden boder-black focus:outline-none w-1/2 py-2 px-5 otp_check_email">
                                            <button type="button" style="display: none" disabled
                                                class="w-1/2 email_data_submit bg-yellow-600 flex gap-x-3 justify-center items-center py-3 hover:bg-yellow-500 font-bold transition">Update<svg
                                                    aria-hidden="true"
                                                    class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600 hidden"
                                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                        fill="currentColor"></path>
                                                    <path
                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                        fill="currentFill"></path>
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="phone_edit relative mt-10">
                                    <h2 class="text-3xl flex items-end font-medium text-yellow-500">Phone Update
                                        <button
                                            class="ml-7 show_hide_btn text-sm hover:text-blue-400 px-4 py-1 bg-white transition text-blue-600 inline-block"
                                            type="button">Edit</button>
                                    </h2>
                                    <p style="display: none" class="absolute left-0 text-red-500 error_phone"></p>
                                    <p style="display: none" class="absolute left-0 text-green-500 status_phone"></p>

                                    <div class="flex mt-7 flex-wrap">
                                        <div class="flex w-full items-start">
                                            <input type="text" name="phone" id="" disabled
                                                placeholder="Ex: +91999988887777" value="<?php if (auth()->user()->phone) {
                                                    $phone = '+';
                                                    echo $phone .= auth()->user()->phone;
                                                } ?>"
                                                class=" focus:outline-none  bg-neutral-200 cursor-not-allowed w-[36%] py-2 px-5 phone_value_update">
                                            <div id="recaptcha-container" class="w-[34%] hidden"></div>
                                            <button type="button" disabled
                                                class="bg-yellow-600 hover:bg-yellow-500 w-[30%] py-3 hidden cursor-not-allowed sentOtp">Sent
                                                OTP<svg aria-hidden="true"
                                                    class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600 hidden"
                                                    viewBox="0 0 100 101" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                        fill="currentColor"></path>
                                                    <path
                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                        fill="currentFill"></path>
                                                </svg></button>
                                        </div>
                                        <div class="phone_otp hidden w-1/2">
                                            <div class="alert alert-success" id="successRegsiter" style="display: none;">
                                            </div>
                                            <div class="flex w-full">
                                                <input type="text" autofocus placeholder="Enter OTP.."
                                                    class="focus:outline-none w-1/2 py-2 px-5 phone_otp_value">
                                                <button type="button"
                                                    class="bg-yellow-600 hover:bg-yellow-500 w-1/2 verifyBtn">Verify
                                                    Code
                                                    <svg aria-hidden="true"
                                                        class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600 hidden"
                                                        viewBox="0 0 100 101" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                            fill="currentColor"></path>
                                                        <path
                                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                            fill="currentFill"></path>
                                                    </svg></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        @endif
                        @if (url()->current() == route('get.addressDetail'))
                            <div class="profile_edit_parent p-6  bg-black ">
                                <div class="personal_info">
                                    <h2 class="text-3xl flex items-end font-medium text-yellow-500">Manage Address
                                    </h2>
                                    <div class="flex justify-center">
                                        <button
                                            class="text-[#2370f4]  secondary_font add_address_btn   text-2xl px-2 py-1  "
                                            type="button">Add+</button>
                                    </div>
                                    <form class="mt-5 hidden add_address_form"
                                        action="{{ route('update.addressDetail') }}" method="post">

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="w-full justify-between  gap-x-10 flex items-center">
                                            <div class="w-1/2">
                                                @error('name')
                                                    <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                                <label for="addressName">Name</label>
                                                <input id="addressName" class="w-full focus:outline-0 px-5 py-2"
                                                    type="text" value="{{ auth()->user()->name }}" name="name"
                                                    required>
                                            </div>
                                            <div class="w-1/2">
                                                @error('phone')
                                                    <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                                <label for="addressPhone">Phone</label>
                                                <input id="addressPhone" class="w-full focus:outline-0 px-5 py-2"
                                                    placeholder="Ex:919999888877" type="number"
                                                    value="{{ auth()->user()->phone }}" min="123456789123"
                                                    max="999999999999" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="w-full justify-between  mt-3 gap-x-10 flex items-center">
                                            <div class="w-1/2">
                                                @error('address')
                                                    <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                                <label for="addressAddress">Address</label>
                                                <input id="addressAddress" placeholder="Address (Area and Street)"
                                                    class="w-full focus:outline-0 px-5 py-2" type="text"
                                                    value="{{ old('address') }}" name="address" required>
                                            </div>
                                            <div class="w-1/2">
                                                @error('pincode')
                                                    <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                                <label for="addressPincode">Pincode</label>
                                                <input id="addressPincode" value="{{ old('pincode') }}"
                                                    class="w-full focus:outline-0 px-5 py-2" placeholder="Pincode"
                                                    type="number" max="999999" min="111111" name="pincode"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="w-full justify-between  mt-3 gap-x-10 flex items-center">
                                            <div class="w-1/2">
                                                @error('state')
                                                    <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                                <label for="addressState">State</label>
                                                <select required class="text-black px-5 py-1 w-full" id="addressState"
                                                    name="state" id="addressState">
                                                    <option class="text-black first_state_null" value="">Select
                                                        State</option>
                                                    <option class="text-black" value="Andra Pradesh">Andra Pradesh
                                                    </option>
                                                    <option class="text-black" value="Arunachal Pradesh">Arunachal Pradesh
                                                    </option>
                                                    <option class="text-black" value="Assam">Assam</option>
                                                    <option class="text-black" value="Bihar">Bihar</option>
                                                    <option class="text-black" value="Chhattisgarh">Chhattisgarh</option>
                                                    <option class="text-black" value="Goa">Goa</option>
                                                    <option class="text-black" value="Gujarat">Gujarat</option>
                                                    <option class="text-black" value="Haryana">Haryana</option>
                                                    <option class="text-black" value="Himachal Pradesh">Himachal Pradesh
                                                    </option>
                                                    <option class="text-black" value="Jammu and Kashmir">Jammu and Kashmir
                                                    </option>
                                                    <option class="text-black" value="Jharkhand">Jharkhand</option>
                                                    <option class="text-black" value="Karnataka">Karnataka</option>
                                                    <option class="text-black" value="Kerala">Kerala</option>
                                                    <option class="text-black" value="Madya Pradesh">Madya Pradesh
                                                    </option>
                                                    <option class="text-black" value="Maharashtra">Maharashtra</option>
                                                    <option class="text-black" value="Manipur">Manipur</option>
                                                    <option class="text-black" value="Meghalaya">Meghalaya</option>
                                                    <option class="text-black" value="Mizoram">Mizoram</option>
                                                    <option class="text-black" value="Nagaland">Nagaland</option>
                                                    <option class="text-black" value="Orissa">Orissa</option>
                                                    <option class="text-black" value="Punjab">Punjab</option>
                                                    <option class="text-black" value="Rajasthan">Rajasthan</option>
                                                    <option class="text-black" value="Sikkim">Sikkim</option>
                                                    <option class="text-black" value="Tamil Nadu">Tamil Nadu</option>
                                                    <option class="text-black" value="Telangana">Telangana</option>
                                                    <option class="text-black" value="Tripura">Tripura</option>
                                                    <option class="text-black" value="Uttaranchal">Uttaranchal</option>
                                                    <option class="text-black" value="Uttar Pradesh">Uttar Pradesh
                                                    </option>
                                                    <option class="text-black" value="West Bengal">West Bengal</option>
                                                    <option class="text-black" value="Andaman and Nicobar Islands">Andaman
                                                        and Nicobar Islands
                                                    </option>
                                                    <option class="text-black" value="Chandigarh">Chandigarh</option>
                                                    <option class="text-black" value="Dadar and Nagar Haveli">Dadar and
                                                        Nagar Haveli</option>
                                                    <option class="text-black" value="Daman and Diu">Daman and Diu
                                                    </option>
                                                    <option class="text-black" value="Delhi">Delhi</option>
                                                    <option class="text-black" value="Lakshadeep">Lakshadeep</option>
                                                    <option class="text-black" value="Pondicherry">Pondicherry</option>
                                                </select>
                                            </div>
                                            <div class="w-1/2">
                                                @error('city')
                                                    <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                                <label for="addressCity">City</label>
                                                <input id="addressCity" placeholder="City"
                                                    class="w-full focus:outline-0 px-5 py-2" type="text"
                                                    value="{{ old('city') }}" name="city" required>
                                            </div>
                                        </div>
                                        <div class="w-full justify-between  mt-3 gap-x-10 flex items-center">
                                            <div class="w-1/2">
                                                <p class="text-lg mb-1 font-normal">Address Type</p>
                                                <div class="flex gap-x-5">
                                                    @error('address_type')
                                                        <p class="text-red-500">{{ $message }}</p>
                                                    @enderror
                                                    <div class="">
                                                        <label for="address_type1">Home</label>
                                                        <input type="radio" name="address_type" checked value="home"
                                                            id="address_type1">
                                                    </div>
                                                    <div class="">
                                                        <label for="address_type2">Work</label>
                                                        <input type="radio" name="address_type" value="work"
                                                            id="address_type2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-1/2 mt-5">
                                            <button type="submit"
                                                class="w-1/2  bg-yellow-600 py-3 hover:bg-yellow-500 font-bold transition-all">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="all_addresses text-center mt-3 border-t">
                                    <button class="text-[#2370f4]  secondary_font    text-2xl p-2  " type="button">All
                                        Addresses</button>
                                    <table class="" id="addresstable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Country</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Pincode</th>
                                                <th>Address Type</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/r-2.5.0/datatables.min.js"></script>


    </script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyCEt9nMC9rfnaJOrq1Tlw8s2Z8xf745rJ4",
            authDomain: "mobile-otp-10df6.firebaseapp.com",
            projectId: "mobile-otp-10df6",
            storageBucket: "mobile-otp-10df6.appspot.com",
            messagingSenderId: "598923848155",
            appId: "1:598923848155:web:d0b6059f5debc4c9031ffe",
            measurementId: "G-X5QD8LM0NE"
        };

        firebase.initializeApp(firebaseConfig);
    </script>

    <script type="text/javascript">
        // phone edit btn
        $(".phone_edit .show_hide_btn").click(function() {
            $(".phone_value_update,.sentOtp").toggleClass("cursor-not-allowed ");
            if ($(".phone_value_update,.sentOtp").attr("disabled")) {
                $(".phone_value_update,.sentOtp").removeAttr("disabled");
                $(this).text("Cancel");
            } else {
                $(this).text("Edit");
                $(".phone_value_update,.sentOtp").attr("disabled", "true");
            }
            $(".sentOtp,#recaptcha-container").toggleClass("hidden");
            $(".phone_value_update").toggleClass(" bg-neutral-200 ").focus();
            if (!$(".phone_otp ").hasClass("hidden")) {
                $(".phone_otp").addClass("hidden");
            }
        });
        window.onload = function() {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        $(document).on("click", ".sentOtp", function() {
            if ({{ auth()->user()->phone ? auth()->user()->phone : '1234567890' }} != $(".phone_value_update")
                .val()) {
                var number = $(".phone_value_update").val();
                var this_btn_clk = $(this);
                console.log(number);
                firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(
                    confirmationResult) {
                    $(this_btn_clk).children("svg").removeClass("hidden");
                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    console.log(coderesult);
                    $(".status_phone").text("Message Sent Successfully.").fadeIn().delay().fadeOut(3000);
                    $(".phone_otp").removeClass("hidden");
                    $(".phone_value_update").addClass("cursor-not-allowed").attr("disabled", "true");
                    $(this_btn_clk).children("svg").addClass("hidden");
                }).catch(function(error) {
                    $(this_btn_clk).children("svg").addClass("hidden");
                    $(".error_phone").text(error.message).fadeIn().delay().fadeOut(3000);

                });
            } else {
                alert("Phone number must not be the same..");
            }
        });
        $(document).on("click", ".verifyBtn", function() {
            var number_value = $(".phone_value_update").val();
            var code = $(".phone_otp_value").val();
            $(this).children("svg").removeClass("hidden");
            var this_btn_clk = $(this);
            coderesult.confirm(code).then(function(result) {
                var user = result.user;
                console.log(user);

                $.ajax({
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                    },
                    url: "{{ route('phone.update') }}",
                    data: {
                        phone: number_value,
                    },
                    success: function(response) {
                        $(this_btn_clk).children("svg").addClass("hidden");
                        if (response.error) {
                            $(".error_phone").text(response.error).fadeIn().delay(3000)
                                .fadeOut();
                        } else {

                            $(".phone_edit .show_hide_btn").text("Edit");
                            $(".sentOtp,#recaptcha-container")
                                .toggleClass("hidden");
                            $(".phone_value_update,.sentOtp").toggleClass(
                                "cursor-not-allowed ");
                            $(".phone_value_update").toggleClass(" bg-neutral-200 ")
                                .focus();
                            $(".phone_value_update,.sentOtp").attr("disabled", "true");
                            $(".phone_otp").addClass("hidden");
                            $(".status_phone").text(response.status).fadeIn().delay(3000)
                                .fadeOut();
                        }
                    }
                });

            }).catch(function(error) {
                $(this_btn_clk).children("svg").addClass("hidden");
                $(".error_phone").text(error.message).fadeIn().delay(3000)
                    .fadeOut();
            });
        })
    </script>

    <script>
        $(document).ready(function() {



            // personal edit btn
            $(".personal_info button.show_hide_btn").click(function() {
                var this_ = $(this);
                $(".name_update_value,.image_update_value").toggleClass(
                    "cursor-not-allowed bg-white");
                if ($(".personal_data_submit,.name_update_value,.image_update_value").attr("disabled")) {
                    $(this_).text("Cancel");
                    $(".name_update_value,.image_update_value,.personal_data_submit").removeAttr(
                        "disabled");
                    $(".personal_data_submit").fadeToggle();
                    $(".name_update_value").focus();

                } else {
                    $(".personal_data_submit").fadeToggle();
                    $(".image_update_value,.name_update_value,.personal_data_submit").attr("disabled",
                        "true")
                    $(this_).text("Edit");
                }
            });
            // email edit btn
            $(".email_edit button.show_hide_btn").click(function() {
                $(".email_value_update").toggleClass("cursor-not-allowed bg-neutral-200");
                if ($(".email_value_update,.email_data_submit").attr("disabled")) {
                    $(".email_value_update,.email_data_submit").removeAttr("disabled");
                    $(this).text("Cancel");
                } else {
                    $(".email_value_update,.email_data_submit").attr("disabled", "true");
                    $(this).text("Edit");
                }
                $(".otp_check_email").addClass("hidden");
                $(".email_value_update").val("{{ auth()->user()->email }}").focus();
                $(".email_data_submit").fadeToggle();
            });

            // password update
            $(".pass_info button.show_hide_btn").click(function() {
                $this_btn_pass = $(this);
                $(".pass_info form").toggleClass("hidden")
                $(".pass_info form input[type=text],.pass_info form input[type=password]").attr("value", "").val("");
                $(".pass_info form input:nth-child(1)").focus();
                if ($(".pass_info form").hasClass("hidden")) {
                    $this_btn_pass.text("Edit");
                } else {
                    $this_btn_pass.text("Cancel");
                }
            });
            // email updated code Start

            $(document).on("click", ".email_data_submit", function(e) {
                e.preventDefault();
                var this_btn_email = $(this);
                var email_value = $(this).parents(".email_edit").find(".email_value_update").val();

                if ("{{ auth()->user()->email }}".toLowerCase() != email_value.toLowerCase()) {

                    if (!$(".email_value_update").attr("disabled") && $(".otp_check_email").hasClass(
                            "hidden") && $(".otp_check_email").val() == '') {

                        $(this_btn_email).children("svg").removeClass("hidden");
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                            },
                            method: "post",
                            url: "{{ route('profile-email.update') }}",
                            data: {
                                create_otp: "otp created",
                                email: email_value,
                            },
                            success: function(response) {
                                if (response.error) {
                                    $(this_btn_email).children("svg").removeClass("hidden");
                                    $(".error_phone").text(response.error).fadeIn().delay(
                                        5000).faphone();
                                } else {
                                    $(this_btn_email).children("svg").addClass("hidden");
                                    $(".otp_check_email").toggleClass("hidden");
                                    $(".status_email").text(response.status).fadeIn().delay(
                                        5000).fadeOut();
                                }
                            }
                        });
                    } else {
                        $(this_btn_email).children("svg").removeClass("hidden");
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                            },
                            method: "post",
                            url: "{{ route('update-email.otpVerify') }}",
                            data: {
                                confirm_otp: "confirmed",
                                otp: $(".otp_check_email").val(),
                            },
                            success: function(response) {
                                if (response.error) {
                                    $(this_btn_email).children("svg").addClass("hidden");
                                    $(".error_email").text(response.error).fadeIn().delay(5000)
                                        .fadeOut();
                                } else {
                                    $(".email_value_update,.email_data_submit").attr("disabled",
                                        "true");
                                    $(".email_value_update").addClass(
                                        "cursor-not-allowed bg-neutral-200");
                                    $(".email_edit .show_hide_btn ").text("Edit");
                                    $(".otp_check_email").addClass("hidden");
                                    $(".email_data_submit").fadeToggle();
                                    $(this_btn_email).children("svg").addClass("hidden");
                                    $(".status_email").text(response.status).fadeIn().delay(
                                        5000).fadeOut();
                                }
                            }
                        });
                    }
                } else {
                    alert("Email address must not be the same..");
                }
            });
            // email updated code End


            // add address

            var addresstable = $("#addresstable").dataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ route('get.addressDetail') }}",
                },
                columns: [{
                        data: "name",
                        name: "name",
                    }, {
                        data: "phone",
                        name: "phone",
                    },
                    {
                        data: "address",
                        name: "address",
                    }, {
                        data: "country",
                        name: "country",
                    }, {
                        data: "state",
                        name: "state",
                    },
                    {
                        data: "city",
                        name: "city",
                    }, {
                        data: "pincode",
                        name: "pincode",
                    }, {
                        data: "address_type",
                        name: "address_type",
                    }, {
                        data: "action",
                        name: "action",
                    },
                ]
            });

            // add address btn
            $(".add_address_btn").click(function() {
                $(this).parents(".profile_edit_parent").find(".add_address_form").toggleClass("hidden");
                if ($(".add_address_form").hasClass("hidden")) {
                    $(this).text("Add+");
                } else {
                    $(this).text("Close-");
                }

            });

            $("#addressState").select2();
            $("span.select2.select2-container.select2-container--default").css("width", "100%");

            if ("{{ session()->has('address_create') }}") {
                $(".add_address_form").addClass("hidden");
                $(".add_address_form input").val("").attr("value", "");
                $('#addresstable').DataTable().ajax.reload();
            }
            // delete address
            $(document).on("click", ".delete_address", function(e) {
                e.preventDefault();
                var route_address_delete = $(this).attr("data-address");
                var _this = $(this);
                if (confirm("Are your sure to delete this address..")) {
                    $.ajax({
                        url: route_address_delete,
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                        },
                        method: 'DELETE',
                        success: function(response) {
                            if (response.status) {
                                $('#addresstable').DataTable().ajax.reload();
                                $(".status_redirect").text(response.status).fadeIn().delay(3000)
                                    .fadeOut();
                            } else {
                                $(".error_redirect").text(response.error).fadeIn().delay(3000)
                                    .fadeOut();
                            }
                        },
                    });

                }
            });

        });
    </script>
@endsection
