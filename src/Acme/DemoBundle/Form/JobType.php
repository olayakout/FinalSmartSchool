<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class JobType extends AbstractType
{
	    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('job','text');

        
        $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'job';
    }
}
