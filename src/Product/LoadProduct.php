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
     * @throws \Exception
     */
    public function addProducts(ObjectManager $manager, $number = 10)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        $suppliers = $manager->getRepository(Supplier::class)->findAll();
        $supplier = $suppliers[random_int(0, count($suppliers)-1)];
        // on créé 10 personnes
        for ($i = 0; $i < 20; $i++) {
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