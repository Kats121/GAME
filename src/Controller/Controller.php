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
        $player = new Player();
        $player->setName($name);
        $player->setLvl($lvl);

        $entityManager->persist($player);
        $entityManager->flush();
        return new Response('Игрок добавлен: ' . $player->getId());
    }
    #[Route('/formplayer', name: 'formplayer')]
    public function formplayer(): Response
    {
        return $this->render('player.html.twig', []);
    }
}



