<?php

namespace App\Product;


use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array                                        $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('isSelected', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'class' => 'chk-col-teal',
                ]
            ]);
    }

    /**
     * Définir les options par défaut pour le formulaire
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            #Indiquer quel type de donnée sera a traiter par un formulaire
            'data_class' => Product::class,
        ]);
    }
}