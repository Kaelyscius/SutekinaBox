<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 09/07/2018
 * Time: 12:22
 */

namespace App\Controller;


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