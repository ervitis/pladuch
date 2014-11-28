<?php

namespace Pladuch\BackBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class SgaController extends Controller
{
    /**
     * @Template("PladuchBackBundle:sga:index.html.twig")
     *
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        return array('user' => $user);
    }
}
