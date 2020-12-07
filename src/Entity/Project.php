<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @Vich\Uploadable()
 */
class Project
{
    public function __construct(){
        $this->updateAt = new \DateTime();
    }
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="date")
     */
    private $date_start;

    /**
     * @ORM\Column(type="date")
     */
    private $date_end;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link_doc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link_project;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $languageTech;

    /**
     * @var string|null $picture
     * @ORM\Column(type="string",length=255)
     */
    private ?string $picture = null;

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
     * @var File $pictureFile
     * @Vich\UploadableField(mapping="pictures_directory", fileNameProperty="picture")
     */
    private File $pictureFile;

    /**
     * @return File
     */
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * @var \DateTimeInterface|null
     * @ORM\Column(type="datetime")
     */
    private $updateAt;


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

    public function getLinkDoc(): ?string
    {
        return $this->link_doc;
    }

    public function setLinkDoc(?string $link_doc): self
    {
        $this->link_doc = $link_doc;

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

    public function getUploadDir()
    {
        return '';
    }

    public function setUploadDir(string $dir)
    {
        dump($dir); die;
        return '';
    }
}
