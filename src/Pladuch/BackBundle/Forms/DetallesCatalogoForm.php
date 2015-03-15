<?php

namespace Pladuch\BackBundle\Forms;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Pladuch\DataBundle\Entity\Idiomas;

class DetallesCatalogoForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $build, array $options)
    {
        $build
            ->add('descripcion', 'textarea')
            ->add('idiomaid', 'entity', array(
                'class'         => 'PladuchDataBundle:Idiomas',
                'property'      => 'iso',
            ))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Pladuch\Data\CatalogoPlatosTraduccion',
        );
    }

    public function getName()
    {
        return 'detalle_plato';
    }
}