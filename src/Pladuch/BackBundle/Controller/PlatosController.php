<?php

namespace Pladuch\BackBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlatosController extends Controller
{
    /**
     * @Template("PladuchBackBundle:platos:index.html.twig")
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}
