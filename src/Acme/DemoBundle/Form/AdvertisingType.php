<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertisingType extends AbstractType
{
	    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     
        $builder->add('body','textarea');
        $builder->add('date','date', array(
                 'years' => range(date('Y') , date('Y')+50),
                     ));
        
        $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'advertising';
    }
}
