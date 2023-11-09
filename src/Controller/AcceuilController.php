<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Description of AcceuilController
 *
 * @author loish
 */
class AcceuilController extends AbstractController {
    /**
     * @Route("/", name="acceuil")
     * @return Response
     */
    public function index(): Response{
        $hello = "Pages D'acceuil";
        return $this->render("pages/acceuil.html.twig", [
            'hello' => $hello
        ]);
    }
}
