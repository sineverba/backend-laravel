<?php


namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends ApiController
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
     * @OA\Post(
     *   path="/api/v1/refresh",
     *   summary="Perform token refresh",
     *   tags={"Authentication"},
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *          required={"token"},
     *          @OA\Property(
     *              property="token",
     *              description="Previous token",
     *              type="string",
     *              example="eya1.b2.c3",
     *          ),
     *       ),
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Sucessful refresh",
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
     *              example="Token could not be parsed from the request."
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

    /**
     * Refresh the token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            $token = auth()->refresh();
            return $this->getToken($token);
        } catch (JWTException $e) {
            return response()->json($this->getErrorMessage($e->getMessage()), 401);
        }
    }
}
