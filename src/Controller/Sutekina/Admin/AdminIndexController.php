<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 10/07/2018
 * Time: 11:02
 */

namespace App\Controller\Sutekina\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdminIndexController extends Controller
{

    /**
     * @Route(
     *     "/admin",
     *     name="admin_index",
     *     methods={"GET"},
     *     )
     * Le paramètre method HTTP
     *
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }

    public function sidebar($categoryActive = 'home', $sousCategoryActive = ''){
        #Rendu
        return $this->render('admin/components/_sidebar.html.twig', [
            'categoryActive' => $categoryActive,
            'sousCategoryActive' => $sousCategoryActive,
        ]);

    }

}