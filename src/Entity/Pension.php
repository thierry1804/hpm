<?php

namespace App\Entity;

use App\Repository\PensionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PensionRepository::class)]
class Pension
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(nullable: true)]
    private ?float $reductionEnfant = null;

    /**
     * @var Collection<int, TarifPension>
     */
    #[ORM\OneToMany(targetEntity: TarifPension::class, mappedBy: 'pension', orphanRemoval: true)]
    private Collection $tarifs;

    public function __construct()
    {
        $this->tarifs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getReductionEnfant(): ?float
    {
        return $this->reductionEnfant;
    }

    public function setReductionEnfant(?float $reductionEnfant): static
    {
        $this->reductionEnfant = $reductionEnfant;

        return $this;
    }

    /**
     * @return Collection<int, TarifPension>
     */
    public function getTarifs(): Collection
    {
        return $this->tarifs;
    }

    public function addTarif(TarifPension $tarif): static
    {
        if (!$this->tarifs->contains($tarif)) {
            $this->tarifs->add($tarif);
            $tarif->setPension($this);
        }

        return $this;
    }

    public function removeTarif(TarifPension $tarif): static
    {
        if ($this->tarifs->removeElement($tarif)) {
            // set the owning side to null (unless already changed)
            if ($tarif->getPension() === $this) {
                $tarif->setPension(null);
            }
        }

        return $this;
    }
}
