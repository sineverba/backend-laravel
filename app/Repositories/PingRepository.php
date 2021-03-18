<?php


namespace App\Repositories;

use App\Interfaces\PingInterface;

/**
 * @OA\Schema(
 *   schema="PingSchema",
 *   title="Ping",
 *   description="Ping model",
 *   @OA\Property(
 *          property="data",
 *          description="Ping status",
 *          type="string",
 *          @OA\Items(
 *               @OA\Property(
 *                  property="app_version", description="Backend current version", type="string", example="1.0.0"
 *               ),
 *          ),
 *   ),
 * )
 */

class PingRepository implements PingInterface
{
    public function index():array
    {
        $data = array();

        $data['app_version'] = env('APP_VERSION', '0.0.1');

        return $data;
    }
}
