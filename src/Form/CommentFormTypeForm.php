<?php

// src/Form/CommentFormType.php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $user = $options['user'];

    if (!$user) {
        $builder
            ->add('authorName', TextType::class, [
                'label' => 'Name',
                'attr' => ['placeholder' => 'Full Name', 'class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Email here', 'class' => 'form-control'],
            ]);
    }

    $builder->add('content', TextareaType::class, [
        'label' => 'Message',
        'attr' => ['placeholder' => 'Enter Your Message', 'class' => 'form-control', 'rows' => 5],
    ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'user' => null,
        ]);
    }
}
