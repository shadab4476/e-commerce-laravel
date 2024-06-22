@extends('layouts.app')

@section('content')
    <div class="all_section_parent dark_image_bg">
        @include('layouts.header')
        <div class="container mx-auto">

            <div class="forgot_form_parent md:pb-10 ">
                <div class="flex my-3">
                    <h1 class="md:text-5xl  text-yellow-500 font-medium">Forgot Password</h1>
                </div>
                <div class="form_parent   md:py-5 md:px-10  md:w-[35%] md:mx-auto">
                    <form method="POST" class="w-full gap-y-2 flex flex-wrap" action="{{ route('forgot.password') }}">
                        @csrf
                        <p style="display:none" class="status_redirect text-green-600 font-medium">
                        </p>
                        <p style="display:none" class="error_redirect text-red-600 font-medium">
                        </p>
                        <div class="w-full">
                            <label for="password" class="text-white">New Password</label>
                            <input autofocus required value="{{ old('password') }}" class="w-full focus:outline-0 px-2 py-3"
                                type="password" placeholder="New Password" name="password" id="password">
                        </div>
                        @error('password')
                            <p class="error_redirect text-red-600 font-medium">{{ $message }}</p>
                        @enderror

                        <div class="w-full">
                            <label for="password_confirmation" class="text-white">Comfirm Password</label>
                            <input required value="{{ old('password_confirmation') }}"
                                class="w-full focus:outline-0 px-2 py-3" type="text" placeholder="Confirm Password"
                                name="password_confirmation" id="password_confirmation">
                        </div>
                        @error('password_confirmation')
                            <p class="error_redirect text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <div class="w-1/2 mt-2">
                            <button
                                class="w-full bg-yellow-600 hover:bg-yellow-500 transition-all text-white px-2 py-3">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
