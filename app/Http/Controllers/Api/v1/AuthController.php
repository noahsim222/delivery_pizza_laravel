<?php

namespace App\Http\Controllers\Api\v1;

/**
 * Class OtpController
 * @package App\Http\Controllers\Api\v1
 */
class AuthController extends Controller
{
    /**
     * Create a new otp code
     *
     * @return \Illuminate\Http\Response
     */
    public function otp()
    {
        return response()->json([
            'message' => 'Email sent to u****@mail.com',
            'code' => 20000,
            'data' => [
                'sid' => 'SECRET_TOKEN_OF_SESSION'
            ]
        ]);
    }

    /**
     * Check otp code
     *
     * @return \Illuminate\Http\Response
     */
    public function checkOtp()
    {
        return response()->json([
            'message' => 'Success',
            'code' => 20000,
            'data' => [
                'username' => 'user@mail.com',
                'token' => 'TOKEN'
            ],
        ]);
    }

    /**
     * Check token user
     *
     * @return \Illuminate\Http\Response
     */
    public function checkToken()
    {
        return response()->json([
            'message' => 'Success',
            'code' => 20000,
        ]);
    }
}
