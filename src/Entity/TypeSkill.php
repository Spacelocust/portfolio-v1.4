<?php

namespace App\Entity;

use App\Repository\TypeSkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TypeSkillRepository::class)
 */
class TypeSkill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=StackTech::class, mappedBy="typeSkill")
     */
    private $skill;

    public function __construct()
    {
        $this->skill = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|StackTech[]
     */
    public function getSkill(): Collection
    {
        return $this->skill;
    }

    public function addSkill(StackTech $skill): self
    {
        if (!$this->skill->contains($skill)) {
            $this->skill[] = $skill;
            $skill->setTypeSkill($this);
        }

        return $this;
    }

    public function removeSkill(StackTech $skill): self
    {
        if ($this->skill->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getTypeSkill() === $this) {
                $skill->setTypeSkill(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
