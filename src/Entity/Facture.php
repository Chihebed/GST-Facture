<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
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
    private $NumFacture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DatePaiement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Montanttotalht;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $montanttotalttc;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNumFacture()
    {
        return $this->NumFacture;
    }

    /**
     * @param mixed $NumFacture
     */
    public function setNumFacture($NumFacture): void
    {
        $this->NumFacture = $NumFacture;
    }

    /**
     * @return mixed
     */
    public function getDatePaiement()
    {
        return $this->DatePaiement;
    }

    /**
     * @param mixed $DatePaiement
     */
    public function setDatePaiement($DatePaiement): void
    {
        $this->DatePaiement = $DatePaiement;
    }

    /**
     * @return mixed
     */
    public function getMontanttotalht()
    {
        return $this->Montanttotalht;
    }

    /**
     * @param mixed $Montanttotalht
     */
    public function setMontanttotalht($Montanttotalht): void
    {
        $this->Montanttotalht = $Montanttotalht;
    }

    /**
     * @return mixed
     */
    public function getMontanttotalttc()
    {
        return $this->montanttotalttc;
    }

    /**
     * @param mixed $montanttotalttc
     */
    public function setMontanttotalttc($montanttotalttc): void
    {
        $this->montanttotalttc = $montanttotalttc;
    }

    public function __toString()
    {
        $format = "Commande (id: %s, DateCommande: %s, DateReglement: %s, MoyenPaiement: %s, VilleCommande: %s, TotalCommande: %s, PaiementValide: %s, DateLivraison: %s, PrixLivraison: %s)";
        return sprintf($format, $this->id, $this->DateCommande, $this->DateReglement, $this->MoyenPaiement, $this->VilleCommande, $this->TotalCommande, $this->PaiementValide, $this->DateLivraison, $this->PrixLivraison);
    }
}
