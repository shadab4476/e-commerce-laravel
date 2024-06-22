<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Nette\Utils\Html;
use Yajra\DataTables\Facades\DataTables;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Address::whereUser_id(auth()->user()->id)->get();
            $datatable = DataTables::of($data)->addColumn("action", function ($row) {
                $delete = route('delete.addressDetail', $row->id);
                $HtmlAddAction = '<div class="action_table"><ul class="">';
                $HtmlAddAction .= '<li><a class="px-2 py-1 inline-block delete_address" href="javascript:void(0)" data-address="' . $delete . '"><svg class="border-[1px] rounded-full ast-mobile-svg ast-close-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.293 6.707l5.293 5.293-5.293 5.293c-0.391 0.391-0.391 1.024 0 1.414s1.024 0.391 1.414 0l5.293-5.293 5.293 5.293c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414l-5.293-5.293 5.293-5.293c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0l-5.293 5.293-5.293-5.293c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path></svg></a></li>';
                return Html::fromHtml($HtmlAddAction);
            });;
            return   $datatable->make(true);
        }
        $title = "Address Info";
        return view("dashboard.profile.edit", compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "phone" => "required|numeric|min:123456789012|max:999999999999",
            "address" => "required",
            "pincode" => "required|numeric|min:123456|max:999999",
            "state" => "required",
            "address_type" => "required",
            "city" => "required",
        ]);

        $address = Address::create([
            "user_id" => auth()->user()->id,
            "name" => $request->input("name"),
            "phone" => $request->input("phone"),
            "address" => $request->input("address"),
            "pincode" => $request->input("pincode"),
            "state" => $request->input("state"),
            "address_type" => $request->input("address_type"),
            "city" => $request->input("city"),
        ]);
        if ($address) {
            return redirect()->back()->with(["status" => "Address Saved..", "address_create" => "true"]);
        }
        return redirect()->back()->with(["error" => "Error!!!!",]);
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
            $address = Address::findOrFail($id);
            $address->delete();
            return response()->json([
                "status" => "Address Deleted.."
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "error" => $exception->getMessage(),
            ]);
        }
    }
}
