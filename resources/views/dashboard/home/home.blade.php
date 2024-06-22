@extends('layouts.app')

@section('content')
    <div class="all_section_parent dark_image_bg">
        @include('layouts.header')



        {{-- error and status Message Start --}}
        <div class="status_redirect absolute w-full text-4xl text-center text-green-400 font-bold" style="display: none">
        </div>
        <div class="error_redirect  absolute w-full text-4xl text-center text-red-400 font-bold" style="display: none"></div>
        {{-- error and status Message End --}}


        <section class="section_one">

            <div class="container mx-auto">

                <div class="main_parent p-10 pb-12 md:pt-[130px]">
                    <h3 class="secondary_font text-yellow-400 capitalize text-center text-3xl">Hurry,best deal is almost
                        here!
                    </h3>
                    <h1
                        class="mt-5 primary_font font-medium  mb-12 text-center  text-white leading-none uppercase text-[70px] md:text-[120px]">
                        TIME LEFT
                        UNTIL OUR <span class="text-yellow-300"> BIGGEST SALE OF THE YEAR BEGINS </span></h1>
                    <div class="reminder_btn text-center">
                        <a href="{{ auth()->check() ? 'javascript:void(0)' : route('register') }}"
                            class="px-12 inline-block text-white py-3 {{ auth()->check() ? 'setReminder' : '' }} font-bold bg-yellow-500 hover:bg-yellow-400">Set
                            Reminder
                            <svg aria-hidden="true"
                                class="inline hidden w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </a>
                    </div>

                </div>


            </div>
        </section>
    </div>



    <section class="section_two md:mt-12">
        <div class="container mx-auto md:px-12">
            <div class="w-full text-white offer_detail_sec_two flex items-center   justify-between p-5 md:p-20 flex-wrap">
                <div class="md:w-1/2 w-full offer_details_latest">
                    <h3 class="discount_upto text-3xl secondary_font text-yellow-300">
                        Up To 50% Off
                    </h3>
                    <h2 class="primary_font  leading-none mt-5 mb-3 md:text-[100px]  text-[50px] uppercase">grab your
                        FAVORITES
                        BEFORE THEY'RE GONE</h2>
                    <p class="font-normal  text-[18px]">You can trust us to bring you the latest technology at unbeatable
                        prices. Don’t miss this
                        limited-time opportunity to upgrade your audio game. Grab your perfect pair now!
                    </p>

                    <div class=" mt-8">
                        <a
                            href="{{ route('shop.index') }}"class="px-12 inline-block text-lg capitalize text-white py-3 setReminder font-bold bg-yellow-500 hover:bg-yellow-600">shop
                            now</a>
                    </div>
                </div>
                <div class="md:w-1/2 w-full md:p-12 p-5  offer_details_latest_img">
                    <img class="w-full block object-cover" src="{{ asset('/images/eirbudsHome.png') }}" alt="product img">
                </div>
            </div>

        </div>
    </section>

    <section class="section_three md:py-10">

        <div class="flex justify-between items-center product_slider">
        </div>

    </section>



    <script>
        $(document).ready(function() {
            // reminder Start
            $(".setReminder").click(function() {
                var thisBtn = $(this);
                $(this).children("svg").removeClass("hidden");
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    method: "post",
                    url: "{{ route('set.reminder') }}",
                    success: function(success) {
                        $(thisBtn).children("svg").addClass("hidden");
                        if (success.status) {
                            $(".statusMessages").text(success.status).fadeIn().delay(3000)
                                .fadeOut();
                        } else {
                            $(".errroMessages").text(success.error).fadeIn().delay(3000)
                                .fadeOut();
                        }
                    },
                });

            });
            // reminder End


        });
    </script>
@endsection
