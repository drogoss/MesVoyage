<?php

namespace App\Controller\admin;

use App\Entity\Visite;
use App\Form\VisiteType;
use App\Repository\VisiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminVoyagesController
 *
 * @author loish
 */
class AdminVoyagesController extends AbstractController {
    
    /**
     * 
     * @var VisiteRepository
     */
    private $repository; 
    
    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository) {
        $this->repository = $repository;     
    }

    /**
     * @Route("/admin", name="admin.voyages")
     * @return Response
     */
    public function index(): Response{
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render("admin/admin.voyages.html.twig", [
            'visites' => $visites
        ]);
    }
    
    /**
     * @Route ("/admin/suppre/(lib)", name="admin.voyage.suppr")
     * @return Response
     */
    public function suppr(Visite $visite): Response {
        $this->repository->remove($visite, true);
        return $this->redirectToRoute('admin.voyages');
    }
    
    /**
     * @Route("/admin/edit/{id}", name="admin.voyage.edit")
     * @param Visite $visite
     * @param Request $request
     * @return Response
     */
    public function edit(Visite $visite, Request $request, EntityManagerInterface $entityManager): Response
    {
    $formVisite = $this->createForm(VisiteType::class, $visite);

    $formVisite->handleRequest($request);

    if ($formVisite->isSubmitted() && $formVisite->isValid()) {
        // Pas besoin de la méthode add sur le repository, utilisez le gestionnaire d'entités
        $entityManager->flush();

        return $this->redirectToRoute('admin.voyages');
    }     

    return $this->render("admin/admin.voyage.edit.html.twig", [
        'visite' => $visite,
        'formvisite' => $formVisite->createView()
    ]);        
}
}

