<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 24.03.18
 * Time: 18:06
 */

namespace BasketballBundle\Controller;


use BasketballBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use BasketballBundle\Form\UserType;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction(Request $request)
    {

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $user = new User();
        $form = $this->createForm(UserType::class,
            array(
                 'login' => $lastUsername
            ),
            array(
                'action' => $this->generateUrl('security_login'),
                'method' => 'POST',
        ));

//        $form->handleRequest($request);

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {

    }
}