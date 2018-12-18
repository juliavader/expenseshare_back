<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\ShareGroup;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonController
 * @package App\Controller
 * @Route("/person")
 */
class PersonController extends BaseController
{

    /**
     * @Route("/group/{slug}", name="person_list", methods="GET")
     * @param ShareGroup $shareGroup
     * @return Response
     */
    public function index(ShareGroup $shareGroup): Response
    {
        $persons = $this->getDoctrine()->getRepository(Person::class)
            ->createQueryBuilder('p')
            ->select('p', 'e')
            ->leftJoin('p.expenses', 'e')
            ->where('p.shareGroup = :group')
            ->setParameter(':group', $shareGroup)
            ->getQuery()
            ->getArrayResult()
        ;

        return $this->json($persons);

    }

}