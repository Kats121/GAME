<?php

namespace App\Controller;

use App\Entity\Inventory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\InventoryRepository;

class InventoryController extends AbstractController
{
    #[Route('/entityInventory', name: 'inventory', methods: ["POST"])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $name = $request->request->get('name');
        $nazvanie = $request->request->get('nazvanie');

        $inventory= new Inventory();
        $inventory->setname($name);   
        $inventory->setNazvanie($nazvanie);

        $entityManager->persist($inventory);
        $entityManager->flush();
        return new Response('Предмет добавлен в инвентарь игрока: ' . $inventory->getId());
    }
    #[Route('/forminventory', name: 'forminventory')]
    public function formplayer(): Response
    {

        return $this->render('inventory.html.twig', []);
    }
}
