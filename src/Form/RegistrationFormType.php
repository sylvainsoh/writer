<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('full_name', TextType::class,[
                'label' => false,
                'attr' =>[
                    'placeholder'=> "Nom complet ...",
                    'class' => 'form-control'
                ],
                "row_attr" =>[
                    "class" => "form-group flex"
                ],
            ])
            ->add('email', EmailType::class,[
                'label' => false,
                'attr' =>[
                    'placeholder'=> "Email ...",
                    'class' => 'form-control'
                ],
                "row_attr" =>[
                    "class" => "form-group flex"
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => "Vous devez accepter nos conditions d'utilisation",
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => [
                    'label' => false,
                    'attr'=>[
                        'placeholder' => "Mot de passe ...",
                        'class' => 'form-control'
                    ],
                    "row_attr" =>[
                        "class" => "form-group flex"
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Saississez un mot de passe ',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Le mot de passe dois avoir au minimum {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => false,
                    'attr'=>[
                        'placeholder' => "Confirmation du mot de passe ...",
                        'class' => 'form-control'
                    ],
                    "row_attr" =>[
                        "class" => "form-group flex"
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez le mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Le mot de passe dois avoir au minimum {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],
                // 'attr' => ['autocomplete' => 'new-password'],
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
