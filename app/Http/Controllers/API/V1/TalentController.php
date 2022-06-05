<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ResponseController;
use App\Models\SavedProfile;
use App\Models\Showcase;
use App\Models\Talent;
use Illuminate\Http\Response;
use Carbon\Carbon;

class TalentController extends Controller
{
    public function test()
    {
        return Carbon::now()->toDateTimeLocalString();
    }
    /**
    * Get  talent by talentId
    * @return JsonResponse
    */
    public function show($talentId): JsonResponse
    {
        try {
            $talent = Talent::with("skills")->findOrFail($talentId);
            $clientHasSchdeuleInterview = Showcase::where('user_id', auth()->user()->id)->where('talent_id', $talentId)->exists();
            if ($clientHasSchdeuleInterview) {
                $talent->hasInterviewWithClient = Showcase::where('user_id', auth()->user()->id)->where('talent_id', $talentId)->latest()->first(['date']);
            }
            return ResponseController::response(true, $talent, Response::HTTP_OK);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
    * Get  talents by interviewed by a user
    * @return JsonResponse
    */
    public function getInterviewedTalent(): JsonResponse
    {
        try {
            $talent = Showcase::with('talent')->where("user_id", auth()->user()->id)->where('status', 2)->get();
            return ResponseController::response(true, $talent, Response::HTTP_OK);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
    /**
    * Get  talents by hired by a user
    * @return JsonResponse
    */
    public function getHiredTalent(): JsonResponse
    {
        try {
            $talents = Showcase::with(['talent','talent.skills'=> function ($query) {
                $query->with('skill');
            }])->where("user_id", auth()->user()->id)->where('status', 1)->get();
            // ->groupBy('talent.category.title')->all()
            return ResponseController::response(true, $talents, Response::HTTP_OK);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
    * Get  talents by saved by a user
    * @return JsonResponse
    */
    public function getSavedTalent(): JsonResponse
    {
        try {
            $talent = SavedProfile::with(['talent','talent.skills'=> function ($query) {
                $query->with('skill');
            }])->where("user_id", auth()->user()->id)->paginate(10);
            return ResponseController::response(true, $talent, Response::HTTP_OK);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
    /**
    * Remove user's saved talents
    * @return JsonResponse
    */
    public function removeSavedTalent($talentId): JsonResponse
    {
        try {
            SavedProfile::where("user_id", auth()->user()->id)->where('talent_id', $talentId)->delete();
            return ResponseController::response(true, 'Remove', Response::HTTP_OK);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
