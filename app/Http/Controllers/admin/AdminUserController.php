<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Html;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "All Users";

        if (request()->ajax()) {
            $users = User::get();
            $datatable = DataTables::of($users)->addColumn("action", function ($row) {
                $edit = route('users.edit', $row->id);
                $delete = route('users.destroy', $row->id);
                $HtmlAddAction = '<div class="action_table"><ul class="flex justify-between">';
                $HtmlAddAction .= '<li><a class="px-2 py-1 inline-block" href="' . $edit . '">Edit</a></li>';
                $HtmlAddAction .= '<li><a class="px-2 py-1 inline-block delete_user" href="javascript:void(0)" data-user="' . $delete . '">Delete</a></li>';
                return Html::fromHtml($HtmlAddAction);
            })->addColumn("isActive", function ($row) {
                if ($row->isActive == 1) {
                    $status = "<button type='button'  class='inline-block statusChange'><h2 class='text-green-500 font-bold'>Online</h2></button>";
                    return Html::fromHtml($status);
                }
                $status = "<button type='button'  class='inline-block statusChange'><h2 class=''>Online</h2></button>";
                return Html::fromHtml($status);
            })->addColumn("name", function ($row) {
                $name_product = $row->name;
                $name = "<button type='button'  class='inline-block'><h2 class='text-yellow-500 font-bold'>$name_product </h2></button>";
                return Html::fromHtml($name);
            })->addColumn("image", function ($row) {
                if ($row->image) {
                    $image_path = asset("assets/images/" . $row->image);
                    $image = "<div class='flex justify-center items-center  w-full'><img alt='user image' class='cursor-pointer h-[50px] w-[50px] rounded-full  block object-cover  object-center' src='$image_path' /></div>";
                    return Html::fromHtml($image);
                }
                $empty = '<span class="text-red-600 font-bold">!!</span>';
                return Html::fromHtml($empty);
            })->addColumn("phone", function ($row) {
                if ($row->phone) {
                    $phone = "<div class='flex justify-center items-center  w-full'>+$row->phone</div>";
                    return Html::fromHtml($phone);
                }
                $empty = '<span class="text-red-600 font-bold">!!</span>';
                return Html::fromHtml($empty);
            });
            return $datatable->make(true);
        }

        return  view("admin.users.index", compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Create User";
        return view("admin.users.create", compact('title'));
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
            "name" => "required|string|max:15|unique:users,name",
            "image" => "nullable|image|mimes:jpeg,png,jpg",
            "password" => "required|min:4",
            "email" => "required|email:rfc,dns|unique:users,email",
            "phone" => "required|numeric|unique:users,phone|min:1111111111|max:9999999999|"
        ]);

        $image = $request->file('image');
        if ($image) {
            $fileName = time() . '.' . $image->extension();
            $image->move(public_path('/assets/images'), $fileName);
        } else {
            $fileName = null;
        }
        try {
            $user = User::create([
                "name" => $request->input('name'),
                "password" => bcrypt($request->input('password')),
                "email" => $request->input('email'),
                "phone" =>  $request->input('phone'),
                "image" => $fileName,
            ]);
            $user->assignRole("user");
            Mail::to($user->email)->send(new RegisterMail($user));
            return redirect()->route('users.index')->with(["status" => "Account successfully registered."]);
        } catch (\Exception $e) {
            return redirect()->back()->with(["error" => $e->getMessage()]);
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
        $title = "User Edit";
        $user = User::find($id);
        return view("admin.users.edit", compact('title', 'user'));
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
            "name" => "required|string|max:15|unique:users,name," . $id,
            "image" => "nullable|image|mimes:jpeg,png,jpg",
            "password" => "nullable|min:4",
            "email" => "required|email:rfc,dns|unique:users,email," . $id,
            "phone" => "required|numeric|unique:users,phone," . $id,
        ]);

        try {
            $user = User::findOrFail($id);
            if ($request->hasFile('image')) {
                $image_name = $request->file('image');
                $image = time() . '.' . $image_name->extension();
                $image_name->move(public_path('/assets/images'), $image);
            } else {
                if ($user->image) {
                    $image = $user->image;
                } else {
                    $image = null;
                }
            }
            if ($request->input('password')) {
                $password = bcrypt($request->input('password'));
            } else {
                $password = $user->password;
            }
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->image = $image;
            $user->password = $password;
            $user->update();
            return redirect()->route('users.index')->with(["status" => "User updated.."]);
        } catch (Exception $exception) {
            return redirect()->back()->with(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return response()->json(["status" => "User deleted.."]);
            }
        } catch (Exception $e) {
            return  response()->json(["error" => $e->getMessage()]);
        }
    }
}
