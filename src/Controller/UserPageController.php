<?php

namespace App\Controller;

use App\Service\CallApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserPageController extends AbstractController
{

    #[Route('/home', name: 'user_page')]
    public function index(CallApi  $api): Response
    {
        $crypto = $api->Content();

        return $this->render('user_page/index.html.twig', [
            'crypto' => $crypto
        ]);
    }

    #[Route('/buy_sell', name: 'exchange')]
    public function exchange(): Response
    {
        return $this->render('user_page/exchange.html.twig', [
            'controller_name' => 'UserPageController',
        ]);
    }

    #[Route('/account', name: 'account')]
    public function account(): Response
    {
        return $this->render('user_page/compte.html.twig', [
            'controller_name' => 'UserPageController',
        ]);
    }

    #[Route('/setting', name: 'setting')]
    public function setting(): Response
    {
        return $this->render('user_page/repair.html.twig', [
            'controller_name' => 'UserPageController',
        ]);
    }
}
