@extends('layouts.app')
@section('content')
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/r-2.5.0/datatables.min.css" rel="stylesheet">

    <div class="all_section_parent dark_image_bg pb-10">
        @include('layouts.header')
        {{-- error and status Message Start --}}
        <p style="display: none" class="absolute status_redirect w-full text-4xl text-center text-green-400 font-bold">
        </p>
        <p style="display: none" class="error_redirect absolute w-full text-4xl text-center text-red-400 font-bold">
        </p>
        {{-- error and status Message End --}}


        <section class="section_first ">
            <div class="container mx-auto md:px-12">

                <div class="flex items-center my-5  justify-between ">
                    <h1 class="md:text-5xl text-yellow-500 font-medium"> Cart </h1>

                    <a class="inline-block transition hover:bg-yellow-400 px-8 bg-yellow-500 py-2 text-lg"
                        href="{{ route('home') }}">Back</a>
                </div>

                <div class="w-full flex justify-start items-start gap-x-5">
                    <div class="w-[70%]">
                        <table id="cartTable" class="p-5 !w-full ">
                            <thead>
                                <tr>
                                    <th class="font-bold">Image</th>
                                    <th class="font-bold">Name</th>
                                    <th class="font-bold">₹Price</th>
                                    <th class="font-bold">Quantity</th>
                                    <th class="font-bold">Subtotal</th>
                                    <th class="font-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-[30%] cart_price_detail px-8 pb-10 pt-5  rgb-black border-white border-[1px]">
                        <h2 class="text-center text-yellow-500 primary_font my-3 text-4xl font-bold">
                            Cart Total
                        </h2>
                        <table class="w-full">
                            <tbody>
                                <tr class=" border-b-[1px] border-white">
                                    <th class="text-xl py-3">Subtotal</th>
                                    <td class="subtotal_all_items text-xl py-3 text-gray-500">₹{{ $items_price_total }}</td>
                                </tr>
                                <tr class=" border-b-[1px] border-white">
                                    <th class="text-xl py-3">Total</th>
                                    <td class="text-xl total_all_items py-3 text-gray-500">₹{{ $items_price_total }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="my-4">Have a coupon?</h4>

                        <a href="{{ count($cart_id) > 0 ? route('product.cartCheckout') : '#!' }}"
                            onclick="{{ count($cart_id) > 0 ? count($cart_id) : 'return alert("Cart is emptyyyy!!!!")' }}"
                            class="w-full inline-block primary_font text-2xl text-center py-4 bg-yellow-600 transiton hover:bg-yellow-500">
                            PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/r-2.5.0/datatables.min.js"></script>



    <script>
        jQuery(document).ready(function($) {
            var cartTable = $("#cartTable").dataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ route('carts.index') }}",
                },
                order: [
                    [1, "desc"],
                ],
                columns: [{
                    data: "image",
                    name: "image",
                    orderable: false,
                    searchable: false,
                }, {
                    data: "name",
                    name: "name",
                }, {
                    data: "product.price",
                    name: "price",
                    orderable: false,
                    searchable: false,
                }, {
                    data: "quantity",
                    name: "quantity",
                    orderable: false,
                    searchable: false,
                }, {
                    data: "subtotal",
                    name: "subtotal",
                    orderable: false,
                    searchable: false,
                }, {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }, ],
            });
            $(document).on("click", ".delete_cart_product", function(e) {
                e.preventDefault();
                var route_product_delete = $(this).attr("data-product");
                var _this = $(this);
                if (confirm("Are your sure to delete this product..")) {
                    $.ajax({
                        url: route_product_delete,
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                        },
                        method: 'DELETE',
                        success: function(response) {
                            console.log(response.cart_qty);
                            if (response.status || response.cart_qty) {
                                $("#cart_qty").text(response.cart_qty);
                                $('#cartTable').DataTable().ajax.reload();
                                $(".subtotal_all_items").text(response.total);
                                $(".total_all_items").text(response.total);
                                $(".status_redirect").text(response.status).fadeIn().delay(5000)
                                    .fadeOut();

                            } else {
                                $(".error_redirect").text(response.error).fadeIn().delay(5000)
                                    .fadeOut();
                            }
                        },
                    });

                }
            });




            // plus minus and qty fetch Start
            // minus
            $(document).on("click", ".minus_qty", function() {
                $(this).attr("disabled", "true");
                var this_ = $(this);
                var qty_val = $(this).parents(".quantity_cart_table").find(".quantity_cart_item").val();
                var ogQtyVal = --qty_val;
                if (ogQtyVal > 0) {
                    $(this).parents(".quantity_cart_table").find(".quantity_cart_item").val(ogQtyVal).attr(
                        "value", ogQtyVal);
                } else {
                    $(this).attr("disabled", "true");
                    $(this).parents(".quantity_cart_table").find(".quantity_cart_item").val(1).attr("value",
                        1);
                }
                if (ogQtyVal > 0) {
                    var cart_id = $(this).attr("data-id");
                    $.ajax({
                        method: "PUT",
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                        },
                        data: {
                            cart_id: cart_id,
                            qty: ogQtyVal,
                        },
                        url: `{{ route('carts.update', ' $(this).attr("data-id")') }}`,
                        success: function(response) {
                            if (response.error || response.error != undefined) {
                                alert(response.error);
                            } else {
                                $(this_).removeAttr("disabled");
                                $(this_).parents("tr").find(".total_price").text(response
                                    .subprice);
                                $(".subtotal_all_items").text(response.totalPrice);
                                $(".total_all_items").text(response.totalPrice);
                            }
                        },
                    });
                }

            });
            // plus 
            $(document).on("click", ".plus_qty", function() {
                var this_btn = $(this);
                $(this).attr("disabled", "true");
                var qty_val = $(this).parents(".quantity_cart_table").find(".minus_qty").removeAttr(
                    "disabled");
                var qty_val = $(this).parents(".quantity_cart_table").find(".quantity_cart_item").val();
                var ogQtyVal = ++qty_val;
                if (ogQtyVal > 0) {
                    $(this).parents(".quantity_cart_table").find(".quantity_cart_item").val(ogQtyVal).attr(
                        "value", ogQtyVal);
                } else {
                    $(this).parents(".quantity_cart_table").find(".quantity_cart_item").val(1).attr("value",
                        1);
                }

                if (ogQtyVal > 0) {
                    var cart_id = $(this).attr("data-id");
                    $.ajax({
                        method: "PUT",
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                        },
                        data: {
                            cart_id: cart_id,
                            qty: ogQtyVal,
                        },
                        url: `{{ route('carts.update', ' $(this).attr("data-id")') }}`,
                        success: function(response) {
                            if (response.error || response.error != undefined) {
                                alert(response.error);
                            } else {
                                $(this_btn).removeAttr("disabled");
                                $(this_btn).parents("tr").find(".total_price").text(response
                                    .subprice);
                                $(".subtotal_all_items").text(response.totalPrice);
                                $(".total_all_items").text(response.totalPrice);
                            }
                        },
                    });
                }
            });
            // quantity 
            $(document).on("change", ".quantity_cart_item", function() {
                var this_btn = $(this);
                var oldValue = $(this).attr("value");
                var ogQtyVal = $(this).val();
                var cart_id = $(this).parents(".quantity_cart_table").find(".plus_qty").attr("data-id");

                if (ogQtyVal > 0) {
                    $.ajax({
                        method: "PUT",
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                        },
                        data: {
                            cart_id: cart_id,
                            qty: ogQtyVal,
                        },
                        url: `{{ route('carts.update', ' $(this).attr("data-id")') }}`,
                        success: function(response) {
                            if (response.error || response.error != undefined) {
                                alert(response.error);
                            } else {
                                $(this_btn).parents("tr").find(".total_price").text(response
                                    .subprice);
                                $(".subtotal_all_items").text(response.totalPrice);
                                $(".total_all_items").text(response.totalPrice);
                            }
                        },
                    });
                } else {
                    $(this).parents(".quantity_cart_table").find(".quantity_cart_item").val(oldValue).attr(
                        "value",
                        oldValue);
                    alert("The number entered must be greater than 0...");
                }
            });



            // plus minus and qty fetch And




        });
    </script>
@endsection
