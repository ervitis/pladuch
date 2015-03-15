<?php

namespace Pladuch\BackBundle\Forms;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CatalogoForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $formBuilderInterface, array $options)
    {
        $formBuilderInterface
            ->add('nombre')
            ->add('file', 'file');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Pladuch\DataBundle\Entity\CatalogoPlatos'
        );
    }

    public function getName()
    {
        return 'catalogo';
    }
}
