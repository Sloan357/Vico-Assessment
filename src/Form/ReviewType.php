<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('overall_rating', ChoiceType::class, [
                'label' => 'Overall Satisfaction',
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5
                ],
            ])
            ->add('short_review', TextareaType::class, [
                'label' => 'Please add a short review',
                'attr' => [
                    'class' => 'review-text-area'
                ]
            ])
            // ->add('communication_rating', RangeType::class, [
            //     'attr' => [
            //         'Bad' => 1,
            //         'Excellent' => 5
            //     ],
            // ])
            // ->add('quality_rating', RangeType::class, [
            //     'attr' => [
            //         'Bad' => 1,
            //         'Excellent' => 5
            //     ],
            // ])
            // ->add('value_rating', RangeType::class, [
            //     'attr' => [
            //         'Bad' => 1,
            //         'Excellent' => 5
            //     ],
            // ])
            ->add('Next', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
