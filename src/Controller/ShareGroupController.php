<?php
/**
 * Created by PhpStorm.
 * User: prive
 * Date: 14/12/2018
 * Time: 13:50
 */

namespace App\Controller;


use App\Entity\Person;
use App\Entity\ShareGroup;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PersonController
 * @package App\Controller
 * @Route("/sharedgroup")
 */
class ShareGroupController extends BaseController
{

    /**
     * @Route("/{slug}", name="sharegroup_get", methods="GET")
     */
    public function index(ShareGroup $shareGroup )
    {

        return $this->json($this->serialize($shareGroup));
    }


    /**
     * @Route("/", name="sharegroup_get", methods="GET")
     */
    public function getAllSharedGroup(): Response
    { $shareGroup = $this->getDoctrine()->getRepository(ShareGroup::class)
        ->createQueryBuilder('s')
        ->getQuery()
        ->getArrayResult();

        return $this->json($shareGroup);
    }

    /**
     * @Route("/", name="sharegroup_new", methods="POST")
     */
    public function new(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();

        $sharegroup = new ShareGroup();
        $sharegroup->setSlug($jsonData["slug"]);
        $sharegroup->setCreatedAt(new \DateTime());
        $sharegroup->setClosed(false);

        $em->persist($sharegroup);
        $em->flush();

        return $this->json($this->serialize($sharegroup));
    }



}