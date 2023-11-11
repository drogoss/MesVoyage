<?php

namespace App\Controller;

use App\Repository\VisiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of VoyagesController
 *
 * @author loish
 */
class VoyagesController extends AbstractController {
    private $repository; 
    private $entityManager;
    
    public function __construct(VisiteRepository $repository, EntityManagerInterface $entityManager) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;        
    }

    /**
     * @Route("/voyages", name="voyages")
     * @return Response
     */
    public function index(): Response{
        $visites = $this->repository->findAll();
        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
        ]);
    }
    public function join(): Response {
        $array = ["country", "city", "numberBetween", "sentences"];
        $result = implode(", ", [$array]);

        return $this->render('voyages.html.twig', [
            'result' => $result
        ]);
}
}