<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Expense;
use App\Entity\Person;
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
            ->orderBy('e.createdAt','DESC')
            ->where('p.shareGroup = :group')
            ->setParameter(':group', $shareGroup)
            ->getQuery()
            ->getArrayResult();


            return $this->json($exps);

    }


    /**
     * @Route("/", name="expense_new", methods="POST")
     */

    public function new_Expense(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);
        $category = $this->getDoctrine()->getRepository(Category::class)->find($jsonData["category"]);
        $person = $this->getDoctrine()->getRepository(Person::class)->find($jsonData["person"]);

        $em = $this->getDoctrine()->getManager();

        $expense = new Expense();
        $expense->setTitle($jsonData["title"]);
        $expense->setAmount($jsonData["amount"]);
        $expense->setCreatedAt(new \DateTime());
        $expense->setCategory($category);
        $expense->setPerson($person);



        $em->persist($expense);
        $em->flush();

        $exp = $this->getDoctrine()->getRepository(Expense::class)
            ->createQueryBuilder('e')
            ->where('e.id = :id')
            ->setParameter(':id', $expense->getId())
            ->getQuery()
            ->getArrayResult();

        return $this->json($exp[0]);
    }

    /**
     * @Route("/", name="expense_delete", methods="DELETE")
     */
    public function delete(Request $request): Response
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $person = $this->getDoctrine()->getRepository(expense::class)->find($jsonData["expense"]);

        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();

        return $this->json(["ok" => true]);

    }


}