<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Exp", mappedBy="users",cascade={"persist"})
     */
    private $exps;

    public function __construct()
    {
        $this->exps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * @return Collection|Exp[]
     */
    public function getExps(): Collection
    {
        return $this->exps;
    }

     /**
     * @return Collection|Exp[]
     */
    public function getExp(): Collection
    {
        return $this->getExps();
    }


    public function addExp(Exp $exp): self
    {
        if (!$this->exps->contains($exp)) {
            $this->exps[] = $exp;
            $exp->setUsers($this);
        }

        return $this;
    }

    public function removeExp(Exp $exp): self
    {
        if ($this->exps->contains($exp)) {
            $this->exps->removeElement($exp);
            // set the owning side to null (unless already changed)
            if ($exp->getUsers() === $this) {
                $exp->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * toString
     * @return string
     */
 
    public function __toString()
    {
        return $this->fullname;
    }

}
