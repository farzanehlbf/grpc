<?php
declare(strict_types=1);
namespace App\Api\Cli\Command;

final class PingServiceCommand extends \Spiral\Console\Command
{
    protected const SIGNATURE  = 'ping {url=https://google.com:Url to ping}';
    protected const DESCRIPTION = 'Ping Service';

    public function __invoke(
        \GRPC\Ping\PingServiceInterface $client,
    ): int
    {
        $response=$client->PingUrl(
            new \Spiral\RoadRunner\GRPC\Context([]),
            new \GRPC\Ping\PingRequest(['url'=>$this->argument('url')])
        );
        $this->writeln(sprintf(
            'Response: code - %d , date',
            $response->getStatus(),
            $response->getCreatedAt()->toDateTime()->format('Y-m-d H:i:s')
        ));
        return self::SUCCESS;
    }
}
