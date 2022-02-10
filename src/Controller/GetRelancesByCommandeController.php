<?php

namespace App\Controller;

use App\Entity\Relance;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetRelancesByCommandeController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): array
    {
        $query = $request->get('id_commande');
        $commandeId = ['id_commande' => $query];
        return $this->entityManager->getRepository(Relance::class)->getRelancesValidByCommande(['commande' => $commandeId]);
    }
}