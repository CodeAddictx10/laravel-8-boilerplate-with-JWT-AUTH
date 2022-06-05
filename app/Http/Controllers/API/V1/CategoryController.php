<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\HireTalentFormRequest;
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
    *@param HireTalentFormRequest $request
    * @return Illuminate\Http\JsonResponse
    */
    public function show(HireTalentFormRequest $request):JsonResponse
    {
        $categoryByIds = $request->safe()->only(['categories'])['categories'];

        try {
            $skills = Category::with('skills')->whereIn("id", $categoryByIds)->get()->pluck('skills');
            return ResponseController::response(true, $skills, Response::HTTP_OK);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
