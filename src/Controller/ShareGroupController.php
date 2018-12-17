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
     * @Route("/check", name="sharegroup_check", methods="POST")
     */
    /*
    public function check(Request $request): Response
    {
        $slug = $request->get('slug');
        $slug = $request->request->get('slug');

        $sharegroup = $this->getDoctrine()->getRepository(ShareGroup::class)->findOneBySlug($slug);

        if ($request->isXMLHttpRequest()) {
            return $this->json($sharegroup);
        }
    }
    */

    /**
     * @Route("/check/{slug}", name="sharegroup_check", methods="GET")
     */
    public function check(ShareGroup $sharegroup,Request $request): Response
    {
        if ($request->isXMLHttpRequest()) {
            return $this->json($sharegroup);
        }
    }

    /**
     * @Route("/", name="sharegroup_list", methods="GET")
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