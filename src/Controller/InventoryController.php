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
    #[Route('/entityInventory', name: 'inventory', methods: ["POST"])]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $inventory = $request->request->get('name');
        $peopleRepository = $entityManager->getRepository(inventory::class);
        $inventory = $peopleRepository->findOneBy(['name' => $inventory]);

        $entityManager->remove($inventory);
        $entityManager->flush();
        return new Response('Пользователь с именем' . $inventory->getName() . 'и весь его инвентарь был удален.');
    }
     #[Route('/entityInventory', name: 'Inventory', methods: ["POST"])]
     public function update( Request $request, EntityManagerInterface $entityManager): Response 
     {
    $oldName = $request->request->get('old_name'); 
    $newNazvanie  = $request->request->get('new_nazvanie'); 
    $repository = $entityManager->getRepository(Inventory::class);
    $Inventory = $repository->findOneBy(['name' => $oldName]);
    $Inventory->setNazvanie($newNazvanie);

    $entityManager->flush();

    return new Response('Данные обновлены');
     }
    #[Route('/forminventory', name: 'forminventory')]
    public function formplayer(): Response
    {

        return $this->render('inventory.html.twig', []);
    }
}
