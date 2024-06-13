<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Plan;
use App\Models\Location;
use App\Http\Requests\PlanRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Yb_PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Plan::with('catName')->latest()->get();
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
                ->addColumn('category', function ($row) {
                    return $row->catName->title;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="plans/' . $row->id . '/edit" class="btn btn-gradient-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-plan btn btn-gradient-danger btn-sm" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::all();
        $location = Location::all();
        return view('admin.plan.create', ['category' => $category, 'location' => $location]);
    }

    public function get_location_by_category(Request $request)
    {
        $locations = location_category($request->category_id);
        return view('admin.plan.location_by_category', ['locations' => $locations]);
    }
    public function get_location_by_category_edit(Request $request)
    {
        $plan = Plan::where(['id' => $request->plan_id])->first();
        $locations = location_category($request->category_id);
        return view('admin.plan.location_by_category_edit', ['locations' => $locations, 'plan' => $plan]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        //
        // return $request->input();
        $gallery = [];
        if ($request->hasfile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('plan'), $name);
                $gallery[] = $name;
            }
        }
        $plan = new Plan();
        $plan->gallery = implode(',', $gallery);
        $plan->title = $request->title;
        $plan->title_slug = Str::slug($request->title);
        $plan->category = $request->category;
        $plan->start_time = $request->start_time;
        $plan->end_time = $request->end_time;
        $plan->location = $request->location;
        $plan->duration = $request->duration;
        $plan->capacity = $request->capacity;
        $plan->price = $request->price;
        $plan->includes = $request->includes;
        $plan->excludes = $request->excludes;
        $plan->description = $request->des;
        $result = $plan->save();

        if ($request->tour_title) {
            $TourPlan = [];
            for ($i = 0; $i < count($request->tour_title); $i++) {
                $TourPlan[$i]['plan_id'] = $plan->id;
                $TourPlan[$i]['title'] = $request->tour_title[$i];
                $TourPlan[$i]['sub_title'] = $request->sub_title[$i];
                $TourPlan[$i]['description'] = $request->tour_description[$i];
            }
            DB::table('tour_plan')->insert($TourPlan);
        }
        return '1';
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
        $category = Category::all();
        $location = Location::all();
        $tourPlan = DB::table('tour_plan')->where(['plan_id' => $id])->get();
        $plan = Plan::where(['id' => $id])->first();
        return view('admin.plan.edit', ['plan' => $plan, 'category' => $category, 'location' => $location, 'tourPlan' => $tourPlan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, string $id)
    {
        //
        $gallery = array_filter(explode(',', $request->old_gallery));

        if (!empty($request->old)) {
            $g_count = count($gallery);
            for ($j = 0; $j < $g_count; $j++) {
                if (!in_array($j + 1, $request->old)) {
                    $img = $gallery[$j];
                    if (file_exists(public_path('plan/' . $img))) {
                        unlink(public_path('plan/') . $img);
                    }
                    unset($gallery[$j]);
                }
            }
        } else {
            $g_count = count($gallery);
            for ($j = 0; $j < $g_count; $j++) {
                $img = $gallery[$j];
                if (file_exists(public_path('plan/' . $img))) {
                    unlink(public_path('plan/') . $img);
                }
                unset($gallery[$j]);
            }
        }

        if ($request->hasfile('gallery1')) {
            foreach ($request->file('gallery1') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('plan'), $name);
                $gallery[] = $name;
            }
        }

        $plan = Plan::where(['id' => $id])->update([
            "gallery" => implode(',', $gallery),
            "title" => $request->title,
            "title_slug" => Str::slug($request->title_slug),
            // "title_slug"=>strtolower($request->title_slug),
            "category" => $request->category,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
            "location" => $request->location,
            "duration" => $request->duration,
            "capacity" => $request->capacity,
            "price" => $request->price,
            "includes" => $request->includes,
            "excludes" => $request->excludes,
            "description" => $request->des,
            "status" => $request->status,
        ]);

        if ($request->tour_title) {
            DB::table('tour_plan')->where('plan_id', $id)->delete();
            $TourPlan = [];
            for ($i = 0; $i < count($request->tour_title); $i++) {
                $TourPlan[$i]['plan_id'] = $id;
                $TourPlan[$i]['title'] = $request->tour_title[$i];
                $TourPlan[$i]['sub_title'] = $request->sub_title[$i];
                $TourPlan[$i]['description'] = $request->tour_description[$i];
            }
            DB::table('tour_plan')->insert($TourPlan);
        }
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $imagePath = Plan::select('gallery')->where('id', $id)->first();

        // If there are multiple gallery images, you can use a loop to delete them like this:
        $galleryImages = explode(',', $imagePath->gallery); // Get the array of gallery image names
        $galleryPath = public_path() . '/plan/'; // Set the path of the gallery folder

        foreach ($galleryImages as $image) {
            $imagePath = $galleryPath . $image; // Set the path of the gallery image to delete
            File::delete($imagePath); // Delete the gallery image
        }
        $destroy = Plan::where('id', $id)->delete();
        return  $destroy;
    }
}
