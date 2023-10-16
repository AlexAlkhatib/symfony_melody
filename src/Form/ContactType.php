<?php

namespace App\Form;

use App\Entity\Contact;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class,['attr' => [
                'class' => 'form-control',
                'minlength' => '1',
                'maxlength' => '50'
            ],
            'label' => 'Prenom',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]])
            
            ->add('email', EmailType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '3',
                    'maxlength' => '50'
                ],
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('subject', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '0',
                    'maxlength' => '50'
                ],
                'label' => 'Sujet',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('message', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '1',
                    'maxlength' => '150'
                ],
                'label' => 'Message',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Valider'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
