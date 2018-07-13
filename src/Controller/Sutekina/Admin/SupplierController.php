<?php

namespace App\Controller\Sutekina\Admin;


use App\Entity\Supplier;
use App\Product\LoadProduct;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends Controller
{
    /**
     * @Route(
     *     "/admin/supplier-for-products",
     *     name="admin-supplier-for-products",
     *     )
     * Le paramètre method HTTP
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @return Response
     */
    public function listOfSupplierForAskProducts(ObjectManager $manager): Response
    {

        $suppliers = $manager->getRepository(Supplier::class)->findAll();

        return $this->render('admin/supplier/ask_product.html.twig', [
            'suppliers' => $suppliers,
            'categoryActive' => 'product',
            'sousCategoryActive' => 'supplier_ask_for_product',
        ]);
    }


    /**
     * @Route(
     *     "/admin/supplier-for-products{id}",
     *     name="admin_product_supplier_ask_for_product",
     *     )
     * Le paramètre method HTTP
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @param \App\Product\LoadProduct                   $loadProduct
     *
     * @return Response
     * @throws \Exception
     */
    public function askSupplierForProducts(ObjectManager $manager, LoadProduct $loadProduct, $id): Response
    {

        $supplierProducts = $loadProduct->addProducts($manager, 10, $id);


        return $this->render('admin/supplier/supplierMessage.html.twig', [
            'supplierProducts' => $supplierProducts,
            'categoryActive' => 'product',
            'sousCategoryActive' => 'supplier_ask_for_product',
        ]);
    }
}