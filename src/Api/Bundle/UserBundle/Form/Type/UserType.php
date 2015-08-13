<?php
/**
 * Created by PhpStorm.
 * User: ilham
 * Date: 12/08/15
 * Time: 18:50
 */

namespace Api\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null)
            ->add('lastname', null)
            ->add('email', 'email')
            ->add('plainPassword', 'password')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Api\Bundle\UserBundle\Form\Type\UserType',
            'intention'  => 'registration',
        ));
    }

    public function getName()
    {
        return 'user_form_type';
    }
}