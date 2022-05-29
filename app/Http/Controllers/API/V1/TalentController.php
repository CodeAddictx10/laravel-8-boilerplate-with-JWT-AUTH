<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ResponseController;
use App\Models\Talent;
use Illuminate\Http\Response;

class TalentController extends Controller
{
    /**
    * Get  talent by talentId
    * @return JsonResponse
    */
    public function show($talentId): JsonResponse
    {
        try {
            $talent = Talent::with("skills")->findOrFail($talentId);
            return ResponseController::response(true, $talent, Response::HTTP_OK);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
