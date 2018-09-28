<?php
/**
 * Created by IntelliJ IDEA.
 * User: vlv
 * Date: 2018/9/27
 * Time: 9:57 PM
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'  => 'User Name'])
            ->add('id', HiddenType::class)
            ->add('phone', IntegerType::class)
            ->add('email', TextType::class)
            ->add('location', TextType::class)
            ->add('gender', TextType::class)
            ->add('age', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Save User'))
        ;
    }
}