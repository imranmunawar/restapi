<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class APIController extends Controller
{
    protected $statusCode;
    const HTTP_NOT_FOUND = 404;
    const HTTP_CONFLICT = 409;
    const HTTP_UNAUTHORIZE = 401;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_INTERNAL_ERROR = 500;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_CREATED = 201;
    const HTTP_OK = 200;
    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    public function respondConflict($message = 'Record already exists')
    {
        // in cases such like record already exist on POST request
        return $this->setStatusCode(self::HTTP_CONFLICT)->respondWithError($message);
    }
    public function respondUnAuthorize($message = 'Authentication failed!')
    {
        return $this->setStatusCode(self::HTTP_UNAUTHORIZE)->respondWithError($message);
    }
    public function respondBadRequest($message = 'Bad Request')
    {
        return $this->setStatusCode(self::HTTP_BAD_REQUEST)->respondWithError($message);
    }
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(self::HTTP_NOT_FOUND)->respondWithError($message);
    }
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(self::HTTP_INTERNAL_ERROR)->respondWithError($message);
    }
    public function respondUnProcessableEntity($message = 'Parameters validation failed')
    {
        return $this->setStatusCode(self::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }
    public function respondCreated($message = 'Record has been created')
    {
        return $this->setStatusCode(self::HTTP_CREATED)->respondWithMsgOnly($message);
    }
    public function respondUpdated($message)
    {
        return $this->setStatusCode(self::HTTP_OK)->respondWithMsgOnly($message);
    }
    public function respondOK($data)
    {
        return $this->setStatusCode(self::HTTP_OK)->respondWithData($data);
    }
    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers, JSON_UNESCAPED_UNICODE);
    }
    public function respondWithError($message)
    {
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ],$header);
    }
    public function respondWithMsgOnly($message)
    {
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return $this->respond([
            'message' => $message,
            'status_code' => $this->getStatusCode()
        ],$header);
    }
    public function respondWithData($data)
    {
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        return $this->respond([
            'data' => $data,
            'status_code' => $this->getStatusCode()
        ],$header);
    }
}
