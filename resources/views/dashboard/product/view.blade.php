@extends('layouts.app')
@section('content')
    <div style="display:none" class="fixed py-3 h-full w-full top-0 left-0  z-50 image_preview">
        <button type="button" class="w-[50px] close_btn h-[50px] absolute right-0 top-0"><svg
                xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0,0,256,256">
                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                    font-family="none" font-weight="none" font-size="none" text-anchor="none"
                    style="mix-blend-mode: normal">
                    <g transform="scale(5.12,5.12)">
                        <path
                            d="M7.71875,6.28125l-1.4375,1.4375l17.28125,17.28125l-17.28125,17.28125l1.4375,1.4375l17.28125,-17.28125l17.28125,17.28125l1.4375,-1.4375l-17.28125,-17.28125l17.28125,-17.28125l-1.4375,-1.4375l-17.28125,17.28125z">
                        </path>
                    </g>
                </g>
            </svg></button>
        <img src="" class="w-full h-full block object-contain" alt="product preview image">
    </div>
    @include('layouts.header')
    {{-- error and status Message Start --}}
    <p style="display: none" class="absolute status_redirect w-full text-lg text-center text-green-400 font-bold">
    </p>
    <p style="display: none" class="error_redirect absolute w-full text-lg text-center text-red-400 font-bold">
    </p>
    {{-- error and status Message End --}}
    <section class="first_section pb-12">
        <div class="container mx-auto px-12">
            <div class="flex mt-3 mb-10 justify-between items-center">
                <h1 class="md:text-5xl  text-yellow-500 font-medium"> Product View </h1>
                <a class="inline-block px-8 bg-yellow-500 hover:bg-yellow-400 transition-all  py-2 text-lg"
                    href="{{ route('products.index') }}">Back</a>
            </div>
            <div class="w-full flex justify-between items-start gap-x-5">
                <div class="w-1/2 h-full img_view_parent relative">
                    <button class=" absolute zoom_main_img"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0"
                            viewBox="0 0 62 62" style="enable-background:new 0 0 512 512" xml:space="preserve"
                            class="">
                            <g>
                                <g fill="none" fill-rule="evenodd">
                                    <path fill="#9e9e9e"
                                        d="M48 25a22.9 22.9 0 0 1-5.39 14.78 21.022 21.022 0 0 1-2.83 2.83A22.991 22.991 0 1 1 48 25z"
                                        opacity="1" data-original="#9e9e9e" class=""></path>
                                    <path fill="#707070"
                                        d="M25 2c-.5 0-1 .022-1.5.054A22.985 22.985 0 0 1 39.61 39.78a21.022 21.022 0 0 1-2.83 2.83 22.9 22.9 0 0 1-13.391 5.328c.533.036 1.069.062 1.611.062a22.9 22.9 0 0 0 14.78-5.39 21.022 21.022 0 0 0 2.83-2.83A22.989 22.989 0 0 0 25 2z"
                                        opacity="1" data-original="#707070" class=""></path>
                                    <circle cx="25" cy="25" r="19" fill="#02a9f4" opacity="1"
                                        data-original="#02a9f4" class=""></circle>
                                    <path fill="#0377bc"
                                        d="M25 6c-.506 0-1 .037-1.5.076C33.378 6.85 41 15.092 41 25s-7.622 18.15-17.5 18.924c.5.039.994.076 1.5.076 10.493 0 19-8.507 19-19S35.493 6 25 6z"
                                        opacity="1" data-original="#0377bc" class=""></path>
                                    <path fill="#f44335"
                                        d="M58.83 58.83a4.008 4.008 0 0 1-5.66 0L42.56 48.22a1 1 0 0 1 0-1.41l.71-.71 2.83-2.83.71-.71a1 1 0 0 1 1.41 0l10.61 10.61a4.008 4.008 0 0 1 0 5.66z"
                                        opacity="1" data-original="#f44335"></path>
                                    <path fill="#c81e1e"
                                        d="M58.83 53.17 48.22 42.56a1 1 0 0 0-1.41 0l-.71.71-.085.085 9.815 9.815a4 4 0 0 1-1.33 6.539 4 4 0 0 0 4.33-6.539z"
                                        opacity="1" data-original="#c81e1e"></path>
                                    <path fill="#7f8e94" d="m46.1 43.27-2.83 2.83-3.49-3.49a21.022 21.022 0 0 0 2.83-2.83z"
                                        opacity="1" data-original="#7f8e94"></path>
                                    <path fill="#c81e1e" d="m44.677 50.343 5.656-5.656 2.828 2.828-5.656 5.656z"
                                        opacity="1" data-original="#c81e1e"></path>
                                    <path fill="#f5f5f5"
                                        d="M32 23h-5v-5a2 2 0 1 0-4 0v5h-5a2 2 0 1 0 0 4h5v5a2 2 0 1 0 4 0v-5h5a2 2 0 1 0 0-4zM16 14a1 1 0 0 1-.6-1.8A15.869 15.869 0 0 1 25 9a1 1 0 0 1 0 2c-3.03-.01-5.98.974-8.4 2.8a1 1 0 0 1-.6.2z"
                                        opacity="1" data-original="#f5f5f5" class=""></path>
                                    <g fill="#000" fill-rule="nonzero">
                                        <path
                                            d="M25 5C13.954 5 5 13.954 5 25s8.954 20 20 20 20-8.954 20-20c-.013-11.04-8.96-19.987-20-20zm0 38c-9.941 0-18-8.059-18-18S15.059 7 25 7s18 8.059 18 18c-.012 9.936-8.064 17.988-18 18z"
                                            fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                        <path
                                            d="m53.881 46.811-2.831-2.832-2.121-2.121a2 2 0 0 0-2.827 0L43.948 39.7c7.783-10.026 6.431-24.376-3.088-32.771-9.52-8.396-23.925-7.945-32.9 1.03-8.976 8.976-9.427 23.382-1.031 32.9 8.395 9.52 22.745 10.872 32.771 3.089l2.158 2.152a2 2 0 0 0 0 2.827l2.121 2.121 2.829 2.829 5.654 5.654a5 5 0 1 0 7.07-7.07zM46.1 50.343l4.243-4.243 1.414 1.414-4.242 4.242zM3 25C3 12.85 12.85 3 25 3s22 9.85 22 22-9.85 22-22 22c-12.145-.014-21.986-9.855-22-22zm39.654 16.238 2.032 2.032-1.416 1.416-2.032-2.032c.491-.453.963-.925 1.416-1.416zm4.861 2.034 1.414 1.415-4.242 4.242-1.415-1.414zm10.606 14.849a3.072 3.072 0 0 1-4.242 0l-4.95-4.95 4.242-4.242 4.95 4.95a3 3 0 0 1 0 4.242z"
                                            fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                        <path
                                            d="M32 22h-4v-4a3 3 0 0 0-6 0v4h-4a3 3 0 0 0 0 6h4v4a3 3 0 0 0 6 0v-4h4a3 3 0 0 0 0-6zm0 4h-5a1 1 0 0 0-1 1v5a1 1 0 0 1-2 0v-5a1 1 0 0 0-1-1h-5a1 1 0 0 1 0-2h5a1 1 0 0 0 1-1v-5a1 1 0 0 1 2 0v5a1 1 0 0 0 1 1h5a1 1 0 0 1 0 2z"
                                            fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                    </g>
                                </g>
                            </g>
                        </svg></button>
                    <img class="w-full h-[500px] img_view_product object-contain object-center block"
                        src="{{ asset('/assets/images/' . $product->image) }}" alt="product view main image">

                </div>
                <div class="w-1/2 product_detail main_all_pro_detail">
                    <h4 class="text-yellow-500 text-xl capitalize"><a href="#!">{{ $product->category->name }}</a>
                    </h4>
                    <h2 class="text-6xl primary_font font-medium uppercase my-5">{{ $product->name }}</h2>
                    <h3 class="text-xl"><span
                            class="text-gray-500 text-2xl line-through">₹{{ $product->rprice }}.00</span>
                        <span class="text-3xl"><strong>₹{{ $product->price }}.00</strong>
                        </span> & Free Shipping
                    </h3>
                    <p class="font-normal text-lg leading-normal mt-2 mb-5">{{ $product->short_description }}</p>
                    <div class="add_to_cart border-b-[1px] pb-5 border-white flex items-center gap-x-7">
                        <div class="quantity buttons_added flex">
                            <button type="button" class="minus  border-[1px] py-2  px-4 ">-</button>
                            <input type="number" class="w-[42px] text-center quantity_cart focus:outline-none h-[42px]"
                                name="quantity" value="1" aria-label="Product quantity" size="4"
                                min="1" max="" step="1" placeholder="" inputmode="numeric"
                                autocomplete="off">
                            <button type="button" class="py-2 border-[1px] border-white px-4   plus">+</button>
                        </div>
                        @if (auth()->check())
                            <button type="button" id="addToCart"
                                class="uppercase flex items-center bg-yellow-700  transition-all hover:bg-yellow-600 px-10  py-3 font-medium ">Add
                                To
                                Cart
                                <svg aria-hidden="true" role="status"
                                    class="inline w-6 h-6 ms-2  text-gray-200 hidden animate-spin dark:text-gray-600"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="#1C64F2" />
                                </svg>

                            </button>
                        @else
                            <a href="{{ auth()->check() ? '' : route('index') }}" id="productAddToCart"
                                class="uppercase flex items-center transition-all   bg-yellow-700 hover:bg-yellow-600 px-10  py-3 font-medium ">Add
                                To Cart
                            </a>
                        @endif

                        <button type="button" id="productBuyNow"
                            class="uppercase flex items-center transition-all   bg-yellow-700 hover:bg-yellow-600 px-10  py-3 font-medium ">Buy
                            Now
                        </button>
                    </div>
                    <div class="category_parent my-3">
                        <h3 class="capitalize text-lg">Category: <span class="text-yellow-500 font-medium "><a
                                    class="inline-block " href="#!">{{ $product->category->name }}</a></span> </h3>
                    </div>

                    <div class="shipping_detail">
                        <ul>
                            <li class="flex items-center gap-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                    viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                    class="">
                                    <g>
                                        <switch>
                                            <g>
                                                <g fill="#02bc7d">
                                                    <path
                                                        d="M9.7 11.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l3 3c.2.2.4.3.7.3s.5-.1.7-.3l7-8c.3-.5.3-1.1-.2-1.4-.4-.3-1-.3-1.3.1L12 13.5z"
                                                        fill="#02bc7d" opacity="1" data-original="#02bc7d"
                                                        class=""></path>
                                                    <path
                                                        d="M21 11c-.6 0-1 .4-1 1 0 4.4-3.6 8-8 8s-8-3.6-8-8c0-2.1.8-4.1 2.3-5.6C7.8 4.8 9.8 4 12 4c.6 0 1.3.1 1.9.2.5.2 1.1-.1 1.3-.7s-.2-1-.7-1.2h-.1c-.8-.2-1.6-.3-2.4-.3C6.5 2 2 6.5 2 12.1c0 2.6 1.1 5.2 2.9 7 1.9 1.9 4.4 2.9 7 2.9 5.5 0 10-4.5 10-10 .1-.6-.4-1-.9-1z"
                                                        fill="#02bc7d" opacity="1" data-original="#02bc7d"
                                                        class=""></path>
                                                </g>
                                            </g>
                                        </switch>
                                    </g>
                                </svg>No-Risk Money Back Guarantee!
                            </li>
                            <li class="flex items-center gap-x-2"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                    viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                    class="">
                                    <g>
                                        <switch>
                                            <g>
                                                <g fill="#02bc7d">
                                                    <path
                                                        d="M9.7 11.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l3 3c.2.2.4.3.7.3s.5-.1.7-.3l7-8c.3-.5.3-1.1-.2-1.4-.4-.3-1-.3-1.3.1L12 13.5z"
                                                        fill="#02bc7d" opacity="1" data-original="#02bc7d"
                                                        class=""></path>
                                                    <path
                                                        d="M21 11c-.6 0-1 .4-1 1 0 4.4-3.6 8-8 8s-8-3.6-8-8c0-2.1.8-4.1 2.3-5.6C7.8 4.8 9.8 4 12 4c.6 0 1.3.1 1.9.2.5.2 1.1-.1 1.3-.7s-.2-1-.7-1.2h-.1c-.8-.2-1.6-.3-2.4-.3C6.5 2 2 6.5 2 12.1c0 2.6 1.1 5.2 2.9 7 1.9 1.9 4.4 2.9 7 2.9 5.5 0 10-4.5 10-10 .1-.6-.4-1-.9-1z"
                                                        fill="#02bc7d" opacity="1" data-original="#02bc7d"
                                                        class=""></path>
                                                </g>
                                            </g>
                                        </switch>
                                    </g>
                                </svg>No Hassle Refunds</li>
                            <li class="flex items-center gap-x-2"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                    viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                    class="">
                                    <g>
                                        <switch>
                                            <g>
                                                <g fill="#02bc7d">
                                                    <path
                                                        d="M9.7 11.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l3 3c.2.2.4.3.7.3s.5-.1.7-.3l7-8c.3-.5.3-1.1-.2-1.4-.4-.3-1-.3-1.3.1L12 13.5z"
                                                        fill="#02bc7d" opacity="1" data-original="#02bc7d"
                                                        class=""></path>
                                                    <path
                                                        d="M21 11c-.6 0-1 .4-1 1 0 4.4-3.6 8-8 8s-8-3.6-8-8c0-2.1.8-4.1 2.3-5.6C7.8 4.8 9.8 4 12 4c.6 0 1.3.1 1.9.2.5.2 1.1-.1 1.3-.7s-.2-1-.7-1.2h-.1c-.8-.2-1.6-.3-2.4-.3C6.5 2 2 6.5 2 12.1c0 2.6 1.1 5.2 2.9 7 1.9 1.9 4.4 2.9 7 2.9 5.5 0 10-4.5 10-10 .1-.6-.4-1-.9-1z"
                                                        fill="#02bc7d" opacity="1" data-original="#02bc7d"
                                                        class=""></path>
                                                </g>
                                            </g>
                                        </switch>
                                    </g>
                                </svg>Secure Payments</li>
                        </ul>
                    </div>
                </div>
            </div>

            @if ($product->images)
                <div class="related_images mt-8 flex gap-y-5 flex-wrap gap-x-5 items-start">
                    @foreach ($product->images as $image)
                        <div class="r_image w-[259px] h-[300px]">
                            <button class="block  related_img  w-full h-full" type="button">
                                <img class=" w-full h-full object-cover object-center block"
                                    src="{{ asset($image->image) }}" alt="Product Related Image">
                            </button>
                        </div>
                    @endforeach

                </div>
            @endif

            <div class="product_description_and_review border-[1px] mt-10  border-white">
                <div class="description_product border-b-[1px] cursor-pointer   border-white">
                    <h3
                        class="text-yellow-500 py-3 first_h3 px-5 relative text-2xl font-medium secondary_font flex justify-between items-center">
                        Description <button type="button"
                            class="absolute right-[15px] top-50   w-[25px h-[25px] hidden plus_tab inline-block"><svg
                                xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                class="block">
                                <g>
                                    <path d="M13 11V6h-2v5H6v2h5v5h2v-5h5v-2z" data-name="01 align center" fill="#cdd204"
                                        opacity="1" data-original="#000000" class=""></path>
                                </g>
                            </svg></button>

                        <button
                            class="absolute right-[10px] top-50  transition-all 	  minus_tab inline-block w-[25px] h-[25px] "
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="25" x="0" y="0"
                                viewBox="0 0 121.805 121.804" style="enable-background:new 0 0 512 512"
                                xml:space="preserve" class="block">
                                <g>
                                    <path
                                        d="M7.308 68.211h107.188a7.309 7.309 0 0 0 7.309-7.31 7.308 7.308 0 0 0-7.309-7.309H7.308a7.31 7.31 0 0 0 0 14.619z"
                                        fill="#cfc900" opacity="1" data-original="#000000"></path>
                                </g>
                            </svg>
                        </button>

                    </h3>
                    <p class="text-lg cursor-text transition-all p-5 description_text">
                        {{ $product->description }}</p>
                </div>
                @auth

                    <div class="review_product  cursor-pointer ">
                        <h3
                            class="text-yellow-500 first_h3 py-3 px-5 relative text-2xl font-medium secondary_font flex justify-between items-center">
                            Reviews ({{ count($product->reviews) }}) <button type="button"
                                class="absolute right-[15px] top-50   w-[25px h-[25px] plus_tab inline-block"><svg
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0"
                                    viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                    class="block">
                                    <g>
                                        <path d="M13 11V6h-2v5H6v2h5v5h2v-5h5v-2z" data-name="01 align center" fill="#cdd204"
                                            opacity="1" data-original="#000000" class=""></path>
                                    </g>
                                </svg></button>

                            <button
                                class="absolute  transition-all  hidden right-[10px] top-50  minus_tab inline-block w-[25px] h-[25px] "
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="25" x="0" y="0"
                                    viewBox="0 0 121.805 121.804" style="enable-background:new 0 0 512 512"
                                    xml:space="preserve" class="block">
                                    <g>
                                        <path
                                            d="M7.308 68.211h107.188a7.309 7.309 0 0 0 7.309-7.31 7.308 7.308 0 0 0-7.309-7.309H7.308a7.31 7.31 0 0 0 0 14.619z"
                                            fill="#cfc900" opacity="1" data-original="#000000"></path>
                                    </g>
                                </svg>
                            </button>

                        </h3>

                        <div style="display: none" class="p-5 cursor-text review_form ">
                            <form class="border p-3 border-white" action="{{ route('send.review') }}" method="post">
                                @csrf
                                <label for="r_message" class="mb-1 inline-block font-medium">Enter Your Message</label>
                                @error('message')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                                <input type="text" name="message" value="{{ old('message') }}" autofocus required
                                    placeholder="Message.." class="px-5 focus:outline-none w-full py-2" id="r_message">
                                <div class="review_stars flex gap-x-2 my-4">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label for="review{{ $i }}"
                                            class="cursor-pointer  review_star review_star{{ $i }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                                                x="0" y="0" viewBox="0 0 511.987 511"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                class="">
                                                <g>
                                                    <path fill="#ffffff"
                                                        d="M510.652 185.902a27.158 27.158 0 0 0-23.425-18.71l-147.774-13.419-58.433-136.77C276.71 6.98 266.898.494 255.996.494s-20.715 6.487-25.023 16.534l-58.434 136.746-147.797 13.418A27.208 27.208 0 0 0 1.34 185.902c-3.371 10.368-.258 21.739 7.957 28.907l111.7 97.96-32.938 145.09c-2.41 10.668 1.73 21.696 10.582 28.094 4.757 3.438 10.324 5.188 15.937 5.188 4.84 0 9.64-1.305 13.95-3.883l127.468-76.184 127.422 76.184c9.324 5.61 21.078 5.097 29.91-1.305a27.223 27.223 0 0 0 10.582-28.094l-32.937-145.09 111.699-97.94a27.224 27.224 0 0 0 7.98-28.927zm0 0"
                                                        opacity="1" data-original="#ffc107" class=""></path>
                                                </g>
                                            </svg></label>
                                        <input type="radio" class="hidden" name="review" id="review{{ $i }}"
                                            value="{{ $i }}">
                                    @endfor
                                    @error('review')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    @error('user_id')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    <input type="hidden" required class="hidden" name="user_id" id=""
                                        value="{{ auth()->user()->id }}">
                                    <input type="hidden" required class="hidden" name="product_id" id=""
                                        value="{{ $product->id }}">
                                </div>
                                <button type="submit"
                                    class="uppercase flex items-center bg-yellow-700  transition-all px-12 hover:bg-yellow-600  py-3 font-medium ">
                                    Submit</button>
                            </form>

                            <div class="all_reviews ">
                                @forelse ($product->reviews as $review)
                                    <div class="review flex  gap-x-3 mb-5">
                                        <div class="imgUser_review h-[50px] w-[50px]">
                                            @if ($review->user->image)
                                                <img class="block w-full h-full object-cover object-center rounded-full"
                                                    src="{{ asset('assets/images/' . $review->user->image) }}"
                                                    alt="">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50"
                                                    x="0" y="0" viewBox="0 0 512 512"
                                                    style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                    class="block w-full h-full object-cover object-center rounded-full">
                                                    <g>
                                                        <path fill="#ffc839"
                                                            d="M42.452 387.149h427.097c20.018-35.502 31.454-76.489 31.454-120.151 0-135.311-109.691-245.002-245.002-245.002S10.999 131.687 10.999 266.998c-.001 43.663 11.434 84.649 31.453 120.151z"
                                                            opacity="1" data-original="#ffc839"></path>
                                                        <path fill="#ffaa7b"
                                                            d="M234.79 344.818s14.849 6.514 21.21 15.858c6.361-9.344 21.21-15.858 21.21-15.858l59.79-30.41a218.846 218.846 0 0 0-15.332-4.136c-10.152-10.152-12.726-29.399-13.189-42.865-5.298 6.171-10.858 11.333-16.171 15.458-10.352 8.039-23.126 12.405-36.282 12.405s-25.93-4.366-36.281-12.405c-5.313-4.126-10.873-9.288-16.172-15.458-.463 13.466-3.037 32.713-13.189 42.865a218.547 218.547 0 0 0-15.365 4.146z"
                                                            opacity="1" data-original="#ffaa7b"></path>
                                                        <path fill="#fc9460"
                                                            d="M253.542 295.217c-12.273-.513-24.099-4.821-33.797-12.352-5.313-4.126-10.874-9.288-16.172-15.459-.403 11.713-2.409 27.794-9.604 38.465 10.233 20.654 23.492 37.935 36.902 28.896 16.537-11.147 21.442-27.715 22.671-39.55z"
                                                            opacity="1" data-original="#fc9460"></path>
                                                        <path fill="#7e6dd1"
                                                            d="m236.893 341.648-26.528-13.493c-11.288 3.433-26.702 12.396-27.246 35.792-7.623 1.32-46.006 9.763-46.006 45.624v71.682C172.32 500.836 212.853 512 256 512c.856 0 1.706-.024 2.56-.032V363.315c0-12.167-21.667-21.667-21.667-21.667z"
                                                            opacity="1" data-original="#7e6dd1"></path>
                                                        <path fill="#7255ce"
                                                            d="M138.612 482.076v-72.505c0-38.743 45.991-44.338 45.991-44.338 0-24.597 16.517-33.147 27.644-36.12l-31.972-16.262c-68.457 22.323-101.153 31.25-118.201 43.419 17.748 12.113 45.66 37.275 45.66 75.772v30.005a245.308 245.308 0 0 0 30.878 20.029z"
                                                            opacity="1" data-original="#7255ce"></path>
                                                        <path fill="#9589e8"
                                                            d="m331.725 312.851-56.618 28.797s-21.667 9.5-21.667 21.667v148.653c.854.009 1.704.032 2.56.032 11.492 0 22.796-.804 33.867-2.335l-.007-.005 69.782-20.617v.002a244.933 244.933 0 0 0 44.623-26.999v-30.004c0-38.497 27.913-63.658 45.66-75.772-17.047-12.169-49.742-21.096-118.2-43.419z"
                                                            opacity="1" data-original="#9589e8"></path>
                                                        <path fill="#b5b0f7"
                                                            d="M314.218 287.125a1.943 1.943 0 0 0-2.844 1.317c-1.711 8.38-9.135 34.779-36.704 50.447-2.715 1.543-3.365 5.165-1.312 7.518l27.858 31.907c5.784 6.662 16.433 5.463 20.608-2.309 7.058-13.14 16.891-33.14 24.169-54.642 1.303-3.85.377-8.107-2.37-11.103a115.819 115.819 0 0 0-29.405-23.135z"
                                                            opacity="1" data-original="#b5b0f7"></path>
                                                        <path fill="#9589e8"
                                                            d="M237.346 338.89c-6.633-3.77-12.09-8.164-16.592-12.775-6.708.569-35.884 4.873-37.554 36.284a423.117 423.117 0 0 0 6.992 13.608c4.175 7.772 14.824 8.971 20.608 2.309l27.857-31.907c2.054-2.354 1.403-5.977-1.311-7.519z"
                                                            opacity="1" data-original="#9589e8"></path>
                                                        <path fill="#7e6dd1"
                                                            d="M200.642 288.443a1.943 1.943 0 0 0-2.844-1.317 115.819 115.819 0 0 0-29.405 23.135c-2.746 2.996-3.673 7.253-2.37 11.103 5.502 16.255 12.462 31.645 18.581 43.868.001-37.08 37.554-37.706 37.554-37.706l.001-.003c-15.319-14.867-20.176-32.51-21.517-39.08z"
                                                            opacity="1" data-original="#7e6dd1"></path>
                                                        <path fill="#b5b0f7"
                                                            d="M402.265 463.562a246.198 246.198 0 0 0 67.283-76.413c-1.886-5.61-3.928-10.758-6.145-15.279-3.194-6.514-7.627-11.622-14.464-16.29-17.677 11.836-46.674 37.229-46.674 76.461z"
                                                            opacity="1" data-original="#b5b0f7"></path>
                                                        <path fill="#7e6dd1"
                                                            d="M63.06 355.58c-6.837 4.669-11.271 9.776-14.464 16.29-2.216 4.521-4.258 9.669-6.145 15.279a246.187 246.187 0 0 0 67.283 76.413v-31.521c.001-39.232-28.997-64.625-46.674-76.461z"
                                                            opacity="1" data-original="#7e6dd1"></path>
                                                        <path fill="#b5b0f7"
                                                            d="M347.642 420.625h-46.5c-6.6 0-12 5.4-12 12v73c0 1.416.261 2.771.718 4.035a243.237 243.237 0 0 0 69.782-20.617v-56.418c0-6.6-5.4-12-12-12z"
                                                            opacity="1" data-original="#b5b0f7"></path>
                                                        <path fill="#ffdd40"
                                                            d="M423.487 88.206c-23.26 17.194-52.201 46.18-39.932 82.497 19 56.244-67 91.713 29 132.478 38.384 16.3 60.687 33.306 73.645 47.851 9.572-26.211 14.803-54.51 14.803-84.034-.001-70.531-29.816-134.09-77.516-178.792zM88.513 88.206c23.26 17.194 52.201 46.18 39.932 82.497-19 56.244 67 91.713-29 132.478-38.384 16.3-60.688 33.306-73.645 47.851-9.572-26.211-14.803-54.51-14.803-84.034.001-70.531 29.816-134.09 77.516-178.792z"
                                                            opacity="1" data-original="#ffdd40" class=""></path>
                                                        <path fill="#56415e"
                                                            d="M164.872 157.476h183.271c.325-13.205 2.527-48.157 16.328-73.055a13.743 13.743 0 0 0 .926-11.304c-5.008-13.962-19.966-46.602-52.588-55.308-1.738-.464-2.197-2.712-.783-3.823l4.889-3.841c2.216-1.742 1.365-5.28-1.403-5.813-24.069-4.642-104.004-15.75-128.834 35.307-1.482 3.047-4.275 5.241-7.555 6.09-7.225 1.87-20.22 7.506-28.69 24.395a13.82 13.82 0 0 0-.752 10.633c4.116 12.131 14.145 44.705 15.191 76.719z"
                                                            opacity="1" data-original="#56415e"></path>
                                                        <path fill="#45304c"
                                                            d="M246.877 76.772C217.605 32.163 268.807.018 268.807.018c-31.052.402-66.923 8.354-82.129 39.621-1.482 3.047-4.275 5.241-7.555 6.09-7.225 1.87-20.22 7.506-28.69 24.395a13.82 13.82 0 0 0-.752 10.633c4.116 12.131 14.145 44.705 15.191 76.719h42.66c27-21.871 56.739-54.196 39.345-80.704z"
                                                            opacity="1" data-original="#45304c"></path>
                                                        <path fill="#ffaa7b"
                                                            d="M355.257 152.135c-4.103-3.76-13.276-1.854-16.81.448.774 4.821.818 9.753.149 14.623l-4.17 30.372c0 2.448-.077 4.85-.219 7.21 10.169 3.067 16.22-6.062 17.071-12.327a46.57 46.57 0 0 1 1.796-7.949c2.705-8.446 12.463-22.956 2.183-32.377z"
                                                            opacity="1" data-original="#ffaa7b"></path>
                                                        <path fill="#fc9460"
                                                            d="M156.744 152.135c4.103-3.76 13.276-1.854 16.81.448a49.656 49.656 0 0 0-.149 14.623l4.17 30.372c0 2.448.077 4.85.219 7.21-10.169 3.067-16.22-6.062-17.071-12.327a46.57 46.57 0 0 0-1.796-7.949c-2.705-8.446-12.463-22.956-2.183-32.377z"
                                                            opacity="1" data-original="#fc9460"></path>
                                                        <path fill="#ffc7ab"
                                                            d="M336.937 143.2c-.939-2.449-2.122-4.929-3.613-7.268-2.525-3.962-3.636-8.648-3.297-13.32.973-13.438.451-39.721-17.19-47.659-14.987-6.744-33.372-2.839-45.096 1.059a37.227 37.227 0 0 1-22.632.263c-13.358 10.252-13.672 33.335-12.769 45.626a21.905 21.905 0 0 1-3.35 13.381c-1.463 2.296-2.634 4.726-3.57 7.131-3.037 7.802-3.923 16.264-2.785 24.55l4.226 30.781c0 44.252 23.622 74.33 43.715 89.934 2.966 2.303 6.139 4.284 9.452 5.975a58.855 58.855 0 0 0 12.253-7.316c19.831-15.399 43.144-45.085 43.144-88.759l4.17-30.372c1.113-8.097.27-16.366-2.658-24.006z"
                                                            opacity="1" data-original="#ffc7ab"></path>
                                                        <path fill="#ffaa7b"
                                                            d="M270.719 286.337c-19.831-15.399-43.144-45.085-43.144-88.759l-4.171-30.379c-1.123-8.177-.249-16.529 2.748-24.229.924-2.374 2.079-4.772 3.524-7.038a21.62 21.62 0 0 0 3.307-13.206c-.92-12.516-.562-36.369 13.894-45.955a36.802 36.802 0 0 1-2.617-.76c-11.725-3.898-30.109-7.803-45.096-1.059-17.692 7.96-18.166 34.371-17.181 47.774a21.613 21.613 0 0 1-3.307 13.206c-1.444 2.266-2.6 4.664-3.524 7.038-2.997 7.7-3.871 16.052-2.748 24.229l4.171 30.379c0 43.674 23.314 73.359 43.144 88.759 10.351 8.038 23.125 12.404 36.281 12.404a59.288 59.288 0 0 0 25.5-5.767 58.867 58.867 0 0 1-10.781-6.637z"
                                                            opacity="1" data-original="#ffaa7b"></path>
                                                    </g>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="userReveew_detail">
                                            <h3 class="text-xl capitalize">{{ $review->user->name }}</h3>
                                            <div class="flex my-1">
                                                {{-- happy --}}
                                                @for ($i = 1; $i <= $review->review; $i++)
                                                    <label for="review{{ $i }}" class="cursor-pointer  ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20"
                                                            height="20" x="0" y="0" viewBox="0 0 511.987 511"
                                                            style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                            class="">
                                                            <g>
                                                                <path fill="#ffc107"
                                                                    d="M510.652 185.902a27.158 27.158 0 0 0-23.425-18.71l-147.774-13.419-58.433-136.77C276.71 6.98 266.898.494 255.996.494s-20.715 6.487-25.023 16.534l-58.434 136.746-147.797 13.418A27.208 27.208 0 0 0 1.34 185.902c-3.371 10.368-.258 21.739 7.957 28.907l111.7 97.96-32.938 145.09c-2.41 10.668 1.73 21.696 10.582 28.094 4.757 3.438 10.324 5.188 15.937 5.188 4.84 0 9.64-1.305 13.95-3.883l127.468-76.184 127.422 76.184c9.324 5.61 21.078 5.097 29.91-1.305a27.223 27.223 0 0 0 10.582-28.094l-32.937-145.09 111.699-97.94a27.224 27.224 0 0 0 7.98-28.927zm0 0"
                                                                    opacity="1" data-original="#ffc107" class="">
                                                                </path>
                                                            </g>
                                                        </svg></label>
                                                @endfor
                                                <?php
                                                $notHappyReview = 5 - $review->review;
                                                ?>
                                                @for ($i = 0; $i < $notHappyReview; $i++)
                                                    {{-- not happy --}}
                                                    <label for="review{{ $i }}" class="cursor-pointer  ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20"
                                                            height="20" x="0" y="0" viewBox="0 0 511.987 511"
                                                            style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                            class="">
                                                            <g>
                                                                <path fill="#ffffff"
                                                                    d="M510.652 185.902a27.158 27.158 0 0 0-23.425-18.71l-147.774-13.419-58.433-136.77C276.71 6.98 266.898.494 255.996.494s-20.715 6.487-25.023 16.534l-58.434 136.746-147.797 13.418A27.208 27.208 0 0 0 1.34 185.902c-3.371 10.368-.258 21.739 7.957 28.907l111.7 97.96-32.938 145.09c-2.41 10.668 1.73 21.696 10.582 28.094 4.757 3.438 10.324 5.188 15.937 5.188 4.84 0 9.64-1.305 13.95-3.883l127.468-76.184 127.422 76.184c9.324 5.61 21.078 5.097 29.91-1.305a27.223 27.223 0 0 0 10.582-28.094l-32.937-145.09 111.699-97.94a27.224 27.224 0 0 0 7.98-28.927zm0 0"
                                                                    opacity="1" data-original="#ffc107" class="">
                                                                </path>
                                                            </g>
                                                        </svg></label>
                                                @endfor

                                            </div>
                                            <p class="text-lg">
                                                {{ $review->message }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="review_empty">
                                        {{ 'No Review Found..' }}
                                    </div>
                                @endforelse

                            </div>

                        </div>
                    </div>
                @endauth

            </div>




        </div>

    </section>


    <section class="related_sec2 sec_two pt-12  md:pb-[100px]">
        <div class="container mx-auto">
            <h2 class="primary_font text-7xl text-yellow-600 mb-5">Similar Products
            </h2>

            <ul class="related_product_wrapper flex flex-wrap gap-y-12 gap-x-[2%]">
                @forelse ($products as $product_data)
                    @if ($product->category == $product_data->category)
                        <li class="w-[23%] related_product">
                            <div class="w-full relative hover_menu_parent">
                                <div class="absolute z-50 top-[10px] left-[10px] ">
                                    <button type="buttton"
                                        class="px-3 py-0 cursor-text  text-lg rounded-lg text-white bg-[#2A2A2A]">
                                        <?php
                                        $discount = $product_data->rprice - $product_data->price;
                                        $discount_percent = ($discount / $product_data->rprice) * 100;
                                        echo '-' . intval($discount_percent) . '%';
                                        ?>
                                    </button>
                                </div>
                                <div class="product_detail w-full">
                                    <div class="product_img  flex justify-">
                                        <a class="w-full h-full block  transition-all   overflow-hidden"
                                            @role('admin')
                                            href="{{ route('products.show', $product_data->id) }}"
                                            @else
                                            href="{{ route('product.show', $product_data->id) }}"
                                            @endrole>
                                            <img class="transition-all w-full object-contain object-center block"
                                                src="{{ asset('assets/images/' . $product_data->image) }}"
                                                alt="Product Image">
                                        </a>
                                    </div>
                                    <h2 class="mt-2 mb-1 primary_font text-2xl font-medium">{{ $product_data->name }}</h2>
                                    <h3><span class="text-lg"><del>₹{{ $product_data->rprice }}.00</del></span> <strong
                                            class="text-xl">₹{{ $product_data->price }}.00</strong></h3>
                                </div>
                            </div>

                        </li>
                    @endif
                @empty
                    <li class="w-full border-white  border-[1px] mb-5">
                        <div class="empty_detail text-center py-5">
                            <h3 class="font-bold text-xl text-yellow-500">No Data Found !!! </h3>
                        </div>
                    </li>
                @endforelse
            </ul>

        </div>
    </section>


    <script>
        $(function() {
            "@auth"
            $(".review_form form").submit(function() {
                $(this).find("input[name=user_id]").attr("value", "{{ auth()->user()->id }}");
            });
            "@endauth"


            // review star Start

            $(".review_star1").click(function() {
                $(this).find("path").attr("fill", "#ffc107");
                $(".review_star2,  .review_star3, .review_star4, .review_star5").find("path").attr("fill",
                    "#ffffff");
            });
            $(".review_star2").click(function() {
                $(".review_star1, .review_star2").find("path").attr("fill", "#ffc107");
                $(".review_star3, .review_star4, .review_star5").find("path").attr("fill",
                    "#ffffff");
            });
            $(".review_star3").click(function() {
                $(".review_star1, .review_star2, .review_star3").find("path").attr("fill",
                    "#ffc107");
                $(".review_star4, .review_star5").find("path").attr("fill", "#ffffff");
            });
            $(".review_star4").click(function() {
                $(".review_star1, .review_star2, .review_star3, .review_star4").find("path").attr("fill",
                    "#ffc107");
                $(".review_star5").find("path").attr("fill", "#ffffff");
            });
            $(".review_star5").click(function() {
                $(".review_star1, .review_star2, .review_star3, .review_star4, .review_star5").find("path")
                    .attr("fill", "#ffc107");
            });
            // review star End






            $(".zoom_main_img,.related_images .related_img").click(function() {
                var src = $(this).parents(".img_view_parent").find(
                        ".img_view_product")
                    .attr("src");
                var src2 = $(this).parents(".r_image").find(
                        ".related_img img")
                    .attr("src");
                $(".image_preview").find("img").attr("src", src);
                $(".image_preview").find("img").attr("src", src2);
                $(".image_preview").fadeIn();
            });
            $(".close_btn").click(function() {
                $(".image_preview").fadeOut();
                $(".image_preview").find("img").attr("src", "");
            });

            // tabs Start
            $(".product_description_and_review h3.first_h3").click(function() {
                $(this).find(".plus_tab").toggleClass("hidden");
                $(this).find(".minus_tab").toggleClass("hidden");
                $(this).parents(".review_product,.description_product").find(
                        "p.description_text,.review_form")
                    .fadeToggle(200);
            });

            // tabs End


            $(document).on("click", "#addToCart", function() {
                $(this).attr("disabled", "true");
                $(this).find("svg").removeClass("hidden");
                var this_btn = $(this);
                var q_value = $(".quantity_cart").val();
                if (q_value > 0) {
                    if ("{{ auth()->check() }}") {

                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                            },
                            method: "POST",
                            url: "{{ route('carts.store') }}",
                            data: {
                                p_id: "{{ $product->id }}",
                                subtotal: "{{ $product->price }}",
                                q_id: q_value,
                            },
                            success: function(response) {
                                if (response.status) {
                                    $("#cart_qty").text(response.qty);
                                    $(this_btn).removeAttr("disabled");
                                    $(this_btn).find("svg").addClass("hidden");
                                    $(".status_redirect").html(response.status +
                                            ' <a href="{{ route('carts.index') }}" class="text-blue-500 font-normal underline"> Check Now..</a>'
                                        ).fadeIn().delay(5000)
                                        .fadeOut();
                                }
                                if (response.update) {
                                    $(this_btn).removeAttr("disabled");
                                    $(this_btn).find("svg").addClass("hidden");
                                    $(".status_redirect").html(response.update +
                                            ' <a href="{{ route('carts.index') }}" class="text-blue-500  font-normal underline"> Check Now..</a>'
                                        ).fadeIn().delay(5000)
                                        .fadeOut();
                                } else {
                                    $(".error_redirect").text(response.error).fadeIn().delay(
                                            5000)
                                        .fadeOut();
                                }
                            },
                        });
                    }

                } else {
                    alert("The number entered must be greater than 0...");
                }
            });




            $(document).on("click", ".plus", function() {
                var qty_val = $(this).parents(".quantity").find(".minus_qty").removeAttr(
                    "disabled");
                var qty_val = $(this).parents(".quantity").find(".quantity_cart").val();
                var ogQtyVal = ++qty_val;
                if (ogQtyVal > 0) {
                    $(this).parents(".quantity").find(".quantity_cart").val(ogQtyVal).attr(
                        "value", ogQtyVal);
                } else {
                    $(this).parents(".quantity").find(".quantity_cart").val(1).attr("value",
                        1);
                }
            });
            $(document).on("change", ".quantity_cart", function() {
                var ogQtyVal = $(this).val();
                var cart_id = $(this).parents(".quantity_cart_table").find(".plus_qty").attr("data-id");

                if (ogQtyVal > 0) {
                    $(this).val(ogQtyVal).attr("value", ogQtyVal);
                } else {
                    alert("The number entered must be greater than 0...");
                }
            });
            $(document).on("click", ".minus", function() {
                var qty_val = $(this).parents(".quantity").find(".minus_qty").removeAttr(
                    "disabled");
                var qty_val = $(this).parents(".quantity").find(".quantity_cart").val();
                var ogQtyVal = --qty_val;
                if (ogQtyVal > 0) {
                    $(this).parents(".quantity").find(".quantity_cart").val(ogQtyVal).attr(
                        "value", ogQtyVal);
                } else {
                    $(this).parents(".quantity").find(".quantity_cart").val(1).attr("value",
                        1);
                }
            });
            if ("{{ auth()->check() }}") {
                $(document).on("click", "#productBuyNow", function() {
                    var qty_main_val = $(".quantity_cart").val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                        },
                        method: "get",
                        url: "{{ route('product.checkout', $product->id) }}",
                        data: {
                            qty: qty_main_val,
                            data: "session",
                        },
                        success: function(response) {
                            window.location.href =
                                "{{ route('product.checkout', $product->id) }}";
                        }
                    });
                });
            }
        });
    </script>
@endsection
