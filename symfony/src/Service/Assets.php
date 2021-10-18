<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Asset;

class Assets
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getTotalUsd($repository)
    {
        $assets = $repository->findAll();

        $totalUsd = 0;

        foreach ($assets as $asset) {
            if ($asset->getCurrency() === 'BTC') {
                $currencyData = $this->getCurrencyData('90');
                $usd = $asset->getAmount() * floatval($currencyData[0]['price_usd']);

                $totalUsd += $usd;
            } else if ($asset->getCurrency() === 'ETH') {
                $currencyData = $this->getCurrencyData('80');
                $usd = $asset->getAmount() * floatval($currencyData[0]['price_usd']);

                $totalUsd += $usd;
            } else if ($asset->getCurrency() === 'IOTA') {
                $currencyData = $this->getCurrencyData('447');
                $usd = $asset->getAmount() * floatval($currencyData[0]['price_usd']);

                $totalUsd += $usd;
            }
        }

        return number_format($totalUsd, 2, '.', '');
    }

    public function getAssetUsd(Asset $asset)
    {
        if ($asset->getCurrency() === 'BTC') {
            $currencyData = $this->getCurrencyData('90');
            $usd = $asset->getAmount() * floatval($currencyData[0]['price_usd']);
        } else if ($asset->getCurrency() === 'ETH') {
            $currencyData = $this->getCurrencyData('80');
            $usd = $asset->getAmount() * floatval($currencyData[0]['price_usd']);
        } else if ($asset->getCurrency() === 'IOTA') {
            $currencyData = $this->getCurrencyData('447');
            $usd = $asset->getAmount() * floatval($currencyData[0]['price_usd']);
        }

        return number_format($usd, 2, '.', '');
    }

    public function getCurrencyData(string $id)
    {
        $response = $this->client->request('GET', 'https://api.coinlore.net/api/ticker', [
            'query' => [
                'id' => $id,
            ],
        ]);

        return $response->toArray();
    }
}