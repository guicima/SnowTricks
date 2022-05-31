<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'm-2'],
            ])
            ->add('description', null, [
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'm-2'],
            ])
            ->add('theme', null, [
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'm-2'],
            ])
            ->add('images', FileType::class, [
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'm-2'],
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                // 'constraints' => [
                //     new File([
                //         'maxSize' => '1024k',
                //         'mimeTypes' => [
                //             'image/jpeg',
                //             'image/png',
                //             'video/mp4',
                //         ],
                //         'mimeTypesMessage' => 'Please upload a valid image or video',
                //     ]),

                // ],
            ])
            ->add('video', UrlType::class, [
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'm-2'],
                'mapped' => false,
                'required' => false,
            ])
            // ->add('modifiedAt')
            // ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
