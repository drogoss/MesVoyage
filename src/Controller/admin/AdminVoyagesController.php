<?php

namespace App\Controller\admin;

use App\Repository\VisiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
