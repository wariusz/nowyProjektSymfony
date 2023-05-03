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
}
