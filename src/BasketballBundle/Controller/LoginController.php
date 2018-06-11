<?php
namespace BasketballBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        if ($this->getUser()) {
            return $this->redirect('/');
        }

        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', array(
            'errors' => $errors,
            'login' => $lastUserName
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


