<?php


namespace App\Http\Controllers\Api;


class SwaggerController
{
    /**
     * @OA\Info(
     *      version=APP_VERSION,
     *      title="Backend Laravel Api documentation",
     *      description="Backend Laravel API description",
     *      @OA\Contact(
     *          email="info@example.com"
     *      ),
     *      @OA\License(
     *          name="MIT"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Api Server"
     * )
     *
     */
}
