<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 * @package App\Http\Controllers\v1
 */
class AuthController extends Controller
{

    /**
     * Logout api user by revoking access tokens
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logOut()
    {
        Auth::user()->token()->revoke();
        return $this->sendResponse([], '', 204);
    }
}
