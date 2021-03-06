<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepository;
use App\Notifications\NewUserFollowNotification;
use Illuminate\Http\Request;
use Auth;

class FollowersController extends Controller
{
    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }


    public function index($id)
    {
        $user = $this->user->byId($id);
        $followers = $user->followersUser()->pluck('follower_id')->toArray();

        if (in_array(Auth::guard('api')->user()->id,$followers))
        {
            return response()->json(['followed' => true]);
        }
        return response()->json(['followed' => false]);
    }

    public function follow()
    {
        $userToFollow = $this->user->byId(request('user'));
        $followed = Auth::guard('api')->user()->followThisUser($userToFollow->id);
        if (count($followed['attached']) > 0)
        {
            $userToFollow->notify(new NewUserFollowNotification());
            $userToFollow->increment('followers_count');
            return response()->json(['followed' => true]);
        }
        $userToFollow->decrement('followers_count');
        return response()->json(['followed' => false]);
    }
}
