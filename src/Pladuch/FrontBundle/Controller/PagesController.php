<?php

namespace Pladuch\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function indexAction()
    {
        return $this->render('PladuchFrontBundle:front:index.html.twig');
    }
}
