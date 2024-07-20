{{-- <!DOCTYPE html> --}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/fevicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/web.css') }}">
    <title>
        {{ $title }}
    </title>

    {{-- jQuery , Tailwind css Start --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('links/tailwind.js') }}"></script>
    <script src="{{ asset('links/jQuery.js') }}"></script>
    {{-- jQuery , Tailwind css End --}}
    {{-- gsap Start --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
        integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"
        integrity="sha512-onMTRKJBKz8M1TnqqDuGBlowlH0ohFzMXYRNebz+yOcc5TQr/zAKsthzhuv0hiyUKEiQEQXEynnXCvNTOk50dg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- gsap End --}}

</head>

<body id="body">


    <main class="bg-black ">
        <div class="w-[10px] fixed cursor_custom h-[10px] rounded-full bg-yellow-500"></div>
        {{-- ALL CONTENT START --}}
        @yield('content')
        {{-- ALL CONTENT END --}}
        @include('layouts.footer')
        <button title="Top"
            class="fixed bottom-[20%] invisible transition-all opacity-0 click_to_top_btn p-[10px] rounded-[5px] flex justify-center items-center bg-yellow-500 hover:bg-yellow-600 right-[2%]"><svg
                xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="20" height="20" x="0" y="0" viewBox="0 0 612.02 612.02"
                style="enable-background:new 0 0 512 512" xml:space="preserve" class="-rotate-90 block">
                <g>
                    <path
                        d="M596.96 269.674 342.381 15.094c-20.079-20.079-52.644-20.079-72.723 0s-20.079 52.644 0 72.723L487.852 306.01 269.658 524.202c-20.079 20.079-20.079 52.644 0 72.723s52.644 20.079 72.723 0L596.96 342.346c20.079-20.029 20.079-52.593 0-72.672zm-306.102-15.416L88.744 41.238c-20.309-21.378-53.204-21.378-73.513 0s-20.309 56.058 0 77.462l165.371 174.289L15.231 467.278c-20.309 21.379-20.309 56.083 0 77.462s53.204 21.379 73.513 0l202.114-213.02c20.309-21.378 20.309-56.058 0-77.462z"
                        fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                </g>
            </svg></button>
    </main>

    <script>
        // cart data fetch Start
        if ("{{ auth()->check() }}") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content")
                },
                type: "POST",
                url: "{{ route('cart.qty') }}",
                success: function(response) {
                    $("#cart_qty").text(response.status).removeClass("hidden");
                },
            });
        }
        // cart data fetch End

        // order data fetch Start
        if ("{{ auth()->check() }}") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content")
                },
                type: "POST",
                url: "{{ route('order.qty') }}",
                success: function(response) {
                    $("#order_qty").text(response.status).removeClass("hidden");
                },
            });
        }
        // order data fetch End

        if ("{{ session()->has('status') }}") {
            $(".status_redirect").text("{{ session()->get('status') }}").fadeIn().delay(5000)
                .fadeOut();
        }
        if ("{{ session()->has('error') }}") {
            $(".error_redirect").text("{{ session()->get('error') }}").fadeIn().delay(5000)
                .fadeOut();
        }


        const button = document.querySelector('.click_to_top_btn');

        // const 
        function displayButton() {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    button.style.visibility = "visible";
                    button.style.opacity = "1";
                } else {
                    button.style.visibility = "hidden";
                    button.style.opacity = "0";
                }
            });
        };

        function scrollToTop() {
            button.addEventListener("click", () => {
                window.scroll({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            });
        };
// status check 
        function activeUsers() {
            if ("{{ auth()->check() }}") {
                $(".activeUserOnHover").on("mouseenter", function() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content")
                        },
                        url: "{{ route('active.users') }}",
                        type: "post",
                        success: function(res) {
                            $(".activeUserOnHover .activeUserOnHoverChild li a").text(res.users);
                        }
                    });
                })
            }
        }
        activeUsers();
        displayButton();
        scrollToTop();
    </script>
    {{-- custom Js Link Start --}}
    <script src="{{ asset('/js/script.js') }}"></script>
    {{-- custom Js Link End --}}
</body>

</html>
