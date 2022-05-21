<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
    * Get all categories
    * @return Illuminate\Http\JsonResponse
    */
    public function index():JsonResponse
    {
        $categories = Category::all();
        return ResponseController::response(true, $categories, Response::HTTP_OK);
    }
}
