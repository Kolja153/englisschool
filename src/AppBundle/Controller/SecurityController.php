<?php

namespace AppBundle\Controller;

use AppBundle\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/", name="login")
     * @Template()
     */
    public function loginAction()
    {
        $form = $this->createLoginForm();

        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('security/login.html.twig', array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a form
     *
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createLoginForm()
    {
        $form = $this->createForm(new LoginType(), null, array(
            'action' => $this->generateUrl('login_check'),
            'method' => 'POST',
        ));

        $form->add('login', 'submit', array(
            'label' => 'Війти',
            'attr'  => array(
                'class' => 'btn btn-success submit'
            )
        ));

        return $form;
    }

}
