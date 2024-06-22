<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Nette\Utils\Html;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "All Product";

        if (request()->ajax()) {
            $products = Product::with("category")->get();
            $datatable = DataTables::of($products)->addColumn("image", function ($row) {
                $view = route('products.show', $row->id);
                if ($row->image) {
                    $image =    asset('assets/images/' . $row->image);
                    $imageString = '<a href="' . $view . '" class="block"><img class="w-[100%] object-cover h-[100%]" src="' . $image . '" alt="Product Image"></a>';
                    return html::fromHtml($imageString);
                }
                return;
            })->addColumn("name", function ($row) {
                $name_product = $row->name;
                $view = route('products.show', $row->id);
                $name = "<a href='$view' class='inline-block'><span class='text-yellow-500 font-bold'>$name_product </span></a>";
                return Html::fromHtml($name);
            })->addColumn("action", function ($row) {
                $edit = route('products.edit', $row->id);
                $delete = route('products.destroy', $row->id);
                $view = route('products.show', $row->id);

                $HtmlAddAction = '<div class="action_table"><ul class="flex gap-x-3 justify-between">';
                $HtmlAddAction .= '<li><a class="px-2 py-1 inline-block" href="' . $edit . '">Edit</a></li>';
                $HtmlAddAction .= '<li><a class="px-2 py-1 inline-block" href="' . $view . '">View</a></li>';
                $HtmlAddAction .= '<li><a class="px-2 py-1 inline-block delete_product" href="javascript:void(0)" data-product="' . $delete . '">Delete</a></li>';
                return Html::fromHtml($HtmlAddAction);
            })->addColumn("category_id", function ($row) {

                if ($row->category) {
                    return Html::fromHtml('<span>' . $row->category->name . '</span>');
                }
                return;
            });

            return $datatable->make(true);
        }

        return view("dashboard.product.index", compact('title'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $title = "Add Product";
        return view("dashboard.product.create", compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = null;
        $request->validate([
            "name" => "required|unique:products,name",
            "image" => "required|mimes:jpg,png,jpeg|image",
            "description" => "required",
            "short_description" =>  "required",
            "price" =>  "required|numeric|min:1",
            "rprice" =>  "required|numeric|min:1|gt:price",
            "category_id" => "required",
            "related_image.*" => "required|mimes:jpg,png,jpeg|image",
        ]);
        try {
            $image_file = $request->file('image');
            if ($image_file) {
                $image = time() . '.' . $image_file->extension();
                $image_file->move(public_path("/assets/images"), $image);
            }
            $product = Product::create([
                "name" => $request->input("name"),
                "image" => $image,
                "description" => $request->input("description"),
                "short_description" => $request->input("short_description"),
                "price" => $request->input("price"),
                "rprice" => $request->input("rprice"),
                "category_id" => $request->input("category_id"),
                "author_id" => auth()->user()->id,
            ]);
            if ($request->hasFile('related_image')) {
                foreach ($request->file('related_image') as $key => $r_image) {
                    $image_related =    time() . $key . '.' . $r_image->extension();
                    $path = "assets/images/";
                    $r_image->move($path, $image_related);
                    ProductImage::create([
                        "product_id" => $product->id,
                        "image" => $path . $image_related,
                    ]);
                }
            }
            return redirect()->route("products.index")->with(["status" => "Product Created.."]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $title = "Show Product";
        $product = Product::with("category")->with("reviews")->find($id);
        $products = Product::with("category")->get();
        return view("dashboard.product.view", compact('title', 'product', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //\
        $title = "Edit Product";
        $categories = Category::get(["name", "id"]);
        $product =  Product::find($id);
        return view("dashboard.product.edit", compact('title', 'product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            "name" => "required|unique:products,name," . $id,
            "image" => "nullable|mimes:jpg,png,jpeg|image",
            "related_image.*" => "nullable|mimes:jpg,png,jpeg|image",
            "description" => "required",
            "short_description" =>  "required",
            "price" =>  "required|numeric|min:1",
            "rprice" =>  "required|numeric|min:1|gt:price",
            "category_id" => "required",
        ]);
        $product = Product::find($id);
        if ($request->hasFile("image")) {
            $image_name = $request->file("image");
            $image = time() . '.' . $image_name->extension();
            $image_name->move(public_path('/assets/image', $image));
        } else {
            $image = $product->image;
        }

        $product->name = $request->input("name");
        $product->image = $image;
        $product->category_id = $request->input("category_id");
        $product->description = $request->input("description");
        $product->short_description = $request->input("short_description");
        $product->price = $request->input("price");
        $product->rprice = $request->input("rprice");
        $product->update();

        if ($request->hasFile('related_image')) {
            foreach ($request->file('related_image') as $key => $image) {
                $image_related =    time() . $key . '.' . $image->extension();
                $path = "assets/images/";
                $image->move($path, $image_related);
                $product->images()->create([
                    "image" => $path . $image_related,
                ]);
            }
        }
        return redirect()->route("products.index")->with(["status" => "Product Updated.."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $product = Product::findOrFail($id);
            if ($product) {
                if ($product->images) {
                    $related_image = ProductImage::whereProduct_id($product->id);
                    $related_image->delete();
                    $product->delete();
                    return response()->json(["status" => "Product Deleted.."]);
                }
            }
        } catch (\Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }



    public function relatedImageDelete(Request $request)
    {

        try {
            $product_image = ProductImage::findOrFail($request->id);
            $product_image->delete();
            return response()->json([
                "status" => "Relatetd Image Deleted.."
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "error" => $exception->getMessage(),
            ]);
        }
    }

    public function relatedImageUpdate(Request $request)
    {
        try {
            $request->validate([
                "image" => "required|mimes:jpg,png,jpeg|image",
            ]);
            $imageData = ProductImage::findorFail($request->id);
            if ($request->hasFile('image')) {
                $imageOg = $request->file('image');
                $path = "assets/images/";
                $imagename = time() . '.' . $imageOg->extension();
                $imageOg->move($path, $imagename);
                $image = $path . $imagename;
            }
            $imageData->update([
                "image" => $image,
            ]);

            return response()->json(["src" => $image, "status" => "Product Related Image Updated.."]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }
}
