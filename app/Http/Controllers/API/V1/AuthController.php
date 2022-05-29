<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\RegisterLoginFormRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create new user
     * @param RegisterLoginFormRequest
     * @return JsonResponse
     */
    public function register(RegisterLoginFormRequest $request): JsonResponse
    {
        $user =  $request->safe()->only(['full_name', 'email', 'phone_number', 'country_id', 'company']);
        $password = $request->safe()->only(['password'])["password"];
        $user['password'] = bcrypt($password);
        try {
            $newUser = User::create($user);
            $token = auth()->attempt($request->safe()->only(['email', 'password']));
            return ResponseController::response(true, ["token"=>$token, "user"=>$newUser], Response::HTTP_CREATED);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Login existing user
     * @param RegisterLoginFormRequest
     * @return JsonResponse
     */
    public function login(RegisterLoginFormRequest $request): JsonResponse
    {
        $token = auth()->attempt($request->safe()->only(['email', 'password']));
        if (!$token) {
            return ResponseController::response(false, "Incorrect details", Response::HTTP_UNAUTHORIZED);
        } else {
            return ResponseController::response(true, ['token' => $token, 'user' => auth()->user()], Response::HTTP_OK);
        }
    }

    /**
    * Get current auth user
    * @return JsonResponse
    */
    public function auth(): JsonResponse
    {
        try {
            $user = User::findOrFail(auth()->user()->id);
            return ResponseController::response(true, ['user' => $user], Response::HTTP_OK);
        } catch (\Exception $error) {
            return ResponseController::response(false, $error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
