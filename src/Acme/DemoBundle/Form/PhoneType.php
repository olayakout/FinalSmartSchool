<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PhoneType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder->add('phone');

}


public function getName()
{
    return 'phone';
}
}
