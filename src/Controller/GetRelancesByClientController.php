<?php

namespace App\Controller;

use App\Entity\Relance;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetRelancesByClientController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): array
    {
        $query = $request->get('id_client');
        $clientId = ['id_client' => $query];
        return $this->entityManager->getRepository(Relance::class)->getRelancesValidByClient(['client' => $clientId]);
    }
}