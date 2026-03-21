<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandCon extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $brands = Brand::where('status', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $brands
        ], 200);
    }
}
