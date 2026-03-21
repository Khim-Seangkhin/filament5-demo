<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdsCon extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $ads = Advertisement::where('status', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $ads
        ], 200);
    }
}
