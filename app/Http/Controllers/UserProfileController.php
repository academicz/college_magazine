<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function getProfile($id)
    {
        $categories = ArticleCategory::all();
        $data = [
            'user' => User::findOrFail($id), 
            'articles' => Article::where([['user_id', $id],['status',1]])->paginate(10),
            'categories'=>$categories
        ];

        return view('Public.profile', $data);
    }

    public function editProfile($id)
    {
        $data = [
            'user' => user()
        ];
        return view('Public.edit_profile', $data);
    }

    public function postEditProfile(EditProfileRequest $request)
    {
        $user = User::find($request['user_id']);
        if ($request->has('image')) {
            $file = $request->file('image');
            $extnsion = $file->guessClientExtension();
            $name = "user-" . rand(1000000, 9999999) . "." . $extnsion;
            $destinationPath = 'uploads/profile_pictures';
            $file->move($destinationPath, $name);

            $user->image = $destinationPath . '/' . $name;
        }

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->google_plus = $request['plus'];
        $user->facebook = $request['facebook'];
        $user->twitter = $request['twitter'];
        $user->about = $request['about'];

        $user->save();
        return redirect()->route('editProfile', ['id' => $user->id]);
    }
}
