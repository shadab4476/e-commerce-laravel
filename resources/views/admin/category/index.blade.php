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
                    <h1 class="md:text-5xl text-yellow-500 font-medium">All Categories</h1>

                    <a class="inline-block transition hover:bg-yellow-400 px-8 bg-yellow-500 py-2 text-lg"
                        href="{{ route('categories.create') }}">Create</a>
                </div>


                <table id="category_table" class="categoryTable  text-white">
                    <thead>
                        <tr>
                            <th class="font-bold">ID</th>
                            <th class="font-bold">Name</th>
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
            var categoryTable = $("#category_table").dataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ route('categories.index') }}",
                },
                columns: [{
                    data: "id",
                    name: "id",
                }, {
                    data: "name",
                    name: "name",
                }, {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }, ],
            });
            $(document).on("click", ".delete_category", function(e) {
                e.preventDefault();
                var route_category_delete = $(this).attr("data-category");
                var _this = $(this);
                if (confirm("Are your sure to delete this category..")) {
                    $.ajax({
                        url: route_category_delete,
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                        },
                        method: 'DELETE',
                        success: function(response) {
                            if (response.status) {
                                $("#category_table").DataTable().ajax.reload();
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
