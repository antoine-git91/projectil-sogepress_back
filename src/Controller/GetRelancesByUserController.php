<?php

namespace App\Controller;

use App\Entity\Relance;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetRelancesByUserController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): array
    {
        $query = $request->get('id_user');
        $clientId = ['id_user' => $query];
        return $this->entityManager->getRepository(Relance::class)->findBy(['user' => $clientId]);
    }
}