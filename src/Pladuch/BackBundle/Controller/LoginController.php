<?php

namespace Pladuch\BackBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class LoginController extends Controller
{
    /**
     * @Template("PladuchBackBundle:login:login.html.twig")
     *
     * @return array
     */
    public function indexAction()
    {
        return array(
            'error'         => false,
            'last_username' => '',
        );
    }

    /**
     * @Template("PladuchBackBundle:login:login.html.twig")
     *
     * @param Request $request
     * @return array
     */
    public function loginAction(Request $request)
    {
        $security = $this->get('security.context');
        if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl(''));
        }

        $session = $request->getSession();

        $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        if (! $error) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

}
