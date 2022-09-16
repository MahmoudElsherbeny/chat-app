<?php

namespace App\Http\Controllers\chat_app;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $people_you_know = User::WithotCurrentUser()->WithoutFriendsBlocks()
                               ->inRandomOrder()->limit(25)->get();
        
        return view('chat_app.home')->with(['users' => $people_you_know]);
    }
    
}
