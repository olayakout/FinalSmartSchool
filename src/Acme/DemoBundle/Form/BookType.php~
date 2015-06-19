<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BookType extends AbstractType
{
	    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('author','text');
        $builder->add('code','text');
        $builder->add('publishinghouse','text');
        
        $builder->add('submit','submit');
    }

    public function getName()
    {
        return 'book';
    }
}
