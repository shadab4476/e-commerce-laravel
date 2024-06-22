@extends('layouts.app')

@section('content')
    <div class="all_section_parent dark_image_bg">
        @include('layouts.header')
        <div class="container mx-auto">

            <div class="login_form_parent md:pb-10 ">
                <div class="flex my-3">
                    <h1 class="md:text-5xl  text-yellow-500 font-medium">Login Form</h1>
                </div>
                <div class="form_parent   md:py-5 md:px-10  md:w-[35%] md:mx-auto">
                    <form method="POST" class="w-full gap-y-2 flex flex-wrap" action="{{ route('login') }}">
                        @csrf
                        <p style="display:none" class="error_redirect text-red-600 font-medium"></p>
                        <p style="display:none" class="status_redirect text-green-600 font-medium"></p>
                        <div class="w-full">
                            <label for="email" class="text-white">Email/Name</label>
                            <input autofocus value="{{ old('email') }}" class="w-full focus:outline-0 px-2 py-3"
                                type="text" placeholder="Email/Name" name="email" id="email">
                        </div>

                        <div class="w-full">
                            <label for="password" class="text-white">Password</label>
                            <input value="{{ old('password') }}" class="w-full focus:outline-0 px-2 py-3" type="text"
                                placeholder="Password" name="password" id="password">
                        </div>
                        <div class="w-full mt-2 flex justify-between items-center text-white">
                            <button
                                class="w-1/2  bg-yellow-600 hover:bg-yellow-500 transition-all  px-2 py-3">Login</button>
                            <a href="{{ route('get.forgot.password') }}" class="p-2 underline text-blue-600">Forgot
                                Password</a>
                        </div>
                        <p class="text-white">New Account Create. <a class="inline-block text-blue-600 underline"
                                href="{{ route('get.register') }}">Register Now</a> </p>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
