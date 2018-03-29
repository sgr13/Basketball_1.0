<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 26.03.18
 * Time: 21:47
 */

namespace BasketballBundle\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @package BasketballBundle\Controller\Admin
 */
class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        //łatwy sposób sprawdzenia praw dostępu!
//        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return new Response('<html><body><h1>Witaj Adminie!!!!</h1></body></html>');
    }

}