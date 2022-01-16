<?php

namespace Allphat\ShortyBundle\Form\Type;

use Allphat\ShortyBundle\Entity\ShortyEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ShortyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sourceUrl', TextType::class)
            ->add('shortHost', TextType::class,
                [
                    'data' => $options['shorty_host']
                ]
            );

        if (true === $options['allow_max_calls']) {
            $builder>add('maxCalls', IntegerType::class);
        }
        if (true === $options['allow_lifetime']) {
            $builder
                ->add('startsAt', DateTimeType::class)
                ->add('endsAt', DateTimeType::class)
            ;
        }

        $builder->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ShortyEntity::class,
        ]);
    }
}