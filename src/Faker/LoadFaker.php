<?php

namespace App\Faker;


use App\Entity\Product;
use App\Entity\Supplier;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class LoadFaker extends Fixture
{
    private $faker;

    private $products;

    private $encoder;

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create('fr_FR');
        $this->addUsers($manager);
        $this->addSuppliers($manager);

        $manager->flush();
    }

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager                            $em
     *
     * @param \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $encoder
     *
     * @throws \Exception
     */
    private function addUsers(ObjectManager $em)
    {
        $roles = [
            ['ROLE_USER'],
            ['ROLE_ADMIN'],
            ['ROLE_MARKETING'],
            ['ROLE_PURCHASE']
        ];

        $user = new User();
        $firstname = 'Alexandre';
        $lastname = 'Canivez';
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $plainPassword = 'alexandre';
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);
        $user->setEmail('alex@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $em->persist($user);
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $firstname = $this->faker->firstName;
            $lastname = $this->faker->lastName;
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $plainPassword = 'alexandre';
            $encoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);
            $user->setEmail(strtr(
                    strtolower($firstname),
                '@ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'aAAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
            ).'.'.strtolower($lastname).'@gmail.com');
            $user->setRoles($roles[random_int(0, count($roles) - 1)]);
            $em->persist($user);
        }
    }

    private function addSuppliers(ObjectManager $em)
    {

        for ($i = 1; $i <= 10; $i++) {
            $supplier = new Supplier();
            $supplier->setName('Entreprise n° '.$i);
            $supplier->setAddress($this->faker->streetAddress);
            $supplier->setPostalCode($this->faker->postcode);
            $supplier->setCity($this->faker->city);
            $supplier->setCountry($this->faker->country);
            $supplier->setEmail($this->faker->safeEmail);
            $supplier->setContactName($this->faker->name);
            $supplier->setProducts($this->addProduct($em, $supplier));
            $em->persist($supplier);

        }



    }

    private function addProduct(ObjectManager $em, $supplier)
    {
        for ($i = 1; $i <= 20; $i++) {
            $product = new Product();
            $product->setName('Produit ref: '. $this->faker->ean13);
            $product->setPrice($this->faker->randomNumber(2));
            $product->setSupplierId($supplier);
            $em->persist($product);
            $this->products[] = $product;
        }

        return $this->products;
    }
}