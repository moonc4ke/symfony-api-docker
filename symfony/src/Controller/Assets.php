<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Asset;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Assets as AssetsService;

/**
 *  @Route("/api/assets/usd")
 */
class Assets extends AbstractController
{
    /** 
     * @var AssetsService 
     */
    private $assetsService;

    public function __construct(AssetsService $assetsService)
    {
        $this->assetsService = $assetsService;
    }

     /**
     * @Route("/", name="api_all_assets_usd", methods={"GET"})
     */
    public function getAction(): JsonResponse
    {
        $repository = $this->getDoctrine()->getRepository(Asset::class);
        $totalUsd = $this->assetsService->getTotalUsd($repository);
        
        return $this->json([
            'total_usd' => $totalUsd
        ]);
    }

    /**
     * @Route("/{id}", name="api_asset_usd", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function getAssetAction(Asset $asset): JsonResponse
    {
        $usd = $this->assetsService->getAssetUsd($asset);
        
        return $this->json([
            'asset_usd' => $usd
        ]);
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