@extends('layouts.app')
@section('content')
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/r-2.5.0/datatables.min.css" rel="stylesheet">

    <div class="all_section_parent dark_image_bg">
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
                    <h1 class="md:text-5xl text-yellow-500 font-medium">All Products</h1>

                    <a class="inline-block transition hover:bg-yellow-400 px-8 bg-yellow-500 py-2 text-lg"
                        href="{{ route('products.create') }}">Create</a>
                </div>


                <table id="product_table" class="product_table  text-white">
                    <thead>
                        <tr>
                            <th class="font-bold">ID</th>
                            <th class="font-bold">Category </th>
                            <th class="font-bold">Name</th>
                            <th class="font-bold">Image</th>
                            <th class="font-bold">Description</th>
                            <th class="font-bold">Short Description</th>
                            <th class="font-bold">RPrice</th>
                            <th class="font-bold">₹Price</th>
                            <th class="font-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </section>
    </div>


    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/r-2.5.0/datatables.min.js"></script>



    <script>
        jQuery(document).ready(function($) {
            var productTable = $("#product_table").dataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ route('products.index') }}",
                },
                order: [
                    [0, "desc"],
                ],
                columns: [{
                    data: "id",
                    name: "id",
                }, {
                    data: "category_id",
                    name: "category_id",
                }, {
                    data: "name",
                    name: "name",
                }, {
                    data: "image",
                    name: "image",
                }, {
                    data: "description",
                    name: "description",
                }, {
                    data: "short_description",
                    data: "short_description",
                }, {
                    data: "rprice",
                    name: "rprice",
                }, {
                    data: "price",
                    name: "price",
                }, {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }, ],
            });
            $(document).on("click", ".delete_product", function(e) {
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
                            if (response.status) {
                                $('#product_table').DataTable().ajax.reload();
                                $(".status_redirect").text(response.status).fadeIn().delay(3000)
                                    .fadeOut();
                            } else {
                                $(".error_redirect").text(response.error).fadeIn().delay(3000)
                                    .fadeOut();
                            }
                        },
                    });

                }
            });
        });
    </script>
@endsection
