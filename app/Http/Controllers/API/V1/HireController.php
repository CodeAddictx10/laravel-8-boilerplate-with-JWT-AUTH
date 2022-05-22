<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\HireFormRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Hire;
use App\Models\TalentSkill;
use Illuminate\Database\Eloquent\Builder;

class HireController extends Controller
{

    /**
     * @param HireFormRequest $request
     * @return JsonResponse
     */
    public function filterTalents(HireFormRequest $request):JsonResponse
    {
        $validated = $request->safe()->only(['category_id','skills','level','availability']);
        $talents = TalentSkill::with('skill', 'talent')->whereHas('skill', function (Builder $query) use ($validated) {
            $query->where('category_id', $validated["category_id"])->WhereIn('title', $validated["skills"]);
        })->WhereHas('talent', function (Builder $query) use ($validated) {
            $query->where('level', $validated["level"])->where('status', 0)->orWhere('availability', $validated["availability"]);
        })
        ->inRandomOrder()
        ->get();
        return ResponseController::response(true, $talents, Response::HTTP_OK);
    }
    /**
     * @param HireFormRequest $request
     * @return JsonResponse
     */
    public function store(HireFormRequest $request):JsonResponse
    {
        $validated = $request->safe()->only(['category_id','skills','level','availability','workplace','duration','available_in']);
        $validated["user_id"] = auth()->user()->id;
        try {
            Hire::create($validated);
            return ResponseController::response(true, 'Posted', Response::HTTP_CREATED);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
