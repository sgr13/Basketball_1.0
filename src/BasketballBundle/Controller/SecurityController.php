<?php
namespace BasketballBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class LoginController extends Controller
{
    /**
     * @Route("/logina", name="login2")
     */
    public function loginAction()
    {
        if ($this->getUser()) {
            return $this->redirect('/');
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'errors' => $errors,
            'username' => $lastUserName
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
//        return $this->redirect('index');
    }
}


