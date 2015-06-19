<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class StudentclassType extends AbstractType
{
	    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','text');

        
        $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'studentclass';
    }
}
