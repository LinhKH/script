<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Plan;
use App\Http\Requests\LocationRequest;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class Yb_LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Location::latest('id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $status = '<label class="badge badge-gradient-info">Active</label>';
                    } else {
                        $status = '<label class="badge badge-gradient-danger">Inactive</label>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="location/' . $row->id . '/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-location btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.location.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.location.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request)
    {
        //
        if ($request->img) {
            $image = rand() . $request->img->getClientOriginalName();
            $request->img->move(public_path('location'), $image);
        } else {
            $image = "";
        }

        $location = new Location();
        $location->location = $request->location;
        $location->category_id = $request->category;
        $location->location_slug = Str::slug($request->location);
        $location->image = $image;
        $result = $location->save();
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $location = Location::where('id', $id)->first();
        return view('admin.location.edit', ['location' => $location, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationRequest $request, string $id)
    {
        //
        // Update Location Image
        if ($request->img != '') {
            $path = public_path() . '/location/';
            //code for remove old file
            if ($request->old_img != ''  && $request->old_img != null) {
                $file_old = $path . $request->old_img;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->img;
            $image = rand() . $request->img->getClientOriginalName();
            $file->move($path, $image);
        } else {
            $image = $request->old_img;
        }

        $location = Location::where(['id' => $id])->update([
            "location" => $request->location,
            "location_slug" => Str::slug($request->slug),
            "image" => $image,
            "status" => $request->status,
        ]);
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $imagePath = Location::select('image')->where('id', $id)->first();
        $filePath = public_path() . '/location/' . $imagePath->image;
        File::delete($filePath);

        $check =  Plan::where('location', '=', $id)->first();
        if ($check === null) {
            $destroy = Location::where('id', $id)->delete();
            return  $destroy;
        } else {
            return response()->json("You don't delete this, This Location is used in Tour Plan");
        }
    }
}
