<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @Vich\Uploadable()
 */
class Project
{
    public function __construct(){
        $this->updateAt = new \DateTime();
        $this->date_start = new \DateTime();
        $this->date_end = new \DateTime();
    }

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
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $appraisal;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="date")
     */
    private $date_start;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="date")
     */
    private $date_end;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link_project;

    /**
     * @Assert\NotBlank(message="Veuillez indiquer la/ ou les technoligie(s) utilisée(s)")
     * @ORM\Column(type="string", length=255)
     */
    private $languageTech;

    /**
     * @ORM\Column(type="boolean", length=1)
     */
    private bool $isDocument = false;

    /**
     * @Assert\NotBlank( message="Veuillez insérer une image")
     * @var string|null $picture
     * @ORM\Column(type="string",length=255)
     */
    private ?string $picture = null;

    /**
     * @var File|null $pictureFile
     * @Vich\UploadableField(mapping="pictures_project", fileNameProperty="picture")
     */
    private ?File $pictureFile = null;

    /**
     * @var string|null $document
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private ?string $document = null;

    /**
     * @var File|null $documentFile
     * @Vich\UploadableField(mapping="doc_project", fileNameProperty="document")
     */
    private ?File $documentFile = null;

    /**
     * @var \DateTimeInterface|null
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     */
    public function setPicture(?string $picture = null): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return File
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getLinkProject(): ?string
    {
        return $this->link_project;
    }

    public function setLinkProject(?string $link_project): self
    {
        $this->link_project = $link_project;

        return $this;
    }

    public function getLanguageTech(): ?string
    {
        return $this->languageTech;
    }

    public function setLanguageTech(string $languageTech): self
    {
        $this->languageTech = $languageTech;

        return $this;
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

    /**
     * @return string|null
     */
    public function getDocument(): ?string
    {
        return $this->document;
    }

    /**
     * @param string|null $document
     */
    public function setDocument(?string $document): self
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getDocumentFile(): ?File
    {
        return $this->documentFile;
    }

    /**
     * @param File|null $documentFile
     */
    public function setDocumentFile(?File $documentFile): void
    {
        $this->documentFile = $documentFile;
        if($documentFile){
            $this->updateAt = new \DateTime();
            $this->isDocument = true;
        }
    }

    public function getSlug(): string
    {
        return 'doc-'.$this->title;
    }

    /**
     * @return bool
     */
    public function isDocument(): bool
    {
        return $this->isDocument;
    }

    /**
     * @param bool $isDocument
     */
    public function setIsDocument(bool $isDocument): void
    {
        $this->isDocument = $isDocument;
    }

    /**
     * @return mixed
     */
    public function getAppraisal()
    {
        return $this->appraisal;
    }

    /**
     * @param mixed $appraisal
     */
    public function setAppraisal($appraisal): self
    {
        $this->appraisal = $appraisal;

        return $this;
    }
}
