@extends('layouts.app')

@section('content')
    <div class="all_section_parent dark_image_bg ">
        @include('layouts.header')
        <div class="container mx-auto">

            <div class="Verification_form_parent md:pb-10 ">
                <div class="flex my-3">
                    <h1 class="md:text-5xl  text-yellow-500 font-medium">Verification Form</h1>
                </div>
                <div class="form_parent md:py-5 md:px-10  md:w-[35%] md:mx-auto">
                    <form enctype="multipart/form-data" method="POST" class="w-full gap-y-2 flex flex-wrap"
                        action="{{ route('phone.email.verify') }}">
                        @csrf
                        <p style="display: none" class="error_redirect text-red-600 font-medium"></p>
                        <div class="w-full">
                            <label for="email" class="text-white">Email</label>
                            <input required value="{{ old('email') }}" class="w-full focus:outline-0 px-2 py-3"
                                type="email" placeholder="Email" name="email" id="email">
                        </div>
                        @error('email')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror

                        <div class="w-1/2 mt-2">
                            <button
                                class="w-full bg-yellow-600 hover:bg-yellow-500 transition-all text-white px-2 py-3">Send
                                Otp</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
