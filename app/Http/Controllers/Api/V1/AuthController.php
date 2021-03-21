<?php


namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

class AuthController
{
    /**
     * @OA\Post(
     *   path="/api/v1/login",
     *   summary="Perform Login",
     *   tags={"Authentication"},
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *          required={"email", "password"},
     *          @OA\Property(
     *              property="email",
     *              description="Email",
     *              type="string",
     *              example="info@example.com",
     *          ),
     *          @OA\Property(
     *              property="password",
     *              description="password",
     *              type="string",
     *              example="password123456",
     *          ),
     *       ),
     *   ),
     *   @OA\Response(
     *      response=201,
     *      description="Sucessful login",
     *      @OA\JsonContent(
     *          @OA\Property(
     *              property="access_token",
     *              description="The token",
     *              type="string",
     *              example="ey123456789.a1b2c3d4f5"
     *          ),
     *          @OA\Property(
     *              property="token_type",
     *              description="Token Type",
     *              type="string",
     *              example="bearer",
     *          ),
     *          @OA\Property(
     *              property="expires_in",
     *              description="Expiration token (in seconds)",
     *              type="number",
     *              example=3600,
     *          ),
     *      )
     *    ),
     *     @OA\Response(
     *      response=401,
     *      description="Wrong credentials",
     *      @OA\JsonContent(
     *          @OA\Property(
     *              property="error",
     *              description="The error",
     *              type="string",
     *              example="invalid username or password"
     *          ),
     *      )
     *    )
     * )
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {
        $credentials = json_decode($request->getContent(), true);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid username or password'
            ], 401);
        }
        return $this->getToken($token);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    private function getToken($token)
    {
        $json = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
        return response()->json($json);
    }
}
