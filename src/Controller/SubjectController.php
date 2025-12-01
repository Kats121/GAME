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
    public function create(Request $request, EntityManagerInterface $entityManager, SubjectRepository $SubjectRepository): Response
    {
        $nazvanie = $request->request->get('nazvanie');
        $redcost = $request->request->get('redcost');
        $price = $request->request->get('price');
        if (!is_numeric($price) || intval($price) < 1) {
            return new Response('Цена должна быть больше нуля.');
        }
        $img = $request->request->get('img');

        if (empty($img)) {
            return new Response('Изображение обязательно для загрузки', 400);
        }


        if (!(strpos($img, '.png') !== false || strpos($img, '.jpg') !== false)) {
            return new Response('Изображение должно быть в формате png или jpg', 400);
        }

        $subject = new Subject();
        $subject->setNazvanie($nazvanie);
        $subject->setRedcost($redcost);
        $subject->setPrice($price);
        $subject->setImg($img);

        $entityManager->persist($subject);
        $entityManager->flush();
        $subjects = $SubjectRepository->findAll();
        return $this->render('list2.html.twig', [
            'subjects' => $subjects,
        ]);
    }

    public function deleteImg(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subject = $request->request->get('nazvanie');
        $subjectRepository = $entityManager->getRepository(Subject::class);
        $subject = $subjectRepository->findOneBy(['nazvanie' => $subject]);
        $subject->setImg(null);
        $entityManager->flush();
        return new Response('У пользователя с именем' . $subject->getNazvanie() . ' была удалена картинка.');
    }

    #[Route('/entityPlayer', name: 'player', methods: ["POST"])]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subject = $request->request->get('nazvanie');
        $peopleRepository = $entityManager->getRepository(Subject::class);
        $subject = $peopleRepository->findOneBy(['nazvanie' => $subject]);

        $entityManager->remove($subject);
        $entityManager->flush();
        return new Response('Пользователь с именем' . $subject->getNazvanie() . ' был удален.');
    }
    #[Route('/entitySubject', name: 'subject', methods: ["POST"])]
    public function update(Request $request, EntityManagerInterface $entityManager, SubjectRepository $SubjectRepository): Response
    {
        $oldNazvanie = $request->request->get('old_nazavanie');
        $newRedcost  = $request->request->get('new_redcost');
        $newPrice  = $request->request->get('new_price');
        $newImg  = $request->request->get('new_price');
        $repository = $entityManager->getRepository(subject::class);
        $subject = $repository->findOneBy(['name' => $oldNazvanie]);
        $subject->setRedcost($newRedcost);
        $subject->setPrice($newPrice);
        $subject->setImg($newImg);
        $entityManager->flush();

        $subjects = $SubjectRepository->findAll();
        return $this->render('list2.html.twig', [
            'subjects' => $subjects,
        ]);
    }
    
    #[Route('/formsubject', name: 'formsubject')]
    public function formplayer(): Response
    {

        return $this->render('subject.html.twig', []);
    }
}
