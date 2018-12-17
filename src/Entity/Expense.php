<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expense
 *
 * @ORM\Table(name="expense", indexes={@ORM\Index(name="fk_expense_person1_idx", columns={"person_id"}), @ORM\Index(name="fk_expense_category1_idx", columns={"category_id"})})
 * @ORM\Entity
 */
class Expense
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $amount = '0.00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     * })
     */
    private $person;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Expense
     */
    public function setId(int $id): Expense
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Expense
     */
    public function setTitle(string $title): Expense
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     * @return Expense
     */
    public function setAmount(string $amount): Expense
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Expense
     */
    public function setCreatedAt(\DateTime $createdAt): Expense
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \Category
     */
    public function getCategory(): \Category
    {
        return $this->category;
    }

    /**
     * @param \Category $category
     * @return Expense
     */
    public function setCategory(\Category $category): Expense
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return \Person
     */
    public function getPerson(): \Person
    {
        return $this->person;
    }

    /**
     * @param \Person $person
     * @return Expense
     */
    public function setPerson(\Person $person): Expense
    {
        $this->person = $person;
        return $this;
    }



}
