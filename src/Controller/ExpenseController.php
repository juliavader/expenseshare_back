<?php

namespace App\Controller;

use App\Entity\Expense;
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
     * @Route("/", name="expense_list", methods="GET")
     */
    public function index(Request $request): Response
    {
        $exps = $this->getDoctrine()->getRepository(Expense::class)
            ->createQueryBuilder('e')
            ->select('e', 'ep')
            ->innerjoin('e.person', 'ep')
            ->getQuery()
            ->getArrayResult();


        if ($request->isXMLHttpRequest()) {
            return $this->json($exps);
        }
    }

}