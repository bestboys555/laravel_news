<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;

class ProfileController extends Controller
{
    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/images/avatar');
    }

    public function data()
    {
        $profile = User::find(Auth::id());
        return view('management.profile.profile', compact('profile','userRole'));
    }
    public function data_pass()
    {
        $profile = User::find(Auth::id());
        return view('management.profile.setPassword', compact('profile'));
    }
    public function UpdatePass(Request $request){
        if(Auth::Check())
        {
            $request_data = $request->All();
            $validator = Validator::make($request->all(), [
                'old_password' => 'required|string',
                'password' => 'required|same:password|min:8',
                'password_confirmation' => 'required|same:password|min:8',
            ]);

            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }else{
                $current_password = Auth::User()->password;
                if(Hash::check($request_data['old_password'], $current_password))
                {
                  $user_id = Auth::User()->id;
                  $obj_user = User::find($user_id);
                  $obj_user->password = Hash::make($request_data['password']);
                  $obj_user->save();
                  return redirect()
                            ->route('profile.data_pass')
                            ->with('success','Update successfully');
                }
                else
                {
                    return back()->withErrors(['Please enter correct current password'])->withInput();
                }
            }
        }
        else
        {
          return redirect()->to('/');
        }
    }
    public function updateAuthUser (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->save();

        return redirect()->route('profile.data')->with('success','Update successfully');
    }

    public function Updatehidden_menu ()
    {
        $fetch_userTo = DB::table('users')->where('id', Auth::id())
        ->get();
        $hidden_menu = $fetch_userTo[0]->hidden_menu;

        if($hidden_menu=='0'){
            $velue_change="1";
        }else{
            $velue_change="0";
        }

        $user = User::find(Auth::id());
        $user->hidden_menu = $velue_change;
        $user->save();
    }

    public function uploadAvatar(Request $request)
    {
        $this->validate($request,[
            'file' =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];

           /// del old pic ///
            $fetch_userTo = DB::table('users')
            ->where('id', Auth::id())
            ->get();
            $old_avatar_pic = $fetch_userTo[0]->avatar_pic;
            $old_file_path = $this->photos_path . '/' . $old_avatar_pic;
            if ($old_avatar_pic!=null and file_exists($old_file_path)) {
                unlink($old_file_path);
            }
            /// del old pic ///
            $name = sha1(date('YmdHis') . Str::random(30));
            $resize_name = $name . Str::random(2) . '.' . $photo->getClientOriginalExtension();

            Image::make($photo)
                //->resize(250, 250, function ($constraints) { $constraints->aspectRatio();})
                //->resizeCanvas(250, null)
                //->crop(250, 250, 0, -125)
                ->fit(250)
                ->save($this->photos_path . '/' . $resize_name);

            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->avatar_pic = $resize_name;
            $obj_user->save();
        }
        return Response::json([
            'message' => 'Image saved Successfully'
        ], 200);
    }
}
