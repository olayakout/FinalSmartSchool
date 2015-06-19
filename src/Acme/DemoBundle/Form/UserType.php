<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
	    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fullname', 'text');
        $builder->add('code','password');

        $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'user';
    }
}
