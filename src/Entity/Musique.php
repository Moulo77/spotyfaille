<?php

namespace App\Entity;

use App\Repository\MusiqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: MusiqueRepository::class)]
#[Vich\Uploadable]
class Musique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'string', length: 255)]
    private $son;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[Vich\UploadableField(mapping: 'fichier_son', fileNameProperty: 'son')]
    /**
     * @var File
     */
    private $fichierSon;

    #[ORM\ManyToOne(targetEntity: Artiste::class, inversedBy: 'musiques')]
    private $artiste;

    #[ORM\ManyToOne(targetEntity: Style::class, inversedBy: 'musiques')]
    private $style;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSon(): ?string
    {
        return $this->son;
    }

    public function setSon(string $son): self
    {
        $this->son = $son;

        return $this;
    }

    public function getFichierSon()
    {
        return $this->fichierSon;
    }

    public function setFichierSon(File $fichierSon = null): void
    {
        $this->fichierSon = $fichierSon;

        if($fichierSon){
            $this->createdAt = new \DateTime('now');
        }
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getStyle(): ?Style
    {
        return $this->style;
    }

    public function setStyle(?Style $style): self
    {
        $this->style = $style;

        return $this;
    }
}
