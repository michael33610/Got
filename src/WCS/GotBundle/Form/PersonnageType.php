<?php


namespace WCS\GotBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PersonnageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('nom',         TextType::class)
        ->add('prenom',    TextType::class)
        ->add('sexe',    ChoiceType::class, array(
            'choices'  => array(
            'Homme' => 'H',
            'Femme' => 'F',
        )))

        ->add('bio',    TextType::class)

        ->add('royaume', EntityType::class, array(
            // query choices from this entity
            'class' => 'WCSGotBundle:Royaume',

            'choice_label' => 'nom',))
        ->add('save',         SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'WCS\GotBundle\Entity\Personnage'
        ));
    }
}
