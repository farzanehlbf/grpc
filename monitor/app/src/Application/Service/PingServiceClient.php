<?php
declare(strict_types=1);

namespace App\Application\Service;

use Grpc\BaseStub;
use GRPC\Ping\PingServiceInterface;
use Spiral\RoadRunner\GRPC\ContextInterface;
use Spiral\RoadRunner\GRPC\Exception\GRPCException;
use Spiral\RoadRunner\GRPC\StatusCode;

final class PingServiceClient  extends BaseStub  implements PingServiceInterface
{

    public function PingUrl(ContextInterface $ctx, \GRPC\Ping\PingRequest $in): \GRPC\Ping\PingResponse
    {

        return $this->sendRequest(
            '/'.self::NAME.'/PingUrl',
            $in,
            \GRPC\Ping\pingResponse::class,
        );

    }

    public function sendRequest(string $method, \GRPC\Ping\PingRequest $in, string $response): \GRPC\Ping\PingResponse
    {
        [$response, $status] = $this->_simpleRequest
        (
            $method,
            $in,
            [$response,'decode'])
            ->wait();



        $code = $status->code ?? StatusCode::UNKNOWN;

        if ($code !== StatusCode::OK) {
            throw new GRPCException(
                message:$status->details ,
                code: $status->code
            );
        }

        return $response;
    }



}
