<?php

namespace App\SutekinaBox;

use App\Product\ProductType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SutekinaBoxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom de la Sutekinabox...'
                ]
            ])
            ->add('budget', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Montant du budget'
                ]
            ])
            ->add('products', CollectionType::class, array(
                // each entry in the array will be an "label" field
                'entry_type' => ProductType::class,

                // these options are passed to each "email" type
                'entry_options' => array(
                    'attr' => array(
                        'class' => 'chk-col-teal',
                    ),
                ),
            ))
            ->add('Enregistrer', SubmitType::class, array(
                'attr' => [
                    'class' => 'btn bg-green waves-effect',
                    ]
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
//            'data_class' => Article::class
            'data_class' => SutekinaBoxRequest::class, #On ne prend plus une instance d'article, mais directement le service lié
        ]);
    }

}