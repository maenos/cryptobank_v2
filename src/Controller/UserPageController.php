<?php

namespace App\Controller;
use App\Entity\Transaction;
use App\Form\BuyType;
use App\Form\SellType;
use App\Service\CallApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function exchange(CallApi  $api, Request $request): Response
    {
        $user = $this->getUser();

        $id= uniqid();


        $cu = $api->Content();


        $buy = new Transaction();
        $buyform = $this->createForm(BuyType::class, $buy,[
            'attr' =>
                [
                    'class'=>'currency_validate',
                    'name'=>'myform'
                ]
        ]);



        $buyform->handleRequest($request);
        if( $buyform->isSubmitted() &&  $buyform->isValid()){
             $buy =  $buyform->getData();
             $email = $user->getEmail();
            $buy->setType('achat');
            $buy->setEmail($email);
            $buy->setStatus('attente');
            $buy->setDate(new \DateTime('now'));



            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($buy);
            $doctrine->flush();

            return $this->redirectToRoute('exchange');


        }
        $sell = new Transaction();
        $sellform = $this->createForm(SellType::class, $sell,[
            'attr' =>
                [
                    'class'=>'currency2_validate',
                    'name'=>'myform'
                ]
        ]);



        $sellform->handleRequest($request);
        if( $sellform->isSubmitted() &&  $sellform->isValid()){

            $sell =  $sellform->getData();
            $email = $user->getEmail();


            $sell->setType('vente');
            $sell->setEmail($email);
            $sell->setStatus('attente');
            $sell->setDate(new \DateTime('now'));

             $sell->setTxid($id);

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($sell);
            $doctrine->flush();

            return $this->redirectToRoute('exchange');


        }
        $transaction = $this->getDoctrine()->getRepository(Transaction::class)->findBy(array(), array('id' => 'desc'),1,0);

        return $this->render('user_page/exchange.html.twig', [
            'controller_name' => 'UserPageController',
            'crypto'=> $cu,
            'buy'=>$buyform->createView(),
            'transaction'=> $transaction,
            'sell'=>$sellform->createView(),
            'id'=>$id
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
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
