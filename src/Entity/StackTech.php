<?php

namespace App\Entity;

use App\Repository\StackTechRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=StackTechRepository::class)
 * @Vich\Uploadable()
 */
class StackTech
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
    private $title;

    /**
     * @Assert\NotBlank( message="Veuillez insérer une image")
     * @var string|null $picture
     * @ORM\Column(type="string",length=255)
     */
    private ?string $picture = null;

    /**
     * @var File|null $pictureFile
     * @Vich\UploadableField(mapping="pictures_tech", fileNameProperty="picture")
     */
    private ?File $pictureFile = null;

    /**
     * @var \DateTimeInterface|null
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @Assert\NotBlank( message="Veuillez saisir un type")
     * @ORM\ManyToOne(targetEntity=TypeSkill::class, inversedBy="skill")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeSkill;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     * @return $this
     */
    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * @param File $pictureFile
     */
    public function setPictureFile(File $pictureFile): void
    {
        $this->pictureFile = $pictureFile;
        if($pictureFile){
            $this->updateAt = new \DateTime();
        }
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getSlug(): string
    {
        return 'tech-'.$this->title;
    }

    public function getTypeSkill(): ?TypeSkill
    {
        return $this->typeSkill;
    }

    public function setTypeSkill(?TypeSkill $typeSkill): self
    {
        $this->typeSkill = $typeSkill;

        return $this;
    }
}
