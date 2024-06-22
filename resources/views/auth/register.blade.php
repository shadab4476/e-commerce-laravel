@extends('layouts.app')

@section('content')
    <div class="all_section_parent dark_image_bg">
        @include('layouts.header')
        <div class="container mx-auto">


            <div class="register_form_parent md:pb-10 ">
                <div class="flex my-3">
                    <h1 class="md:text-5xl  text-yellow-500 font-medium">Registration Form</h1>
                </div>
                <p style="display: none" class="error_redirect text-red-600 font-medium"></p>

                <div class="form_parent   md:py-5 md:px-10  md:w-[35%] md:mx-auto">
                    <form enctype="multipart/form-data" method="POST" class="w-full gap-y-2 flex flex-wrap"
                        action="{{ route('register') }}">
                        @csrf
                        <div class="w-full">
                            <label for="email" class="text-white">Email</label>
                            @if (session()->has('user_email'))
                                <p class="w-full bg-white text-black px-2 py-3">{{ session()->get('user_email') }}</p>
                            @endif
                        </div>
                        @error('email')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <div class="w-full">
                            <label for="name" class="text-white">Name</label>
                            <input required autofocus value="{{ old('name') }}" class="w-full focus:outline-0 px-2 py-3"
                                type="text" placeholder="Name" name="name" id="name">
                        </div>
                        @error('name')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <div class="w-full">
                            <label for="image" class="text-white">Image</label>
                            <input value="{{ old('image') }}" class="w-full focus:outline-0 bg-white px-2 py-3"
                                accept=".png,.jpeg,.jpg" type="file" placeholder="Image" name="image" id="image">
                        </div>
                        @error('image')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror

                        <div class="w-full">
                            <label for="password" class="text-white">Password</label>
                            <input required value="{{ old('password') }}" class="w-full focus:outline-0 px-2 py-3" type="text"
                                placeholder="Password" name="password" id="password">
                        </div>
                        @error('password')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <div class="w-1/2 mt-2">
                            <button
                                class="w-full bg-yellow-600 hover:bg-yellow-500 transition-all text-white px-2 py-3">Register</button>
                        </div>

                    </form>
                    <p class="text-white">Account Exists <a class="underline text-blue-600 inline-block"
                            href="{{ route('get.login') }}">Login Now</a> </p>
                </div>

            </div>
        </div>

    </div>
@endsection
