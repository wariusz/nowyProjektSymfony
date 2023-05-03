<?php

namespace App\Controller;

use App\Service\CurrencyRateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyRateController extends AbstractController
{
    #[Route('/currency/rate', name: 'app_currency_rate')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CurrencyRateController.php',
        ]);
    }

    /**
     * @Route("/api/currency-rates", name="add_currency_rate", methods={"POST"})
     */
    public function addCurrencyRate(Request $request, CurrencyRateService $currencyRateService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $currency = $data['currency'] ?? null;
        $rate = $data['rate'] ?? null;
        $date = $data['date'] ?? null;

        if (!$currency || !$rate || !$date) {
            return new JsonResponse(['error' => 'Invalid request data.'], Response::HTTP_BAD_REQUEST);
        }

        $currencyRate = $currencyRateService->addCurrencyRate($currency, $rate, $date);

        return new JsonResponse(['id' => $currencyRate->getId()], Response::HTTP_CREATED);
    }

}
