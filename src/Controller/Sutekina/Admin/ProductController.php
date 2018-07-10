<?php

namespace App\Controller\Sutekina\Admin;


use App\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route(
     *     "/admin/createbox",
     *     name="admin_create_box",
     *     methods={"GET"},
     *     )
     * Le paramètre method HTTP
     *
     *
     * @param \App\Controller\Sutekina\Admin\EntityManager $manager
     *
     * @return Response
     */
    public function createBox(ObjectManager $manager): Response
    {
        $products = $manager->getRepository(Product::class)->findAll();


        return $this->render('admin/product/create.html.twig', [
            'products' => $products,
        ]);
    }

}