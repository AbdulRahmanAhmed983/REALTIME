<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Events\NewNotification;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // comments => de function in post model
           $posts =  Post::with(['comments' => function($q){
               $q->select('id','post_id','comment');
           }])->get();
        return view('home',compact('posts'));
    }
    public function saveComment(Request $request){
        Comment::Create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->post_content
        ]);

        $data = [
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->post_content
        ];


        event(new NewNotification($data));
        return redirect()->back()->with(['success' => 'done comment']);
    }
}
