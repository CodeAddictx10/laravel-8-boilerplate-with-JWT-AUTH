<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TalentSkill;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ResponseController;
use App\Models\LatestSearch;
use App\Http\Requests\SearchTalentFormRequest;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    /**
    * search talents by user's recent search
    * @return JsonResponse
    */
    public function filterTalentsByLatestSearch():JsonResponse
    {
        $latestSearch = LatestSearch::where('user_id', auth()->user()->id)->latest()->first(['category_id','skills','level','availability']);

        if (!$latestSearch) {
            return ResponseController::response(false, 'No talent found', Response::HTTP_NOT_FOUND);
        }

        $talents = $this->search($latestSearch->category_id, $latestSearch->skills, $latestSearch->level, $latestSearch->availability);
        return ResponseController::response(true, $talents, Response::HTTP_OK);
    }
    /**
     * search talents by user's recent search
     * @param SearchTalentFormRequest
     * @return JsonResponse
     */
    public function filterTalentsBySkill(SearchTalentFormRequest $request):JsonResponse
    {
        $skill = $request->safe()->only(['skill']);
        $talents = TalentSkill::with('skill', 'talent')->whereHas('skill', function (Builder $query) use ($skill) {
            $query->where('title', $skill);
        })->WhereHas('talent', function (Builder $query) {
            $query->where('status', 0);
        })
        ->inRandomOrder()
        ->limit(10)
        ->get();
        return ResponseController::response(true, $talents, Response::HTTP_OK);
    }

    /**
     * search talent for unauth user's
     * @param HireFormRequest $request
     * @return JsonResponse
     */
    public function filterTalents(SearchTalentFormRequest $request):JsonResponse
    {
        $validated = $request->safe()->only(['category_id','skills','level','availability']);
        $talents = $this->search($validated['category_id'], $validated['skills'], $validated["level"], $validated["availability"]);
        return ResponseController::response(true, $talents, Response::HTTP_OK);
    }

    /**
     * save user's search query
     * @param HireFormRequest $request
     * @return JsonResponse
     */
    public function store(SearchTalentFormRequest $request):JsonResponse
    {
        $validated = $request->safe()->only(['category_id','skills','level','availability','workplace','duration','available_in']);
        $validated["user_id"] = auth()->user()->id;
        $talents = $this->search($validated['category_id'], $validated['skills'], $validated["level"], $validated["availability"]);

        try {
            LatestSearch::create($validated);
            return ResponseController::response(true, $talents, Response::HTTP_CREATED);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * serach for talent that suit a client
     * @param int $category
     * @param array $skills
     * @param string $level
     * @param string $avail
     * @return mixed
     */
    public function search(int $category_id, array $skills, string $level, string $avail):mixed
    {
        $talents = TalentSkill::with(['skill', 'talent', 'talent.skills'=> function ($query) {
            $query->with('skill');
        }])->whereHas('skill', function (Builder $query) use ($skills) {
            $query->WhereIn('title', $skills);
        })->WhereHas('talent', function (Builder $query) use ($level, $avail, $category_id) {
            $query->where('category_id', $category_id)->where('level', $level)->where('status', 0)->orWhere('availability', $avail);
        })
        ->inRandomOrder()
        ->limit(10)
        ->get();
        return $talents;
    }
}
