<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\AppBaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends AppBaseController
{
    public function index(Request $request)
    {
        try {
            return $this->sendSuccess(Auth::user());
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }
}
