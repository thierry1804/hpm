<?php

namespace App\Entity;

use App\Repository\HebergementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HebergementRepository::class)]
class Hebergement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?float $surface = null;

    #[ORM\Column]
    private ?int $capacite = null;

    /**
     * @var Collection<int, TarifHebergement>
     */
    #[ORM\OneToMany(targetEntity: TarifHebergement::class, mappedBy: 'hebergement', orphanRemoval: true)]
    private Collection $tarifs;

    /**
     * @var Collection<int, UniteHebergement>
     */
    #[ORM\OneToMany(targetEntity: UniteHebergement::class, mappedBy: 'typeHebergement', orphanRemoval: true)]
    private Collection $unites;

    public function __construct()
    {
        $this->tarifs = new ArrayCollection();
        $this->unites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(?float $surface): static
    {
        $this->surface = $surface;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * @return Collection<int, TarifHebergement>
     */
    public function getTarifs(): Collection
    {
        return $this->tarifs;
    }

    public function addTarif(TarifHebergement $tarif): static
    {
        if (!$this->tarifs->contains($tarif)) {
            $this->tarifs->add($tarif);
            $tarif->setHebergement($this);
        }

        return $this;
    }

    public function removeTarif(TarifHebergement $tarif): static
    {
        if ($this->tarifs->removeElement($tarif)) {
            // set the owning side to null (unless already changed)
            if ($tarif->getHebergement() === $this) {
                $tarif->setHebergement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UniteHebergement>
     */
    public function getUnites(): Collection
    {
        return $this->unites;
    }

    public function addUnite(UniteHebergement $unite): static
    {
        if (!$this->unites->contains($unite)) {
            $this->unites->add($unite);
            $unite->setTypeHebergement($this);
        }

        return $this;
    }

    public function removeUnite(UniteHebergement $unite): static
    {
        if ($this->unites->removeElement($unite)) {
            // set the owning side to null (unless already changed)
            if ($unite->getTypeHebergement() === $this) {
                $unite->setTypeHebergement(null);
            }
        }

        return $this;
    }
}
