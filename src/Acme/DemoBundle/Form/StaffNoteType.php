<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class StaffNoteType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder->add('mynote','textarea',array(
    'required'    => true,
    ));
$builder->add('noteDate','date', array(
'years' => range(date('Y') -60, date('Y')+3),
'required'    => true,
                     ));
$builder->add('submit','submit');
}

public function getName()
{
return 'staffstudent';
}
}
