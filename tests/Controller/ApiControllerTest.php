<?php

namespace App\Tests\Controller;

use App\Controller\ApiController;
use PHPUnit\Framework\TestCase;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiControllerTest extends TestCase
{
    /**
     * @param string|null $message
     * @param JsonResponse $expectedRespond
     *
     * @return void
     * @dataProvider providerRespondValidationError
     */
    public function testRespondValidationError(?string $message, JsonResponse $expectedRespond) : void
    {
        $apiController = new ApiController();
        $actualRespond = (
            $message ?
                $apiController->respondValidationError($message) :
                $apiController->respondValidationError()
        );

        $this->assertEquals($expectedRespond, $actualRespond);
    }

    /**
     * @return array|array[]
     */
    public function providerRespondValidationError() : array
    {
        return [
            // Test with default message
            __LINE__ => [
                'message' => null,
                'expectedRespond' => new JsonResponse(
                    ['errors' => 'Validation error!'],
                    422
                )
            ],
            // Test with custom error message
            __LINE__ => [
                'message' => 'A validation error has been encountered!',
                'expectedRespond' => new JsonResponse(
                    ['errors' => 'A validation error has been encountered!'],
                    422
                ),
            ],
        ];
    }

    /**
     * @param string|null $message
     * @param JsonResponse $expectedRespond
     * @return void
     * @dataProvider providerRespondUnauthorized
     */
    public function testRespondUnauthorized(?string $message, JsonResponse $expectedRespond) : void
    {
        $apiController = new ApiController();
        $actualRespond = (
            $message ?
                $apiController->respondUnauthorized($message) :
                $apiController->respondUnauthorized()
        );

        $this->assertEquals($expectedRespond, $actualRespond);
    }

    /**
     * @return array|array[]
     */
    public function providerRespondUnauthorized() : array
    {
        return [
            // Test with default message
            __LINE__ => [
                'message' => null,
                'expectedRespond' => new JsonResponse(
                    ['errors' => 'Not authorized!'],
                    401
                )
            ],
            // Test with custom error message
            __LINE__ => [
                'message' => 'Authorization failed!',
                'expectedRespond' => new JsonResponse(
                    ['errors' => 'Authorization failed!'],
                    401
                ),
            ],
        ];
    }

    /**
     * @param array $data
     * @param JsonResponse $expectedRespond
     * @return void
     */
    public function testRespondCreated() : void
    {
        $data = [
            'key' => 'value',
        ];
        $this->assertEquals(
            new JsonResponse($data,201),
            (new ApiController())->respondCreated($data)
        );
    }

    /**
     * @param string|null $message
     * @param JsonResponse $expectedRespond
     * @return void
     * @dataProvider providerRespondNotFound
     */
    public function testRespondNotFound(?string $message, JsonResponse $expectedRespond) : void
    {
        $apiController = new ApiController();
        $actualRespond = $message ?
            $apiController->respondNotFound($message) :
            $apiController->respondNotFound()
        ;
        $this->assertEquals($expectedRespond, $actualRespond);
    }

    /**
     * @return array|array[]
     */
    public function providerRespondNotFound() : array
    {
        return [
            // Test with default message
            __LINE__ => [
                'message' => null,
                'expectedRespond' => new JsonResponse(
                    ['errors' => 'Not found!'],
                    404
                )
            ],
            // Test with custom error message
            __LINE__ => [
                'message' => 'Entity could not be found!',
                'expectedRespond' => new JsonResponse(
                    ['errors' => 'Entity could not be found!',],
                    404
                ),
            ],
        ];
    }

    /**
     * @param array $errors
     * @param array $headers
     * @param JsonResponse $expectedRespond
     * @return void
     * @dataProvider providerRespondWithErrors
     */
    public function testRespondWithErrors(string $errors, array $headers, JsonResponse $expectedRespond) : void
    {
        $this->assertEquals($expectedRespond, (new ApiController())->respondWithErrors($errors, $headers));
    }

    public function providerRespondWithErrors()
    {
        $customHeaders = [
            'First custom header',
            'Second custom header'
        ];

        return [
            // Test with default values
            __LINE__ => [
                'errors' => 'There is something wrong',
                'headers' => [],
                'expectedRespond' => new JsonResponse(['errors' => 'There is something wrong']),
            ],

            // Test with customized headers
            __LINE__ => [
                'errors' => 'There is something wrong',
                'headers' => $customHeaders,
                'expectedResponse' => new JsonResponse(
                    ['errors' => 'There is something wrong'],
                    200,
                    $customHeaders
                ),
            ],
        ];
    }
}
