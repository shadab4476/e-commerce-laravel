<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Nette\Utils\Html;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "All Category";
        if (\request()->ajax()) {
            $categories = Category::get();
            $category_datatable = DataTables::of($categories)->addColumn("action", function ($row) {
                $edit = route('categories.edit', $row->id);
                $delete = route('categories.destroy', $row->id);
                $HtmlAddAction = '<div class="action_table"><ul class="flex justify-between">';
                $HtmlAddAction .= '<li><a class="px-2 py-1 inline-block" href="' . $edit . '">Edit</a></li>';
                $HtmlAddAction .= '<li><a class="px-2 py-1 inline-block delete_category" href="javascript:void(0)" data-category="' . $delete . '">Delete</a></li>';
                return Html::fromHtml($HtmlAddAction);
            })->addColumn("name", function ($row) {
                $name_product = $row->name;
                $name = "<a href='javascript:void(0)' class='inline-block'><span class='text-yellow-500 font-bold'>$name_product </span></a>";
                return Html::fromHtml($name);
            });
            return $category_datatable->make(true);
        }

        return view("admin.category.index", compact('title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //\
        $title = "Category Create";
        return  view("admin.category.create", compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required|unique:categories,name",
        ]);

        Category::create([
            "name" => $request->input("name"),
            "author_id" => auth()->user()->id,
        ]);

        return redirect()->route("categories.index")->with(["status" => "Category created.."]);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = "Category Edit";
        $category = Category::find($id);
        return view("admin.category.edit", compact('title', 'category'));
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
        $request->validate([
            "name" => "required",
        ]);


        $category = Category::find($id);
        $categories = Category::get(["name"]);
        foreach ($categories as $category_name) {
            if (strtolower($request->input("name")) != strtolower($category->name) &&  strtolower($category_name->name) == strtolower($request->input("name"))) {
                return redirect()->back()->with(["error" => "This category name is already exists.."]);
            }
        }
        $category->update([
            "name" => $request->input("name"),
        ]);
        return redirect()->route("categories.index")->with(["status" => "Category Updated.."]);
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
            $category = Category::find($id);
            if ($category) {
                $category->delete();
                return response()->json(["status" => "Category Deleted.."]);
            }
        } catch (\Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }
}
