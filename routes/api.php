<?php

use App\Http\Controllers\Api\AdsCon;
use App\Http\Controllers\Api\BrandCon;
use App\Http\Controllers\Api\CategoryCon;
use App\Http\Controllers\Api\CompanyInfoCon;
use App\Http\Controllers\Api\DetailNewsCon;
use App\Http\Controllers\Api\PostCon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::get('/categories', CategoryCon::class);
    Route::get('/categories/{cslug}', PostCon::class); // ByCategory
    Route::get('/posts/{slug}', DetailNewsCon::class); // Detail
    Route::get('/companyinfo', CompanyInfoCon::class);
    Route::get('/ads', AdsCon::class);
    Route::get('/brands', BrandCon::class);
});

