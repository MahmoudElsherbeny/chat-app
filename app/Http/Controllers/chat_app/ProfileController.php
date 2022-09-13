<?php

namespace App\Http\Controllers\chat_app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Models\User_info;
use App\Traits\ImageFunctions;
use Exception;

class ProfileController extends Controller
{
    use ImageFunctions;
    
    public function edit()
    {
        return view('chat_app.pages.profile');
    }

    public function update(UpdateProfileRequest $request, $id, $name) {

        $user = User::findOrFail($id);
        try {
            $user->name = $request->input('name');
            if($user->user_info) {
                $user->user_info->status = $request->input('status');
                $user->user_info->phone = $request->input('phone');
                if($request->image) {
                    $user->user_info->image ? $this->delete_if_exist($user->user_info->image) : '';
                    $user->user_info->image = $this->store_image_path($request->image, 'users');
                }
            }
            else {
                $info = User_info::create([
                    'user_id' => $user->id,
                    'status' => $request->input('status'),
                    'phone' => $request->input('phone'),
                ]);
                if($request->image) {
                    $info->image = $this->store_image_path($request->image, 'users');
                    $info->save();
                } 
            }

            if($user->isDirty()) {
                $user->save();
                Session::flash('success', 'profile updated succefully');
            }
        } catch(Exception $e) {
            Session::flash('error', 'Error: '.$e->getMessage());
        }

        return Redirect::back();
    }
}
