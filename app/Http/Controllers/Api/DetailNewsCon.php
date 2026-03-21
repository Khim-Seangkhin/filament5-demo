<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DetailNewsCon extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $post = Post::where('status', 1)->where('slug', $slug)->get();

        return response()->json([
            'success' => true,
            'data' => $post
        ], 200);
    }
}
