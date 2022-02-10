<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetNumberClientCurrentMonthByUserController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function __invoke(Request $request)
    {
        $query = $request->get('id_user');
        $clientId = ['id_user' => $query];
        $clients = $this->entityManager->getRepository(Client::class)->getClientsMonth(['user' => $clientId]);
        if(is_null($clients)){
            return "0";
        }
        return $clients;
    }
}