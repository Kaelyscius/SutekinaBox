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
    public function listBox(ObjectManager $manager): Response
    {
        $allBox = $manager->getRepository(SutekinaBox::class)->findAll();

        return $this->render('admin/product/list.html.twig', [
            'allBox' => $allBox,
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
        $products = $manager->getRepository(Product::class)->findAll();
        $sutekinaBox->setProducts($products);


        #Créer un Formulaire permettant l'ajout d'une box
        $form = $this->createForm(SutekinaBoxType::class,$sutekinaBox)->handleRequest($request);

        #Verification des données du formulaire
        if ($form->isSubmitted() && $form->isValid()){
//            dd($workflows);

            $workflow = $workflows->get($sutekinaBox);
            dd($workflow);

            $workflow->can($sutekinaBox, 'to_validate'); // False
            $workflow->can($sutekinaBox, 'to_check_stock'); // True

            // Update the currentState on the post
            try {
                $workflow->apply($sutekinaBox, 'to_check_stock');
            } catch (TransitionException $exception) {
                // ... if the transition is not allowed
            }
            /**
             * Une fois le formulaire soumis et valide on passe nos données directement au service
             * qui se chargera du trainement.
             */
            $sutekinaBoxRequestHandler->handle($sutekinaBox);
            $allBox = $manager->getRepository(SutekinaBox::class)->findAll();
            #Message flash
            $this->addFlash('notice', 'Box bien crée !');

            #Redirection sur l'article qui vient d'être crée.
            return $this->redirectToRoute('admin_list_box', [
                'allBox' => $allBox,
            ]);



        }

        #Affichage du formulaire dans la vue
        return $this->render('admin/product/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}