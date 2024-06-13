<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class Yb_CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = User::all();
        $blog = Blog::all();
        if ($request->ajax()) {
            $data =  Comment::select(['b_comments.*','users.username as user','blogs.title as blog'])
                    ->LeftJoin('users','b_comments.user_id','=','users.id')
                    ->LeftJoin('blogs','b_comments.blog_id','=','blogs.id')
                    ->orderBy('b_comments.id','desc')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('blog',function($row){
                    return substr($row->blog,0,50).'...';
                })
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $status = '<label class="badge badge-gradient-info">Show</label>';
                    }else{
                        $status = '<label class="badge badge-gradient-danger">Hide</label>';
                    }
                    return $status;
                })
                ->editColumn('created_at', function($row){
                    return date('d M, Y',strtotime($row->created_at));
                })
                ->addColumn('action', function($row){
                    $btn = '<a href= "comment/'.$row->id.'/edit" class="editComment btn btn-success btn-xs" >Edit</a> <a href="javascript:void(0)" class="delete-comment btn btn-danger btn-xs" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.comment.index',['user'=> $user,'blog'=>$blog]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Session::get('id');
        $request->validate([ 'comment'=>'required', ]);
        $comment = new Comment();
        $comment->comment = $request->input("comment");
        $comment->blog_id = $request->input("blog");
        $comment->user_id = $user;
        $comment->parent_id = $request->input("parent");
        $result = $comment->save();
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
        $comment = Comment::where('id',$id)->first();
        return view('admin.comment.edit',['comment'=>$comment]);
        //return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([ 'comment'=>'required',]);

        $comment = Comment::where(['id'=>$id])->update([
            "comment" => htmlspecialchars($request->input("comment")),
            "status" => $request->status,
        ]);
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = Comment::where('id',$id)->delete();
        return  $destroy;
    }
}
