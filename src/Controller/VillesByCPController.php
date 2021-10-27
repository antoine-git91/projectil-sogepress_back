<?php


namespace App\Controller;


use App\Entity\Ville;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VillesByCPController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): array
    {
        $query = $request->get('code_postal');
        $codePostal = ['code_postal' => $query];
        return $this->entityManager->getRepository(Ville::class)->findBy(['codePostal' => $codePostal]);
    }
}