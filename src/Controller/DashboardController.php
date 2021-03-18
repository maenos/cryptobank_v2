<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(): Response
    {

        return $this->render('cryptobank/landing.html.twig', [
            'controller_name' => 'DashboardController'
        ]);
    }

    /**
     * @Route("/connecter", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('user_page');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('cryptobank/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/s'inscrire", name="register", methods={"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param FlashyNotifier $flashy
     * @return Response
     */
    public function register(Request $request,UserPasswordEncoderInterface  $encoder,FlashyNotifier $flashy): Response
    {
        $user = new User();
        $form = $this->createForm(LoginType::class, $user,
        [
            'attr' =>
            [
                'class'=>'signup_validate',
                'name'=>'myform'
            ]
        ]
        );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();

            $password = $encoder->encodePassword($user,$user->getPassword());


            $user->setPassword($password);


            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($user);
            $doctrine->flush();

            $flashy->success('inscription reuissit avec succes', 'http://your-awesome-link.com');
            return $this->redirectToRoute('dashboard');

        }

        return $this->render('cryptobank/register.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/reset", name="reset")
     */
    public function reset(): Response
    {
        return $this->render('cryptobank/reset.html.twig', [
            'controller_name' => 'DashboardController'
        ]);

    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('cryptobank/about.html.twig', [
            'controller_name' => 'DashboardController'
        ]);
    }
    /**
     * @Route("/condition", name="condition")
     */
    public function cond(): Response
    {
        return $this->render('cryptobank/condition.html.twig', [
            'controller_name' => 'DashboardController'
        ]);
    }
    /**
     * @Route("/private", name="privacy")
     */
    public function privat(): Response
    {
        return $this->render('cryptobank/privacy.html.twig', [
            'controller_name' => 'DashboardController'
        ]);
    }
}
