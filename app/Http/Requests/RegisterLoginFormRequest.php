<?php

namespace App\Http\Requests;

use App\Http\Controllers\ResponseController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class RegisterLoginFormRequest extends FormRequest
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
        if ($this->routeIs('login')) {
            return [
                'email'=>'required|email',
                'password'=>'required|min:6|max:50',
            ];
        }
        return [
            'full_name'=>'required|min:3|max:225',
            'email'=>'required|email|unique:users,email',
            'phone_number'=>'required|unique:users,phone_number',
            'password'=>'required|min:6|max:50',
            'company'=>'required|max:255',
            'country_id'=>'required|integer',
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
        'full_name.required' => 'Fullname is required',
        'full_name.min' => 'Fullname must be minimum of 3 characters',
        'full_name.max' => 'Fullname must be maximum of 225 characters',
        'email.required' => 'An email is required',
        'email.email' => 'Please enter a valid email',
        'email.unique' => 'Email provided has been used',
        'phone_number.required' => 'Phone_number is required',
        'phone_number.unique' => 'Phone number provided has been used',
        'password.required' => 'Your password is required',
        'password.min' => 'Password must be minimum of 6 characters',
        'password.max' => 'Password must be maximum of 50 characters',
        'company.required'=>'Please enter your company',
        'company.max' => 'Company must be maximum of 225 characters',
        'country_id.required'=>'Please select your country',
        'country_id.integer'=>'An integer is required'

    ];
    }
}
