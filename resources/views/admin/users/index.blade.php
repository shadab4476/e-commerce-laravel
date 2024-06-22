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
                    <h1 class="md:text-5xl text-yellow-500 font-medium">All Users</h1>

                    <a class="inline-block transition hover:bg-yellow-400 px-8 bg-yellow-500 py-2 text-lg"
                        href="{{ route('users.create') }}">Create</a>
                </div>


                <table id="users_table" class="userTable  text-white">
                    <thead>
                        <tr>
                            <th class="font-bold">ID</th>
                            <th class="font-bold">Image</th>
                            <th class="font-bold">Name</th>
                            <th class="font-bold">Email</th>
                            <th class="font-bold">Phone</th>
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
            var usersTable = $("#users_table").dataTable({
                processing: true,
                serverside: true,
                ajax: {
                    url: "{{ route('users.index') }}",
                },
                columns: [{
                        data: "id",
                        name: "id",
                    },
                    {
                        data: "image",
                        name: "image",
                        orderable:false,
                        searchable:false,
                    }, {
                        data: "name",
                        name: "name",
                    }, {
                        data: "email",
                        name: "email",
                    }, {
                        data: "phone",
                        name: "phone",
                    }, {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    },
                ],
            });
            $(document).on("click", ".delete_user", function(e) {
                e.preventDefault();
                var route_user_delete = $(this).attr("data-user");
                var _this = $(this);
                if (confirm("Are your sure to delete this user..")) {
                    $.ajax({
                        method: 'DELETE',
                        url: route_user_delete,
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                        },
                        success: function(response) {
                            if (response.status) {
                                $("#users_table").DataTable().ajax.reload();
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
