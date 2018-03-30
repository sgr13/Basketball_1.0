<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 26.03.18
 * Time: 21:47
 */

namespace BasketballBundle\Controller\Admin;


use BasketballBundle\Services\Calendar;
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
     * @var Calendar
     */
    private $calendar;

    public function __construct()
    {

        $this->calendar = new Calendar();
    }

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
     * @param Request $request
     * @param Calendar $calendar
     * @return JsonResponse|Response
     */
    public function addNextGameAction(Request $request)
    {
        $presentDay = $this->calendar->getPresentDayCalendar();
        dump($presentDay);
        dump($this->calendar);
        if($request->request->get('selectedMonth') && $request->request->get('selectedYear')){

            $selectedMonth = $request->request->get('selectedMonth');
            $selectedYear = $request->request->get('selectedYear');
            $calendar = $this->calendar->getChosenDayCalendar($selectedMonth, $selectedYear);

            return new JsonResponse($calendar);
        }

        return $this->render('Admin/add_next_game.html.twig', array(
            'calendar' => $this->calendar,
            'presentDay' => $presentDay
        ));
    }
}