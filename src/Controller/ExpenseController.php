<?php

namespace App\Controller;

use App\Entity\Expense;
use App\Entity\ShareGroup;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExpenseController
 * @package App\Controller
 * @Route("/expense")
 */
class ExpenseController extends BaseController
{
    /**
     * @Route("/group/{slug}", name="expense_list", methods="GET")
     */
    public function index(ShareGroup $shareGroup): Response
    {
        $exps = $this->getDoctrine()->getRepository(Expense::class)
            ->createQueryBuilder('e')
            ->select('e', 'p', 'ps')
            ->innerjoin('e.person', 'p')
            ->innerjoin('p.shareGroup', 'ps')
            ->where('p.shareGroup = :group')
            ->setParameter(':group', $shareGroup)
            ->getQuery()
            ->getArrayResult();


            return $this->json($exps);

    }

}