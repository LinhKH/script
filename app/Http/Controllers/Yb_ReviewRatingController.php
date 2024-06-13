<?php

namespace App\Http\Controllers;
use App\Models\ReviewRating;
use App\Models\AllPlan;
use App\Models\User;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Yb_ReviewRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data =  ReviewRating::select(['review_ratings.*','users.username','plans.title as plan'])
                    ->LeftJoin('users','review_ratings.user_id','=','users.id')
                    ->LeftJoin('plans','review_ratings.plan_id','=','plans.id')
                    ->orderBy('review_ratings.review_id','desc')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('plan',function($row){
                    return substr($row->plan,0,50).'...';
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
                    $btn = '<a href= "rating/'.$row->review_id.'/edit" class="btn btn-success btn-sm" >Edit</a>  <a href="javascript:void(0)" class="delete-review btn btn-danger btn-sm" data-id="'.$row->review_id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.rating.index');
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
        $request->validate(['comment'=>'required']);
        if(!$request->input("rating")){
            $rating = 0;
        }else{
            $rating = $request->input("rating");
        }

        $reviewRating = new ReviewRating();
        $reviewRating->plan_id = $request->input("plan_id");
        $reviewRating->user_id = $request->input("user_id");
        $reviewRating->comment = $request->input("comment");
        $reviewRating->star_rating = $rating;
        $result = $reviewRating->save();
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
       // $reviewRating = ReviewRating::where(['review_id'=>$id])->first();
        $reviewRating =  ReviewRating::select(['review_ratings.*','users.username','plans.title as plan'])
                        ->LeftJoin('users','review_ratings.user_id','=','users.id')
                        ->LeftJoin('plans','review_ratings.plan_id','=','plans.id')
                        ->where(['review_id'=>$id])
                        ->first();
        return view('admin.rating.edit',['rating'=>$reviewRating]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'comment'=>'required',
            'status'=>'required',
        ]);

        $reviewRating = ReviewRating::where(['review_id'=>$id])->update([
            "star_rating" =>$request->rating,
            "comment" => htmlspecialchars($request->comment),
            "status" =>$request->status,
        ]);
        return $reviewRating;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = ReviewRating::where('review_id',$id)->delete();
        return  $destroy;
    }
}
