<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 26.03.18
 * Time: 21:47
 */

namespace BasketballBundle\Controller\Admin;


use BasketballBundle\Entity\NextGame;
use BasketballBundle\Entity\Player;
use BasketballBundle\Entity\PlayersList;
use BasketballBundle\Form\CalendarType;
use BasketballBundle\Form\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// * @Security("is_granted('ROLE_ADMIN_PANEL')")

/**
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
     * @Route("/stepTwo/{date}/{place}", name="step_two")
     */
    public function stepTwoAction($date, $place)
    {
        $em = $this->getDoctrine()->getManager();
        $lastGame = $em->getRepository('BasketballBundle:NextGame')->findAll();

        if (!empty($lastGame)) {
            $em->remove($lastGame[0]);
            $em->flush();
        }

        $newPlayersList = new PlayersList();
        $em->persist($newPlayersList);
        $em->flush();

        $nextGame = new NextGame();
        $nextGame->setDate($date);
        $nextGame->setPlace($place);
        $nextGame->setPlayersList($newPlayersList);

        $em->persist($nextGame);
        $em->flush();
        $this->addFlash('success', 'Dodałeś nowe spotkanie!');
        return $this->redirect('/adminPanel');
    }

    /**
     * @Route("/addPlayerToUser", name="addPlayerToUser")
     */
    public function addPlayerToUserAction(Request $request)
    {
        if ($request->request->get('userId')) {
            $user = $this->getDoctrine()->getRepository('BasketballBundle:Player')
                    ->checkIfUserPlayerExists($request->request->get('userId'));
            if (empty($user)) {
                return new JsonResponse('u/' . $request->request->get('userId'));
            } else {
                return new JsonResponse('p/' . $user[0]['id']);
            }

        }

        $form = $this->createForm(PlayerType::class);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $player = $form->getData();
            $player->setGames(0);

            $photoFront = $player->getPhotoFront();
            $pathToImg = $request->server->get('DOCUMENT_ROOT').$request->getBasePath() . '/photos';

            $photoFrontName = md5(uniqid()) . '.' . $photoFront->guessExtension();

            $photoFront->move(
                $pathToImg,
                $photoFrontName
            );

            $player->setPhotoFront($photoFrontName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            return $this->redirect('/adminPanel');
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
        $users = $this->getDoctrine()
            ->getRepository('BasketballBundle:User')
            ->find($request->request->get('userId'));

        if ($request->request->get('userId')) {
            $form = $this->createForm(PlayerType::class);
            dump($form);
            return new JsonResponse($form);
        }

    }

    /**
     * @Route("/playerEditByAdmin/{id}", name="playerEditByAdmin")
     */
    public function playerEditByAdmin(Request $request, Player $player)
    {
        $form = $this->createForm(PlayerType::class, $player, array('noPhoto' => true));
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $player = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            return $this->redirect('/adminPanel');
        }

        return $this->render('Admin/playerEditByAdmin.html.twig', array(
            'form' => $form->createView()
        ));
    }
}