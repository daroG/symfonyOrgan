<?php

namespace App\Form;

use App\Entity\Mass;
use App\Entity\PlayedSongs;
use App\Entity\PlayedSongsSong;
use App\Entity\Song;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('added_at', DateTimeType::class)
            ->add('mass', EntityType::class, [
                'class' => Mass::class,
                'choice_label' => 'title',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlayedSongs::class,
        ]);
    }
}
