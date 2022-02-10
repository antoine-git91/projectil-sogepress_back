<?php

namespace App\Controller;

use App\Entity\SupportMagazine;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class EditionsByMagazineController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): array
    {
        $query = $request->get('magazine_id');
        $magazine = ['magazine' => $query];
        return $this->entityManager->getRepository(SupportMagazine::class)->findBy(['magazine' => $magazine]);
    }
}