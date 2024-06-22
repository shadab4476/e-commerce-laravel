@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <section class="first_sec">
        <p style="display: none" class="absolute status_redirect w-full text-xl text-center text-green-400 font-bold">
        </p>
        <p style="display: none" class="error_redirect absolute w-full text-xl text-center text-red-400 font-bold">
        </p>
        <div class="container mx-auto">

            <div class="main_checkout my-3 flex justify-between">
                <div class="w-[65%]">
                    @if ($address)
                        <div class="address shadow-sm p-3 shadow-white">
                            <h3 class="text-lg text-yellow-400">Delivery Address</h3>
                            <div class="address_detail flex justify-between items-center">
                                <p class="flex gap-x-1 capitalize"><span
                                        class="font-bold">{{ $address->name }}</span><span>{{ $address->address }},</span><span>{{ $address->city }},</span><span>{{ $address->state }}-</span><span
                                        class="font-bold">{{ $address->pincode }},</span><span>{{ $address->address_type }}</span>
                                    <input type="hidden" name="address_confirm" value="{{ $address->id }}">
                                </p>
                                <button type="button"
                                    class="px-3 py-1 change_address_btn hover:bg-yellow-400 bg-yellow-500 transition-all">Change</button>
                                <a href="{{ route('get.addressDetail') }}" title="Add Address.."
                                    class="px-3 py-1 add_address_btn hover:bg-yellow-400 inline-block bg-yellow-500 transition-all">Add</a>
                            </div>
                            <div class="hidden allAdresses">
                                @foreach ($addresses as $key => $a)
                                    <div class="add_address_checkbox flex gap-x-5">
                                        <input type="radio" id="addAdressCheckbox{{ $key }}"
                                            value="{{ $a->id }}" name="address_id">
                                        <label for="addAdressCheckbox{{ $key }}">
                                            <p class="flex gap-x-1 capitalize"><span
                                                    class="font-bold">{{ $a->name }}</span><span>{{ $a->address }},</span><span>{{ $a->city }},</span><span>{{ $a->state }}-</span><span
                                                    class="font-bold">{{ $a->pincode }},</span><span>{{ $a->address_type }}</span>
                                            </p>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @else
                        @include('dashboard.profile.addressAdd')
                    @endif

                    <div class="my-5">
                        <div class="pro_details flex items-start justify-start gap-x-5">
                            <div class="w-[100px] h-[100px] pro_buy_img">
                                <img class="w-full h-full block object-cover object-center"
                                    src="{{ asset('assets/images/' . $product->image) }}" alt="image">
                            </div>
                            <div class="details">
                                <h2 class="w-full">
                                    {{ $product->name }}
                                </h2>
                                <h3>
                                    Seller: Shadab
                                </h3>
                                <h2>
                                    <del> ₹{{ $product->rprice }}</del> ₹{{ $product->price }}
                                    You have save <span>
                                        <?php
                                        $discount = $product->rprice - $product->price;
                                        $discount_percent = ($discount / $product->rprice) * 100;
                                        echo '-' . intval($discount_percent) . '%';
                                        ?>
                                    </span>
                                </h2>
                            </div>

                        </div>
                        <div class="c_order_next_btnparent flex justify-between items-center">
                            <p>Order Comfirmation Email Sent To <i>"{{ auth()->user()->email }}"</i></p>

                        </div>
                    </div>
                </div>
                <div class="w-[30%] checkout_cnf bg-red-500 p-5">
                    <h3 class="secondary_font  text-xl ">PRICE DETAIL</h3>
                    <div class="py-4 border-t border-white  border-b flex flex-col gap-y-2">
                        <h4 class="text-lg font-medium flex justify-between items-center">Quantity
                            <span>{{ session()->get('cnf_price') }} </span>
                            <h4 class="text-lg font-medium flex justify-between items-center">Price
                                <span>₹{{ $product->rprice * session()->get('cnf_price') }}</span>
                            </h4>
                            <h4 class="text-lg font-medium flex justify-between items-center">
                                Delivery Charges

                                <span>Free</span>
                            </h4>
                            <h4 class="	 text-lg font-medium flex justify-between items-center">

                                Discount
                                <span>
                                    <?php
                                    $product->rprice = $product->rprice * session()->get('cnf_price');
                                    $product->price = $product->price * session()->get('cnf_price');
                                    $discount = $product->rprice - $product->price;
                                    $discount_percent = ($discount / $product->rprice) * 100;
                                    echo '-' . intval($discount_percent) . '%';
                                    ?>
                                </span>
                            </h4>
                    </div>
                    <h4 class="text-2xl  font-medium flex justify-between items-center">Total Payable
                        <span>₹{{ $product->price }}</span>
                    </h4>
                    <strong class="text-green-800 inline-block pt-4 w-full text-center text-lg">You will save
                        ₹{{ $product->rprice - $product->price }} on this order.
                    </strong>
                    <div class="mt-5">
                        <div class="flex justify-between items-center">
                            <label for="cod">COD (Cash On Delivery)</label>
                            <input type="radio" name="delivery_pay_mode" checked
                                class="w-[15px] h-[15px] cod_delivery accent-red-600" value="COD" id="cod">
                        </div>
                        <div class="flex justify-between items-center">
                            <label for="upi">UPI</label>
                            <input type="radio" name="delivery_pay_mode" value="UPI"
                                class="w-[15px] h-[15px] accent-red-600 bg-yellow-300 upi_delivery" id="upi">
                        </div>
                    </div>

                    <div class="submit_data mt-2">
                        <button type="button"
                            class="w-full inline-block continue_pay_btn text-xl text-center py-3 hover:bg-yellow-600 transiton-all bg-yellow-500">
                            Continue
                        </button>
                    </div>

                </div>


            </div>
        </div>



    </section>
    <script>
        $(document).ready(function() {

            // add address btn
            $(".add_address_btn").click(function() {
                $(this).parents(".profile_edit_parent").find(".add_address_form").toggleClass("hidden");
                if ($(".add_address_form").hasClass("hidden")) {
                    $(this).text("Add+");
                } else {
                    $(this).text("Close-");
                }

            });

            $("button.change_address_btn").click(function() {
                $(".allAdresses").toggleClass("hidden");
            });
            // address change ajax
            $(document).on("change", ".add_address_checkbox input[name=address_id]", function() {

                $this_val = $(this).val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    },
                    type: "post",
                    url: "{{ route('address.change') }}",
                    data: {
                        id: $this_val,
                    },
                    success: function(response) {
                        if (response.error) {
                            $(".error_redirect").text(response.error).fadeIn().dealy(3000)
                                .fadeOut();
                        } else {
                            $("input[type=hidden]input[name=address_confirm]").attr("value",
                                response.address.id).val(response.address.id);
                            $(".address_detail span:nth-child(1)").text(response.address.name +
                                ",");
                            $(".address_detail span:nth-child(2)").text(response.address
                                .address +
                                ",");
                            $(".address_detail span:nth-child(3)").text(response.address.city +
                                ",");
                            $(".address_detail span:nth-child(4)").text(response.address.state +
                                "- ");
                            $(".address_detail span:nth-child(5)").text(response.address
                                .pincode +
                                ",");
                            $(".address_detail span:nth-child(6)").text(response.address
                                .address_type);
                        }
                        $(".allAdresses").toggleClass("hidden");
                    }
                });

            });

            // continue ajax on pay orders

            $(document).on("click", "button.continue_pay_btn", function() {
                if ($("input[name=address_confirm]").attr("value") != "" && $(
                        "input[name=delivery_pay_mode]:checked")
                    .attr("value") !=
                    "") {
                    var delivery_paying_mode = $("input[name=delivery_pay_mode]:checked").val();
                    var address_id = $("input[name=address_confirm]").val();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                        },
                        type: "POST",
                        url: "{{ route('order.confirm') }}",
                        data: {
                            mode: delivery_paying_mode,
                            address_id: address_id,
                            product_id: "{{ $product->id }}",
                        },
                        success: function(response) {
                            if (response.error) {
                                $(".error_redirect").text(response.error).fadeIn().delay(3000)
                                    .fadeOut();
                            } else {
                                window.location.href = "{{ route('thankyou') }}" + "/" +
                                    response
                                    .orderId;
                            }
                        },
                    });
                } else {
                    alert("Field not to be empty..");
                }
            });
        });
    </script>
@endsection
