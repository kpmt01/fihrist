<?php

namespace App\Form;

use App\Entity\Addresses;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('City', TextType::class, array('label' => 'Şehir', 'attr' => array('class' => 'form-control')))
            ->add('Street', TextType::class, array('label' => 'Sokak', 'attr' => array('class' => 'form-control')))
            ->add('State', TextType::class, array('label' => 'Bölge', 'attr' => array('class' => 'form-control')))
            ->add('Postcode', TextType::class, array('label' => 'Posta Kodu', 'attr' => array('class' => 'form-control')))
            ->add('Description', TextType::class, array('label' => 'Açıklama', 'attr' => array('class' => 'form-control')))
            ->add('user', EntityType::class, array(
                'label' => 'Kullanıcı',
                'class' => User::class,
                'choice_label' => 'name',
                'attr' => array('class' => 'custom-select form-control')
            ))

            ->add('Kaydet',SubmitType::class, array('label' => 'Kaydet', 'attr' => array('class' => 'btn btn-outline-success mt-3') ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Addresses::class,
        ]);
    }
}
