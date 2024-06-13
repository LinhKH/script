<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Location;
use App\Models\ReviewRating;
use App\Models\Plan;
use App\Models\Page;


if (!function_exists('site_settings')) {
    function site_settings()
    {
        $siteInfo = DB::table('general_settings')->first();
        return $siteInfo;
    }
}

if (!function_exists('social_links')) {
    function social_links()
    {
        $social = DB::table('social-setting')->get();
        return $social;
    }
}

if (!function_exists('site_pages')) {
    function site_pages()
    {
        $pages = Page::where('status', '1')->latest()->limit(5)->get();
        return $pages;
    }
}

if (!function_exists('plan_pages')) {
    function plan_pages()
    {
        $plan = Plan::where('status', '1')->latest()->limit(5)->get();
        return $plan;
    }
}

if (!function_exists('user_review_count')) {
    function user_review_count($id)
    {
        $reviewRating = ReviewRating::select([DB::raw('COUNT(review_ratings.plan_id) as planCount'), DB::raw('SUM(review_ratings.star_rating) as rating')])
            ->where('plan_id', $id)
            ->first();
        return  $reviewRating;
    }
}

if (!function_exists('blog_comments')) {
    function blog_comments($id, $parent = 0)
    {
        $comments = Comment::select(['b_comments.*', 'users.username'])
            ->leftJoin('users', 'users.id', '=', 'b_comments.user_id')
            ->where('blog_id', $id)->where('parent_id', $parent)
            ->where('b_comments.status', '1')
            ->get();
        return $comments;
    }
}

if (!function_exists('location_category')) {
    function location_category($category_id)
    {
        $locations = Location::where('category_id', $category_id)->where('status', 1)
            ->get();
        return $locations;
    }
}
