<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Entry;
use App\Repository\EntryRepository;
class EntryController extends AbstractController
{
    /**
     * @Route("/entry", name="app_entry")
     */
    public function index(EntryRepository $entryRepository): Response
    {
        // $products = $this->getDoctrine()
        //     ->getRepository(Entry::class)
        //     ->findAll();
  
        // $data = [];
  
        // foreach ($products as $product) {
        //    $data[] = [
        //        'id' => $product->getId(),
        //        'name' => $product->getTitle(),
        //        'image' => $product->getImage(),
        //    ];
        // }
        return $this->render('entry/index.html.twig', [
            'controller_name' => 'EntryController',
            'entries' => $entryRepository->findAll()
        ]);
    }
}
