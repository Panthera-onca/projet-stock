<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $site_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $livre_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite_stock;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ajout_retrait;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $date_modification;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiteId(): ?int
    {
        return $this->site_id;
    }

    public function setSiteId(int $site_id): self
    {
        $this->site_id = $site_id;

        return $this;
    }

    public function getLivreId(): ?int
    {
        return $this->livre_id;
    }

    public function setLivreId(int $livre_id): self
    {
        $this->livre_id = $livre_id;

        return $this;
    }

    public function getQuantiteStock(): ?int
    {
        return $this->quantite_stock;
    }

    public function setQuantiteStock(int $quantite_stock): self
    {
        $this->quantite_stock = $quantite_stock;

        return $this;
    }

    public function getAjoutRetrait(): ?int
    {
        return $this->ajout_retrait;
    }

    public function setAjoutRetrait(int $ajout_retrait): self
    {
        $this->ajout_retrait = $ajout_retrait;

        return $this;
    }

    public function getDateModification(): ?\DateTimeImmutable
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeImmutable $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }
}
