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
     * Save user's and talent when user interact with talent profile
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
                $validated = $request->safe()->only(['talentId']);
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

    /**
     * Update user's and talent when user interact with talent profile
     *@param HireTalentFormRequest
     * @return JsonResponse
     */
    public function update(HireTalentFormRequest $request):JsonResponse
    {
        $action = $request->safe()->only(["action"])["action"];
        $talentId = $request->safe()->only(['talent_id'])["talent_id"];
        $userId = auth()->user()->id;

        switch ($action) {
            case 'hire':
               $hired = Showcase::where('talent_id', $talentId)->where('status', 2)->where('user_id', $userId)->update(["status"=>1]);
                if (!$hired) {
                    return ResponseController::response(false, "Talent can not be hired", Response::HTTP_NOT_ACCEPTABLE);
                }
                //send out an email to talent for availability
                return ResponseController::response(true, "Hired", Response::HTTP_OK);
                break;
            case 'not interested':
                Showcase::updateOrCreate(
                    ['status' => 4],
                    ['talent_id' => $talentId, 'status' => 2, 'user_id'=>$userId]
                );
                return ResponseController::response(true, "Saved", Response::HTTP_OK);
                break;
            case 'save':
                $recordExist = SavedProfile::where('user_id', $userId)->where('talent_id', $talentId)->exists();
                if (!$recordExist) {
                    SavedProfile::create(['talent_id' => $talentId, 'user_id'=>$userId]);
                }
                return ResponseController::response(true, "Saved", Response::HTTP_CREATED);
                break;

            default:
                 return ResponseController::response(true, "No action given", Response::HTTP_BAD_REQUEST);
                break;
        }
    }
}
