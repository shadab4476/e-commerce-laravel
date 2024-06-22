@extends('layouts.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <div class="all_section_parent dark_image_bg">
        <div style="display:none" class="fixed h-full w-full top-0 left-0  z-50 image_preview">
            <button type="button" class="w-[50px] close_btn h-[50px] absolute right-0 top-0"><svg
                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0,0,256,256">
                    <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                        stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                        font-family="none" font-weight="none" font-size="none" text-anchor="none"
                        style="mix-blend-mode: normal">
                        <g transform="scale(5.12,5.12)">
                            <path
                                d="M7.71875,6.28125l-1.4375,1.4375l17.28125,17.28125l-17.28125,17.28125l1.4375,1.4375l17.28125,-17.28125l17.28125,17.28125l1.4375,-1.4375l-17.28125,-17.28125l17.28125,-17.28125l-1.4375,-1.4375l-17.28125,17.28125z">
                            </path>
                        </g>
                    </g>
                </svg></button>
            <img src="" class="w-full h-full object-contain" alt="product preview image">
        </div>
        @include('layouts.header')
        {{-- error and status Message Start --}}
        <p style="display: none" class="absolute status_redirect w-full text-lg text-center text-green-400 font-bold">
        </p>
        <p style="display: none" class="error_redirect absolute w-full text-lg text-center text-red-400 font-bold">
        </p>
        {{-- error and status Message End --}}
        <section class="first_section">
            <div class="container mx-auto">
                <div class="flex my-3 justify-between items-center">
                    <h1 class="md:text-5xl  text-yellow-500 font-medium">Edit Product </h1>
                    <a class="inline-block px-8 bg-yellow-500 hover:bg-yellow-400 transition py-2 text-lg"
                        href="{{ route('products.index') }}">Back</a>
                </div>

                <div class="editproductForm_parent md:pb-10 ">

                    <div class="flex justify-between items-start">
                        <div class="form_parent md:py-5 md:px-10 md:w-[35%]
                        md:mx-auto">
                            <form enctype="multipart/form-data" method="POST" class="w-full gap-y-2 flex flex-wrap"
                                action="{{ route('products.update', $product->id) }}">
                                @method('put')
                                @csrf
                                <div class="w-full ">
                                    <label for="select2-dropdown" class="w-full text-white">Category</label>
                                    <select required name="category_id" class="text-black w-full py-3 px-2 capitalize"
                                        id="select2-dropdown">
                                        @foreach ($categories as $category)
                                            <option
                                                {{ strtolower($product->category->name == $category->name ? 'selected' : '') }}
                                                class="text-black capitalize" value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <p class="text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                                <div class="w-full">
                                    <label for="name" class="text-white">Name</label>
                                    <input autofocus required value="{{ $product->name }}"
                                        class="w-full focus:outline-0 px-2 py-3" type="text" placeholder="Name"
                                        name="name" id="name">
                                </div>
                                @error('name')
                                    <p class="text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                                <div class="w-full flex flex-wrap justify-between items-center">
                                    <label for="image" class="w-full text-white">Image</label>
                                    <input value="{{ $product->image }}" class="w-3/4 focus:outline-0 bg-white px-2 py-3"
                                        accept=".png,.jpeg,.jpg" type="file" placeholder="Image" name="image"
                                        id="image">
                                    <img title="Product Image"
                                        class="cursor-pointer product_image_view c w-1/4 h-[54px] object-contain"
                                        src="{{ asset('assets/images/' . $product->image) }}" alt="product image">
                                </div>
                                @error('image')
                                    <p class="text-red-600 font-medium">{{ $message }}</p>
                                @enderror

                                <div class="w-full">
                                    <label for="description" class="text-white">Description</label>
                                    <textarea required name="description" id="description" class="w-full text-black focus:outline-0 px-2 py-3"
                                        placeholder="Descriotion">{{ $product->description }}</textarea>

                                </div>
                                @error('description')
                                    <p class="text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                                <div class="w-full">
                                    <label for="short_description" class="text-white">Short Description</label>
                                    <textarea required name="short_description" id="short_description" placeholder="Short Descriotion"
                                        class="w-full text-black focus:outline-0 px-2 py-3">{{ $product->short_description }}</textarea>
                                </div>
                                @error('short_description')
                                    <p class="text-red-600 font-medium">{{ $message }}</p>
                                @enderror

                                <div class="w-full">
                                    <label for="rprice" class="text-white">Regular Price</label>
                                    <input required value="{{ $product->rprice }}"
                                        class="w-full focus:outline-0 px-2 py-3" type="text"
                                        placeholder="Regular Price" name="rprice" id="rprice">
                                </div>
                                @error('rprice')
                                    <p class="text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                                <div class="w-full">
                                    <label for="price" class="text-white">Price</label>
                                    <input required value="{{ $product->price }}"
                                        class="w-full focus:outline-0 px-2 py-3" type="text" placeholder="Price"
                                        name="price" id="price">
                                </div>
                                @error('price')
                                    <p class="text-red-600 font-medium">{{ $message }}</p>
                                @enderror

                                <div class="w-full">
                                    <label for="related_image" class="text-white">Add Related Image</label>
                                    <input multiple class="w-full bg-white focus:outline-0 px-2 py-3" type="file"
                                        accept=".jpeg,.jpg,.png" placeholder="Related Images" name="related_image[]"
                                        id="related_image">
                                </div>
                                @error('related_image')
                                    <p class="text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                                <div class="w-1/2 mt-2">
                                    <button
                                        class="w-full bg-yellow-600 hover:bg-yellow-500 transition-all text-white px-2 py-3">Update

                                    </button>
                                </div>

                            </form>
                        </div>
                        <div class="reletedImages flex gap-y-5 flex-wrap w-[35%]">
                            @foreach ($product->images as $image)
                                <div class="w-full related_image_child h-full ">
                                    <img class="w-[259px] h-[300px] block object-contain object-center"
                                        src="{{ asset($image->image) }}" alt="retlated iamge" />
                                    <div class="flex deleteUpdateImageRelated flex-wrap gap-x-10 mt-2">
                                        <button class="px-3 product_image_edit py-1 bg-black">Edit</button>
                                        <button image-data-id="{{ $image->id }}"
                                            class="px-3 flex justify-between items-center py-1 product_image_delete bg-black">Delete
                                            <svg aria-hidden="true"
                                                class="w-5 h-5 ml-2 loadSvg hidden text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill"></path>
                                            </svg>
                                        </button>
                                        @error('relatedImage')
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror

                                        <div class="related_parent_update mt-2 hidden">
                                            <input type="file" name="relatedImage" class="w-full bg-white py-2 px-5"
                                                id="">
                                            <button
                                                class="bg-yellow-600 mt-1 hover:bg-yellow-500 realtedupdateSubmit transition-all py-1 px-5 "
                                                type="submit" image-data-id="{{ $image->id }}">Update</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            $("#select2-dropdown").select2();
            $(".product_image_view").click(function() {
                var src = $(this).attr("src");
                $(".image_preview").find("img").attr("src", src);
                $(".image_preview").fadeIn();
            });
            $(".close_btn").click(function() {
                $(".image_preview").fadeOut();
                $(".image_preview").find("img").attr("src", "");
            });

            $(".product_image_edit").click(function() {
                $(this).parents(".deleteUpdateImageRelated").find(".related_parent_update").toggleClass(
                    "hidden");
            });


            $(".realtedupdateSubmit").click(function() {
                var thisbtnClick = $(this);
                var imageValue = $(this).parents(".related_parent_update").find(
                    "input[name=relatedImage]");
                var formData = new FormData();
                var image = imageValue[0].files[0];
                var relatedImageid = $(this).attr("image-data-id");
                formData.append("image", image);
                formData.append("id", relatedImageid);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                    },
                    type: "post",
                    url: "{{ route('related.imageUpdate') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.error) {
                            $(".error_redirect").text(response.error).fadeIn().delay(5000)
                                .fadeOut();
                        } else {
                            var src = "{{ url('/') }}" + '/' + response.src;
                            $(thisbtnClick).parents(".related_image_child").find("img").attr(
                                "src", src)
                            $("input[name=relatedImage]").val("").attr("value", "");
                            $(thisbtnClick).parents(".deleteUpdateImageRelated").find(
                                ".related_parent_update").toggleClass(
                                "hidden");
                            $(".status_redirect").text(response.status).fadeIn().delay(5000)
                                .fadeOut();
                        }
                    }
                });

            });


            $(".product_image_delete").click(function() {
                $this_btns = $(this);
                $id = $(this).attr("image-data-id");
                if ("{{ count($product->images) }}" > 2) {
                    if ($id != '' && $id != undefined) {
                        if (confirm("Are you sure to delete this image..")) {
                            $this_btns.find(".loadSvg").removeClass("hidden");
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content"),
                                },
                                type: "POST",
                                url: "{{ route('related.imageDelete') }}",
                                data: {
                                    id: $id,
                                },
                                success: function(response) {
                                    $this_btns.find(".loadSvg").addClass("hidden");
                                    if (response.error) {
                                        $(".error_redirect").text(response.error).fadeIn()
                                            .delay(
                                                5000)
                                            .fadeOut();
                                    } else {
                                        $this_btns.parents(".related_image_child").remove();
                                        $(".status_redirect").text(response.status).fadeIn()
                                            .delay(
                                                5000)
                                            .fadeOut();
                                    }
                                },
                            });
                        }
                    }
                } else {
                    alert("Product Images must at least 2..");
                }
            });


        });
    </script>
@endsection
