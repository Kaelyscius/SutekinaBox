<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 12/07/2018
 * Time: 14:46
 */

namespace App\Controller\Sutekina\Admin;


use App\Entity\SutekinaBox;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Workflow\Exception\TransitionException;
use Symfony\Component\Workflow\Registry;

class PurchaseController extends Controller
{
    private $route;

    /**
     * @Route(
     *     "/admin/purchase/ask_for_validate/{id}/{validate}",
     *     name="admin_purchase_ask_to_validate"
     *     )
     * Le paramètre method HTTP
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @param \Symfony\Component\Workflow\Registry       $workflows
     * @param                                            $id
     *
     * @return Response
     */
    public function validateBox(ObjectManager $manager, Registry $workflows, $id, $validate): Response
    {

        $sutekinaBox = $manager->getRepository(SutekinaBox::class)->find($id);

        $workflow = $workflows->get($sutekinaBox);

        $workflow->can($sutekinaBox, 'created'); // False
        $workflow->can($sutekinaBox, 'to_validated'); // True
        $workflow->can($sutekinaBox, 'to_check_stock'); // True

        try {
            if ($validate){
                $workflow->apply($sutekinaBox, 'to_check');
                $allBox = $manager->getRepository(SutekinaBox::class)->findAllToCheckStockBox($sutekinaBox->getId());

                //on set les routes à prendre
                $this->route = 'admin_box_ask_for_stock';
            } else {
                $workflow->apply($sutekinaBox, 'to_validate');
                $allBox = $manager->getRepository(SutekinaBox::class)->findAllToValidatedBox($sutekinaBox->getId());
                $this->route = 'admin_list_box';

            }

            #Message flash

            $manager->persist($sutekinaBox);
            $manager->flush();
            $this->addFlash('notice', 'Box bien crée !');

            #Redirection sur l'article qui vient d'être crée.
            return $this->redirectToRoute($this->route, [
                'allBox' => $allBox,
            ]);
        } catch (TransitionException $exception) {
            // ... if the transition is not allowed
        }

    }

    /**
     * @Route(
     *     "/admin/purchase/admin_box_ask_for_stock",
     *     name="admin_purchase_ask_for_stock"
     *     )
     * Le paramètre method HTTP
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     *
     * @return Response
     */
    public function askForStock(ObjectManager $manager): Response
    {

        $allBox = $manager->getRepository(SutekinaBox::class)->findAllToCheckStockBox($sutekinaBox->getId());
        #Redirection sur l'article qui vient d'être crée.
        return $this->redirectToRoute('admin_box_to_purchase', [
            'allBox' => $allBox,
        ]);
    }

}