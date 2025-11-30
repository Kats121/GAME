<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;
use App\Repository\InventoryRepository;

class ExcelController extends AbstractController
{
 #[Route('/entityexcel', name:'excel', methods:['POST'])]
    public function excel(InventoryRepository $InventoryRepository): Response
    {
    $values = $InventoryRepository->findAll();   
    $writer = WriterEntityFactory::createXLSXWriter();
    $filename = 'file.xlsx';
    $writer->openToFile($filename);
    $header = [
    WriterEntityFactory::createCell('ID'),
    WriterEntityFactory::createCell('name'),
    WriterEntityFactory::createCell('nazvanie'),
];
$headerRow = WriterEntityFactory::createRow($header);
$writer->addRow($headerRow);
foreach ($values as $value) {
 $cells = [
                WriterEntityFactory::createCell($value->getId()),
                WriterEntityFactory::createCell($value->getName()),
                WriterEntityFactory::createCell($value->getNazvanie()),
            ];
             $row = WriterEntityFactory::createRow($cells);
             $writer->addRow($row);
}
$writer->close();
    return new Response;
    }
    #[Route('/formexcel', name: 'formexcel')]
         public function forminventory(InventoryRepository $InventoryRepository): Response
         {
            $inventories = $InventoryRepository->findAll();
          return $this->render('excel.html.twig', [
          'inventory' => $inventories,
          ]);
         }
}


