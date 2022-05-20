<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class KontaktdiebasisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'meine E-Mail'
            ])
            ->add('nachricht', TextareaType::class, [
                'label' => 'Nachricht',
                'attr' => [
                    'rows' => '4',
                ],
            ])
        ->add('senden', SubmitType::class, [
            'label' => 'Absenden',
        ])
        ->add('abbruch', SubmitType::class, [
            'label' => 'Abbrechen',
            'attr' => [
                'formnovalidate' => 'formnovalidate'
            ]
        ])
        ->add('reset', ResetType::class, [
            'label' => 'Reset',
        ]);
    }
}