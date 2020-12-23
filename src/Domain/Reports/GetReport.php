<?php

namespace EolabsIo\AmazonMws\Domain\Reports;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\Response;
use EolabsIo\AmazonMws\Domain\Reports\ReportCore;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportId;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;

class GetReport extends ReportCore
{
    use InteractsWithReportId;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([
            $this->getReportIdParameter(),
        ]);
    }

    public function getAction(): string
    {
        return 'GetReport';
    }

    public function getResultsFromResponseParser(Response $response): Collection
    {
        $contentMd5 = $response->header('Content-MD5');
        $md5 = md5($response->body());

        if ($contentMd5 != $md5) {
            throw new Exception("MD5 Error Processing Request");
        }

        return AmazonMwsResponseParser::fromString($response->body());
    }
}
