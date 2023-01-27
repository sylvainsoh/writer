<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder' => 'Titre ...',
                    'class' => 'form-control'
                ],
                'row_attr' =>[
                    'class' => 'form-group flex'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => false,
                'required' => true,
                'attr' =>[
                    'placeholder' => 'Contenu ...',
                    'class' => 'form-control',
                    'rows' => 30
                ],
                'row_attr' =>[
                    'class' => 'form-group'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisissez le contenu de l'article",
                    ]),
                    new Length([
                        'min' => 300,
                        'minMessage' => 'Le contenu dois avoir au minimum {{ limit }} caractères'
                    ]),
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => false,
                'required' =>false,
                'attr' =>[
                    // 'placeholder' => 'Article title ...',
                    'class' => 'form-control'
                ],
                'row_attr' =>[
                    'class' => 'form-group flex'
                ]
            ])
            ->add('categories', EntityType::class, [
                'label' => false,
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple'  => true,
                'by_reference' => false,
                'attr' =>[
                    // 'placeholder' => 'Article title ...',
                    'class' => 'form-control choices_categories'
                ],
                'row_attr' =>[
                    'class' => 'form-group flex'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
