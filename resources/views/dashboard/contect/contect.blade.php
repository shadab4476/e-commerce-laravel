@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <section class="secion1">
        <div class="container mx-auto">
            <div class="flex items-center mt-3 mb-10   justify-between ">
                <h1 class="md:text-5xl text-yellow-500 font-bold"> Contect </h1>
                <a class="inline-block transition hover:bg-yellow-400 px-8 bg-yellow-500 py-2 text-lg"
                    href="{{ route('home') }}">Back</a>
            </div>
            <p class="text-2xl secondary_font text-yellow-500 text-center ">Let's Talk..
            </p>
            <div class="flex py-12 items-center">
                <div class="personalDetail w-1/2">
                    <div class="address border-b pb-3 mb-3 border-gray flex items-center gap-x-3">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                class="">
                                <g>
                                    <path
                                        d="M255.976 7.46c-103.808 0-188.263 84.407-188.263 188.215 0 149.269 176.102 300.758 183.582 307.128 1.351 1.158 2.992 1.738 4.681 1.738s3.33-.58 4.681-1.738c7.529-6.37 183.63-157.859 183.63-307.128 0-103.808-84.455-188.215-188.311-188.215zM131.271 196.446c0-68.771 55.982-124.704 124.753-124.704s124.704 55.934 124.704 124.704c0 68.819-55.934 124.753-124.704 124.753s-124.753-55.933-124.753-124.753z"
                                        fill="#ff9e00" opacity="1" data-original="#000000"></path>
                                </g>
                            </svg>
                        </p>
                        <div>
                            <h3 class="text-2xl font-medium">Address</h3>
                            <p>
                                Near Railway Station Bhawani Mandi
                            </p>
                        </div>
                    </div>
                    <div class="phone border-b pb-3 mb-3 border-gray flex items-center gap-x-3">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                viewBox="0 0 513.64 513.64" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                class="">
                                <g>
                                    <path
                                        d="m499.66 376.96-71.68-71.68c-25.6-25.6-69.12-15.359-79.36 17.92-7.68 23.041-33.28 35.841-56.32 30.72-51.2-12.8-120.32-79.36-133.12-133.12-7.68-23.041 7.68-48.641 30.72-56.32 33.28-10.24 43.52-53.76 17.92-79.36l-71.68-71.68c-20.48-17.92-51.2-17.92-69.12 0L18.38 62.08c-48.64 51.2 5.12 186.88 125.44 307.2s256 176.641 307.2 125.44l48.64-48.64c17.921-20.48 17.921-51.2 0-69.12z"
                                        fill="#ff9e00" opacity="1" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                        </p>
                        <div>
                            <h3 class="text-2xl font-medium">Phone</h3>
                            <p>
                                +917726844777 </p>
                        </div>
                    </div>
                    <div class="email border-b pb-3 border-gray flex items-center gap-x-3">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                class="">
                                <g>
                                    <path fill-rule="evenodd"
                                        d="M256 512C114.841 512 0 397.159 0 256S114.841 0 256 0s256 114.841 256 256-114.841 256-256 256zm132.758-166.069a5.732 5.732 0 0 0 5.725-5.725V179.489l-130.25 103.432c-2.41 1.915-5.323 2.872-8.234 2.872s-5.823-.958-8.234-2.872L117.516 179.489v160.717a5.732 5.732 0 0 0 5.725 5.725zm-19.96-179.862L256 255.644l-112.799-89.575zm52.168 5.725v168.414c0 17.759-14.449 32.208-32.208 32.208H123.241c-17.76 0-32.207-14.449-32.207-32.208V171.794c0-17.759 14.448-32.207 32.207-32.207h265.517c17.759-.001 32.208 14.448 32.208 32.207z"
                                        clip-rule="evenodd" fill="#ff9e00" opacity="1" data-original="#000000"
                                        class=""></path>
                                </g>
                            </svg>
                        </p>
                        <div>
                            <h3 class="text-2xl font-medium">Email</h3>
                            <p>
                                shadabansari7726@gmail.com </p>
                        </div>
                    </div>
                </div>
                <div class="ContectMessageForm w-1/2 px-8">
                    <form action="" method="post">
                        @csrf
                        <label for="name" class="w-full ">Full Name</label>
                        <input id="name" class="mb-3 px-3 w-full py-4 focus:outline-none" type="text"
                            placeholder="Full Name" name="name" required
                            value="{{ auth()->check() ? auth()->user()->name : '' }}">
                        <label for="message" class="w-full">Message</label>
                        <textarea name="message" id="message" class="w-full focus:outline-none text-black px-4 py-2" placeholder="Message"
                            rows="5"></textarea>
                        <button
                            class="mt-5 w-1/2  bg-yellow-600 py-3 hover:bg-yellow-500 font-bold transition-all">Send</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
