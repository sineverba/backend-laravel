<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $gateway;

    private $success_created_message = [
        'success' => 'created'
    ];

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    protected function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    private function getGateway()
    {
        return $this->gateway;
    }

    private function getSuccessCreatedMessage()
    {
        return $this->success_created_message;
    }

    protected function getErrorMessage($message = null)
    {
        return [
            'error' => $message,
        ];
    }

    /**
     * Return all resources
     * @return mixed
     */

    protected function index()
    {
        return $this->getGateway()->index();
    }

    /**
     * Create new resource
     */
    protected function store(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $store = $this->getGateway()->store($payload);
        if ($store === true) {
            return response()->json($this->getSuccessCreatedMessage(), 201);
        }
        return response()->json($store, 400);
    }

    /**
     * Show single resource
     */
    protected function show($id)
    {
        return $this->getGateway()->show($id);
    }
}
