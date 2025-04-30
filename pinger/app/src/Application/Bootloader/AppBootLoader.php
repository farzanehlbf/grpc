<?php

namespace App\Application\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class AppBootLoader extends Bootloader
{
    protected const SINGLETONS=[
        HttpClientInterface::class => HttpClient::class,
    ];

}
