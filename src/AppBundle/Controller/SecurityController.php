<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SecurityController
 *
 * @package AppBundle\Controller
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error'         => $error,
            ]
        );
    }

    /**
     * @Route("/admin", name="security_admin")
     */
    public function adminAction(Request $request)
    {
        return $this->render('security/secured.html.twig');
    }

    /**
     * @Route("/user", name="security_user")
     */
    public function userAction(Request $request)
    {
        return $this->render('security/secured.html.twig');
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function registrationAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\RegistrationType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('registration_success');
        }


        return $this->render(
            'security/registration.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/registration/success", name="registration_success")
     */
    public function registrationSuccessAction(Request $request)
    {
        return $this->render('security/registration_success.html.twig');
    }
}
