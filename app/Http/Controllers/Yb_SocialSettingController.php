<?php

namespace App\Http\Controllers;
use App\Http\Requests\SocialSettingRequest;
use App\Models\SocialSetting;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_SocialSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = SocialSetting::latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('icon', function($row){
                    if($row->icon != ''){
                        $icon = '<span><i class="'.$row->icon.'"></i></span>';
                    }else{
                        $icon = '<span><i class=""></i></span>';
                    }
                    return $icon;
                })
                ->editColumn('status',function($row){
                     if($row->status == '1'){
                         $status = '<label class="badge badge-gradient-info">Active</label>';
                     }else{
                         $status = '<label class="badge badge-gradient-danger">Inactive</label>';
                     }
                     return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="social-settings/'.$row->id.'/edit" class="btn btn-gradient-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-social btn btn-gradient-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                 })
                 ->rawColumns(['icon','status','action'])
                 ->make(true);
        }
        return view('admin.socialSetting.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.socialSetting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialSettingRequest $request)
    {
        //
        $socialSetting = new SocialSetting();
        $socialSetting->title = $request->input('title');
        $socialSetting->url = $request->input('url');
        $socialSetting->icon = $request->input('icon');
        $socialSetting->status = $request->input('status');
        $result = $socialSetting->save();
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
        $socialSetting = SocialSetting::where(['id'=>$id])->first();
        return view('admin.socialSetting.edit',['social'=>$socialSetting]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialSettingRequest $request, string $id)
    {
        //
        $SocialSetting = SocialSetting::where(['id'=>$id])->update([
            'title'=>$request->input('title'),
            'url'=>$request->input('url'),
            'icon'=>$request->input('icon'),
            'status'=>$request->input('status'),
        ]);
        return $SocialSetting;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = SocialSetting::where('id',$id)->delete();
        return $destroy;
    }
}
