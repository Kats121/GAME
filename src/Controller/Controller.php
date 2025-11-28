<?php

namespace App\Controller;

use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlayerRepository;

class Controller extends AbstractController
{
    #[Route('/entityPlayer', name: 'player', methods: ["POST"])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $name = $request->request->get('name');
        $lvl = $request->request->get('lvl');
            if (!is_numeric($lvl) || intval($lvl) < 1) {
            return new Response('Уровень должен быть первый или выше', 400);
        }
        $img = $request->request->get('img');
    if (empty($img)) {
        $img = 'placeholder.png'; 
    } else {
        if (!(strpos($img, '.png') !== false || strpos($img, '.jpg') !== false)) {
            return new Response('Изображение должно быть в формате png или jpg', 400);
        }
    }
        $player = new Player();
        $player->setName($name);
        $player->setLvl($lvl);
        $player->setImg($img);

    
        $entityManager->persist($player);
        $entityManager->flush();
        return new Response('Игрок добавлен: ' . $player->getId());
    }
    #[Route('/entityPlayer', name: 'player', methods: ["POST"])]
  #[Route('/entityPlayer', name: 'player', methods: ["POST"])]
   public function deleteImg(Request $request, EntityManagerInterface $entityManager): Response
   {
    $player = $request->request->get('name');
        $peopleRepository = $entityManager->getRepository(Player::class);
        $player = $peopleRepository->findOneBy(['name' => $player]);
        $player->setImg(null);
        $entityManager->flush();
        return new Response('У пользователя с именем' . $player->getName() . ' была удалена картинка.');
   }
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $player = $request->request->get('name');
        $peopleRepository = $entityManager->getRepository(Player::class);
        $player = $peopleRepository->findOneBy(['name' => $player]);
        $entityManager->remove($player);
        $entityManager->flush();
        return new Response('Пользователь с именем' . $player->getName() . ' был удален.');
    }
    #[Route('/entityPlayer', name: 'player', methods: ["POST"])]
     public function update( Request $request, EntityManagerInterface $entityManager): Response 
     {
    $oldName = $request->request->get('old_name'); 
    $newName = $request->request->get('new_name'); 
    $newLvl  = $request->request->get('new_lvl'); 
    $newImg  = $request->request->get('new_img'); 
    $repository = $entityManager->getRepository(Player::class);
    $player = $repository->findOneBy(['name' => $oldName]);
    $player->setName($newName);
    $player->setLvl($newLvl);
    $player->setImg($newImg);

    $entityManager->flush();

    return new Response('Данные обновлены');
     }
    
    #[Route('/formplayer', name: 'formplayer')]
    public function formplayer(): Response
    {
        return $this->render('player.html.twig', []);
    }
}



