<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Department;
use App\Repository\DepartmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ContactType
 * @package App\Form\Type
 */
class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('lastname', TextType::class, ['label' => 'Nom'])
            ->add('mail', TextType::class, ['label' => 'Adresse mail'])
            ->add('message', TextType::class, ['label' => 'Message'])
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'mapped' => true,
                'query_builder' => function (DepartmentRepository $er) {
                    return $er->createQueryBuilder('d');
                },
                'choice_label' => 'label',
            ])
            ->add('save', SubmitType::class, ['label' => 'Envoyer'])
        ;
    }
}