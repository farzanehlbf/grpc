<?php

use Google\Protobuf\Timestamp;
use GRPC\Ping\PingRequest;
use GRPC\Ping\PingResponse;
use GRPC\Ping\PingServiceInterface;
use Spiral\RoadRunner\GRPC;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class PingService implements PingServiceInterface
{


    public function __construct(
        private readonly HttpClientInterface $httpClient
    )
    {

    }

    public function PingUrl(GRPC\ContextInterface $ctx, PingRequest $in): PingResponse
    {
        $httpResponse = $this->httpClient->request(
            'GET', $in->getUrl()
        );

        $response = new PingResponse();
        $response->setStatus($httpResponse->getStatusCode());

        $createAt=new Timestamp();
        $createAt->fromDateTime(new \DateTime());
        $response->setCreatedAt($createAt);
        return $response;
    }
}
