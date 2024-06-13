<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Banner;
use App\Models\User;
use App\Models\Page;
use App\Models\Category;
use App\Models\Plan;
use App\Models\Location;
use App\Models\Booking;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Comment;
use App\Models\ReviewRating;
use App\Models\UserContact;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class Yb_HomeController extends Controller
{
    //
    public function index()
    {
        $banner =  Banner::first();
        $location = Location::select('locations.*')->withCount('plan')->get();
        $plan =  Plan::select(['plans.*', 'categories.title as category', 'categories.title_slug as slug', DB::raw("count(booking.id) as count")])
            ->leftJoin('categories', 'categories.id', '=', 'plans.category')
            ->leftJoin('booking', 'booking.plan_id', '=', 'plans.id')
            ->groupBy('plans.id')
            ->where('plans.status', '1')
            ->get();
        $destination = Plan::select(['plans.location', 'locations.location', 'locations.location_slug', 'locations.image', DB::raw("count(booking.id) as count")])
            ->leftJoin('booking', 'booking.plan_id', '=', 'plans.id')
            ->leftJoin('locations', 'locations.id', '=', 'plans.location')
            ->groupBy('plans.location')
            ->where('plans.status', '1')
            ->limit(6)
            ->get();
        $blog = Blog::limit(6)->latest()->get();
        return view('public.index', ['banner' => $banner, 'location' => $location, 'plan' => $plan, 'destination' => $destination, 'blog' => $blog]);
    }

    public function yb_category(Request $request)
    {
        Paginator::useBootstrap();
        $where = '';

        if ($request->start_date != '' && $request->end_date != '') {
            if ($where != '') {
                $where .= ' AND ';
            }
            $where .= ' DATE_FORMAT(plans.start_time, "%Y-%m-%d") BETWEEN "' . $request->start_date . '" AND "' . $request->end_date . '"';
        } elseif ($request->start_date && $request->start_date != '') {
            if ($where != '') {
                $where .= ' AND ';
            }
            $where .= 'DATE_FORMAT(plans.start_time, "%Y-%m-%d") >= "' . $request->start_date . '"';
        }

        if ($request->sort == 'h-l') {
            $order = 'plans.price DESC';
        } else if ($request->sort == 'l-h') {
            $order = 'plans.price ASC';
        } elseif ($request->sort == 'oldest') {
            $order = 'plans.id ASC';
        } else {
            $order = 'plans.id DESC';
        }

        if ($request->location != '') {
            $location = $request->location;
        } else {
            $location = '';
        }

        if ($request->min_price && $request->min_price != '') {
            if ($where != '') {
                $where .= ' AND ';
            }
            $where .= 'plans.price>= ' . $request->min_price;
        }

        if ($request->max_price && $request->max_price != '') {
            if ($where != '') {
                $where .= ' AND ';
            }
            $where .= 'plans.price<= ' . $request->max_price;
        }
        
        if ($request->cat != 'all') {
            $cat = $request->cat;
        } else {
            $cat = '';
        }
        // dd($request->cat);

        if (!empty($cat)) {
            if ($where != '') {
                $where .= ' AND ';
            }
            if (is_array($request->cat)) {
                $cat_slug = Category::whereIn('categories.title_slug', $request->cat)->pluck('id')->toArray();
                $where .= 'plans.category IN (' . implode(',', $cat_slug) . ')';
            } else {
                $cat_slug = Category::where('categories.title_slug', $request->cat)->pluck('id')->first();
                $where .= 'plans.category =' . $cat_slug;
            }
        }

        $category = Category::withCount('plans')->get();

        if ($request->location != 'all') {
            $location = $request->location;
        } else {
            $location = '';
        }

        if (!empty($location)) {
            if ($where != '') {
                $where .= ' AND ';
            }
            $loc_slug = Location::where(['locations.location_slug' => $request->location])->pluck('id')->first();
            $where .= 'plans.location = ' . $loc_slug;
        }

        $location = Location::select('locations.*')->withCount('plan')->get();

        $limit = 9;

        if ($where != '') {
            $plan = Plan::select(['plans.*', 'categories.title as category', 'categories.title_slug as slug', 'locations.location'])
                ->leftJoin('categories', 'categories.id', '=', 'plans.category')
                ->leftJoin('locations', 'locations.id', '=', 'plans.location')
                ->whereRaw($where)
                ->orderByRaw($order)
                ->paginate($limit);
        } else {
            $plan = Plan::select(['plans.*', 'categories.title as category', 'categories.title_slug as slug', 'locations.location'])
                ->LeftJoin('categories', 'categories.id', '=', 'plans.category')
                ->leftJoin('locations', 'locations.id', '=', 'plans.location')
                ->latest()
                ->paginate($limit);
        }
        return view('public.plan', ['category' => $category, 'location' => $location, 'plan' => $plan]);
    }

    public function yb_singlePage($text, $slug)
    {
        $plan = Plan::with('tourPlan', 'catName', 'locationName')->where('plans.title_slug', $slug)->first();
        $booked = Booking::where('plan_id', $plan->id)->sum('seats');

        $reviewRating = ReviewRating::select('review_ratings.*', 'users.username', 'users.image')
            ->leftJoin('users', 'review_ratings.user_id', '=', 'users.id')
            ->where('plan_id', $plan->id)
            ->where('review_ratings.status', '1')
            ->get();

        $related = Plan::select(['plans.*', 'categories.title as category', 'categories.title_slug as slug'])
            ->LeftJoin('categories', 'plans.category', '=', 'categories.id')
            ->where('plans.category', $plan->category)
            ->where('plans.status', '1')
            ->get();

        return view('public.single', ['plan' => $plan, 'reviewRating' => $reviewRating, 'related' => $related, 'booked' => $booked]);
    }

    public function yb_blogs(Request $request)
    {
        Paginator::useBootstrap();
        $limit = 6;
        $blog = Blog::select('blogs.*')->with('blog_category')->where('blogs.status', '1')->latest()->paginate($limit);
        return view('public.blogs', ['blog' => $blog]);
    }

    public function yb_blogs_categories($slug)
    {
        Paginator::useBootstrap();
        $limit = 6;
        $category = BlogCategory::where(['b_categories.title_slug' => $slug])->first();

        $blog = Blog::select('blogs.*')->with('blog_category')->where('blogs.category', $category->id)
            ->where('blogs.status', '1')->latest()->paginate($limit);

        return view('public.blogs_cat', compact('blog', 'category'));
    }

    public function yb_blogSinglePage($slug, $text)
    {
        $category = BlogCategory::withCount('blogs')->limit('5')->get();

        $blog = Blog::with('blog_category')->where('blogs.title_slug', $text)
            ->where('blogs.status', '1')->first();

        $latest = Blog::with('blog_category')
            ->where('blogs.status', '1')->latest()
            ->limit(5)->get();

        $commentCount = Comment::where('blog_id', $blog->id)
            ->where('status', '1')->count();

        return view('public.blog_single', ['blog' => $blog, 'commentCount' => $commentCount, 'category' => $category, 'latest' => $latest]);
    }

    // contact page
    public function yb_contact()
    {
        $value = session()->get('id');
        if (session()->get('id') != '') {
            $users = User::WHERE(['id' => $value])->get();
            return view('public.contact', ['user' => $users]);
        } else {
            return view('public.contact');
        }
    }

    // save contact page
    public function yb_contactStore(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required',
        ]);

        $userContact = new UserContact();
        $userContact->username = $request->input("username");
        $userContact->email = $request->input("email");
        $userContact->phone = $request->input("phone");
        $userContact->description = $request->input("description");
        $result = $userContact->save();
        return $result;
    }

    public function yb_footer_pages($slug)
    {
        $page = Page::where('page_slug', $slug)->first();
        return view('public.single-page', ['page_detail' => $page]);
    }
}
