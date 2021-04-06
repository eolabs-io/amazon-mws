<?php

namespace EolabsIo\AmazonMws\Tests\Factories\Concerns;

use TwoCaptcha\ApiClient;
use TwoCaptcha\TwoCaptcha;

trait CreatesSolverMock
{
    public function createSolverMock()
    {
        $captchaId = '98765';
        $apiKey = env('TWO_CAPTCHA_API_KEY');
        $code = '123456';

        $apiClient = $this->createMock(ApiClient::class);

        $data['sendParams']['key'] = $apiKey;
        $data['sendParams']['method'] = 'post';

        $apiClient
            ->expects($this->once())
            ->method('in')
            ->with(
                $this->equalTo($data['sendParams'])
            )
            ->willReturn('OK|' . $captchaId);

        $apiClient
            ->expects($this->once())
            ->method('res')
            ->with($this->equalTo(['action' => 'get', 'id' => $captchaId, 'key' => $apiKey]))
            ->willReturn('OK|' . $code);

        $solver = new TwoCaptcha([
            'apiKey' => env('TWO_CAPTCHA_API_KEY'),
            'pollingInterval' => 1,
        ]);
        $solver->setHttpClient($apiClient);

        return $solver;
    }
}
