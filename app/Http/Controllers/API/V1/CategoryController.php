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

    /**
    * Get all skills by Category
    *@param int $categoryId
    * @return Illuminate\Http\JsonResponse
    */
    public function show(int $categoryId):JsonResponse
    {
        try {
            $skills = Category::findorFail($categoryId)->skills;
            return ResponseController::response(true, $skills, Response::HTTP_OK);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
