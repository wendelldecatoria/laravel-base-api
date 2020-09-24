<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

class ApiController extends Controller {

    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respond($message = 'Success', $data = "", $headers = [])
    {
        return Response::json([
            'message' => $message,
            'status_code' => $this->statusCode,
            'data' => $data
        ], $this->getStatusCode(), $headers)
    }

    public function respondWithError($message, $data = [])
    {
        return Response::json([
            'error' => [
                'message' => $message,
                'status_code' => $this->statusCode,
                'data' => $data
            ]
        ]);
    }


     


}