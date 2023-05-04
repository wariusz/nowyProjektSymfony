<?php

namespace App\Service;

use App\Entity\CurrencyRate;
use Doctrine\ORM\EntityManagerInterface;

class CurrencyRateService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addCurrencyRate(string $currency, float $rate, string $date): CurrencyRate
    {
        $currencyRate = new CurrencyRate();
        $currencyRate->setCurrency($currency);
        $currencyRate->setRate($rate);
        $currencyRate->setDate($date);

        $this->entityManager->persist($currencyRate);
        $this->entityManager->flush();

        return $currencyRate;
    }

    public function getCurrencyRatesByDate(string $date): array
    {
        $repository = $this->entityManager->getRepository(CurrencyRate::class);

        $currencyRates = $repository->findBy(['date' => $date]);

        return $currencyRates;
    }

}
