<?php

namespace App\Form;

use App\Entity\Morceaux;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MorceauxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMorceaux', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Nom du morceau',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('dateSortie', DateType::class,
            [
                'label' => 'Date de sortie',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ])
            ->add('artiste', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Nom de l\'artiste',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('genreid')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de l\'album',
                'required' => false,
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',

                        ],
                        'mimeTypesMessage' => 'utiliser une image valide, au format jpg ou png',
                    ])]
                
            ])
            ->add('musicFile', VichFileType::class, [
                'label' => 'Fichier musique du morceau',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '15M',
                        'mimeTypes' => [
                            'audio/midi','audio/mpeg',
                            'audio/mpeg3','audio/webm',
                            'audio/ogg','audio/wav',
                        ]
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Valider'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Morceaux::class,
        ]);
    }
}
