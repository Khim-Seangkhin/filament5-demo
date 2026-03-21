<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCon extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($cslug)
    {
        $posts = Post::where('status', 1)->where('cslug', $cslug)->paginate(8);

        return response()->json([
            'success' => true,
            'data' => $posts
        ], 200);
    }
}
