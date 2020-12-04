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
    private $ref_eni;

    /**
     * @ORM\Column(type="text")
     */
    private $isbn;

    /**
     * @ORM\Column(type="text")
     */
    private $nom_livre;

    /**
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $auteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $filiere_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $categorie_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefEni(): ?string
    {
        return $this->ref_eni;
    }

    public function setRefEni(string $ref_eni): self
    {
        $this->ref_eni = $ref_eni;

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

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getFiliereId(): ?int
    {
        return $this->filiere_id;
    }

    public function setFiliereId(int $filiere_id): self
    {
        $this->filiere_id = $filiere_id;

        return $this;
    }

    public function getCategorieId(): ?int
    {
        return $this->categorie_id;
    }

    public function setCategorieId(int $categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }
}
