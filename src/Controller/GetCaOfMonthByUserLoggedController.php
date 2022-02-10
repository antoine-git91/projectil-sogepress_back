<?php

namespace App\Controller;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetCaOfMonthByUserLoggedController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route(
     *     name="getCaOfMonthByUserLogged",
     *     path="/getCaOfMonthByUserLogged/{id_user}",
     *     methods={"GET","OPTIONS"},
     * )
     * @param Request $request
     * @return string
     */
    public function __invoke(Request $request): string
    {
        $query = $request->get('id_user');
        $clientId = ['id_user' => $query];
        $ca = $this->entityManager->getRepository(Commande::class)->getCa(['user' => $clientId]);
        if(is_null($ca)){
            return "0";
        }
        return $ca;
    }
}