<?php

namespace App\Form;

use App\Entity\Guestentry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class GuestentryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('image', FileType::class, ['attr' => ['class' => 'form-control']])
            ->add('created_on',DateTimeType::class, ['attr' => ['class' => 'form-control']])
            ->add('status',ChoiceType::class, ['attr' => ['class' => 'form-control'], 'choices'  => [
                        'Select' => null,
                        'Approved' => 1,
                        'Rejected' => 0,
                    ]])
            //->add('modified_on')
            //->add('user')
            //->add('modified')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Guestentry::class,
        ]);
    }
}
