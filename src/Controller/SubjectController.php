<?php

namespace App\Controller;

use App\Entity\Subject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SubjectRepository;

class SubjectController extends AbstractController
{
    #[Route('/entitySubject', name: 'subject', methods: ["POST"])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nazvanie = $request->request->get('nazvanie');
        $redcost = $request->request->get('redcost');
        $price = $request->request->get('price');
         if (!is_numeric($price) || intval($price) < 1) {
            return new Response('Цена должна быть больше нуля.');
        }

        $subject= new Subject();
        $subject->setNazvanie($nazvanie);   
        $subject->setRedcost($redcost);
        $subject->setPrice($price);

        $entityManager->persist($subject);
        $entityManager->flush();
        return new Response('Предмет добавлен: ' . $subject->getId());
    }
    #[Route('/formsubject', name: 'formsubject')]
    public function formplayer(): Response
    {

        return $this->render('subject.html.twig', []);
    }
}

