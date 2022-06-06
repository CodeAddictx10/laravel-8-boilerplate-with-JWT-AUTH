<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ResponseController;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class HireTalentFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
    * Indicates if the validator should stop on the first rule failure.
    *
    * @var bool
    */
    protected $stopOnFirstFailure = true;

    /**
     * Custom response message
     * @return JsonResponse
     */
    public function failedValidation(Validator $validator):JsonResponse
    {
        $response = ResponseController::response(false, $validator->errors()->all()[0], Response::HTTP_BAD_REQUEST);
        throw new ValidationException($validator, $response);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

          /**
         * For users to get by skills by one or more categories
         */
        if ($this->routeIs('getSkillsByCategories')) {
            return [
                'categories'=>'required|array',
            ];
        }

        /**
         * For users to update already interacted talent records
         */

        if ($this->routeIs('updateTalent')) {
            return [
                'action'=>'required|string|in:hire,schedule an interview,save profile,not interested',
                'talent_id'=>'required|exists:talents,id',
            ];
        }

        //schedule an interview
        return [
            'action'=>'required|string|in:schedule an interview,save profile,not interested',
            'talent_id'=>'required|exists:talents,id',
            'meeting_link'=>'required_if:action,schedule an interview|url',
            'date'=>'required_if:action,schedule an interview|date',
            'time'=>'required_if:action,schedule an interview',
            'timezone'=>'required_if:action,schedule an interview',
            'test_link'=>'sometimes|required|url',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
        'categories.required'=>'Categories parameter is required',
        'categories.array'=>'Categories parameter is must be type of an array',
        'action.required'=>'Action parameter is required',
        'action.in'=>'Action must be either be schedule an interview, save profile or not interested',
        'talent_id.required'=>'Talent Id is required',
        'talent_id.exists'=>'Talent Id does not exists',
        'meeting_link.required_if'=>'Interview meeting link is required',
        'meeting_link.url'=>'Interview meeting link must be a valid URL',
        'test_link.required'=>'Interview test link is required',
        'test_link.url'=>'Interview test link must be a valid URL',
        'date.required_if'=>'Interview date is required',
        'date.date'=>'Interview date must be a valid date',
        'time.required_if'=>'Interview time is required',
        'timezone.required_if'=>'Interview timezone is required',
    ];
    }
}
