<?php

namespace App\Controller;

use App\Entity\Potentialite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetPotentialCustomersController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): array
    {
        $query = $request->get('id_magazine');
        $magazine = ['id_magazine' => $query];
        return $this->entityManager->getRepository(Potentialite::class)->findBy(['magazine' => $magazine]);
    }
}