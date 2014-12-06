<?php

namespace Pladuch\BackBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MuestrasController extends Controller
{
    /**
     * @Template("PladuchBackBundle:muestras:index.html.twig")
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}
