<?php

namespace App\Controller;

use App\Entity\Actu;
use App\Entity\Shitcoin;
use App\Entity\Transaction;
use App\Form\BuyshitType;
use App\Form\BuyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DropdownController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/shitcoin', name: 'shit')]
    public function index(): Response
    {

        $shitcoin = $this->entityManager->getRepository(Shitcoin::class)->findAll();
        return $this->render('dropdown/index.html.twig', [
            'shitcoin' => $shitcoin,
        ]);
    }

    #[Route('/actualite', name: 'actu')]
    public function actu(): Response
    {

        $actu = $this->entityManager->getRepository(Actu::class)->findAll();
        return $this->render('dropdown/actualite.html.twig', [
            'actualite' => $actu,
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function resp(): Response
    {

        $shitcoin = $this->entityManager->getRepository(Shitcoin::class)->findAll();
        return $this->render('dropdown/actualite.html.twig', [
            'shitcoin' => $shitcoin,
        ]);
    }
    #[Route('/shitcoin/{slug}', name: 'shitBuy')]
    public function shit($slug,Request $request): Response
    {


        $buy = new Transaction();
        $buyform = $this->createForm(BuyshitType::class, $buy,[
            'attr' =>
                [
                    'class'=>'currency_validate',
                    'name'=>'myform'
                ]
        ]);






        $shitcoin = $this->entityManager->getRepository(Shitcoin::class)->findOneById($slug);
        $transaction = $this->getDoctrine()->getRepository(Transaction::class)->findBy(array(), array('id' => 'desc'),1,0);

        $user = $this->getUser();

        $buyform->handleRequest($request);
        if( $buyform->isSubmitted() &&  $buyform->isValid()){
            $buy =  $buyform->getData();

            $email = $user->getEmail();
            $buy->setType('shitAchat');
            $buy->setReceiveM('valeur sera affiche ');
            $buy->setEmail($email);
            $buy->setIspaid(false);
            $buy->setDate(new \DateTime('now'));


            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($buy);
            $doctrine->flush();

            return $this->redirectToRoute('shit');


        }
        return $this->render('user_page/exchange2.html.twig', [
            'shitcoin' => $shitcoin,
            'buy'=>$buyform->createView(),
            'transaction'=>$transaction,

        ]);
    }
}
