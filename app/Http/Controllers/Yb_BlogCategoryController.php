<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Yb_BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = BlogCategory::orderBy('id','desc')->get();
                    return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $status = '<label class="badge badge-gradient-info">Active</label>';
                    }else{
                        $status = '<label class="badge badge-gradient-danger">Inactive</label>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="b-categories/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-blogCat btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.b-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.b-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryRequest $request)
    {
        //
        if($request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('b-category'),$image);
        }else {
            $image = "";
        }

        $blogCategory  = new BlogCategory();
        $blogCategory ->title = $request->title;
        $blogCategory->title_slug= Str::slug($request->title); 
        $blogCategory->banner_img = $image;
        $result = $blogCategory ->save();
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
        $blogCategory = BlogCategory::where(['id'=>$id])->first();
        return view('admin.b-category.edit',['category'=>$blogCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryRequest $request, string $id)
    {
        //
        // Update blog Category Image
        if($request->img != ''){        
            $path = public_path().'/b-category/';
            //code for remove old file
            if($request->old_img != ''  && $request->old_img != null){
                $file_old = $path.$request->old_img;
                if(file_exists($file_old)){
                    unlink($file_old);
                }
            }
            //upload new file
            $file = $request->img;
            $image = rand().$request->img->getClientOriginalName();
            $file->move($path, $image);
        }else{
            $image = $request->old_img;
        }

        $blogCategory = BlogCategory::where(['id'=>$id])->update([
            "title"=>$request->title,
            "title_slug"=> Str::slug($request->slug), 
            "banner_img" => $image,
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
        $imagePath = BlogCategory::select('banner_img')->where('id', $id)->first();
        $filePath = public_path().'/b-category/'.$imagePath->banner_img;
        File::delete($filePath);

        $check = Blog::where('category','=',$id)->count();
        if($check == 0){
            $destroy = BlogCategory::where('id',$id)->delete();
            return  $destroy;
        }else{
            return "You won't Delete this (This Category May be used in Blog List.)";
        }
    }
}
