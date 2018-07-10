<?php

namespace App\Controller\Sutekina;


use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @Route(
     *     "/",
     *     name="index",
     *     methods={"GET"}
     * )
     * Le paramètre method HTTP
     *
     *
     * @return Response
     */
    public function index(): Response
    {

        return $this->render('index/index.html.twig', [
        ]);
    }

}