<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockController extends AbstractController
{
    #[Route('/newStock', name: 'new_stock')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stock = new Stock();
        $form = $this->createForm(StockFormType::class, $stock);
        $form->handleRequest($request);
        $stock->setCreatedDate(new \DateTimeImmutable("now"));

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($stock);
            $entityManager->flush();

            return $this->render('stock/index.html.twig', ['newStock' => true]);
        }

        return $this->render('stock/index.html.twig', [
            'stockForm' => $form->createView(),
        ]);
    }
    #[Route('/showStocks', name: 'show_stocks')]
    public function showStocks(EntityManagerInterface $entityManager) : Response
    {
        $stocks = $entityManager->getRepository(Stock::class)->findAll();

        return $this->render('stock/showStocks.html.twig', [
            'stocks' => $stocks,
        ]);
    }
}
