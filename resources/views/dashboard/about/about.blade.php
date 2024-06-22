@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="container mx-auto">
        <section class="section1">
            <div class="flex items-center mt-3 mb-10   justify-between ">
                <h1 class="md:text-5xl text-yellow-500 font-bold"> About </h1>
                <a class="inline-block transition hover:bg-yellow-400 px-8 bg-yellow-500 py-2 text-lg"
                    href="{{ route('home') }}">Back</a>
            </div>
            <div class=" py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <img src="{{ asset('images/about_image.jpg') }}" alt="About Us Image"
                                class="rounded-lg shadow-lg mb-4">
                        </div>
                        <div>
                            <p class="text-lg leading-relaxed">
                                Welcome to our company! We are dedicated to providing exceptional services and products in
                                the industry. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                            <p class="text-lg leading-relaxed mt-4">
                                Our mission is to deliver high-quality solutions that meet the unique needs of our
                                customers. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
