<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Yb_BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            //$data = Blog::latest('id')->get();
            $data = Blog::with('blog_category')->latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('image',function($row){
                if($row->image != ''){
                    $img = '<div class="d-flex flex-row">
                                <img src="'.asset("/blog/".$row->image).'" class="mr-2" width="70px">
                                <span class="align-self-center">'.$row->title.'</span>
                            </div>';
                }else{
                    $img = '<div class="d-flex flex-row">
                                <img src="'.asset("/blog/default.png").'" class="mr-2" width="70px">
                                <span class="align-self-center">'.$row->title.'</span>
                            </div>';
                }
                return $img;
            })
            ->editColumn('status', function($row){
                if($row->status == '1'){
                    $status = '<label class="badge badge-gradient-info">Publish</label>';
                }else{
                    $status = '<label class="badge badge-gradient-danger">Draft</label>';
                }
                return $status;
            })
            ->addColumn('category', function($row){
                return $row->blog_category->title;
            })
            ->addColumn('action', function($row){
                $btn = '<a href="blogs/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-blog btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                return $btn;
            })
            ->rawColumns(['image','status','action'])
            ->make(true);
        }
        return view('admin.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $blogCategory = BlogCategory::all();
        return view('admin.blogs.create',['category'=>$blogCategory]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        //
        if($request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('blog'),$image);
        }else {
            $image = "";
        }
     
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->title_slug= Str::slug($request->title); 
        $blog->image = $image;
        $blog->description = $request->des;
        $blog->category = $request->category;
        $blog->author = $request->author;
        $result = $blog->save();
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
        $blogCategory = BlogCategory::all();
        $blog = Blog::where('id',$id)->first();
        return view('admin.blogs.edit',['blog'=>$blog,'category'=>$blogCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        //
         // Update Blog Image
         if($request->img != ''){        
            $path = public_path().'/blog/';
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
    
            $blog = Blog::where(['id'=>$id])->update([
                "title" => $request->title,
                "title_slug"=> Str::slug($request->slug), 
                "image" => $image,
                "description" => $request->des,
                "category" => $request->category,
                "author" => $request->author,
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
        $imagePath = Blog::select('image')->where('id', $id)->first();
        $filePath = public_path().'/blog/'.$imagePath->image;
        File::delete($filePath);
        $destroy = Blog::where('id',$id)->delete();
        return  $destroy;
    }
}
