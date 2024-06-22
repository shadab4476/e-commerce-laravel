@extends('layouts.app')

@section('content')
    @include('layouts.header')

    <section class="mainSectionIndex">


        <div class="container mx-auto">
            <p style="display: none" class="absolute status_redirect w-full text-xl text-center text-green-400 font-bold">
            </p>
            <p style="display: none" class="error_redirect absolute w-full text-xl text-center text-red-400 font-bold">
            </p>
            <div class="flex items-center mt-3 mb-10   justify-between ">
                <h1 class="md:text-5xl text-yellow-500 font-bold"> Shop </h1>

                <a class="inline-block transition hover:bg-yellow-400 px-8 bg-yellow-500 py-2 text-lg"
                    href="{{auth()->check()? route('home'):route('index') }}">Back</a>
            </div>

            <div class="parent_product_wrapper mb-12 md:mb-[150px]">

                <ul class="flex flex-wrap gap-y-12 gap-x-[2%]">

                    @forelse ($products as $product)
                        <li class="w-[23%] relative hover_menu_parent">
                            <div class="absolute z-50 top-[10px] left-[10px] ">
                                <button type="buttton"
                                    class="px-3 py-0 cursor-text  text-lg rounded-lg text-white bg-[#2A2A2A]">
                                    <?php
                                    $discount = $product->rprice - $product->price;
                                    $discount_percent = ($discount / $product->rprice) * 100;
                                    echo '-' . intval($discount_percent) . '%';
                                    ?>
                                </button>
                            </div>
                            @if (auth()->check())
                                <div title="Add To Cart.."
                                    class="absolute z-50 hover_submenu w-[40px] rounded-full h-[40px] top-[10px] right-[10px] ">
                                    <button data-id="{{ $product->id }}" data-price="{{ $product->price }}"
                                        class="w-full flex justify-center items-center h-full block addTOCart">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 152 152"
                                            style="enable-background:new 0 0 512 512" xml:space="preserve"
                                            class="w-full h-full cartSvg">
                                            <g>
                                                <g data-name="Layer 2">
                                                    <g data-name="06.add_to_cart">
                                                        <circle cx="76" cy="76" r="76" fill="#2A2A2A"
                                                            opacity="1" data-original="#10adff" class=""></circle>
                                                        <g fill="#fff">
                                                            <path
                                                                d="M108.16 65.23a4 4 0 0 0-3.16-1.52 4.3 4.3 0 0 0-.62 0 4.06 4.06 0 0 0-3.44 3.29q-1 3.25-2 6.51c-1.17 3.78-2.38 7.7-3.54 11.57H64.3c-.65-2.44-1.34-4.9-2-7.29l-1.17-4.21c-1.86-6.79-3.79-13.81-5.67-20.73a4.88 4.88 0 0 0-4-4c-2.69-.42-5.42-.88-8.07-1.33l-5.21-.87a5.82 5.82 0 0 0-.92-.08 4 4 0 0 0-4.2 3.43 4.19 4.19 0 0 0 3.74 4.88l2.8.5c2.43.44 4.94.9 7.46 1.18.73.08.79.09 1.06 1.08 2.27 8.44 4.64 17 6.93 25.29.62 2.23 1.24 4.45 1.85 6.68.72 2.61 2.12 3.72 4.67 3.72h35.91c3.07 0 4.34-.94 5.22-3.87q1.71-5.73 3.45-11.47l1.37-4.57c.13-.44.27-.87.4-1.31.31-1 .63-2 .91-3.08a4.4 4.4 0 0 0-.67-3.8zM65.82 96.45a7.6 7.6 0 1 0 7.53 7.74 7.64 7.64 0 0 0-7.53-7.74zM92.63 96.45a7.6 7.6 0 0 0 0 15.2 7.6 7.6 0 0 0 0-15.2z"
                                                                fill="#ffffff" opacity="1" data-original="#ffffff"
                                                                class=""></path>
                                                            <path
                                                                d="M77.83 71a3.5 3.5 0 0 0 4.92 0L93.9 59.82a3.5 3.5 0 1 0-5-5L83.72 60V43.47a3.52 3.52 0 0 0-7 0v16.74l-5.53-5.38a3.5 3.5 0 1 0-4.88 5z"
                                                                fill="#ffffff" opacity="1" data-original="#ffffff"
                                                                class=""></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <svg aria-hidden="true"
                                            class="w-1/2 h-1/2 loadSvg hidden text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            <div class="product_detail w-full">
                                <div class="product_img  flex justify-">
                                    <a class="w-full h-full block  transition-all   overflow-hidden"
                                        @role('admin')
                                        href="{{ route('products.show', $product->id) }}"
                                        @else
                                        href="{{ route('product.show', $product->id) }}"
                                        @endrole>
                                        <img class="transition-all w-full object-contain object-center block"
                                            src="{{ asset('assets/images/' . $product->image) }}" alt="Product Image">
                                    </a>
                                </div>
                                <h2 class="mt-2 mb-1 primary_font text-2xl font-medium">{{ $product->name }}</h2>
                                <h3><span class="text-lg"><del>₹{{ $product->rprice }}.00</del></span> <strong
                                        class="text-xl">₹{{ $product->price }}.00</strong></h3>
                            </div>
                        </li>

                    @empty
                        <li class="w-full border-white  border-[1px] mb-5">
                            <div class="empty_detail text-center py-5">
                                <h3 class="font-bold text-xl text-yellow-500">No Data Found !!! </h3>
                            </div>
                        </li>
                    @endforelse

                </ul>
                <div class="pagination_links mt-12">
                    {{ $products->links() }}
                </div>

            </div>


        </div>

    </section>
    <script>
        $(function() {
            if ("auth()->check()") {
                $(document).on("click", ".addTOCart", function() {
                    $(this).attr("disabled", "true");
                    $(this).find("svg.cartSvg").addClass("hidden");
                    $(this).find("svg.loadSvg").removeClass("hidden");
                    var this_btn = $(this);
                    var q_value = 1;
                    if (q_value > 0) {
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                            },
                            method: "POST",
                            url: "{{ route('carts.store') }}",
                            data: {
                                p_id: $(this_btn).attr("data-id"),
                                subtotal: $(this_btn).attr("data-price"),
                                q_id: q_value,
                            },
                            success: function(response) {
                                $(this_btn).removeAttr("disabled");
                                $(this_btn).find("svg").toggleClass("hidden");
                                if (response.status) {
                                    $("#cart_qty").text(response.qty);

                                    $(".status_redirect").html(response.status +
                                            ' <a href="{{ route('carts.index') }}" class="text-blue-500 font-normal underline"> Check Now..</a>'
                                        ).fadeIn().delay(5000)
                                        .fadeOut();
                                }
                                if (response.update) {
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
                    } else {
                        alert("The number entered must be greater than 0...");
                    }
                });
            }

        });
    </script>
@endsection
