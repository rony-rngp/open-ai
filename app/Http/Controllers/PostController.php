<?php

namespace App\Http\Controllers;

use App\Jobs\PostCreateJob;
use App\Models\Post;
use App\Models\Website;
use GuzzleHttp\Client;
use Illuminate\Http\Request;



class PostController extends Controller
{

    public function create()
    {
        $websites = Website::get();
        $post_list = Post::with('website')->latest()->get();
        $pending_count = Post::where('status', 'Pending')->count();
        return view('ai.post_create', compact('websites', 'post_list','pending_count'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'keyword' => 'required',
           'website_id' => 'required',
        ]);

        $keywords = explode("\r\n",$request->keyword);

        $website_info = Website::find($request->website_id);

        $post_ids = [];

        foreach ($keywords as $keyword){
            $post = new Post();
            $post->website_id = $website_info->id;
            $post->keyword = $keyword;
            $post->status = 'Pending';
            $post->save();
            array_push($post_ids, $post->id);
        }

        $this->dispatch(new PostCreateJob($keywords, $website_info, $post_ids));

        return redirect()->back()->with('success', 'Post Created Successfully');


    }
}
