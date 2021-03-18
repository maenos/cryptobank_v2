<?php

namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApi
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function content():array
    {
        $response = $this->client->request(
            'GET',
'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin%2Cethereum%2Clitecoin&order=market_cap_desc&per_page=100&page=1&sparkline=false&price_change_percentage=24h'
        );
/*
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
*/
        return $response->toArray();
    }

}