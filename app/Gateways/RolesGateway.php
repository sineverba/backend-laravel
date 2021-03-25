<?php


namespace App\Gateways;

use App\Interfaces\RolesInterface;
use Illuminate\Support\Facades\Validator;

class RolesGateway extends BaseGateway
{
    public function __construct(RolesInterface $interface)
    {
        $this->setInterface($interface);
    }

    public function store($payload)
    {
        $rules = [
            'role' => [
                'required',
                'unique:roles'
            ]
        ];
        $validator = Validator::make($payload, $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }
        return $this->getInterface()->store($payload);
    }
}
