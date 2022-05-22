<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    /**
     * Get all testimonies
     * @return Illuminate\Http\JsonResponse
     */
    public function index():JsonResponse
    {
        $countries = Country::all();
        return ResponseController::response(true, $countries, Response::HTTP_OK);
    }
}
