<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DateCommande;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DateReglement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MoyenPaiement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $VilleCommande;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TotalCommande;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PaiementValide;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DateLivraison;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrixLivraison;

    /**
     * @ORM\OneToOne(targetEntity=Facture::class, cascade={"persist", "remove"})
     */
    private $Factures;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?string
    {
        return $this->DateCommande;
    }

    public function setDateCommande(string $DateCommande): self
    {
        $this->DateCommande = $DateCommande;

        return $this;
    }

    public function getDateReglement(): ?string
    {
        return $this->DateReglement;
    }

    public function setDateReglement(string $DateReglement): self
    {
        $this->DateReglement = $DateReglement;

        return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->MoyenPaiement;
    }

    public function setMoyenPaiement(string $MoyenPaiement): self
    {
        $this->MoyenPaiement = $MoyenPaiement;

        return $this;
    }

    public function getVilleCommande(): ?string
    {
        return $this->VilleCommande;
    }

    public function setVilleCommande(string $VilleCommande): self
    {
        $this->VilleCommande = $VilleCommande;

        return $this;
    }

    public function getTotalCommande(): ?string
    {
        return $this->TotalCommande;
    }

    public function setTotalCommande(string $TotalCommande): self
    {
        $this->TotalCommande = $TotalCommande;

        return $this;
    }

    public function getPaiementValide(): ?string
    {
        return $this->PaiementValide;
    }

    public function setPaiementValide(string $PaiementValide): self
    {
        $this->PaiementValide = $PaiementValide;

        return $this;
    }

    public function getDateLivraison(): ?string
    {
        return $this->DateLivraison;
    }

    public function setDateLivraison(string $DateLivraison): self
    {
        $this->DateLivraison = $DateLivraison;

        return $this;
    }

    public function getPrixLivraison(): ?string
    {
        return $this->PrixLivraison;
    }

    public function setPrixLivraison(string $PrixLivraison): self
    {
        $this->PrixLivraison = $PrixLivraison;

        return $this;
    }

    public function getFactures(): ?Facture
    {
        return $this->Factures;
    }

    public function setFactures(?Facture $Factures): self
    {
        $this->Factures = $Factures;

        return $this;
    }
}
