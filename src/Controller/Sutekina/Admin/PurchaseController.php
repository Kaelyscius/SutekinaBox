<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 12/07/2018
 * Time: 14:46
 */

namespace App\Controller\Sutekina\Admin;


use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{

    /**
     * @Route(
     *     "/admin/purchase/ask_for_validate/{id}",
     *     name="admin_purchase_ask_to_validate",
     *     methods={"GET"},
     *     )
     * Le paramètre method HTTP
     *
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @return Response
     */
    public function validateBox(ObjectManager $manager, $id): Response
    {

        dd($id);

    }

}