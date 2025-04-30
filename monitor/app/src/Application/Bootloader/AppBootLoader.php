<?php

namespace App\Application\Bootloader;

use GRPC\Ping\PingServiceClient;
use GRPC\Ping\PingServiceInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\EnvironmentInterface;
use Grpc\ChannelCredentials;

class AppBootLoader extends Bootloader
{
    protected const SINGLETONS = [
        PingServiceInterface::class => [self::class, 'initPingService'],
    ];

    private function initPingService(EnvironmentInterface $env): PingServiceInterface
    {
        return new PingServiceClient(
            $env->get('PING_SERVICE_HOST', '127.0.0.1:9001'),
            ['credentials' => ChannelCredentials::createInsecure()]
        );

    }
}
