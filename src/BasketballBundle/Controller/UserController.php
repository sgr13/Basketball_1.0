<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 26.03.18
 * Time: 23:28
 */

namespace BasketballBundle\Controller;


use BasketballBundle\Entity\User;
use BasketballBundle\Form\UserRegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm(UserRegistrationForm::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $user->setRoles(array(0 => 'ROLE_USER'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Welcome ' . $user->getLogin());

            return $this->redirectToRoute('main');
        }

        return $this->render('user/register.html.twig', array(
           'form' => $form->createView()
        ));
    }
}