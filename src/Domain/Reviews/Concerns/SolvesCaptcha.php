<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Concerns;

use TwoCaptcha\TwoCaptcha;
use Illuminate\Support\Facades\Storage;

trait SolvesCaptcha
{
    public function solveCaptcha()
    {
        // noscript img
        $noscriptImg = $this->crawler->filter('noscript > img')->image();
        $captchaImg = $this->crawler->filter('div > img')->image();

        file_get_contents($noscriptImg->getUri());

        $url = $captchaImg->getUri();
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);

        Storage::put($name, $contents);
        $path = Storage::path($name);

        $result = $this->getSolver()->normal($path);

        $form = $this->crawler->filter('form')->form();
        $form['field-keywords'] = $result->code;

        $crawler = $this->getBrowser()->submit($form);

        return $crawler->html();
    }

    public function getSolver(): TwoCaptcha
    {
        return new TwoCaptcha(env('TWO_CAPTCHA_API_KEY'));
    }
}
