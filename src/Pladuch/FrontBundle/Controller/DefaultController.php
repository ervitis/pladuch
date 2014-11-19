<?php

namespace Pladuch\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PladuchFrontBundle:Default:index.html.twig', array('name' => 'good'));
    }
}
