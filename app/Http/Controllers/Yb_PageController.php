<?php

namespace App\Http\Controllers;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Page::orderBy('id','desc')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('show_in_header', function($row){
                    $checked = ($row->show_in_header == '1') ? 'checked' : '';
                    return '<div class="page-checkbox">
                                <input type="checkbox" class="show-in-header" id="head'.$row->id.'" '.$checked.'>
                                <label for="head'.$row->id.'"></label>
                            </div>';
                })
                ->editColumn('show_in_footer', function($row){
                    $checked = ($row->show_in_footer == '1') ? 'checked' : '';
                    return '<div class="page-checkbox">
                                <input type="checkbox" class="show-in-footer" id="foot'.$row->id.'" '.$checked.'>
                                <label for="foot'.$row->id.'"></label>
                            </div>';
                })
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $status = '<label class="badge badge-gradient-info">Active</span>';
                    }else{
                        $status = '<label class="badge badge-gradient-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="pages/'.$row->id.'/edit" class="btn btn-gradient-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-page btn btn-gradient-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['show_in_header','show_in_footer','status','action'])
                ->make(true);
        }
        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        //
        $page = new Page();
        $page->page_title = $request->title;
        $page->page_slug = str_replace(array(' ','_'),'-',strtolower($request->title));
        $page->description = htmlspecialchars($request->des);
        $result = $page->save();
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
        $page = Page::where(['id'=>$id])->first();
        return view('admin.pages.edit',['page'=>$page]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, string $id)
    {
        //
        if($request->slug != ''){
            $slug = str_replace(array(' ','_'),'-',strtolower($request->input("slug")));
        }else{
            $slug = str_replace(array(' ','_'),'-',strtolower($request->input("title")));
        }

        $page = Page::where(['id'=>$id])->update([
            "page_title" => $request->title,
            "page_slug"=> $slug,
            "description" => htmlspecialchars($request->des),
            "status" => $request->status,
        ]);
        return $page;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = Page::where('id',$id)->delete();
        return  $destroy;
    }

    public function yb_show_in_header(Request $request){
        $id = $request->id;
        $status = $request->status;

        $response = Page::where('id',$id)->update([
            'show_in_header'=> $status
        ]);
        return $response;
    }

    public function yb_show_in_footer(Request $request){
        $id = $request->id;
        $status = $request->status;

        $response = Page::where('id',$id)->update([
            'show_in_footer'=> $status
        ]);
        return $response;
    }
}
