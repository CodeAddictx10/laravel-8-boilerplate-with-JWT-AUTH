<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Testimony;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TestimonyController extends Controller
{
    /**
     * Get all testimonies
     * @return Illuminate\Http\JsonResponse
     */
    public function index():JsonResponse
    {
        $testimonies = Testimony::all();
        return ResponseController::response(true, $testimonies, Response::HTTP_OK);
    }
}
