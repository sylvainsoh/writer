<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('full_name', TextType::class, [
                "label" => false,
                "attr" => [
                    "placeholder" => "Votre nom et prénom ...",
                    "class" => "form-control"
                ],
                "row_attr" =>[
                    "class" => "form-group flex"
                ],
                "required" => true,
            ])
            ->add('email', EmailType::class, [
                "label" => false,
                "attr" => [
                    "placeholder" => "Votre email ...",
                    "class" => "form-control"
                ],
                "row_attr" =>[
                    "class" => "form-group flex"
                ],
                "required" => true,
            ])
            ->add('subject', TextType::class, [
                "label" => false,
                "attr" => [
                    "placeholder" => "Le sujet de votre message ...",
                    "class" => "form-control"
                ],
                "row_attr" =>[
                    "class" => "form-group flex"
                ],
                "required" => true,
            ])
            ->add('message', TextareaType::class, [
                "label" => false,
                "attr" => [
                    "placeholder" => "Votre message ...",
                    "class" => "form-control",
                    "rows" => 10
                ],
                "row_attr" =>[
                    "class" => "form-group flex"
                ],
                "required" => true,
            ])
            ->add('send', SubmitType::class, [
                "label" => "Envoyer Message",
                "attr" =>[
                    "class" => "btn btn-primary"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
