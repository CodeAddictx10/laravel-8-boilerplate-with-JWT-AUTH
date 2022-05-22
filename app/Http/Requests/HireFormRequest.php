<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Controllers\ResponseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\ValidationException;

class HireFormRequest extends FormRequest
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
         * For un-auth users to get list of talents
         */
        if ($this->route()->action['as'] === 'get-talent') {
            return [
                'category_id'=>'required|exists:categories,id',
                'skills'=>'required|array',
                'level'=>'required|in:Entry-Level,Intermediate,Mid-Level',
                'availability'=>'required|in:Full-Time,Part-Time,Any'
            ];
        }
        return [
            'category_id'=>'required|exists:categories,id',
            'skills'=>'required|array',
            'level'=>'required|in:Entry-Level,Intermediate,Mid-Level',
            'availability'=>'required|in:Full-Time,Part-Time,Any',
            'workplace'=>'required|in_array:On-Site,Remote,Hybird',
            'duration'=>'required|in_array:0-3,3-6,6+',
            'available_in'=>'required|in_array:Immediately,2-4,4+'
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
            'category_id.required'=>'Category Id is required',
            'category_id.exists'=>'Category Id does not exists',
            'skills.required'=>'At least a skill is required',
            'skills.array'=>'Skills must be type of an array',
            'level.required'=>'Level is required',
            'level.in_array'=>'Level must be either be an Entry-Level, Intermediate or a Mid-Level',
            'availability.required'=>'Availability is required',
            'availability.in_array'=>'Availability must be either be a Full-Time, Part-Time or Any',
            'workplace.required'=>'Workplace is required',
            'workplace.in_array'=>'Workplace must be either be On-Site, Remote, or Hybird',
            'duration.required'=>'Duration is required',
            'duration.in_array'=>'Duration must be either be 0-3 months, 3-6 months, or 6+ months',
            'available_in.required'=>'Start time is required',
            'available_in.in_array'=>'Start time must be either be Immediately, In 2-4 weeks, or In 4+ weeks',
    ];
    }
}
