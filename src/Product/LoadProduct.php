<?php

namespace App\Product;

use App\Entity\Product;

use App\Entity\Supplier;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LoadProduct
{
    private $products;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @param int           $number number of element
     *
     * @param               $id of supplier
     *
     * @return
     * @throws \Exception
     */
    public function addProducts(ObjectManager $manager, $number = 10, $id)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        $supplier = $manager->getRepository(Supplier::class)->find($id);
        // on créé 10 personnes
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName('Produit ref: '. $faker->ean13 );
            $product->setPrice($faker->randomNumber(2));
            $product->setSupplierId($supplier);
            $manager->persist($product);
            $this->products[] = $product;
        }

        $manager->flush();
        return $this->products;

    }
}