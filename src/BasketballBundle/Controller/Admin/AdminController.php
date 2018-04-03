<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 26.03.18
 * Time: 21:47
 */

namespace BasketballBundle\Controller\Admin;


use BasketballBundle\Entity\Player;
use BasketballBundle\Form\CalendarType;
use BasketballBundle\Form\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Security("is_granted('ROLE_ADMIN_PANEL')")
 * @package BasketballBundle\Controller\Admin
 */
class AdminController extends Controller
{
    /**
     * @Route("/adminPanel", name="adminPanel")
     */
    public function adminAction()
    {

        return $this->render('Admin/admin_panel.html.twig', array(
        ));
    }

    /**
     * @Route("/addNextGame", name="addNextGame")
     */
    public function addNextGameAction()
    {

        $form = $this->createForm(CalendarType::class);
        return $this->render('Admin/add_next_game.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/stepTwo/{date}/{place}", name="stem_two")
     */
    public function stepTwoAction($date, $place)
    {
        $em = $this->getDoctrine()->getManager();
        dump($em);
//        dump($date);
//        dump($place);
        die;
    }

    /**
     * @Route("/addPlayerToUser", name="addPlayerToUser")
     */
    public function addPlayerToUserAction(Request $request)
    {
//        dump('ok');die;
        if ($request->request->get('userId')) {

            return new JsonResponse('jest super');
        }

        $form = $this->createForm(PlayerType::class);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            dump($form->getData());die;
        }

        $users = $this->getDoctrine()->getRepository('BasketballBundle:User')->findAll();
        return $this->render('Admin/addPlayerToUser.html.twig', array(
            'users' => $users,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/addPlayerToUserStepTwo", name="addPlayerToUserStepTwo")
     */
    public function addPlayerToUserStepTwoAction(Request $request)
    {
        $player = new Player();

//        dump($player);die;
//        $form = null;
//
//        if ($form->isValid()) {
//
//        }

        $users = $this->getDoctrine()
            ->getRepository('BasketballBundle:User')
            ->find($request->request->get('userId'));

        if ($request->request->get('userId')) {
            $form = $this->createForm(PlayerType::class);
            dump($form);
            return new JsonResponse($form);
        }

    }
}