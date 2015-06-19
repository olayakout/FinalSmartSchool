<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TansekType extends AbstractType
{
	    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content','textarea');       
        $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'tansek';
    }
}
