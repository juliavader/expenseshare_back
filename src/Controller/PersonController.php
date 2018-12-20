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
            ->orderBy('p.id', 'DESC')
            ->where('p.shareGroup = :group')
            ->setParameter(':group', $shareGroup)
            ->getQuery()
            ->getArrayResult()
        ;

        return $this->json($persons);

    }

    /**
     * @return Response
     * @Route("/Group/{slug}", name="Person_All", methods="GET")
     */
    public function getAllPersons(ShareGroup $shareGroup): Response
    {
        $persons = $this->getDoctrine()->getRepository(Person::class)
            ->createQueryBuilder('p')
            ->where('p.shareGroup = :group')
            ->setParameter(':group', $shareGroup)
            ->getQuery()
            ->getArrayResult();

        return $this->json($persons);

    }


    /**
     * @Route("/", name="person_new", methods="POST")
     */

    public function new_Person(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $sharedgroup = $this->getDoctrine()->getRepository(ShareGroup::class)->findOneBySlug($jsonData["sharedgroup"]);
        $em = $this->getDoctrine()->getManager();

        $person = new Person();
        $person->setFirstname($jsonData["firstname"]);
        $person->setLastname($jsonData["lastname"]);
        $person->setShareGroup($sharedgroup);


        $em->persist($person);
        $em->flush();

        return $this->json($this->serialize($person));
    }


    /**
     * @Route("/", name="person_delete", methods="DELETE")
     */
    public function delete(Request $request): Response
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $person = $this->getDoctrine()->getRepository(Person::class)->find($jsonData["person"]);

        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();

        return $this->json(["ok" => true]);

    }




}