<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $nom_livre;

    /**
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="integer")
     */
    private $refEni;

    /**
     * @ORM\Column(type="text")
     */
    private $isbn;

    /**
     * @ORM\Column(type="boolean")
     */
    private $site;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLivre(): ?string
    {
        return $this->nom_livre;
    }

    public function setNomLivre(string $nom_livre): self
    {
        $this->nom_livre = $nom_livre;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getRefEni(): ?int
    {
        return $this->refEni;
    }

    public function setRefEni(int $refEni): self
    {
        $this->refEni = $refEni;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getSite(): ?bool
    {
        return $this->site;
    }

    public function setSite(bool $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
}
