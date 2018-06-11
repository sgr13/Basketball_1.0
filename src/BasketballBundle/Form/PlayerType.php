<?php

namespace BasketballBundle\Form;

use BasketballBundle\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Imię:'))
            ->add('nickname', TextType::class, array('label' => 'Nickname:'))
            ->add('height', IntegerType::class, ['label' => 'Wzrost: '])
            ->add('user', EntityType::class, array(
                'class' => 'BasketballBundle\Entity\User',
                ))
            ->add('specialization', EntityType::class, array(
                'class' => 'BasketballBundle:Specialization',
                'choice_label' => 'name', 'label' => 'Mocna strona:'))
            ->add('photoFront', FileType::class, array('label' => ' ', 'data_class' => null));

        if ($options['noPhoto']) {
            $builder->remove('photoFront');
            $builder->remove('user');
        }

        if ($options['onlyPhoto']) {
            $builder->remove('name')
                ->remove('specialization')
                ->remove('user')
                ->remove('height')
                ->remove('nickname');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
            'noPhoto' => false,
            'onlyPhoto' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return 'basketball_bundle_player_type';
    }
}
