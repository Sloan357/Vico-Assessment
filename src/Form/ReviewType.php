<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('created')
            ->add('overall_rating', RangeType::class, [
                'label' => 'Overall Satisfaction',
                'attr' => [
                    'Bad' => 1,
                    'Excellent' => 5
                ],
            ])
            ->add('short_review', TextareaType::class, [
                'label' => 'Please add a short review'
            ])
            ->add('communication_rating', RangeType::class, [
                'attr' => [
                    'Bad' => 1,
                    'Excellent' => 5
                ],
            ])
            ->add('quality_rating', RangeType::class, [
                'attr' => [
                    'Bad' => 1,
                    'Excellent' => 5
                ],
            ])
            ->add('value_rating', RangeType::class, [
                'attr' => [
                    'Bad' => 1,
                    'Excellent' => 5
                ],
            ])
            ->add('project_id')
            ->add('creator_id')
            ->add('vico_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
