<?php

namespace App\Form;

use App\Entity\Supplier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplierType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array                                        $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', EntityType::class, array(
                // each entry in the array will be an "label" field
                'class' => Supplier::class,
                'choice_value'  => 'id',
                'choice_label'  => function ($supplier) {
                    return $supplier->getName();
                },
                'multiple'      => false,
                'expanded'      => false,
                'attr' => array(
                    'class' => 'chk-col-teal',
                ),
            ));
    }

    /**
     * Définir les options par défaut pour le formulaire
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            #Indiquer quel type de donnée sera a traiter par un formulaire
            'data_class' => Supplier::class,
        ]);
    }
}