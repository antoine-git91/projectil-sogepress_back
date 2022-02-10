<?php

namespace App\Controller;

use App\Entity\Magazine;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MagazinesByClientController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): array
    {
        $query = $request->get('id_client');
        $magazine = ['id_client' => $query];
        return $this->entityManager->getRepository(Magazine::class)->findBy(['client' => $magazine]);
    }
}