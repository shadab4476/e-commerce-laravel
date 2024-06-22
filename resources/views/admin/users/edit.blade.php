@extends('layouts.app')

@section('content')
    <div class="all_section_parent dark_image_bg">
        @include('layouts.header')
        <div class="container mx-auto">


            <div class="register_form_parent md:pb-10 ">
                <div class="flex justify-between my-3">
                    <h1 class="md:text-5xl  text-yellow-500 font-medium">Edit User</h1>
                    <a href="{{ route('users.index') }}"
                        class="inline-block transition hover:bg-yellow-400 px-8 bg-yellow-500 py-2 text-lg">
                        All User</a>
                </div>
                <p style="display: none" class="error_redirect text-red-600 font-medium"></p>

                <div class="form_parent   md:py-5 md:px-10  md:w-[35%] md:mx-auto">
                    <form enctype="multipart/form-data" method="POST" class="w-full gap-y-2 flex flex-wrap"
                        action="{{ route('users.update', $user->id) }}">
                        @method('put')
                        @csrf
                        <div class="w-full">
                            <label for="email" class="text-white">Email</label>
                            <input required autofocus value="{{ $user->email }}" class="w-full focus:outline-0 px-2 py-3"
                                type="email" placeholder="Email" name="email" id="email">
                        </div>
                        @error('email')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <div class="w-full">
                            <label for="Phone" class="text-white">Phone</label>
                            <input value="{{ $user->phone }}" class="w-full focus:outline-0 px-2 py-3" type="number"
                                placeholder="Phone" name="phone" id="Phone">
                        </div>
                        @error('phone')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <div class="w-full">
                            <label for="name" class="text-white">Name</label>
                            <input value="{{ $user->name }}" class="w-full focus:outline-0 px-2 py-3" type="text"
                                placeholder="Name" name="name" id="name">
                        </div>
                        @error('name')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <div class="w-full flex items-end justify-between">
                            <div class="{{ $user->image ? 'w-[80%]' : 'w-full' }}">
                                <label for="image" class="text-white">Image</label>
                                <input value="{{ old('image') }}" class="w-full focus:outline-0 bg-white px-2 py-3"
                                    accept=".png,.jpeg,.jpg" type="file" placeholder="Image" name="image"
                                    id="image">
                            </div>
                            @if ($user->image)
                                <div class="w-[20%] flex justify-center items-center">
                                    <img class="w-[50px] h-[50px] block object-cover rounded-full object-center"
                                        src="{{ asset('assets/images/' . $user->image) }}" alt="User Image..">
                                </div>
                            @endif
                        </div>
                        @error('image')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror

                        <div class="w-full password_edit">
                            <div class="flex mb-3 justify-between items-center">
                                <label for="password" class="font-bold text-white">Password</label>
                                <button
                                    class="show_hide_btn text-sm hover:text-blue-400 px-4 py-1 bg-white transition text-blue-600 inline-block"
                                    type="button">Edit</button>
                            </div>
                            <input value="" class="w-full hidden password_value focus:outline-0 px-2 py-3"
                                type="text" placeholder="Password" name="password" id="password">
                        </div>
                        @error('password')
                            <p class="text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <div class="w-1/2 mt-2">
                            <button
                                class="w-full bg-yellow-600 hover:bg-yellow-500 transition-all text-white px-2 py-3">Update</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>

    <script>
        $(function() {
            $(".show_hide_btn").click(function() {
                $this_btn = $(this);
                $(".password_value").toggleClass("hidden").focus().attr("value", "").val("");
                if ($(".password_value").hasClass("hidden")) {
                    $this_btn.text("Edit");
                } else {
                    $this_btn.text("Cancel");
                }
            });
        });
    </script>
@endsection
