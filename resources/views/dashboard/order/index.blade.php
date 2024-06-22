@extends('layouts.app')
@section('content')
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/r-2.5.0/datatables.min.css" rel="stylesheet">



    <!-- Modal toggle -->

    <!-- Main modal -->
    <div class="   hidden orderDetails fixed  z-50  w-full  h-full ">
        <div class="absolute p-4 w-4/5  top-1/2  left-1/2 translate-y-[-50%] translate-x-[-50%] ">
            <!-- Modal content -->
            <div class=" bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="address_order text-black">
                        <h4 class="text-black font-medium text-2xl mb-2 flex justify-between">Delivery Address <button
                                class="text-red-500 font-medium text-lg cls_btn_order_detail">Close</button>
                        </h4>
                        <h2 class="text-black  font-bold order_user_name text-lg"></h2>
                        <p class="text-base order_address leading-relaxed text-gray-500 dark:text-gray-400">
                            <span class="text-black"></span><span class="text-black"></span><span
                                class="text-black"></span><span class="text-black"></span><span class="text-black"></span>
                        </p>
                        <h3 class="text-black address_number font-bold">Phone No. +<span
                                class="text-black font-normal"></span></h3>
                    </div>
                    <div
                        class="order_product_detail  flex gap-x-5   border-t border-gray-200 rounded-b dark:border-gray-600 mt-3 text-black">
                        <div class="images_order_product w-[100px]  h-[100px]">
                            <a href="" class="w-full h-full block"><img src="" alt="product image"
                                    class="block object-cover object-center w-full h-full"></a>
                        </div>
                        <div class="text-black o_pro_name text-lg w-2/5"><a href=""
                                class="font-medium block text-black underline w-full"></a>
                            <h4 class="text-black font-normal  order_price" style="font-size: 15px"></h4>
                            <h4 class="text-black font-normal  ">Seller: Shadab</h4>
                        </div>
                        <p class="text-base order_address leading-relaxed text-gray-500 dark:text-gray-400">
                        </p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button class="text-red-500 font-medium cls_btn_order_detail">Close</button>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.header')
    <p style="display: none" class="absolute status_redirect w-full text-xl text-center text-green-400 font-bold">
    </p>
    <p style="display: none" class="error_redirect absolute w-full text-xl text-center text-red-400 font-bold">
    </p>
    <div class="container mx-auto">

        <table id="order_table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Date/Time</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/r-2.5.0/datatables.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            var orderTable = $("#order_table").DataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ route('order.index', auth()->user()->name) }}",
                },
                order: [
                    [0, "desc"],
                ],
                columns: [{
                        name: "id",
                        data: "id",
                    }, {
                        name: "product_name",
                        data: "product_name",
                    },
                    {
                        name: "product_image",
                        data: "product_image",
                    },
                    {
                        name: "product_price",
                        data: "product_price",
                    }, {
                        name: "payment_status",
                        data: "payment_status",
                    }, {
                        name: "data_time",
                        data: "data_time",
                    },
                ],
            });


            $(document).on("click", ".detail_order", function() {
                $order_route = $(this).attr("data-active");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                    },
                    method: "POST",
                    url: $order_route,
                    success: function(response) {
                        if (response.error) {
                            $(".error_redirect").text(response.error).fadeIn().delay(4000)
                                .fadeOut();
                        } else {
                            $(".order_user_name").text(response.status.address.name);
                            $(".address_order p span:nth-child(1)").text(response.status.address
                                .address + ", ");
                            $(".address_order p span:nth-child(2)").text(response.status.address
                                .city + ", ");
                            $(".address_order p span:nth-child(3)").text(response.status.address
                                .state + "- ");
                            $(".address_order p span:nth-child(4)").text(response.status.address
                                .pincode + ", ");
                            $(".address_order p span:nth-child(5)").text(response.status.address
                                .address_type);
                            $(".address_number span").text(response.status.address
                                .phone);
                            $(".images_order_product a").attr("href", response.product_show);
                            $(".images_order_product img").attr("src", "/assets/images/" +
                                response.status.product
                                .image)
                            $(".o_pro_name a").attr("href", response.product_show).text(
                                response.status.product.name);
                            $(".order_price").text("₹" + response.status.product.price);
                            $(".orderDetails").removeClass("hidden");
                        }
                    },
                });
            });
            $(".cls_btn_order_detail").click(function() {
                $(".orderDetails").addClass("hidden");
            });
        });
    </script>
@endsection
