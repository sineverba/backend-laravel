<?php


namespace App\Exceptions;

use Exception;

class UnableToFoundTokenException extends Exception
{
    public function render()
    {
        return response()->json(
            [
                'error' => 'Unauthenticated'
            ],
            401
        );
    }
}
