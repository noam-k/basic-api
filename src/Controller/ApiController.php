<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @param int $statusCode
     * @return ApiController
     */
    public function setStatusCode(int $statusCode): ApiController
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * @param array $data
     * @param array $headers
     * @return JsonResponse
     */
    public function respond($data, $headers = []): JsonResponse
    {
        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param string $errors
     * @param array $headers
     * @return JsonResponse
     */
    public function respondWithErrors(string $errors, array $headers = []): JsonResponse
    {
        $data = [
            'errors' => $errors,
        ];

        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondUnauthorized(string $message = 'Not authorized!'): JsonResponse
    {
        return $this->setStatusCode(401)->respondWithErrors($message);
    }
}
