<?php

namespace App\Controller;

use App\Entity\Person;
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
     * @Route("/", name="person_list", methods="GET")
     */
    public function index(Request $request): Response
    {
        $exps = $this->getDoctrine()->getRepository(Person::class)
            ->createQueryBuilder('p')
            ->getQuery()
            ->getArrayResult();


        if ($request->isXMLHttpRequest()) {
            return $this->json($exps);
        }
    }

}