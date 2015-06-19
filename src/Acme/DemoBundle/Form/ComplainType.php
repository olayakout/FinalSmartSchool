<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class ComplainType extends AbstractType
{
	    public function buildForm(FormBuilderInterface $builder, array $options)
    {

         $builder->add('fullname','text');
         $builder->add('nationalid','text');
         $builder->add('complain','textarea');

 $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'complain';
    }
}
