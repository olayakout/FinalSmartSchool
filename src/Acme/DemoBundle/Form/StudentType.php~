<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class StudentType extends AbstractType
{
      public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('fullname','text');
        $builder->add('fatherjob','text');
	$builder->add('code','text');
        $builder->add('birthday','date', array(
                 'years' => range(date('Y') -8, date('Y')+3),
                     ));
        $builder->add('nationalid','text');
        $builder->add('address','text');
        $builder->add('phone','number',array('mapped'=>false));

        $builder->add('image', 'file');

        $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'student';
    }
}
