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
                $validated = $request->safe()->only(['talentId', 'meeting_link', 'test_link', 'date']);
                $validated["time"] = $request->safe()->only(["time"])." ".$request->safe()->only(["timezone"]);
                $validated["user_id"] = auth()->user()->id;
                $validated["status"] = 2;
                Showcase::create($validated);
                //send out an email to talent for availability
                return ResponseController::response(true, "Saved", Response::HTTP_CREATED);
                break;
            case 'not interested':
                $validated = $request->safe()->only(['talentId']);
                $validated["user_id"] = auth()->user()->id;
                $validated["status"] = 4;
                Showcase::create($validated);
                //send out an email to talent for availability
                return ResponseController::response(true, "Saved", Response::HTTP_CREATED);
                break;
            case 'save':
                $validated = $request->safe()->only(['talentId']);
                $validated["user_id"] = auth()->user()->id;
                SavedProfile::create($validated);
                return ResponseController::response(true, "Saved", Response::HTTP_CREATED);
                break;

            default:
                 return ResponseController::response(true, "No action given", Response::HTTP_BAD_REQUEST);
                break;
        }
    }
}
