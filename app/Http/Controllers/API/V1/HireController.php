<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\HireTalentFormRequest;
use App\Models\SavedProfile;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Showcase;

class HireController extends Controller
{
    /**
     *@param HireTalentFormRequest
     * @return JsonResponse
     */
    public function store(HireTalentFormRequest $request):JsonResponse
    {
        $action = $request->safe()->only(["action"])["action"];

        switch ($action) {
            case 'schedule an interview':
                $validated = $request->safe()->only(['talent_id', 'meeting_link', 'test_link', 'date', 'time', 'timezone']);
                $validated["user_id"] = auth()->user()->id;
                $validated["status"] = 2;
                Showcase::create($validated);
                //send out an email to talent for availability
                return ResponseController::response(true, "Saved", Response::HTTP_CREATED);
                break;
            case 'not interested':
                $validated = $request->safe()->only(['talent_id']);
                $validated["user_id"] = auth()->user()->id;
                $validated["status"] = 4;
                Showcase::create($validated);
                return ResponseController::response(true, "Saved", Response::HTTP_CREATED);
                break;
            case 'save profile':
                $validated = $request->safe()->only(['talent_id']);
                $validated["user_id"] = auth()->user()->id;
                SavedProfile::create($validated);
                return ResponseController::response(true, "Saved", Response::HTTP_CREATED);
                break;

            default:
                 return ResponseController::response(true, "No action given", Response::HTTP_BAD_REQUEST);
                break;
        }
    }

    public function getUserStats():JsonResponse
    {
        $hired = Showcase::where("user_id", auth()->user()->id)->where('status', 1)->count();
        $shortlisted = SavedProfile::where("user_id", auth()->user()->id)->count();
        $interviewing = Showcase::where("user_id", auth()->user()->id)->where('status', 2)->count();
        return ResponseController::response(true, ['hired'=>$hired, 'shortlist'=>$shortlisted, 'interviewed'=>$interviewing], Response::HTTP_OK);
    }
}
