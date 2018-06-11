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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use BasketballBundle\Form\UserType;

/**
 * Class Maincontroller
 * @Security("is_granted('ROLE_MAIN_PAGE')")
 */
class Maincontroller extends Controller
{
    /**
     * @Route("/main", name="main")
     */
    public function mainAction()
    {
        return $this->render('Main/main.html.twig', array());
    }

    /**
     * @Route("/success", name="success")
     */
    public function successAction()
    {
        return new Response('<html><body><h1>Witaj zalogowany użytkowniku!!!</h1></body></html>');
    }

    /**
     * @Route("/test")
     */
    public function testAction()
    {
        return $this->render('user/test.html.twig', array());
    }
}