<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Models\Plan;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Yb_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Category::orderBy('id', 'desc')->get();
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
                    $btn = '<a href="categories/' . $row->id . '/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-category btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //

        if ($request->img) {
            $image = rand() . $request->img->getClientOriginalName();
            $request->img->move(public_path('category'), $image);
        } else {
            $image = "";
        }

        $category = new Category();
        $category->title = $request->title;
        $category->title_slug = str_replace(' ', '-', strtolower($request->title));
        $category->banner_img = $image;
        $result = $category->save();
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
        //
        $category = Category::where(['id' => $id])->first();
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //
        // Update category Image
        if ($request->img != '') {
            $path = public_path() . '/category/';
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

        $category = Category::where(['id' => $id])->update([
            "title" => $request->input('title'),
            "title_slug" => str_replace(' ', '-', strtolower($request->input('slug'))),
            "banner_img" => $image,
            "status" => $request->input("status"),
        ]);
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $imagePath = Category::select('banner_img')->where('id', $id)->first();
        $filePath = public_path() . '/category/' . $imagePath->banner_img;
        File::delete($filePath);

        $check =  Plan::where('category', '=', $id)->first();
        if ($check === null) {
            $destroy = Category::where(['id' => $id])->delete();
            return $destroy;
        } else {
            return response()->json("You don't delete this, This Category is used in Tour Plan");
        }
    }
}
