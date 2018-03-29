<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 24.03.18
 * Time: 19:45
 */

namespace BasketballBundle\Security;


use BasketballBundle\Form\UserType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    private $formFactory;

    private $em;

    private $router;

    private $passwordEncoder;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router, UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getCredentials(Request $request)
    {
        //sprawdzamy czy jest to zwykła strona czy też strona logowania z akcją -POST
        $isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');

        if (!$isLoginSubmit) {
            return;
        }

        //Jeżeli zwrócimy jakakolwiek wartość nie będącą null-em, przechodzimy do kolejnego kroku($data = $credentials)

        $form = $this->formFactory->create(UserType::class);
        $form->handleRequest($request);

        $data = $form->getData();


        //w ten sposób po błędnym logowaniu nazwa użytkownika zostaje w polu login
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['login']
        );

        return $data;

    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['login'];

        return $this->em->getRepository('BasketballBundle:User')
            ->findOneBy(array('login' => $username));
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['password'];

        if ($this->passwordEncoder->isPasswordValid($user, $password)) {
            return true;
        }

        return false;
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('security_login');
    }

//    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
//    {
//        $targetPath = $this->getTargetPath($request->getSession(), $providerKey);
//
//        if (!$targetPath) {
//            $targetPath = $this->router->generate('security_login');
//        }
//
//        return new RedirectResponse($targetPath);
//    }

    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('success');
    }
}