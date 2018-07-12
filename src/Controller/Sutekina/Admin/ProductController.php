<?php

namespace App\Controller\Sutekina\Admin;


use App\Entity\Product;
use App\Entity\SutekinaBox;
use App\SutekinaBox\SutekinaBoxRequest;
use App\SutekinaBox\SutekinaBoxRequestHandler;
use App\SutekinaBox\SutekinaBoxType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Workflow\Exception\TransitionException;
use Symfony\Component\Workflow\Registry;

class ProductController extends Controller
{
    /**
     * @Route(
     *     "/admin/listbox",
     *     name="admin_list_box",
     *     methods={"GET"},
     *     )
     * Le paramètre method HTTP
     *
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @return Response
     */
    public function listBoxReadyToPrepare(ObjectManager $manager): Response
    {
        $allBox = $manager->getRepository(SutekinaBox::class)
            ->findAllPreparedBox();
        return $this->render('admin/product/list.html.twig', [
            'allBox' => $allBox,
            'categoryActive' => 'product',
            'sousCategoryActive' => 'box_list',
        ]);
    }

    /**
     * @Route(
     *     "/admin/createbox",
     *     name="admin_create_box",
     *     )
     * @Security("has_role('ROLE_ADMIN')")
     *
     *
     * @param \Symfony\Component\HttpFoundation\Request  $request
     * @param \App\SutekinaBox\SutekinaBoxRequestHandler $sutekinaBoxRequestHandler
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @param \Symfony\Component\Workflow\Registry       $workflows
     *
     * @return Response
     */
    public function createBox(Request $request, SutekinaBoxRequestHandler $sutekinaBoxRequestHandler, ObjectManager $manager, Registry $workflows): Response
    {


        $sutekinaBox = new SutekinaBoxRequest(); #Pour laisser notre service faire le boulot.
//        $products = $manager->getRepository(Product::class)->findAll();
//        $sutekinaBox->setProducts($products);


        #Créer un Formulaire permettant l'ajout d'une box
        $form = $this->createForm(SutekinaBoxType::class,$sutekinaBox)->handleRequest($request);

        #Verification des données du formulaire


        if ($form->isSubmitted() && $form->isValid()){

            $workflow = $workflows->get($sutekinaBox);

            $workflow->can($sutekinaBox, 'created'); // False
            $workflow->can($sutekinaBox, 'to_validated'); // True

            // Update the currentState on the post
            try {
                $workflow->apply($sutekinaBox, 'to_validate');
                /**
                 * Une fois le formulaire soumis et valide on passe nos données directement au service
                 * qui se chargera du trainement.
                 */

                $sutekinaBoxRequestHandler->handle($sutekinaBox);
                $allBox = $manager->getRepository(SutekinaBox::class)->findAllProductsByBox($sutekinaBox->getId());
                #Message flash
                $this->addFlash('notice', 'Box bien crée !');

                #Redirection sur l'article qui vient d'être crée.
                return $this->redirectToRoute('admin_list_box', [
                    'allBox' => $allBox,
                ]);
            } catch (TransitionException $exception) {
                // ... if the transition is not allowed
            }
        }

        #Affichage du formulaire dans la vue
        return $this->render('admin/product/create.html.twig', [
            'form' => $form->createView(),
            'categoryActive' => 'product',
            'sousCategoryActive' => 'box_create',
        ]);
    }



    /**
     * @Route(
     *     "/admin/box_to_validate",
     *     name="admin_box_to_validate",
     *     methods={"GET"},
     *     )
     * Le paramètre method HTTP
     *
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @return Response
     */
    public function boxToValidate(ObjectManager $manager): Response
    {
        $allBox = $manager->getRepository(SutekinaBox::class)
            ->findAllToValidatedBox();
        return $this->render('admin/product/list.html.twig', [
            'allBox' => $allBox,
            'categoryActive' => 'purchase',
            'sousCategoryActive' => 'ask_to_validate',
        ]);
    }

    /**
     * @Route(
     *     "/admin/box_ask_for_stock",
     *     name="admin_box_ask_for_stock",
     *     methods={"GET"},
     *     )
     * Le paramètre method HTTP
     *
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @return Response
     */
    public function boxToCheckStock(ObjectManager $manager): Response
    {
        $allBox = $manager->getRepository(SutekinaBox::class)
            ->findAllToCheckStockBox();
        return $this->render('admin/product/list.html.twig', [
            'allBox' => $allBox,
            'categoryActive' => 'purchase',
            'sousCategoryActive' => 'ask_for_stock',
        ]);
    }


    /**
     * @Route(
     *     "/admin/box_to_purchase",
     *     name="admin_box_to_purchase",
     *     methods={"GET"},
     *     )
     * Le paramètre method HTTP
     *
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @return Response
     */
    public function boxToPurchase(ObjectManager $manager): Response
    {
        $allBox = $manager->getRepository(SutekinaBox::class)
            ->findAllToPurchaseBox();
        return $this->render('admin/product/list.html.twig', [
            'allBox' => $allBox,
            'categoryActive' => 'purchase',
            'sousCategoryActive' => 'validation_purchase_box',
        ]);
    }

    /**
     * @Route(
     *     "/admin/ready_to_prepare",
     *     name="admin_ready_to_prepare",
     *     methods={"GET"},
     *     )
     * Le paramètre method HTTP
     *
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @return Response
     */
    public function boxReadyToPrepare(ObjectManager $manager): Response
    {
        $allBox = $manager->getRepository(SutekinaBox::class)
            ->findAllPreparedBox();
        return $this->render('admin/product/list.html.twig', [
            'allBox' => $allBox,
            'categoryActive' => 'purchase',
            'sousCategoryActive' => 'manage_box',
        ]);
    }
}