<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShareGroup
 *
 * @ORM\Table(name="share_group", uniqueConstraints={@ORM\UniqueConstraint(name="slug_UNIQUE", columns={"slug"})})
 * @ORM\Entity
 */
class ShareGroup
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
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="closed", type="boolean", nullable=false)
     */
    private $closed = '0';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ShareGroup
     */
    public function setId(int $id): ShareGroup
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return ShareGroup
     */
    public function setSlug(string $slug): ShareGroup
    {
        $this->slug = $slug;
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
     * @return ShareGroup
     */
    public function setCreatedAt(\DateTime $createdAt): ShareGroup
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->closed;
    }

    /**
     * @param bool $closed
     * @return ShareGroup
     */
    public function setClosed(bool $closed): ShareGroup
    {
        $this->closed = $closed;
        return $this;
    }



    
}
