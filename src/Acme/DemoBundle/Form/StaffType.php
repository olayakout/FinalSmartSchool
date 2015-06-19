<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class StaffType extends AbstractType
{
	    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $builder->add('code', 'text');
        $builder->add('fullname','text');
        $builder->add('job');

        $builder->add('graduate','text');
	$builder->add('anotherstudy','text');
        $builder->add('dateofgraduate','date', array(
                 'years' => range(date('Y') -60, date('Y')+3),
                     ));
        $builder->add('dateofanotherstudy','date', array(
                 'years' => range(date('Y') -60, date('Y')+3),
                     ));
        $builder->add('birthday','date', array(
			    'years' => range(date('Y') -65, date('Y')),
			));
        $builder->add('appointmentdate','date', array(
			    'years' => range(date('Y') -65, date('Y')),
			));
        $builder->add('joindate','date', array(
			    'years' => range(date('Y') -65, date('Y')),
			));
        $builder->add('degree','text');
        $builder->add('dateofgetdegree','date', array(
			    'years' => range(date('Y') -65, date('Y')),
			));
        $builder->add('nationalid','text');
        $builder->add('address','text');
        $builder->add('phone','number',array('mapped'=>false));
        $builder->add('image', 'file');

        $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'staff';
    }
}
