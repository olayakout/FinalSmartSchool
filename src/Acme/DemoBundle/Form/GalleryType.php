<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GalleryType extends AbstractType
{
	    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('dateofpic','date');
        $builder->add('image', 'file');
	$builder->add('activity');
	$builder->add('class');

        $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'gallery';
    }
}
