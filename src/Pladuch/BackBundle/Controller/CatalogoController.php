<?php

namespace Pladuch\BackBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CatalogoController extends Controller
{
    /**
     * @Template("PladuchBackBundle:catalogo:index.html.twig")
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}
