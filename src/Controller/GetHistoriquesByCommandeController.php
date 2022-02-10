<?php

namespace App\Controller;

use App\Entity\HistoriqueClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetHistoriquesByCommandeController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): array
    {
        $query = $request->get('id_commande');
        $Client = ['id_commande' => $query];
        return $this->entityManager->getRepository(HistoriqueClient::class)->findBy(['commande' => $Client], ["createdAt" => "DESC"]);
    }
}