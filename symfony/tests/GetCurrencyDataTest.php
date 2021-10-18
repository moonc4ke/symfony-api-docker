<?php

namespace App\Tests;

use App\Service\Assets;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetCurrencyDataTest extends KernelTestCase
{
    public function testGetCurrencyDataMethod(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $assetsService = $container->get(Assets::class);

        $currencyDataArray = $assetsService->getCurrencyData(90);

        $this->assertEquals('BTC', $currencyDataArray[0]['symbol']);
    }
}
