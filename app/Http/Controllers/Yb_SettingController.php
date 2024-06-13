<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Yb_SettingController extends Controller
{
    //
    public function yb_general_settings(Request $request){
        if($request->input()){
            $request->validate([
                'logo'=> 'image|mimes:jpg,jpeg,png,svg',
                'com_name'=> 'required',
                'com_email'=> 'required',
                'phone'=> 'required',
                'address'=> 'required',
                'phone'=> 'required',
                'f_copyright'=> 'required',
            ]);

            if($request->logo != ''){        
                $path = public_path().'/site-img/';

                //code for remove old file
                if($request->old_logo != ''  && $request->old_logo != null){
                    $file_old = $path.$request->old_logo;
                    if(file_exists($file_old)){
                        unlink($file_old);
                    }
                }

                //upload new file
                $file = $request->logo;
                $filename = rand().$file->getClientOriginalName();
                $file->move($path, $filename);
            }else{
                $filename = $request->old_logo;
            }

            $update = DB::table('general_settings')->update([
                'com_logo'=>$filename,
                'com_name'=>$request->com_name,
                'com_email'=>$request->com_email,
                'com_phone'=>$request->phone,
                'address'=>$request->address,
                'description'=>$request->des,
                'footer_copyright'=>$request->f_copyright,
                'cur_format'=>$request->cur_format,
             
            ]);
            return $update;
        }else{
            $settings = DB::table('general_settings')->get();
            return view('admin.settings.general',['data'=>$settings]);
        }
    }

    public function yb_profile_settings(Request $request){
        if($request->input()){
            $request->validate([
                'admin_name'=> 'required',
                'admin_email'=> 'required|email:rfc',
                'username'=> 'required',
            ]);

            $update = DB::table('admin')->update([
                'admin_name'=>$request->admin_name,
                'admin_email'=>$request->admin_email,
                'username'=>$request->username,
            ]);
            return $update;

        }else{
            $settings = DB::table('admin')->get();
            return view('admin.settings.profile',['data'=>$settings]);
        }
    }

    public function yb_change_password(Request $request){
        if($request->input()){
            $request->validate([
                'password'=> 'required',
                'new'=> 'required',
                'new_confirm'=> 'required',
            ]);

            $get_admin = DB::table('admin')->first();

            if(Hash::check($request->password,$get_admin->password)){
                DB::table('admin')->update([
                    'password'=>Hash::make($request->new)
                ]);
                return '1';
            }else{
                return 'Please Enter Correct Current Password';
            }
        }
    }

    public function yb_banner_settings(Request $request){
        // return $request->input();
        if($request->input()){
            $request->validate([
                'image'=> 'image|mimes:jpg,jpeg,png,svg',
                'title'=> 'required',
                'sub_title'=> 'required',
            ]);
    
            if($request->image != ''){        
                $path = public_path().'/banner/';

                //code for remove old file
                if($request->old_image != ''  && $request->old_image != null){
                    $file_old = $path.$request->old_image;
                    if(file_exists($file_old)){
                        unlink($file_old);
                    }
                }
                //upload new file
                $file = $request->image;
                $filename = rand().$file->getClientOriginalName();
                $file->move($path, $filename);
                }else{
                    $filename = $request->old_image;
                }
    
                $update = DB::table('banner')->update([
                    'image'=>$filename,
                    'title'=>$request->title,
                    'sub_title'=>$request->sub_title,
                ]);
                return $update;
            }else{
                $settings = DB::table('banner')->get();
                return view('admin.settings.banner',['data'=>$settings]);
            }
        
    }  
}
