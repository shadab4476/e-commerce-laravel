@extends('layouts.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <div class="all_section_parent dark_image_bg">
        @include('layouts.header')
        <section class="first_section">
            <div class="container mx-auto">
                <div class="flex my-3 justify-between items-center">
                    <h1 class="md:text-5xl  text-yellow-500 font-medium">Add Product </h1>
                    <a class="inline-block px-8 bg-yellow-500 hover:bg-yellow-400 transition py-2 text-lg"
                        href="{{ route('products.index') }}">All Products</a>
                </div>

                <div class="productForm_parent md:pb-10 ">

                    <p class="text-red-600 error_redirect font-medium" style="display: none"></p>

                    <div class="form_parent md:py-5 md:px-10 md:w-[35%]
                        md:mx-auto">
                        <form enctype="multipart/form-data" method="POST" class="w-full gap-y-2 flex flex-wrap"
                            action="{{ route('products.store') }}">
                            @csrf
                            <div class="w-full ">
                                <label for="select2-dropdown" class="w-full text-white">Category</label>
                                <select required name="category_id" class="text-black w-full py-3 px-2 capitalize"
                                    id="select2-dropdown">
                                    @foreach ($categories as $category)
                                        <option @selected(old('category_id') == $category->id) class="text-black capitalize"
                                            value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <p class="text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                            <div class="w-full">
                                <label for="name" class="text-white">Name</label>
                                <input autofocus required value="{{ old('name') }}"
                                    class="w-full focus:outline-0 px-2 py-3" type="text" placeholder="Name"
                                    name="name" id="name">
                            </div>
                            @error('name')
                                <p class="text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                            <div class="w-full">
                                <label for="image" class="text-white">Image</label>
                                <input required value="{{ old('image') }}"
                                    class="w-full focus:outline-0 bg-white px-2 py-3" accept=".png,.jpeg,.jpg"
                                    type="file" placeholder="Image" name="image" id="image">
                            </div>
                            @error('image')
                                <p class="text-red-600 font-medium">{{ $message }}</p>
                            @enderror

                            <div class="w-full">
                                <label for="description" class="text-white">Description</label>
                                <textarea required name="description" id="description" class="w-full text-black focus:outline-0 px-2 py-3"
                                    placeholder="Descriotion">{{ old('description') }}</textarea>

                            </div>
                            @error('description')
                                <p class="text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                            <div class="w-full">
                                <label for="short_description" class="text-white">Short Description</label>
                                <textarea required name="short_description" id="short_description" placeholder="Short Descriotion"
                                    class="w-full text-black focus:outline-0 px-2 py-3">{{ old('short_description') }}</textarea>
                            </div>
                            @error('short_description')
                                <p class="text-red-600 font-medium">{{ $message }}</p>
                            @enderror

                            <div class="w-full">
                                <label for="rprice" class="text-white">Regular Price</label>
                                <input required value="{{ old('rprice') }}" class="w-full focus:outline-0 px-2 py-3"
                                    type="text" placeholder="Regular Price" name="rprice" id="rprice">
                            </div>
                            @error('rprice')
                                <p class="text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                            <div class="w-full">
                                <label for="price" class="text-white">Price</label>
                                <input required value="{{ old('price') }}" class="w-full focus:outline-0 px-2 py-3"
                                    type="text" placeholder="Price" name="price" id="price">
                            </div>
                            @error('price')
                                <p class="text-red-600 font-medium">{{ $message }}</p>
                            @enderror

                            <div class="w-full">
                                <label for="related_image" class="text-white">Related Image</label>
                                <input multiple required value="{{ old('related_image') }}"
                                    class="w-full bg-white focus:outline-0 px-2 py-3" type="file"
                                    accept=".jpeg,.jpg,.png" placeholder="Related Images" name="related_image[]"
                                    id="related_image">
                            </div>
                            @error('related_image')
                                <p class="text-red-600 font-medium">{{ $message }}</p>
                            @enderror

                            <div class="w-1/2 mt-2">
                                <button
                                    class="w-full bg-yellow-600 hover:bg-yellow-500 transition-all text-white px-2 py-3">Create

                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            $("#select2-dropdown").select2();
        });
    </script>
@endsection
