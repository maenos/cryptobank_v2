<?php

namespace App\Controller\Admin;

use App\Entity\Actu;
use App\Entity\Shitcoin;
use App\Entity\Transaction;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashController extends AbstractDashboardController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $client = $this->entityManager->getRepository(User::class);
        $clientAll = $client->findAll();

        $clientNum = count($clientAll);

        $commande = count( $this->entityManager->getRepository(Transaction::class)->findAll());

        $order = $this->entityManager->getRepository(Transaction::class)->findBy([],['date'=>'DESC'],'3');



        return $this->render('access/dashboard.html.twig',[
            'num'=>$clientNum,
            'produit'=>'2',
            'order'=>$commande,
            'commande'=>$order

        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cryptobank V2');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('user', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Transaction', 'fas fa-list', Transaction::class);
        yield MenuItem::linkToCrud('actualite', 'fas fa-list', Actu::class);
        yield MenuItem::linkToCrud('shitcoin', 'fas fa-list', Shitcoin::class);



    }



    public function configureCrud(): Crud
    {
        return Crud::new()
            // ...

            // the first argument is the "template name", which is the same as the
            // Twig path but without the `@EasyAdmin/` prefix

            ->overrideTemplates([
                'layout' => 'bundles/EasyAdminBundle/default/layout.html.twig',
                'main_menu' => 'bundles/EasyAdminBundle/default/menu.html.twig',


            ])
            ;
    }
}
